<?php

namespace Mookofe\Benchmark\Contracts;

use Mookofe\Benchmark\FlatResult;

Interface FilterInterface
{
    public function match(FlatResult $result);
}