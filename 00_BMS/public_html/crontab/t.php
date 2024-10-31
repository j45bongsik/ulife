<?php
// 보험사 1차 가공분 업로드 자료를 가져와서 각 항목별로 합산을 한뒤 
// 보험사별, 상품별, 해외 국내별, 장기 단기별 토탈보험료를 가져와서 
// 각 항목별로 합산 및 조건별 수수료와 성과급을 계산하여 보여준다.
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
$sql = "
        SELECT 
            b.catnm, a.insurance_company, a.product_name, a.division, a.stay_duration, SUM(premium) AS total_premium, a.product_number
        FROM 
            insurance_company_first_processed_data AS a 
            INNER JOIN insurance_company_category AS `b` ON a.insurance_company = b.catno
        WHERE 
            1=1
            /* and use_year_month = '2024-04' */
        GROUP BY a.insurance_company, a.product_name, a.division, a.stay_duration, a.product_number
";
$result = mysqli_query($conn, $sql);
//개수 확인
debug(mysqli_num_rows($result));

// 결과값 data 배열에 담아서 저장
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

debug($data);

// 보험사별, 상품별, 해외 국내별, 장기 단기별 토탈보험료를 가져와서 각 항목별로 합산을 데이터를 가져와서 각 항목별로 합산 및 조건별 수수료와 성과급을 계산하여 보여준다.
// 조건은 아래와 같다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.6억이 넘는 경우 보험사 수수료가 45%를(30%+15%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.2억 초과 1.6억 이하 인경우 보험사 수수료가 44%를(30%+14%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 8천만 초과 1.2억 이하 인경우 보험사 수수료가 43%를(30%+13%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 6천만 초과 8천만 이하 인경우 보험사 수수료가 42%를(30%+12%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 4천만 초과 6천만 이하 인경우 보험사 수수료가 41%를(30%+11%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 2천만 초과 4천만 이하 인경우 보험사 수수료가 40%를(30%+10%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.5천만 초과 2천만 이하 인경우 보험사 수수료가 39%를(30%+9%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 800만 초과 1.5천만 이하 인경우 보험사 수수료가 38%를(30%+8%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 초과 800만 이하 인경우 보험사 수수료가 37%를(30%+7%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 이하 인경우 보험사 수수료가 36%를(30%+6%) 곱해서 수수료를 계산한다.

// 보험사가 메리츠화재 인경우 '해외장기체류보험(15680)' 인경우 기본 25% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '전문직해외장기체류보험(15780)' 인경우 기본 24.5% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외단기체류보험(15880)[팜투어,허니문]' 인경우 기본 30% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외실손의료보험(15540)' 인경우 기본 45% 수수료 + 5% 시책을 적용 해서 총 50% 를 적용한다.
//                                               -- 보험료가 2000만원 미만인 경우 50% (45+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 1억원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 1억원 이상인경우 55% (50+5) 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '국내여행보험(15920)' 인경우 기본 40% 수수료 + 5% 시책을 적용한다.
//                                               -- 보험료가 1000만원 미만인 경우 45% (40+5) 수수료를 적용한다.
//                                               -- 보험료가 1000만원 이상이면서 2000만원 미만인경우 47% (42+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 3000만원 미만인경우 49% (44+5) 수수료를 적용한다.
//                                               -- 보험료가 3000만원 이상이면서 4000만원 미만인경우 51% (46+5) 수수료를 적용한다.
//                                               -- 보험료가 4000만원 이상이면서 5000만원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 5000만원 이상인경우 55% (50+5) 수수료를 적용한다.
// 이와 별도로 성과급이 주어지는 케이스는 다음과 같다.
// 해외실손의료보험(15540)와 전문직해외장기체류보험(15780) 를 제외한 
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 100만원 이상인 경우 합산금액 * 1.5% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 300만원 이상인 경우 합산금액 * 2.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 500만원 이상인 경우 합산금액 * 2.50% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 1000만원 이상인 경우 합산금액 * 3.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 5000만원 이상인 경우 합산금액 * 4.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 10000만원 이상인 경우 합산금액 * 4.50% 를 성과급으로 준다.

// MG는 국내는 없음 해외 패키지만 있음
// MG는 해외기본 단기 30% 수수료
// MG는 해외성과 단기 1백만원 이상 2.0% 성과급
// MG는 해외성과 단기 5백만원 이상 2.5% 성과급
// MG는 해외성과 단기 1천만원 이상 3.0% 성과급
// MG는 해외성과 단기 2천만원 이상 3.5% 성과급
// MG는 해외성과 단기 4천만원 이상 4.0% 성과급
// MG는 해외성과 단기 7천만원 이상 4.5% 성과급
// MG는 해외성과 단기 1억원 이상 5.0% 성과급

// DB는 국내기본 단기 20% 수수료
// DB는 해외기본 단기 10% 수수료
// DB는 해외기본 장기 22% 수수료
// DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
// DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
// DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
// DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
// DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
// DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
// DB는 국내해외성과 단기 1억 이상 4.5% 성과급

// 삼성화재는 국내기본 단기 24% 수수료
// 삼성화재는 해외기본 단기 5% 수수료
// 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급
// 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급
// 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급
// 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급
// 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급
// 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

// 현대는 국내기본 단기 10% 수수료
// 현대는 해외기본 단기 30% 수수료
// 현대는 해외기본 장기 30% 수수료
// 현대는 해외기본 장기단체 28% 수수료

// 한화는 국내기본 단기 24% 수수료
// 한화는 해외기본 단기 30% 수수료
// 한화는 해외기본 장기 30% 수수료
// 한화는 해외기본 장기단체상품이 없음

// 어시스트카드는 국내기본 단기 수수료가 없음
// 어시스트카드는 해외기본 단기 20% 수수료
// 어시스트카드는 해외기본 장기 20% 수수료
// 어시스트카드는 해외기본 장기단체상품이 없음

/*

// 구분, 체류기간인 경우 enum 으로 처리한다. D, O / L, S 미리 배열로 만들어 놓는다 
        $enumArr = array(
            '해외' => 'O',
            '국내' => 'D',
            '장기' => 'L',
            '단기' => 'S'
        );

        // 보험사 명을 보험사 코드로 변경
        $insuranceCompanyArr = array(
            '삼성생명' => '001001',
            '한화생명' => '001002',
            '메리츠' => '002001',
            '메리츠화재' => '002001',
            'CHUBB' => '002002',
            'DB손해보험' => '002003',
            '삼성화재' => '002004',
            '현대해상' => '002005',
            'AIG손해보험' => '002006',
            'KB손해보험' => '002007',
            '롯데손해보험' => '002008',
            'MG손해보험' => '002009',
            '한화손해보험' => '002010',
            '흥국화재' => '002011',
            '어시스트카드' => '002012'
        );


        
        보험사 데이터 1차 가공 분 업로드 자료 테이블 

        CREATE TABLE `insurance_company_first_processed_data` (
  `no` int(11) NOT NULL,
  `code` varchar(35) NOT NULL DEFAULT '' COMMENT 't_excel_upload_history 테이블의 업로드코드',
  `use_year_month` varchar(7) NOT NULL DEFAULT '' COMMENT '엑셀파일에 들어간 청약일 년도와 월 ''YYYY-MM'' 부분',
  `subscription_date` date DEFAULT NULL COMMENT '청약일',
  `insurance_company` varchar(50) NOT NULL DEFAULT '' COMMENT '보험사코드',
  `account` varchar(200) NOT NULL DEFAULT '' COMMENT '거래처 (추후에 상황 보고 줄여야 함)',
  `product_number` varchar(50) NOT NULL DEFAULT '' COMMENT '보험상품번호',
  `product_name` varchar(100) NOT NULL DEFAULT '' COMMENT '상품명',
  `division` enum('D','O') NOT NULL DEFAULT 'D' COMMENT '구분 D 국내/ O 해외  domestic / Overseas',
  `stay_duration` enum('L','S') NOT NULL DEFAULT 'S' COMMENT '체류기간 ''L'',''S'' 장기 long time / 단기 short-term',
  `commission_rate` varchar(5) NOT NULL DEFAULT '' COMMENT '수수료율',
  `premium` int(11) NOT NULL DEFAULT 0 COMMENT '보험료',
  `charge` int(11) NOT NULL DEFAULT 0 COMMENT '수수료',
  `commission` int(11) NOT NULL DEFAULT 0 COMMENT '커미션',
  `revenue` int(10) unsigned zerofill NOT NULL DEFAULT 0000000000 COMMENT '수익',
  `channel` enum('B2B','B2B2C','B2C','M') NOT NULL DEFAULT 'B2B' COMMENT '채널 ''B2B'',''B2B2C'',''B2C'',''M'' ( M : 모바일 ) ',
  `del_yn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부 (Y 삭제 / N삭제 안함)',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  PRIMARY KEY (`no`),
  KEY `code` (`code`),
  KEY `use_year_month` (`use_year_month`),
  KEY `insurance_company` (`insurance_company`),
  KEY `division` (`division`),
  KEY `stay_duration` (`stay_duration`),
  KEY `channel` (`channel`),
  KEY `account` (`account`),
  KEY `product_name` (`product_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='보험사 데이터 1차 가공 분 업로드 자료.'




*/

$ChubbTotalSum = 0;
$ChubbTotalArr = array();
$CommissionArr = array();
$MGCommission = array();
$DBCommission = array();
$SamsungCommission = array();
$ChubbCommission = array();
$HyundaiCommission = array();
$HanwhaCommission = array();
$AssistcardCommission = array();
$MeritzCommission = array();
$MeritzBonus = array();

foreach($data as $key => $value){
    $charge_rate = 0.000;
/*
    debug($value);
    $value['catnm']
    $value['insurance_company']
    $value['product_name']
    $value['division']
    $value['stay_duration']
    $value['total_premium']
    $value['product_number']
*/
// insurance_company 보험사 코드

    if($value['insurance_company'] == '002001'){
        // 보험사가 메리츠화재 인경우 '해외장기체류보험(15680)' 인경우 기본 25% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '전문직해외장기체류보험(15780)' 인경우 기본 24.5% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '해외단기체류보험(15880)[팜투어,허니문]' 인경우 기본 30% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '해외실손의료보험(15540)' 인경우 기본 45% 수수료 + 5% 시책을 적용 해서 총 50% 를 적용한다.
        //                                               -- 보험료가 2000만원 미만인 경우 50% (45+5) 수수료를 적용한다.
        //                                               -- 보험료가 2000만원 이상이면서 1억원 미만인경우 53% (48+5) 수수료를 적용한다.
        //                                               -- 보험료가 1억원 이상인경우 55% (50+5) 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '국내여행보험(15920)' 인경우 기본 40% 수수료 + 5% 시책을 적용한다.
        //                                               -- 보험료가 1000만원 미만인 경우 45% (40+5) 수수료를 적용한다.
        //                                               -- 보험료가 1000만원 이상이면서 2000만원 미만인경우 47% (42+5) 수수료를 적용한다.
        //                                               -- 보험료가 2000만원 이상이면서 3000만원 미만인경우 49% (44+5) 수수료를 적용한다.
        //                                               -- 보험료가 3000만원 이상이면서 4000만원 미만인경우 51% (46+5) 수수료를 적용한다.
        //                                               -- 보험료가 4000만원 이상이면서 5000만원 미만인경우 53% (48+5) 수수료를 적용한다.
        //                                               -- 보험료가 5000만원 이상인경우 55% (50+5) 수수료를 적용한다.
        
        
        
        
        
        
        
        
        // 성과급(Bonus)  계산 

        // 이와 별도로 성과급이 주어지는 케이스는 다음과 같다. 
        // 해외실손의료보험(15540)와 전문직해외장기체류보험(15780) 를 제외한 
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 100만원 이상인 경우 합산금액 * 1.5% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 300만원 이상인 경우 합산금액 * 2.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 500만원 이상인 경우 합산금액 * 2.50% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 1000만원 이상인 경우 합산금액 * 3.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 5000만원 이상인 경우 합산금액 * 4.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 10000만원 이상인 경우 합산금액 * 4.50% 를 성과급으로 준다.
        // $MeritzBonus 배열에 array_push로 담아서 합산 한다음 계산한다.

    } else if($value['insurance_company'] == '002002'){ // 보험사가 CHUBB 인 경우
        // Chubb 인경우 배열에 따로 토탈값만 담아서 합산을 한다.
        $ChubbTotalArr[] = $value['total_premium'];
    } else if($value['insurance_company'] == '002009' && $value['division'] == 'O'){        // MG 이면서 해외인경우
        // MG는 국내는 없음 해외 패키지만 있음
        // MG는 해외기본 단기 30% 수수료
        // MG는 해외성과 단기 1백만원 이상 2.0% 성과급
        // MG는 해외성과 단기 5백만원 이상 2.5% 성과급
        // MG는 해외성과 단기 1천만원 이상 3.0% 성과급
        // MG는 해외성과 단기 2천만원 이상 3.5% 성과급
        // MG는 해외성과 단기 4천만원 이상 4.0% 성과급
        // MG는 해외성과 단기 7천만원 이상 4.5% 성과급
        // MG는 해외성과 단기 1억원 이상 5.0% 성과급

        // MG는 해외기본 단기 30% 수수료
        
        // 추가 성과급 계산
        if($value['total_premium'] >= 1000000){
            // MG는 해외성과 단기 1백만원 이상 2.0% 성과급 ( 30%+2% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.32;
        } else if($value['total_premium'] >= 5000000 && $value['total_premium'] < 10000000){
            // MG는 해외성과 단기 5백만원 이상 2.5% 성과급 ( 30%+2.5% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.325;
        } else if($value['total_premium'] >= 10000000 && $value['total_premium'] < 20000000){
            // MG는 해외성과 단기 1천만원 이상 3.0% 성과급 ( 30%+3% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.33;
        } else if($value['total_premium'] >= 20000000 && $value['total_premium'] < 40000000){
            // MG는 해외성과 단기 2천만원 이상 3.5% 성과급 ( 30%+3.5% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.335;
        } else if($value['total_premium'] >= 40000000 && $value['total_premium'] < 70000000){
            // MG는 해외성과 단기 4천만원 이상 4.0% 성과급 ( 30%+4% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.34;
        } else if($value['total_premium'] >= 70000000 && $value['total_premium'] < 100000000){
            // MG는 해외성과 단기 7천만원 이상 4.5% 성과급 ( 30%+4.5% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.345;
        } else if($value['total_premium'] >= 100000000){
            // MG는 해외성과 단기 1억원 이상 5.0% 성과급 ( 30%+5% )
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.35;
        } else {
            // MG는 해외기본 단기 30% 수수료
            // $MGCommission 배열에 array push 해서담는다.
            $charge_rate = 0.30;
        }

        // 수수료율을 곱해서 수수료를 계산한다. 그리고 MGCommission 배열에 담는다.
        array_push($MGCommission, $value['total_premium'] * $charge_rate);
        // database 에 해당 데이터들의 charge_rate 를 업데이트 한다.

        // $MGCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['MG'] = array_sum($MGCommission);

    } elseif($value['insurance_company'] == '002003'){  // DB손해보험
        // DB는 국내기본 단기 20% 수수료
        // DB는 해외기본 단기 10% 수수료
        // DB는 해외기본 장기 22% 수수료
        // DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
        // DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
        // DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
        // DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
        // DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
        // DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
        // DB는 국내해외성과 단기 1억 이상 4.5% 성과급
        
        // DB는 국내기본 단기 20% 수수료
        if($value['division'] == 'D'){
            // 국내인경우
            // 추가 성과급 계산
            if($value['total_premium'] > 3000000 && $value['total_premium'] <= 5000000){
                // DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.21;
            } else if($value['total_premium'] > 5000000 && $value['total_premium'] <= 10000000){
                // DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.22;
            } else if($value['total_premium'] > 10000000 && $value['total_premium'] <= 20000000){
                // DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.225;
            } else if($value['total_premium'] > 20000000 && $value['total_premium'] <= 30000000){
                // DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.23;
            } else if($value['total_premium'] > 30000000 && $value['total_premium'] <= 50000000){
                // DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.235;
            } else if($value['total_premium'] > 50000000){
                // DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.24;
            } else {
                // DB는 국내기본 단기 20% 수수료
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.20;
            }

            array_push($DBCommission, $value['total_premium'] * $charge_rate);
            // database 에 해당 데이터들의 charge_rate 를 업데이트 한다.

        } else if($value['division'] == 'O' && $value['stay_duration'] == 'S'){
            // 해외인경우
            // DB는 해외기본 단기 10% 수수료에 성과급을 추가한다.
            // DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급 => 11%
            // DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급 => 12%
            // DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급 => 12.5%
            // DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급 => 13%
            // DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급 => 13.5%
            // DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급 => 14%
            
            // 추가 성과급 계산
            if($value['total_premium'] > 3000000 && $value['total_premium'] <= 5000000){
                // DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.11;
            } else if($value['total_premium'] > 5000000 && $value['total_premium'] <= 10000000){
                // DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.12;
            } else if($value['total_premium'] > 10000000 && $value['total_premium'] <= 20000000){
                // DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.125;
            } else if($value['total_premium'] > 20000000 && $value['total_premium'] <= 30000000){
                // DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.13;
            } else if($value['total_premium'] > 30000000 && $value['total_premium'] <= 50000000){
                // DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.135;
            } else if($value['total_premium'] > 50000000){
                // DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.14;
            } else {
                // DB는 해외기본 단기 10% 수수료
                // $DBCommission 배열에 array push 해서담는다.
                $charge_rate = 0.10;
            }

            array_push($DBCommission, $value['total_premium'] * $charge_rate);
            // database 에 해당 데이터들의 charge_rate 를 업데이트 한다.

        } else if($value['division'] == 'O' && $value['stay_duration'] == 'L'){
            // 해외인경우
            // DB는 해외기본 장기 22% 수수료
            // $DBCommission 배열에 array push 해서담는다.
            $charge_rate = 0.22;
            array_push($DBCommission, $value['total_premium'] * $charge_rate);

            // database 에 해당 데이터들의 charge_rate 를 업데이트 한다. 

        }

        
        // $DBCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['DB'] = array_sum($DBCommission);

    } elseif($value['insurance_company'] == '002004'){  // 삼성화재인경우
        // 삼성화재는 국내기본 단기 24% 수수료
        // 삼성화재는 해외기본 단기 5% 수수료
        // 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급
        // 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급
        // 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급
        // 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급
        // 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급
        // 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

        // 삼성화재는 국내기본 단기 24% 수수료
        if($value['division'] == 'D' && $value['stay_duration'] == 'S'){
            // 국내인경우
            // 삼성화재는 국내기본 단기 24% 수수료
            // $SamsungCommission 배열에 array push 해서담는다.
            $charge_rate = 0.24;
            array_push($SamsungCommission, $value['total_premium'] * $charge_rate);
            // database 에 해당 데이터들의 charge_rate 를 업데이트 한다.

        } else if($value['division'] == 'O' && $value['stay_duration'] == 'S'){
            // 해외인경우
            
            // 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급 => 7%
            // 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급 => 7.5%
            // 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급 => 8%
            // 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급 => 9%
            // 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급 => 9.5%
            // 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)
            // 삼성화재는 해외기본 단기 5% 수수료에 성과급을 추가한다.

            // 삼성화재는 해외기본 단기 5% 수수료
            
            // 추가 성과급 계산
            if($value['total_premium'] >= 3000000 && $value['total_premium'] < 5000000){
                // 삼성화재는 해외성과 단기
                // 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급 => 7%
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.07;
                
            } else if($value['total_premium'] >= 5000000 && $value['total_premium'] < 10000000){
                // 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급 => 7.5%
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.075;
                
            } else if($value['total_premium'] >= 10000000 && $value['total_premium'] < 30000000){
                // 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급 => 8%
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.08;
            
            } else if($value['total_premium'] >= 30000000 && $value['total_premium'] < 50000000){
                // 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급 => 9%
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.09;
                
            } else if($value['total_premium'] >= 50000000 && $value['total_premium'] < 100000000){
                // 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급 => 9.5%
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.095;
                
            } else if($value['total_premium'] >= 100000000){
                // 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

                $charge_rate = 0.10;
                
                $SamsungCommissionTmp = $value['total_premium'] * $charge_rate;
                if($SamsungCommissionTmp >= 1000000){
                    $SamsungCommissionTmp = 1000000;
                }
                // $SamsungCommission 배열에 array push 해서담는다.
                array_push($SamsungCommission, $SamsungCommissionTmp);

                // B2B, B2B2C 채널별로 보여줄때는 보험료만 보여주지 따로 수수료 까지는 안보여 주기로 함.. 보여주게 되면 보험사별 합산 금액에서 1억원 이상 10%에서 1000만원 까지만 수수료가 주어지므로 
                // B2B, B2B2C 해당 보험사를 채널별로 나누게 되면 수수료 합산금액이 1억원 이상인 경우 1천만원이 넘어가는 부분에 대해서 수수료가 1000만원이 넘어가게 됨으로
                // 보험사별로 봤을때와 채널별로 봤을때의 수수료 수치가 달라지고 수수료의 합산 금액이 달라지게 되므로 보험료만 계산 해서 보여주기로 함 
                

                $charge_rate = 0; // 1억원 이상인 경우 1천만원까지만 성과급을 준다. 그리고 그런 경우는 이미 배열에 담았으므로 수수료는 0으로 한다. 따라서 아래에서 수수료 계산시 0이 된다.
                // 0인 경우는 수수료 계산시 0이 곱해지게 되므로 아래에서 배열안에 0이 들어가게 되고 0이 더해지게 된다.
            } else {
                // 삼성화재는 해외기본 단기 5% 수수료
                // $SamsungCommission 배열에 array push 해서담는다.
                $charge_rate = 0.05;
            }
            
        } else if($value['division'] == 'O' && $value['stay_duration'] == 'L'){
            // 해외 장기인경우
            $charge_rate = 0;
        } else if($value['division'] == 'D' && $value['stay_duration'] == 'L'){
            // 국내 장기인경우
            $charge_rate = 0;
        } else {
            // 다른 케이스는 ? 
            $charge_rate = 0;
        }

        // 수수료율을 곱해서 수수료를 계산한다. 그리고 SamsungCommission 배열에 담는다.
        array_push($SamsungCommission, $value['total_premium'] * $charge_rate);

        // $SamsungCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['Samsung'] = array_sum($SamsungCommission);
    } elseif($value['insurance_company'] == '002005'){  // 현대해상인경우
        // 현대는 국내기본 단기 10% 수수료
        // 현대는 해외기본 단기 30% 수수료
        // 현대는 해외기본 장기 30% 수수료
        // 현대는 해외기본 장기단체 28% 수수료

        // 현대는 국내기본 단기 10% 수수료
        if($value['division'] == 'D'){
            // 국내인경우
            // 현대는 국내기본 단기 10% 수수료
            // $HyundaiCommission 배열에 array push 해서담는다.
            $charge_rate = 0.10;
        } else if($value['division'] == 'O' && $value['stay_duration'] == 'S'){
            // 해외인경우
            // 현대는 해외기본 단기 30% 수수료
            // $HyundaiCommission 배열에 array push 해서담는다.
            $charge_rate = 0.30;
        } else if($value['division'] == 'O' && $value['stay_duration'] == 'L'){
            // 해외인경우
            // 현대는 해외기본 장기 30% 수수료
            // ---  현대는 해외기본 장기단체 28% 수수료
            // $HyundaiCommission 배열에 array push 해서담는다.
            if( $value['product_number'] == '001' ){ // 장기 단체인 경우 어떻게 체크 할 것인지 조건 확인 필요 <--- 해당 조건은 임시로 넣은 것임.
                
                array_push($HyundaiCommission, $value['total_premium'] * 0.28);
            } else {
                array_push($HyundaiCommission, $value['total_premium'] * 0.30);
            }
        }

        // $HyundaiCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['Hyundai'] = array_sum($HyundaiCommission);

    } elseif($value['insurance_company'] == '002010'){  // 한화손해보험인경우
        // 한화는 국내기본 단기 24% 수수료
        // 한화는 해외기본 단기 30% 수수료
        // 한화는 해외기본 장기 30% 수수료
        // 한화는 해외기본 장기단체상품이 없음

        // 한화는 국내기본 단기 24% 수수료
        if($value['division'] == 'D'){
            // 국내인경우
            // 한화는 국내기본 단기 24% 수수료
            // $HanwhaCommission 배열에 array push 해서담는다.
            array_push($HanwhaCommission, $value['total_premium'] * 0.24);
        } else if($value['division'] == 'O'){
            // 해외인경우
            // 한화는 해외기본 단기 30% 수수료
            // $HanwhaCommission 배열에 array push 해서담는다.
            array_push($HanwhaCommission, $value['total_premium'] * 0.30);
        }

        // $HanwhaCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['Hanwha'] = array_sum($HanwhaCommission);

    } elseif($value['insurance_company'] == '002012'){  // 어시스트카드인경우
        // 어시스트카드는 국내기본 단기 수수료가 없음
        // 어시스트카드는 해외기본 단기 20% 수수료
        // 어시스트카드는 해외기본 장기 20% 수수료
        // 어시스트카드는 해외기본 장기단체상품이 없음

        // 어시스트카드는 해외기본 단기 20% 수수료
        if($value['division'] == 'D'){
            // 국내인경우
            // 어시스트카드는 국내기본 단기 수수료가 없음
        } else if($value['division'] == 'O'){ // 해외인 경우 장기와 단기가 모두 20% 수수료
            // 해외인경우
            // 어시스트카드는 해외기본 단기 20% 수수료
            // $AssistcardCommission 배열에 array push 해서담는다.
            array_push($AssistcardCommission, $value['total_premium'] * 0.20);
        }

        // $AssistcardCommission 배열에 있는 금액을 합산한다.
        // 커미션 배열에 담는다.
        $CommissionArr['Assistcard'] = array_sum($AssistcardCommission);

    } else {
        // 다른 보험사는 ? 
    }
    echo "보험사와 상품명, 해외국내, 장기단기, 토탈보험료, 수수료율 : ".$value['insurance_company'].", ".$value['catnm'].", ".$value['product_name'].", ".$value['division'].", ".$value['stay_duration'].", ".$value['total_premium'].", ".$value['commission_rate']."<br>";
} // foreach end

// chubb 배열이 1개 이상일 경우 합산을 한다.

if(count($ChubbTotalArr) > 0){
    $ChubbTotalSum = array_sum($ChubbTotalArr);
    // 보험사 수수료 계산
    if($ChubbTotalSum > 160000000){
        // 1.6억이 넘는 경우 보험사 수수료가 45%를(30%+15%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.45;
    } else if($ChubbTotalSum > 120000000 && $ChubbTotalSum <= 160000000){
        // 1.2억 초과 1.6억 이하 인경우 보험사 수수료가 44%를(30%+14%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.44;
    } else if($ChubbTotalSum > 80000000 && $ChubbTotalSum <= 120000000){
        // 8천만 초과 1.2억 이하 인경우 보험사 수수료가 43%를(30%+13%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.43;
    } else if($ChubbTotalSum > 60000000 && $ChubbTotalSum <= 80000000){
        // 6천만 초과 8천만 이하 인경우 보험사 수수료가 42%를(30%+12%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.42;
    } else if($ChubbTotalSum > 40000000 && $ChubbTotalSum <= 60000000){
        // 4천만 초과 6천만 이하 인경우 보험사 수수료가 41%를(30%+11%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.41;
    } else if($ChubbTotalSum > 20000000 && $ChubbTotalSum <= 40000000){
        // 2천만 초과 4천만 이하 인경우 보험사 수수료가 40%를(30%+10%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.40;
    } else if($ChubbTotalSum > 15000000 && $ChubbTotalSum <= 20000000){
        // 1.5천만 초과 2천만 이하 인경우 보험사 수수료가 39%를(30%+9%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.39;
    } else if($ChubbTotalSum > 8000000 && $ChubbTotalSum <= 15000000){
        // 800만 초과 1.5천만 이하 인경우 보험사 수수료가 38%를(30%+8%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.38;
    } else if($ChubbTotalSum > 5000000 && $ChubbTotalSum <= 8000000){
        // 500만 초과 800만 이하 인경우 보험사 수수료가 37%를(30%+7%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.37;
    } else if($ChubbTotalSum <= 5000000){
        // 500만 이하 인경우 보험사 수수료가 36%를(30%+6%) 곱해서 수수료를 계산한다.
        $ChubbCommission = $ChubbTotalSum * 0.36;
    }

    // 커미션 배열에 담는다.
    $CommissionArr['Chubb'] = $ChubbCommission;
}


// 이하는 채널별 





/*

// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.6억이 넘는 경우 보험사 수수료가 45%를(30%+15%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.2억 초과 1.6억 이하 인경우 보험사 수수료가 44%를(30%+14%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 8천만 초과 1.2억 이하 인경우 보험사 수수료가 43%를(30%+13%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 6천만 초과 8천만 이하 인경우 보험사 수수료가 42%를(30%+12%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 4천만 초과 6천만 이하 인경우 보험사 수수료가 41%를(30%+11%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 2천만 초과 4천만 이하 인경우 보험사 수수료가 40%를(30%+10%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.5천만 초과 2천만 이하 인경우 보험사 수수료가 39%를(30%+9%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 800만 초과 1.5천만 이하 인경우 보험사 수수료가 38%를(30%+8%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 초과 800만 이하 인경우 보험사 수수료가 37%를(30%+7%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 이하 인경우 보험사 수수료가 36%를(30%+6%) 곱해서 수수료를 계산한다.

// 보험사가 메리츠화재 인경우 '해외장기체류보험(15680)' 인경우 기본 25% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '전문직해외장기체류보험(15780)' 인경우 기본 24.5% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외단기체류보험(15880)[팜투어,허니문]' 인경우 기본 30% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외실손의료보험(15540)' 인경우 기본 45% 수수료 + 5% 시책을 적용 해서 총 50% 를 적용한다.
//                                               -- 보험료가 2000만원 미만인 경우 50% (45+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 1억원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 1억원 이상인경우 55% (50+5) 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '국내여행보험(15920)' 인경우 기본 40% 수수료 + 5% 시책을 적용한다.
//                                               -- 보험료가 1000만원 미만인 경우 45% (40+5) 수수료를 적용한다.
//                                               -- 보험료가 1000만원 이상이면서 2000만원 미만인경우 47% (42+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 3000만원 미만인경우 49% (44+5) 수수료를 적용한다.
//                                               -- 보험료가 3000만원 이상이면서 4000만원 미만인경우 51% (46+5) 수수료를 적용한다.
//                                               -- 보험료가 4000만원 이상이면서 5000만원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 5000만원 이상인경우 55% (50+5) 수수료를 적용한다.
// 이와 별도로 성과급이 주어지는 케이스는 다음과 같다.
// 해외실손의료보험(15540)와 전문직해외장기체류보험(15780) 를 제외한 
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 100만원 이상인 경우 합산금액 * 1.5% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 300만원 이상인 경우 합산금액 * 2.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 500만원 이상인 경우 합산금액 * 2.50% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 1000만원 이상인 경우 합산금액 * 3.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 5000만원 이상인 경우 합산금액 * 4.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 10000만원 이상인 경우 합산금액 * 4.50% 를 성과급으로 준다.

// MG는 국내는 없음 해외 패키지만 있음
// MG는 해외기본 단기 30% 수수료
// MG는 해외성과 단기 1백만원 이상 2.0% 성과급
// MG는 해외성과 단기 5백만원 이상 2.5% 성과급
// MG는 해외성과 단기 1천만원 이상 3.0% 성과급
// MG는 해외성과 단기 2천만원 이상 3.5% 성과급
// MG는 해외성과 단기 4천만원 이상 4.0% 성과급
// MG는 해외성과 단기 7천만원 이상 4.5% 성과급
// MG는 해외성과 단기 1억원 이상 5.0% 성과급

// DB는 국내기본 단기 20% 수수료
// DB는 해외기본 단기 10% 수수료
// DB는 해외기본 장기 22% 수수료
// DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
// DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
// DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
// DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
// DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
// DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
// DB는 국내해외성과 단기 1억 이상 4.5% 성과급

// 삼성화재는 국내기본 단기 24% 수수료
// 삼성화재는 해외기본 단기 5% 수수료
// 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급
// 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급
// 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급
// 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급
// 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급
// 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

// 현대는 국내기본 단기 10% 수수료
// 현대는 해외기본 단기 30% 수수료
// 현대는 해외기본 장기 30% 수수료
// 현대는 해외기본 장기단체 28% 수수료

// 한화는 국내기본 단기 24% 수수료
// 한화는 해외기본 단기 30% 수수료
// 한화는 해외기본 장기 30% 수수료
// 한화는 해외기본 장기단체상품이 없음

// 어시스트카드는 국내기본 단기 수수료가 없음
// 어시스트카드는 해외기본 단기 20% 수수료
// 어시스트카드는 해외기본 장기 20% 수수료
// 어시스트카드는 해외기본 장기단체상품이 없음

        */ 


        ?>


<table caption="insurance_company_first_processed_data (13 rows)">
      <thead>
        <tr>
          <th class="col1">catnm</th>
          <th class="col2">insurance_company</th>
          <th class="col3">product_name</th>
          <th class="col4">division</th>
          <th class="col5">stay_duration</th>
          <th class="col6">total_premium</th>
          <th class="col7">product_number</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="col1">메리츠화재</td>
          <td class="col2">002001</td>
          <td class="col3">국내여행보험Ⅱ</td>
          <td class="col4">D</td>
          <td class="col5">S</td>
          <td class="col6">12021510</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">메리츠화재</td>
          <td class="col2">002001</td>
          <td class="col3">전문직해외장기체류보험</td>
          <td class="col4">O</td>
          <td class="col5">L</td>
          <td class="col6">1335550</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">메리츠화재</td>
          <td class="col2">002001</td>
          <td class="col3">해외여행 실손의료비보험</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">69362280</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">메리츠화재</td>
          <td class="col2">002001</td>
          <td class="col3">해외장기체류보험</td>
          <td class="col4">O</td>
          <td class="col5">L</td>
          <td class="col6">632420</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">CHUBB</td>
          <td class="col2">002002</td>
          <td class="col3">Chubb 국내여행보험</td>
          <td class="col4">D</td>
          <td class="col5">S</td>
          <td class="col6">54032640</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">CHUBB</td>
          <td class="col2">002002</td>
          <td class="col3">Chubb 멀티해외여행보험</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">218850</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">CHUBB</td>
          <td class="col2">002002</td>
          <td class="col3">Chubb 해외여행보험</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">227162394</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">DB손해보험</td>
          <td class="col2">002003</td>
          <td class="col3">프로미 해외여행보험II</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">7183410</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">삼성화재</td>
          <td class="col2">002004</td>
          <td class="col3">삼성화재 국내여행보험</td>
          <td class="col4">D</td>
          <td class="col5">S</td>
          <td class="col6">691840</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">삼성화재</td>
          <td class="col2">002004</td>
          <td class="col3">삼성화재 해외여행보험</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">23978270</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">현대해상</td>
          <td class="col2">002005</td>
          <td class="col3">현대장기</td>
          <td class="col4">O</td>
          <td class="col5">L</td>
          <td class="col6">9333800</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">MG손해보험</td>
          <td class="col2">002009</td>
          <td class="col3">MG 해외여행보험</td>
          <td class="col4">O</td>
          <td class="col5">S</td>
          <td class="col6">8443277</td>
          <td class="col7"></td>
        </tr>
        <tr>
          <td class="col1">한화손해보험</td>
          <td class="col2">002010</td>
          <td class="col3">한화장기</td>
          <td class="col4">O</td>
          <td class="col5">L</td>
          <td class="col6">5649720</td>
          <td class="col7"></td>
        </tr>
      </tbody>
    </table>


<xmp>
// 보험사가 메리츠화재 인경우 '해외장기체류보험(15680)' 인경우 기본 25% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '전문직해외장기체류보험(15780)' 인경우 기본 24.5% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외단기체류보험(15880)[팜투어,허니문]' 인경우 기본 30% 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '해외실손의료보험(15540)' 인경우 기본 45% 수수료 + 5% 시책을 적용 해서 총 50% 를 적용한다.
//                                               -- 보험료가 2000만원 미만인 경우 50% (45+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 1억원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 1억원 이상인경우 55% (50+5) 수수료를 적용한다.
// 보험사가 메리츠화재 인경우 '국내여행보험(15920)' 인경우 기본 40% 수수료 + 5% 시책을 적용한다.
//                                               -- 보험료가 1000만원 미만인 경우 45% (40+5) 수수료를 적용한다.
//                                               -- 보험료가 1000만원 이상이면서 2000만원 미만인경우 47% (42+5) 수수료를 적용한다.
//                                               -- 보험료가 2000만원 이상이면서 3000만원 미만인경우 49% (44+5) 수수료를 적용한다.
//                                               -- 보험료가 3000만원 이상이면서 4000만원 미만인경우 51% (46+5) 수수료를 적용한다.
//                                               -- 보험료가 4000만원 이상이면서 5000만원 미만인경우 53% (48+5) 수수료를 적용한다.
//                                               -- 보험료가 5000만원 이상인경우 55% (50+5) 수수료를 적용한다.
// 이와 별도로 성과급이 주어지는 케이스는 다음과 같다.
// 해외실손의료보험(15540)와 전문직해외장기체류보험(15780) 를 제외한 
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 100만원 이상인 경우 합산금액 * 1.5% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 300만원 이상인 경우 합산금액 * 2.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 500만원 이상인 경우 합산금액 * 2.50% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 1000만원 이상인 경우 합산금액 * 3.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 5000만원 이상인 경우 합산금액 * 4.00% 를 성과급으로 준다.
// 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 10000만원 이상인 경우 합산금액 * 4.50% 를 성과급으로 준다.

----------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------

</xmp>


<?php

debug($CommissionArr);

?>

<xmp>
궁금증 

1. DB는 국내 기본 장기는 없는지.... 
2. 수수료와 성과급을 따로 해야 하는지 ?
3. 삼성인 경우 국내장기와 해외장기는 없는지 ? 
4. 현대 장기 단체상품은 없는지 ? => 수수료 정책에 정리되어 있어서 확인 필요
   - ErpBasicInfoManagement->public function insuranceCompanyExcelUploadRegProc() 에서 단체 처리 프로세스 추가 필요


1차 작업
-----------------------------------------------------------------------------------------------------
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.6억이 넘는 경우 보험사 수수료가 45%를(30%+15%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.2억 초과 1.6억 이하 인경우 보험사 수수료가 44%를(30%+14%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 8천만 초과 1.2억 이하 인경우 보험사 수수료가 43%를(30%+13%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 6천만 초과 8천만 이하 인경우 보험사 수수료가 42%를(30%+12%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 4천만 초과 6천만 이하 인경우 보험사 수수료가 41%를(30%+11%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 2천만 초과 4천만 이하 인경우 보험사 수수료가 40%를(30%+10%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.5천만 초과 2천만 이하 인경우 보험사 수수료가 39%를(30%+9%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 800만 초과 1.5천만 이하 인경우 보험사 수수료가 38%를(30%+8%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 초과 800만 이하 인경우 보험사 수수료가 37%를(30%+7%) 곱해서 수수료를 계산한다.
// 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 이하 인경우 보험사 수수료가 36%를(30%+6%) 곱해서 수수료를 계산한다.

// MG는 국내는 없음 해외 패키지만 있음
// MG는 해외기본 단기 30% 수수료
// MG는 해외성과 단기 1백만원 이상 2.0% 성과급
// MG는 해외성과 단기 5백만원 이상 2.5% 성과급
// MG는 해외성과 단기 1천만원 이상 3.0% 성과급
// MG는 해외성과 단기 2천만원 이상 3.5% 성과급
// MG는 해외성과 단기 4천만원 이상 4.0% 성과급
// MG는 해외성과 단기 7천만원 이상 4.5% 성과급
// MG는 해외성과 단기 1억원 이상 5.0% 성과급

// DB는 국내기본 단기 20% 수수료
// DB는 해외기본 단기 10% 수수료
// DB는 해외기본 장기 22% 수수료
// DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
// DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
// DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
// DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
// DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
// DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
// DB는 국내해외성과 단기 1억 이상 4.5% 성과급

// 삼성화재는 국내기본 단기 24% 수수료
// 삼성화재는 해외기본 단기 5% 수수료
// 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급
// 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급
// 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급
// 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급
// 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급
// 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

// 현대는 국내기본 단기 10% 수수료
// 현대는 해외기본 단기 30% 수수료
// 현대는 해외기본 장기 30% 수수료
// 현대는 해외기본 장기단체 28% 수수료

// 한화는 국내기본 단기 24% 수수료
// 한화는 해외기본 단기 30% 수수료
// 한화는 해외기본 장기 30% 수수료
// 한화는 해외기본 장기단체상품이 없음

// 어시스트카드는 국내기본 단기 수수료가 없음
// 어시스트카드는 해외기본 단기 20% 수수료
// 어시스트카드는 해외기본 장기 20% 수수료
// 어시스트카드는 해외기본 장기단체상품이 없음

</xmp>