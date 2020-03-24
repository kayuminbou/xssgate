<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 05</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // WAF1 主要タグ禁止(小文字含む)
                if(preg_match("/<(script)/i", $payload)){
                    $payload = "";
                }
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace("/(<[\w\s=\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF3 javascriptスキーム禁止
                $payload = preg_replace("/javascript:/i", "", $payload);
                // WAF4 閉じタグ挿入禁止
                if(preg_match("/>/i", $payload)){
                    $payload = "";
                }
                // 想定解：<svg/onload=alert()//
                print "hello, ".$payload."!<br/>";
            }
        ?>
        <form action="./05.php" method="get">
            <input type="text" name="payload" value=""><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>