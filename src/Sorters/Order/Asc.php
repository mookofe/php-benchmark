<?php

namespace Mookofe\Benchmark\Sorters\Order;

class Asc extends absOrder
{
    /**
     * Sorting criteria for ascending
     *
     * @param decimal $a First value to compare
     * @param decimal $b Second value to compare
     *
     * @return boolean
     */
    public function orderFunction($a, $b) 
    {
        return ($a > $b) ? +1 : -1;
    }
}
