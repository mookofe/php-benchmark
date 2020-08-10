<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark;

/**
 * Represents the flat calculated results for a given Method
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
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
     * @param float $min Minimum time lasted of execution
     * @param float $max Maximum time lasted of execution
     * @param float $avg Average time lasted of execution
     * @param float $median Median time lasted of execution
     */
    public function __construct(string $methodName, array $parameters, float $min, float $max, float $avg, float $median)
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
     * @param Benchmark $benchmark Benchmark item
     *
     * @return FlatResult
     */
    public static function createFromBenchmark($methodName, Benchmark $benchmark)
    {
        return new FlatResult(
            $methodName,
            $benchmark->getParameterSet(),
            $benchmark->getMin(),
            $benchmark->getMax(),
            $benchmark->getAvg(),
            $benchmark->getMedian()
        );
    }

    /**
     * Get readable parameter representation in string
     *
     * @return string
     */
    public function readableParameters(): string
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
    protected function parseParameters(array $parameters): string
    {
        if (is_array($parameters)) {
            return "[" . implode(', ', $parameters) . "]";
        }

        if (is_object($parameters)) {
            return "Object";
        }

        return '';
    }
}
