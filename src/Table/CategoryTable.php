<?php
namespace App\Table;

use App\Entity\Category;
use Core\Table;

class CategoryTable extends Table
{

  protected static $table_name = 'categories';

  protected static $entity = Category::class;

}