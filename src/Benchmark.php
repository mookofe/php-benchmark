<?php

namespace App\Benchmark;

class Benchmark
{
    private $parameterSet;
    private $results = null;

    protected $min;
    protected $max;
    protected $avg;
    protected $median;

    public function __construct($parameterSet)
    {
        $this->parameterSet = $parameterSet;
    }

    public function addResult($result)
    {
        $this->results[] = $result;
    }

    /**
     * Get the minimum executed time for this function and parameter set
     */
    public function getMin()
    {
       return $this->min;
    }

    /**
     * Get the maximun executed time for this function and parameter set
     */
    public function getMax()
    {
        return $this->max;
    }

    public function getAvg()
    {
        return $this->min;
    }

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

    public function getTimesExcecuted()
    {
        return count($this->results);
    }
}
