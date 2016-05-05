<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>あなたは多数派？少数派？</title>
    <meta name="description" content="あなたが普段していることが多数派なのか少数派なのか診断できます。">
    <meta name="keywords" content="占い,診断,多数派,少数派">
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

//フォームのvalueを変数に入れる
$userQuestion = $_POST["userQuestion"];

if(strpos($userQuestion,',') !== FALSE){
  echo "問題文にカンマがあると登録できません。戻って作成しなおしてください。";
} else {
  echo "問題を追加しました！";
  //ファイルに書き込む文字列にする
  $str = $userQuestion.",";

  //ファイルに書き込んでいく
  $file = fopen("data/question.csv","a"); //決まり事。書き込む前にファイルオープン。
  flock($file, LOCK_EX); //書き込み時には他の人の書き込み待ちする。書き込み中はロック。
  fputs($file,$str); //書き込み
  flock($file, LOCK_UN); //ロックを解除
  fclose($file); //ファイルを閉じる
}




?>

<br><br><br><br>

<a href="create.php">問題作成ページに戻る</a>
<br><br>
<a href="index.php">解答ページにいく</a>





<script>

</script>


</body>
</html>
