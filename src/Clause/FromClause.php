<?php
/**
 * SebSter From Clause Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Clause;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * FromClause Class
 */
class FromClause extends SQL\Clause\AbstractClause
{
  public function __construct(SQL\Element\Collection $identifierOrAlias)
  {
    $arguments = func_get_args();

    foreach ($arguments as $idx => $identifierOrAlias)
    {
      if(!($identifierOrAlias instanceof SQL\Element\Identifier || $identifierOrAlias instanceof SQL\Element\Alias))
      {
        throw new SQL\Exception\InvalidArgumentException('Argument '.($idx+1).' passed to '.__CLASS__.'::'.__FUNCTION__.'() must be an instance of '.SQL\Element\Identifier::class.' or '.SQL\Element\Alias::class.'. Got '.gettype($identifierOrAlias));
      }
    }

    $parentArguments = ['FROM ',', ',''];
    $parentArguments = array_merge($parentArguments, $arguments);

    call_user_func_array('parent::__construct', $parentArguments);
  }
}
