<?php
namespace Test\Entity;

use Exception;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{

  /**
   * @dataProvider requestProvider
   * @test
   * @param $value    string
   * @param $expected string
   */
  public function request_data_to_entity_object($value, $expected)
  {
    $entity = new Foo([$value => $expected]);

    $this->assertEquals($expected, $entity->$value);
  }

  /**
   * @test
   * @expectedException Exception
   * @expectedExceptionMessage The fo property does not exist
   */
  public function request_fail_data_to_entity_object()
  {
    new Foo(['fo' => 'bar']);
  }

  /**
   * @test
   */
  public function request_data_to_entity_object_with_setter()
  {
    $foo = new Foo(['fake' => 'test', 'bar_bar' => 'bar']);

    $this->assertEquals('test', $foo->fake);
    $this->assertEquals('BAR', $foo->bar_bar);
  }

  /**
   * @return string[]
   */
  public function requestProvider(): array
  {
    return [
      ['foo',     'test'],
      ['bar',     'test2'],
      ['fooFoo',  'test3'],
    ];
  }

}
