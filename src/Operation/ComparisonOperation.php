<?php
/**
 * SebSter Comparison Operation Class
 *
 * @author      S.R. van Heerde <seb_ster@hotmail.com>
 * @copyright   Copyright (c) S.R. van Heerde
 *
 */

namespace SebSter\SQL\Operation;

use SebSter\SQL;
require_once __dir__.'\..\..\vendor\autoload.php';// @codeCoverageIgnore

/**
 * ComparisonOperation Class
 */
class ComparisonOperation extends SQL\Operation\AbstractOperation implements SQL\Interfaces\LogicOperationInterface
{
  public function __construct($operator, SQL\Element\Expression $expression)
  {
    if (!is_string($operator))
    {
      throw new SQL\Exception\InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__FUNCTION__.'() must be of type string. Got '.gettype($operator));
    }

    $arguments = func_get_args();

    $parentArguments[] = '';
    $parentArguments[] = array_shift($arguments);
    $parentArguments[] = '';
    $parentArguments = array_merge($parentArguments, $arguments);

    call_user_func_array('parent::__construct', $parentArguments);
  }

  /**
   * {@inheritDoc}
   */
  public function andIs(ComparisonOperation $comparisonOperation)
  {
    $arguments = func_get_args();
    array_unshift($arguments, $this);

    $andOperationClass = new \ReflectionClass(SQL\Operation\AndOperation::class);
    $andOperation = $andOperationClass->newInstanceArgs($arguments);

    return $andOperation;
  }

  /**
   * {@inheritDoc}
   */
  public function orIs(ComparisonOperation $comparisonOperation)
  {
    $arguments = func_get_args();
    array_unshift($arguments, $this);

    $orOperationClass = new \ReflectionClass(SQL\Operation\OrOperation::class);
    $orOperation = $orOperationClass->newInstanceArgs($arguments);

    return $orOperation;
  }
}
