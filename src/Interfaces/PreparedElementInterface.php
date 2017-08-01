<?php
/**
 * SebSter Prepared Element interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * PreparedElement interface.
 */
interface PreparedElementInterface extends ElementInterface
{
  /**
   * add argument to string collection
   */
  public function addString($string);

  /**
   * add argument to parameter collection
   * return assigned key/index
   *
   * @return string
   */
  public function addParameter(SQL\Element\Expression $expression);

  /**
   * return parameter collection
   *
   * @return \array
   */
  public function getParameters();
}
