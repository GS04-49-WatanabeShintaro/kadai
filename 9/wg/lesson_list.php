<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>レッスン一覧</title>
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

$now = new DateTime();
$nowTime = $now->format('Y-m-d H:i:s');

//DB接続
$pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

//DBからテーブルを取得
$stmt = $pdo->prepare("SELECT * FROM wg_event_table WHERE event_day >= '$nowTime' ORDER BY event_day DESC");
$flag = $stmt->execute();

//取得できたかチェック
$view = "";
if($flag==false){ //$flag=falseが⼊っていればエラー
  $view = "SQLエラー";
} else {
  //Selectデータの数だけ自動でループしてくれる
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //5.表示文字列を作成→変数に追記で代入
  $view .= '<p><a href="yoyaku.php?id='.
  $result["id"].
  '">'.
  $result["event_name"] . '@' . $result['place'] .
  '（' . $result['event_day'] . '）' .
  '￥' . $result['money'] .
  '</a></p>';

  }
}

 ?>

<!-- イベントDBの中身を表示 -->
<br>
<p class="text-center"><b>ただいま開催予定のレッスンはこちらです</b></p>
<br>
<p><?=$view ?></p>


</body>
</html>