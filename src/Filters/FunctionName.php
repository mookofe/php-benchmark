<?php

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

class FunctionName implements FilterInterface
{
    protected $functionNames;

    public function __construct(array $functionNames)
    {
        $this->functionNames = $functionNames;
    }

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
