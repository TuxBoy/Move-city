<?php
namespace Core;

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
	 * @param $request Request
	 * @return Response
	 * @throws Exception
	 */
	public function handler(Request $request): Response
	{
		$clear_request   = trim($request->getPathInfo(), '/') ?? '/';
		$parts_request   = explode('/', $clear_request);
		$controller_name = $parts_request[0];
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
				$args     = $request->query->all() ?? [];
				$response = $controller_instantiable->$action($request, $args);
			}
		}

		if (is_string($response)) {
			$response = new Response($response);
		}

		return $response;
	}

}
