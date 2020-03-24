<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 09</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // 禁止要素設定
                $elements = array("/<script[\w\s\/]/i", "/<iframe[\w\s\/]/i", "/<frame[\w\s\/]/i", "/<svg[\w\s\/]/i");
                // 禁止属性設定
                $attrs = array("/onchange[\w\s]=/i", "/onclick[\w\s]=/i", "/onerror[\w\s]=/i", "/onfocus[\w\s]=/i", 
                        "/onload[\w\s]=/i", "/onmouseover[\w\s]=/i", "/oncut[\w\s]=/i", "/href[\w\s]=/i");
                // WAF1 主要タグ禁止
                $payload = preg_replace($elements, "", $payload);
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace($attrs, "", $payload);
                // WAF3 その他、単純なイベントハンドラの記述禁止
                $payload = preg_replace("/(<[\w =\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF4 アンパサンドの禁止
                $payload = preg_replace("/[\(\)]/i", "", $payload);
                // 想定解：<details/open/ontoggle=alert``>
                print "hello, ".$payload."!<br/>";
            }
        ?>
        <form action="./09.php" method="get">
            <input type="text" name="payload" value=""><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>