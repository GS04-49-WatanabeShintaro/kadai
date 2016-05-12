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
   $encodeMail = urlencode($mail);
   //echo $encodeMail;

   if($mail==""){
     $mail = '<span style = "color:red">未入力</span>';
   }

   //ドットで繋げる
   // echo $name."<br>";
   // echo $mail."<br>";
   // echo $tel."<br>";

$nowUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
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
このURLをコピーして、LINE等で友達に送ってください。<br>
友達が相性診断した結果が、<br>
<?=$mail ?><br>
<small>（あなたのメールアドレス）</small><br>
へ送られます。
</p>
<br><br>
ちなみに友達が見るページはこんな感じだよ！↓↓↓
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
<p>自分の名前を入れてね<small>（ニックネームでもOK）</small><br>
  <input type="text" name="me" size="36">
</p>
<p>好きな人の名前を入れてね<small>（ニックネームでもOK）</small><br>
  <input type="text" name="you" size="36">
</p>
<input type="hidden" name="mail" value=<?=$mail ?>>
<p><button type="submit">診断してみる！</button></p>
</form>
<br><br><br><br><br><br><br><br><br><br>

 </body>
 </html>
