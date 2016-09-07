<?php

namespace Mookofe\Benchmark;

class Orchestrator
{
    
    /**
     * Array or methods to be tested
     *
     * @var array
     */
    private $methods;

    /**
     * Array of marameters set to be tested
     *
     * @var array
     */
    private $parameters;

    /**
     * Create a new Orchestrator instance.
     *
     * @return void
     */
    public function __construct()
    {
        $methods = [];
        $parameters = [];
    }

    /**
     * Add method to the list to be tested
     *
     * @param \Mookofe\Benchmark\Method $method Method to be added to the list
     *
     * @return @void
     */
    public function addMethod(Method $method)
    {
        $this->methods[] = $method;
    }

    /**
     * Add Parameters set to list
     *
     * @param mixed
     *
     * @return @void
     */
    public function addParameters()
    {
        $this->parameters[] = func_get_args();
    }

    /**
     * Execute the tests against the methods and parameters set
     *
     * @param int $times Number of times to be executed the same function
     *
     * @return array
     */
    public function run($times = 1)
    {
        foreach ($this->methods as $method) {
            $method->generateBenchmark($times, $this->parameters);
        }
        return $this->methods;
    }
}
