<?php
/**
 * SebSter Comparison Operation interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * ComparisonOperation interface.
 */
interface ComparisonOperationInterface extends PreparableInterface
{
  /**
   * Construct a Comparison Operation where the current instance is
   * compared to the Expression argument using an 'EqualTo' operator.
   *
   * @return SQL\Operation\ComparisonOperation
   */
  public function equalTo(SQL\Element\Expression $expression);

  /**
   * Construct a Comparison Operation where the current instance is
   * compared to the Expression argument using an 'Greater Then' operator.
   *
   * @return SQL\Operation\ComparisonOperation
   */
  public function greaterThen(SQL\Element\Expression $expression);

  /**
   * Construct a Comparison Operation where the current instance is
   * compared to the Expression argument using an 'Less Then' operator.
   *
   * @return SQL\Operation\ComparisonOperation
   */
  public function lessThen(SQL\Element\Expression $expression);
}
