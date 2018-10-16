<?php
namespace Test\Event\Fixtures;

use Core\EventManager\Event;

class FooEvent
{

	public function __invoke(Event $event)
	{
		echo 'Event1';
	}

}
