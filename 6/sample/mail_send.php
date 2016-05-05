<?php
//言語設定、内部エンコーディングを指定する
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
 
$name = $_POST["name"];
$mail = $_POST["mail"];
$qa   = $_POST["qa"];

//日本語メール送信
$to = $mail;
$subject = $name."へのテスト送信";
$body = $name."さん\nメール送信ありがとうございます。\n".$qa;
$header = "MIME-Version: 1.0\r\n"
	  . "Content-Transfer-Encoding: 7bit\r\n"
	  . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
	  . "Message-Id: <" . md5(uniqid(microtime())) . "@gmail.com>\r\n"
	  . "From:  <php.yamazaki@gmail.com>\r\n";
 
$mflg = mb_send_mail($to,$subject,$body,mb_encode_mimeheader($header));
if( $mflg==false ){
	echo "Error";
}else{
	echo "POST受信＆送信完了OK";	
}
?>