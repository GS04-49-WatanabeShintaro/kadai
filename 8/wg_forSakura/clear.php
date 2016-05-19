<?php
  //1. POSTデータ取得（）
  $id = $_POST["id"];

  //2. DB接続します
  $pdo = new PDO('mysql:dbname=d4c_wg_db;charset=utf8;host=mysql529.db.sakura.ne.jp', 'd4c', 'wi11Garden');

  //３．データ登録SQL作成
  $stmt = $pdo->prepare("DELETE  FROM wg_an_table WHERE id=$id");
  $status = $stmt->execute();//SQLを実行する。

  //４．データ登録処理後
  if($status==false){
    //Errorの場合$status=falseとなり、エラー表示
    echo "SQLエラー";
    exit;//DBの処理を終わらせる

  }else{
    //５．index.phpへリダイレクト
    header("Location: db.php");
    exit;



  }
?>