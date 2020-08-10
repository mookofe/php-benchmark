<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\AbstractSorter;
use Mookofe\Benchmark\Sorters\Orientation\absOrder;

class Median extends absSorter
{	
	/**
     * Stores the field name used to order
     *
     * @var string
     */
    protected static $fieldName = 'median';

    /**
     * Create an instance of median sorter
     *
     * @param \Mookofe\Benchmark\Sorters\Orientation\absOrde $order 	Order to be organized (Asc, Desc)
     *
     * @return void
     */
    public function __construct(absOrder $order)
    {
        parent::__construct($order);        
    }    
}
