<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

    // 테스트 메일 발송
	use PHPMailer\PHPMailer\OAuth;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

    
    //$mail_from = "toursafe_@naver.com";
    //$from_name = "사내시스템 알림 입니다";
    //$mail_to = "lsm@bis.co.kr";
    //$to_name = "임초딩";
    //$mail_subject = "테스트 입니다.";
    //$mail_content = "테스트 내용 입니다.";

    //erp_mailer($mail_from,$from_name, $mail_to, $to_name, $mail_subject, $mail_content);

function erp_mailer($mail_from="toursafe_@naver.com", $from_name="사내시스템 알림 입니다" , $mail_to, $to_name, $mail_subject, $mail_content){

    include "../../application/third_party/mailer/Exception.php";
    include "../../application/third_party/mailer/PHPMailer.php";
    include "../../application/third_party/mailer/SMTP.php";

    $to_id=$mail_to;
    $from_id="toursafe_@naver.com";
    $pass="a0705029335@";
    $title=$mail_subject;
    $article=$mail_content;;

    //	$mail = new PHPMailer(true);

    $smtp="smtp.naver.com";
    $mail=new PHPMailer(true);
    $mail->IsSMTP();
    try {
        $mail->Host=$smtp;
        $mail->SMTPAuth=true;
        $mail->Port=465;
        $mail->SMTPSecure="ssl";
        $mail->Username=$from_id;
        $mail->Password=$pass;
        $mail->CharSet = "UTF-8";
        $mail->SetFrom($from_id);
        $mail->AddAddress($to_id);
        $mail->Subject = $title;
        $mail->MsgHTML($article);
        $mail->Send();
    } catch (phpmailerException $e){
        echo $e->errorMessage();
    } catch (Exception $e){
        echo $e->getMessage();
    } catch (Exception $e) {
        $sedn_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        //return $send_msg;
} // end of function erp_mailer
?>
