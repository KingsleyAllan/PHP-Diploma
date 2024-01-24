<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>

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
        <h1>Login</h1>

        <form action="Login.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div><br>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="********" class="form-control" required>
        </div><br>

        <button type="submit" value="login" class="btn btn-light fw-bold fs-5">Login</button><br><br>

        <a class="nav-link active text-white fs-5 fw-bold" aria-current="page" href="Index.php">Don't have an account? SignUp.</a>
        </form>
    </div>

</body>
</html>

<?php
session_start();

// Form Submission Processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Form Validation
    if (empty($username) && empty($password)) {
        $error = "All fields are required! Please try again.";
    } else {
        // Connect to the db
        include_once 'dbConnect.php';

        // SQL Query and fetching user info
        $stmt = "SELECT username, password_hash, roles FROM users WHERE username = ?";
        $stmt = $database_connection->prepare($stmt);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password_hash'];
            $roles = $row['roles'];

            // Password Verification
            if (password_verify($password, $hashed_password)) {
                // If password is correct, start a new session
                $_SESSION['username'] = $username;
                $_SESSION['roles'] = $roles;

                // Redirect user to the appropriate dashboard based on role
                if ($roles === 'user') {
                    header('Location: user_dashboard.php');
                } elseif ($roles === 'admin') {
                    header('Location: admin_dashboard.php');
                } 

                $stmt->close();
                $database_connection->close();
            } else {
                // Upon failed Authentication
                $_SESSION['error'] = "Invalid username or password";
            }
        }
    }
}
?>