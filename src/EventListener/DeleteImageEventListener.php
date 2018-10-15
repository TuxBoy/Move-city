<?php
namespace App\EventListener;

use App\EventManager\ImageEvent;

/**
 * Class DeleteImageEventListener
 */
class DeleteImageEventListener
{

	/**
	 * @param ImageEvent $event
	 */
	public function __invoke(ImageEvent $event)
	{
		/** @var $category \App\Entity\Category */
		$category = $event->getTarget();
		$image    = PUBLIC_PATH . 'uploads/' . $category->image;
		if (file_exists($image)) {
			unlink($image);
		}
	}

}
