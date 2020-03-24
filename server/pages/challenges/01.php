<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 01</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // 想定解："><script>alert()</script>
            }
        ?>
        <form action="./01.php" method="get">
            <input type="text" name="payload" value="<?php print $payload; ?>"><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>