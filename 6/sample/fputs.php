<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>fputs</title>
</head>
<body>
<?php
/* ------------------------------------------------------------------------
■例 ファイル読み込み
fputs.php

■実例；
$name = $_POST["name"];
$mail = $_POST["mail"];
$age  = $_POST["age"];
$comment = $_POST["comment"];
$str = $name.",".$mail.",".$age.",".$comment."\n";

$file = fopen("data/data.txt","a");
flock($file, LOCK_EX);
fputs($file,$str);
flock($file, LOCK_UN);
fclose($file);

------------------------------------------------------------------------ */

//以下に記述してみましょう
$name = $_POST["name"];
$mail = $_POST["mail"];
$tel  = $_POST["tel"];

//文字列を作成
$str = $name.",".$mail.",".$tel.","."\n";

//ファイル操作
$file = fopen("data/data.txt","a"); //決まり事。書き込む前にファイルオープン。
flock($file, LOCK_EX); //書き込み時には他の人の書き込み待ちする。書き込み中はロック。
fputs($file,$str); //書き込み
flock($file, LOCK_UN); //ロックを解除
fclose($file); //ファイルを閉じる



?>
ファイルの中を確認してください。
</body>
</html>
