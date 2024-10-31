<?php
// 해당 파일 에서는 DB 에서 계약등록에 대한 알람을 보내는 파일입니다.
// 해당 파일은 매일 03시 00분에 실행됩니다.
// 1. 계약등록테이블 ( contract ) 에서 오늘 날짜가 계약 시작날짜와 계약종료날짜 사이에 있는 데이터를 가져온다 
// 2. expiration_notice 에 있는 데이터를 가져와서 특정문자 ',' 로 구분하여 배열( expiration_notice_day )에 담는다. 
// 3. 오늘 날짜에서 배열 들에 포함된 일(day)수 의 합을 구한다. (foreach 문을 사용해서 알림 날짜 수 만큼 돌린다.)
// 4. 3번에서 더해진 날짜와 그 계약종료 날짜(insurance_period_end) 가 같으면 알람을 보내는 파일입니다.
$system_path = "";
define('BASEPATH', $system_path);
// DB 연결
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/config/database.php";

// DB 연결
$conn = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

// DB 연결 확인
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// 디버깅 함수
function debug($data){
    echo "<pre><div style='width:1024px; background:#000000; margin-top:100px; color:#1ee209;'>"; //  #0f6244;
    print_r($data);
    echo "</div></pre>";
}



// 오늘 날짜
$today = date("Y-m-d");

// 오늘 날짜가 계약 시작일과 계약종료 날짜 사이에 있는 데이터를 가져옴
$sql = "SELECT * FROM contract WHERE insurance_period_start <= '$today' AND insurance_period_end >= '$today' and delete_yn = 'N'";
$result = mysqli_query($conn, $sql);

// 오늘 날짜가 계약 시작일과 계약종료 날짜 사이에 있는 데이터가 있을 경우
if (mysqli_num_rows($result) > 0) {
    // 오늘 날짜가 계약 시작일과 계약종료 날짜 사이에 있는 데이터를 배열에 담음
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    debug($data);
    // 오늘 날짜가 계약 시작일과 계약종료 날짜 사이에 있는 데이터의 개수만큼 반복
    foreach ($data as $key => $value) {
        // expiration_notice_day 에 있는 데이터를 가져와서 특정문자 ',' 로 구분하여 배열에 담음
        $expiration_notice_day = explode(",", $value['expiration_notice']);  // $expiration_notice_day 알림 날짜 
        
        // 알림날짜 수 만큼 돌림
        // 알림 날짜별로 오늘 날짜에서 더해진 날짜를 구함 이 날짜가 계약종료 날짜와 같으면 알람을 보냄
        foreach ($expiration_notice_day as $key2 => $value2) {
            // 오늘 날짜에서 알림 날짜를 더함
            $expiration_notice_day_sum = date("Y-m-d", strtotime($today . " + " . $value2 . " day"));
            echo "알림 날짜 :  [ {$value2} ] ".$value['insurance_period_end'] . "<br>" . $expiration_notice_day_sum . "<br>====================================<br>";
            
            // 오늘 날짜에서 알림 날짜를 더한 날짜가 계약종료 날짜와 같으면 알람메일을 보냄
            if ($expiration_notice_day_sum == $value['insurance_period_end']) {
                echo "메일 발송 ";
                // 메일 발송 S
                $mail_from = "dev@bis.co.kr";        // 보내는 사람 메일주소 // 기획팀 그룹메일
                $mail_to = "jsp@bis.co.kr,lsm@bis.co.kr";           // 받는 사람 메일주소 (어드민 계정에서 추가 되는 사람의 메일 주소) 
                $mail_to = "01117174995@naver.com";           // 받는 사람 메일주소 (어드민 계정에서 추가 되는 사람의 메일 주소) 
                //$Bcc = ""; // 숨은참조 메일 발송 확인용 

                $Headers = "MIME-Version: 1.0\r\n";
                $Headers .= "Content-Type: text/html; charset=euc-kr; format=flowed\r\n";
                $Headers .= "Content-Transfer-Encoding: 8bit\r\n"; 
                $Headers .= "from: BIS 관리자<$mail_from>" . "\r\n";
                //$Headers .= "Cc: $mail_from" . "\r\n";
                $Headers .= "Bcc: $Bcc" . "\r\n"; 

                //$Headers .= "Content-Type: text/html; charset=UTF-8";

                $subject = '=?UTF-8?B?'.base64_encode("[확인]보험계약 만료일이 다가오는 건들이 있습니다. ").'?=';

                $contents = "
                담당자님 관계자님 안녕하세요. </br></br>

                보험 관련 종료일이 {$value2}일 남아서 알림 메일 전달 드립니다 </br></br>

                보험 명 : {$value['insurance_name']} </br>
                보험 종료일 : {$value['insurance_period_end']} </br></br>

                본 메일은 발신전용 메일 입니다. </br></br>

                자세한 내용은 관리자 페이지에서 확인 부탁드립니다.</br></br>";

                $Headers = iconv("UTF-8","EUC-KR", $Headers);
                $contents = iconv("UTF-8","EUC-KR", $contents);

                mail($mail_to,$subject,$contents,$Headers);
                // 메일 발송 E
                
            }
        }

        // 3번에서 더해진 날짜와 그 계약종료 날짜가 같으면 알람을 보냄
        if ($expiration_notice_day_sum == $value['insurance_period_end']) {
            // 계약등록테이블 ( contract ) 에서 해당 계약번호에 대한 데이터를 가져옴
            $sql2 = "SELECT * FROM contract WHERE contract_no = '" . $value['contract_no'] . "'";
            $result2 = mysqli_query($conn, $sql2);

            // 계약등록테이블 ( contract ) 에서 해당 계약번호에 대한 데이터가 있을 경우
            if (mysqli_num_rows($result2) > 0) {
                // 계약등록테이블 ( contract ) 에서 해당 계약번호에 대한 데이터를 배열에 담음
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $data2[] = $row2;
                }

                // 계약등록테이블 ( contract ) 에서 해당 계약번호에 대한 데이터의 개수만큼 반복
            }
        }
    }

} else {
    echo "0 results";
}



