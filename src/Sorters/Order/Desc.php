<?php

namespace Mookofe\Benchmark\Sorters\Order;

class Desc extends absOrder
{
    public function orderFunction($a, $b) 
    {
        return ($b > $a) ? +1 : -1;
    }
}
