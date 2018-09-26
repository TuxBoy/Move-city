<?php
namespace Core\Container;

use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DIC
 *
 * @package App
 */
class DIC implements ContainerInterface
{

	/**
	 * @var string[]
	 */
	private $registry = [];

	/**
	 * @var array
	 */
	private $instances = [];

	/**
	 * @var array
	 */
	private $factories = [];

	/**
	 * @var Response
	 */
	private $response;

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * DIC constructor
	 *
	 * @param Request  $request
	 * @param Response $response
	 */
	public function __construct(Request $request, Response $response)
	{
		$this->response = $response;
		$this->request  = $request;
	}

	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return mixed Entry.
	 * @throws ReflectionException|Exception
	 */
	public function get($id)
	{
		if (isset($this->factories[$id])) {
			return $this->factories[$id];
		}
		if (!isset($this->instances[$id])) {
			if (isset($this->registry[$id])) {
				$this->instances[$id] = $this->registry[$id]($this);
			}
			else {
				$this->instances[$id] = $this->resolve($id);
			}
		}
		return $this->instances[$id];
	}

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has($id)
	{
		return array_key_exists($id, $this->registry);
	}

	/**
	 * @param string   $id
	 * @param callable $resolver
	 */
	public function set(string $id, callable $resolver)
	{
		$this->registry[$id] = $resolver;
	}

	/**
	 * @param string   $id
	 * @param callable $resolver
	 */
	public function setFactory(string $id, callable $resolver)
	{
		$this->factories[$id] = $resolver;
	}

	/**
	 * @param string $id
	 * @return object
	 * @throws ReflectionException|Exception
	 */
	private function resolve(string $id)
	{
		$reflected_class = new ReflectionClass($id);
		if ($reflected_class->isInstantiable()) {
			if ($constructor = $reflected_class->getConstructor()) {
				return $reflected_class->newInstanceArgs($this->getParameters($constructor));
			}
			else {
				return $reflected_class->newInstance();
			}
		}
		else {
			throw new Exception($id . ' is not an instantiable class');
		}
	}

	/**
	 * @param ReflectionMethod $reflectionMethod
	 * @return array
	 * @throws ReflectionException
	 */
	private function getParameters(ReflectionMethod $reflectionMethod): array
	{
		$parameters         = $reflectionMethod->getParameters();
		$resolve_parameters = [];
		foreach ($parameters as $parameter) {
			if ($parameter_class = $parameter->getClass()) {
				if ($parameter_class->getName() === Request::class) {
					$resolve_parameters[] = $this->request;
				}
				elseif ($parameter_class->getName() === Response::class) {
					$resolve_parameters[] = $this->response;
				}
				else {
					$resolve_parameters[] = $this->get($parameter_class->getName());
				}
			}
			else {
				$resolve_parameters[] = $parameter->getDefaultValue();
			}
		}
		return $resolve_parameters;
	}

	/**
	 * @param $class_name  string
	 * @param $method_name string
	 * @return array
	 * @throws Exception
	 */
	public function parameterResolver(string $class_name, string $method_name): array
	{
		$class = new ReflectionClass($class_name);
		if (!$method_name || !$class->hasMethod($method_name)) {
			throw new Exception($method_name . ' does not exist in the ' . $class_name . ' Class');
		}
		$class_method = $class->getMethod($method_name);
		return $this->getParameters($class_method);
	}

}
