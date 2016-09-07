<?php

namespace Mookofe\Benchmark;

use Mookofe\Benchmark\Benchmark;
use Mookofe\Benchmark\BenchmarkResult;

class Method
{
    /**
     * Method name 
     *
     * @var string
     */
    public $name;

    /**
     * Benchmark of this specific method
     *
     * @var array
     */
    protected $benchmarks;

    /**
     * Create a new Method instance.
     *
     * @return void
     */
    public function __construct($methodName)
    {
        $this->name = $methodName;
    }

    /**
     * Generate benchmark
     *
     * @param int $times Number of times to be executed the same method
     * @param array $parametersSets Set of parameters that will be tested
     *
     * @return @void
     */
    public function generateBenchmark($times, $parametersSets)
    {
        foreach ($parametersSets as $parameterSet) {
            
            /** Define benchmark for this parameter set */
            $benchmark = new Benchmark($parameterSet);
            
            for ($n=0; $n<$times; $n++) {
                $benchmarkResult = new BenchmarkResult();
                $benchmarkResult->start();

                call_user_func_array($this->name, $parameterSet);
                
                $benchmarkResult->end();

                /**  Add result item to parameter array */
                $benchmark->addResult($benchmarkResult);
            }

            /** Generate stats */
            $benchmark->generateStats();

            $this->benchmarks[] = $benchmark;
        }
    }

    /**
     * Get benchmark for this particular method
     *
     * @return array
     */
    public function getBenchmarks()
    {
        return $this->benchmarks;
    }    
}
