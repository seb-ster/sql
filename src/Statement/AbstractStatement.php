<?php
/**
 * SebSter Abstract Statement Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Statement;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * AbstractStatement Class
 */
abstract class AbstractStatement extends SQL\Element\Collection
{
}
