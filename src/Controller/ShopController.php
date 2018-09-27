<?php
namespace App\Controller;

use App\Table\ShopTable;
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

}
