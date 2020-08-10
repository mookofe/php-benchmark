<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

class Parameter implements FilterInterface
{   
    /**
     * List of parameters set to filter
     *
     * @var array
     */
    protected $parameterSets;

    /**
     * Create a Parameter filter instance 
     *
     * @return void
     */
    public function __construct()
    {
        $this->parameterSets = [];
    }
    
    /**
     * Add Parameter set to list
     *
     * @param mixed
     *
     * @return @void
     */
    public function addSet()
    {
        $this->parameterSets[] = func_get_args();
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
        foreach ($this->parameterSets as $parameterSet) {
            if ($flatResult->parameters === $parameterSet) {
                return true;
            }
        }

        return false;
    }

}
