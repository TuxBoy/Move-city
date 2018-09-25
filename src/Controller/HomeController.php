<?php
namespace App\Controller;

use App\PhpRenderer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{

	/**
	 * @var PhpRenderer
	 */
	private $view;

	public function __construct(PhpRenderer $view)
	{
		$this->view = $view;
	}

	public function index()
	{
  	return new JsonResponse(['slug' => 'test']);
  }

}
