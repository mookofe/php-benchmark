<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

/**
 * Class FunctionName
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class FunctionName implements FilterInterface
{
    /**
     * List of functions to be filtered
     *
     * @var array
     */
    protected $functionNames;

    /**
     * FunctionName constructor.
     *
     * @param array $functionNames
     */
    public function __construct(array $functionNames)
    {
        $this->functionNames = $functionNames;
    }

    /**
     * @inheritdoc
     */
    public function match(FlatResult $result): bool
    {
        foreach ($this->functionNames as $functionName) {
            if ($functionName === $result->methodName) {
                return true;
            }
        }

        return false;
    }
}
