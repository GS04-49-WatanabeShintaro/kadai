<?php
  //1. POSTデータ取得（）
  $id = $_POST["id"];

  //2. DB接続します
  $pdo = new PDO('mysql:dbname=wg_booked;charset=utf8;host=localhost', 'root', '');

  //３．データ登録SQL作成
  $stmt = $pdo->prepare("DELETE  FROM wg_booked_table WHERE id=$id");
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