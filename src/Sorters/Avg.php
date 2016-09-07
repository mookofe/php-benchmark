<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Sorters\Order\absOrder;

class Avg extends absSorter
{
    protected static $fieldName = 'avg';

    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
