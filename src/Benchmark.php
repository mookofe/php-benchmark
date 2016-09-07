<?php

namespace Mookofe\Benchmark;

class Benchmark
{   

    private $parameterSet;
    private $results = null;

    /**
     * Stores Minimum time lasted of execution
     *
     * @var double
     */
    protected $min;

    /**
     * Stores Maximum time lasted of execution
     *
     * @var double
     */
    protected $max;

    /**
     * Stores the avererge time lasted in execution
     *
     * @var double
     */
    protected $avg;

    /**
     * Stores the avererge time lasted in execution
     *
     * @var decimal
     */
    protected $median;

    /**
     * Get a Benchmark instance 
     *
     * @param array $parameterSet Parameter set for this iteration
     *
     * @return void
     */
    public function __construct($parameterSet)
    {
        $this->parameterSet = $parameterSet;
    }

    /**
     * Add a method iteration result
     *
     * @param \Mookofe\Benchmark\BenchmarkResult $result Benchmark result item
     *
     * @return decimal
     */
    public function addResult($result)
    {
        $this->results[] = $result;
    }

    /**
     * Get the minimum executed time for this function and parameter set
     *
     * @return decimal
     */
    public function getMin()
    {
       return $this->min;
    }

    /**
     * Get the maximun executed time for this function and parameter set
     *
     * @return decimal
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Get the average executed time for this function and parameter set
     *
     * @return decimal
     */
    public function getAvg()
    {
        return $this->min;
    }

    /**
     * Get the median executed time for this function and parameter set
     *
     * @return decimal
     */
    public function getMedian()
    {
        return $this->min;
    }

    /**
     * Generate stats for a function with a particular parameter set
     *
     * @return void
     */
    public function generateStats()
    {   
        $results = $this->resultsToArray();
        $this->min = min($results);
        $this->max = max($results);
        $this->avg = array_sum($results) / count($results);
        $this->median = $this->generateMedian($results);
    }

    /**
     * Get the median value from array
     *
     * @param array $numbers Array of numbers to generate the median
     * 
     * @return decimal
     */
    protected function generateMedian(array $numbers)
    {
        rsort($numbers);
        $mid = (count($numbers) / 2);
        return ($mid % 2 != 0) ? $numbers{$mid-1} : (($numbers{$mid-1}) + $numbers{$mid}) / 2;
    }

    /**
     * Get benchmark parameters set
     *
     * @return array
     */
    public function getParameterSet()
    {
        return $this->parameterSet;
    }

    /**
     * Convert the current result into an array
     *
     * @return array
     */
    protected function resultsToArray()
    {
        $results = [];
        foreach ($this->results as $result) {
            $results[] = $result->getProcessingTime();
        }
        return $results;
    }

    /**
     * Get how many times this Benchmark it's beign executed
     *
     * @var int
     */
    public function getTimesExcecuted()
    {
        return count($this->results);
    }
}
