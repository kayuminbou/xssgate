<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challege 02</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // WAF1 scriptタグ禁止
                if(preg_match("/<script/", $payload)){
                    $payload = "";
                }
            }
        ?>
        <form action="./02.php" method="get">
            <input type="text" name="payload" value="<?php print $payload; ?>"><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>