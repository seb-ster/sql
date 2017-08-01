<?php
/**
 * SebSter Abstract Clause Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Clause;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * AbstractClause Class
 */
abstract class AbstractClause extends SQL\Element\Collection
{}
