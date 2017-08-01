<?php
namespace SebSter\SQL\Tests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class SelectStatementTest extends \PHPUnit_Framework_TestCase
{
  public function testInstantiation()
  {
    $select = new SQL\Statement\SelectStatement();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Statement\SelectStatement::projection() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testEmptyProjection()
  {
    $select = new SQL\Statement\SelectStatement();

    $select = $select->projection();
  }

  public function testProjectionToString()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $select = new SQL\Statement\SelectStatement();

    $this->assertEquals('SELECT *;', (string)$select);

    $select = $select->projection($identifier);
    $this->assertInstanceOf(SQL\Statement\SelectStatement::class, $select);
    $this->assertEquals('SELECT `a_field`;', (string)$select);
  }

  public function testProjectionPrepare()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $select = new SQL\Statement\SelectStatement();
    $select = $select->projection($identifier);
    $preparedElement = $select->prepare();

    $this->assertInstanceOf(SQL\Element\PreparedElement::class, $preparedElement);
    $this->assertEquals('SELECT `a_field`;', (string)$preparedElement);
    $this->assertEquals([], $preparedElement->getParameters());
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Statement\SelectStatement::from()
  */
  public function testEmptyFrom()
  {
    $select = new SQL\Statement\SelectStatement();

    $select = $select->from();
  }

  public function testFromToString()
  {
    $identifier = new SQL\Element\Identifier('a_table');
    $select = new SQL\Statement\SelectStatement();

    $select = $select->from($identifier);
    $this->assertInstanceOf(SQL\Statement\SelectStatement::class, $select);
    $this->assertEquals('SELECT * FROM `a_table`;', (string)$select);
  }

  public function testFromPrepare()
  {
    $identifier = new SQL\Element\Identifier('a_table');
    $select = new SQL\Statement\SelectStatement();
    $select = $select->from($identifier);
    $preparedElement = $select->prepare();

    $this->assertInstanceOf(SQL\Element\PreparedElement::class, $preparedElement);
    $this->assertEquals('SELECT * FROM `a_table`;', (string)$preparedElement);
    $this->assertEquals([], $preparedElement->getParameters());
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Statement\SelectStatement::where() must be an instance of SebSter\SQL\Operation\AbstractOperation,
  */
  public function testEmptyWhere()
  {
    $select = new SQL\Statement\SelectStatement();

    $select = $select->where();
  }

  public function testWhereToString()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $select = new SQL\Statement\SelectStatement();

    $select = $select->where($identifier->equalTo($identifier));
    $this->assertInstanceOf(SQL\Statement\SelectStatement::class, $select);
    $this->assertEquals('SELECT * WHERE `a_field` = `a_field`;', (string)$select);

    $select = $select->where($identifier->equalTo($identifier), $identifier->equalTo($identifier));
    $this->assertEquals('SELECT * WHERE `a_field` = `a_field` AND `a_field` = `a_field`;', (string)$select);

    $select = $select->where($identifier->equalTo($identifier)->orIs($identifier->equalTo($identifier)));
    $this->assertEquals('SELECT * WHERE (`a_field` = `a_field` OR `a_field` = `a_field`);', (string)$select);
  }

  public function testWherePrepare()
  {
    $identifier = new SQL\Element\Identifier('a_field');
    $select = new SQL\Statement\SelectStatement();
    $select = $select->where($identifier->equalTo($identifier));
    $preparedElement = $select->prepare();

    $this->assertInstanceOf(SQL\Element\PreparedElement::class, $preparedElement);
    $this->assertEquals('SELECT * WHERE `a_field` = `a_field`;', (string)$preparedElement);
    $this->assertEquals([], $preparedElement->getParameters());
  }

  public function testMultiClauseSequence()
  {
    $identifier = new SQL\Element\Identifier('identifier');
    $expression = new SQL\Element\Expression(123);
    $select = new SQL\Statement\SelectStatement();
    $select = $select->where($identifier->equalTo($expression));
    $select = $select->from($identifier);
    $preparedElement = $select->prepare();

    $this->assertEquals('SELECT * FROM `identifier` WHERE `identifier` = 123;', (string)$select);
    $this->assertInstanceOf(SQL\Element\PreparedElement::class, $preparedElement);
    $this->assertEquals('SELECT * FROM `identifier` WHERE `identifier` = :0;', (string)$preparedElement);
    $this->assertEquals([':0'=>123], $preparedElement->getParameters());
  }
}
