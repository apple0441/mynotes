# Summary of PHP interview questions

> Some questions are collected from the Internet, and some questions related to MySQL and HTML may be interspersed in it.

## 1. What is the difference between echo(), print(), and print_r()?

**echo** and **print** are not a function, but a language structure;
`print(string $arg)` has only one argument;
`echo arg1, arg2` can output multiple parameters and return `void`;
`echo` and `print` can only print strings, not structures;
`print_r` can print out the structure. for example:

```php
$arr = array("key"=>"value");
print_r($arr);
```

## 2. What is the difference between the statement include and require?

On failure:
`include` generates a `warning`, while `require` directly generates an error break;
`require` to load before running;
`include` is loaded at runtime;
`require_once` and `include_once` can avoid including the same file repeatedly.

## 3. What is the difference between pass by value and pass by reference in php?

& means pass by reference;
Parameter passing by reference in the function will change the parameter;
Generally, you can consider using references when there are multiple output parameters.

```php
$num = 10
function multiply($num){
     $num = $num * 10;
}
multiply($num);
echo $num;
```

## 4. Which of the following does not add john to the users array?

```
(a) $users[] = 'john';
(b) array_add($users,'john');
(c) array_push($users,'john');
(d) $users ||= 'john';
```
The answer is bd, there is no `array_add` function in php, and item d is the expression of grammatical error.

## 5. The meaning of several status codes in the HTTP protocol.

```
200 : The request is successful, and the requested data is returned accordingly.
301 : Permanent redirect.
302 : Temporary line redirection.
401 : The current request requires user authentication.
403: The server refuses to execute the request, that is, there is no permission.
404 : The request failed, the requested data was not found on the server.
500 : Server error. General server-side program execution error.
503: The server is temporarily maintained or overloaded. This state is temporary.
```
## 6. Write some php magic methods.

```
__construct() is called automatically when the class is instantiated.
__destruct() is called automatically when a class object is finished using it.
__set() is called when assigning a value to an undefined property.
__get() is called when an attribute is not defined.
__isset() will be called when using the isset() or empty() function.
__unset() will be called when using unset().
__sleep() is called when serializing using serialize.
__wakeup() is called when unserialize is used for deserialization.
__call() Called when calling a method that does not exist.
__callStatic() calls a static method that does not exist.
__toString() is called when converting an object to a string. Such as echo.
__invoke() Called when an attempt is made to invoke an object as a method.
__set_state() Called when using the var_export() function. Accepts an array parameter.
__clone() Called when an object is copied using clone.
```

## 7. The difference between MySQL storage engine MyISAM and InnoDB.

```
a. The MyISAM type does not support advanced processing such as transaction processing, but the InnoDB type does.
b. The MyISAM type table emphasizes performance, and its execution is faster than the InnoDB type.
c. InnoDB does not support indexes of type FULLTEXT.
d. InnoDB does not save the specific row number of the table, that is to say, when executing select count(*) from table, InnoDB needs to scan the entire table to calculate how many rows there are, but MyISAM simply reads the saved row number That's it.
e. For fields of type AUTO_INCREMENT, InnoDB must contain an index only for this field, but in MyISAM tables, a joint index can be established with other fields.
f. When DELETE FROM table, InnoDB will not recreate the table, but delete it row by row.
g. The LOAD TABLE FROM MASTER operation does not work for InnoDB. The solution is to first change the InnoDB table to a MyISAM table, and then change it to an InnoDB table after importing data. However, for additional InnoDB features used (such as foreign keys) Table does not apply.
h. MyISAM supports table locks, and InnoDB supports row locks.
```

## 8. Name some MySQL optimization methods?

```
a. Design a good database structure, allow partial data redundancy, try to avoid join queries, and improve efficiency.
b. Select the appropriate table field data type and storage engine, and add indexes appropriately.
c. The mysql library master-slave read and write separation.
d. Find rules and divide tables to reduce the amount of data in a single table and improve query speed.
e. Add caching mechanism, such as memcached, apc, etc.
f. Generate static pages for infrequently changed pages.
g. Write efficient SQL. For example, SELECT * FROM TABEL is changed to SELECT field_1, field_2, field_3 FROM TABLE.
```

## 9. The result of $a below is:
```php
<?php
$a = in_array('01', array('1')) == var_dump('01' == 1);
?>
```
A true
B false

The answer is B

## 10. Talk about the difference between empty() and isset() in php.

`isset` is used to check whether a variable is set, using `isset()` to test a variable that is set to NULL will return `FALSE`.
`empty` If `var` is a non-empty or non-zero value, `empty()` returns `FALSE`. In other words, `"", 0, "0", NULL, FALSE, array(), var $var;`, and objects without any attributes will be considered empty, and if `var` is empty, return `TRUE`.

If the variable is `0`, `empty()` will return `TRUE`, and `isset()` will return `TRUE`;
If the variable is an empty string, `empty()` will return TRUE, and `isset()` will return `TRUE`;
If the variable is undefined, `empty()` will return `TRUE`, and `isset()` will return `FLASE`.
   
Note: `isset()` can only be used with variables, because passing any other parameters will cause a parse error. To check whether a constant is set, use the `defined()` function.
When you want to judge whether a variable has been declared, you can use the `isset` function;
When you want to judge whether a variable has been assigned data and is not empty, you can use the `empty` function;
When you want to judge that a variable exists and is not empty, first use the `isset` function and then use the `empty` function;