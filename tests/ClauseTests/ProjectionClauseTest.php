<?php
namespace SebSter\SQL\Tests\ClauseTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class ProjectionClauseTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\ProjectionClause::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testEmptyInstantiation()
  {
    new SQL\Clause\ProjectionClause();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\ProjectionClause::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = true;

    new SQL\Clause\ProjectionClause($invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Clause\ProjectionClause::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationSecondArgumentInvalidType()
  {
    $invalidType = true;
    $identifier = new SQL\Element\Identifier('a_field');

    new SQL\Clause\ProjectionClause($identifier, $invalidType);
  }

  public function testToString()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $expression = new SQL\Element\Expression(1);

    //single field
    $projectionClause = new SQL\Clause\ProjectionClause($identifier);
    $this->assertEquals('`a_field`', $projectionClause->getString());

    //field and expression
    $projectionClause = new SQL\Clause\ProjectionClause($identifier, $expression);
    $this->assertEquals('`a_field`, 1', $projectionClause->getString());
  }

  public function testPrepare()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $expression = new SQL\Element\Expression(1);

    //single field
    $projectionClause = new SQL\Clause\ProjectionClause($identifier);
    $preparedClause = $projectionClause->prepare();

    $this->assertEquals('`a_field`', $preparedClause->getString());
    $this->assertEquals([], $preparedClause->getParameters());

    //field and expression
    $projectionClause = new SQL\Clause\ProjectionClause($identifier, $expression);
    $preparedClause = $projectionClause->prepare();

    $this->assertEquals('`a_field`, :0', $preparedClause->getString());
    $this->assertEquals([':0'=>1], $preparedClause->getParameters());
  }
}
