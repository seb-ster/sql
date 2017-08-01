<?php
/**
 * SebSter Identifier interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * IdentifierInterface
 */
interface IdentifierInterface extends ExpressionInterface
{
  /**
   * Return true if this identifier has a qualifier
   *
   * @return boolean
   */
  public function isQualified();
}
