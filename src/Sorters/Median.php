<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Sorters\Order\absOrder;

class Median extends absSorter
{
    protected static $fieldName = 'median';

    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
