<?php
/**
 * SebSter Or Operation Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * OrOperation Class
 */
class OrOperation extends SQL\Operation\LogicOperation
{
  public function __construct(SQL\Operation\ComparisonOperation $comparisonOperation)
  {
    $arguments = func_get_args();

    array_unshift($arguments, ' OR ');

    call_user_func_array('parent::__construct', $arguments);
  }
}
