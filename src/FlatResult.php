<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark;

class FlatResult
{   
    /**
     * List of parameters
     *
     * @var array
     */
    public $parameters;

    /**
     * Method name
     *
     * @var string
     */
    public $methodName;

    /**
     * Minimum time lasted of execution
     *
     * @var double
     */
    public $min;

    /**
     * Maximum time lasted of execution
     *
     * @var double
     */
    public $max;

    /**
     * Average time lasted of execution
     *
     * @var double
     */
    public $avg;

    /**
     * Median time lasted of execution
     *
     * @var double
     */
    public $median;

    /**
     * Create a new Flat Result instance.
     *
     * @param string $methodName Name of the method to be created
     * @param array $parameters List of parameters to be added
     * @param double $min Minimum time lasted of execution
     * @param double $max Maximum time lasted of execution
     * @param double $avg Average time lasted of execution
     * @param double $median Median time lasted of execution
     *
     * @return void
     */
    public function __construct($methodName, $parameters, $min, $max, $avg, $median)
    {
        $this->methodName = $methodName;
        $this->parameters = $parameters;
        
        $this->min = $min;
        $this->max = $max;
        $this->avg = $avg;
        $this->median = $median;
    }

    /**
     * Create a Flat Result from a Benchmark
     *
     * @param string $methodName Name of the method to be created
     * @param Mookofe\Benchmark\Benchmark $benchmark Benchmark item
     *
     * @return FlatResult
     */
    public static function createFromBenchmark($methodName, Benchmark $benchmark)
    {
        return new FlatResult($methodName, $benchmark->getParameterSet(), $benchmark->getMin(), $benchmark->getMax(), $benchmark->getAvg(), $benchmark->getMedian());
    }

    /**
     * Get readable parameter representation in string
     *
     * @return string
     */
    public function readableParameters()
    {
        $readable = "(";
        foreach ($this->parameters as $parameter) {
            $readable .= $this->parseParameters($parameter);
        }
        return $readable .= ")";
    }

    /**
     * Parse parameter values to string readable
     *
     * @param array $parameters List of parameters
     *
     * @return string
     */
    protected function parseParameters($parameters)
    {
        if (is_array($parameters)) {
            return "[" . implode(', ', $parameters) . "]";
        }
        elseif (is_object($parameters)) {
            return "Object";
        }
        
        return $parameters;
    }
}
