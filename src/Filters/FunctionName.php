<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

class FunctionName implements FilterInterface
{
    /**
     * List of functions to be filtered
     *
     * @var array
     */
    protected $functionNames;

    /**
     * Create a functionName filter instance 
     *
     * @return void
     */
    public function __construct(array $functionNames)
    {
        $this->functionNames = $functionNames;
    }

    /**
     * Verify if the current filter match with the flatResult specified
     *
     * @param Mookofe\Benchmark\FlatResult $flatResult Flat result to be evaluated
     *
     * @return boolean
     */
    public function match(FlatResult $flatResult)
    {
        foreach ($this->functionNames as $functionName) {
            if ($functionName == $flatResult->methodName) {
                return true;
            }
        }
        return false;
    }

    
}
