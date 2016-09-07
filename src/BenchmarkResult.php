<?php

namespace Mookofe\Benchmark;

class BenchmarkResult
{
    
    private $startTime;
    private $endTime;
    private $processingTime;

    public function start()
    {
        $this->startTime = microtime(true);
    }

    public function end()
    {
        $this->endTime = microtime(true);
        $this->processingTime = $this->endTime-$this->startTime;
    }

    /**
     * Represented in microseconds
     */
    public function getProcessingTime()
    {
        return $this->processingTime * 1000000;
    }    
}
