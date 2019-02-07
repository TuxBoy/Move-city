<?php
namespace Test\Event;

use Core\EventManager\EventInterface;
use Core\EventManager\EventManager;
use Core\EventManager\EventManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Test\Event\Fixtures\FooEvent;

/**
 * Class EventManagerTest
 */
class EventManagerTest extends TestCase
{

	/**
	 * @var EventManagerInterface
	 */
	private $eventManager;

	/**
	 * @var ContainerInterface|MockObject
	 */
	private $container;

	public function setUp()
	{
		$this->container    = $this->getMockBuilder(ContainerInterface::class)->getMock();
		$this->eventManager = new EventManager($this->container);
		parent::setUp();
	}

	public function tearDown()
	{
		$this->eventManager = null;
		$this->container    = null;
		parent::tearDown();
	}

	/**
	 * @test
	 */
	public function triggerEvent()
	{
		$event = $this->makeEvent();
		$this->eventManager->attach($event->getName(), function () { echo 'Event1'; });
		$this->eventManager->trigger($event);
		$this->expectOutputString('Event1');
	}

	/**
	 * @test
	 */
	public function triggerMultipleEvent()
	{
		$event = $this->makeEvent();
		$this->eventManager->attach($event->getName(), function () { echo 'Event1'; });
		$this->eventManager->attach($event->getName(), function () { echo 'Event2'; });
		$this->eventManager->attach($event->getName(), function () { echo 'Event3'; });
		$this->eventManager->trigger($event);
		$this->expectOutputRegex('/Event1/');
		$this->expectOutputRegex('/Event2/');
		$this->expectOutputRegex('/Event3/');
	}

	/**
	 * @test
	 */
	public function triggerEventWithEventObject()
	{
		$event = $this->makeEvent();
		$this->eventManager->attach($event->getName(), function () { echo 'Event1'; });
		$this->eventManager->trigger($event->getName());
		$this->expectOutputString('Event1');
	}

	/**
	 * @test
	 */
	public function detachEvent()
	{
		$event     = $this->makeEvent('a');
		$event2    = $this->makeEvent('b');
		$callback2 = function () { echo 'Event2'; };
		$this->eventManager->attach($event->getName(),  function () { echo 'Event1'; });
		$this->eventManager->attach($event2->getName(), $callback2);
		$this->eventManager->detach($event2->getName(), $callback2);
		$this->eventManager->trigger($event->getName());
		$this->expectOutputString('Event1');
	}

	/**
	 * @test
	 */
	public function clearListeners()
	{
		$event     = $this->makeEvent('a');
		$event2    = $this->makeEvent('b');
		$this->eventManager->attach($event->getName(),   function () { echo 'Event1'; });
		$this->eventManager->attach($event->getName(),   function () { echo 'Event2'; });
		$this->eventManager->attach($event2->getName(),  function () { echo 'Event21'; });
		$this->eventManager->clearListeners($event->getName());
		$this->eventManager->trigger($event->getName());
		$this->eventManager->trigger($event2->getName());
		$this->expectOutputString('Event21');
	}

	/**
	 * @test
	 */
	public function triggerOrderWithPriority()
	{
		$event = $this->makeEvent();
		$this->eventManager->attach($event->getName(), function () { echo 'Event1'; }, 1000);
		$this->eventManager->attach($event->getName(), function () { echo 'Event3'; });
		$this->eventManager->attach($event->getName(), function () { echo 'Event2'; }, 100);
		$this->eventManager->trigger($event->getName());
		$this->expectOutputString('Event1Event2Event3');
	}

	/**
	 * @test
	 */
	public function triggerEventWithClassForAttach()
	{
		$this->container->method('get')->willReturn(new FooEvent());

		$event = $this->makeEvent();
		$this->eventManager->attach($event->getName(), FooEvent::class);
		$this->eventManager->trigger($event->getName());
		$this->expectOutputString('Event1');
	}

	/**
	 * @param string $event_name
	 * @return EventInterface|MockObject
	 */
	public function makeEvent(string $event_name = 'default.event'): EventInterface
	{
		$event = $this->getMockBuilder(EventInterface::class)->getMock();
		$event->method('getName')->willReturn($event_name);
		return $event;
	}

}
