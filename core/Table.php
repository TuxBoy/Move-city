<?php
namespace Core;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Types\Type;
use ReflectionClass;
use ReflectionException;
use SDAM\Annotation\Annotation;
use SDAM\Annotation\AnnotationsName;

abstract class Table
{

  /** @var string */
  protected static $table_name;

  /**
   * @var Connection
   */
  protected $connection;

  /**
   * @var Entity
   */
  protected static $entity;

  /**
   * ShopTable constructor
   *
   * @param Connection $connection
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * @param string $entity
   * @return mixed
   * @throws \Exception
   */
  public function getTableClass(string $entity): Table
  {
    $parts_entity = explode('\\', $entity);
    $table_name   = 'App\\Table\\' . ucfirst(end($parts_entity)) . 'Table';
    if (!class_exists($table_name)) {
      throw new \Exception("Table $table_name does not exist");
    }
    return new $table_name($this->connection);
  }

  /**
   * Return all data in the database
   *
   * @return object[]|Entity[]
   */
  public function getAll(): array
  {
    return $this->connection->createQueryBuilder()
      ->select('*')
      ->from(static::$table_name)
      ->orderBy('id', 'DESC')
      ->execute()
      ->fetchAll(FetchMode::CUSTOM_OBJECT, static::$entity);
  }

	/**
	 * @param int $limit
	 * @return object[]|Entity[] The recent item by created date with limit
	 */
	public function getRecentShops(int $limit = 15): array
	{
		return $this->connection->createQueryBuilder()
			->select('*')
			->from(static::$table_name)
			->orderBy('created_at', 'DESC')
			->setMaxResults($limit)
			->execute()
			->fetchAll(FetchMode::CUSTOM_OBJECT, static::$entity);
	}

  /**
   * @param int $id
   * @return object
   * @throws \Exception
   */
  public function get(int $id)
  {
    $record = $this->connection->createQueryBuilder()
      ->select('*')
      ->from(static::$table_name, 't')
      ->where('t.id = ?')
      ->setParameter(0, $id)
      ->execute()
      ->fetch();
    if (!$record) {
      throw new \Exception("The $id param id is not found");
    }
    return $this->hydrate($record);
  }

  /**
   * Insert or update if id index exist
   *
   * @param array|Entity $data
   * @return Statement|int
   * @throws ReflectionException|\Doctrine\DBAL\DBALException
   * @throws \PhpDocReader\AnnotationException|\Exception
   */
  public function save($data): int
  {
  	$relations      = [];
		$relation_table = null;
    if (is_object($data)) {
      $data = $this->objectToArray($data);
    }
    $this->prepareForeignData($data);
    $update         = isset($data['id']) && !empty($data['id']);
    $prepare_values = [];
    // Build values for the prepare query ('key' => '?' ..)
    array_map(function ($value) use (&$prepare_values) {
      $prepare_values[$value] = '?';
    }, array_keys($data));

    if ($update) {
      $identifier = [];
      if (isset($data['id'])) {
        $identifier['id'] = (int) $data['id'];
        unset($data['id']);
      }
      return $this->connection->update(static::$table_name, $data, $identifier);
    }

		$record = $this->connection
			->createQueryBuilder()
			->insert(static::$table_name)
			->values($prepare_values)
			->setParameters(array_values($data))
			->execute();

    // Manage relation insert in the foreign table
    if (($last_record_id = $this->connection->lastInsertId()) && $relation_table && !empty($relations)) {
    	$relations_records = $relations->getValues();
			foreach ($relations_records as $relations_record) {
				$foreign_key            = $this->entityToForeignKey($relations_record);
				$base_key               = $this->entityToForeignKey(static::$entity);
				$prepare_foreign_values = [$foreign_key => ':' . $foreign_key, $base_key => ':' . $base_key];
				$this->connection->createQueryBuilder()
					->insert($relation_table)
					->values($prepare_foreign_values)
					->setParameters([':' . $foreign_key => $relations_record->id, ':' . $base_key => $last_record_id])
					->execute();
    	}
		}

    return $record;
  }

	/**
	 * @param Entity|string $entity_name
	 * @return string The foreign key based entity class name (App\Entity\Post => post_id)
	 */
  private function entityToForeignKey($entity_name): string
	{
		if (is_object($entity_name)) {
			$entity_name = get_class($entity_name);
		}
		$parts = explode('\\', $entity_name);
		return strtolower(end($parts)) . '_id';
	}

  /**
   * @param array $record
   * @param string $entity_name
   * @return string|object Hydrate entity
   * @throws \Exception
   */
  private function hydrate(array $record, ?string $entity_name = null)
  {
    $entity = $entity_name ? new $entity_name : new static::$entity;
    foreach ($record as $property => $value) {
      if (substr($property, -3) === '_id' && $value) {
        $foreign_entity_property = Str::lParse($property, '_');
        $foreign_entity          = Annotation::of(get_class($entity), $foreign_entity_property)->getObjectVar();
        $foreign_table           = $this->getTableClass($foreign_entity);
        $entity->$foreign_entity_property = $foreign_table->get($value);
      }
      $entity->$property = $value;
    }
    return $entity;
  }

  /**
   * @param Entity $entity
   * @return array
   * @throws ReflectionException
   * @throws \PhpDocReader\AnnotationException|\Exception
   */
  private function objectToArray(Entity $entity): array
  {
    $result = [];
    $class  = new ReflectionClass(get_class($entity));
    foreach ($class->getProperties() as $property) {
    	$name = $property->getName();
      if ($property->getValue($entity) === '1') {
        $property->setValue($entity, 1);
      }
      elseif ($property->getValue($entity) === "0") {
        $property->setValue($entity, 0);
      }
      if (
        Annotation::of($class, $name)->hasAnnotation(AnnotationsName::P_LINK) &&
        Annotation::of($class, $name)->getAnnotation(AnnotationsName::P_LINK)->getValue() === 'belongsTo'
      ) {
        $result[$name . '_id'] = $property->getValue($entity);
      }
			if (
				Annotation::of($class, $name)->hasAnnotation(AnnotationsName::P_LINK) &&
				Annotation::of($class, $name)->getAnnotation(AnnotationsName::P_LINK)->getValue() === 'belongsToMany'
			) {
				$result[$name] = $property->getValue($entity);
			}
      if (in_array($name, ['createdAt', 'updatedAt'])) {
      	// Transform createdAt => created_at
      	$property_to_key = strtolower(Str::lParse($name, 'At')) . '_at';
				$value = $property->getValue($entity) ? $property->getValue($entity) : (new \DateTime())->format('Y-m-d H:i:s');
      	$result[$property_to_key] = $value;
			}
      elseif (!Annotation::of($class, $name)->hasAnnotation(AnnotationsName::P_LINK)) {
        $result[$name] = $property->getValue($entity);
      }
    }
    return $result;
  }

  /**
   * @param int $id
   * @return int
   * @throws \Doctrine\DBAL\DBALException|\Doctrine\DBAL\Exception\InvalidArgumentException
   */
  public function delete(int $id): int
  {
    return $this->connection->delete(static::$table_name, ['id' => $id], ['id' => Type::INTEGER]);
  }

	/**
	 * @param array $data
	 * @throws \Exception
	 */
	private function prepareForeignData(array &$data): void
	{

		foreach ($data as $key => $value) {
			if ($value instanceof Collection) {
				/** @var $relations Collection */
				$relations      = $data[$key];
				$relation_table = static::$table_name . '_' . $key;
				if (!$this->connection->getSchemaManager()->tablesExist([$relation_table])) {
					throw new \Exception("Relation table $relation_table does not exist in the database");
				}
				unset($data[$key]);
			}
		}
	}

}
