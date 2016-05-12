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
<br>
<p class="text-center bookTitle">
  <b>予約フォーム</b>
</p>

<div class="bookMain">
<form method="post" action="result.php" name="form"  onSubmit="return check()">
<table align="center" width="500" cellspacing="5" cellpadding="5" >
  <tr>
    <td>お名前：</td>
    <td><input type="text" name="name" size="36"></td>
  </tr>
  <tr>
    <td>フリガナ：</td>
    <td><input type="text" name="kana" size="36"></td>
  </tr>
  <tr>
    <td>メールアドレス：</td>
    <td><input type="text" name="email" size="36"></td>
  </tr>
  <tr>
    <td>電話番号：</td>
    <td><input type="text" name="tel" size="36"></td>
  </tr>
</table>
<br>
<p class="text-center"><button type="submit">予約申込</button></p>
</form>
<div>


</body>
</html>