<?php
session_start();
if (isset($_GET["edit"])) {
    $item_id = $_GET["edit"];
}else{
    $item_id = $_SESSION["temp_item_id"];
}
if (isset($_SESSION["incomplete_edit"])) {
    $incomplete_edit = $_SESSION["incomplete_edit"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Index</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="homedex_styles.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <?php
        include("nav.php");
        ?>

        <main>
            <h1>Edit the item:</h1>
            <form action="edit.php" method="get">
                <input type="hidden" value="<?php echo "$item_id"; ?>" name="item_id">

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

                <?php
                if (isset($incomplete_edit) && $incomplete_edit == true) {
                    echo "<p>Please fill in all required fields.</p>";
                }
                ?>

                <button type="submit">Edit Item</button>
            </form>
        </main>

        <footer>

        </footer>
    </body>
</html>
