<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\Order\absOrder;

abstract class absSorter
{
    /**
     * Store the order for the sorting (Asc, Desc)
     *
     * @var \Mookofe\Benchmark\Sorters\Order\absOrder
     */
    protected static $order;

    /**
     * Stores the field name used to order
     *
     * @var string
     */
    protected static $fieldName;
    
    /**
     * Create an instance of absSorter sorter
     *
     * @param \Mookofe\Benchmark\Sorters\Order\absOrde $order   Order to be organized (Asc, Desc)
     *
     * @return void
     */
    public function __construct(absOrder $order)
    {
        static::$order = $order;
    }

    /**
     * Comparer function used to sort the flatResults
     *
     * Poliformic behavior to use the field and sorter of the derived implementation
     *
     * @param \Mookofe\Benchmark\FlatResult $a   First flat result to compare
     * @param \Mookofe\Benchmark\FlatResult $b   Second flat result to compare
     *
     * @return boolean
     */
    public static function compare($a, $b)
    {
        $fieldName = static::$fieldName;

        if ($a->$fieldName == $b->$fieldName){
            return 0;
        }

        return static::$order->orderFunction($a->$fieldName, $b->$fieldName);
    }

    /**
     * Sort flatResult array based on Sorter and Order
     *
     * @param array $result List of flatResult to be ordered
     *
     * @return array
     */
    public function sort($result)
    {
        usort($result, [get_class($this), 'compare']);
        return $result;
    }
}
