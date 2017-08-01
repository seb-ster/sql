<?php
namespace SebSter\SQL\Tests\ElementTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class IdentifierTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Element\Identifier::__construct()
  */
  public function testEmptyInstantiation()
  {
    new SQL\ELement\Identifier();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\Identifier::__construct() must be of type string.
  */
  public function testInstantiationWithInvalidType()
  {
    $invalidType = false;
    new SQL\Element\Identifier($invalidType);
  }

  public function testUnqualifiedInstantiation()
  {
    $name = 'a_field';
    new SQL\Element\Identifier($name);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Element\Identifier::__construct() must be an instance of SebSter\SQL\Element\Identifier
  */
  public function testInstantiationWithInvalidQualifierType()
  {
    $name = 'a_field';
    $invalidType = false;
    new SQL\Element\Identifier($name, $invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 2 passed to SebSter\SQL\Element\Identifier::__construct() must be unqualified
  */
  public function testQualifiedInstantiation()
  {
    $name = 'a_field';
    $table = new SQL\Element\Identifier('a_table');
    $qualifier = new SQL\Element\Identifier('qualifier', $table);

    new SQL\Element\Identifier($name, $qualifier);
  }

  public function testToString()
  {
    $name = 'a_field';
    $table = new SQL\Element\Identifier('a_table');

    $identifier = new SQL\Element\Identifier($name);
    $this->assertEquals('`'.$name.'`',(string)$identifier);

    $identifier = new SQL\Element\Identifier($name, $table);
    $this->assertEquals($table.'.`'.$name.'`',(string)$identifier);
  }

  public function testPrepare()
  {
    $name = 'a_field';
    $identifier = new SQL\Element\Identifier($name);
    $preparedIdentifier = $identifier->prepare();

    //identifiers cannot be stored in parameters
    $this->assertEquals('`'.$name.'`',(string)$preparedIdentifier);
    $this->assertEquals([], $preparedIdentifier->getParameters());
  }
}
