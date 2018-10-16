<?php
namespace Core\EventManager;

/**
 * Psr Interface for EventManager
 */
interface EventManagerInterface
{
	/**
	 * Attaches a listener to an event
	 *
	 * @param string $event the event to attach too
	 * @param callable|string $callback a callable function
	 * @param int $priority the priority at which the $callback executed
	 * @return EventManagerInterface
	 */
	public function attach(string $event, $callback, $priority = 0): self;

	/**
	 * Detaches a listener from an event
	 *
	 * @param string $event the event to attach too
	 * @param callable $callback a callable function
	 * @return bool true on success false on failure
	 */
	public function detach(string $event, callable $callback): bool;

	/**
	 * Clear all listeners for a given event
	 *
	 * @param  string $event
	 * @return void
	 */
	public function clearListeners(string $event): void;

	/**
	 * Trigger an event
	 *
	 * Can accept an EventInterface or will create one if not passed
	 *
	 * @param  string|EventInterface $event
	 * @param  object|string $target
	 * @param  array|object $argv
	 * @return mixed
	 */
	public function trigger($event, $target = null, $argv = []);

}
