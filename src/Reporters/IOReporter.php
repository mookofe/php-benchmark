<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Reporters;

use Mookofe\Benchmark\FlatResult;
use Mookofe\Benchmark\Sorters\AbstractSorter;
use Mookofe\Benchmark\Exceptions\PathRequiredException;

/**
 * Class IOReporter
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class IOReporter extends AbstractReporter implements ReporterInterface
{
    /**
     * Path where report will be saved
     *
     * @var string
     */
    private $path;

    /**
     * Construct a IOReporter instance
     * 
     * @param array $results Result of detailed benchmark
     */
    public function __construct(array $results)
    {
        parent::__construct($results);
    }

    /**
     * @inheritdoc
     */
    public function generate(AbstractSorter $sorter)
    {
        if ($this->path === null){
            throw new PathRequiredException();
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

        echo '<pre><code>';
        echo strtr($template, $vars);
        echo '</code></pre>';

        file_put_contents($this->path,  strtr($template, $vars));
    }

    /**
     * Set the path where the report file will be saved
     *
     * @param string $path New path to set
     *
     * @return void
     */
    public function setPath($path)
    {
        /* @TODO Validate if path exist */
        $this->path = $path;
    }

    /**
     * Generates the summary in human readable format
     *
     * @param array $results Results to be converted
     *
     * @return string
     */
    private function getSummary(array $results): string
    {
        $summary = '';
        foreach ($results as $result) {
            $summary .= $this->buildSummaryRow($result);
        }

        return $summary;
    }

    /**
     * Generates summary row in human readable format
     *
     * @param FlatResult $flatResult Flat result to be converted into a string row
     *
     * @return string
     */
    private function buildSummaryRow(FlatResult $flatResult): string
    {
        return  $this->buildSpacedColumn($flatResult->methodName, 17)
            . $this->buildSpacedColumn($flatResult->readableParameters(), 22)
            . $this->buildSpacedColumn(round($flatResult->min, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->max, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->avg, 4), 10)
            . $this->buildSpacedColumn(round($flatResult->median, 4), 10)
            . "\n";
    }

    /**
     * Calculates the position of the field values to be able to have a nice looking text plain table
     *
     * @param string $value Value in the row
     * @param int $size Maximun characters needed
     *
     * @return string
     */
    private function buildSpacedColumn($value, $size): string
    {
        return str_pad($value, $size);
    }
}