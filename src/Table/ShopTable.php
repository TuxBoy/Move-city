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

}
