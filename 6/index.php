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
  $fp = @fopen("data/question.csv", "r");  //ファイルを開く
  flock($fp, LOCK_SH);                      //ファイルロック
  while ($array = fgetcsv( $fp )) { //カンマ区切りのcsvをarrayに入れて配列化
        $num = count($array); //配列の数を調べてnumに代入。全問題数。
        echo $num;
        $qID = rand(0, $num-2);//今回の問題をランダムに選択する。問題番号。
        echo $qID;

        echo //jsでlocalstorageにプレイした問題番号を保存
          "<script>
            if(localStorage.getItem('playedNumber') == ''){
              var playedNumber = new Array();
              playedNumber.push($qID);
              localStorage.setItem('playedNumber', JSON.stringify(playedNumber));
              console.log(playedNumber);
            } else {
              var playedNumber =  JSON.parse(localStorage.getItem('playedNumber'));
              playedNumber.push($qID);
              localStorage.setItem('playedNumber', JSON.stringify(playedNumber));
              console.log(playedNumber);
            }
          </script>;";
          //jsで読み込んだlocalstorageでプレイ済み問題に当たらないようにしたかったけど、
          //phpの処理が先なせいで配列を渡せないっぽいので諦めました。

        $qText = $array[$qID];//今回の問題のテキスト
        echo $qText;
  }

  flock($fp, LOCK_UN);            //ロック解除
  fclose($fp);                          //ファイルを閉じる
?>

  <script>
  $(document).ready(function(){

//文字を出現させるコード。コピペ。
        var setElm = $('.split'),
        delaySpeed = 60,
        fadeSpeed = 0;

        setText = setElm.html();

        setElm.css({visibility:'visible'}).children().addBack().contents().each(function(){
            var elmThis = $(this);
            if (this.nodeType == 3) {
                var $this = $(this);
                $this.replaceWith($this.text().replace(/(\S)/g, '<span class="textSplitLoad">$&</span>'));
            }
        });
        $(window).load(function(){
            splitLength = $('.textSplitLoad').length;
            setElm.find('.textSplitLoad').each(function(i){
                splitThis = $(this);
                splitTxt = splitThis.text();
                splitThis.delay(i*(delaySpeed)).css({display:'inline-block',opacity:'0'}).animate({opacity:'1'},fadeSpeed);
            });
            setTimeout(function(){
                    setElm.html(setText);
            },splitLength*delaySpeed+fadeSpeed);
        });
//文字出現終了

//カウントダウン
var time = 16;
function countDown(){
  if (time != 1) {
    time = time - 1;
    $('#cd-text').html('00:' + ('0' + time).slice(-2) );//sliceで右から2桁表示
    var barLength = time / 16 * 100;//プログレスバーの長さ計算
    $('.progress-bar').attr({'style':'width:'+ barLength +'%'});//プログレスバーに長さを代入
    var down = setTimeout(countDown, 1000); //あとで停止するためにdownって変数にsetTimeout入れておく。
  } else {
    clearTimeout(down);//setTimeout終わり
    $('#cd-text').html('TIME OVER');
    $('.progress-bar').attr({'style':'width:0%'});
  }
};
countDown();
//カウントダウン終了

  });
  </script>

<div id="questionPanel" class="qPanel">
  <h4><b>問題</b></h4>
  <p class="split"><?=$qText ?></p>
</div>


<div class="countPanel">
  <div id="cd-text">00:20</div>
    <div class="progress">
      <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width: 100%">
        <span class="sr-only"></span>
      </div>
  </div>
</div>

<div class="yesnoPanel">
<div class="container">
  <div class="row">
    <form method="post" action="result.php">
      <input type="hidden" name="qNumber" value="<?=$qID ?>">
      <button class="yesBtn col-xs-offset-2 col-xs-2 col-sm-offset-2 col-sm-2 col-md-offset-2 col-md-2 col-lg-offset-2 col-lg-2" name="answer" value="yes" type="submit">
        Yes
      </button>
    </form>
    <form method="post" action="result.php">
      <input type="hidden" name="qNumber" value="<?=$qID ?>">
      <button class="noBtn col-xs-offset-4 col-xs-2 col-sm-offset-4 col-sm-2 col-md-offset-4 col-md-2 col-lg-offset-4 col-lg-2" name="answer" value="no" type="submit">
        No
      </button>
    </form>
  </div>
</div>
</div>

<!-- <form method="post" action="result.php" style="color:black">
  <p>お名前:<input type="text" name="name" size="20"></p>
  <p>tesutp:<input type="text" name="test" size="20"></p>
  <button type="submit" name="test" value="yes">ボタンだよ</button>
  <p><input type="submit" value="送信"></p>
</form> -->




</body>
</html>
