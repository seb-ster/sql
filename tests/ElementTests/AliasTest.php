<?php
namespace SebSter\SQL\Tests\ElementTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class AliasTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\Alias::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testEmptyInstantiation()
  {
    new SQL\Element\Alias();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\Alias::__construct() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    new SQL\Element\Alias($invalidType);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Element\Alias::__construct() must be an instance of SebSter\SQL\Element\Identifier
  */
  public function testInstantiationWithMissingAlias()
  {
    $expression = new SQL\Element\Expression('a_string');
    new SQL\Element\Alias($expression);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Element\Alias::__construct() must be an instance of SebSter\SQL\Element\Identifier
  */
  public function testInstantiationWithInvalidAliasType()
  {
    $invalidType = false;
    $expression = new SQL\Element\Expression('a_string');
    new SQL\Element\Alias($expression, $invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Only unqualified Identifiers may be used as alias
  */
  public function testInstantiationWithQualifiedAliasType()
  {
    $invalidType = false;
    $expression = new SQL\Element\Expression('a_string');
    $table = new SQL\Element\Identifier('a_table');
    $field = new SQL\Element\Identifier('a_field', $table);
    new SQL\Element\Alias($expression, $field);

  }

  public function testToString()
  {
    $prefix = '(';
    $glue = ', ';
    $postfix = ')';
    $expression = new SQL\Element\Expression(123);
    $identifier = new SQL\Element\Identifier('identifier');
    $collection = new SQL\Element\Collection($prefix, $glue, $postfix, $expression, $expression);

    $alias = new SQL\Element\Alias($identifier, $identifier);
    $this->assertEquals('`identifier` AS `identifier`', (string)$alias);

    $alias = new SQL\Element\Alias($expression, $identifier);
    $this->assertEquals('123 AS `identifier`', (string)$alias);

    $alias = new SQL\Element\Alias($collection, $identifier);
    $this->assertEquals('(123, 123) AS `identifier`', (string)$alias);
  }

  public function testPrepare()
  {
    $expression = new SQL\Element\Expression(123);
    $field = new SQL\Element\Identifier('alias');
    $alias = new SQL\Element\Alias($expression, $field);
    $preparedAlias = $alias->prepare();

    $this->assertEquals(':0 AS `alias`',(string)$preparedAlias);
    $this->assertEquals([':0'=>123], $preparedAlias->getParameters());
  }
}
