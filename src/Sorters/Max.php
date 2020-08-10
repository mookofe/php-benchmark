<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\AbstractSorter;
use Mookofe\Benchmark\Sorters\Orientation\absOrder;

class Max extends AbstractSorter
{	
	/**
     * Stores the field name used to order
     *
     * @var string
     */
    protected static $fieldName = 'max';

    /**
     * Create an instance of max sorter
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
