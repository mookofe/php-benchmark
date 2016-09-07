<?php

namespace Mookofe\Benchmark;

class FlatResult
{
    public $parameters;
    public $methodName;

    public $min;
    public $max;
    public $avg;
    public $median;

    public function __construct($methodName, $parameters, $min, $max, $avg, $median)
    {
        $this->methodName = $methodName;
        $this->parameters = $parameters;
        
        $this->min = $min;
        $this->max = $max;
        $this->avg = $avg;
        $this->median = $median;
    }

    public static function createFromBenchmark($methodName, Benchmark $benchmark)
    {
        return new FlatResult($methodName, $benchmark->getParameterSet(), $benchmark->getMin(), $benchmark->getMax(), $benchmark->getAvg(), $benchmark->getMedian());
    }

    public function readableParameters()
    {
        $readable = "(";
        foreach ($this->parameters as $parameter) {
            $readable .= $this->parseParameters($parameter);
        }
        return $readable .= ")";
    }

    protected function parseParameters($parameters)
    {
        if (is_array($parameters)) {
            return "[" . implode(', ', $parameters) . "]";
        }
        elseif (is_object($parameters)) {
            return "Object";
        }
        
        var_dump($parameters);
        return $parameters;
    }
}
