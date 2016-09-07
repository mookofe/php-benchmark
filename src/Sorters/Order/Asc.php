<?php

namespace Mookofe\Benchmark\Sorters\Order;

class Asc extends absOrder
{
    public function orderFunction($a, $b) 
    {
        return ($a > $b) ? +1 : -1;
    }
}
