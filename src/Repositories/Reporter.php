<?php

namespace Mookofe\Benchmark\Repositories;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Filters\FilterManager;
use Mookofe\Benchmark\Contracts\FilterInterface;
use Mookofe\Benchmark\Contracts\ReporterInterface;

abstract class Reporter
{   
    /**
     * Filters to be applied when report runs
     *
     * @var Mookofe\Benchmark\Contracts\FilterInterface
     */
    protected $filters;

    /**
     * List of benchmarks
     *
     * @var array
     */
    protected $results;

    /**
     * Sorter to be applied to sort summary
     *
     * @var Mookofe\Benchmark\Sorters\absSorter
     */
    protected $sorter;

    /**
     * Construct a reporter instance
     *
     * @param array $results List of benchmarks
     *
     * @return void
     */
    public function __construct(array $results)
    {
        $this->filters = [];
        $this->results = $results;
    }

    /**
     * Generate report
     *
     * @param \Mookofe\Benchmark\Sorters\absSorter $sorter Sorter used to order the result
     *
     * @return array
     */
    protected function generateReport(absSorter $sorter)
    {
        $this->sorter = $sorter;

        $filtered = $this->filter($this->flatternResults());
        return $this->orderBy($filtered);
    }

    /**
     * Add filter to filters list
     *
     * @param \Mookofe\Benchmark\Contracts\FilterInterface $filter Filter to be applied to the report
     *
     * @return void
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * Convert detailed benchmark into a list of flatResult
     *
     * @return array
     */
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

    /**
     * Perform a filter on the flatResults based on the local filters applied
     *
     * @param array $flatResults List of flatResults
     *
     * @return array
     */
    protected function filter(array $flatResults)
    {
        if (count($this->filters) > 0) {
            return FilterManager::Proccess($this->filters, $flatResults);
        }

        return $flatResults;
    }

    /**
     * Perform an order on the flatResults based on the local sorter
     *
     * @param array $flatResults List of flatResults
     *
     * @return array
     */
    public function orderBy(array $flatResults)
    {
        return $this->sorter->sort($flatResults);
    }

}
