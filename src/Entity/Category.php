<?php
namespace App\Entity;

use App\Traits\HasImage;
use Core\Entity;
use Core\Str;
use SDAM\Traits\HasCreatedAt;

/**
 * Class Category
 */
class Category extends Entity
{
	use HasCreatedAt;
	use HasImage;

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
