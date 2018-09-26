<?php
namespace Core;

use App\Controller\HomeController;
use Exception;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Kernel
 *
 * @package App
 */
class Kernel
{

	/**
	 * @var string
	 */
	public static $controller_path = 'App\\Controller\\';

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * Kernel constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * @param          $request Request
	 * @param Response $response
	 * @return Response
	 * @throws Exception
	 */
	public function handler(Request $request, Response $response): Response
	{
    $clear_request   = $request->getPathInfo();
    if ($clear_request[-1] === '/') {
        $clear_request = substr($clear_request, 0, -1);
    }
      if (!empty($clear_request)) {
          $parts_request   = explode('/', trim($clear_request, '/'));
          $controller_name = $parts_request[0];
    }
    else {
        $controller_name = 'home';
    }
		$controller      = static::$controller_path . ucfirst($controller_name) . 'Controller';
		if (!class_exists($controller)) {
				throw new Exception("The controller $controller does not exist");
		}
		$controller_instantiable = $this->container->get($controller);
		if (is_callable($controller_instantiable)) {
			$response = call_user_func_array($controller_instantiable, [$request]);
		}
		else {
			$action = count($parts_request) > 1 ? $parts_request[1] : 'index';
			if (!method_exists($controller, $action)) {
				$response = new Response('<h1>Page introuvable</h1>', 404);
			}
			else {
				$parameters = $this->container->parameterResolver(get_class($controller_instantiable), $action);
				$response = call_user_func_array([$controller_instantiable, $action], $parameters);
			}
		}

		if (is_string($response)) {
			$response = new Response($response);
		}

		return $response;
	}

}
