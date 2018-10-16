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
		['filename' => $filename] = pathinfo($category->image);
		foreach (glob(PUBLIC_PATH . 'uploads/' . $filename . '*') as $image) {
			if (file_exists($image)) {
				unlink($image);
			}
		}
	}

}
