<?php
/**
 * SebSter Expression Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * Expression Class
 */
class Expression extends SQL\Element\AbstractPreparable implements SQL\Interfaces\ExpressionInterface
{
  use SQL\Operation\ComparisonTrait;

  public $value;

  public function __construct($scalar)
  {
    if (is_string($scalar))
    {
      $this->value = $scalar;
    }
    else if (is_null($scalar))
    {
      $this->value = $scalar;
    }
    else if (is_bool($scalar))
    {
      $this->value = $scalar;
    }
    else if (is_numeric($scalar))
    {
      $this->value = $scalar;
    }
    else
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string, NULL, boolean or numeric. Got '.gettype($scalar));
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getString()
  {
    $string = '';

    if (is_string($this->value))
    {
      $string = "'".$this->value."'";
    }
    else if (is_null($this->value))
    {
      $string = "NULL";
    }
    else if (is_bool($this->value))
    {
      $string = $this->value?'1':'0';
    }
    else if (is_numeric($this->value))
    {
      $string = (string)$this->value;
    }

    return $string;
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

    $placeholder = $preparedElement->addParameter($this);
    $preparedElement->addString($placeholder);

    return $preparedElement;
  }
}
