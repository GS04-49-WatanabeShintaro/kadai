<?php

$name = $_POST["name"];
$mail = $_POST["mail"];
$tel = $_POST["tel"];

if($name==""){
  $name = '<span style = "color:red">未入力</span>';
}
if($mail==""){
  $mail = '<span style = "color:red">未入力</span>';
}
if($tel==""){
  $tel = '<span style = "color:red">未入力</span>';
}

echo date("Y年m月d日 H:i:s");


//ドットで繋げる
// echo $name."<br>";
// echo $mail."<br>";
// echo $tel."<br>";

 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="UTF-8">
   <title>get2</title>
 </head>
 <body>


<h1>
あなたの名前は<?php echo $name; ?>でしょ？
メールが<?php echo $mail; ?>とか、
<?php echo $tel; ?>っていう電話番号まで知ってるんだから。
</h1>

<!-- xss対策するときは表示する時に下記のようにする -->
<?php echo htmlspecialchars($name,ENT_QUOTES); ?>
<!-- でも毎回やると面倒なので関数を書く -->
<?php
function htmlEnc($value) {
        return htmlspecialchars($value,ENT_QUOTES);
}

echo htmlEnc($name);

 ?>

 </body>
 </html>
