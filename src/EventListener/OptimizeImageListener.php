<?php
namespace App\EventListener;

use App\EventManager\OptimizeImageEvent;
use App\Traits\HasImage;
use Intervention\Image\ImageManager;

class OptimizeImageListener
{

	/**
	 * @var ImageManager
	 */
	private $imageManager;

	/**
	 * OptimizeImageListener constructor
	 *
	 * @param ImageManager $imageManager
	 */
	public function __construct(ImageManager $imageManager)
	{
		$this->imageManager = $imageManager;
	}

	/**
	 * @param OptimizeImageEvent $event
	 */
	public function __invoke(OptimizeImageEvent $event)
	{
		$entity = $event->getTarget();
		if ($entity->image && $this->classHasTrait($entity, HasImage::class)) {
			$image = $entity->image;
			['extension' => $extension, 'filename' => $filename] = pathinfo($image);
			$this->imageManager
				->make(PUBLIC_PATH . 'uploads/' . $image)
				->fit(300, 200)
				->save(PUBLIC_PATH . 'uploads/' . $filename . '_thumb.' . $extension);
		}
	}

	/**
	 * Check if object has trait in the uses
	 *
	 * @param object $object
	 * @param string $trait
	 * @return bool true if the trait exist in the object
	 */
	private function classHasTrait($object, string $trait): bool
	{
		if (!trait_exists($trait)) {
			return false;
		}
		return in_array(HasImage::class, class_uses($object));
	}

}
