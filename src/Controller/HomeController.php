<?php
namespace App\Controller;

use App\Table\ShopTable;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HomeController
 *
 */
class HomeController
{

	public function index(ShopTable $shopTable)
	{
  	return new JsonResponse($shopTable->getAll());
  }

}
