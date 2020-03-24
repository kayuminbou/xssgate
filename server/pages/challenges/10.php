<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>xssgate</title>
    </head>

    <body>
        <h2>Challenge 10</h2>
        <?php
            if (isset($_GET["payload"]) && $_GET["payload"] != "") {
                $payload = $_GET["payload"];
                // 大文字変換
                $payload = strtoupper($payload);
                // HTMLエンティティデコード
                $payload = html_entity_decode($payload);
                // 禁止要素設定
                $elements = array("/<script[\w\s\/]/i", "/<iframe[\w\s\/]/i", "/<frame[\w\s\/]/i", "/<svg[\w\s\/]/i", 
                                "/<object[\w\s\/]/i");
                // 禁止属性設定
                $attrs = array("/onchange[\w\s]=/i", "/onclick[\w\s]=/i", "/onerror[\w\s]=/i", "/onfocus[\w\s]=/i", 
                        "/onload[\w\s]=/i", "/onmouseover[\w\s]=/i", "/oncut[\w\s]=/i", "/href[\w\s]=/i", "/data[\w\s]=/i");
                // WAF1 主要タグ禁止
                $payload = preg_replace($elements, "", $payload);
                // WAF2 イベントハンドラ禁止
                $payload = preg_replace($attrs, "", $payload);
                // WAF3 その他、単純なイベントハンドラの記述禁止
                $payload = preg_replace("/(<[\w =\"\'\`]+)on[\w]+=/i", "$1", $payload);
                // WAF4 セミコロン無しの文字参照を除去
                $payload = preg_replace("/(&#[\w]+)/i", "", $payload);
                // 想定解：<details/open/ontoggle=A='\143\157\156\163\164\162\165\143\164\157\162';B='\141\154\145\162\164()';''[A][A](B)();>
                print "hello, ".$payload."!<br/>";
            }
        ?>
        <form action="./10.php" method="get">
            <input type="text" name="payload" value=""><br/>
            <input type="submit" value="submit"><br/>
        </form>
        <br/>
        <a href="/">top</a>
    </body>
</html>