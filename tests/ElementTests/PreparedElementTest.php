<?php
namespace SebSter\SQL\Tests\ElementTests;

use SebSter\SQL;
require __dir__.'\..\..\vendor\autoload.php';

class PreparedElementTest extends \PHPUnit_Framework_TestCase
{
  public function testInstantiation()
  {
    new SQL\Element\PreparedElement();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\PreparedElement::addParameter() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testAddParameterWithoutArgument()
  {
    $preparedElement = new SQL\Element\PreparedElement();

    $preparedElement->addParameter();
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\PreparedElement::addParameter() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testAddParameterWithInvalidArgumentType()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $invalidType = false;

    $preparedElement->addParameter($invalidType);
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\PreparedElement::addParameter() must be an instance of SebSter\SQL\Element\Expression
  */
  public function testAddParameterWithSubClassArgument()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $subClass = new SQL\Element\Identifier('subclass');

    $preparedElement->addParameter($subClass);
  }

  public function testAddParameter()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $expression = new SQL\Element\Expression('a Expression');

    $preparedElement->addParameter($expression);
  }

  /**
  * @expectedException PHPUnit_Framework_Error
  * @expectedExceptionMessage Missing argument 1 for SebSter\SQL\Element\PreparedElement::addString()
  */
  public function testAddStringWithoutArgument()
  {
    $preparedElement = new SQL\Element\PreparedElement();

    $preparedElement->addString();
  }

  /**
  * @expectedException SebSter\SQL\Exception\InvalidArgumentException
  * @expectedExceptionMessage Argument 1 passed to SebSter\SQL\Element\PreparedElement::addString() must be a string
  */
  public function testAddStringWithInvalidArgumentType()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $invalidType = false;

    $preparedElement->addString($invalidType);
  }

  public function testAddString()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $string = 'a string';

    $preparedElement->addString($string);
  }

  public function testGetString()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $string = 'a string';
    $preparedElement->addString($string);

    $this->assertEquals($string, $preparedElement->getString());
  }

  public function testGetParameters()
  {
    $preparedElement = new SQL\Element\PreparedElement();
    $expression0 = new SQL\Element\Expression(NULL);
    $expression1 = new SQL\Element\Expression('first');
    $expression2 = new SQL\Element\Expression(2);
    $expression3 = new SQL\Element\Expression(true);

    $placeholder0 = $preparedElement->addParameter($expression0);
    $this->assertEquals(':0', $placeholder0);

    $placeholder1 = $preparedElement->addParameter($expression1);
    $this->assertEquals(':1', $placeholder1);

    $placeholder2 = $preparedElement->addParameter($expression2);
    $this->assertEquals(':2', $placeholder2);

    $placeholder3 = $preparedElement->addParameter($expression3);
    $this->assertEquals(':3', $placeholder3);

    $expectedArray = [];
    $expectedArray[$placeholder0] = $expression0->value;
    $expectedArray[$placeholder1] = $expression1->value;
    $expectedArray[$placeholder2] = $expression2->value;
    $expectedArray[$placeholder3] = $expression3->value;

    $this->assertEquals($expectedArray, $preparedElement->getParameters());
  }
}
