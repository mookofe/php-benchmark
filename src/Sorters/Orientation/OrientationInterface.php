<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters\Orientation;

/**
 * Interface OrderInterface
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
interface OrientationInterface
{
    /**
     * Sorting criteria for descending
     *
     * @param float $a First value to compare
     * @param float $b Second value to compare
     *
     * @return int
     */
    public function orderFunction(float $a, float $b): int;
}