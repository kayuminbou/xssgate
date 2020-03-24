<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 07</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // HTMLエンティティデコード
                $payload = html_entity_decode($payload);
                // &Tab;や&NewLine;の禁止
                $payload = preg_replace("/(&Tab;|&NewLine;)/i", "", $payload);
                // WAF1 主要タグ禁止(小文字含む)
                if(preg_match("/<(script)/i", $payload)){
                    $payload = "";
                }
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace("/(<[\w\s\/=\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF3 javascriptスキーム禁止
                $payload = preg_replace("/javascript[:&]/i", "", $payload);
                // 想定解：<iframe src=&#106avascript:alert()>
                print "hello, ".$payload."!<br/>";
            }
        ?>
        <form action="./07.php" method="get">
            <input type="text" name="payload" value=""><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>