<?php
//言語設定、内部エンコーディングを指定する
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
 
//日本語メール送信
$to = "送信先メールアドレス";
$subject = "テスト送信";
$body = "テスト送信の本文";
$header = mb_encode_mimeheader("MIME-Version: 1.0\r\n"
	  . "Content-Transfer-Encoding: 7bit\r\n"
	  . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
	  . "Message-Id: <" . md5(uniqid(microtime())) . "@ドメイン名>\r\n"
	  . "From:  <送信者メールアドレス>\r\n");
 
$mflg = mb_send_mail($to,$subject,$body,$header);
if( $mflg==false ){
	echo "Error";
}else{
	echo "送信完了OK（タイムラグがあるよ）";	
}
?>