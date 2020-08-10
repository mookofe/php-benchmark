mookofe/php-benchmark
=========

PHP library that allows you benchmark and compare the performance of functions.

<!--[![Build Status](https://travis-ci.org/mookofe/php-benchmark.svg?branch=master)](https://travis-ci.org/mookofe/php-benchmark)-->
[![Latest Stable Version](https://poser.pugx.org/mookofe/php-benchmark/v/stable)](https://packagist.org/packages/mookofe/php-benchmark)
[![Latest Unstable Version](https://poser.pugx.org/mookofe/php-benchmark/v/unstable)](https://packagist.org/packages/mookofe/php-benchmark)
[![License](https://poser.pugx.org/mookofe/laravel-support/license.svg)](https://packagist.org/packages/mookofe/laravel-support)


Features
----
  - Optimize for PHP7
  - The library accepts an arbitrary number of user defined functions to test against each other
  - Accept functions under test as callable type. 
  - Accept functions under test with a canonical name
  - The library accept an arbitrary number of argument sets to be passed to each function under test.
  - Functions can be tested N number of times
  - Includes Summary report
  - Summary report can be streamed can be sent to an i/o stream in human readable format
  - Summary report can be order by (Min, Max, Avg and Median) execution time (Ascending and Descending)
  - Report can be filtered by function name and parameters set
  

Version
----
0.0.1


Installation
--------------

To get started, use Composer to add the package to your project's dependencies:


```
$ composer require mookofe/php-benchmark
```


Basic Usage:
----

```php
function bubbleSort(array $array): void
{
    if (!$length = count($array)) {
        return $array;
    }      
     
    for ($outer = 0; $outer < $length; $outer++) {
        for ($inner = 0; $inner < $length; $inner++) {
            if ($array[$outer] < $array[$inner]) {
                $tmp = $array[$outer];
                $array[$outer] = $array[$inner];
                $array[$inner] = $tmp;
            }
        }
    }
}

function quickSort(array $array): void
{
    if (!$length = count($array)) {
        return $array;
    }
 
    $k = $array[0];
    $x = $y = array();
     
    for ($i=1;$i<$length;$i++) {
        if ($array[$i] <= $k) {
            $x[] = $array[$i];
        } else {
           $y[] = $array[$i];
        }
    }

    return array_merge(quickSort($x),array($k),quickSort($y));
}
```
Given these two functions, let's benchmark them
    
```php
use Mookofe\Benchmark\Method;
use Mookofe\Benchmark\Sorters\Min;
use Mookofe\Benchmark\Orchestrator;
use Mookofe\Benchmark\Sorters\Order\Asc;
use Mookofe\Benchmark\Repositories\IOReporter;

...
   
//Define orchestrator
$orchestrator = Orchestrator();

/** Add paraters to test */
$orchestrator->addParameters([5, 4, 3, 2, 1]);
$orchestrator->addParameters([100, 5, 300]);
$orchestrator->addParameters([20, 10, 9, 25]);

/** Add methods */
$orchestrator->addMethod(new Method('bubbleSort'));
$orchestrator->addMethod(new Method('quickSort'));

/** Run tests 10 times */
$results = $orchestrator->run(10);

/** Run reporter */
$reporter = new IOReporter($results);
$reporter->setPath('results.txt');

//Sorter
$asc = new Asc();
$sorter = Min($asc);

/** Generate report */
$reporter->generate($sorter);
```

Results:

```
    
********************************************************************************
 Benchmark Report
********************************************************************************

Running times: 10
Number of functions: 2
Number of parameters set: 3


SUMMARY:
Function        Parameters             Min       Max       Avg       Median
--------------------------------------------------------------------------------
bubbleSort       ([100, 5, 300])       3.0994    5.0068    3.0994    3.0994    
bubbleSort       ([20, 10, 9, 25])     5.0068    28.8486   5.0068    5.0068    
bubbleSort       ([5, 4, 3, 2, 1])     6.9141    22.8882   6.9141    6.9141    
quickSort        ([100, 5, 300])       10.0136   11.9209   10.0136   10.0136   
quickSort        ([5, 4, 3, 2, 1])     10.9673   377.8934  10.9673   10.9673   
quickSort        ([20, 10, 9, 25])     13.113    19.0735   13.113    13.113    



* Times in microsecond (µs)
```

Sorting:
----


###Sort by minimum descending

Sort the summary report by the min field

```php
use Mookofe\Benchmark\Sorters\Min;
use Mookofe\Benchmark\Sorters\Order\Desc;

...

/** Sorter */
$desc = new Desc();
$sorter = new Min($desc);

/** Generate report */
$reporter->generate($sorter);
```

### Sort by maximum
Sort the summary report by the max field

```php
use Mookofe\Benchmark\Sorters\Max;
use Mookofe\Benchmark\Sorters\Order\Asc;

...

/** Sorter */
$asc = new Asc();
$sorter = new Max($asc);
```

### Sort by average
Sort the summary report by the avg field

```php
use Mookofe\Benchmark\Sorters\Max;
use Mookofe\Benchmark\Sorters\Order\Avg;

...

$asc = Asc();
$sorter = new Avg($asc);
```

### Sort by median
Sort the summary report by the median field

```php
use Mookofe\Benchmark\Sorters\Max;
use Mookofe\Benchmark\Sorters\Order\Median;

...

$asc = new Asc();
$sorter = new Median($asc);
```


Filtering
----

###Filter by method name
```php
use Mookofe\Benchmark\Sorters\Median;
use Mookofe\Benchmark\Sorters\Order\Asc;
use Mookofe\Benchmark\Filters\FunctionName;

...

$asc = new Asc();
$sorter = new Median($asc);

/** Filters */
$functionNames = [
    'bubbleSort'
];

$functionNameFilter = new FunctionName($functionNames);
$reporter->addFilter($functionNameFilter);

/** Generate report */
$reporter->generate($sorter);
```


### Filter by parameters set
```php
use Mookofe\Benchmark\Sorters\Median;
use Mookofe\Benchmark\Sorters\Order\Asc;
use Mookofe\Benchmark\Filters\Parameter;

...

$asc = new Asc();
$sorter = Median($asc);

/** Filters */
$parametersFilter = new Parameter();
$parametersFilter->addSet([5, 4, 3, 2, 1]);
$parametersFilter->addSet([100, 5, 300]);
$reporter->addFilter($parametersFilter);

/** Generate report */
$reporter->generate($sorter);
```


TODO
----
  - Accept arguments by canonical name
  - Create WebReporterRepository to allow benchmark on controllers and other places
  - Return exception when argument and signature does not match
  - Finish package tests
  - try/catch validations
  - Enable Continuous Integration

License
----
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)