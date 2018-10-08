<?php
namespace Core;

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
      ->fetchAll(FetchMode::CUSTOM_OBJECT,static::$entity);
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
      ->from(static::$table_name, 's')
      ->where('s.id = ?')
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
   * @throws \PhpDocReader\AnnotationException
   */
  public function save($data): int
  {
    if (is_object($data)) {
      $data = $this->objectToArray($data);
    }
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
    return $this->connection
      ->createQueryBuilder()
      ->insert(static::$table_name)
      ->values($prepare_values)
      ->setParameters(array_values($data))
      ->execute();
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
      if ($property->getValue($entity) === '1') {
        $property->setValue($entity, 1);
      }
      elseif ($property->getValue($entity) === "0") {
        $property->setValue($entity, 0);
      }
      if (
        Annotation::of(get_class($entity), $property->getName())->hasAnnotation(AnnotationsName::P_LINK) &&
        Annotation::of(get_class($entity), $property->getName())->getAnnotation('link')->getValue() === 'belongsTo'
      ) {
        $result[$property->getName() . '_id'] = $property->getValue($entity);
      }
      elseif (!Annotation::of($class, $property->getName())->hasAnnotation(AnnotationsName::P_LINK)) {
        $result[$property->getName()] = $property->getValue($entity);
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

}
