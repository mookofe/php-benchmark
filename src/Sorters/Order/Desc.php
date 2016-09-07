<?php

namespace Mookofe\Benchmark\Sorters\Order;

class Desc extends absOrder
{   
    /**
     * Sorting criteria for descending
     *
     * @param decimal $a First value to compare
     * @param decimal $b Second value to compare
     *
     * @return boolean
     */
    public function orderFunction($a, $b) 
    {
        return ($b > $a) ? +1 : -1;
    }
}
