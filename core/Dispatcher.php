<?php
namespace Core;

use Psr\Container\ContainerInterface;
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
   * @var ContainerInterface
   */
  private $container;

  /**
   * Dispatcher constructor.
   * @param ContainerInterface $container
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

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
	 * @param callable|string $middleware
	 * @return Dispatcher
	 */
	public function addMiddleware($middleware): self
	{
	  if (is_string($middleware)) {
	    $middleware = $this->container->get($middleware);
    }
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
