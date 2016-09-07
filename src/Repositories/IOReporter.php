<?php

namespace Mookofe\Benchmark\Repositories;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Repositories\Reporter;
use Mookofe\Benchmark\Contracts\ReporterInterface;
use Mookofe\Benchmark\Exceptions\PathRequiredException;

class IOReporter extends Reporter implements ReporterInterface
{

    protected $path;

    public function __construct(array $results)
    {
        parent::__construct($results);
    }

    public function generate(absSorter $sorter)
    {
        /* Verify if path is valid */
        if (!$this->path){
            throw new PathRequiredException('Path required to generate report');
        }

        $result = $this->generateReport($sorter);
        $template = file_get_contents(dirname(dirname(__FILE__)) . '/Resources/IOReport.template');

        $benchmarks = $this->results[0]->getBenchmarks();

        //Values for template
        $vars = [
            '$summary' => $this->getSummary($result),
            '$runningTimes' => $benchmarks[0]->getTimesExcecuted(),
            '$functionsNumber' => count($this->results),
            '$parametersCount' => count($benchmarks)
        ];

        // echo '<pre><code>';
        // echo strtr($template, $vars);
        // echo '</code></pre>';

        file_put_contents($this->path,  strtr($template, $vars));
    }

    public function setPath($path)
    {
        /* @TODO Validate if path exist */
        $this->path = $path;
    }

    protected function getSummary(array $results)
    {
        $summary = "";
        foreach ($results as $result) {
            $summary .= $this->buildSummaryRow($result);
        }
        return $summary;
    }

    protected function buildSummaryRow(FlatResult $flatResult)
    {
        return  $this->buildSpacedColumn($flatResult->methodName, 17)
            . $this->buildSpacedColumn($flatResult->readableParameters(), 22)
            . $this->buildSpacedColumn(round($flatResult->min, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->max, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->avg, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->median, 4), 10)
            . "\n";
    }

    protected function buildSpacedColumn($value, $size)
    {
        return str_pad($value, $size);
    }

}