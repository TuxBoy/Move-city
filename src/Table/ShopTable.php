<?php
namespace App\Table;

use App\Entity\Category;
use App\Entity\Shop;
use Core\Table;
use Doctrine\DBAL\Connection;
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
			->select(static::$table_name)
			->from('shops', 's')
			->orderBy('id', 'DESC')
			->where('s.enable=1')
			->execute()
			->fetchAll(FetchMode::CUSTOM_OBJECT, Shop::class);
	}

	/**
	 * @param int $id
	 * @return Shop
	 * @throws \Exception
	 */
	public function getShopWithCategories(int $id): Shop
	{
		/** @var $shop Shop */
		$shop                 = $this->get($id);
		$categories_from_shop = $this->getTableClass(Category::class)->findByShop($id);
		foreach ($categories_from_shop as $category) {
			$shop->addCategory($category);
		}
		return $shop;
	}

}
