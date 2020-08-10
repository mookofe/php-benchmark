<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

class FilterManager
{
    /**
     * Proccess all filters againts the results
     *
     * @param array $filters Filters to be evaluated
     * @param array $flatResults List of flat results to be filtered
     *
     * @return array
     */
    public static function proccess($filters, $flatResults)
    {
        $filtered = [];
        foreach ($flatResults as $flatResult) {

            $match = true;
            foreach ($filters as $filter) {
                $match = $match && $filter->match($flatResult);                    
            }

            if ($match) {
                $filtered[] = $flatResult;
            }
        }
        return $filtered;
    }
}
