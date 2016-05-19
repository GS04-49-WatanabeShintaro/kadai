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

    if($name ==""){
      echo "名前が入力されていません";
    } else if($kana =="") {
      echo "フリガナが入力されていません";
    } else if($email =="") {
      echo "メールアドレスが入力されていません";
    } else if($tel ==""){
      echo "電話番号が入力されていません";
    } else {

    //2. DB接続します
    $pdo = new PDO('mysql:dbname=d4c_wg_db;charset=utf8;host=mysql529.db.sakura.ne.jp', 'd4c', 'wi11Garden');

    //３．データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO wg_an_table (id, name, kana, email, tel, indate )VALUES(NULL, :name, :kana, :email, :tel, sysdate())");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':kana', $kana);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':tel', $tel);
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