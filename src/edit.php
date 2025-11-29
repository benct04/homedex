<?php
session_start();
if ($_GET["item_name"] != "" and $_GET["quantity"] != "" and $_GET["location"] != "" and $_GET["exp_date"] != "" and $_GET["price"] != "" and $_GET["supplier"] != "" and $_GET["notes"] != "") {
    $item_id = intval($_GET["item_id"]);
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

    $sql = "UPDATE items SET quantity=$quantity, name='$item_name', exp_date='$exp', notes='$notes', location='$location', price=$price, supplier='$supplier' WHERE item_id=$item_id;";

    mysqli_query( $conn, $sql );

    $conn->close();

    $_SESSION["incomplete_edit"] = false;

    header("location: items.php");
    exit();
} else{
    $_SESSION["incomplete_edit"] = true;
    $_SESSION["temp_item_id"] = $_GET["item_id"];
    header("location: edit_form.php");
    exit();
}
?>
