<?php
namespace SebSter\SQL\Tests\OperationTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class EqualToOperationTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\EqualToOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testEmptyInstantiation()
  {
    new SQL\Operation\EqualToOperation();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\EqualToOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    new SQL\Operation\EqualToOperation($invalidType);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\EqualToOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithoutRightExpression()
  {
    $left = new SQL\Element\Expression(1);
    new SQL\Operation\EqualToOperation($left);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\EqualToOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidRightType()
  {
    $invalidType = false;
    $left = new SQL\Element\Expression(1);
    new SQL\Operation\EqualToOperation($left, $invalidType);
  }

  public function testToString()
  {
    $left = new SQL\Element\Expression(1);
    $right = new SQL\Element\Expression(1);
    $oneEqualsOne = new SQL\Operation\EqualToOperation($left, $right);

    $this->assertEquals('1 = 1', (string)$oneEqualsOne);
  }
}
