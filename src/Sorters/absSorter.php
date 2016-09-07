<?php

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\Order\absOrder;

abstract class absSorter
{
    protected static $order;
    protected static $fieldName;
    
    public function __construct(absOrder $order)
    {
        static::$order = $order;
    }

    public static function compare($a, $b)
    {
        $fieldName = static::$fieldName;

        if ($a->$fieldName == $b->$fieldName){
            return 0;
        }

        return static::$order->orderFunction($a->$fieldName, $b->$fieldName);
    }

    public function sort($result)
    {
        usort($result, [get_class($this), 'compare']);
        return $result;
    }
}
