<?php
session_start();

// Fetch users from the database (you should enhance this with pagination and filtering)
include 'dbConnect.php';

$sql = "SELECT * FROM products";
$result = $database_connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Produts</title>

    <style>
        body{
        font-family: 'Courier New', Courier, monospace;
       }

       h1{
        text-align: center;
       }
    </style>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-xl bg-black">
            <div class="container">
                <div class="collapse navbar-collapse show" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-xl-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white fs-5 fw-bold" href="user_dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5 fw-bold" href="ViewProducts.php">View Products</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                           <a href="Login.php" class="text-decoration-none">
                           <button class="nav-link btn btn-warning text-black fs-5 fw-bold text-decoration-none">Login</button>
                           </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                <h1 class="pt-5 fw-bolder">Products</h1><br>
                <table class="table table-hover">
                    <thead>
                        <tr class="fs-5">
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">PRICE(USD.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

<?php
if (!isset($_SESSION['username']) || $_SESSION['roles'] !== 'user') {
    header('Location: login.php');
    exit;
}
?>