<?php
/**
 * SebSter And Operation Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * AndOperation Class
 */
class AndOperation extends SQL\Operation\LogicOperation
{
  public function __construct(SQL\Operation\ComparisonOperation $comparisonOperation)
  {
    $arguments = func_get_args();

    array_unshift($arguments, ' AND ');

    call_user_func_array('parent::__construct', $arguments);
  }
}
