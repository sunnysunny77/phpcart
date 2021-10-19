<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="author" content="D.C" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/table.css" rel="stylesheet" type="text/css" />
    <link href="css/lsform.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <h1>Admin</h1>
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

        <h2>ADD new item to store</h2>
        <form action="?" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Insert new Item</legend>
                <label for="new-name">Name</label>
                <br>
                <input type="text" id="new-name" name="name"/>
                <br>
                <label for="new-description">Description</label>
                <br>
                <textarea rows="10" id="new-description" name="description"></textarea>
                <br>
                <label for="new-cost">Cost</label>
                <br>
                <input step="any" type="number" id="new-cost" name="cost"/>
                <br>
                <label for="upload">Upload File:</label>
                <br>
                <input type="file" id="upload" name="upload"/>
                <br>
                <br>
                <input type="submit" name="action"  value="Insert Item" />
                <br>
            </fieldset>
        </form>

        
        <?php include_once $root . "/includes/helpers.inc.php";

        echo "<h2>Change current admin login</h2>";
        echo "<form action=\"?\" method=\"post\">";
        echo "<label for=\"email\"> Email: </label>";
        echo "<input autocomplete=\"on\" id=\"email\" type=\"text\" name=\"email\" value=\"";
        htmlout($_SESSION['email']);
        echo"\"/>";
        echo "<label for=\"pass\">Password:</label>";
        echo "<input autocomplete=\"on\" type=\"password\" name=\"pass\" id=\"pass\" />";
        echo "<input type=\"submit\" name=\"action\" value=\"Change Login\" />";
        echo "</form>";

        echo "<h2>Add new admin login</h2>";
        echo "<form action=\"?\" method=\"post\">";
        echo "<label for=\"new-email\"> Email: </label>";
        echo "<input autocomplete=\"on\" id=\"new-email\" type=\"text\" name=\"email\"/>";
        echo "<label for=\"new-pass\">Password:</label>";
        echo "<input autocomplete=\"on\" type=\"password\" name=\"pass\" id=\"new-pass\" />";
        echo "<input type=\"submit\" name=\"action\" value=\"New Login\" />";
        echo "</form>";


        echo "<h2>Edit items in store</h2>";
        foreach ($items as $update_1) {
            echo "<form action=\"?\" method=\"post\" enctype=\"multipart/form-data\">";
            echo "<fieldset>";
            echo "<legend>Edit</legend>";
            echo "<input type=\"hidden\" name=\"item_id\"  value=\"";
            htmlout($update_1['item_id']);
            echo "\"/>";
            echo "<input type=\"hidden\" name=\"file_id\"  value=\"";
            htmlout($update_1['file_id']);
            echo "\"/>";
            echo "<label for=\"name";
            htmlout($update_1['item_id']);
            echo "\">Name</label>";
            echo "<br>";
            echo "<input type=\"text\" id=\"name";
            htmlout($update_1['item_id']);
            echo "\" name=\"name\" value=\"";
            htmlout($update_1['name']);
            echo "\"/>";
            echo "<br>";
            echo "<label for=\"description";
            htmlout($update_1['item_id']);
            echo "\">Description</label>";
            echo "<br>";
            echo "<textarea rows=\"10\" id=\"description";
            htmlout($update_1['item_id']);
            echo "\" name=\"description\">";
            htmlout($update_1['description']);
            echo "</textarea>";
            echo "<br>";
            echo "<label for=\"cost";
            htmlout($update_1['item_id']);
            echo "\">Cost</label>";
            echo "<br>";
            echo "<input type=\"number\" step=\"any\" id=\"cost";
            htmlout($update_1['item_id']);
            echo "\" name=\"cost\" value=\"";
            htmlout($update_1['cost']);
            echo "\"/>";
            echo "<br>";
            echo "<label for=\"upload";
            htmlout($update_1['file_id']);
            echo "\">Upload File:</label>";
            echo "<br>";
            echo "<input type=\"file\" id=\"upload";
            htmlout($update_1['file_id']);
            echo "\" name=\"upload\" />";
            echo "<br>";
            echo "<br>";
            echo "<input type=\"submit\" name=\"action\"  value=\"Update Item\" />";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<input type=\"submit\" name=\"action\"  value=\"Delete Item\" />";
            echo "<br>";
            echo "<br>";
            echo "</fieldset>";
            echo "</form>";
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