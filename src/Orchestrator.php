<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark;

/**
 * Orchestrate the tests that are going to be performed
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Orchestrator
{
    /**
     * Array or methods to be tested
     *
     * @var array
     */
    private $methods;

    /**
     * Array of parameters set to be tested
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
        $this->methods = [];
        $this->parameters = [];
    }

    /**
     * Add method to the list to be tested
     *
     * @param Method $method Method to be added to the list
     */
    public function addMethod(Method $method): void
    {
        $this->methods[] = $method;
    }

    /**
     * Add Parameters set to list
     *
     * @param mixed
     */
    public function addParameters(): void
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
    public function run(int $times = 1)
    {
        /** @var Method $method */
        foreach ($this->methods as $method) {
            $method->generateBenchmark($times, $this->parameters);
        }

        return $this->methods;
    }
}
