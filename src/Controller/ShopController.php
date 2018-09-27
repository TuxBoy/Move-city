<?php
namespace App\Controller;

use App\Table\ShopTable;
use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ShopController
 */
class ShopController
{

	/**
	 * @param ShopTable $shopTable
	 * @return JsonResponse
	 */
	public function index(ShopTable $shopTable): JsonResponse
	{
		return new JsonResponse($shopTable->getAll());
	}

	/**
	 * @param PhpRenderer $renderer
	 * @return string
	 * @throws \Exception
	 */
	public function create(PhpRenderer $renderer)
	{
		return $renderer->render('shop.create');
	}

}
