<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ErpBasicInfoModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }

    // 법인카드 리스트
    /*
        SELECT 
            a.cardNo, a.admin_id, b.deptNo, c.dept_no, c.dept_name, b.adminName, a.card_nicname 
        FROM 
            erp_card_manage AS a
            LEFT JOIN admin_user AS b ON a.admin_id = b.adminId
            LEFT JOIN admin_depts AS c ON b.deptNo = c.dept_no
    */
    public function getCardList(){
        $this->db->select('a.no, a.cardNo, a.card_com, d.financial_name, a.admin_id, b.deptNo, c.dept_no, c.dept_name, b.adminName, a.card_nicname, a.use_yn, a.card_year, a.card_month');
        $this->db->from('erp_card_manage AS a');
        $this->db->join('admin_user AS b', 'a.admin_id = b.adminId', 'left');
        $this->db->join('admin_depts AS c', 'b.deptNo = c.dept_no', 'left');
        $this->db->join('t_financial_com_code as d', 'a.card_com = d.code', 'left');

        $query = $this->db->get();
        return $query->result();
    }


    // 카드사 리스트 가져오기 // SELECT * FROM t_financial_com_code WHERE TYPE = 'card' AND use_yn = 'Y'
    public function getCardCompanyList(){
        $this->db->select('*');
        $this->db->from('t_financial_com_code');
        $this->db->where('type', 'card');
        $this->db->where('use_yn', 'Y');
        $query = $this->db->get();
        return $query->result();
    }


    // 법인카드 수정페이지에서 카드 정보 가져오기
    public function getCardInfo($no){
        $this->db->select('a.no, a.cardNo, a.card_com, d.financial_name, a.admin_id, a.pay_day, b.deptNo, c.dept_no, c.dept_name, b.adminName, a.card_nicname as memo, a.use_yn, a.card_year, a.card_month');
        $this->db->from('erp_card_manage AS a');
        $this->db->join('admin_user AS b', 'a.admin_id = b.adminId', 'left');
        $this->db->join('admin_depts AS c', 'b.deptNo = c.dept_no', 'left');
        $this->db->join('t_financial_com_code as d', 'a.card_com = d.code', 'left');
        $this->db->where('a.no', $no);
        $query = $this->db->get();
        return $query->result();
    }


    // t_excel_upload_history 테이블에서 해당 no 로 되어있는 code 필드 가져오기 getExcelUploadHistoryCode
    public function getExcelUploadHistoryCode($no){
        $this->db->select('code');
        $this->db->from('t_excel_upload_history');
        $this->db->where('no', $no);
        $this->db->where('del_yn', 'Y');
        $query = $this->db->get();
        return $query->result();
    }


    // 법인카드,매출,매입 내역 t_excel_upload_history 테이블에서 삭제하기 실제로는 업데이트 cardUploadBreakdownDelProc  del_yn를 'Y' 로 업데이트 후 결과를 리턴 한다
    public function excelUploadBreakdownDelProc($no){
        $this->db->where('no', $no);
        $this->db->update('t_excel_upload_history', array('del_yn' => 'Y'));
        return $this->db->affected_rows();
    }


    // 업데이트한 t_excel_upload_history 테이블에서 해당 no 로 되어있는 del_yn 필드를 다시 'N' 으로 업데이트 하기 cardUploadBreakdownDelRollBack
    public function cardUploadBreakdownDelRollBack($no){
        $this->db->where('no', $no);
        $this->db->update('t_excel_upload_history', array('del_yn' => 'N'));
        return $this->db->affected_rows();
    }


    // 업데이트한 erp_sales_buy_invoice 테이블에서 해당 no 로 되어있는 del_yn 필드를 다시 'N' 으로 업데이트 하기 salesBuyUploadBreakdownDelRollBack
    public function salesBuyUploadBreakdownDelRollBack($no){
        $this->db->where('no', $no);
        $this->db->update('erp_sales_buy_invoice', array('del_yn' => 'N'));
        return $this->db->affected_rows();
    }


    // 법인사용 내역 삭제하기 실제로는 업데이트 cardUploadBreakdownDelProc erp_card_use_history 테이블의 del_yn를 'Y' 로 업데이트 update_date 는 현재 날짜로 업데이트
    public function cardUploadBreakdownDelProc($code){
        $this->db->where('code', $code);
        $this->db->update('erp_card_use_history', array('del_yn' => 'Y', 'update_date' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }


    // 매출전자계산서목록 삭제하기 실제로는 업데이트 erp_sales_buy_invoice 테이블의 del_yn를 'Y' 로 업데이트 update_date 는 현재 날짜로 업데이트
    public function salesBuyUploadBreakdownDelProc($code){
        $this->db->where('code', $code);
        $this->db->update('erp_sales_buy_invoice', array('del_yn' => 'Y', 'update_date' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }


	// 수정 페이지 에서 수정 할 법인 카드 정보 가져오기 GetCardInfo
	public function GetUpdateCardInfo($seq){
		$this->db->where("erp_card_manage.no", $seq);
		return $this->db->get('erp_card_manage')->result();
	}


    // 법인카드 등록 cardInfoRegProc
    public function cardInfoRegProc($data){
        $this->db->insert('erp_card_manage', $data);
        return $this->db->insert_id();
    }


	// 수정페이지에서 넘어온 데이터를 업데이트 하는 함수 UpdateCardInfo
	public function UpdateCardInfo($data){
		$this->db->where("erp_card_manage.no", $data['no']);
		return $this->db->update("erp_card_manage", $data);
	}


    // 법인카드 내역 업로드 히스토리 리스트 가져오기 getExcelUploadHistory('type'); //t_excel_upload_history 테이블에서  type 필드 = 'C','S','B'  카드, 매입, 매출 'C:카드','B:매입','S:매출' // 삭제여부가 'N' 인것만 가져오기
    // getExcelUploadHistory('B', $per_page, $offset); 
    public function getExcelUploadHistory($type, $per_page, $offset){
        $this->db->select('*');
        $this->db->from('t_excel_upload_history');
        $this->db->where('type', $type);
        $this->db->where('del_yn', 'N');
        $this->db->order_by('use_year_month', 'desc');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    // 엑셀 업로드된 내역이 있는지 확인 한다 getExcelUploadHistoryCheck
    public function getExcelUploadHistoryCheck($type, $searchDateYM){
        $this->db->select('code');
        $this->db->from('t_excel_upload_history');
        $this->db->where('use_year_month', $searchDateYM);
        $this->db->where('type', $type);
        $this->db->where('del_yn', 'N');
        $query = $this->db->get();
        return $query->result();
    }



    // erp_card_use_history 테이블에서 카드 사용내역 가져오기 사용자 명도 함께 가져오기
    /*

    SELECT 
	a.* , b.*, c.adminName
FROM 
	erp_card_use_history AS a
	LEFT JOIN erp_card_manage AS b ON a.card_number = b.cardNo
	LEFT JOIN admin_user AS c ON b.admin_id = c.adminId


    */
    public function getCardUseHistoryList($searchData, $per_page, $offset){
        /*
        $this->db->select('SQL_CALC_FOUND_ROWS a.no, a.billing_year, a.billing_month, a.use_year, a.use_month, a.billing_day, 
                            a.approval_date, a.department_number, a.department_name, a.card_number, a.user_name, 
                            a.franchise_name, a.payment_method, a.approval_amount, a.discount_amount, a.billing_principal, 
                            a.fee, a.total, a.purchase_date, a.approval_number, a.tax_type, a.franchise_status, a.franchise_number, 
                            a.franchise_business_number, a.representative_name, a.franchise_address, a.franchise_tel, a.category, a.memo, 
                            a.del_yn, a.update_date, a.regdate, c.adminName');
        $this->db->from('erp_card_use_history AS a');
        $this->db->join('erp_card_manage AS b', 'a.card_number = b.cardNo', 'left');
        $this->db->join('admin_user AS c', 'b.admin_id = c.adminId', 'left');
        */
        /*
        $sql = "
        SELECT SQL_CALC_FOUND_ROWS 
                `a`.`no`, `a`.`billing_year`, `a`.`billing_month`, `a`.`use_year`, `a`.`use_month`, 
                `a`.`billing_day`, `a`.`approval_date`, `a`.`department_number`, `a`.`department_name`, `a`.`card_number`, 
                `a`.`user_name`, `a`.`franchise_name`, `a`.`payment_method`, `a`.`approval_amount`, `a`.`discount_amount`, 
                `a`.`billing_principal`, `a`.`fee`, `a`.`total`, `a`.`purchase_date`, `a`.`approval_number`, 
                `a`.`tax_type`, `a`.`franchise_status`, `a`.`franchise_number`, `a`.`franchise_business_number`, `a`.`representative_name`, 
                `a`.`franchise_address`, `a`.`franchise_tel`, `a`.`category`, `a`.`memo`, `a`.`del_yn`, 
                `a`.`update_date`, `a`.`regdate`, `c`.`adminName`, `b`.`admin_id`
        FROM 
            `erp_card_use_history` AS `a` 
            LEFT JOIN `erp_card_manage` AS `b` ON `a`.`card_number` = `b`.`cardNo` 
            LEFT JOIN `admin_user` AS `c` ON `b`.`admin_id` = `c`.`adminId`
        WHERE 1=1";
        */
        $sql = "
        SELECT 
                `a`.`no`, `a`.`billing_day`, `a`.`approval_date`, `a`.`card_number`, `c`.`adminName`, `a`.`category`, `d`.`cate_name`, `a`.`franchise_name`, `a`.`approval_number`, 
                `a`.`memo`, `a`.`total`
                /* , `a`.`department_number`, `a`.`department_name`, `a`.`user_name`, `a`.`payment_method`, `a`.`approval_amount`, 
                `a`.`discount_amount`, `a`.`fee`, `a`.`billing_principal` , `a`.`purchase_date`, `a`.`tax_type`, `a`.`franchise_status`, `a`.`franchise_number`, `a`.`franchise_business_number`, 
                `a`.`representative_name`, `a`.`franchise_address`, `a`.`franchise_tel`, `a`.`del_yn`, `a`.`update_date`, `a`.`regdate`, `b`.`admin_id` */ 
        FROM 
                `erp_card_use_history` AS `a` 
                LEFT JOIN `erp_card_manage` AS `b` ON `a`.`card_number` = `b`.`cardNo` 
                LEFT JOIN `admin_user` AS `c` ON `b`.`admin_id` = `c`.`adminId` 
                LEFT JOIN `t_money_used_cate`AS `d` ON `a`.`category` = `d`.`cate_code`
        WHERE 
                1=1 
                AND `a`.`del_yn` = 'N'
                ";


        if($searchData['searchDateY'] != ''){
            $sql .= " and a.use_year = '".$searchData['searchDateY']."'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.use_month = '".$searchData['searchDateM']."'";
        }
        if($searchData['useType'] != ''){
            $sql .= " and a.category = '".$searchData['useType']."'";
        }
        if($searchData['useHistory'] != ''){
            $sql .= " and a.memo like '%".$searchData['useHistory']."%'";
        }
        


        $sql .= " order by a.no desc LIMIT $per_page OFFSET $offset";
        
        //$rdata['sum_total'] = 0;
        //$rdata['sum_total'] = $this->getCardUseHistoryListTotalSum($searchData);
        $rdata = $this->db->query($sql)->result();

        return $rdata;
		// 쿼리 확인 하기		//echo "SQL : ".$this->db->last_query();

    }


    public function getCardUseHistoryListTotalSum($searchData){
        $sql = "
        SELECT 
            count(*) as total_cnt, SUM(a.total) AS 'sum_total'
        FROM 
            `erp_card_use_history` AS `a` 
            LEFT JOIN `erp_card_manage` AS `b` ON `a`.`card_number` = `b`.`cardNo` 
            LEFT JOIN `admin_user` AS `c` ON `b`.`admin_id` = `c`.`adminId`
        WHERE 1=1
        and a.del_yn = 'N'
        
        ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.use_year = '".$searchData['searchDateY']."'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.use_month = '".$searchData['searchDateM']."'";
        }
        if($searchData['useType'] != ''){
            $sql .= " and a.category = '".$searchData['useType']."'";
        }
        if($searchData['useHistory'] != ''){
            $sql .= " and a.memo like '%".$searchData['useHistory']."%'";
        }

        return $this->db->query($sql)->result();
    }

    // 고객사 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
    public function getCardUseHistoryListTotalCnt(){
        return $this->db->query("
        SELECT FOUND_ROWS() as total_cnt
        ")->result();
    }


    // 넘어온 SQL 문을 그대로 실행 해서 해당 데이터를 리턴 한다 GetSqlData()
    public function GetSqlData($sql){
        return $this->db->query($sql)->result();
    }

    // 넘어온 SQL 문을 그대로 실행 해서 해당 데이터를 리턴 한다 GetSqlData()
    public function GetSqlData2($sql){
        $re = $this->db->query($sql);
        return $re;
    }

    // 엑셀 데이터 업로드 히스토리 저장하기 InsertUploadHistory
    public function InsertUploadHistory($data){
        $this->db->insert('t_excel_upload_history', $data);
        return $this->db->insert_id();
    }

    // 엑셀 데이터 업로드 개수 가져오기 GetExcelUploadCount
    public function GetExcelUploadCount($type){
        $this->db->select('count(*) as total_cnt');
        $this->db->from('t_excel_upload_history');
        $this->db->where('type', $type);
        $this->db->where('del_yn', 'N');
        $query = $this->db->get();
        return $query->result();
    }


    /*
참고용 admin_user 테이블 구조
CREATE TABLE `admin_user` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `adminProgram` enum('non','crm','erp','all') NOT NULL DEFAULT 'crm' COMMENT '어드민 사용프로그램 ★★★ ERP 개발시 변경 필요 ★★★',
  `adminId` varchar(30) NOT NULL COMMENT '어드민 아이디',
  `deptNo` varchar(12) NOT NULL COMMENT '어드민부서코드',
  `adminPwd` varchar(255) NOT NULL COMMENT '어드민 비번',
  `adminName` varchar(30) NOT NULL DEFAULT '0' COMMENT '어드민 이름',
  `adminHwId` varchar(30) NOT NULL COMMENT '어드민 하이웍스 아이디',
  `adminMobile` char(11) NOT NULL COMMENT '어드민 핸드폰',
  `adminEmail` varchar(50) NOT NULL COMMENT '어드민 이메일',
  `authCustomerAccount` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '권한_고객관리',
  `authInsuranceContract` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '권한_보험계약관리',
  `authBasicInformation` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '권한_기초정보관리',
  `adminLevel` char(2) NOT NULL COMMENT '어드민 레벨',
  `adminYn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '어드민 여부',
  `lastLogin` datetime NOT NULL COMMENT '마지막 로그인',
  `regId` varchar(30) NOT NULL DEFAULT '' COMMENT '누가 등록을 했는지 (어드민 ID )',
  `regdate` datetime DEFAULT NULL COMMENT '어드민 등록일',
  PRIMARY KEY (`no`),
  UNIQUE KEY `admin_user_adminId_IDX` (`adminId`) USING BTREE,
  UNIQUE KEY `admin_user_adminMobile_IDX` (`adminMobile`) USING BTREE,
  UNIQUE KEY `admin_user_adminEmail_IDX` (`adminEmail`) USING BTREE,
  KEY `admin_user_adminName_IDX` (`adminName`) USING BTREE,
  KEY `admin_user_adminYn_IDX` (`adminYn`) USING BTREE,
  KEY `admin_dept_no` (`deptNo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='CRM, ERP 관리자'



참고용 erp_card_manage 테이블 구조
CREATE TABLE `erp_card_manage` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `card_com` int(3) unsigned DEFAULT NULL COMMENT '카드사 코드(t_card_com.code)',
  `cardNo` varchar(19) NOT NULL COMMENT '카드번호',
  `admin_id` varchar(30) DEFAULT NULL COMMENT '사용자ID(admin_user.adminId)',
  `card_year` char(4) DEFAULT '' COMMENT '카드유효기간연도',
  `card_month` char(2) DEFAULT '' COMMENT '카드유효기간월',
  `card_cvc` char(3) DEFAULT '' COMMENT '카드CVC코드',
  `pay_day` varchar(2) DEFAULT NULL COMMENT '결제일',
  `card_nicname` varchar(100) DEFAULT NULL COMMENT '카드닉네임/tag/사용처 (ex :  naver, online ..... ) ',
  `update_admin_id` varchar(30) DEFAULT NULL COMMENT '최종 수정자',
  `reg_admin_id` varchar(30) DEFAULT NULL COMMENT '카드 등록자',
  `use_yn` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT '카드사용여부',
  `regdate` datetime NOT NULL COMMENT '카드등록일',
  PRIMARY KEY (`no`),
  UNIQUE KEY `cardNo` (`cardNo`),
  KEY `card_year` (`card_year`),
  KEY `card_month` (`card_month`),
  KEY `user_id` (`admin_id`) USING BTREE,
  KEY `use_yn` (`use_yn`),
  KEY `regdate` (`regdate`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='카드관련'



 참고용 erp_card_use_history 테이블 구조

CREATE TABLE `erp_card_use_history` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `code` varchar(20) DEFAULT NULL COMMENT 't_excel_upload_history 의 code 와 매칭 타입은 md5(regdate) 형식으로 되어있음 ',
  `billing_year` varchar(4) DEFAULT NULL COMMENT '청구년도',
  `billing_month` varchar(2) DEFAULT NULL COMMENT '청구월',
  `use_year` varchar(4) DEFAULT NULL COMMENT '사용년도',
  `use_month` varchar(2) DEFAULT NULL COMMENT '사용월',
  `billing_day` varchar(8) DEFAULT NULL COMMENT '청구일',
  `approval_date` varchar(8) DEFAULT NULL COMMENT '승인일',
  `department_number` varchar(12) DEFAULT NULL COMMENT '부서번호',
  `department_name` varchar(100) DEFAULT NULL COMMENT '부서명',
  `card_number` varchar(19) DEFAULT NULL COMMENT '카드번호',
  `user_name` varchar(30) DEFAULT NULL COMMENT '이용자명',
  `franchise_name` varchar(100) DEFAULT NULL COMMENT '가맹점명',
  `payment_method` varchar(10) DEFAULT NULL COMMENT '결제방법',
  `approval_amount` int(11) DEFAULT NULL COMMENT '승인금액',
  `discount_amount` int(11) DEFAULT NULL COMMENT '할인금액',
  `billing_principal` int(11) DEFAULT NULL COMMENT '청구원금',
  `principal` int(11) DEFAULT NULL COMMENT '원금',
  `fee` int(11) DEFAULT NULL COMMENT '수수료',
  `total` int(11) DEFAULT NULL COMMENT '합계',
  `purchase_date` varchar(8) DEFAULT NULL COMMENT '매입일',
  `approval_number` varchar(10) DEFAULT NULL COMMENT '승인번호',
  `tax_type` varchar(20) DEFAULT NULL COMMENT '과세유형',
  `franchise_status` varchar(20) DEFAULT NULL COMMENT '가맹점상태',
  `franchise_number` varchar(15) DEFAULT NULL COMMENT '가맹점번호',
  `franchise_business_number` varchar(10) DEFAULT NULL COMMENT '가맹점사업자번호',
  `representative_name` varchar(30) DEFAULT NULL COMMENT '대표자성명',
  `franchise_address` varchar(100) DEFAULT NULL COMMENT '가맹점주소',
  `franchise_tel` varchar(50) DEFAULT NULL COMMENT '가맹점전화번호',
  `category` varchar(12) NOT NULL COMMENT '카테고리',
  `memo` varchar(100) DEFAULT NULL COMMENT '메모',
  `del_yn` enum('Y','N') DEFAULT 'N' COMMENT '삭제여부',
  `update_date` date DEFAULT NULL COMMENT '수정일',
  `regdate` date DEFAULT current_timestamp() COMMENT '등록일',
  PRIMARY KEY (`no`),
  UNIQUE KEY `approval_number_uniq` (`approval_number`),
  KEY `billing_year` (`billing_year`),
  KEY `billing_month` (`billing_month`),
  KEY `use_year` (`use_year`),
  KEY `use_month` (`use_month`),
  KEY `billing_day` (`billing_day`),
  KEY `approval_date` (`approval_date`),
  KEY `department_number` (`department_number`),
  KEY `department_name` (`department_name`),
  KEY `card_number` (`card_number`),
  KEY `payment_method` (`payment_method`),
  KEY `purchase_date` (`purchase_date`),
  KEY `approval_number` (`approval_number`),
  KEY `tax_type` (`tax_type`),
  KEY `category` (`category`),
  KEY `del_yn` (`del_yn`),
  KEY `regdate` (`regdate`),
  KEY `user_name` (`user_name`),
  KEY `code` (`code`),
  FULLTEXT KEY `franchise_name` (`franchise_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci


// t_excel_upload_history 테이블 구조

CREATE TABLE `t_excel_upload_history` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(35) DEFAULT NULL COMMENT '업로드코드_그냥 보여주기위한 텍스트에 불과함 해당코드로 검색도 안하고 리스트에 뿌려주기만 하는 필드입니다',
  `use_year_month` char(7) DEFAULT NULL COMMENT '업로드한 청구년도와 월 ''YYYY-MM''',
  `type` enum('C','B','S','F') NOT NULL COMMENT '카드, 매입, 매출 ''C:카드'',''B:매입'',''S:매출'',''F'':1차가공파일',
  `com_name` varchar(50) DEFAULT NULL COMMENT '카드사명, 우리회사 법인명',
  `reg_admin` varchar(50) DEFAULT NULL COMMENT '등록자 ID',
  `total` int(11) NOT NULL DEFAULT 0 COMMENT '등록된 개수',
  `tax_yn` enum('Y','N') DEFAULT NULL, '세금 여부'
  `del_yn` enum('Y','N') DEFAULT 'N' COMMENT '삭제여부',
  `reg_date` datetime DEFAULT NULL COMMENT '등록일',
  PRIMARY KEY (`no`),
  KEY `type` (`type`),
  KEY `del_yn` (`del_yn`),
  KEY `use_year_month` (`use_year_month`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='엑셀업로드 히스토리 관련'

*/





} // end of class