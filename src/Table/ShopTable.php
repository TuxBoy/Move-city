<?php
namespace App\Table;

use App\Entity\Shop;
use Core\Table;
use Doctrine\DBAL\FetchMode;

/**
 * Class ShopTable
 */
class ShopTable extends Table
{

  protected static $table_name = 'shops';

  protected static $entity = Shop::class;

	/**
	 * @return Shop[]
	 */
	public function getEnableShops(): array
	{
		return $this->connection->createQueryBuilder()
			->select('*')
			->from('shops', 's')
			->orderBy('id', 'DESC')
			->where('s.enable=1')
			->execute()
			->fetchAll(FetchMode::CUSTOM_OBJECT, Shop::class);
	}

}
