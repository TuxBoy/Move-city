<?php
namespace App\EventManager;

use Core\Entity;
use Core\EventManager\Event;

class ImageEvent extends Event
{

	public function __construct(Entity $entity)
	{
		$this->setName('entity.delete.image');
		$this->setTarget($entity);
	}

}
