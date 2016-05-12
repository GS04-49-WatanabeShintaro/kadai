<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

require("PHPMailerAutoload.php");
$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = '********@gmail.com';  // Gmailのアカウント名
$mailer->Password = '********';  // Gmailのパスワード
$mailer->From     = '********@gmail.com';  // Fromのメールアドレス
$mailer->FromName = mb_encode_mimeheader(mb_convert_encoding("Fromの名前","JIS","UTF-8"));
$mailer->Subject  = mb_encode_mimeheader(mb_convert_encoding("メールのタイトル","JIS","UTF-8"));
$mailer->Body     = mb_convert_encoding("メールの内容です！","JIS","UTF-8");
$mailer->AddAddress('********@********'); // 宛先
$mailer->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if( !$mailer->Send() ){
	echo "送信エラー<br/ >";
	echo "Mailer Error: " . $mailer->ErrorInfo;
} else {
	echo "送信完了";
}
?>