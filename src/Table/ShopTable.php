<?php
namespace App\Table;

use App\Entity\Shop;
use Doctrine\DBAL\Connection;
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
	 * @return \Doctrine\DBAL\Driver\Statement|int
	 */
	public function save(array $data = [])
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

}
