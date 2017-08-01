<?php
/**
 * SebSter Logic Operation Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * LogicOperation Class
 */
class LogicOperation extends SQL\Operation\AbstractOperation
{
  public function __construct($operator, SQL\Operation\ComparisonOperation $comparisonOperation)
  {
    $arguments = func_get_args();
    $operator = array_shift($arguments);

    if (!is_string($operator))
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($operator));
    }

    foreach ($arguments as $idx => $comparisonOperation)
    {
      if(!($comparisonOperation instanceof SQL\Operation\ComparisonOperation))
      {
        throw new SQL\Exception\InvalidArgumentException('Argument '.($idx+2).' passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of '.SQL\Operation\ComparisonOperation::class.'. Got '.gettype($comparisonOperation));
      }
    }

    $parentArguments[] = '(';
    $parentArguments[] = $operator;
    $parentArguments[] = ')';
    $parentArguments = array_merge($parentArguments, $arguments);

    call_user_func_array('parent::__construct', $parentArguments);
  }
}
