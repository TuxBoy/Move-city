<?php
namespace App\Controller;

use App\Table\ShopTable;
use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
	 * @param Request     $request
	 * @param ShopTable   $shopTable
	 * @return string
	 * @throws \Exception
	 */
	public function create(PhpRenderer $renderer, Request $request, ShopTable $shopTable)
	{
		if ($request->getMethod() === 'POST') {
			$shopTable->save($request->request->all());
		}
		return $renderer->render('shop.create');
	}

}
