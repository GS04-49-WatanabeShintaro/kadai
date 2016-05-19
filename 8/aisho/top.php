<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>秘密</title>
    <meta name="description" content="秘密">
    <meta name="keywords" content="占い,診断">
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
<img src="img/logo.png" width="50%" height="50%" class="img-responsive img-responsive-overwrite">
<hr>

<p><b>あなたには気になっている人がいますか？</b><br><br>
  このサイトは、<b>あなたの恋愛を応援</b>するために、<b>あなたの気になる人の好きな人</b>をこっそり覗き見る、相性診断を装ったツールを作成します。</b></p>
<br>
<div>
～使い方～<br>
1. 下記の入力フォームに<u>自分の</u>メールアドレスを入力します。<br><small>※このメールアドレスは、<u>気になる人が入力した好きな人の名前</u> がこっそり戻ってくるアドレスです。それ以外に利用されることはなく、当サイトで管理も保管もしません。</small><br>
↓<br>
2. 次のページに出てくるURLをコピーして、LINE等で好きな人に送ります。<br><small>※このURLの相性診断から入力された内容があなたのメールに届きます。必ず届くように迷惑メール設定をご確認ください。自分で見れるメールなら、捨てアドでも構いません。</small><br>
↓<br>
3. 好きな人が相性診断の「相手」項目に入力した人の名前が、あなたのメールアドレスに届きます。<br>
<br><br>
</div>

<!-- <form method="post" action="form_get2.php"> -->
<form method="get" action="url.php">

<p>自分のメールアドレス:<br><input type="email" name="mail" size="36" placeholder="例:aaa@bbb.jp" required></p>
<p><button type="submit">ツールを作成する</button></p>
<br><br>
～オプション～<br>
　下記のフォームに入れた名前と相性診断した場合に相性が良く表示されるように設定します。
他の名前と相性診断された場合には、相性が酷い数字になります。<br>
　自分じゃない異性と相性診断したときに相性を低く表示させることで、自分以外との恋愛の邪魔をします。<br>
<small>※相性を良くしたい自分の名前やニックネームなど、相手が入力する自分の名前が容易に想像できる時にだけ使用してください。例えば「なおこ」と「なおちゃん」は別として扱われます。ここに「なおこ」を入力して、気になる人が「なおちゃん」と入力すると相性が低く表示されてしまいます。</small><br><br>
<p>自分の名前、ニックネームなどを<b><u>ひらがな</u></b>で:<br><small>(任意で最大3つまで。空欄でもOK。)</small>
<br><input type="text" name="name1" size="36" placeholder="（任意）例:しらいしまい"></p>
<p><input type="text" name="name2" size="36" placeholder="（任意）例:まい"></p>
<p><input type="text" name="name3" size="36" placeholder="（任意）例:まいやん"></p>
<p><button type="submit">ツールを作成する</button></p>
<small>※オプション項目が入力されていた場合、上下どちらの「ツールを作成する」ボタンを押してもオプションが有効になります。ご注意ください。</small>
</form>
<br>
<hr>
</body>
</html>
