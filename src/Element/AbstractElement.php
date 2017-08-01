<?php
/**
 * SebSter Abstract Element Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * AbstractElement Class
 */
abstract class AbstractElement implements SQL\Interfaces\ElementInterface
{
  /**
   * {@inheritDoc}
   */
  public function __toString()
  {
    return $this->getString();
  }
}
