<?php

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

class Parameter implements FilterInterface
{
    protected $parameterSets;

    public function __construct()
    {
        $this->parameterSets = [];
    }

    public function addSet()
    {
        $this->parameterSets[] = func_get_args();
    }

    public function match(FlatResult $flatResult)
    {
        foreach ($this->parameterSets as $parameterSet) {
            if ($flatResult->parameters === $parameterSet) {
                return true;
            }
        }

        return false;
    }

}
