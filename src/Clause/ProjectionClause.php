<?php
/**
 * SebSter Projection Clause Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Clause;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * ProjectionClause Class
 */
class ProjectionClause extends SQL\Clause\AbstractClause
{
  public function __construct(SQL\Element\Expression $expression)
  {
    $arguments = func_get_args();

    foreach ($arguments as $idx => $expression)
    {
      if(!($expression instanceof SQL\Element\Expression))
      {
        throw new SQL\Exception\InvalidArgumentException('Argument '.($idx+1).' passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of '.SQL\Element\Expression::class.'. Got '.gettype($expression));
      }
    }

    $parentArguments = ['',', ',''];
    $parentArguments = array_merge($parentArguments, $arguments);

    call_user_func_array('parent::__construct', $parentArguments);
  }
}
