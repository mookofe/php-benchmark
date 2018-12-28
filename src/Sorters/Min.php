<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Sorters;

use Mookofe\Benchmark\Sorters\Orientation\absOrder;

class Min extends AbstractSorter
{
	/**
     * Field name used to order
     *
     * @var string
     */
    protected static $fieldName = 'min';

    /**
     * Create an instance of min sorter
     *
     * @param OrientationInterface $orientation Orientation to be organized (Asc, Desc)
     *
     * @return void
     */
    public function __construct(OrientationInterface $orientation)
    {
        parent::__construct($orientation);
    }    
}
