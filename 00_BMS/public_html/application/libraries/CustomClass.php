<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customclass{

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        
        $this->CI->load->library('session');
        $this->CI->load->library("pagination");
        
    }
    
    public function CheckAgent($REQUEST){
            $mAgent = array("iPhone", "iPod", "Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony" );
            $chkMobile = false;
            for($i=0; $i<sizeof($mAgent); $i++){
                if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
                    $chkMobile = true;
                    break;
                }
            }

            if($chkMobile){
                $url = $REQUEST;
                print_r("모바일 입니다. 현재 경로 => ".$url);
                $url_segment = explode("/", $url);
                print_r("나눈 후 경로 => ".$url[0].' + '.$url[1]);
                // redirect('/main_m/intro', 'refresh');
                
            }            
        
    }


    // 암호화
    public function Encrypt($str, $secret_key="withBisToursafe!#^^", $secret_iv="withBisToursafe!#^^"){
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return str_replace("=", "", base64_encode(openssl_encrypt($str, "aes-128-cbc", $key, 0, $iv)));
    }


    // 복호화
    public function Decrypt($str, $secret_key="withBisToursafe!#^^", $secret_iv="withBisToursafe!#^^"){
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($str), "aes-128-cbc", $key, 0, $iv);
    }


    // 로그인 비밀번호 단방향 암호화
    public function EncryptLogin($str){
        return hash('sha256', $str);
    }


    // 디버그
	public function Debug($data){
        echo "<pre><div style='width:1024px; background:#000000; margin-top:100px; color:#1ee209;'>"; //  #0f6244;
		print_r($data);
		echo "</div></pre>";
	}


    // 도메인으로 서비스 구분
    public function ServiceTab(){
        $service_tab = "";
        $service_tab = substr($_SERVER['HTTP_HOST'], 0, 3); // crm , erp, bms
        $_SERVER['service_tab'] = $service_tab;
        if(!in_array($service_tab , array('crm','erp','bms'))){
            $service_tab = "bms";
        }
        return $service_tab;
    }

    // 로그인이 이미 되어 있으면 메인 페이지로 이동 
    public function LoginChkNgoMain(){
        if(isset($_SESSION['CRM_ID'])){
            // $service_tab 이 ERP 이면 /salesBreakdown 로 이동 CRM 이면 /customer 로 이동
            if($_SERVER['service_tab'] == "erp"){
                $this->AlertMsgMovePage("이미 로그인 되어 있어서 매출 페이지로 이동 합니다.", "/salesBreakdown");
            }else if($_SERVER['service_tab'] == "crm" || $_SERVER['service_tab'] == "bms"){
                $this->AlertMsgMovePage("이미 로그인 되어 있어서 기본 페이지로 이동 합니다.", "/customer");
            }
            exit;
        }
    }


    // 로그 아웃 처리
    public function Logout(){
        session_destroy();
    }


    // js로 메세지를 띄우고 원하는 페이지로 이동 시킨다.
    public function AlertMsgMovePage($msg, $url){
        echo "<script>alert('".$msg."');location.href='".$url."';</script>";
        exit;
    }


    // js로 메세지를 띄우고 이전 페이지로 이동 시킨다.
    public function AlertMsgBackPage($msg){
        echo "<script>alert('".$msg."');history.back();</script>";
        exit;
    }


    // 핸드폰 번호 정규식 체크
    public function PhoneNumChk($phoneNum){
        $pattern = "/^01[016789]+\-[0-9]{3,4}+\-[0-9]{4}$/";
        if(!preg_match($pattern, $phoneNum)){
            return false;
        }else{
            return true;
        }
    }


    // 이메일 정규식 체크
    public function EmailChk($email){
        // lsm@bis.co.kr , lsm@bis.com, lsm@bis.net , lsm@bis.pe.kr 을 체크가 가능 해야 함
        $pattern = "/^[a-zA-Z0-9]+@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+){1,2}$/";
        if(!preg_match($pattern, $email)){
            return false;
        }else{
            return true;
        }
        
    }


    // 사업자 번호 정규식 체크
    public function BizNumChk($bizNum){
        $pattern = "/^[0-9]{3}-[0-9]{2}-[0-9]{5}$/";
        if(!preg_match($pattern, $bizNum)){
            return false;
        }else{
            return true;
        }
    }


    // 주민번호 정규식 체크
    public function JuminNumChk($juminNum){

        // 입력받은 주민번호가 총 14자리가 아니면 안됨
        if(strlen($juminNum) != 14){
            return false;
        }

        // 주민번호 3번째 수부터  6번째까지 나열된 숫자가 0000 이면 안됨
        // 주민번호 3번째 수부터  4번째까지 나열된 숫자는 월 01~12 이어야 함
        // 주민번호 5번째 수부터  6번째까지 나열된 숫자는 3번째 수부터 4번째의 수가 정수로 바꿨을때 홀수 이면 31 보다 크면 안됨 짝수이면 30보다 크면 안됨
        // 주민번호 - 뒤의 첫번째 수는 1~4 까지의 수만 가능함

        // 주민번호 3번째수부터 6번째까지 나열된 숫자가 0000 이면 안됨
        $zero = substr($juminNum, 2, 4);
        if($zero == "0000"){
            return false;
        }

        // 주민번호 3번째 수부터  4번째까지 나열된 숫자는 월 01~12 이어야 함
        $month = substr($juminNum, 2, 2);
        // 정수로 변환 
        $month = intval($month);        
        if($month < 1 || $month > 12){
            return false;
        }

        // 주민번호 5번째 수부터  6번째까지 나열된 숫자는 3번째 수부터 4번째의 수가 정수로 바꿨을때 홀수 이면 31 보다 크면 안됨 짝수이면 30보다 크면 안됨
        $day = substr($juminNum, 4, 2);
        // 정수로 변환
        $day = intval($day);
        // 3번째 수부터 4번째의 수가 정수로 바꿨을때 홀수 이면 31 보다 크면 안됨 짝수이면 30보다 크면 안됨
        if($month % 2 == 1){
            if($day > 31){
                return false;
            }
        } else {
            // $month 가 2월이면 29일까지만 있음(윤년 때문에 29일로 함)
            if($month == 2){
                if($day > 29){
                    return false;
                }
            }
            if($day > 30){
                return false;
            }
        }

        // 주민번호 - 뒤의 첫번째 수는 성별을 나타내며 1~4 까지의 수만 가능함  // 홀수 남자 , 짝수 여자
        $gender = substr($juminNum, 7, 1);
        // 정수로 변환
        $gender = intval($gender);
        if($gender < 1 || $gender > 4){
            return false;
        }

        $pattern = "/^[0-9]{6}-[0-9]{7}$/";
        if(!preg_match($pattern, $juminNum)){
            return false;
        }else{
            // 최종 적으로 한번 더 검사하는 로직을 태운다.
            // 하이픈 제거 하고 주민번호를 넘긴다.
            $juminNum = str_replace("-", "", $juminNum);
            $return = $this->resnoCheck($juminNum);
            return $return;
        }
    }


    // 사업자 번호 중복 체크
    public function CheckBizNo($bizNo){
        $this->CI->load->model('crm/customer_model');
        $result = $this->CI->customer_model->CheckBizNo($bizNo);
        // 쿼리 확인 하기
        $result['sql'] = $this->CI->db->last_query();
        //echo "SQL : ".$this->CI->db->last_query();
        return $result;
    }


    // 주민 번호 중복 체크
    public function CheckJuminNo($juminNo){
        $this->CI->load->model('crm/customer_model');

        // 암호화 해서 비교 
        $juminNo = $this->Encrypt($juminNo);
        $result = $this->CI->customer_model->CheckJuminNo($juminNo);
        return $result;
    }


    function resnoCheck($resno){
        // 형태 검사: 총 13자리의 숫자, 7번째는 1..4의 값을 가짐         // ereg 는 php 7.0 부터 지원하지 않는다고 한다.        // ereg 대신 preg_match 를 사용하면 된다.
        if(!preg_match("/^\d{2}(((0[1,3,5,7,8]|10|12)((0[1-9])|([1,2][0-9])|30|31))|((0[4,6,9]|11)((0[1-9])|([1,2][0-9])|30))|(02((0[1-9])|([1,2][0-9]))))[9,0,1,2,3,4,5,6,7,8]\d{6}$/",  $resno)){
            // 주민번호 정규식 무결성 검사 신규 추가 
            // 외국인 등록자 추가 
            // 2월 29일 생일자 추가
            return false;
        }
        // 날짜 유효성 검사
        $birthYear = ('2' >= $resno[6]) ? '19' : '20';

        $birthYear .= substr($resno, 0, 2);		
        $birthMonth = substr($resno, 2, 2);
        $birthDate = substr($resno, 4, 2);

        if (!checkdate($birthMonth, $birthDate, $birthYear)){
            echo "\n <br>birthYear = ".$birthYear." , birthMonth = ".$birthMonth." , birthDate = ".$birthDate." , checkdate = ".checkdate($birthMonth, $birthDate, $birthYear);
            return false;
        }

        for ($i = 0; $i < 13; $i++) {
            $buf[$i] = (int) $resno[$i];
        }

        $multipliers = array(2,3,4,5,6,7,8,9,2,3,4,5);
        for ($i = $sum = 0; $i < 12; $i++){
            $sum += ($buf[$i] *= $multipliers[$i]);
            //echo "\n sum = ".$sum." , buf[".$i."] = ".$buf[$i]." , multipliers[".$i."] = ".$multipliers[$i];
        }

        if ((11 - ($sum % 11)) % 10 != $buf[12]){
            return false;
        }
        return true;
    }


    // 다움 주소 검색
    public function SearchAddress(){
        $SearchAddress = "
            <script src=\"//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js\"></script>
            <script>
                //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
                function searchAddressZipcode() {
                    new daum.Postcode({
                        oncomplete: function(data) {
                            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                            // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                            var roadAddr = data.roadAddress; // 도로명 주소 변수
                            var extraRoadAddr = ''; // 참고 항목 변수

                            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                            // 법정동의 경우 마지막 문자가 \"동/로/가\"로 끝난다.
                            if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                                extraRoadAddr += data.bname;
                            }
                            // 건물명이 있고, 공동주택일 경우 추가한다.
                            if(data.buildingName !== '' && data.apartment === 'Y'){
                                extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                            }
                            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                            if(extraRoadAddr !== ''){
                                extraRoadAddr = ' (' + extraRoadAddr + ')';
                            }

                            // 우편번호와 주소 정보를 해당 필드에 넣는다.
                            document.getElementById('postcode').value = data.zonecode;
                            document.getElementById('road_address').value = roadAddr;
                            document.getElementById('jibun_address').value = data.jibunAddress;
                            
                            // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                            if(roadAddr !== ''){
                                document.getElementById('extra_address').value = extraRoadAddr;
                            } else {
                                document.getElementById('extra_address').value = '';
                            }

                            /*
                            var guideTextBox = document.getElementById('guide');
                            // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                            if(data.autoRoadAddress) {
                                var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                                guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                                guideTextBox.style.display = 'block';

                            } else if(data.autoJibunAddress) {
                                var expJibunAddr = data.autoJibunAddress;
                                guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                                guideTextBox.style.display = 'block';
                            } else {
                                guideTextBox.innerHTML = '';
                                guideTextBox.style.display = 'none';
                            }
                            */
                        }
                    }).open();
                }
            </script>
        ";
        return $SearchAddress;
    }

    // 쿼리 출력문 확인
    //function drawQuery($data,$mode=0){
    //    drawTable($data);
    //}


    // 테이블 그리기
    //function drawTable($data){
    function drawQuery($data){
        if (!$data){
            echo "-- No Data --";
            return;
        }
        $data[0] = (array)$data[0];
        $keys = array_keys($data[0]);

        $ret  = "<table class='table table-list' border='1'>";
        $ret .= "<tr><th>".implode("</th><th>",$keys)."</th></tr>";
        foreach ($data as $v){
            $v = array_map("htmlspecialchars", $v);
            $ret .= "<tr><td>".implode("</td><td>",$v)."</td></tr>";
        }
        $ret .= "</table>";
        echo $ret;
    }


    // 보험사 구분 정보 리스트
    public function getInsuranceCompanyCategoryList(){
        $this->CI->load->model('crm/insurancecompany_model');
        $result = $this->CI->insurancecompany_model->getInsuranceCompanyDivisionList();
        return $result;
    }


  	// 로그인 페이지가 아닌 페이지에서 세션이 없으면 로그인 페이지로 이동
	public function loginCheckNGoLoginpage(){
		if(!isset($_SESSION['CRM_ID'])){

            // 해당 페이지를 변수에 담아서 로그인 후 해당 페이지로 이동 시키기 위해
            $url = $_SERVER['REQUEST_URI'];
            // 해당 변수를 암호화해서 세션에 담아서 로그인 후 해당 페이지로 이동 시키기 위해
            $url = $this->Encrypt($url);
            // 이전 페이지 체크 
                        
            // debug 함수로 확인            $this->Debug($_SERVER['REQUEST_URI']);
            
            // 로그인이 필요 합니다 라는 메세지를 띄우고 로그인 페이지로 이동
            // SCPID 는 GET으로 url 암호화 된 것을 넘기기 위한 단순한 변수.. 이름에 딱히 의미는 없는 변수임 ... 일반적인 ID, REFERER .... 이렇게 시작하면 어느페이지로 이동하고 구조를 알수 있어서 그냥 의미없어 보이도록 SCPID로 지었음
            $this->AlertMsgMovePage("로그인이 필요 합니다.", "/login?SCPID=".$url); 
			exit;
		}
	}


    // 숫자로 엑셀열 표시
    function getExcelColumn($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }
    
    
}