<?php
session_start();
if (isset($_GET["create_username"]) and $_GET["create_username"] != "" and isset($_GET["create_password"]) and $_GET["create_password"] != "" and $_GET["create_password"] == $_GET["confirm_password"]) {

    $create_user = $_GET["create_username"];
    $create_pass = $_GET["create_password"];

    $dup_user = false;

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "homedex";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed:". $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$create_user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $dup_user = true;
    } else {
        $sql = "INSERT INTO users (username, pass) VALUES ('$create_user','$create_pass');";

        $conn->query($sql);
    }

}else if (isset($_GET["login_username"]) and isset($_GET["login_password"])){

    $login_user = $_GET["login_username"];
    $login_pass = $_GET["login_password"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "homedex";

    $incorrect_login = false;

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed:". $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$login_user' and pass='$login_pass';";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["username"];
        $_SESSION["password"] = $row["pass"];
        $_SESSION["user_id"] = $row["user_id"];
        header("Location: items.php");
        exit;
    }else{
        $incorrect_login = true;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homedex</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="homedex_styles.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <?php
        include("nav.php");
        ?>

        <main>
            <h1>Login</h1>
            <form action="login.php" method="get">
                <?php
                if (isset($_GET["login_username"])){
                    if ($incorrect_login == true){
                        echo "<p>Invalid Login. Please try again.</p>";
                    }
                }
                ?>
                <label for="login_username">Username:</label>
                <input name="login_username" id="login_username" type="text"><br>

                <label for="login_password">Password:</label>
                <input name="login_password" id="login_password" type="password"><br>

                <button type="submit">Login</button>
                <button type="reset">Clear</button>
            </form>
            <h1>Create Account</h1>
            <form action="login.php" method="get" id="create_form">
                <label for="create_username">Username:</label>
                <input name="create_username" id="create_username" type="text"><br>
                <?php
                if (isset($_GET["create_username"]) and $_GET["create_username"] != "" and isset($_GET["create_password"]) and $_GET["create_password"] != "" and $_GET["confirm_password"] != "" and isset($_GET["confirm_password"]) and $_GET["create_password"] == $_GET["confirm_password"]) {
                    if ($dup_user == true){
                        echo "<p>Username taken. Please use a different one</p>";
                    }
                }else if (isset($_GET["create_username"]) and $_GET["create_username"] == "") {
                    echo "<p>Please enter a username.</p>";
                }
                ?>

                <label for="create_password">Password:</label>
                <input name="create_password" id="create_password" type="password"><br>
                <?php
                if(isset($_GET["create_password"]) and $_GET["create_password"] == ""){
                    echo "<p>Please enter your password</p>";
                }
                ?>

                <label for="confirm_password">Confirm Password:</label>
                <input name="confirm_password" id="confirm_password" type="password"><br>
                <?php
                if (isset($_GET["confirm_password"]) and $_GET["confirm_password"] != $_GET["create_password"]){
                    echo "<p>Passwords don't match.</p>";
                }
                ?>

                <button type="submit" id="create_button">Create Account</button>
                <button type="reset">Clear</button>
            </form>
        </main>

        <footer>

        </footer>
    </body>
</html>