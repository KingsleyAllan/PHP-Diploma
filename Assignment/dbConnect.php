<?php
$database_connection = mysqli_connect('localhost', 'root', '', 'e-shop_php');

// var_dump($database_connection);

if ($database_connection->connect_error) {
    die("Connection Failed: " . $database_connection->connect_error);
}
?>