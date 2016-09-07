mookofe/php-benchmark
=========

PHP library that allows you benchmark and compare the performance of functions

[![Build Status](https://travis-ci.org/mookofe/laravel-support.svg?branch=master)](https://travis-ci.org/mookofe/laravel-support)
[![Latest Stable Version](https://poser.pugx.org/mookofe/php-benchmark/v/stable)](https://packagist.org/packages/mookofe/php-benchmark)
[![Latest Unstable Version](https://poser.pugx.org/mookofe/php-benchmark/v/unstable)](https://packagist.org/packages/mookofe/php-benchmark)
[![License](https://poser.pugx.org/mookofe/laravel-support/license.svg)](https://packagist.org/packages/mookofe/laravel-support)


Features
----
  - Optimize for PHP7
  - The library accept an arbitrary number of user defined functions to test against each other
  - Accept functions under test as callable type. 
  - Accept functions under test with a canonical name
  - The library accept an arbitrary number of argument sets to be passed to each function under test.
  - Functions can be tested N number of times
  - Summary report
  - Summary report can be stream can be sent to an i/o stream in human readable format
  - Summary report can be order by (Min, Max, Avg and Median) execution time (Ascending and Descending)
  - Report can be filtered by function name and parameters set
  

Version
----
0.0.1


Installation
--------------

**Preparation**

Open your composer.json file and add the following to the require array: 

```json
"mookofe/php-benchmark": "dev-master"
```

**Install dependencies**

```
$ php composer install
```

Or

```batch
$ php composer update
```


Basic Usage:
----

```php
	function bubbleSort($array)
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

    function quickSort($array)
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
    
    //Define orchestrator
    $orch = new \Mookofe\Benchmark\Orchestrator;
    
    /** Add paraters to test */
    $orch->addParameters([5, 4, 3, 2, 1]);
    $orch->addParameters([100, 5, 300]);
    $orch->addParameters([20, 10, 9, 25]);
    
    /** Add methods */
    $orch->addMethod(new \Mookofe\Benchmark\Method('bubbleSort'));
    $orch->addMethod(new \Mookofe\Benchmark\Method('quickSort'));
    
    /** Run tests 10 times*/
    $results = $orch->run(10);
	
	 /** Run reporter*/
    $reporter = new \Mookofe\Benchmark\Repositories\IOReporter($results);
    $reporter->setPath('results.txt');
    
    //Sorter
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Min($asc);
    
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
    /** Sorter */
    $desc = new \Mookofe\Benchmark\Sorters\Order\Desc;
    $sorter = new \Mookofe\Benchmark\Sorters\Min($desc);
    
    /** Generate report */
    $reporter->generate($sorter);
```

###Sort by maximum
Sort the summary report by the max field

```php
    /** Sorter */
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Max($asc);
```

###Sort by average
Sort the summary report by the avg field

```php
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Avg($asc);
```

###Sort by median
Sort the summary report by the median field

```php
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Median($asc);
```


Filtering
----

###Filter by method name
```php
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Median($asc);
    
    /** Filters */
    $functionNames = [
    	'bubbleSort'
    ];
    
    $functionNameFilter = new \Mookofe\Benchmark\Filters\FunctionName($functionNames);
    $reporter->addFilter($nameFilter);
    
    /** Generate report */
    $reporter->generate($sorter);
```


###Filter by parameters set
```php
    $asc = new \Mookofe\Benchmark\Sorters\Order\Asc;
    $sorter = new \Mookofe\Benchmark\Sorters\Median($asc);
    
    /** Filters */
    $parametersFilter = new \Mookofe\Benchmark\Filters\Parameter();
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

License
----
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)