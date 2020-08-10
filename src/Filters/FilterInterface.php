<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Contracts;

use Mookofe\Benchmark\FlatResult;

/**
 * Interface FilterInterface
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
Interface FilterInterface
{	
	/**
     * Verify if the current filter match with the flatResult specified
     *
     * @param FlatResult $result Flat result to be evaluated
     *
     * @return bool
     */
    public function match(FlatResult $result): bool;
}