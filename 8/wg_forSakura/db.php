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
$stmt = $pdo->prepare("SELECT * FROM wg_an_table");
$flag = $stmt->execute();

//取得できたかチェック
$view = "";
if($flag==false){ //$flag=falseが⼊っていればエラー
  $view = "SQLエラー";
} else {
  //Selectデータの数だけ自動でループしてくれる
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //5.表示文字列を作成→変数に追記で代入
  $view .= '<tr>'.
  '<td>'.
  '<form method="post" action="clear.php"><button type="submit" name="id" value="'.
  $result['id'] .
  '">×</button></form>' .
  '</td>' .
  '<td>'. $result['id'] . '</td>' .
  '<td>'. $result['name'] . '</td>' .
  '<td>'. $result['kana'] . '</td>' .
  '<td>'. $result['email'] . '</td>' .
  '<td>'. $result['tel'] . '</td>' .
  '<td>'. $result['indate'] . '</td>' .
  '</tr>';
  }
}

 ?>

 <table class="booked" align="center" width="720" cellspacing="5" cellpadding="5">
 	<tbody>
 		<tr>
 			<td>削除</td>
         <td>ID</td>
 			<td>名前</td>
 			<td>フリガナ</td>
 			<td>メール</td>
 			<td>電話番号</td>
 			<td>予約日時</td>
 		</tr>
    <?=$view ?>
 	</tbody>
 </table>


</body>
</html>