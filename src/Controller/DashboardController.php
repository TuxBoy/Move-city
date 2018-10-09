<?php
namespace App\Controller;

use App\Table\CategoryTable;
use App\Table\ShopTable;
use Core\PhpRenderer;

class DashboardController
{

	/**
	 * @param PhpRenderer   $renderer
	 * @param ShopTable     $shopTable
	 * @param CategoryTable $categoryTable
	 * @return string
	 * @throws \Exception
	 */
	public function index(PhpRenderer $renderer, ShopTable $shopTable, CategoryTable $categoryTable): string
	{
		return $renderer->render('admin.dashboard.index', [
			'shops'      => $shopTable->getRecentShops(),
			'categories' => $categoryTable->getRecentShops()
		]);
	}

}
