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

?>

<div id="createPage">
<form method="post" action="create_result.php">
<p class="white">みんなに聞きたい質問を入力してください。<br><small>※「,」は使用できません。</small></p>
<p><input type="text" name="userQuestion" size="40"></p>
<p><input type="submit" value="問題を投稿する" class="submitBtn"></p>
</form>
</div>

<div class="linkText">
<a href="index.php"><u>回答ページに戻る</u></a>
<br><br><br>
<a href="qlist.php"><u>問題一覧</u></a>
</div>

<script>
$(document).ready(function(){

//縦スクロール禁止
document.addEventListener('touchmove', function(e) {
  if (window.innerHeight >= document.body.scrollHeight) {
    e.preventDefault();
  }
}, false);

  });
</script>


</body>
</html>
