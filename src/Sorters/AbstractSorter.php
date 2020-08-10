<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\Order\absOrder;

abstract class AbstractSorter
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
    protected $fieldName;

    /**
     * @var OrientationInterface
     */
    private $orientation;
    
    /**
     * Create an instance of absSorter sorter
     *
     * @param OrientationInterface $orientation orientation to be sorted (Asc, Desc)
     *
     * @return void
     */
    public function __construct(OrientationInterface $orientation)
    {
        $this->orientation = $orientation;
    }

    /**
     * Comparer function used to sort the flatResults
     *
     * Polymorphic behavior to use the field and sorter of the derived implementation
     *
     * @param \Mookofe\Benchmark\FlatResult $a   First flat result to compare
     * @param \Mookofe\Benchmark\FlatResult $b   Second flat result to compare
     *
     * @return boolean
     */
    public static function compare(FlatResult $a, FlatResult $b): bool
    {
        $fieldName = $this->fieldName;

        if ($a->$fieldName === $b->$fieldName){
            return 0;
        }

        return static::$orientatio->orderFunction($a->$fieldName, $b->$fieldName);
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
