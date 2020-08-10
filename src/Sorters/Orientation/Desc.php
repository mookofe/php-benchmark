<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters\Orientation;

/**
 * Descending orientation implementation
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Desc implements OrientationInterface
{   
    /**
     * @inheritdoc
     */
    public function orderFunction(float $a, float $b): int
    {
        return ($b > $a) ? +1 : -1;
    }
}