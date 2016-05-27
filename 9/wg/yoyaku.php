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

$id = $_GET["id"];

//イベントテーブルを見に行く
//DB接続
$pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

//DBからテーブルを取得
$stmt = $pdo->prepare("SELECT *  FROM wg_event_table WHERE id = $id");
$flag = $stmt->execute();

//取得できたかチェックしてこのイベントの各情報を取得。1レコードのみの取得。
$view = "";
$array = array();//配列を作る
if($flag==false){ //$flag=falseが⼊っていればエラー
  $view = "SQLエラー";
} else {
  //Selectデータの数だけ自動でループしてくれる
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $event_name = $result["event_name"];
    $place = $result["place"];
    $event_day = $result["event_day"];
    $money = $result["money"];
    $max_np = $result["max_np"]; //募集人数
  }
}

//予約者数を見に行く
//DB接続
$pdo2 = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

//DBからテーブルを取得、イベントIDがこの日付のものだけ。
$stmt2 = $pdo2->prepare("SELECT *  FROM wg_booked_table WHERE eventid = $id");
$flag2 = $stmt2->execute();

//取得できたかチェック
$view2 = "";
$np = "";
$cancel = "";
if($flag2==false){ //$flag=falseが⼊っていればエラー
  $view2 = "SQLエラー";
} else {
  //Selectデータの数だけ自動でループしてくれる
  while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
  $np += $result2['np']; //参加人数を足す
  $cancel += $result2['cancel'];//キャンセルの数字を足す
  }
}

//参加人数からキャンセル数を引いて本当の参加者を出す。キャンセルすると2人参加も1人参加に変わるようにする。
$fix_np = $np - $cancel;

if( $max_np <= $fix_np ) {
  echo "申し訳ございませんが、このレッスンは満席となりました。";
  exit;
}

?>

<script>
$(document).ready(function(){

  }

  //送信前チェック。動かないから後で直す。
  function check(){
  	if(window.confirm('送信してよろしいですか？')){ // 確認ダイアログを表示
  		return true; // 「OK」時は送信を実行
  	}
  	else{ // 「キャンセル」時の処理
  		window.alert('キャンセルされました'); // 警告ダイアログを表示
  		return false; // 送信を中止
  	}
  }

});
</script>


<br>
<p class="text-center bookTitle">
  <b><?=$event_name ?>予約フォーム</b><br><br>
  日時：<?=$event_day ?><br>
  場所：<?=$place ?><br>
  料金：￥<?=$money ?>
</p>

<div class="bookMain">
<form method="post" action="result.php" name="form" onSubmit="return check()">
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
  <tr>
    <td>人数：</td>
    <td>
      <select name="np">
        <option value="1">1人</option>
        <option value="2">2人</option>
      </select>
    </td>
  </tr>
</table>
<input type="hidden" name="event_id" value="<?=$id ?>">
<input type="hidden" name="event_day" value="<?=$event_day ?>">
<br>
<p class="text-center"><button type="submit">予約申込</button></p>
</form>
<div>


</body>
</html>