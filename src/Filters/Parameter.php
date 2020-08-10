<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Contracts\FilterInterface;

/**
 * Class Parameter
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
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
     */
    public function addSet(): void
    {
        $this->parameterSets[] = func_get_args();
    }

    /**
     * @inheritdoc
     */
    public function match(FlatResult $result): bool
    {
        foreach ($this->parameterSets as $parameterSet) {
            if ($result->parameters === $parameterSet) {
                return true;
            }
        }

        return false;
    }
}
