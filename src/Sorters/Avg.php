<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\absSorter;
use Mookofe\Benchmark\Sorters\Order\absOrder;

class Avg extends absSorter
{
	/**
     * Stores the field name used to order
     *
     * @var string
     */
    protected static $fieldName = 'avg';

    /**
     * Create an instance of average sorter
     *
     * @param \Mookofe\Benchmark\Sorters\Order\absOrde $order 	Order to be organized (Asc, Desc)
     *
     * @return void
     */
    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
