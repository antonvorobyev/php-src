--TEST--
Test implode() function
--FILE--
<?php
/* Prototype: string implode ( string $glue, array $pieces );
   Description: Returns a string containing a string representation of all the 
                array elements in the same order, with the glue string between each element.
*/
echo "*** Testing implode() for basic opeartions ***\n";
$arrays = array (
  array(1,2),
  array(1.1,2.2),
  array(array(2),array(1)),
  array(false,true),
  array(),
  array("a","aaaa","b","bbbb","c","ccccccccccccccccccccc")
);
/* loop to output string with ', ' as $glue, using implode() */
foreach ($arrays as $array) {
  var_dump( implode(', ', $array) );
  var_dump($array);
}

echo "\n*** Testing implode() with variations of glue ***\n";
/* checking possible variations */
$pieces = array (
  2, 
  0,
  -639,
  -1.3444,
  true,
  "PHP",
  false,
  NULL,
  "",
  " ",
  6999.99999999,
  "string\x00with\x00...\0"
);
$glues = array (
  "TRUE",
  true,
  false,
  array("key1", "key2"),
  "",
  " ",
  "string\x00between",
  -1.566599999999999,
  NULL, 
  -0,
  '\0'
);
/* loop through to display a string containing all the array $pieces in the same order,
   with the $glue string between each element  */
$counter = 1;
foreach($glues as $glue) {
  echo "-- Iteration $counter --\n";
  var_dump( implode($glue, $pieces) );
  $counter++;
}

/* empty string */
echo "\n*** Testing implode() on empty string ***\n";
var_dump( implode("") );

/* checking sub-arrays */
echo "\n*** Testing implode() on sub-arrays ***\n";
$sub_array = array(array(1,2,3,4), array(1 => "one", 2 => "two"), "PHP", 50);
var_dump( implode("TEST", $sub_array) );
var_dump( implode(array(1, 2, 3, 4), $sub_array) );
var_dump( implode(2, $sub_array) );

echo "\n*** Testing implode() on objects ***\n";
/* checking on objects */
class foo
{
  function __toString() {
    return "Object";
  }
}

$obj = new foo(); //creating new object
$arr = array();
$arr[0] = &$obj;
$arr[1] = &$obj;
var_dump( implode(",", $arr) );
var_dump($arr);

/* Checking on resource type */
echo "\n*** Testing end() on resource type ***\n";
/* file type resource */
$file_handle = fopen(__FILE__, "r");

/* directory type resource */
$dir_handle = opendir( dirname(__FILE__) );

/* store resources in array for comparision */
$resources = array($file_handle, $dir_handle);

var_dump( implode("::", $resources) );

echo "\n*** Testing error conditions ***\n";
/* zero argument */
var_dump( implode() );

/* only glue */
var_dump( implode("glue") );

/* int as pieces */
var_dump( implode("glue",1234) );

/* NULL as pieces */
var_dump( implode("glue", NULL) );

/* pieces as NULL array */
var_dump( implode(",", array(NULL)) );

/* integer as glue */
var_dump( implode(12, "pieces") );

/* NULL as glue */
var_dump( implode(NULL, "abcd") );

/* args > than expected */
var_dump( implode("glue", "pieces", "extra") );

/* closing resource handles */
fclose( $file_handle );
closedir( $dir_handle );

echo "Done\n";
?>
--EXPECTF--	
*** Testing implode() for basic opeartions ***
string(4) "1, 2"
array(2) {
  [0]=>
  int(1)
  [1]=>
  int(2)
}
string(8) "1.1, 2.2"
array(2) {
  [0]=>
  float(1.1)
  [1]=>
  float(2.2)
}

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
string(12) "Array, Array"
array(2) {
  [0]=>
  array(1) {
    [0]=>
    int(2)
  }
  [1]=>
  array(1) {
    [0]=>
    int(1)
  }
}
string(3) ", 1"
array(2) {
  [0]=>
  bool(false)
  [1]=>
  bool(true)
}
string(0) ""
array(0) {
}
string(42) "a, aaaa, b, bbbb, c, ccccccccccccccccccccc"
array(6) {
  [0]=>
  string(1) "a"
  [1]=>
  string(4) "aaaa"
  [2]=>
  string(1) "b"
  [3]=>
  string(4) "bbbb"
  [4]=>
  string(1) "c"
  [5]=>
  string(21) "ccccccccccccccccccccc"
}

*** Testing implode() with variations of glue ***
-- Iteration 1 --
string(91) "2TRUE0TRUE-639TRUE-1.3444TRUE1TRUEPHPTRUETRUETRUETRUE TRUE6999.99999999TRUEstring with ... "
-- Iteration 2 --
string(58) "2101-6391-1.3444111PHP1111 16999.999999991string with ... "
-- Iteration 3 --
string(47) "20-639-1.34441PHP 6999.99999999string with ... "
-- Iteration 4 --

Notice: Array to string conversion in %s on line %d
string(13) "key1Arraykey2"
-- Iteration 5 --
string(47) "20-639-1.34441PHP 6999.99999999string with ... "
-- Iteration 6 --
string(58) "2 0 -639 -1.3444 1 PHP      6999.99999999 string with ... "
-- Iteration 7 --
string(201) "2string between0string between-639string between-1.3444string between1string betweenPHPstring betweenstring betweenstring betweenstring between string between6999.99999999string betweenstring with ... "
-- Iteration 8 --
string(124) "2-1.56660-1.5666-639-1.5666-1.3444-1.56661-1.5666PHP-1.5666-1.5666-1.5666-1.5666 -1.56666999.99999999-1.5666string with ... "
-- Iteration 9 --
string(47) "20-639-1.34441PHP 6999.99999999string with ... "
-- Iteration 10 --
string(58) "2000-6390-1.3444010PHP0000 06999.999999990string with ... "
-- Iteration 11 --
string(69) "2\00\0-639\0-1.3444\01\0PHP\0\0\0\0 \06999.99999999\0string with ... "

*** Testing implode() on empty string ***

Warning: implode(): Argument to implode must be an array in %s on line %d
bool(false)

*** Testing implode() on sub-arrays ***

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
string(27) "ArrayTESTArrayTESTPHPTEST50"

Notice: Array to string conversion in %s on line %d
string(19) "1Array2Array3Array4"

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
string(18) "Array2Array2PHP250"

*** Testing implode() on objects ***
string(13) "Object,Object"
array(2) {
  [0]=>
  &object(foo)#%d (0) {
  }
  [1]=>
  &object(foo)#%d (0) {
  }
}

*** Testing end() on resource type ***
string(30) "Resource id #%d::Resource id #%d"

*** Testing error conditions ***

Warning: Wrong parameter count for implode() in %s on line %d
NULL

Warning: implode(): Argument to implode must be an array in %s on line %d
bool(false)

Warning: implode(): Bad arguments in %s on line %d
bool(false)

Warning: implode(): Bad arguments in %s on line %d
bool(false)
string(0) ""

Warning: implode(): Bad arguments in %s on line %d
bool(false)

Warning: implode(): Bad arguments in %s on line %d
bool(false)

Warning: Wrong parameter count for implode() in %s on line %d
NULL
Done
