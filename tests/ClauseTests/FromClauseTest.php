<?php
namespace SebSter\SQL\Tests\ClauseTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class FromClauseTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\FromClause::__construct() must be an instance of SebSter\SQL\Element\Collection
  */
  public function testEmptyInstantiation()
  {
    new SQL\Clause\FromClause();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Clause\FromClause::__construct() must be an instance of SebSter\SQL\Element\Collection
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = true;

    new SQL\Clause\FromClause($invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Clause\FromClause::__construct() must be an instance of SebSter\SQL\Element\Identifier or SebSter\SQL\Element\Alias
  */
  public function testInstantiationSecondArgumentInvalidType()
  {
    $invalidType = true;
    $identifier = new SQL\Element\Identifier('a_table');

    new SQL\Clause\FromClause($identifier, $invalidType);
  }

  public function testToString()
  {
    $identifier = new SQL\Element\Identifier('ident');
    $qualifier = new SQL\Element\Identifier('db');
    $qualifiedIdentifier = new SQL\Element\Identifier('table', $qualifier);
    $alias = new SQL\Element\Alias($qualifiedIdentifier, $identifier);

    //single field
    $fromClause = new SQL\Clause\FromClause($identifier);
    $this->assertEquals('FROM `ident`', $fromClause->getString());

    //multi field and qualified
    $fromClause = new SQL\Clause\FromClause($identifier, $qualifiedIdentifier);
    $this->assertEquals('FROM `ident`, `db`.`table`', $fromClause->getString());

    //alias
    $fromClause = new SQL\Clause\FromClause($alias);
    $this->assertEquals('FROM `db`.`table` AS `ident`', $fromClause->getString());
  }

  public function testPrepare()
  {
    $identifier = new SQL\Element\Identifier('ident');
    $qualifier = new SQL\Element\Identifier('db');
    $qualifiedIdentifier = new SQL\Element\Identifier('table', $qualifier);
    $alias = new SQL\Element\Alias($qualifiedIdentifier, $identifier);

    //single field
    $fromClause = new SQL\Clause\FromClause($identifier);
    $preparedClause = $fromClause->prepare();

    $this->assertEquals('FROM `ident`', $preparedClause->getString());
    $this->assertEquals([], $preparedClause->getParameters());

    //multi field and qualified
    $fromClause = new SQL\Clause\FromClause($identifier, $qualifiedIdentifier);
    $preparedClause = $fromClause->prepare();

    $this->assertEquals('FROM `ident`, `db`.`table`', $preparedClause->getString());
    $this->assertEquals([], $preparedClause->getParameters());

    //alias
    $fromClause = new SQL\Clause\FromClause($alias);
    $preparedClause = $fromClause->prepare();

    $this->assertEquals('FROM `db`.`table` AS `ident`', $preparedClause->getString());
    $this->assertEquals([], $preparedClause->getParameters());
  }
}
