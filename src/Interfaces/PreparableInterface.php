<?php
/**
 * SebSter Preparable interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * Preparable interface.
 */
interface PreparableInterface extends ElementInterface
{
  /**
   * Replace user input with placeholders.
   * Assign parameters to placeholders.
   * Return string representation of this element and parameters
   *
   * @return SQL\Element\PreparedElement
   */
  public function prepare(SQL\Element\PreparedElement $preparedElement);
}
