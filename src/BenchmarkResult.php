<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark;

/**
 * Represents the result for a single method evaluation
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class BenchmarkResult
{
    /**
     * Start time for benchmark
     *
     * @var float
     */
    private $startTime;

    /**
     * End time for benchmark
     *
     * @var float
     */
    private $endTime;

    /**
     * Start timer to count
     *
     * @return void
     */
    public function start(): void
    {
        $this->startTime = microtime(true);
    }

    /**
     * Finish a execution
     *
     * @return void
     */
    public function end(): void
    {
        $this->endTime = microtime(true);
    }

    /**
     * Calculates the difference between the start and end of a function
     *
     * Represented in microseconds
     *
     * @return float
     */
    public function getProcessingTime(): float
    {
        return ($this->endTime-$this->startTime) * 1000000;
    }    
}
