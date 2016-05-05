<?php
//***************************************************************************************
//File Read (☆を表示する処理)
//***************************************************************************************
	$file = "./files/data.txt";
	$fp = fopen($file, "r");                    //読込み用 "r" でファイルをオープン
	flock($fp, LOCK_EX);                        //ファイルロック(排他ロック)
	$fp_str = fgets($fp);                       //１行読み込み
	$array_fp = array();                        //配列初期化：一時受け変数を用意
	$array_fp = explode("***" , $fp_str);       //配列に入れる
	flock($fp, LOCK_UN);                        //ファイルロック解除
	fclose($fp);                                //ファイルを閉じる
	
	if(!is_null($array_fp[0]) && !is_null($array_fp[1])) {
		//$array_fp[0] : Total(全ての評価点数を加算した値)
		//$array_fp[1] : Count(評価数)
		$hosi_value = $array_fp[0] / $array_fp[1];   //計算AVERAGE 
		$hosi_echo  = number_format($hosi_value,1);  //現在の評価値表示：小数点(1桁)
		$hosi_obj   = number_format($hosi_echo);     //現在の評価値を整数へ⇒☆を表示させる
		//整数値=☆の数 を表示
		$hj="";
		for($i=0; $i<$hosi_obj; $i++){
			$hj = $hj."★ ";
		}
	}
	
//***************************************************************************************
// File Read(コメントを表示する処理)
//***************************************************************************************
	function read() {
		$file = "./files/comment.txt";
		$fp = fopen($file, "r");        //読込み用 "r" でファイルをオープン
		flock($fp, LOCK_SH);            //ファイルロック(共有ロック)
		$i=0;                           //ループ変数初期化
		while(!feof($fp)) {             //ファイルポインタが終端に到達
			$fp_str = fgets($fp);       //1行取得
			echo $fp_str."<br>";        //表示
			$i++;                       //インクリメント(+1)
		}
		flock($fp, LOCK_UN);            //ファイルロック解除
		fclose($fp);                    //ファイルを閉じる
	}
?>



<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>評価機能</title>
<link href="./css/body.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form name="hyoka" method="post" action="rank_in.php">
  <table width="800"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" class="tdC">この商品を評価してください<br></td>
  </tr>
  <tr>
    <td class="tdA">現在：<span class="style1"><?=$hj?></span>　<?=$hosi_echo?>(5点評価)</td>
    <td class="tdA">評価</td>
    <td class="tdB">
        <select name="hosi">
            <option>選択してください</option>
            <option value="1">★</option>
            <option value="2">★★</option>
            <option value="3">★★★</option>
            <option value="4">★★★★</option>
            <option value="5">★★★★★</option>
        </select>
        <input name="comment" type="text" size="50" maxlength="255">
        <input type="submit" name="Submit" value="送信">
    </td>
</tr>
</table>
<?php
read();
?>
</form>
</body>
</html>
