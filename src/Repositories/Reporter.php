<?php

namespace Mookofe\Benchmark\Repositories;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Filters\FilterManager;
use Mookofe\Benchmark\Contracts\FilterInterface;
use Mookofe\Benchmark\Contracts\ReporterInterface;

abstract class Reporter
{
    protected $filters;
    protected $results;
    protected $sorter;

    public function __construct(array $results)
    {
        $this->filters = [];
        $this->results = $results;
    }

    protected function generateReport(absSorter $sorter)
    {
        $this->sorter = $sorter;

        $filtered = $this->filter($this->flatternResults());
        return $this->orderBy($filtered);
    }

    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    protected function flatternResults()
    {
        $flatResults = [];
        foreach ($this->results as $result) {
            foreach ($result->getBenchmarks() as $benchmark) {
                $flatResults[] = FlatResult::createFromBenchmark($result->name, $benchmark);
            }          
        }

        return $flatResults;
    }

    protected function filter(array $flatResults)
    {
        if (count($this->filters) > 0) {
            return FilterManager::Proccess($this->filters, $flatResults);
        }

        return $flatResults;
    }

    public function orderBy(array $flatResults)
    {
        return $this->sorter->sort($flatResults);
    }

}
