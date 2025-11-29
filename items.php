<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $user_id = intval($_SESSION["user_id"]);

    if (isset($_GET["item_name"])) {
        $incomplete_add = false;
        $dup_item = false;
        if ($_GET["item_name"] != "" and $_GET["quantity"] != "" and $_GET["location"] != "" and $_GET["exp_date"] != "" and $_GET["price"] != "" and $_GET["supplier"] != "" and $_GET["notes"] != "") {
            
            $item_name = $_GET["item_name"];
            $quantity = intval($_GET["quantity"]);
            $exp = $_GET["exp_date"];
            $location = $_GET["location"];
            $price = intval($_GET["price"]);
            $supplier = $_GET["supplier"];
            $notes = $_GET["notes"];
            
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "homedex";

            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (mysqli_connect_error()) {
                die("Conenction Failed:".mysqli_connect_error());
            }

            $sql = "SELECT * FROM items WHERE name='$item_name' and user_id=$user_id;";
            
           $result = mysqli_query($conn, $sql);

           if (mysqli_num_rows($result) == 0) {

                $sql = "INSERT INTO items (quantity,name,exp_date,notes,location,price,supplier,user_id) VALUES
                        ($quantity, '$item_name', '$exp', '$notes', '$location', $price, '$supplier', $user_id)";

                mysqli_query($conn, $sql);
           } else {
                $dup_item = true;
           }

            $conn->close();
        } else{
            $incomplete_add = true;
        }
    }

    if (isset($_GET["delete"])) {
        $delete_item_id = intval($_GET["delete"]);

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "homedex";

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (mysqli_connect_error()) {
            die("Conenction Failed:".mysqli_connect_error());
        }

        $sql = "DELETE FROM items WHERE item_id=$delete_item_id;";

        mysqli_query( $conn, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Homedex</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="homedex_styles.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <?php
        include("nav.php");
        ?>

        <main>
            <?php
            if (isset($_SESSION["username"])) {
                $host = "localhost";
                $username = "root";
                $password = "";
                $dbname = "homedex";

                $conn = mysqli_connect($host, $username, $password, $dbname);

                if (mysqli_connect_error()) {
                    die("Conenction Failed:".mysqli_connect_error());
                }

                $sql = "SELECT * FROM items WHERE user_id='$user_id'";

                $result = mysqli_query($conn, $sql);
                
                echo"<table>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Expiration Date</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row["name"];
                        $quantity = $row["quantity"];
                        $exp = $row["exp_date"];
                        $location = $row["location"];
                        $price = $row["price"];
                        $supplier = $row["supplier"];
                        $notes = $row["notes"];
                        $item_id = $row["item_id"];
                        echo "<tr>
                                <td>$item_name</td>
                                <td>$quantity</td>
                                <td>$exp</td>
                                <td>$location</td> 
                                <td>$price</td>
                                <td>$supplier</td>
                                <td>$notes</td>
                                <td><form action='edit_form.php' method='GET'><button type='submit' name='edit' value='$item_id''>Edit</button></form><form method='GET'><button type='submit' name='delete' value='$item_id'>Delete</button></form></td>
                            </tr>";
                    }
                } else{
                    echo "<p>Add items to be able to see them.</p>";
                }

                echo "</table>";
                
                echo '<h1>Add a new item</h1>
                <form action="items.php" method="get">
                    <label for="item_name">Item Name*:</label>
                    <input name="item_name" id="item_name" type="text"><br>

                    <label for="quantity">Quantity*:</label>
                    <input name="quantity" id="quantity" type="text"><br>

                    <label for="exp_date">Expiration Date*:</label>
                    <input name="exp_date" id="exp_date" type="text"><br>

                    <label for="location">Location*:</label>
                    <input name="location" id="location" type="text"><br>

                    <label for="price">Price*:</label>
                    <input name="price" id="price" type="text"><br>

                    <label for="supplier">Supplier*:</label>
                    <input name="supplier" id="supplier" type="text"><br>

                    <label for="notes">Notes*:</label>
                    <input name="notes" id="notes" type="text"><br>

                    <p>All form areas with an astric are required</p>

                    <button type="submit">Add Item</button>
                </form>';
                $conn->close();
                if (isset($_GET["item_name"])) {
                    if ($incomplete_add == true) {
                        echo "<p>Unable to add new item as all required fields weren't added</p>";
                    }
                    if ($dup_item == true) {
                        echo "<p>Unable to add item as it was a duplicate</p>";
                    }
                }
            }else{
                echo "<p>Please sign in to use this functionality</p>";
            }


            ?>
        </main>

        <footer>

        </footer>
    </body>
</html>