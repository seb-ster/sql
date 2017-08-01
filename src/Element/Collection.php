<?php
/**
 * SebSter Collection Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * Collection Class
 */
class Collection extends SQL\Element\Expression
{
  protected $prefix;
  protected $glue;
  protected $postfix;
  public $value = [];

  public function __construct($prefix, $glue, $postfix, Expression $expression)
  {
    $args = func_get_args();

    $prefix = array_shift($args);
    if (!is_string($prefix))
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($prefix));
    }
    $this->prefix = $prefix;

    $glue = array_shift($args);
    if (!is_string($glue))
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 2 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($glue));
    }
    $this->glue = $glue;

    $postfix = array_shift($args);
    if (!is_string($postfix))
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 3 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($postfix));
    }
    $this->postfix = $postfix;

    foreach ($args as $idx => $expression)
    {
      if(!($expression instanceof SQL\Element\Expression))
      {
        throw new SQL\Exception\InvalidArgumentException('Argument '.($idx+4).' passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of SebSter\SQL\Element\Expression. Got '.gettype($expression));
      }
      $this->value[] = $expression;
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getString()
  {
    $stringParts[] = $this->prefix;

    $idx = 0;
    foreach ($this->value as $element)
    {
      if ($idx++ > 0)
      {
        $stringParts[] = $this->glue;
      }

      //use type casting to allow for string type elements
      $stringParts[] = (string)$element;
    }

    $stringParts[] = $this->postfix;

    //remove empty strings
    $stringParts = array_filter($stringParts);

    return implode('',$stringParts);
  }

  /**
   * {@inheritDoc}
   */
  public function prepare(SQL\Element\PreparedElement $preparedElement = NULL)
  {
    if (is_null($preparedElement))
    {
      $preparedElement = new SQL\Element\PreparedElement();
    }

    if (strlen($this->prefix))
    {
      $preparedElement->addString($this->prefix);
    }

    $idx = 0;
    foreach ($this->value as $expression)
    {
      if ($idx++ > 0)
      {
        $preparedElement->addString($this->glue);
      }

      $preparedElement = $expression->prepare($preparedElement);
    }

    if (strlen($this->postfix))
    {
      $preparedElement->addString($this->postfix);
    }

    return $preparedElement;
  }
}
