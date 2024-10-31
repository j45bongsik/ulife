<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . '/third_party/mailer/Exception.php';
include APPPATH . '/third_party/mailer/PHPMailer.php';
include APPPATH . '/third_party/mailer/SMTP.php';

use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ClassMail extends CI_Controller {

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->load->library("pagination");
        $this->from_id  =   "toursafe_@naver.com";
        $this->pass     =   "a0705029335@";
    }

    public function erp_mailer($mail_from="toursafe_@naver.com", $from_name="사내시스템 알림 입니다", $mail_to, $mail_cc, $to_name, $mail_subject, $mail_content){

        $mail=new PHPMailer(true);
        $mail->IsSMTP();
        try {
            $mail->Host="smtp.naver.com";
            $mail->SMTPAuth=true;
            $mail->Port=465;
            $mail->SMTPSecure="ssl";
            $mail->Username=$this->from_id;
            $mail->Password=$this->pass;
            $mail->CharSet = "UTF-8";
            $mail->SetFrom($this->from_id);
            $mail->AddAddress($mail_to);
            if($mail_cc != "") $mail->addCC($mail_cc);
            $mail->Subject = $mail_subject;
            $mail->MsgHTML($mail_content);
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

}