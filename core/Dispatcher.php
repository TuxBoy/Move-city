<?php
namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Dispatcher
 *
 * @package Core
 */
class Dispatcher
{

	/**
	 * @var callable[]
	 */
	private $middlewares;

	/**
	 * @var int
	 */
	private $index = 0;

	/**
	 * @param Request  $request
	 * @param Response $response
	 * @return Response
	 */
	public function process(Request $request, Response $response): Response
	{
		$middleware = $this->getMiddleware();
		$this->index++;
		if (is_null($middleware)) {
			return $response;
		}
		return $middleware($request, $response, [$this, 'process']);
	}

	/**
	 * Add middleware class in the application
	 *
	 * @param callable $middleware
	 * @return Dispatcher
	 */
	public function addMiddleware(callable $middleware): self
	{
		$this->middlewares[] = $middleware;

		return $this;
	}

	/**
	 * @return callable|null
	 */
	private function getMiddleware(): ?callable
	{
		if (isset($this->middlewares[$this->index])) {
			return $this->middlewares[$this->index];
		}
		return null;
	}

}
