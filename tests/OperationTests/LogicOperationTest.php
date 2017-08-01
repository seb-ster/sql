<?php
namespace SebSter\SQL\Tests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class LogicOperationTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Operation\LogicOperation::__construct()
  */
  public function testEmptyInstantiation()
  {
    new SQL\Operation\LogicOperation();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\LogicOperation::__construct() must be of type string.
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation('=', $expression);

    new SQL\Operation\LogicOperation($invalidType, $comparisonOperation);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\LogicOperation::__construct() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testInstantiationWithoutComparisonOperation()
  {
    $operator = '=';

    new SQL\Operation\LogicOperation($operator);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\LogicOperation::__construct() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testInstantiationWithInvalidTypeComparisonOperation()
  {
    $operator = '=';
    $invalidType = false;

    new SQL\Operation\LogicOperation($operator, $invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 3 passed to SebSter\SQL\Operation\LogicOperation::__construct() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testInstantiationWithSecondComparisonOperationInvalidType()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);
    $invalidType = false;

    new SQL\Operation\LogicOperation($operator, $comparisonOperation, $invalidType);
  }
}
