<?php
namespace App;

use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Kernel
 *
 * @package App
 */
class Kernel
{

	/**
	 * @var ContainerInterface
	 */
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * @var string
	 */
	public static $controller_path = 'App\\Controller\\';

	/**
	 * @param $request ServerRequestInterface
	 * @return ResponseInterface
	 * @throws Exception
	 */
	public function handler(ServerRequestInterface $request): ResponseInterface
	{
		$clear_request   = trim($request->getUri()->getPath(), '/') ?? '/';
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
				$response = new Response(404, [], '<h1>Page introuvable</h1>');
			}
			else {
				$args     = $request->getQueryParams() ?? [];
				$response = $controller_instantiable->$action($request, $args);
			}
		}

		if (is_string($response)) {
			$response = new Response(200, [], $response);
		}

		return $response;
	}

}
