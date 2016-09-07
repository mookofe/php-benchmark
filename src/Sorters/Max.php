<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Sorters\Order\absOrder;

class Max extends absSorter
{
    protected static $fieldName = 'max';

    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
