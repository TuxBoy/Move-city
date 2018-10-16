<?php
namespace App\Traits;

trait HasImage
{

	/**
	 * @var string
	 */
	public $image;

	/**
	 * @param string $suffix
	 * @return string|null
	 */
	public function displayImage(string $suffix = ''): ?string
	{
		if (!$this->image) {
			return null;
		}
		['extension' => $extension, 'filename' => $filename] = pathinfo($this->image);
		$image_name = $filename . '_' . $suffix . DOT . $extension;
		return $this->image ? '<img src="/uploads/' . $image_name .'" alt="image">' : '';
	}

}
