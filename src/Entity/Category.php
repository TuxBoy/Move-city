<?php
namespace App\Entity;

use Core\Entity;
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

}
