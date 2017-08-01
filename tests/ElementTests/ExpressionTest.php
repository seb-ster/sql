<?php
namespace SebSter\SQL\Tests\ElementTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class ExpressionTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Element\Expression::__construct()
  */
  public function testEmptyInstantiation()
  {
    new SQL\Element\Expression();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\Expression::__construct() must be of type string, NULL, boolean or numeric
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = new \stdClass();
    new SQL\Element\Expression($invalidType);
  }

  public function testToString()
  {
    $stringType = 'a_string';
    $expression = new SQL\Element\Expression($stringType);
    $this->assertEquals('\'a_string\'',$expression->getString());
    $this->assertEquals('\'a_string\'',(string)$expression);

    $integerType = 123;
    $expression = new SQL\Element\Expression($integerType);
    $this->assertEquals('123',(string)$expression);

    $floatType = 99.9;
    $expression = new SQL\Element\Expression($floatType);
    $this->assertEquals('99.9',(string)$expression);

    $boolType = true;
    $expression = new SQL\Element\Expression($boolType);
    $this->assertEquals('1',(string)$expression);

    $nullType = NULL;
    $expression = new SQL\Element\Expression($nullType);
    $this->assertEquals('NULL',(string)$expression);
  }

  public function testPrepare()
  {
    $value = 'a_string';
    $expression = new SQL\Element\Expression($value);
    $preparedExpression = $expression->prepare();

    $this->assertEquals(SQL\Element\PreparedElement::class, get_class($preparedExpression));
    $this->assertEquals(':0',(string)$preparedExpression);
    $this->assertEquals([':0' => $value], $preparedExpression->getParameters());
  }

  public function testComparisonOperations()
  {
    $leftValue = 1;
    $rightValue = 1;
    $leftExpression = new SQL\Element\Expression($leftValue);
    $rightExpression = new SQL\Element\Expression($rightValue);
    $leftIdentifier = new SQL\Element\Identifier('left');
    $rightIdentifier = new SQL\Element\Identifier('right');

    $comparisonOperation = $leftExpression->equalTo($rightExpression);
    $this->assertEquals(SQL\Operation\EqualToOperation::class, get_class($comparisonOperation));

    $comparisonOperation = $leftIdentifier->equalTo($rightIdentifier);
    $this->assertEquals(SQL\Operation\EqualToOperation::class, get_class($comparisonOperation));

    $comparisonOperation = $leftExpression->greaterThen($rightExpression);
    $this->assertEquals(SQL\Operation\GreaterThenOperation::class, get_class($comparisonOperation));

    $comparisonOperation = $leftExpression->lessThen($rightExpression);
    $this->assertEquals(SQL\Operation\LessThenOperation::class, get_class($comparisonOperation));
  }
}
