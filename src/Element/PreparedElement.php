<?php
/**
 * SebSter Prepared Element Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * PreparedElement Class
 */
class PreparedElement extends SQL\Element\AbstractElement implements SQL\Interfaces\PreparedElementInterface
{
  private $strings = [];
  private $parameters = [];

  /**
   * {@inheritDoc}
   */
  public function addParameter(SQL\Element\Expression $expression)
  {
    if (get_class($expression) == SQL\Element\Expression::class)
    {
      $placeholder = ':'.count($this->parameters);
      $this->parameters[$placeholder] = $expression->value;

      return $placeholder;
    }
    else
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of '.SQL\Element\Expression::class.', '.get_class($expression).' given.');
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getParameters()
  {
    return $this->parameters;
  }

  /**
   * {@inheritDoc}
   */
  public function addString($string)
  {
    if (is_string($string))
    {
      array_push($this->strings, $string);
    }
    else {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be a string, '.gettype($string).' given.');
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getString()
  {
    return implode('', $this->strings);
  }
}
