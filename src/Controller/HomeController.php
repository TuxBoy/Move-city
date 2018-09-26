<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HomeController
 *
 */
class HomeController
{

	public function index()
	{
  	return new JsonResponse(['slug' => 'test']);
  }

}
