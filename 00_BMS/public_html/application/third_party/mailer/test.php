<?php

require_once("inc/PHPMailer/class.phpmailer.php"); 

$mail = new PHPMailer(true); 

// the true param means it will throw exceptions on errors, which we need to catch 

$mail->IsSMTP(); 

// telling the class to use SMTP 
try { 
		// $mail->CharSet = "euc-kr"; 
		// $mail->Encoding = "base64"; 
		// $mail->SMTPDebug = 2;  // enables SMTP debug information (for testing) 
		// $mail->AddReplyTo('name@yourdomain.com', 'First Last'); 
		// $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically 
		// $mail->AddAttachment('images/phpmailer.gif');  // attachment 
		// $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment 

	$mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정 
	$mail->SMTPAuth = true; // SMTP 인증을 사용함 
	$mail->Port = 465; // email 보낼때 사용할 포트를 지정 
	$mail->SMTPSecure = "ssl"; // SSL을 사용함 
	$mail->Username = "test@gmail.com"; // Gmail 계정 
	$mail->Password = "password"; // 패스워드 
	$mail->SetFrom('test@gmail.com', 'TESTER'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능) 
	$mail->AddAddress('you@mailaddress.com', 'YOU'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능) 
	$mail->Subject = 'Email Subject'; // 메일 제목 
	$mail->MsgHTML(file_get_contents('contents.html')); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함) 
	$mail->Send(); 

	echo "Message Sent OK
	\n"; 
} 

catch (phpmailerException $e) { 
	echo $e->errorMessage(); //Pretty error messages from PHPMailer 
} catch (Exception $e) { 
	echo $e->getMessage(); //Boring error messages from anything else! 
}

?>