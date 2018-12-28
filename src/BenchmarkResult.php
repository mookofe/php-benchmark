<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark;

class BenchmarkResult
{
    /**
     * Start time for benchmark
     *
     * @var double
     */
    private $startTime;

    /**
     * End time for benchmark
     *
     * @var double
     */
    private $endTime;

    /**
     * Function procesing time
     *
     * @var double
     */
    private $processingTime;

    /**
     * Start timer to count
     *
     * @return void
     */
    public function start()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Finihsh a execution 
     *
     * @return void
     */
    public function end()
    {
        $this->endTime = microtime(true);
        $this->processingTime = $this->endTime-$this->startTime;
    }

    /**
     * Calculates the difference between the start and end of a function
     *
     * Represented in microseconds
     *
     * @return decimal
     */
    public function getProcessingTime()
    {
        return $this->processingTime * 1000000;
    }    
}
