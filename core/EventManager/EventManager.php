<?php
namespace Core\EventManager;

use Psr\Container\ContainerInterface;

class EventManager implements EventManagerInterface
{

	/**
	 * @var array
	 */
	private $listeners = [];

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * EventManager constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * Attaches a listener to an event
	 *
	 * @param string   $event    the event to attach too
	 * @param callable|string $callback a callable function
	 * @param int      $priority the priority at which the $callback executed
	 * @return EventManagerInterface
	 */
	public function attach(string $event, $callback, $priority = 0): EventManagerInterface
	{
		$this->listeners[$event][] = [
			'callback' => $callback,
			'priority' => $priority
		];

		return $this;
	}

	/**
	 * Detaches a listener from an event
	 *
	 * @param string   $event    the event to attach too
	 * @param callable $callback a callable function
	 * @return bool true on success false on failure
	 */
	public function detach(string $event, callable $callback): bool
	{
		$this->listeners[$event] = array_filter($this->listeners[$event], function ($listener) use ($callback) {
			return $listener['callback'] !== $callback;
		});
		return true;
	}

	/**
	 * Clear all listeners for a given event
	 *
	 * @param  string $event
	 * @return void
	 */
	public function clearListeners(string $event): void
	{
		$this->listeners[$event] = [];
	}

	/**
	 * Trigger an event
	 *
	 * Can accept an EventInterface or will create one if not passed
	 *
	 * @param  string|EventInterface $event
	 * @param  object|string         $target
	 * @param  array|object          $argv
	 */
	public function trigger($event, $target = null, $argv = [])
	{
		if (is_string($event)) {
			$event = $this->makeEvent($event, $target, $argv);
		}
		if (isset($this->listeners[$event->getName()])) {
			$listeners = $this->listeners[$event->getName()];
			usort($listeners, function ($listenerA, $listenerB) {
				return $listenerB['priority'] - $listenerA['priority'];
			});
			foreach ($listeners as ['callback' => $callback]) {
				// Used DI for callback resolve
				if (is_string($callback)) {
					$callback = $this->container->get($callback);
				}
				call_user_func($callback, $event);
			}
		}
	}

	/**
	 * @param string $event_name
	 * @param null   $target
	 * @param array  $argv
	 * @return EventInterface
	 */
	private function makeEvent(string $event_name, $target = null, array $argv = []): EventInterface
	{
		$event = new Event();
		$event->setName($event_name);
		$event->setTarget($target);
		$event->setParams($argv);
		return $event;
	}
}
