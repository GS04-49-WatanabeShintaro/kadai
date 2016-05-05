<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>あなたは多数派？少数派？</title>
    <meta name="description" content="あなたが普段していることが多数派なのか少数派なのか診断できます。">
    <meta name="keywords" content="占い,診断,多数派,少数派">
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

//フォームのvalueを変数に入れる
$answer = $_POST["answer"];
$qNumber =$_POST["qNumber"];

//ファイルに書き込む文字列にする
$str = $answer.",";

//問題ごとのファイル名を作る
$fileSearch = "data/yn".$qNumber.".csv";
echo $fileSearch;

//yes or noをファイルに書き込んでいく
$file = fopen($fileSearch,"a"); //決まり事。書き込む前にファイルオープン。
flock($file, LOCK_EX); //書き込み時には他の人の書き込み待ちする。書き込み中はロック。
fputs($file,$str); //書き込み
flock($file, LOCK_UN); //ロックを解除
fclose($file); //ファイルを閉じる

//yes or noのファイルを読み込む
$fp = @fopen($fileSearch, "r");  //ファイルを開く
flock($fp, LOCK_SH);                      //ファイルロック
while ($array = fgetcsv( $fp )) { //カンマ区切りのcsvをarrayに入れて配列化
      $num = count($array); //配列の数を調べてnumに代入。全回答数。
      $yes = array_keys($array, "yes"); //yesだけを取り出した配列を作る
      $no = array_keys($array, "no"); //noだけを取り出した配列を作る
      $yesko = count($yes); //yesの配列の個数を数える
      $noko = count($no); //noの配列の個数を数える
      $yesPer = substr($yesko / ($num - 1) * 100, 0, 4);//yesのパーセンテージ
      $noPer = 100 - $yesPer;
}

flock($fp, LOCK_UN);            //ロック解除
fclose($fp);                          //ファイルを閉じる

//解いた問題文を読み込む
$fq = @fopen("data/question.csv", "r");  //ファイルを開く
flock($fq, LOCK_SH);                      //ファイルロック
while ($array = fgetcsv( $fq )) { //カンマ区切りのcsvをarrayに入れて配列化
      $qText = $array[$qNumber];//解いた問題文をqTextに入れる
}

flock($fq, LOCK_UN);            //ロック解除
fclose($fq);                          //ファイルを閉じる

?>
<!-- phpの変数をjsの変数にする -->
<script type="text/javascript">
    var yesPer = parseInt(<?php echo json_encode($yesPer); ?>);
    var noPer = parseInt(<?php echo json_encode($noPer); ?>);
    console.log(noPer);
</script>

<br>
あなたの解いた問題は「<?=$qText ?>」です。<br>
あなたの選んだ答えは「<?=$answer ?>」です。<br>
この問題に答えた人数は<?=$num - 1 ?>人で、<br>
Yesの人は<?=$yesko ?>人で、Noの人は<?=$noko ?>人です。<br>
つまり、Yesは<?=$yesPer ?>%で、Noは<?=$noPer ?>%です。<br>
<br>


<div id="drowareaContainer">
<canvas id="sample" height="500" width="500"></canvas>
<!-- パーセンテージはjsで遅れて入れる -->
<p id="yesPosition"></p>
<p id="noPosition"></p>
</div>


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
        value: noPer,
        color:"#f55"
      },
      {
        value : yesPer,
        color : "#55f"
      }
    ];
var myDoughnut = new Chart(document.getElementById("sample").getContext("2d")).Doughnut(doughnutData);
//円グラフ

function yesDelay() {
  document.getElementById("yesPosition").innerHTML="<b>Yes:<?=$yesPer ?>%</b>";
  document.getElementById("noPosition").innerHTML="<b>No:<?=$noPer ?>%</b>";
}
setTimeout(yesDelay, 2500);


});
</script>

<a href ="index.php">次の問題に進む</a>

</body>
</html>
