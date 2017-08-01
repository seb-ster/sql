<?php
/**
 * SebSter From trait
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Clause;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 *
 */
trait FromTrait
{
  private $fromClause;

  /**
   * {@inheritdoc}
   */
  public function from($identifierOrAlias)
  {
    $arguments = func_get_args();

    $fromClauseClass = new \ReflectionClass(SQL\Clause\FromClause::class);
    $fromClause = $fromClauseClass->newInstanceArgs($arguments);

    $this->fromClause = $fromClause;

    return $this;
  }
}
