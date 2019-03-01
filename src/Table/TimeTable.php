<?php
namespace App\Table;

use App\Entity\Time;
use Core\Table;

class TimeTable extends Table
{

  protected static $table_name = 'times';

  protected static $entity = Time::class;

}
