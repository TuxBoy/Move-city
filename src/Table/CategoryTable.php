<?php
namespace App\Table;

use App\Entity\Category;
use Core\Table;
use Doctrine\DBAL\FetchMode;

class CategoryTable extends Table
{

  protected static $table_name = 'categories';

  protected static $entity = Category::class;

	/**
	 * @param int $shop_id
	 * @return Category[]
	 */
  public function findByShop(int $shop_id): array
	{
		return $this->connection->createQueryBuilder()
			->select('*')
			->from(static::$table_name, 'c')
			->leftJoin('c', 'shops_categories', 'sc', 'c.id = sc.category_id')
			->where('sc.shop_id = ?')
			->setParameter(0, $shop_id)
			->execute()
			->fetchAll(FetchMode::CUSTOM_OBJECT, Category::class);
	}

}
