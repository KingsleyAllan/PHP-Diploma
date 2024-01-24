<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>SignUp</title>

    <style>
       body{
        background-color: black;
        font-family: 'Courier New', Courier, monospace;
        color: white;
       }

       h1{
        text-align: center;
        font-weight: bolder;
       }

       button{
        width: 80%;
        margin-left: 10%;
       }
    </style>
</head>
<body>
    <div class="container position-absolute top-50 start-50 translate-middle ">
        <h1>Sign up</h1>

        <form action="SignUp.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="********" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" placeholder="********" name="confirm_password" class="form-control" required>
        </div><br>

        <button type="submit" value="submit" class="btn btn-light fw-bold fs-5">Sign Up</button><br><br>

        <a class="nav-link active text-white fs-5 fw-bold" aria-current="page" href="Login.php">Already have an account, Login.</a>
        </form>
    </div>

</body>
</html>

<?php
session_start();

// Form Submission Processing
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Form Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
         $error = "All fields are required! Please try again.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match! Please try again.";
    } else {
        // Password Hashing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Connect to the db
        include_once 'dbConnect.php';

        // SQL Query
        $stmt = $database_connection->prepare("INSERT INTO users (username, email, password_hash) VALUES(?, ?, ?)");
    
        // Bind parameters and execute statement
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Sign up successful";
            header('Location: login.php'); // Redirect to the login page
        } else {
            $_SESSION['error'] = "Sign up failed! Please try again.";
        }

        $stmt->close();
    }
}
?>