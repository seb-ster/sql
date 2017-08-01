<?php
/**
 * SebSter Projection trait
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
trait ProjectionTrait
{
  private $projectionClause;

  /**
   * {@inheritdoc}
   */
  public function projection(SQL\Element\Expression $expression)
  {
    $arguments = func_get_args();

    $projectionClauseClass = new \ReflectionClass(SQL\Clause\ProjectionClause::class);
    $projectionClause = $projectionClauseClass->newInstanceArgs($arguments);

    $this->projectionClause = $projectionClause;

    return $this;
  }
}
