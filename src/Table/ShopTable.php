<?php
namespace App\Table;

use App\Entity\Shop;
use Core\Entity;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Types\Type;
use ReflectionClass;
use ReflectionException;

/**
 * Class ShopTable
 */
class ShopTable
{

	/**
	 * @var Connection
	 */
	private $connection;

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
   * @param int $id
   * @return Shop
   * @throws \Exception
   */
	public function get(int $id) : Shop
  {
    $record = $this->connection->createQueryBuilder()
      ->select('*')
      ->from('shops', 's')
      ->where('s.id = ?')
      ->setParameter(0, $id)
      ->execute()
      ->fetch();
    if (!$record) {
      throw new \Exception("The $id param id is not found");
    }
    return $this->hydrate($record, Shop::class);
  }

	/**
	 * Return all data in the database
	 *
	 * @return Shop[]
	 */
	public function getAll()
	{
		return $this->connection->createQueryBuilder()
			->select('*')
			->from('shops')
			->execute()
			->fetchAll(FetchMode::CUSTOM_OBJECT, Shop::class);
	}

	/**
	 * Insert or update if id index exist
	 *
	 * @param array|object $data
	 * @return Statement|int
	 * @throws ReflectionException|\Doctrine\DBAL\DBALException
	 */
	public function save($data): int
	{
	  if (is_object($data)) {
      $data = $this->objectToArray($data);
    }
    $update         = isset($data['id']) && !empty($data['id']);
		$values         = array_filter($data); // Clear null data
		$prepare_values = [];
		// Build values for the prepare query ('key' => '?' ..)
    foreach ($values as $field => $value) {
      $prepare_values[$value] = ':' . $field;
		}

		if ($update) {
      $identifier = [];
      if (isset($values['id'])) {
        $identifier['id'] = (int) $values['id'];
        unset($values['id']);
      }
      return $this->connection->update('shops', $values, $identifier);
    }
		return $this->connection
			->createQueryBuilder()
			->insert('shops')
			->values($prepare_values)
			->setParameters(array_values($values))
			->execute();
	}

  /**
   * @param array $record
   * @param string $entity
   * @return string
   */
  private function hydrate(array $record, string $entity)
  {
    $entity = new $entity;
    foreach ($record as $property => $value) {
      if (property_exists($entity, $property)) {
        $entity->$property = $value;
      }
    }
    return $entity;
  }

  /**
   * @param Entity $entity
   * @return array
   * @throws ReflectionException
   */
  private function objectToArray(Entity $entity): array
  {
    $result = [];
    $class  = new ReflectionClass(get_class($entity));
    foreach ($class->getProperties() as $property) {
      if ($property->getValue($entity) === 'on') {
        $property->setValue($entity, 1);
      }
      $result[$property->getName()] = $property->getValue($entity);
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
		return $this->connection->delete('shops', ['id' => $id], ['id' => Type::INTEGER]);
	}

}
