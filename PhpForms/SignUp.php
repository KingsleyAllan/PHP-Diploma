<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
    <h1>SIGN-UP</h1>
    <form action="SignUp.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="submit" value="SignUp">
    </form>
</body>
</html>
<?php
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    include_once 'db-connect.php';

    // SQL Query
    $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";

    // Execute the query
    $database_connection->query($sql);
}
?>