<!DOCTYPE html>
<html>
    <head>
        <title>Home Index</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="homedex_styles.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <header>
            <img src="homedex_logo.png">
        </header>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="items.php">Items</a></li>
                <?php
                if (isset($_SESSION["username"])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>

        <main>

        </main>

        <footer>

        </footer>
    </body>
</html>