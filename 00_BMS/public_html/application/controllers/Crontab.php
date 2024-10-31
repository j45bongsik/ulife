<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//defined('BASEPATH') OR exit('No direct script access allowed');

class Crontab extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->model('MemberModel');
        $this->load->model('ContractModel');

        $this->load->library('CustomClass');
        $this->load->library('ClassMail');
    }

    // 보험 종료일이 30일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
    // 1. contract 테이블에서 오늘을 기준으로 보험 종료일이 90,60,45,30,15 일 이내인 상품을 조회한다.
    // 2. 조회된 계약의 내부담당자1 을 조회한다.
    // 3. 내부 담장자의 이메일을 조회한다.
    // 4. 이메일 발송

    public function sendMailToContractListByEndDate30InternalManager(){

        $today = date("Y-m-d");
        $today = strtotime($today);
        // 15일 이후의 날짜 
        $todayAdd15d = strtotime("+15 day", $today);
        $todayAdd30d = strtotime("+30 day", $today);
        $todayAdd45d = strtotime("+45 day", $today);
        $todayAdd60d = strtotime("+60 day", $today);
        $todayAdd90d = strtotime("+90 day", $today);
        
        $todayAdd15d = date("Y-m-d", $todayAdd15d);
        $todayAdd30d = date("Y-m-d", $todayAdd30d);
        $todayAdd45d = date("Y-m-d", $todayAdd45d);
        $todayAdd60d = date("Y-m-d", $todayAdd60d);
        $todayAdd90d = date("Y-m-d", $todayAdd90d);

        //echo "today : " . $today . "<br>";
        //echo "todayAdd15d : " . $todayAdd15d . "<br>";
        //echo "todayAdd30d : " . $todayAdd30d . "<br>";
        //echo "todayAdd45d : " . $todayAdd45d . "<br>";
        //echo "todayAdd60d : " . $todayAdd60d . "<br>";
        //echo "todayAdd90d : " . $todayAdd90d . "<br>";

        // contract 테이블에서 contract_admin1 로 그룹핑하여 내부에 담당자들의 이메일을 조회한다. 
        // 이메일을 조회하여 메일 발송을 해야 하며 해당 메일 주소별로 그룹핑하여 메일 발송을 해야 한다.
        // 담당자1 이 몇명인지 조회한다. getContractAdmin1EmailList 

        $contractAdmin1EmailList = $this->ContractModel->getContractAdmin1EmailList();
        // getContractAdmin1EmailList 에서 실행 된 쿼리문 확인 디버깅 
        // echo "SQL : ".$this->db->last_query();


        //$this->customclass->debug($contractAdmin1EmailList);
        $contractAdminEmail = "";

        
        $mail_content_head1 = "
<!DOCTYPE html>
<html lang=\"ko\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <!-- <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" > -->
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover\">
    <meta name=\"format-detection\" content=\"telephone=no,email=no,address=no\">
    <meta name=\"author\" content=\"투어세이프\">
    <meta name=\"description\" content=\"보험 종료일이 다가오는 상품이 있습니다.\">
    <meta name=\"keywords\" content=\"투어세이프, 만기일안내, 보험종료일\">


    <!-- 웹폰트 적용안되면 삭제해주세요 -->
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap\" rel=\"stylesheet\">

    <link rel=\"stylesheet\" href=\"https://bms.toursafe.co.kr/assets/css/reminder.css\">
</head>
<body>
    <!-- reminder -->
    <div class=\"reminder\">
        <!-- textArea -->
        <div class=\"textArea\">
            <div class=\"descArea\">
                <p>
        ";
        foreach($contractAdmin1EmailList as $contractAdmin1Email){
            $mail_content = "";
            $tomailAdminName = "";
            $contractAdminEmail = $contractAdmin1Email->adminEmail;
            $contractAdminId = $contractAdmin1Email->contract_admin1;
            //echo $contractAdminId . "<br>";

            // 오늘 기준 15일 이내이면서 내부 담당자 아이디로 조회한다.
            $contractList15 = $this->ContractModel->getContractListByEndDateAndAdmin($todayAdd15d, $contractAdminId, 15);
            // 오늘 기준 30일 이내이면서 내부 담당자 아이디로 조회한다.
            $contractList30 = $this->ContractModel->getContractListByEndDateAndAdmin($todayAdd30d, $contractAdminId, 30);
            // 오늘 기준 45일 이내이면서 내부 담당자 아이디로 조회한다.
            $contractList45 = $this->ContractModel->getContractListByEndDateAndAdmin($todayAdd45d, $contractAdminId, 45);
            // 오늘 기준 60일 이내이면서 내부 담당자 아이디로 조회한다.
            $contractList60 = $this->ContractModel->getContractListByEndDateAndAdmin($todayAdd60d, $contractAdminId, 60);
            // 오늘 기준 90일 이내이면서 내부 담당자 아이디로 조회한다.
            $contractList90 = $this->ContractModel->getContractListByEndDateAndAdmin($todayAdd90d, $contractAdminId, 90);

            // 조회된 계약을 하나의 배열로 합친다.
            $contractList = array_merge($contractList15, $contractList30, $contractList45, $contractList60, $contractList90);

            // 디버그 CustomClass->debug
            //$this->customclass->debug($contractList);

            $mail_content_head3 = "
            보험 종료일이 다가오는 상품을 안내해 드립니다. 확인 부탁드립니다.
            </p>
            </div>
        </div>
        <!-- //textArea -->

        <!-- reminderTable -->
        <div class=\"reminderTable\">
            <table>
                <colgroup>
                    <!-- table width 수정은 여기에서 -->
                    <col style=\"width:80px;\">
                    <col style=\"width:300px;\">
                    <col style=\"width:90px;\">
                    <col style=\"width:200px\">
                    <col style=\"width:150px\">
                    <col style=\"width:150px;\">
                    <col style=\"width:130px;\">
                    <col style=\"width:70px;\">
                </colgroup>
                <thead>
                    <tr>
                        <th scope=\"col\">계약번호</th>
                        <th scope=\"col\">계약명</th>
                        <th scope=\"col\">보험종료일</th>
                        <th scope=\"col\">계약자</th>
                        <th scope=\"col\">거래처<br />담당자</th>
                        <th scope=\"col\">거래처<br />이메일</th>
                        <th scope=\"col\">거래처<br />연락처</th>
                        <th scope=\"col\">Dday</th>
                    </tr>
                </thead>
                <tbody>
                ";

            $mail_content = ""; // 실제 메일 내용 // 해당 내용이 있으면 메일 발송

            foreach($contractList as $contract){                
                // $contract->expiration_notice 에 ',' 로 구분하여 배열로 만든다.
                // 해당 배열에 $contract->dday 이 있는지 확인한다.
                // 해당 배열에 $contract->dday 이 없으면 해당 foreach 를 종료한다.
                // 해당 배열에 $contract->dday 이 있으면 해당 foreach 를 진행한다.
                $expiration_notice_arr = explode(",", $contract->expiration_notice);
                if($contract->expiration_notice == "" || !(in_array($contract->dday, $expiration_notice_arr))){                    
                    continue;
                }
                $mail_content .= "
                    <tr>
                        <td>
                            " . $contract->insurance_product_no . "
                        </td>
                        <td>
                            " . $contract->insurance_product_name . "
                        </td>
                        <td>
                            " . $contract->insurance_period_end . "
                        </td>
                        <td>
                            " . $contract->customer_name . "
                        </td>
                        <td>
                            " . $contract->manager_name . "
                            " . $contract->manager_position . "
                        </td>
                        <td>
                            " . $contract->email . "
                        </td>
                        <td>
                            " . $contract->manager_mobile . "
                        </td>
                        <td>
                            " . $contract->dday . "
                        </td>
                    </tr>
                ";

                // $contract->expiration_notice_result
                // 값을 ',' 로 구분하여 배열로 만든다.
                // 해당 배열에 $contract->dday 를 추가한다.
                // 배열을 ',' 로 구분하여 문자열로 만든다.
                // 해당 문자열을 expiration_notice_result 에 업데이트 한다.
                if($contract->expiration_notice_result != ""){
                    $contract->expiration_notice_result = explode(",", $contract->expiration_notice_result);
                } else {
                    $contract->expiration_notice_result = array();
                }

                // 배열에 $contract->dday 를 추가한다.
                array_push($contract->expiration_notice_result, $contract->dday);

                // 배열 중복 제거 
                $contract->expiration_notice_result = implode(",", array_unique($contract->expiration_notice_result));
                // 메일 발송 했다는 가정 하에 메일 발송 했다는 내용을 업데이트 한다.
                $this->ContractModel->updateContractExpirationNoticeResult($contract->no, $contract->expiration_notice_result);
                $tomailAdminName = $contract->adminName1;
                //echo "dday : ".$contract->dday . " 계약에 대한 메일 발송 완료<br>";
            } // end of foreach
            $mail_content_bottom = "</tbody>
            </table>
        </div>
        <!-- //reminderTable -->
    </div>
    <!-- //reminder -->

</body>
</html>";
            // 메일 발송
            $mail_from = "";
            $from_name = "";
            $mail_to = $contractAdminEmail;
            $mail_to = 'es.choi@bis.co.kr'; // 최은선대리님 

            $renewMainAdmin = 'es.choi@bis.co.kr'; // 최은선대리님 
            
            $mail_to = 'lsm@bis.co.kr'; // 나 
            //$mail_to = 'sw.cho@bis.co.kr'; // 조상원과장님
			//$mail_to = 'dnrlekzz@naver.com';
			//$mail_to = 'dykis@bis.co.kr'; // 이은재차장님
			//$mail_to = 'peter.jang@bis.co.kr'; // 장승필부장님

            $mail_cc = "";
            if($mail_to != $renewMainAdmin){
                $mail_cc = $renewMainAdmin;
            }

            $to_name = $contractAdminId;
            $mail_subject = "보험 종료일이 다가오는 상품이 있습니다.";

            $mail_content_head2 = "<span class=\"user\">".$tomailAdminName." </span>님 안녕하세요<br />";
            $mail_content_head = $mail_content_head1.$mail_content_head2.$mail_content_head3;

            $mail_content_txt = $mail_content_head.$mail_content.$mail_content_bottom."<br>감사합니다.";

            // 메일 발송
            if($mail_content != "" && $contractAdminEmail){ // 메일 내용이 있고 메일 주소가 있으면 메일 발송
                $re = $this->classmail->erp_mailer($mail_from, $from_name, $mail_to, $mail_cc, $to_name, $mail_subject, $mail_content_txt);
            }

        } // end of foreach
    } // end of function sendMailToInternalManager
} // end of class Crontab