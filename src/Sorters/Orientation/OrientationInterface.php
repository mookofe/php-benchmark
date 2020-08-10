<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters\Orientation;

/**
 * Define contract for sorting orientation (Ascending, Descending)
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
interface OrientationInterface
{
    /**
     * Define comparison function
     *
     * @param float $a First value to compare
     * @param float $b Second value to compare
     *
     * @return int
     */
    public function compare(float $a, float $b): int;
}