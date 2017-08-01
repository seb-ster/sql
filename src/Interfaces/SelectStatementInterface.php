<?php
/**
 * SebSter Select Statement interface
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Interfaces;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * SelectStatement interface.
 */
interface SelectStatementInterface extends PreparableInterface
{
  /**
   * Add a new Collection to this Statement instance containing the
   * Expression arguments to be used in the projection.
   *
   * @return SQL\Statement\SelectStatement
   */
  public function projection(SQL\Element\Expression $Expression);

  /**
   * Add a new Collection to this Statement instance containing the
   * Identifier arguments to be used in the FROM clause.
   *
   * @return SQL\Statement\SelectStatement
   */
  public function from($identifierOrAlias);

  /**
   * Add a new Collection to this Statement instance containing the
   * Operation arguments to be used in the WHERE clause.
   * Multiple arguments will be wrapped in an LogicOperation using AND Logic.
   *
   * @return SQL\Statement\SelectStatement
   */
  public function where(SQL\Operation\AbstractOperation $Operation);
}
