<?php
/**
 * SebSter Identifier Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * Identifier Class
 */
class Identifier extends SQL\Element\Collection implements SQL\Interfaces\IdentifierInterface
{
  private $name;
  private $qualifier;

  public function __construct($name, Identifier $qualifier = NULL)
  {
    if (is_string($name))
    {
      $this->name = $name;
    }
    else
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($name));
    }

    if (!is_null($qualifier))
    {
      if ($qualifier->isQualified())
      {
        throw new SQL\Exception\InvalidArgumentException('Argument 2 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be unqualified');
      }
      else
      {
        $this->qualifier = $qualifier;
      }
    }
  }

  public function isQualified()
  {
    return isset($this->qualifier);
  }

  /**
   * {@inheritDoc}
   */
   public function getString()
   {
     if ($this->isQualified())
     {
       $stringParts[] = $this->qualifier->getString();
     }

     $stringParts[] = "`".$this->name."`";

     $string = implode('.', $stringParts);

     return $string;
   }

  /**
   * {@inheritDoc}
   */
  public function prepare(SQL\Element\PreparedElement $preparedElement = NULL)
  {
    if (is_null($preparedElement))
    {
      $preparedElement = new SQL\Element\PreparedElement($preparedElement);
    }

    $preparedElement->addString($this->getString());

    return $preparedElement;
  }
}
