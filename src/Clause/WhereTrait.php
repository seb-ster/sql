<?php
/**
 * SebSter Where trait
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
trait WhereTrait
{

  private $whereClause;

  /**
   * {@inheritdoc}
   */
  public function where(SQL\Operation\AbstractOperation $operation)
  {
    $arguments = func_get_args();

    $whereClauseClass = new \ReflectionClass(SQL\Clause\WhereClause::class);
    $whereClause = $whereClauseClass->newInstanceArgs($arguments);

    $this->whereClause = $whereClause;

    return $this;
  }
}
