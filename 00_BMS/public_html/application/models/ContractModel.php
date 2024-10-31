<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/// 보험사 상품 관련 모델 ///
class ContractModel extends CI_Model{

    function __construct(){
        parent::__construct(); 
        $this->load->database();
        // 세션 정보 
        
    }

    // 계약 테이블에 데이터를 저장한다. regContract($contractData);
    public function regContract($contractData){
        // 넘어온 데이터를 DB에 저장한다.
        $this->db->insert('contract', $contractData);
        // 저장된 데이터의 아이디를 가져온다.
        $last_id = $this->db->insert_id();
        // 저장된 데이터의 아이디를 리턴한다.
        return $last_id;
    }

    // 해당 코드 값을 받아서 계약 테이블에 있는 데이터를 가져온다.
    /*
        SELECT 
            `a`.*, `b`.`business_number`, `b`.`customer_name` as `customerCompanyName`, `b`.`manager_name` as `insurant`, 
            `b`.`manager_tel` as `insurant_tel`, `c`.`adminName` AS `contract_admin_name1`, `d`.`adminName` AS `contract_admin_name2`,
            `g`.catnm AS insurance_company_category_catenm, `h`.`manager_name`, `h`.`manager_tel`
        FROM 
            `contract` as `a`
            LEFT JOIN `customer_users` as `b` ON `a`.`customer_no` = `b`.`no`
            LEFT JOIN `admin_user` AS `c` ON `a`.`contract_admin1` = `c`.`adminId`
            LEFT JOIN `admin_user` AS `d` ON `a`.`contract_admin2` = `d`.`adminId`
            INNER JOIN insurance_product e ON a.insurance_product_no = e.no
            INNER JOIN insurance_company_category f ON e.insuranceCompanyCate = f.catno 
            INNER JOIN insurance_company_category g ON f.p_catno = g.catno 
            INNER JOIN `contract_customer_manager` `h` ON `a`.`no` = `h`.`contract_no`
        WHERE 
            `a`.`delete_yn` = 'N'
            AND `a`.`no` = '5'
    */
    public function getContractData($contractCode){
        $this->db->select('a.*, b.business_number, b.customer_name as customerCompanyName, b.manager_name as insurant, b.manager_tel as insurant_tel, c.adminName AS contract_admin_name1 , d.adminName AS contract_admin_name2, g.catnm AS insurance_company_category_catenm, h.manager_name, h.manager_tel');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');
        $this->db->join('insurance_product e', 'a.insurance_product_no = e.no', 'inner');
        $this->db->join('insurance_company_category f', 'e.insuranceCompanyCate = f.catno', 'inner');
        $this->db->join('insurance_company_category g', 'f.p_catno = g.catno', 'inner');
        $this->db->join('contract_customer_manager h', 'a.no = h.contract_no', 'inner');
        $this->db->where('a.delete_yn', 'N');
        $this->db->where('a.no', $contractCode);
        $result = $this->db->get();
        $result = $result->result_array();
        return $result;
    }

    // 보험계약 리스트를 가져온다.
    public function getContractList($searchData, $per_page, $offset){
        //print_r($searchData);
        /*
        // $searchData 검색 조건 데이터
        [insurance] => 001
        [insuranceType] => 002002
        [InsurancecompanySelectBox] => 001001
        [searchText] => 
        [searchDate] => 
        [searchDate2] => 
        [searchDateType] => 
        [searchDateType2] => 
        */

        // 계약테이블에 있는 데이터를 가져온다.
        // customer_users 테이블과 조인하여 고객명을 'customerCompanyName' 이라는 필드로 가져온다.
        /*
        SELECT 
            `a`.*, b.business_number, `b`.`customer_name` as `customerCompanyName`, `b`.`manager_name` as `insurant`, `b`.`manager_tel` as `insurant_tel`, 
            c.adminName AS contract_admin_name1 , d.adminName AS contract_admin_name2
        FROM 
            `contract` as `a`
            LEFT JOIN `customer_users` as `b` ON `a`.`customer_no` = `b`.`no`
            LEFT JOIN `admin_user` AS `c` ON `a`.`contract_admin1` = `c`.adminId
            LEFT JOIN `admin_user` AS `d` ON `a`.`contract_admin2` = `d`.adminId
        WHERE 
            `a`.`delete_yn` = 'N'
            AND a.contract_date LIKE '2024-01%' // 진행일자가 있는 경우
            AND b.customer_name LIKE '%야옹%' // 거래처명이 있는 경우  
            AND b.business_number = '123-45-67890' // 사업자번호가 있는 경우
            AND a.policy_number = 'A01357911' // 계약번호가 있는 경우
            AND a.insurance_type = '002002' // 구분이 있는 경우
            AND b.manager_name LIKE '%야옹%' // 거래처담당자명이 있는 경우
            AND a.insurance_period_start BETWEEN '2024-01-01' AND '2024-01-30' // 보험시작일 범위가 있는 경우
            AND ( c.adminName LIKE '%은%' OR d.adminName LIKE '%은%' ) // 계약 담당자가 있는 경우
        ORDER BY `a`.`no` DESC a.contract_admin1 asc, a.contract_admin2 asc
        */

        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->select('a.*, b.business_number, b.customer_name as customerCompanyName, b.manager_name, b.manager_tel as insurant_tel, c.adminName AS contract_admin_name1 , d.adminName AS contract_admin_name2');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');        
        $this->db->where('a.delete_yn', 'N');

        // 진행일자가 있는 경우
        if($searchData['searchDate'] != ''){
            $this->db->like('a.contract_date', $searchData['searchDate'], 'after');
        }
        // 거래처명이 있는 경우
        if($searchData['customerCompanyName'] != ''){
            $this->db->like('b.customer_name', $searchData['customerCompanyName']);
        }
        // 사업자번호가 있는 경우
        if($searchData['business_number'] != ''){
            $this->db->where('b.business_number', $searchData['business_number']);
        }
        // 계약번호가 있는 경우
        if($searchData['policy_number'] != ''){
            $this->db->where('a.policy_number', $searchData['policy_number']);
        }
        // 구분이 있는 경우
        if($searchData['insuranceType'] != ''){
            $this->db->where('a.insurance_type', $searchData['insuranceType']);
        }
        // 거래처담당자명이 있는 경우
        if($searchData['manager_name'] != ''){
            $this->db->like('b.manager_name', $searchData['manager_name']);
        }
        // 보험시작일 범위가 있는 경우
        if($searchData['searchDateType'] != '' && $searchData['searchDateType2'] != ''){
            $this->db->where('a.insurance_period_start >=', $searchData['searchDateType']);
            $this->db->where('a.insurance_period_start <=', $searchData['searchDateType2']);
        }
        // 계약 담당자가 있는 경우
        if($searchData['contract_admin_name'] != ''){
            $this->db->group_start();
            $this->db->like('c.adminName', $searchData['contract_admin_name']);
            $this->db->or_like('d.adminName', $searchData['contract_admin_name']);
            $this->db->group_end();
        }

        // 정렬        
        $this->db->order_by('a.no', 'DESC');
        if($searchData['orderByField'] != ''){
            // $searchData['orderByField'] 배열로 넘어온다 
            foreach($searchData['orderByField'] as $key => $value){
                $this->db->order_by($value, $searchData['orderByType'][$key]);
            }
        }
        //$this->db->order_by('a.contract_admin1', 'asc');
        //$this->db->order_by('a.contract_admin2', 'asc');

        // 페이징 처리
        $this->db->limit($per_page, $offset);

        //$result = $this->db->get();
        //$result = $result->result_array();
        //return $result;
        return $this->db->get()->result();

    }

    // 계약 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetContractListTotalCnt(){
		return $this->db->query("
		SELECT FOUND_ROWS() as total_cnt
		")->result();
	}

    // 계약정보 뷰페이지에서 상담 후 히스토리를 저장한다. addHistory($contractNo, $taskGr, $add_history, $username, $uploadFiles);
    public function addHistory($contractNo, $taskGr, $add_history, $userid, $uploadFiles = ''){
        $historyData = array(
            'contract_no' => $contractNo,
            'task_group' => $taskGr,
            'add_history' => $add_history,
            'uploadFiles' => $uploadFiles,
            'add_date' => date('Y-m-d H:i:s'),
            'add_user' => $userid
        );
        $this->db->insert('contract_memo_history', $historyData);
    }

    // 계약정보 뷰페이지에서 상담 후 히스토리를 가져온다. getConsultHistoryList($contractNo);
    /*
        SELECT a.*, b.adminName
        FROM 
            contract_memo_history a
            INNER JOIN admin_user b ON a.add_user = b.adminId 
        WHERE a.contract_no = 1 
        ORDER BY a.idx DESC 	
    */
    public function getConsultHistoryList($contractNo){
        $this->db->select('a.*, b.adminName');
        $this->db->from('contract_memo_history a');
        $this->db->join('admin_user b', 'a.add_user = b.adminId', 'inner');
        $this->db->where('a.contract_no', $contractNo);
        $this->db->order_by('a.idx', 'DESC');
        //$result = $this->db->get();
        //$result = $result->result_array(); // 배열로 가져온다.
        return $this->db->get()->result();
        //return $result;
    }


    // 계약정보 뷰페이지에서 상담 후 히스토리를 최근 내용으로 1개만 가져온다. getConsultHistoryListPiece($contractNo);
    /*
        SELECT a.*, b.adminName
        FROM 
            contract_memo_history a
            INNER JOIN admin_user b ON a.add_user = b.adminId 
        WHERE a.contract_no = 1 
        ORDER BY a.idx DESC 
        LIMIT 1
    */
    public function getConsultHistoryListPiece($contractNo){
        $this->db->select('a.*, b.adminName');
        $this->db->from('contract_memo_history a');
        $this->db->join('admin_user b', 'a.add_user = b.adminId', 'inner');
        $this->db->where('a.contract_no', $contractNo);
        $this->db->order_by('a.idx', 'DESC');
        $this->db->limit(1);
        //$result = $this->db->get();
        //$result = $result->result_array(); // 배열로 가져온다.
        return $this->db->get()->result();
        //return $result;
    }

    // 보험 종료일자가 입력받은 날짜와 오늘사이에 있는 계약 리스트를 가져온다. getContractListByEndDate($endDate);
    /*
        SELECT `a`.*, `b`.`business_number`, `b`.`customer_name` as `customerCompanyName`, `b`.`manager_name` as `insurant`, `b`.`manager_tel` as `insurant_tel`, `c`.`adminName` AS `contract_admin_name1`, `d`.`adminName` AS `contract_admin_name2`, `e`.`typeNm` AS `insurance_type_name`
        FROM 
            `contract` as `a`
            LEFT JOIN `customer_users` as `b` ON `a`.`customer_no` = `b`.`no`
            LEFT JOIN `admin_user` AS `c` ON `a`.`contract_admin1` = `c`.`adminId`
            LEFT JOIN `admin_user` AS `d` ON `a`.`contract_admin2` = `d`.`adminId`
            INNER JOIN insurance_type AS e ON a.insurance_type = e.typeNo
        WHERE 
            `a`.`delete_yn` = 'N'
            AND `a`.`insurance_period_end` BETWEEN '2024-02-21' AND '2024-05-21'
        ORDER BY `a`.`no` DESC, `a`.`contract_admin1` ASC, `a`.`contract_admin2` ASC
    */
    public function getContractListByEndDate($endDate){
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->select('a.*, b.business_number, b.customer_name as customerCompanyName, b.manager_name, b.manager_tel as insurant_tel, b.email AS `insurant_email`, c.adminName AS contract_admin_name1 , d.adminName AS contract_admin_name2, e.typeNm AS insurance_type_name');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');
        $this->db->join('insurance_type AS e', 'a.insurance_type = e.typeNo', 'inner');
        $this->db->where('a.delete_yn', 'N');
        $this->db->where('a.insurance_period_end >=', date('Y-m-d'));
        $this->db->where('a.insurance_period_end <=', $endDate);
        $this->db->order_by('a.no', 'DESC');
        $this->db->order_by('a.contract_admin1', 'ASC');
        $this->db->order_by('a.contract_admin2', 'ASC');
        $result = $this->db->get();
        $result = $result->result_array();
        return $result;
    }


    // 마이페이지에서 볼 내가 계약중인 보험 상품리스트 중에 보험 상품명들을 가져온다. getMyContractList($userid);
    /*
    SELECT DISTINCT a.insurance_product_name FROM contract AS a 
    WHERE 
    a.contract_admin1 = 'es.choi' OR a.contract_admin2 = 'es.choi'
    AND a.insurance_period_start >= NOW()
    AND a.insurance_period_end <= NOW()
    */
    public function getMyContractList($userid){
        $sql = "
        SELECT 
            DISTINCT a.insurance_product_name 
        FROM 
            contract AS a 
        WHERE 
            a.contract_admin1 = '". $userid ."' OR a.contract_admin2 = '". $userid ."'
            AND a.insurance_period_start >= NOW()
            AND a.insurance_period_end <= NOW()
        
        ";

        $result = $this->db->query($sql)->result();
        return $result;


    }
    // getMyContractListData(세션아이디, 거래처명, 사업자번호, 증권번호, 보험상품명, 보험기간시작일검색스타트일, 보험기간시작일검색엔드일, 페이지당 보여줄 리스트 갯수, 오프셋);
    // 마이페이지에서 계약중인 리스트를 가져온다. 
    // getMyContractListData('es.choi', $customerCompanyName = '', $business_number = '', $policy_number = '', $insuranceProductName = '', $searchDateType = '', $searchDateType2 = '', $per_page = 5, $offset);
    /*
    SELECT 
        `a`.*, 
        `b`.`business_number`, `b`.`customer_name` as `customerCompanyName`, `b`.`manager_name` as `insurant`, `b`.`manager_tel` as `insurant_tel`, b.email AS `insurant_email`, 
        CONCAT( `c`.`adminName`, '/', `d`.`adminName`) AS contract_admin_names, `e`.`typeNm` AS `insurance_type_name`
    FROM 
        `contract` as `a`
        LEFT JOIN `customer_users` as `b` ON `a`.`customer_no` = `b`.`no`
        LEFT JOIN `admin_user` AS `c` ON `a`.`contract_admin1` = `c`.`adminId`
        LEFT JOIN `admin_user` AS `d` ON `a`.`contract_admin2` = `d`.`adminId`
        INNER JOIN insurance_type AS e ON a.insurance_type = e.typeNo
    WHERE 
        `a`.`delete_yn` = 'N'
        
        AND customer_name LIKE '%주식회사%'
        AND business_number = '123-45-67890'
        AND policy_number = 'A01357916'
        AND insurance_product_name LIKE '%삼성생명%'
    AND insurance_period_start BETWEEN '2024-01-21' AND '2024-05-21'
        
    ORDER BY `a`.`no` DESC
    */
    public function getMyContractListData($userid, $customerCompanyName = '', $business_number = '', $policy_number = '', $insuranceProductName = '', $searchDateType = '', $searchDateType2 = '', $per_page = 5, $offset){

        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->select('a.*, b.business_number, b.customer_name as customerCompanyName, b.manager_name, b.manager_tel as insurant_tel, b.email AS `insurant_email`, CONCAT( `c`.`adminName`, \'/\', `d`.`adminName`) AS contract_admin_names, `e`.`typeNm` AS `insurance_type_name`, b.customer_name');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');
        $this->db->join('insurance_type AS e', 'a.insurance_type = e.typeNo', 'inner');
        $this->db->where('a.delete_yn', 'N');
        $this->db->group_start();
        $this->db->where('a.contract_admin1', $userid);
        $this->db->or_where('a.contract_admin2', $userid);
        $this->db->group_end();

        // 거래처명이 있는 경우
        if($customerCompanyName != ''){
            $this->db->like('b.customer_name', $customerCompanyName);
        }
        // 사업자번호가 있는 경우
        if($business_number != ''){
            $this->db->where('b.business_number', $business_number);
        }
        // 계약번호가 있는 경우
        if($policy_number != ''){
            $this->db->where('a.policy_number', $policy_number);
        }
        // 보험상품명이 있는 경우
        if($insuranceProductName != ''){
            $this->db->like('a.insurance_product_name', $insuranceProductName);
        }
        // 보험기간시작일검색스타트일, 보험기간시작일검색엔드일 이 있는 경우
        if($searchDateType != '' && $searchDateType2 != ''){
            $this->db->where('a.insurance_period_start >=', $searchDateType);
            $this->db->where('a.insurance_period_start <=', $searchDateType2);
        }

        // 정렬
        $this->db->order_by('a.no', 'DESC');

        // 페이징 처리
        $this->db->limit($per_page, $offset);

        return $this->db->get()->result();
    }


    // 보험사 정보페이지에서 계약리스트를 가져온다 getContractListFromCustomerNo($customerNo);
    /*
    SELECT

        `a`.*, `b`.`business_number`, `b`.`customer_name` as `customerCompanyName`, `b`.`manager_name` as `insurant`, `b`.`manager_tel` as `insurant_tel`, b.email AS `insurant_email`, 
        CONCAT( `c`.`adminName`, '/', `d`.`adminName`) AS contract_admin_names, `e`.`typeNm` AS `insurance_type_name`
    FROM
        `contract` as `a`
        LEFT JOIN `customer_users` as `b` ON `a`.`customer_no` = `b`.`no`
        LEFT JOIN `admin_user` AS `c` ON `a`.`contract_admin1` = `c`.`adminId`
        LEFT JOIN `admin_user` AS `d` ON `a`.`contract_admin2` = `d`.`adminId`
        INNER JOIN insurance_type AS e ON a.insurance_type = e.typeNo
    WHERE 
        `a`.`delete_yn` = 'N'
        AND `a`.`customer_no` = 1
    ORDER BY `a`.`no` DESC
    */
    public function getContractListFromCustomerNo($customerNo){
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->select('a.*, b.business_number, b.customer_name as customerCompanyName, b.manager_name, b.manager_tel as insurant_tel, b.email AS `insurant_email`, `c`.`adminName` AS `adminName1`, `d`.`adminName` AS `adminName2`, `e`.`typeNm` AS `insurance_type_name');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');
        $this->db->join('insurance_type AS e', 'a.insurance_type = e.typeNo', 'inner');
        $this->db->where('a.delete_yn', 'N');
        $this->db->where('a.customer_no', $customerNo);
        $this->db->order_by('a.no', 'DESC');
        return $this->db->get()->result();
    }


    // 보험사 정보페이지에서 계약된 보험의 관리 히스토리를 가져온다 getContractListHistoryFromCustomerNo($customerNo);
    /*
    SELECT 
        a.idx, a.task_group, a.add_history, a.add_date, d.adminName, b.insurance_product_name  
    FROM 
        contract_memo_history AS a
        INNER JOIN contract AS b ON a.contract_no = b.`no`
        INNER JOIN customer_users AS c ON b.customer_no = c.`no`
        INNER JOIN admin_user AS d ON a.add_user = d.adminId
    WHERE 
        b.customer_no = 1 
    ORDER BY a.idx DESC 
    */
    public function getContractListHistoryFromCustomerNo($contractNo){
        $this->db->select('a.idx, a.task_group, a.add_history, a.add_date, d.adminName, b.insurance_product_name');
        $this->db->from('contract_memo_history AS a');
        $this->db->join('contract AS b', 'a.contract_no = b.no', 'inner');
        $this->db->join('customer_users AS c', 'b.customer_no = c.no', 'inner');
        $this->db->join('admin_user AS d', 'a.add_user = d.adminId', 'inner');
        $this->db->where('b.no', $contractNo);
        $this->db->order_by('a.idx', 'DESC');
        return $this->db->get()->result();
        
    }

    // contract 테이블에서 contract_admin1 로 그룹핑하여 내부에 담당자들의 이메일을 조회한다.
    /* 
    SELECT 
        contract_admin1, adminEmail
    FROM 
        contract AS a 
        INNER JOIN admin_user AS b ON a.contract_admin1 = b.adminId
    GROUP BY contract_admin1
    */
    public function getContractAdmin1EmailList(){
        $this->db->select('contract_admin1, adminEmail');
        $this->db->from('contract AS a');
        $this->db->join('admin_user AS b', 'a.contract_admin1 = b.adminId', 'inner');
        $this->db->group_by('contract_admin1');
        return $this->db->get()->result();
    }
    

    // 오늘 기준 30일 이내이면서 내부 담당자 아이디로 조회한다.
    public function getContractListByEndDateAndAdmin($todayAddday, $contractAdminId, $dday){
        $this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->select('a.*, '.$dday.' as `dday`, b.business_number, b.customer_name as customerCompanyName, b.manager_name, b.manager_tel as insurant_tel, b.email AS `insurant_email`, `c`.`adminName` AS `adminName1`, `d`.`adminName` AS `adminName2`, `e`.`typeNm` AS `insurance_type_name');
        $this->db->from('contract as a');
        $this->db->join('customer_users as b', 'a.customer_no = b.no', 'left');
        $this->db->join('admin_user AS c', 'a.contract_admin1 = c.adminId', 'left');
        $this->db->join('admin_user AS d', 'a.contract_admin2 = d.adminId', 'left');
        $this->db->join('insurance_type AS e', 'a.insurance_type = e.typeNo', 'inner');
        $this->db->where('a.delete_yn', 'N');        
        $this->db->where('a.insurance_period_end =', $todayAddday);
        $this->db->where('a.contract_admin1', $contractAdminId);
        return $this->db->get()->result();
    }

    // updateContractExpirationNoticeResult 함수는 계약 테이블의 expiration_notice_result 필드를 업데이트 한다.
    public function updateContractExpirationNoticeResult($contractNo, $expirationNoticeResult){
        $this->db->set('expiration_notice_result', $expirationNoticeResult);
        $this->db->where('no', $contractNo);
        $this->db->update('contract');
    }


    // 계약정보에서 계약된 회사의 담당자 정보저장한다. regContractCustomerManager($contractNo, $managerName, $managerTel);
    /*
    CREATE TABLE `contract_customer_manager` (
        `contract_no` int(11) NOT NULL COMMENT '계약테이블 PK',
        `manager_name` varchar(50) DEFAULT NULL COMMENT '계약사에 소속된 담당자 이름',
        `manager_tel` varchar(13) DEFAULT NULL COMMENT '계약사에 소속된 담당자 연락처',
        UNIQUE KEY `contract_no_uniq` (`contract_no`),
        KEY `contract_no` (`contract_no`),
        KEY `manager_name` (`manager_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
    */
    
    public function regContractCustomerManager($contractNo, $managerName, $managerTel){
        $managerData = array(
            'contract_no' => $contractNo,
            'manager_name' => $managerName,
            'manager_tel' => $managerTel
        );
        $this->db->insert('contract_customer_manager', $managerData);
    }



} // end of class
