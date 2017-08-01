<?php
/**
 * SebSter LessThen Operation Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * LessThenOperation Class
 */
class LessThenOperation extends SQL\Operation\ComparisonOperation
{
  public function __construct(SQL\Element\Expression $leftExpression, SQL\Element\Expression $rightExpression)
  {
    parent::__construct(' < ', $leftExpression, $rightExpression);
  }
}
