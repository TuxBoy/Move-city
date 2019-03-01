<?php
namespace Core;

use Doctrine\Common\Collections\Collection;
use Exception;

/**
 * Class Entity
 * @package Core
 */
abstract class Entity
{

  /**
   * Entity constructor
   *
   * @param array $request
   * @throws Exception
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
          $setter = $this->propertyToSetter($property);
          if (method_exists(get_called_class(), $setter)) {
            $this->{$setter}($value);
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

  /**
   * @param string $property
   * @return string
   */
  private function propertyToSetter(string $property): string
  {
    return 'set' . join('', array_map('ucfirst', explode('_', $property)));
  }

}
