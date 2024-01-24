<?php
// $students = ["Violet", " ", "Nia", " ", "Finch", " ", "Craig"];

// foreach($students as $value) {
//     echo $value;
// }
$database_connection = mysqli_connect('localhost', 'root', '', 'e-shop_php');

// var_dump($database_connection);

if($database_connection->connect_error) {
    echo $database_connection->connect_error;
}

$sql = "SELECT * FROM users";
$result = $database_connection->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<pre>";
    print_r($row);
    echo "<pre>";
}