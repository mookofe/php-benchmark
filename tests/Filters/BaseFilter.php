<?php
declare(strict_types = 1);

namespace Mookofe\Benchmark\Tests\Filters;

use PHPUnit\Framework\TestCase;
use Mookofe\Benchmark\FlatResult;

abstract class BaseFilter extends TestCase
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