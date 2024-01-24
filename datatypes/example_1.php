<?php

// Datatypes

// 1.int
$age = 29;

echo $age;

echo "<br>";

var_dump($age);
echo "<br>";

// 2. float
$deposit = 5000.00;
var_dump($deposit);
echo "<br>";

// 3. Boolean
$is_completed = true;
var_dump($is_completed);

echo "<br>";

if ($is_completed) {
    echo "Success";
} else {
    echo "Fail";
}
echo "<br>";

//4. string
$msg = "John, 3456789876, 20";
var_dump($msg);

echo "<br>";
$exploded_msg = explode(",", $msg);

var_dump($exploded_msg);

echo "<br>";

$name = $exploded_msg[0];
$id = $exploded_msg[1];
$age = $exploded_msg[2];

echo "Name: {$name}, Id: {$id}, Age: {$age}";
echo "<br>";

// 5. array
// a. indexed array
$students = ["John", "Mary", "Isaac", "Mitchelle"];
var_dump($students);
echo "<br>";
// b. associative array
$user_input = array("username" => "John", "email" => "john@gmail.com", "password" => "John$$123");
var_dump($user_input);
echo "<br>";

// 6. null
$cart = null;
var_dump($cart);
echo "<br>";

// 7. Object
class Student
{
    public $age = 20;
}

$student = new Student(); //Creating an object
var_dump($student);
echo "<br>";

// 8. Resource
$file = fopen('example.txt', 'r');
var_dump($file);

