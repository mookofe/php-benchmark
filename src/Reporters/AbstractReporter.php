<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Reporters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\BenchmarkResult;
use Mookofe\Benchmark\Sorters\AbstractSorter;
use Mookofe\Benchmark\Filters\FilterManager;
use Mookofe\Benchmark\Contracts\FilterInterface;

/**
 * Class AbstractReporter
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
abstract class AbstractReporter
{   
    /**
     * Filters to be applied when report runs
     *
     * @var FilterInterface[]
     */
    protected $filters;

    /**
     * List of benchmarks
     *
     * @var BenchmarkResult[]
     */
    protected $results;

    /**
     * Sorter to be applied to sort summary
     *
     * @var AbstractSorter
     */
    protected $sorter;

    /**
     * Construct a reporter instance
     *
     * @param array $results List of benchmarks
     */
    public function __construct(array $results)
    {
        $this->filters = [];
        $this->results = $results;
    }

    /**
     * Generate report
     *
     * @param AbstractSorter $sorter Sorter used to order the result
     *
     * @return array
     */
    protected function generateReport(AbstractSorter $sorter): array
    {
        $this->sorter = $sorter;

        $filtered = $this->filter($this->flattenResults());

        return $this->orderBy($filtered);
    }

    /**
     * Add filter to filters list
     *
     * @param FilterInterface $filter Filter to be applied to the report
     */
    public function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    /**
     * Convert detailed benchmark into a list of flatResult
     *
     * @return array
     */
    protected function flattenResults(): array
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
    protected function filter(array $flatResults): array
    {
        if (count($this->filters) > 0) {
            return FilterManager::process($this->filters, $flatResults);
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
    public function orderBy(array $flatResults): array
    {
        return $this->sorter->sort($flatResults);
    }
}
