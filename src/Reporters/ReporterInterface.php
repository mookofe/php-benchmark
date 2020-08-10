<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Reporters;

use Mookofe\Benchmark\Sorters\AbstractSorter;

/**
 * Interface ReporterInterface
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
Interface ReporterInterface
{
	/**
     * Generate the report on the implemented class
     *
     * @param AbstractSorter $sorter Flat result to be evaluated
     *
     * @return void
     */
    public function generate(AbstractSorter $sorter);
}