<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 04</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // WAF1 主要タグ禁止(小文字含む)
                if(preg_match("/<(script)/i", $payload)){
                    $payload = "";
                }
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace("/(<[\w =\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF3 javascriptスキーム禁止
                $payload = preg_replace("/javascript:/i", "", $payload);
                // 想定解：<svg%09onload=alert()>
            }
        ?>
        <form action="./04.php" method="get">
            <input type="text" name="payload" value="<?php print $payload; ?>"><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>