mookofe/php-benchmark
=========

PHP library that allows you benchmark and compare the performance of functions

[![Build Status](https://travis-ci.org/mookofe/laravel-support.svg?branch=master)](https://travis-ci.org/mookofe/laravel-support)
[![Latest Stable Version](https://poser.pugx.org/mookofe/laravel-support/v/stable.svg)](https://packagist.org/packages/mookofe/laravel-support)
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

```js
"mookofe/php-benchmark": "0.*"
```

**Install dependencies**

```
$ php composer install
```

Or

```batch
$ php composer update
```


Integration
--------------
Change inheritance on your models, instead of using the default Eloquent Model change as follow:

```php
<?php namespace App;

use Mookofe\LaravelSupport\Model;

class User extends Model {

}

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

```php
    
********************************************************************************
 Benchmark Report
********************************************************************************

Running times: 10
Number of functions: 2
Number of parameters set: 3

FILTERS:
$filters


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

Advanced Usage:
----


###Check if an attribute exists in the model

This function verify if an attribute already exists in the current model.

```php
    $model = new Model;
    echo $model->attributeExist('new_property');          //false
    
    $model->new_property = null;
    echo $model->attributeExist('new_property');          //true
```

###Get changes in a model

Return an array with the affected properties.

```php
    $model = new Model;
    $changes = $model->getChanges();                    //array();
    
    $model->client_id = 1;
    $changes = $model->getChanges();                    //array( array('field' => 'client_id', 'old_value' => '', 'new_value' => 1) );
```

###Create new model from existing using only specific fields
Create a new instance only with the fields specified

```php
    $model = new Model;
    $model->client_id = 1;
    $model->amount = 100;
    $model->date = Carbon::now();
    
    $new_model_fields = array('client_id', 'amount');
    $new_model = $model->extract($new_model_fields);
    
    //You are also allowed to change property name:
    $new_model_fields = array('new_field' => 'client_id', 'amount');
    $new_model = $model->extract($new_model_fields);
```

###Remove model fields
Allows you to remove fields in model

```php
    $fields_to_remove = array('client_id', 'amount');
    $model->removeFields($fields_to_remove);
```


Using Collection features:
--------------
Our model is configured to use our collection which extends from Eloquent Collection, so all methods from the Eloquent Collection can be used.

###Rebuild collection
Allows you to rebuild a collection using the fields you want. Imagine you have a user table with the following fields: (id, name, lastname, sex)

```php
    $collection = User::all();
    
    //New collection only with the specified fields
    $format = array('name', 'lastname');
    $new_collection = $collection->rebuild($format);
    
    //You can also change field names and objects as follow:
    $format = array('id', 'personal_data' => ['name', 'lastname', 'sex']);
    $new_collection = $collection->rebuild($format);
```

###Compare collections
Allows you to compare if all values of a field is present in another collection. 

```php
    $collection = User::all();
    $user_avatar_collection = User_avatar::all();
        
    //Check if all users have a record on the user avatar collection
    $collection->compare($user_avatar_collection, 'user_id', 'id');        //boolean
```

###Create new instance
Allows you to create a new empty instance of the same type of the current collection 

```php
    $collection = User::all();
    $empty_collection = $collection->createNewInstance();
```

###Get latests rows grouped by fields
Return a new collection with the latest rows grouped by the fields specified, in the order of the collection items. Imagine you have a **post** table with the following fields (id, user_id, post\_category\_id).

This example allows you to get the latest posts categories for the user.

```php
    $collection = Post::all();
    $latests = $collection->getLatestsByField( array('user_id', 'post_category_id') );
```

###Get first rows grouped by fields
Return a new collection with the first rows grouped by the fields specified, in the order of the collection items. Using the previous table structure, in this example you get the first posts categories for the user.

```php
    $collection = Post::all();
    $first = $collection->getFirstByField( array('user_id', 'post_category_id') );
```

###Sum values by field in collection
Sum all values matching the search criteria. In this example the function will sum all products prices from category 10.

```php
    $collection = Product::all();
    $sum = $collection->sumValues('product_category_id', 10, 'price');
```

###Find items on collection
Allows you to find items on the collection filter by data in the array. In this example we will filter all products with product category 10 and price 100.

```php
    $collection = Product::all();
    $filter = array('product_category_id' => 10, 'price' => 100);
    
    $filtered = $collection->findByFields($filter);
```

###Merge collections
Merge fields from the new collection if values matches. In this example we will merge the avatar file path to the user model.

```php
    $users = User::all();
    $user_avatar = User_avatar::all()
    
    $fields_to_compare = array('id' => 'user_id');
    $fields_to_merge = array('file_path');
    
    $users->mergeByFields($user_avatar, $fields_to_compare, $fields_to_merge);
```

###Custom value for found item
Allows you to return a custom value if the item you are looking for it's been found. If no option is specified the model is returned.

```php
    $users = User::all();
    $filter = array('name' => 'John');
    $options = array(
        'found_text' => 'Item exist',
        'not_found_text' => 'Item not found',
        'field' => 'field_name'
    );
        
    echo $users->showIfFound($filter, $options);
```

###Delete all models from collection
Allows you to delete all models from the database in the current collection.

```php
    $user_comments = User_comment::all();
    $user_comments->delete();
```

###Collection average by field
Allows you to get the average by a field

```php
    $products = Product::all();
    echo $products->avg('price');
    
    //Including null values for average, assumed as zero.
    echo $products->avg('price', true);
```

###Find items not matching the filter
Allows you to find items on the collection not matching the filter criteria. In this example we will filter all products where product category is different to 10.

```php
    $collection = Product::all();
    $filter = array('product_category_id' => 10);
    
    $filtered = $collection->findIfDifferent($filter);
```

###Get maximum item by field name
Get the max value of the given key and return the item. In this example the function will return the max user from the collection.

```php
    $users = User::all();
    $max_user = $users->maxItem('id');
```


TODO Before bed
----
  - Code should conform, at a minimum, to PSR-1 & PSR-2
  - PHP DocBlock comments
  - Add inline comments
  - Add return types to functions
  - Strictures and type-hinting should be enabled


TODO
----
  - Accept arguments by canonical name
  - Create WebReporterRepository to allow benchmark on controllers and other places
  - Return exception when argument and signature does not match

License
----
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)