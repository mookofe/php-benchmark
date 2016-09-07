<?php

namespace Mookofe\Benchmark;

class Orchestrator
{
    
    private $methods;
    private $parameters;

    public function __construct()
    {
        $methods = [];
        $parameters = [];
    }

    public function addMethod(Method $method)
    {
        $this->methods[] = $method;
    }

    public function addParameters()
    {
        $this->parameters[] = func_get_args();
    }

    public function run($times = 1)
    {
        foreach ($this->methods as $method) {
            $method->generateBenchmark($times, $this->parameters);
        }
        return $this->methods;
    }
}
