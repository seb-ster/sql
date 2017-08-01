<?php
/**
 * SebSter Logic Operation interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * LogicOperation interface.
 */
interface LogicOperationInterface extends PreparableInterface
{
  /**
   * Construct a Logic Operation where where the current instance is
   * combined with the ComparisonOperation arguments using AND logic.
   *
   * @return SQL\Operation\LogicOperation
   */
  public function andIs(SQL\Operation\ComparisonOperation $comparisonOperation);

  /**
   * Construct a Logic Operation where where the current instance is
   * combined with the ComparisonOperation arguments using OR logic.
   *
   * @return SQL\Operation\LogicOperation
   */
  public function orIs(SQL\Operation\ComparisonOperation $comparisonOperation);
}
