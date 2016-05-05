<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>fgets</title>
</head>
<body>
<?php
/* ------------------------------------------------------------------------
■例 ファイル読み込み
fgets.php

■実例；
$fp = fopen("data/data.txt", "r");       //ファイルを開く
flock($fp, LOCK_SH);                      //ファイルロック
while ($array = fgetcsv( $fp )) {
  $num = count($array);
  for($i=0;$i<$num;$i++){
    echo $array[$i];
  }
}
flock($fp, LOCK_UN);                      //ロック解除
fclose($fp);                              //ファイルを閉じる

------------------------------------------------------------------------ */

//以下に記述してみましょう
$fp = fopen("data/data.txt", "r");       //ファイルを開く
flock($fp, LOCK_SH);                      //ファイルロック
while ($array = fgetcsv( $fp )) {
  $num = count($array);
  for($i=0;$i<$num;$i++){
    echo $array[$i];
  }
}
flock($fp, LOCK_UN);                      //ロック解除
fclose($fp);                              //ファイルを閉じる



?>

</body>
</html>
