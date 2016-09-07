<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Sorters\Order\absOrder;

class Min extends absSorter
{
    protected static $fieldName = 'min';

    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
