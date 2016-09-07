<?php

namespace Mookofe\Benchmark;

use Mookofe\Benchmark\Benchmark;
use Mookofe\Benchmark\BenchmarkResult;

class Method
{
    
    public $name;

    protected $benchmarks;

    public function __construct($methodName)
    {
        $this->name = $methodName;
    }

    public function generateBenchmark($times, $parametersSets)
    {
        foreach ($parametersSets as $parameterSet)
        {
            //Define benchmark for this parameter set
            $benchmark = new Benchmark($parameterSet);
            
            for ($n=0; $n<$times; $n++) 
            {
                $benchmarkResult = new BenchmarkResult();
                $benchmarkResult->start();

                call_user_func_array($this->name, $parameterSet);
                
                $benchmarkResult->end();

                //Add result item to parameter array
                $benchmark->addResult($benchmarkResult);
            }

            //Generate stats
            $benchmark->generateStats();

            $this->benchmarks[] = $benchmark;
        }
    }

    public function getBenchmarks()
    {
        return $this->benchmarks;
    }

    
}
