<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 08</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // 大文字変換
                $payload = strtoupper($payload);
                // WAF1 主要タグ禁止(小文字含む)
                if(preg_match("/<(script)/i", $payload)){
                    $payload = "";
                }
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace("/(<[\w\s\/=\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF3 src属性制限
                $payload = preg_replace("/(<[\w \/\r\n]+)(src|srcdoc|href)=/i", "$1", $payload);
                // 想定解：<iframe%09src=javascript:&#97;&#108;&#101;&#114;&#116;&#40;&#41;>
                print "hello, ".$payload."!<br/>";
            }
        ?>
        <form action="./08.php" method="get">
            <input type="text" name="payload" value=""><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>