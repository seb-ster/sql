<?php
namespace SebSter\SQL\Tests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class AndOperationTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\AndOperation::__construct() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testEmptyInstantiation()
  {
    new SQL\Operation\AndOperation();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\AndOperation::__construct() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testInstantiationInvalidType()
  {
    $invalidType = false;

    new SQL\Operation\AndOperation($invalidType);
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

    new SQL\Operation\AndOperation($comparisonOperation, $invalidType);
  }

  public function testGetString()
  {
    $operator = ' = ';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression, $expression);

    $andOperation = new SQL\Operation\AndOperation($comparisonOperation, $comparisonOperation);

    $this->assertEquals('(1 = 1 AND 1 = 1)',$andOperation->getString());
  }

  public function testPrepare()
  {
    $operator = ' = ';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression, $expression);
    $andOperation = new SQL\Operation\AndOperation($comparisonOperation, $comparisonOperation);

    $preparedElement = $andOperation->prepare();

    $this->assertEquals('(:0 = :1 AND :2 = :3)',$preparedElement->getString());
    $this->assertEquals([':0'=>1, ':1'=>1, ':2'=>1, ':3'=>1],$preparedElement->getParameters());
  }
}
