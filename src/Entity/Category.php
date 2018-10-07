<?php
namespace App\Entity;

use Core\Entity;

class Category extends Entity
{

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