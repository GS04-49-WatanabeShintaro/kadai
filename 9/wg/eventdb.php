<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>イベント管理</title>
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
$pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

//DBからテーブルを取得
$stmt = $pdo->prepare("SELECT * FROM wg_event_table ORDER BY event_day DESC");
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
  '<td>'. $result['event_name'] . '</td>' .
  '<td>'. $result['max_np'] . '</td>' .
  '<td>'. $result['event_day'] . '</td>' .
  '<td>'. $result['place'] . '</td>' .
  '<td>'. $result['money'] . '</td>' .
  '<td>'. $result['indate'] . '</td>' .
  '</tr>';
  }
}

 ?>

<!-- 新規イベントの追加 -->
 <br>
 <p class="text-center bookTitle">
   <b>新規イベントの追加</b>
 </p>

 <div class="bookMain">
 <form method="post" action="event_result.php" name="form" onSubmit="return check()">
 <table align="center" width="500" cellspacing="5" cellpadding="5" >
   <tr>
     <td>イベント名(空欄可)：</td>
     <td><input type="text" name="event_name" size="36"></td>
   </tr>
   <tr>
     <td>募集人数(必須)：</td>
     <td>
       <select name="max_np">
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
       </select>
     </td>
   </tr>
   <tr>
     <td>イベント日時(必須)：</td>
     <td><input type="datetime-local" name="event_day" size="36" required></td>
   </tr>
   <tr>
     <td>場所(必須)：</td>
     <td><input type="text" name="place" size="36" required></td>
   </tr>
   <tr>
     <td>金額(必須)<small> ※半角数字</small>：</td>
     <td><input type="text" name="money" size="36" required></td>
   </tr>

 </table>
 <br>
 <p class="text-center"><button type="submit">新規イベント作成</button></p>
 </form>
 <div>
<hr>

<!-- イベントDBの中身を表示 -->
 <table class="booked" align="center" width="720" cellspacing="5" cellpadding="5">
 	<tbody>
 		<tr>
 			<td>削除</td>
         <td>ID</td>
 			<td>イベント名</td>
 			<td>募集人数</td>
 			<td>開催日時</td>
 			<td>場所</td>
        <td>金額</td>
        <td>設定日時</td>
 		</tr>
    <?=$view ?>
 	</tbody>
 </table>


</body>
</html>