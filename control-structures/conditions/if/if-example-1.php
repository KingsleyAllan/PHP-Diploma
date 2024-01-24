<?php

$database_connection = mysqli_connect('localhost', 'root', '');

if ($database_connection->connect_error) {
    echo "Error" . $database_connection->connect_error;
}