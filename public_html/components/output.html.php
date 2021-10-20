<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Output</title>
    <meta name="author" content="D.C" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header>
        <h1>Output</h1>
    </header>
    <nav>
        <ul>
            <li>
                <a href="./">Store</a>
            </li>
            <li>
                <a href="./orders.php">Orders</a>
            </li>
            <li>
                <a href="./register.php">Register</a>
            </li>
            <li>
                <a href="./cart.php">Cart</a>
            </li>
        </ul>
    </nav>
    <main>

        <?php include_once $root . "/includes/helpers.inc.php";
        htmlout($output); ?>

    </main>
    <footer>
        <p>&copy;&nbsp;D.C</p>
        <a href="./admin.php">Admin</a>
    </footer>
</body>
</html>