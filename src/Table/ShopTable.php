<?php
namespace App\Table;

use App\Entity\Shop;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\FetchMode;

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
	 * @param array $data
	 * @return Statement|int
	 */
	public function save(array $data = []): int
	{
		$values         = array_filter($data); // Clear null data
		$prepare_values = [];
		// Build values for the prepare query ('key' => '?' ..)
		array_map(function ($value) use (&$prepare_values) {
			$prepare_values[$value] = '?';
		}, array_keys($values));

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

}
