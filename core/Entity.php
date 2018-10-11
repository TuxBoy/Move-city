<?php
namespace Core;

use SDAM\Annotation\Annotation;
use SDAM\Annotation\AnnotationsName;

abstract class Entity
{

  /**
   * Entity constructor
   *
   * @param array $request
   */
  public function __construct(array $request = [])
  {
    $this->set($request);
  }

  /**
   * @param array $request
   */
  public function set(array $request = [])
  {
    foreach ($request as $property => $value) {
      if (property_exists(get_called_class(), $property)) {
        $this->$property = $value;
      }
    }
  }

}
