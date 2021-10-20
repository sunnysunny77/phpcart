<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orders</title>
    <meta name="author" content="D.C" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header>
        <h1>Orders</h1>
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

        $total = 0;

        echo "<table>";
        echo "<caption>User Information</caption>";
        echo "<tr>";
        echo "<th id=\"user\">User</th>";
        echo "<th id=\"phone\">Phone</th>";
        echo "<th id=\"email\">Email</th>";
        echo "<th id=\"address\">Address</th>";
        echo "<th id=\"deregistration\">Deregistration</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td headers=\"user\">";
        htmlout($user["name"]);
        echo "</td>";
        echo "<td headers=\"phone\">";
        htmlout($user["phone"]);
        echo "</td>";
        echo "<td headers=\"email\">";
        htmlout($user["email"]);
        echo "</td>";
        echo "<td headers=\"address\">";
        htmlout($user["street"]);
        echo " ";
        htmlout($user["suberb"]);
        echo " ";
        htmlout($user["post_code"]);
        echo " ";
        htmlout($user["state"]);
        echo "</td>";
        echo "<td headers=\"deregistration\">";
        echo "<form method=\"post\" action=\"?\">";
        echo "<input type=\"hidden\" name=\"email\" value=\"";
        htmlout($user["email"]);
        echo "\"  />";
        echo "<input type=\"submit\" name=\"action\" value=\"Cancel Registration\" />";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        if (empty($items)) {
            echo "<p>Orders is empty</p>";
        } else {
            echo "<table>";
            echo "<caption>Order Information</caption>";
            echo "<tr>";
            echo "<th id=\"id\">ID</th>";
            echo "<th id=\"name\">Name</th>";
            echo "<th id=\"description\">Description</th>";
            echo "<th id=\"quantity\">Quantity</th>";
            echo "<th id=\"cost\">Cost</th>";
            echo "<th id=\"date\">Date</th>";
            echo "<th id=\"arrived\">Arrived</th>";
            echo "</tr>";
            foreach ($items as $item) {
                echo "<tr>";
                echo "<td headers=\"id\">";
                htmlout($item["order_id"]);
                echo "</td>";
                echo "<td headers=\"name\">";
                htmlout($item["name"]);
                echo "</td>";
                echo "<td headers=\"description\">";
                htmlout($item["description"]);
                echo "</td>";
                echo "<td headers=\"quantity\">";
                htmlout($item["quantity"]);
                echo "</td>";
                echo "<td headers=\"cost\">";
                htmlout($item["cost"] * $item["quantity"]);
                echo "</td>";
                echo "<td headers=\"date\">";
                htmlout($item["date"]);
                echo "</td>";
                echo "<td headers=\"arrived\">";
                echo "<form method=\"post\" action=\"?\">";
                echo "<input type=\"hidden\" name=\"remove\" value=\"";
                htmlout($item["order_id"]);
                echo "\"  />";
                echo "<input type=\"submit\" name=\"action\" value=\"Arrived\" />";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                $total += $item["cost"] * $item["quantity"];
            }
            echo "</table>";
            echo "<p> Total: $";
            htmlout($total);
            echo "</p>";
        }

        ?>

        <a id="log" href="./logout.php">log out</a>
    </main>
    <footer>
        <p>&copy;&nbsp;D.C</p>
        <a href="./admin.php">Admin</a>
    </footer>
</body>
</html>