 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>本当によく当たる!!相性診断!!</title>
     <meta name="description" content="2015年大ヒットした、名前を入れるだけで簡単に相性診断できるサイトです。好きな人との相性を占ってみよう！">
     <meta name="keywords" content="占い,診断">
     <meta property="og:title" content="本当によく当たる!!相性診断!!">
     <meta property="og:type" content="website" />
     <meta property="og:image" content="http://d4c.sakura.ne.jp/app/shindan/img/ogp.jpg">
     <meta property="og:site_name" content="本当によく当たる!!相性診断!!">
     <meta property="og:description" content="名前を入れるだけで簡単に相性診断できるサイトです。好きな人との相性を占ってみよう！">

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
   <body>
<?php include_once("analyticstracking.php") ?>

<?php

   $zipMail = $_GET["zipMail"];
   $name1 = $_GET["name1"];
   $name2 = $_GET["name2"];
   $name3 = $_GET["name3"];
   //下はいらない
  //  $encodeMail = urlencode($mail);
   //
  //  if($mail==""){
  //    $mail = '<span style = "color:red">未入力</span>';
  //  }

   //ドットで繋げる
   // echo $name."<br>";
   // echo $mail."<br>";
   // echo $tel."<br>";

?>

<img src="img/top.png" width="100%" height="100%" class="img-responsive img-responsive-overwrite">
<hr>
<!-- amazon -->
<a href="http://www.amazon.co.jp/b/ref=assmth201504?_encoding=UTF8&at=shintan666-22&ie=UTF8&lc=jsb&node=3436874051">
  <img class="img-responsive img-responsive-overwrite" src="img/hpc_diet_mtg0501_ad_mb640x100._V305343178_.png" width="100%" height="100%" border="0" alt="ヘルス&ビューティー"></a><img src="http://ir-jp.amazon-adsystem.com/e/ir?t=shintan666-22&l=jsb&o=9" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />

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
<input type="hidden" name="zipMail" value=<?=$zipMail ?>>
<input type="hidden" name="name1" value=<?=$name1 ?>>
<input type="hidden" name="name2" value=<?=$name2 ?>>
<input type="hidden" name="name3" value=<?=$name3 ?>>
<p><button type="submit">診断してみる！</button></p>
</form>
<br>
<br>
<hr>
 </body>
 </html>
