<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include_once('Nav.php')?>
    <h1>Login</h1>
    <form action="Login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
<?php
if(isset($_POST['login'])){
    session_start();
    $username = $_POST['username'];
    $password = $_POST["password"];

    // Connect to the database or PDO
    include_once 'db-connect.php';

    // SQL Query
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
 
    // Execute the query
    $result = $database_connection->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        echo "Login Successful";
    } else {
        echo "Wrong Username/Password!";
    }
}
?>