<?php
/**
 * SebSter Abstract Preparable Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Element;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * AbstractPreparable Class
 */
abstract class AbstractPreparable extends SQL\Element\AbstractElement implements SQL\Interfaces\PreparableInterface
{}
