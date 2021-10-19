<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Store</title>
    <meta name="author" content="D.C" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/table.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <h1> Store </h1>
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
        
        <?php

        include_once $root . "/includes/helpers.inc.php";

        echo "<table>";
        echo "<caption>Items</caption>";
        echo "<tr>";
        echo "<th id=\"image\">Image</th>";
        echo "<th id=\"name\">Name</th>";
        echo "<th id=\"description\">Description</th>";
        echo "<th id=\"cost\">Cost</th>";
        echo "<th id=\"cart\">Cart</th>";
        echo "</tr>";
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td headers=\"image\">";
            echo "<img src=\"./image.download.php?image_id=";
            htmlout($item["file_id"]);
            echo "\" alt=\"";
            htmlout($item["name"]);
            echo "\" width=\"140\" height=\"94\" />";
            echo "</td>";
            echo "<td headers=\"name\">";
            htmlout($item["name"]);
            echo "</td>";
            echo "<td headers=\"description\">";
            htmlout($item["description"]);
            echo "</td>";
            echo "<td headers=\"cost\">";
            echo "$";
            htmlout($item["cost"]);
            echo "</td>";
            echo "<td headers=\"cart\">";
            echo "<form method=\"post\" action=\"?\">";
            echo "<input type=\"hidden\" name=\"item_id\" value=\"";
            htmlout($item["item_id"]);
            echo "\"  />";
            echo "<input type=\"hidden\" name=\"name\" value=\"";
            htmlout($item["name"]);
            echo "\"  />";
            echo "<input type=\"hidden\" name=\"description\" value=\"";
            htmlout($item["description"]);
            echo "\"  />";
            echo "<input type=\"hidden\" name=\"cost\" value=\"";
            htmlout($item["cost"]);
            echo "\"  />";
            echo "<label for=\"quantity";
            htmlout($item["item_id"]);
            echo "\">Quantity</label>";
            echo "<input type=\"number\" name=\"quantity\" id=\"quantity";
            htmlout($item["item_id"]);
            echo "\" min=\"1\" max=\"100\" />";
            echo "<input type=\"submit\" name=\"action\" value=\"Add\"  />";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        ?>

        <a id="log" href="./logout.php">log out</a>
    </main>
    <footer>
        <p>&copy;&nbsp;D.C</p>
        <a href="./admin.php">Admin</a>
    </footer>
</body>

</html>