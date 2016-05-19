 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>秘密</title>
     <meta name="description" content="秘密の診断">
     <meta name="keywords" content="占い,診断">
     <!-- CSS読み込み -->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
     <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
     <!-- mycss -->
     <link href="css/mycss.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
     <script src="https://apis.google.com/js/client.js" type="text/javascript"> </script>

     <!-- ファビコン読み込み -->
     <link rel="shortcut icon" href="img/favicon.ico">
   </head>

<?php

   $mail = $_GET["mail"];
   $name1 = $_GET["name1"];
   $name2 = $_GET["name2"];
   $name3 = $_GET["name3"];


   $encodeMail = urlencode($mail);
   $encodeName1 = urlencode($name1);
   $encodeName2 = urlencode($name2);
   $encodeName3 = urlencode($name3);

   //echo $encodeMail;

//localhost/Gs/kadai/8/aisho/url.php?mail=aaa%40aaa.jp&name1=shintaro&name2=kusakarim&name3=&name4=&name5=

   if($mail==""){
     $mail = '<span style = "color:red"><b><u>未入力です！戻って入力しなおしてください。</u></b></span>';
   }

   //ドットで繋げる
   // echo $name."<br>";
   // echo $mail."<br>";
   // echo $tel."<br>";

$nowUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "&name1=" . $encodeName1 . "&name2=" . $encodeName2 . "&name3=" . $encodeName3;
$indexUrl = str_replace("shindan/url.php?", "shindan/index.php?", $nowUrl);

$apiKey = 'AIzaSyBLi6oHAfLCw6YoNB4Rctjw9jy3A-iNd_M';
$longUrl = $indexUrl;

//短縮URLを作る
$url = 'https://www.googleapis.com/urlshortener/v1/url?key=' . $apiKey;
$params = json_encode(array('longUrl' => $longUrl));

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_POST, 1); //1はtrueでもいい
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res = json_decode(curl_exec($curl));
curl_close($curl);
//var_dump($res);
$shortUrl = $res ->id;
//echo $shortUrl;



?>


<p>診断ページを作成しました!!</p>
<br>
<span id="tinyUrl"><b><?=$shortUrl ?></b></span>
  <span>
  <script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
  <script type="text/javascript">
  new media_line_me.LineButton({"pc":false,"lang":"ja","type":"a","text":"本当によく当たる相性診断!! <?=$shortUrl ?>","withUrl":false});
  </script>
  </span>
<br><br>
<p>
このURLをコピーして、LINE等で<b>気になる人</b>に送ってください。<br>
<b>気になる人</b>が相性診断した結果が、<br>
<?=$mail ?><br>
<small>（あなたのメールアドレス）</small><br>
へ送られます。
</p>
<br><br>
ちなみに相手が見るページはこんな感じだよ！↓↓↓<br>
実際に入力して自分でテストしてみてもOK!! 自分にメールが返ってくるよ!!
<hr>
<p><b>あなたと好きな人の相性診断をするよ！</b></p>
<br>
<p class="text-center"><small>
  <u>2015年 中高生が選ぶ診断ランキング3位！</u><br>
  <u>2015年 よく当たる占いランキング2位！</u><br>
  <u>2015年 超簡単な診断ランキング1位！</u><br>
  <u>2015年 幸せになれる占いランキング2位！</u>
</small></p>

<br>
<p>使い方はとっても簡単！↓のフォームに自分の名前と相手の名前を入れて診断ボタンを押すだけ！</p>

<form method="post" action="result.php">
<p>自分の名前を<b><u>ひらがな</u></b>で入れてね<br><small>（ニックネームでもOK）</small><br>
  <input type="text" name="me" size="36" placeholder="例:だいご" required>
</p>
<p>好きな人の名前を<b><u>ひらがな</u></b>入れてね<br><small>（ニックネームでもOK）</small><br>
  <input type="text" name="you" size="36" placeholder="例:きたがわけいこ" required>
</p>
<input type="hidden" name="mail" value=<?=$mail ?>>
<input type="hidden" name="name1" value=<?=$name1 ?>>
<input type="hidden" name="name2" value=<?=$name2 ?>>
<input type="hidden" name="name3" value=<?=$name3 ?>>
<p><button type="submit">診断してみる！</button></p>
</form>
<br><br><br><br><br><br><br><br><br><br>

 </body>
 </html>
