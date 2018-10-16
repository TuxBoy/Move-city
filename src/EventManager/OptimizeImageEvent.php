<?php
namespace App\EventManager;

use Core\Entity;
use Core\EventManager\Event;

class OptimizeImageEvent extends Event
{

	/**
	 * OptimizeImageEvent constructor
	 *
	 * @param Entity $entity
	 */
	public function __construct(Entity $entity)
	{
		$this->setName('image.optimize');
		$this->setTarget($entity);
	}

}
