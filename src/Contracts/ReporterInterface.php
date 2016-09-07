<?php

namespace Mookofe\Benchmark\Contracts;

use Mookofe\Benchmark\Sorters\absSorter;

Interface ReporterInterface
{
	/**
     * Generate the report on the implemented class
     *
     * @param Mookofe\Benchmark\Sorters\absSorter $sorter Flat result to be evaluated
     *
     * @return void
     */
    public function generate(absSorter $sorter);
}