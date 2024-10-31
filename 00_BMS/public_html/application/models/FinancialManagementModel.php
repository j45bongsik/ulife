<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinancialManagementModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }

    // 재화를 사용한 카테고리 getCardUseCategoryList
    public function getCardUseCategoryList(){
        $this->db->select('*');
        $this->db->from('t_money_used_cate');
        $this->db->where('use_yn', 'Y');
        $query = $this->db->get();
        return $query->result();
    }

    // t_money_used_cate 테이블에서 사용내역 카테고리를 가져온다.
    public function getCardUseCategoryListOption(){
        $this->db->select('*');
        $this->db->from('t_money_used_cate');
        $this->db->where('use_yn', 'Y');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    // cardUseHistoryUpdate 카드 사용내역 수정 후 결과 리턴
    public function cardUseHistoryUpdate($data){
        $this->db->where('no', $data['no']);
        $this->db->update('erp_card_use_history', $data);
        return $this->db->affected_rows();
        //echo $this->db->last_query();
    }

    // 보험사 목록 가져오기 getInsuranceCompanyCategoryList
    public function getInsuranceCompanyCategoryList(){
        $this->db->select('catno, catnm');
        $this->db->from('insurance_company_category');
        $this->db->where('depth', '2');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCardUseHistoryList($searchData, $per_page, $offset){        
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
        WHERE 1=1";

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


    // 매입내역 가져오기 getPurchaseBreakdownList($searchData,$per_page,$offset)
    public function getPurchaseBreakdownList($searchData, $per_page, $offset){
        $sql = "
        SELECT 
                `a`.`no`, `a`.`issue_date`, `a`.`sup_business_number`, `a`.`sup_mutual`, `a`.`item_name`, `a`.`item_quantity`, `a`.`item_price`, `a`.`item_supply_price`, `a`.`item_tax_amount`, `a`.`total_amount`,
                `a`.`rec_sup_business_number`, `a`.`rec_sup_mutual`, `a`.`rec_sup_ceo_name`, `a`.`rec_sup_address`, `a`.`tax_amount`, `a`.`tax_invoice_classification`, `a`.`item_purchase_cate2`
        FROM 
                `erp_sales_buy_invoice` AS `a` 
        WHERE 
                type = 'B'
                AND `a`.`del_yn` = 'N'
                ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.issue_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.issue_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['rec_sup_business_number'] != ''){
            $sql .= " and a.rec_sup_business_number = '".$searchData['rec_sup_business_number']."'";
        }
        if($searchData['sup_business_number'] != ''){
            $sql .= " and a.sup_business_number = '".$searchData['sup_business_number']."'";
        }
        if($searchData['sup_mutual'] != ''){
            $sql .= " and a.sup_mutual like '%".$searchData['sup_mutual']."%'";
        }

        $sql .= " order by a.no desc LIMIT $per_page OFFSET $offset";
        $rdata = $this->db->query($sql)->result();

        return $rdata;

    }


    // 매입내역 가져오기 getPurchaseBreakdownListTotalSum($searchData)
    public function getPurchaseBreakdownListTotalSum($searchData){
        $sql = "
        SELECT 
            count(*) as total_cnt, SUM(a.total_amount) AS 'sum_total_amount'
        FROM 
            `erp_sales_buy_invoice` AS `a` 
        WHERE 
            type = 'B'
            AND `a`.`del_yn` = 'N'
        ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.issue_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.issue_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['rec_sup_business_number'] != ''){
            $sql .= " and a.rec_sup_business_number = '".$searchData['rec_sup_business_number']."'";
        }
        if($searchData['sup_business_number'] != ''){
            $sql .= " and a.sup_business_number = '".$searchData['sup_business_number']."'";
        }
        if($searchData['sup_mutual'] != ''){
            $sql .= " and a.sup_mutual like '%".$searchData['sup_mutual']."%'";
        }

        return $this->db->query($sql)->result();
    }


    // 매출내역 가져오기 getSalesBreakdownList($searchData,$per_page,$offset);
    public function getSalesBreakdownList($searchData, $per_page, $offset){
        $sql = "
        SELECT 
                `a`.`no`, `a`.`issue_date`, `a`.`sup_business_number`, `a`.`sup_mutual`, `a`.`item_name`, `a`.`item_quantity`, `a`.`item_price`, `a`.`item_supply_price`, `a`.`item_tax_amount`, `a`.`total_amount`,
                `a`.`rec_sup_business_number`, `a`.`rec_sup_mutual`, `a`.`rec_sup_ceo_name`, `a`.`rec_sup_address`, `a`.`tax_amount`, `a`.`tax_invoice_classification`, `a`.`item_cate`
        FROM 
                `erp_sales_buy_invoice` AS `a` 
        WHERE 
                type = 'S'
                AND `a`.`del_yn` = 'N'
                ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.issue_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.issue_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['rec_sup_business_number'] != ''){
            $sql .= " and a.rec_sup_business_number = '".$searchData['rec_sup_business_number']."'";
        }
        if($searchData['sup_business_number'] != ''){
            $sql .= " and a.sup_business_number = '".$searchData['sup_business_number']."'";
        }
        if($searchData['rec_sup_mutual'] != ''){
            $sql .= " and a.rec_sup_mutual like '%".$searchData['rec_sup_mutual']."%'";
        }

        $sql .= " order by a.no desc LIMIT $per_page OFFSET $offset";
        $rdata = $this->db->query($sql)->result();

        return $rdata;

    }


    
    // 매입내역 가져오기 getSalesBreakdownListTotalSum($searchData)
    public function getSalesBreakdownListTotalSum($searchData){
        $sql = "
        SELECT 
            count(*) as total_cnt, SUM(a.total_amount) AS 'sum_total_amount'
        FROM 
            `erp_sales_buy_invoice` AS `a` 
        WHERE 
            type = 'S'
            AND `a`.`del_yn` = 'N'
        ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.issue_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.issue_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['rec_sup_business_number'] != ''){
            $sql .= " and a.rec_sup_business_number = '".$searchData['rec_sup_business_number']."'";
        }
        if($searchData['sup_business_number'] != ''){
            $sql .= " and a.sup_business_number = '".$searchData['sup_business_number']."'";
        }
        if($searchData['rec_sup_mutual'] != ''){
            $sql .= " and a.rec_sup_mutual like '%".$searchData['rec_sup_mutual']."%'";
        }

        return $this->db->query($sql)->result();
    }


/*
매입 매출 내역 테이블 erp_sales_buy_invoice 참고용 구조 

CREATE TABLE `erp_sales_buy_invoice` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(35) NOT NULL DEFAULT '0' COMMENT '업로드코드',
  `type` enum('S','B') NOT NULL COMMENT '매출(S) 매입(B)',
  `use_year_month` varchar(7) NOT NULL COMMENT '사용년월',
  `issue_year_month` varchar(7) NOT NULL COMMENT '엑셀에 표시된 작성일자 년월',
  `issue_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '엑셀에 표시된 작성일자',
  `approval_number` varchar(50) NOT NULL DEFAULT '0000-00-00' COMMENT '승인번호',
  `issuance_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '발급일자',
  `tran_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '전송일자',
  `sup_business_number` varchar(15) NOT NULL COMMENT '공급자 사업자등록번호',
  `sup_workplace_number` varchar(50) NOT NULL COMMENT '공급자 종사업장번호',
  `sup_mutual` varchar(100) NOT NULL COMMENT '공급자 상호',
  `sup_representative_name` varchar(50) NOT NULL COMMENT '공급자 대표자명',
  `sup_address` varchar(200) NOT NULL COMMENT '공급자 주소',
  `rec_sup_business_number` varchar(15) NOT NULL COMMENT '공급받는자 사업자 등록번호',
  `rec_sup_workplace_number` varchar(50) NOT NULL COMMENT '공급받는자 종사업장 번호',
  `rec_sup_mutual` varchar(100) NOT NULL COMMENT '공급받는자 상호',
  `rec_sup_ceo_name` varchar(50) NOT NULL COMMENT '공급받는자 대표자명',
  `rec_sup_address` varchar(200) NOT NULL COMMENT '공급받는자 주소',
  `total_amount` int(11) NOT NULL DEFAULT 0 COMMENT '합계금액',
  `supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '공급가액',
  `tax_amount` int(11) DEFAULT 0 COMMENT '세액',
  `tax_invoice_classification` varchar(20) NOT NULL COMMENT '전자세금계산서분류',
  `tax_invoice_types` varchar(20) NOT NULL COMMENT '전자세금계산서종류',
  `issuance_type` varchar(30) NOT NULL COMMENT '발급유형',
  `note` text DEFAULT NULL COMMENT '비고',
  `receipt_billing` varchar(5) NOT NULL COMMENT '영수/청구 구분	',
  `provider_email` varchar(100) NOT NULL COMMENT '공급자 이메일',
  `supplier_email1` varchar(100) NOT NULL COMMENT '공급받는자 이메일1',
  `supplier_email2` varchar(100) DEFAULT NULL COMMENT '공급받는자 이메일2',
  `item_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '품목일자',
  `item_name` varchar(100) NOT NULL COMMENT '품목명',
  `item_cate` varchar(100) DEFAULT NULL COMMENT '분류(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매출엑셀에서 분류열)',
  `item_purchase_cate1` varchar(100) DEFAULT NULL COMMENT '매입내역 분류1(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매입엑셀에서 계정과목열)',
  `item_purchase_cate2` varchar(100) DEFAULT NULL COMMENT '매입내역 분류2(엑셀에 갑자기 추가된 열로 인해 추가된 필드매입엑셀에서 세부분류열)',
  `item_specifications` varchar(100) NOT NULL COMMENT '품목규격',
  `item_quantity` int(11) NOT NULL DEFAULT 0 COMMENT '품목수량',
  `item_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목단가',
  `item_supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목공급가액',
  `item_tax_amount` int(11) DEFAULT 0 COMMENT '품목세액',
  `item_remarks` text NOT NULL COMMENT '품목비고',
  `del_yn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부 (Y 삭제 / N삭제 안함)',
  `update_date` datetime DEFAULT NULL COMMENT '업데이트날짜',
  `regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`no`),
  KEY `type` (`type`),
  KEY `issue_date` (`issue_date`),
  KEY `sup_business_number` (`sup_business_number`),
  KEY `sup_mutual` (`sup_mutual`),
  KEY `rec_sup_business_number` (`rec_sup_business_number`),
  KEY `rec_sup_mutual` (`rec_sup_mutual`),
  KEY `regdate` (`regdate`),
  KEY `code` (`code`),
  KEY `use_year_month` (`use_year_month`),
  KEY `issue_year_month` (`issue_year_month`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='매출전자계산서목록'



*/




    // 보험사 1차가공 업로드 리스트 가져오기 getInsuranceCompanyBreakdownList($searchData,$per_page,$offset) 테이블은 insurance_company_first_processed_data 테이블을 사용한다.
    public function getInsuranceCompanyBreakdownList($searchData, $per_page, $offset){
        $sql = "
        SELECT 
                `a`.`no`, `a`.`code`, `a`.`use_year_month`, `a`.`subscription_date`, `b`.`catnm` AS `insurance_company`, `a`.`account`, `a`.`product_name`, `a`.`division`, `a`.`stay_duration`, `a`.`commission_rate`, `a`.`premium`, `a`.`charge`, `a`.`commission`, `a`.`revenue`, `a`.`channel`, `a`.`regdate`
        FROM 
                `insurance_company_first_processed_data` AS `a` 
                INNER JOIN insurance_company_category AS `b` ON a.insurance_company = b.catno
        WHERE 
                1=1 
                AND `a`.`del_yn` = 'N'
                ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.use_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.use_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['division'] != ''){
            $sql .= " and a.division = '".$searchData['division']."'";
        }
        if($searchData['stay_duration'] != ''){
            $sql .= " and a.stay_duration = '".$searchData['stay_duration']."'";
        }
        if($searchData['channel'] != ''){
            $sql .= " and a.channel = '".$searchData['channel']."'";
        }
        if($searchData['insurance_company'] != ''){
            $sql .= " and a.insurance_company = '".$searchData['insurance_company']."'";
        }
        // 거래처명 검색
        if($searchData['account'] != ''){
            $sql .= " and a.account like '%".$searchData['account']."%'";
        }


        $sql .= " order by a.no desc LIMIT $per_page OFFSET $offset";
        $rdata = $this->db->query($sql)->result();

        return $rdata;

        

    }


     /*
        보험사 데이터 1차 가공 분 업로드 자료 테이블 

        CREATE TABLE `insurance_company_first_processed_data` (
  `no` int(11) NOT NULL,
  `code` varchar(35) NOT NULL DEFAULT '' COMMENT 't_excel_upload_history 테이블의 업로드코드',
  `use_year_month` varchar(7) NOT NULL DEFAULT '' COMMENT '엑셀파일에 들어간 청약일 년도와 월 ''YYYY-MM'' 부분',
  `subscription_date` date DEFAULT NULL COMMENT '청약일',
  `insurance_company` varchar(50) NOT NULL DEFAULT '' COMMENT '보험사',
  `account` varchar(200) NOT NULL DEFAULT '' COMMENT '거래처 (추후에 상황 보고 줄여야 함)',
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


    // 보험사 1차가공 업로드 리스트 가져오기 getInsuranceCompanyBreakdownListTotalSum($searchData) 테이블은 insurance_company_first_processed_data 테이블을 사용한다. 
    public function getInsuranceCompanyBreakdownListTotalSum($searchData){
        $sql = "
        SELECT 
            count(*) as total_cnt, SUM(a.revenue) AS 'sum_revenue'
        FROM 
            `insurance_company_first_processed_data` AS `a`
            INNER JOIN insurance_company_category AS `b` ON a.insurance_company = b.catno
        WHERE 
            1=1 
            AND `a`.`del_yn` = 'N'
            ";

        if($searchData['searchDateY'] != ''){
            $sql .= " and a.use_year_month like '".$searchData['searchDateY']."%'";
        }
        if($searchData['searchDateM'] != ''){
            $sql .= " and a.use_year_month like '%".$searchData['searchDateM']."'";
        }
        if($searchData['division'] != ''){
            $sql .= " and a.division = '".$searchData['division']."'";
        }
        if($searchData['stay_duration'] != ''){
            $sql .= " and a.stay_duration = '".$searchData['stay_duration']."'";
        }
        if($searchData['channel'] != ''){
            $sql .= " and a.channel = '".$searchData['channel']."'";
        }
        if($searchData['insurance_company'] != ''){
            $sql .= " and a.insurance_company = '".$searchData['insurance_company']."'";
        }
        // 거래처명 검색
        if($searchData['account'] != ''){
            $sql .= " and a.account like '%".$searchData['account']."%'";
        }

        return $this->db->query($sql)->result();
        
    }





} // end class