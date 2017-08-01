<?php
/**
 * SebSter Element interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

/**
 * Element interface.
 */
interface ElementInterface
{
  /**
   * Return string representation of this element
   *
   * @return \string
   */
  public function __toString();

  /**
   * Alias of __toString()
   *
   * @return \string
   */
  public function getString();
}
