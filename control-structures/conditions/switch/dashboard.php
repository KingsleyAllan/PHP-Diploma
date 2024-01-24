<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        nav{
            background-color: green;
            padding: 14px 0px;
        }

        ul li{
            display: inline;
        }

        ul li a{
            text-decoration: none;
            color: white;
            padding: 0px 28px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <div>
        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="dashboard.php?id=users">Manage Users</a></li>
                <li><a href="dashboard.php?id=roles">Manage Roles</a></li>
                <li><a href="dashboard.php?id=products">Manage Products</a></li>
                <li><a href="dashboard.php?id=logout">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Section -->
        <main>
            <div>
                <?php
                  $selected_option = $_GET['id'];

                  switch ($selected_option) {
                    case 'users':
                            echo "
                                <table>
                                    <thead> 
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John</td>
                                            <td>Mary</td>
                                            <td>Joe</td>
                                        </tr>
                                    </tbody>
                                </table>
                            ";
                        break;
                    case 'roles':
                        echo "Roles";
                    break;
                    case 'products':
                        echo "Products";
                    break;
                    case 'logout':
                        echo "Logout";
                    break;
                    default:
                        echo "404 - Page not found";
                        break;
                  }
                ?>
            </div>
        </main>
    </div>
</body>
</html>