<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Filters;

/**
 * Class FilterManager
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class FilterManager
{
    /**
     * Process all filters against the results
     *
     * @param array $filters Filters to be evaluated
     * @param array $flatResults List of flat results to be filtered
     *
     * @return array
     */
    public static function process($filters, $flatResults)
    {
        $filtered = [];
        foreach ($flatResults as $flatResult) {
            $match = true;

            foreach ($filters as $filter) {
                $match = $match && $filter->match($flatResult);                    
            }

            if ($match === true) {
                $filtered[] = $flatResult;
            }
        }

        return $filtered;
    }
}
