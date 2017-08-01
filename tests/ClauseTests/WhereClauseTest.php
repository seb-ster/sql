<?php
namespace SebSter\SQL\Tests\ClauseTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class WhereClauseTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\WhereClause::__construct() must be an instance of SebSter\SQL\Operation\AbstractOperation
  */
  public function testEmptyInstantiation()
  {
    new SQL\Clause\WhereClause();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\WhereClause::__construct() must be an instance of SebSter\SQL\Operation\AbstractOperation
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = true;

    new SQL\Clause\WhereClause($invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Clause\WhereClause::__construct() must be an instance of SebSter\SQL\Operation\AbstractOperation
  */
  public function testInstantiationSecondArgumentInvalidType()
  {
    $invalidType = true;
    $expression = new SQL\Element\Expression(1);
    $operation = new SQL\Operation\EqualToOperation($expression,$expression);

    new SQL\Clause\WhereClause($operation, $invalidType);
  }

  public function testToString()
  {
    $expression = new SQL\Element\Expression(1);
    $operation = new SQL\Operation\EqualToOperation($expression,$expression);

    //single operation
    $whereClause = new SQL\Clause\WhereClause($operation);
    $this->assertEquals('WHERE 1 = 1', $whereClause->getString());

    //multi operation
    $whereClause = new SQL\Clause\WhereClause($operation, $operation);
    $this->assertEquals('WHERE 1 = 1 AND 1 = 1', $whereClause->getString());
  }

  public function testPrepare()
  {
    $expression = new SQL\Element\Expression(1);
    $operation = new SQL\Operation\EqualToOperation($expression,$expression);

    //single field
    $whereClause = new SQL\Clause\WhereClause($operation);
    $preparedClause = $whereClause->prepare();

    $this->assertEquals('WHERE :0 = :1', $preparedClause->getString());
    $this->assertEquals([':0'=>1, ':1'=>1], $preparedClause->getParameters());

    //multi operation
    $whereClause = new SQL\Clause\WhereClause($operation, $operation);
    $preparedClause = $whereClause->prepare();

    $this->assertEquals('WHERE :0 = :1 AND :2 = :3', $preparedClause->getString());
    $this->assertEquals([':0'=>1, ':1'=>1, ':2'=>1, ':3'=>1], $preparedClause->getParameters());
  }
}
