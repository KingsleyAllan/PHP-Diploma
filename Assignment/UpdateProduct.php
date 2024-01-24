<?php
session_start();

include 'dbConnect.php';

if (!isset($_SESSION['username']) || $_SESSION['roles'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$productDetails = []; // Initialize the variable

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
    $Id = $_POST['ID'];

    // Fetch the product details based on the product ID
    $stmt = $database_connection->prepare("SELECT * FROM products WHERE ID = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $productDetails = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Update Product</title>

    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
        }

        h1{
            text-align: center;
        }

        .btn{
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
                <h1 class="pt-5 fw-bolder">Update Product</h1><br>

                <!-- Update Product Form -->
                <form method="post" action="UpdateProduct.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $productDetails['name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description:</label>
                        <textarea name="description" class="form-control" required><?php echo $productDetails['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input name="price" class="form-control" value="<?php echo $productDetails['price']; ?>" required>
                    </div>

                    <input type="hidden" name="ID" value="<?php echo $productDetails['ID']; ?>">
                    <button type="submit" name="updateProductDetails" class="btn fw-bold fs-5 btn-warning">Update Product</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProductDetails'])) {
        $Id = $_POST['ID'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = floatval($_POST['price']);

        // Validate inputs (add more validation as needed)
        if (!empty($name) && !empty($description) && !empty($price)) {
            $stmt = $database_connection->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE ID = ?");
            $stmt->bind_param("ssdi", $name, $description, $price, $Id);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Product updated successfully";
                header('Location: ManageProducts.php'); // Redirect back to the Manage Products page
                exit;
            } else {
                $_SESSION['error'] = "Product update failed! Please try again.";
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "All fields are required for product update";
        }
    }
?>
