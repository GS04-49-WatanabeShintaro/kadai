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
    //1. POSTデータ取得（）
    $event_name = $_POST["event_name"];
    $max_np = $_POST["max_np"];
    $event_day = $_POST["event_day"];
    $place = $_POST["place"];
    $money = $_POST["money"];

    if($max_np ==""){
      echo "募集人数が入力されていません";
    } else if($event_day =="") {
      echo "イベント日時が入力されていません";
    } else if($place =="") {
      echo "開催場所が入力されていません";
    } else if($money ==""){
      echo "金額が入力されていません";
    } else {

    //2. DB接続します
    $pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

    //３．データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO wg_event_table (id, event_name, max_np, event_day, place, money, indate )VALUES(NULL, :event_name, :max_np, :event_day, :place, :money, sysdate())");
    $stmt->bindValue(':event_name', $event_name);
    $stmt->bindValue(':max_np', $max_np);
    $stmt->bindValue(':event_day', $event_day);
    $stmt->bindValue(':place', $place);
    $stmt->bindValue(':money', $money);
    $status = $stmt->execute();//SQLを実行する。

    //４．データ登録処理後
    if($status==false){
      //Errorの場合$status=falseとなり、エラー表示
      echo "イベント作成に失敗しました。";
      exit;//DBの処理を終わらせる

    }else{
      //５．index.phpへリダイレクト
      header("Location: eventdb.php");
      echo "イベントを作成しました。";
      exit;

    }
}

  ?>



</body>
</html>