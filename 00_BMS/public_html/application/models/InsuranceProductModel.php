<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/// 보험사 상품 관련 모델 ///
class InsuranceProductModel extends CI_Model{

    function __construct(){
        parent::__construct(); 
        $this->load->database();
        // 세션 정보 
        
    }

    // 보험 분류와 종목을 insurance_type 테이블에서 가져온다
    public function getInsuranceTypeList(){
        $sql = "SELECT * FROM insurance_type WHERE 1=1 AND delYn = 'N'";
        //$query = $this->db->query($sql);
        // $result = $query->result_array(); // 배열로 가져온다. // 배열로 가져올 경우 php 8버전에서는 따옴표를 넣어줘야 해서 귀찮음 
        $result = $this->db->query($sql)->result();
        return $result;
    }

    // 보험상품의 분류 목록 getInsuranceClassificationList
    public function getInsuranceClassificationList(){
        // 보험 분류를 2024-03-21 09:55:45 메일로 따로 받았음 최은선 대리님으로 부터 받음 이사님 까지 참조 걸려서 받은 메일
        $sql = "SELECT * FROM insurance_type WHERE 1=1 AND depth = '1' AND delYn = 'N' AND no > 64  ORDER BY typeNo ASC";
        //$query = $this->db->query($sql);
        // $result = $query->result_array(); // 배열로 가져온다. // 배열로 가져올 경우 php 8버전에서는 따옴표를 넣어줘야 해서 귀찮음 
        $result = $this->db->query($sql)->result();
        return $result;
    }

    // 보험 상품의 분류 목록으로 하위 분류 목록을 가져온다. typeNo like 를 사용하여 depth 2 인 것만 가져온다.
    public function getInsuranceTypeListByInsuranceClassification($insuranceClassification){
        $sql = "SELECT * FROM insurance_type WHERE 1=1 AND typeNo LIKE '".$insuranceClassification."%' AND depth = '2' AND delYn = 'N' ORDER BY typeNo ASC";
        $result = $this->db->query($sql)->result();
        return $result;
    }


    // 보험 상품을 등록 한다 regInsuranceProduct
    public function regInsuranceProduct($insuranceProductData){
        // 지금 보험 상품을 등록하려고 하는 어드민의 세션 아이디
        $adminId = $_SESSION['CRM_ID'];
        // 날짜 정보를 가져온다.
        $nowDate = date("Y-m-d H:i:s");
        // 보험 상품의 기본 정보를 저장한다.
        $insuranceProductData['regAdminId'] = $adminId; // 세션에서 관리자 아이디를 가져온다. 
        $insuranceProductData['regDate'] = $nowDate; // 현재 날짜를 가져온다.
        // 넘어온 데이터를 DB에 저장한다.
        $this->db->insert('insurance_product', $insuranceProductData);

        // 마지막으로 저장된 no 값을 가져온다.
        // 그런데 return $this->db->insert_id(); 이렇게 하니까
        // 값을 리턴 받지 못해서 변수에 담아서 리턴 해줬다.
        $last_id = $this->db->insert_id();
        return $last_id;
    }


    // 보험 상품의 리스트를 가져온다.
    public function getInsuranceProductList($searchData, $per_page, $offset){
        //print_r($searchData);
        /*
        // $searchData 검색 조건 데이터
        [insurance] => 001
        [insuranceType] => 002002
        [InsurancecompanySelectBox] => 001001
        [insuranceProductName] => 한화생명
        [internalContactPerson] => es.choi
        [insuranceProductCommissionS] => 20
        [insuranceProductCommissionE] => 40

        */
        // 검색 조건이 있는지 확인한다.
        $where = "";

        // 검색 조건이 있을 경우
        if(isset($searchData['insurance'])){
            if($searchData['insurance'] != ""){
                $where .= " AND insuranceCompanyCate LIKE '".$searchData['insurance']."%'";
            }
        }
        if(isset($searchData['insuranceType'])){
            if($searchData['insuranceType'] != ""){
                $where .= " AND insuranceType LIKE '".$searchData['insuranceType']."%'";
            }
        }
        if(isset($searchData['InsurancecompanySelectBox'])){
            if($searchData['InsurancecompanySelectBox'] != ""){
                $where .= " AND insuranceCompanyCate LIKE '".$searchData['InsurancecompanySelectBox']."%'";
            }
        }
        if(isset($searchData['insuranceProductName'])){
            if($searchData['insuranceProductName'] != ""){
                $where .= " AND insuranceProductName LIKE '%".$searchData['insuranceProductName']."%'";
            }
        }
        if(isset($searchData['internalContactPerson'])){
            if($searchData['internalContactPerson'] != ""){
                $where .= " AND b.adminName LIKE '%".$searchData['internalContactPerson']."%'";
            }
        }
        if(isset($searchData['insuranceProductCommissionS'])){
            if($searchData['insuranceProductCommissionS'] != ""){
                $where .= " AND insuranceProductCommission >= '".$searchData['insuranceProductCommissionS']."'";
            }
        }
        if(isset($searchData['insuranceProductCommissionE'])){
            if($searchData['insuranceProductCommissionE'] != ""){
                $where .= " AND insuranceProductCommission <= '".$searchData['insuranceProductCommissionE']."'";
            }
        }

        // @rnum:=@rnum+1 as rnum 또는 SQL_CALC_FOUND_ROWS 를 사용해서 admin_user 에서 조건에 맞는 전체 리스트를 가져온다
        // select 절에 @rnum:=@rnum+1 as rnum 이처럼 변수 지정해서 하나씩 증가하는 방법이나 또는 SQL_CALC_FOUND_ROWS 를 사용하면 전체 리스트를 가져올 수 있다.
        // 차이점은 리밋을 걸어서 가져온 리스트의 전체 갯수를 가져오는 것과 리밋 제한 없이 검색 조건의 전체 값을 가져온다는 것이 차이다.
        // 결과 값을 변수에 담아서 SQL_CALC_FOUND_ROWS 의 값도 함께 리턴 한다.
        // master id 를 제외한 리스트만 가져온다

        // 보험 상품의 리스트를 가져온다.
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.* , b.adminName 
                FROM 
                    insurance_product a
                    INNER JOIN admin_user b ON a.internalContactPerson = b.adminId
                
                WHERE delYn = 'N' ".$where." ORDER BY no DESC  LIMIT $per_page OFFSET $offset";

        // 디버그 쿼리 확인
        //echo $sql;


        $result = $this->db->query($sql)->result();
        return $result;
    }


    // 보험 상품테이블에 등록된 보험사 구분 데이터를 중복 제거 후 가져온다 getInsuranceCompanyDivisionList
    public function getInsuranceCompanyDivisionList(){
        $sql = "SELECT DISTINCT left(insuranceCompanyCate, 3) as insuranceCompanyCate FROM insurance_product WHERE 1=1 AND delYn = 'N' ORDER BY insuranceCompanyCate ASC";
        $result = $this->db->query($sql)->result();
        return $result;
    }


    // 보험 상품테이블에 등록된 보험사를 중복 제거 후 가져온다 getInsuranceCompanyList
    public function getInsuranceCompanyList(){
        //$sql = "SELECT DISTINCT insuranceCompanyCate FROM insurance_product WHERE 1=1 AND delYn = 'N' ORDER BY insuranceCompanyCate ASC";
        $sql = "
        SELECT 
            DISTINCT a.insuranceCompanyCate, b.catnm
        FROM 
            insurance_product a
            INNER JOIN insurance_company_category b ON a.insuranceCompanyCate = b.catno
        WHERE 1=1 AND a.delYn = 'N' ORDER BY insuranceCompanyCate ASC;
        ";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    // 보험 상품테이블에 등록된 보험 종목 가져오기 getInsuranceTypeListFromInsuranceProduct();
    public function getInsuranceTypeListFromInsuranceProduct(){
        $sql = "SELECT DISTINCT insuranceType FROM insurance_product WHERE delYn = 'N' ORDER BY insuranceType ASC";
        $result = $this->db->query($sql)->result();
        return $result;
    }


    // 보험 분류와 종목을 insurance_type 테이블에서 가져온다
    // 가져오되 typeNo 값들을 받아서 포함 하는 값들만 가져온다.
    public function getInsuranceTypeListFromInsuranceType($typeNs){
        $sql = "
        select 
            typeNo, typeNm, depth, typeNo2, depth_max_typeNo
        from
            insurance_type a
            LEFT JOIN (SELECT typeNo typeNo2, MAX(typeNo) depth_max_typeNo FROM insurance_type WHERE typeNo IN ({$typeNs}) GROUP BY pTypeNo) b ON a.pTypeNo = b.typeNo2 
            WHERE a.typeNo IN ({$typeNs})
        ORDER BY typeNo, sort
        ";
        $result = $this->db->query($sql)->result();
        return $result;
    }


    //보험 상품 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetInsuranceProductListSearchTotalCnt(){
		return $this->db->query("
		SELECT FOUND_ROWS() as total_cnt
		")->result();
	}
    

    // 보험사 구분 코드를 가지고 해당 보험사 구분에 해당하는 보험 상품리스트를 가져온다.
    public function getInsuranceProductListByInsuranceType($insuranceType){
        $sql = "SELECT SQL_CALC_FOUND_ROWS `no`, `insuranceProductName`, `insuranceProductCommission`, `insuranceProductAdditionalCommission`  FROM insurance_product WHERE 1=1 AND delYn = 'N' AND insuranceType = '{$insuranceType}' ORDER BY insuranceType desc";
        $result = $this->db->query($sql)->result();
        return $result;
    }


    // 보험상품의 플랜정보를 insurance_product_plans 에 등록한다 insertInsuranceProductPlans
    /*
    CREATE TABLE `insurance_product_plans` (
    `no` int(11) NOT NULL AUTO_INCREMENT,
    `product_code` varchar(14) NOT NULL,
    `plan_name` varchar(50) NOT NULL,
    `plan_summary` text NOT NULL,
    `del_yn` enum('Y','N') NOT NULL DEFAULT 'N',
    `update_date` datetime DEFAULT NULL,
    `reg_date` datetime NOT NULL,
    PRIMARY KEY (`no`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci

    */
    public function insertInsuranceProductPlans($planData){
        // 넘어온 데이터를 DB에 저장한다. 
        // DB에 저장 후 no 값을 리턴 받아서 다시 넘겨준다.
        $this->db->insert('insurance_product_plans', $planData);
        
        // 마지막으로 저장된 no 값을 가져온다. 
        // 그런데 return $this->db->insert_id(); 이렇게 하니까 
        // 값을 리턴 받지 못해서 변수에 담아서 리턴 해줬다.
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }


} // end of class
