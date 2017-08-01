<?php
namespace SebSter\SQL\Tests\ElementTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class CollectionTest extends \PHPUnit_Framework_TestCase
{

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Element\Collection::__construct()
  */
  public function testEmptyInstantiation()
  {
    new SQL\Element\Collection();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\Collection::__construct() must be of type string
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = true;
    $glue = ',';
    $postfix = ')';
    $expression = new SQL\Element\Expression(1);

    new SQL\Element\Collection($invalidType, $glue, $postfix, $expression);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Element\Collection::__construct() must be of type string
  */
  public function testInstantiationSecondArgumentInvalidType()
  {
    $prefix = '(';
    $invalidType = true;
    $postfix = ')';
    $expression = new SQL\Element\Expression(1);

    new SQL\Element\Collection($prefix, $invalidType, $postfix, $expression);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 3 passed to SebSter\SQL\Element\Collection::__construct() must be of type string
  */
  public function testInstantiationThirdArgumentInvalidType()
  {
    $prefix = '(';
    $glue = ',';
    $invalidType = false;
    $expression = new SQL\Element\Expression(1);

    new SQL\Element\Collection($prefix, $glue, $invalidType, $expression);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 4 passed to SebSter\SQL\Element\Collection::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationFourthArgumentInvalidType()
  {
    $prefix = '(';
    $glue = ',';
    $postfix = ')';
    $invalidType = false;

    new SQL\Element\Collection($prefix, $glue, $postfix, $invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 5 passed to SebSter\SQL\Element\Collection::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationFifthArgumentInvalidType()
  {
    $prefix = '(';
    $glue = ',';
    $postfix = ')';
    $expression = new SQL\Element\Expression(1);
    $invalidType = false;

    new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $invalidType);
  }

  public function testToString()
  {
    $prefix = '(';
    $glue = ', ';
    $postfix = ')';
    $expression = new SQL\Element\Expression(1);
    $identifier = new SQL\Element\Identifier('field');

    //one element
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $identifier);
    $this->assertEquals('(`field`)', (string)$collection);

    //multiple elements
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $identifier);
    $this->assertEquals('(1, `field`)', (string)$collection);

    //nested Collection
    $nestedCollection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $identifier);
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $identifier, $nestedCollection);
    $this->assertEquals('(`field`, (1, `field`))', (string)$collection);
  }

  public function testPrepare()
  {
    $prefix = '(';
    $glue = ', ';
    $postfix = ')';
    $expression = new SQL\Element\Expression(1);
    $identifier = new SQL\Element\Identifier('field');

    //one element
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression);
    $preparedCollection = $collection->prepare();
    $this->assertEquals('(:0)', (string)$preparedCollection);
    $this->assertEquals([':0'=>1], $preparedCollection->getParameters());

    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $identifier);
    $preparedCollection = $collection->prepare();
    $this->assertEquals('(`field`)', (string)$preparedCollection);
    $this->assertEquals([], $preparedCollection->getParameters());

    //multiple elements
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $identifier);
    $preparedCollection = $collection->prepare();
    $this->assertEquals('(:0, `field`)', (string)$preparedCollection);
    $this->assertEquals([':0'=>1], $preparedCollection->getParameters());

    //nested Collection
    $nestedCollection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $identifier);
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $identifier, $nestedCollection);
    $preparedCollection = $collection->prepare();
    $this->assertEquals('(`field`, (:0, `field`))', (string)$preparedCollection);
    $this->assertEquals([':0'=>1], $preparedCollection->getParameters());
  }
}
