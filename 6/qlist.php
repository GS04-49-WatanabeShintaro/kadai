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
    <link href="css/qlist.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <!-- ファビコン読み込み -->
    <link rel="shortcut icon" href="img/favicon.ico">
  </head>
<body>


<div class="resultPhpText">
  <a href="create.php" class="white"><u>質問を作成する</u></a>
  <br><br>
  <b>問題一覧</b>
  <br>
<?php
  $fp = @fopen("data/question.csv", "r");  //ファイルを開く
  flock($fp, LOCK_SH);                      //ファイルロック
  while ($array = fgetcsv( $fp )) { //カンマ区切りのcsvをarrayに入れて配列化
        $num = count($array); //配列の数を調べてnumに代入。全問題数。
        for ($i = 0; $i < $num; $i++){
          echo $array[$i].'<br />';
        }
  }

  flock($fp, LOCK_UN);            //ロック解除
  fclose($fp);                          //ファイルを閉じる
?>
</div>



<div class="linkText">
<a href="create.php"><u>質問を作成する</u></a>
<br><br><br><br><br>
</div>

<!-- <form method="post" action="result.php" style="color:black">
  <p>お名前:<input type="text" name="name" size="20"></p>
  <p>tesutp:<input type="text" name="test" size="20"></p>
  <button type="submit" name="test" value="yes">ボタンだよ</button>
  <p><input type="submit" value="送信"></p>
</form> -->




</body>
</html>
