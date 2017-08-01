<?php
namespace SebSter\SQL\Tests\OperationTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class GreaterThenOperationTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\GreaterThenOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testEmptyInstantiation()
  {
    new SQL\Operation\GreaterThenOperation();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\GreaterThenOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    new SQL\Operation\GreaterThenOperation($invalidType);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\GreaterThenOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithoutRightExpression()
  {
    $left = new SQL\Element\Expression(1);
    new SQL\Operation\GreaterThenOperation($left);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\GreaterThenOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidRightType()
  {
    $invalidType = false;
    $left = new SQL\Element\Expression(1);
    new SQL\Operation\GreaterThenOperation($left, $invalidType);
  }

  public function testToString()
  {
    $left = new SQL\Element\Expression(2);
    $right = new SQL\Element\Expression(1);
    $twoGreaterThenOne = new SQL\Operation\GreaterThenOperation($left, $right);

    $this->assertEquals('2 > 1', (string)$twoGreaterThenOne);
  }
}
