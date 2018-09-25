<?php
namespace App\Controller;

use GuzzleHttp\Psr7\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{

	public function index()
	{
  	return new Response(200, [], 'Hello');
  }

}
