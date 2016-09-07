<?php

namespace Mookofe\Benchmark\Contracts;

use Mookofe\Benchmark\Sorters\absSorter;

Interface ReporterInterface
{
    public function generate(absSorter $sorter);
}