<?php
namespace App\Controller;

use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 *
 */
class HomeController
{

	/**
	 * @param PhpRenderer $renderer
	 * @return string
	 * @throws \Exception
	 */
	public function index(PhpRenderer $renderer): string
	{
		return $renderer->render('home.index');
  }

}
