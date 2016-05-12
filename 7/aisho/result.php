<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>秘密</title>
    <meta name="description" content="秘密">
    <meta name="keywords" content="占い,診断">
    <!-- CSS読み込み -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- mycss -->
    <link href="css/mycss.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/Chart.js"></script>

    <!-- ファビコン読み込み -->
    <link rel="shortcut icon" href="img/favicon.ico">
  </head>
<body>

<?php
//言語設定、内部エンコーディングを指定する
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");

$me = $_POST["me"];
$mail = $_POST["mail"];
$you   = $_POST["you"];

//日本語メール送信
$to = $mail;
$subject = $me."さんが相性診断した人は…";
$body = $you."さんでした！\n";
$header = "MIME-Version: 1.0\r\n"
	  . "Content-Transfer-Encoding: 7bit\r\n"
	  . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
	  . "Message-Id: <" . md5(uniqid(microtime())) . "@rog-e.com>\r\n"
	  . "From:  <app@rog-e.com>\r\n";

$mflg = mb_send_mail($to,$subject,$body,mb_encode_mimeheader($header),"-f app@rog-e.com");
if( $mflg==false ){
	echo "<small>診断失敗したかも…</small>";
}else{
	echo "<small>診断完了!!</small>";
}
?>

<h3>「<?=$me ?>」さんと<br>「<?=$you ?>」さんの相性は…</h3>

<div id="drowareaContainer">
<canvas id="sample" height="500" width="500"></canvas>
<!-- パーセンテージはjsで遅れて入れる -->
<p id="yesPosition"></p>
</div>
<p>
  2人はとても相性が良いようです！<br>
  これからどんどん仲を深めていきましょう！
</p>
<br><br><br>

<script>
$(document).ready(function(){

  //canvasをレスポンシブにする決まり事
  $(window).load(function(){
    container = $('#drowareaContainer');
    canvas = $('#sample');

    function resizeCanvas(){
      canvas.outerWidth(container.width() * 1.0);
      canvas.outerHeight(container.width() * 1.0);  //1.0は適宜変更
    }
    resizeCanvas();
    $(window).on('resize', resizeCanvas);
  });
  //ここまで決まり事


//円グラフ
  var doughnutData = [
      {
        value: 11,
        color:"rgba(255,255,255,0.2)"
      },
      {
        value : 89,
        color : "#f06"
      }
    ];
var myDoughnut = new Chart(document.getElementById("sample").getContext("2d")).Doughnut(doughnutData);
//円グラフ

function yesDelay() {
  document.getElementById("yesPosition").innerHTML="<b>89%くらい</b>";
}
setTimeout(yesDelay, 2200);

});
</script>



</body>
</html>