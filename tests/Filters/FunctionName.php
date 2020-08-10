<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Tests\Filters;

use Mookofe\Benchmark\Filters\FilterManager;

class FunctionName extends BaseFilter
{
    public function testGetChanges(): void
    {
        $flatResults = $this->getFlatResults();
        $filteredExpectedCount = 2;

        /** Assert they're not equals */
        $this->assertTrue(count($flatResults) != $filteredExpectedCount);

        $filter = new \Mookofe\Benchmark\Filters\FunctionName(['bubbleSort']); 
        $filtered = FilterManager::Proccess([$filter], $flatResults);

        /** Assert filtered items match the expected */
        $this->assertEquals($filteredExpectedCount, count($filtered));
    }    
}
