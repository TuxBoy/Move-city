<?php
namespace App\Container;

use Exception;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use ReflectionException;

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
				$parameters = $constructor->getParameters();
				$constructor_parameters = [];
				foreach ($parameters as $parameter) {
					if ($parameter_class = $parameter->getClass()) {
						if ($parameter_class->getName() === ServerRequestInterface::class) {
							$constructor_parameters[] = ServerRequest::fromGlobals();
						}
						else {
							$constructor_parameters[] = $this->get($parameter_class->getName());
						}
					}
					else {
						$constructor_parameters[] = $parameter->getDefaultValue();
					}
				}
				return $reflected_class->newInstanceArgs($constructor_parameters);
			}
			else {
				return $reflected_class->newInstance();
			}
		}
		else {
			throw new Exception($id . ' is not an instantiable class');
		}
	}

}
