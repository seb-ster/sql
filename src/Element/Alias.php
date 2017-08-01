<?php
/**
 * SebSter Alias Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * Alias Class
 */
class Alias extends SQL\Element\Collection
{
  const EXPRESSION_IDX = 0;
  const IDENTIFIER_IDX = 1;

  public function __construct(Expression $expression, Identifier $identifier)
  {
    $this->prefix = '';
    $this->glue = ' AS ';
    $this->postfix = '';

    if ($identifier->isQualified())
    {
      throw new SQL\Exception\InvalidArgumentException('Only unqualified Identifiers may be used as alias');
    }

    $this->value[self::EXPRESSION_IDX] = $expression;
    $this->value[self::IDENTIFIER_IDX] = $identifier;
  }
}
