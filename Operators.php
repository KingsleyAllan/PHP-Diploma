<?php
$x =10;
$y = 20;

if($x == $y) {
    echo "x is equal to y";
} else{
    echo "x is not equal to y";
}

echo "<br>";

$username = "John";
$password = "123";

if ($username === "John" && $password === "123") {
    echo "Login Successful!";
} else {
    echo "Wrong username or password!";
}

echo "<br>";

$first_name= "Violet";
$last_name ="Finch";

echo $first_name. ' ' . $last_name;

echo "<br>";

$database_connection = mysqli_connect('localhost', 'root', '');