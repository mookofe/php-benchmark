<?php

namespace Mookofe\Benchmark\Filters;

class FilterManager
{
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
