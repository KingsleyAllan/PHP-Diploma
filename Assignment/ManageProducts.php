<?php
session_start();

include 'dbConnect.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $database_connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manage Products</title>

    <style>
        body{
        font-family: 'Courier New', Courier, monospace;
       }

       h1{
        text-align: center;
       }

       .add{
        width: 80%;
        margin-left: 10%;
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
                            <a class="nav-link active text-white fs-5 fw-bold" href="admin_dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white fs-5 fw-bold" aria-current="page" href="ViewUsers.php">View Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5 fw-bold" href="ManageProducts.php">Manage Products</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <button class="nav-link btn btn-warning text-black fs-5 fw-bold" href="Login.php">Login</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                <h1 class="pt-5 fw-bolder">Add Products</h1><br>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input name="price" class="form-control" required>
                    </div>

                    <button type="submit" name="createProduct" class="add btn fw-bold fs-5 btn-primary">Add Product</button>
                </form>

                <h3 class="mt-4 fw-bolder pt-5">List of Products</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">PRICE(USD.)</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td>
                                    <form method="post" action="UpdateProduct.php">
                                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                                        <button type="submit" name="updateProduct" class="btn fw-bold btn-warning">Update</button>
                                    </form><br>
                                    <form method="post" action="">
                                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                                        <button type="submit" name="deleteProduct" class="btn fw-bold btn-danger">Delete</button>
                                    </form>
                                </td>
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
ob_start();
if (!isset($_SESSION['username']) || $_SESSION['roles'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'dbConnect.php';

// Handle Product CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['createProduct'])) {
        // Handle product creation form submission
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = floatval($_POST['price']);

        // Validate inputs (add more validation as needed)
        if (!empty($name) && !empty($description) && !empty($price)) {
            $stmt = $database_connection->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $name, $description, $price);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Product created successfully";
            } else {
                $_SESSION['error'] = "Product creation failed! Please try again.";
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "All fields are required for product creation";
        }
    } elseif (isset($_POST['deleteProduct'])) {
        // Handle product deletion form submission
        $Id = $_POST['ID'];

        // Validate input (add more validation as needed)
        if (!empty($Id)) {
            $stmt = $database_connection->prepare("DELETE FROM products WHERE ID = ?");
            $stmt->bind_param("i", $Id);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Product deleted successfully";
            } else {
                $_SESSION['error'] = "Product deletion failed! Please try again.";
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "Product ID is required for deletion";
        }
    }
}
?>