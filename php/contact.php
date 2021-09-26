<?php

if(!$_POST) exit;


function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$subject     = $_POST['subject'];
$companyNm     = $_POST['companyNm'];
$companyKanaNm     = $_POST['companyKanaNm'];
$address     = $_POST['address'];
$telno     = $_POST['telno'];
$email    = $_POST['email'];
$contactor    = $_POST['contactor'];
$hpLink    = $_POST['hpLink'];
$message = $_POST['message'];

if(trim($subject) == '') {
	echo '<div class="error_message">問い合わせ内容を選択してください。</div>';
	exit();
} 
if(trim($companyNm) == '') {
	echo '<div class="error_message">会社名を入力してください。</div>';
	exit();
}
if(trim($companyKanaNm) == '') {
	echo '<div class="error_message">フリガナを入力してください。</div>';
	exit();
}
if(trim($address) == '') {
	echo '<div class="住所を入力してください。</div>';
	exit();
}
if(trim($telno) == '') {
	echo '<div class="error_message">電話番号を入力してください。</div>';
	exit();
}
if(trim($email) == '') {
	echo '<div class="error_message">メールアドレスを入力してください。</div>';
	exit();
}if(!isEmail($email)) {
	echo '<div class="error_message">メールアドレスのフォーマットが間違い、再度入力してください。</div>';
	exit();
}
if(trim($contactor) == '') {
	echo '<div class="error_message">担当名を入力してください。</div>';
	exit();
}
if(trim($hpLink) == '') {
	echo '<div class="error_message">ホームページもしくはネットショップリングを入力してください。</div>';
	exit();
}
if(trim($message) == '') {
	echo '<div class="error_message">ご要望を入力してください。</div>';
	exit();
}

//if(get_magic_quotes_gpc()) {
	$companyNm = stripslashes($companyNm);
	$companyKanaNm = stripslashes($companyKanaNm);
	$address = stripslashes($address);
	$contactor = stripslashes($contactor);
	$hpLink = stripslashes($hpLink);
	$message = stripslashes($message);
//}


//実際の送信先を設定する
$send_to_mail_address = "king@test.com";

//(1)問い合わせ内容を送信
// メールタイトル
$e_subject = '【ホームページ問い合わせ】 ' . $companyNm . 'からのご要望';


// メール本文
//$e_body = "You have been contacted by $companyNm. Their additional message is as follows." . PHP_EOL . PHP_EOL;
//$e_content = "\"$message\"" . PHP_EOL . PHP_EOL;
//$e_reply = "You can contact $companyNm via email, $email";

$data = date("Y-m-d H:i:s");
$hpLink=wordwrap($hpLink,10,"\r\n");
$message=wordwrap($message,10,"\r\n");

$msg = "
＜＜ホームページからの問い合わせ＞＞


＝＝＝＝＝お問い合わせ内容＝＝＝＝＝
①お問い合わせ内容：$subject
②会社名　　　　　：$companyNm 
③フリガナ　　　　：$companyKanaNm
④住所　　　　　　：$address
⑤電話番号　　　　：$telno
⑥メールアドレス　：$email
⑦メールアドレス　：$contactor
⑧ホームページもしくはネットショッピング：
　　　　　　　　　　$hpLink
⑨ご要望　　　　　：
　　　　　　　　　　$message
⑩お問い合わせ日時：$data
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
";


//$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($send_to_mail_address, $e_subject, $msg, $headers)) {

	// Email has sent successfully, echo a success page.

	echo "<fieldset>";
	echo "<div id='success_page'>";
	echo "<h5>メール送信が成功しました。</h5>";
	echo "<p><strong>$companyNm さま</strong>、ありがとうございました。 </p>";
	echo "</div>";
	echo "</fieldset>";

} else {

	echo 'ERROR!';

}


//(2)自動返信処理
// メールタイトル
$e_subject = '【株式会社ジャトラコンサルティング】メッセージ受信完了のお知らせ';

$data = date("Y-m-d H:i:s");
$hpLink=wordwrap($hpLink,10,"\r\n");
$message=wordwrap($message,10,"\r\n");

$msg = "
$companyNm さま

この度は、株式会社ジャトラコンサルティングへお問い合わせいただきありがとうございます。
下記の内容でメッセージを受け付けました。
後日、担当者より改めてご連絡いたします。

＜＜このメールはシステムによる自動送信です。このメールに直接返信することはできません。＞＞


＝＝＝＝＝お問い合わせ内容＝＝＝＝＝
①お問い合わせ内容：$subject
②会社名　　　　　：$companyNm 
③フリガナ　　　　：$companyKanaNm
④住所　　　　　　：$address
⑤電話番号　　　　：$telno
⑥メールアドレス　：$email
⑦メールアドレス　：$contactor
⑧ホームページもしくはネットショッピング：
　　　　　　　　　　$hpLink
⑨ご要望　　　　　：
　　　　　　　　　　$message
⑩お問い合わせ日時：$data
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


-----------------------------------------------------
株式会社ジャトラコンサルティング
オンラインビジネスチーム
-----------------------------------------------------
";


$headers = "From: $send_to_mail_address" . PHP_EOL;
$headers .= "Reply-To: $send_to_mail_address" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

mail($email, $e_subject, $msg, $headers);