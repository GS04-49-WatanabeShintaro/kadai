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
    $name = $_POST["name"];
    $kana = $_POST["kana"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $np = $_POST["np"];
    $event_id = $_POST["event_id"];
    $event_day = $_POST["event_day"];

    if($name ==""){
      echo "名前が入力されていません";
    } else if($kana =="") {
      echo "フリガナが入力されていません";
    } else if($email =="") {
      echo "メールアドレスが入力されていません";
    } else if($tel ==""){
      echo "電話番号が入力されていません";
    } else {

      //人数に空きがあるか確認処理
      //イベントテーブルを見に行く
      //DB接続
      $pdo3 = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

      //DBからテーブルを取得
      $stmt3 = $pdo3->prepare("SELECT *  FROM wg_event_table WHERE id = $event_id");
      $flag3 = $stmt3->execute();

      //取得できたかチェックしてこのイベントの各情報を取得。1レコードのみの取得。
      $view3 = "";
      $array = array();//配列を作る
      if($flag3==false){ //$flag=falseが⼊っていればエラー
        $view3 = "SQLエラー";
      } else {
        //Selectデータの数だけ自動でループしてくれる
        while($result3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
          $max_np = $result3["max_np"]; //募集人数
        }
      }

      //予約者数を見に行く
      //DB接続
      $pdo2 = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

      //DBからテーブルを取得、イベントIDがこの日付のものだけ。
      $stmt2 = $pdo2->prepare("SELECT *  FROM wg_booked_table WHERE eventid = $event_id");
      $flag2 = $stmt2->execute();

      //取得できたかチェック
      $view2 = "";
      $db_np = "";
      $cancel = "";
      if($flag2==false){ //$flag=falseが⼊っていればエラー
        $view2 = "SQLエラー";
      } else {
        //Selectデータの数だけ自動でループしてくれる
        while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $db_np += $result2['np']; //参加人数を足す
        $cancel += $result2['cancel'];//キャンセルの数字を足す
        }
      }

      //参加人数からキャンセル数を引いて本当の参加者を出す。キャンセルすると2人参加も1人参加に変わるようにする。
      $fix_np = $db_np - $cancel;

      if( $max_np <= $fix_np ) {
        echo "申し訳ございませんが、このレッスンは満席となりました。";
        exit;
      }


    //登録処理
    //2. DB接続します
    $pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

    //３．データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO wg_booked_table (id, name, kana, email, tel, indate, np, event, eventid )VALUES(NULL, :name, :kana, :email, :tel, sysdate(), :np, :event, :eventid)");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':kana', $kana);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':tel', $tel);
    $stmt->bindValue(':np', $np);
    $stmt->bindValue(':event', $event_day);
    $stmt->bindValue(':eventid', $event_id);
    $status = $stmt->execute();//SQLを実行する。

    //４．データ登録処理後
    if($status==false){
      //Errorの場合$status=falseとなり、エラー表示
      echo "予約に失敗しました。";
      exit;//DBの処理を終わらせる

    }else{
      //５．index.phpへリダイレクト
      //header("Location: index.php");
      echo "予約を受け付けました。";
      exit;

    }
}

  ?>



</body>
</html>