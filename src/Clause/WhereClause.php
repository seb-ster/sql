<?php
/**
 * SebSter Where Clause Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Clause;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * WhereClause Class
 */
class WhereClause extends SQL\Clause\AbstractClause
{
  public function __construct(SQL\Operation\AbstractOperation $operation)
  {
    $arguments = func_get_args();

    foreach ($arguments as $idx => $operation)
    {
      if(!($operation instanceof SQL\Operation\AbstractOperation))
      {
        throw new SQL\Exception\InvalidArgumentException('Argument '.($idx+1).' passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of '.SQL\Operation\AbstractOperation::class.'. Got '.gettype($operation));
      }
    }

    $parentArguments = ['WHERE ',' AND ',''];
    $parentArguments = array_merge($parentArguments, $arguments);

    call_user_func_array('parent::__construct', $parentArguments);
  }
}
