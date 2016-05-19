<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>予約フォームテスト</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- CSS読み込み -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- mycss -->
    <link href="css/mycss.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <!-- ファビコン読み込み -->
    <link rel="shortcut icon" href="img/favicon.ico">
  </head>


<body>

<?php
//DB接続
$pdo = new PDO('mysql:dbname=d4c_wg_db;charset=utf8;host=mysql529.db.sakura.ne.jp', 'd4c', 'wi11Garden');

//DBからテーブルを取得
$stmt = $pdo->prepare("SELECT id FROM wg_an_table");
$flag = $stmt->execute();

//取得できたかチェック
$view = "";
$array = array();//配列を作る
if($flag==false){ //$flag=falseが⼊っていればエラー
  $view = "SQLエラー";
} else {
  //Selectデータの数だけ自動でループしてくれる
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $array[] = $result['id']; //idを配列にいれていく
  }
}
$countBooked = count($array); //予約者数

?>

<script>
$(document).ready(function(){
  var countArray = <?php echo json_encode($countBooked); ?>;
  if(countArray >= 6){
      $(".bookMain").addClass("text-center");
      $(".bookMain").html("定員に達したため今回の募集は終了致しました。<br>次回のお申し込みをお待ちしております。<br>なお、募集開始のお知らせはInstagram上でもお知らせ致します。");
  }
});
</script>




<br>
<p class="text-center bookTitle">
  <b>予約フォーム</b>
</p>

<div class="bookMain">
<form method="post" action="result.php" name="form"  onSubmit="return check()">
<table align="center" width="500" cellspacing="5" cellpadding="5" >
  <tr>
    <td>お名前：</td>
    <td><input type="text" name="name" size="36" required></td>
  </tr>
  <tr>
    <td>フリガナ：</td>
    <td><input type="text" name="kana" size="36" required></td>
  </tr>
  <tr>
    <td>メールアドレス：</td>
    <td><input type="email" name="email" size="36" required></td>
  </tr>
  <tr>
    <td>電話番号：</td>
    <td><input type="tel" name="tel" size="36" required></td>
  </tr>
</table>
<br>
<p class="text-center"><button type="submit">予約申込</button></p>
</form>
<div>


</body>
</html>