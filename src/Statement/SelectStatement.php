<?php
/**
 * SebSter Select Statement Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Statement;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * SelectStatement Class
 */
class SelectStatement extends SQL\Statement\AbstractStatement implements SQL\Interfaces\SelectStatementInterface
{
  use SQL\Clause\ProjectionTrait;
  use SQL\Clause\FromTrait;
  use SQL\Clause\WhereTrait;

  public function __construct()
  {
    $this->glue = ' ';
  }

  /**
   * {@inheritdoc}
   */
  public function getString()
  {
    $stringParts[] = 'SELECT';

    if (isset($this->projectionClause))
    {
      $stringParts[] = $this->projectionClause->getString();
    }
    else
    {
      $stringParts[] = '*';
    }

    if (isset($this->fromClause))
    {
      $stringParts[] = $this->fromClause->getString();
    }

    if (isset($this->whereClause))
    {
      $stringParts[] = $this->whereClause->getString();
    }

    $string = implode(' ', $stringParts);
    return $string.';';
  }

  /**
   * {@inheritdoc}
   */
  public function prepare(SQL\Element\PreparedElement $preparedElement = NULL)
  {
    //prepare on a statement will always start a empty PreparedElement
    $preparedElement = new SQL\Element\PreparedElement();

    $preparedElement->addString('SELECT ');

    if (isset($this->projectionClause))
    {
      $preparedElement = $this->projectionClause->prepare($preparedElement);
    }
    else
    {
      $preparedElement->addString('*');      
    }

    if (isset($this->fromClause))
    {
      $preparedElement->addString(' ');
      $preparedElement = $this->fromClause->prepare($preparedElement);
    }

    if (isset($this->whereClause))
    {
      $preparedElement->addString(' ');
      $preparedElement = $this->whereClause->prepare($preparedElement);
    }

    $preparedElement->addString(';');

    return $preparedElement;
  }
}
