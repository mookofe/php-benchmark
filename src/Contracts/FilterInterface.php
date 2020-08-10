<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Contracts;

use Mookofe\Benchmark\FlatResult;

Interface FilterInterface
{	
	/**
     * Verify if the current filter match with the flatResult specified
     *
     * @param Mookofe\Benchmark\FlatResult $flatResult Flat result to be evaluated
     *
     * @return boolean
     */
    public function match(FlatResult $result);
}