<?php
namespace Test\Entity;

use Core\Entity;

class Foo extends Entity
{

  /**
   * @var string
   */
  public $foo;

  /**
   * @var string
   */
  public $bar;

  /**
   * @var string
   */
  public $bar_bar;

  /**
   * @var string
   */
  public $fooFoo;

  /**
   * @var string
   */
  public $fake;

  /**
   * @param string $fake
   */
  public function setFake(string $fake): void
  {
    $this->fake = $fake;
  }

  /**
   * @param string $bar_bar
   */
  public function setBarBar(string $bar_bar): void
  {
    $this->bar_bar = strtoupper($bar_bar);
  }

}