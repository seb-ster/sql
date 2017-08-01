<?php
/**
 * SebSter Comparison trait
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 *
 */
trait ComparisonTrait
{
  /**
   * {@inheritDoc}
   */
  public function equalTo(SQL\Element\Expression $expression)
  {
    $comparisonOperation = new SQL\Operation\EqualToOperation($this, $expression);
    return $comparisonOperation;
  }

  /**
   * {@inheritDoc}
   */
  public function lessThen(SQL\Element\Expression $expression)
  {
    $comparisonOperation = new SQL\Operation\LessThenOperation($this, $expression);
    return $comparisonOperation;
  }

  /**
   * {@inheritDoc}
   */
  public function greaterThen(SQL\Element\Expression $expression)
  {
    $comparisonOperation = new SQL\Operation\GreaterThenOperation($this, $expression);
    return $comparisonOperation;
  }
}
