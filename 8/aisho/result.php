<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>診断結果</title>
    <meta name="description" content="診断完了!!">
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
<?php include_once("analyticstracking.php") ?>

<?php
//言語設定、内部エンコーディングを指定する
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");

$me = $_POST["me"];
$zipMail = $_POST["zipMail"];
$you = $_POST["you"];
$name1 = urldecode($_POST["name1"]);
$name2 = urldecode($_POST["name2"]);
$name3 = urldecode($_POST["name3"]);


if($me==""){
  echo '<span style = "color:red"><b><u>診断エラー！<br>自分の名前が未入力です！<br>戻って入力しなおしてください。</u></b></span>';
  exit;
}

if($you==""){
  echo '<span style = "color:red"><b><u>診断エラー！<br>相手のの名前が未入力です！<br>戻って入力しなおしてください。</u></b></span>';
  exit;
}

if($name1 == "" && $name2 == "" && $name3 == ""){
  $kekka = rand(80, 89);
  $kekkaNo = 100 - $kekka;
  $kekkaText = "お二人の相性は良いです。<br>これから仲良くなっていくと思います。<br>相手から話しかけられたり誘われたりしたら、きちんと応えていきましょう。ただし、自分から積極的に押しすぎると失敗します。<br>受動的ではありますが、あくまでも相手からの声を待つのが吉です。";
} else if($you == $name1 || $you == $name2 || $you == $name3){
  $kekka = rand(94, 99);
  $kekkaNo = 100 - $kekka;
  $kekkaText = "お二人の相性は最高です！<br>出会ったばかりであれば積極的に仲良くしていきましょう。今はただの友達と思っている相手でも、相性の良い二人はこれから一緒に過ごすことで、とても仲良くなっていきます。すでに仲良くできてる人は、相手を思いやることでますます愛が深まっていくことでしょう。<br>こんなに相性の良い二人はそうそういません。相手を大事にしてあげてください。";
} else {
  $kekka = rand(11, 19);
  $kekkaNo = 100 - $kekka;
  $kekkaText = "お二人の相性は残念ながら最悪です。<br>今のところ無難に仲良くできていますが、そう遠くない日に性格の不一致、居心地の悪さ等により、お互いが不幸になっていくことでしょう。そして二人はそれをあまり顔に出さないタイプなので、ただただ心が苦しくなっていきます。<br>ただし、これはあくまでも恋愛の相性です。友人としての相性は悪くありません。今仲良くしている人とは、わざわざ疎遠になる必要はなく、これからも末永く今よりも深く仲良くしていけます。相手を傷つけないためには、相手のテリトリーを侵害せず、踏み込みすぎず、大切な友人としての距離感で付き合っていくのが相手にとっての幸せです。";
}

//base64デコード
$mail64 = (str_replace( array('_','-','.'), array('+','=','/'), $zipMail));
$mail = base64_decode($mail64);
//echo $mail;

//日本語メール送信
$to = $mail;
$subject = $me."さんが相性診断した人は…";
$body = $you."さんでした！\n"."相性は".$kekka."%にしておいたよ！\n";
$header = "MIME-Version: 1.0\r\n"
	  . "Content-Transfer-Encoding: 7bit\r\n"
	  . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
	  . "Message-Id: <" . md5(uniqid(microtime())) . "@d4c.sakura.ne.jp>\r\n"
	  . "From:  <app@d4c.sakura.ne.jp>\r\n";

$mflg = mb_send_mail($to,$subject,$body,mb_encode_mimeheader($header),"-f app@d4c.sakura.ne.jp");
if( $mflg==false ){
	echo "<small>診断失敗したかも…</small>";
}else{
	echo "<small>診断完了!!</small>";
}
?>

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
        value: <?php echo json_encode($kekkaNo); ?>,
        color:"rgba(255,255,255,0.2)"
      },
      {
        value : <?php echo json_encode($kekka); ?>,
        color : "#f06"
      }
    ];
var myDoughnut = new Chart(document.getElementById("sample").getContext("2d")).Doughnut(doughnutData);
//円グラフ

function yesDelay() {
  document.getElementById("yesPosition").innerHTML="<b><?php echo json_encode($kekka); ?>%くらい</b>";
}
setTimeout(yesDelay, 2200);

});
</script>

<!-- amazon -->
<a href="http://www.amazon.co.jp/b/ref=assmth201504?_encoding=UTF8&at=shintan666-22&ie=UTF8&lc=jsb&node=3436874051">
  <img class="img-responsive img-responsive-overwrite" src="img/hpc_diet_mtg0501_ad_mb640x100._V305343178_.png" width="100%" height="100%" border="0" alt="ヘルス&ビューティー"></a><img src="http://ir-jp.amazon-adsystem.com/e/ir?t=shintan666-22&l=jsb&o=9" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />

<h3>「<?=$me ?>」さんと<br>「<?=$you ?>」さんの相性は…</h3>
<div id="drowareaContainer">
<canvas id="sample" height="500" width="500"></canvas>
<!-- パーセンテージはjsで遅れて入れる -->
<p id="yesPosition"></p>
</div>
<p>
  <?=$kekkaText ?>
</p>
<br>



<hr>

</body>
</html>