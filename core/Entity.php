<?php
namespace Core;

use Doctrine\Common\Collections\Collection;
use Exception;
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
   * @throws Exception
   */
  public function set(array $request = [])
  {
    foreach ($request as $property => $value) {
      if (property_exists(get_called_class(), $property)) {
        if (!$this->$property instanceof Collection) {
          $setter = 'set' . ucfirst($property);
          if (method_exists(get_called_class(), $setter)) {
            $this->$setter($value);
          }
          else {
            $this->$property = $value;          
          }
        }
      }
      else {
        throw new Exception(sprintf('The %s property does not exist', $property));
      }
    }
  }

}
