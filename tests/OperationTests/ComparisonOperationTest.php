<?php
namespace SebSter\SQL\Tests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class ComparisonOperationTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Operation\ComparisonOperation::__construct()
  */
  public function testEmptyInstantiation()
  {
    new SQL\Operation\ComparisonOperation();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\ComparisonOperation::__construct() must be of type string.
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    $expression = new SQL\Element\Expression(1);

    new SQL\Operation\ComparisonOperation($invalidType, $expression);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\ComparisonOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithoutExpression()
  {
    $operator = '=';

    new SQL\Operation\ComparisonOperation($operator);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Operation\ComparisonOperation::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidTypeExpression()
  {
    $operator = '=';
    $invalidType = false;

    new SQL\Operation\ComparisonOperation($operator, $invalidType);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\ComparisonOperation::andIs() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testEmptyAndIs()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);

    $comparisonOperation->andIs();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\ComparisonOperation::orIs() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testEmptyOrIs()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);

    $comparisonOperation->orIs();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\ComparisonOperation::andIs() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testAndIsWithInvalidType()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);
    $invalidType = false;

    $comparisonOperation->andIs($invalidType);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Operation\ComparisonOperation::orIs() must be an instance of SebSter\SQL\Operation\ComparisonOperation
  */
  public function testOrIsWithInvalidType()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);
    $invalidType = false;

    $comparisonOperation->orIs($invalidType);
  }

  public function testAndIs()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);

    $andOperation = $comparisonOperation->andIs($comparisonOperation);
    $this->assertInstanceOf(SQL\Operation\AndOperation::class, $andOperation);

    $andOperation = $comparisonOperation->andIs($comparisonOperation, $comparisonOperation);
    $this->assertInstanceOf(SQL\Operation\AndOperation::class, $andOperation);
  }

  public function testOrIs()
  {
    $operator = '=';
    $expression = new SQL\Element\Expression(1);
    $comparisonOperation = new SQL\Operation\ComparisonOperation($operator, $expression);

    $orOperation = $comparisonOperation->orIs($comparisonOperation);
    $this->assertInstanceOf(SQL\Operation\OrOperation::class, $orOperation);

    $orOperation = $comparisonOperation->orIs($comparisonOperation, $comparisonOperation);
    $this->assertInstanceOf(SQL\Operation\OrOperation::class, $orOperation);
  }
}
