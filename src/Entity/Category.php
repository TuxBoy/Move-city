<?php
namespace App\Entity;

use Core\Entity;
use Core\Str;
use SDAM\Traits\HasCreatedAt;

/**
 * Class Category
 */
class Category extends Entity
{
	use HasCreatedAt;

  /**
   * @var integer
   */
  public $id;

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $slug;

  /**
   * @var string
   */
  public $image;

  /**
   * @return string
   */
  public function displayImage(): string
  {
    return $this->image ? '<img width="200" src="/uploads/' . $this->image .'" alt="Category image">' : '';
  }

  /**
   * @param string|null $value
   * @return $this
   */
  public function setSlug(?string $value = null): self
  {
    if (is_null($value)) {
      $this->slug = Str::slugify($this->name);
    }
    else {
      $this->slug = Str::slugify($value);
    }
    return $this;
  }

}
