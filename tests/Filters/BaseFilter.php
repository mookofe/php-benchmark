<?php 

namespace Mookofe\Benchmark\Tests\Filters;

use Mookofe\Benchmark\FlatResult;

abstract class BaseFilter extends \PHPUnit_Framework_TestCase
{
	protected function getFlatResults()
	{
		return [
			new FlatResult('bubbleSort', [100, 5, 300], rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100)),
			new FlatResult('bubbleSort', [4, 2, 1], rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100)),
			new FlatResult('quickSort', [100, 5, 300], rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100)),
			new FlatResult('quickSort', [4, 2, 1], rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100)),
		];
	}

    
}