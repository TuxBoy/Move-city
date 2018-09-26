<?php
namespace App\Controller;

use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HomeController
 *
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
