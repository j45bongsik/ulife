<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceCompanyModel extends CI_Model{

    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }

	/// 보험사 관련 모델 ///


    // 보험사 구분 리스트 getInsuranceCompanyDivisionList  insurance_company_category 테이블에서 가져온다. catno, catnm, depth, catno2, depth_max_catno 를 catno, sort 순으로 가져온다.
    // depth_max_catno 는 해당 부모카테로리 중 가장 하위 카테고리의 가장 큰 catno 를 가져온다.
    // select 
    //      catno, catnm, depth, catno2, depth_max_catno
    //      from
    //          insurance_company_category a
    //          LEFT JOIN (SELECT catno catno2, MAX(catno) depth_max_catno FROM insurance_company_category GROUP BY p_catno) b ON a.p_catno = b.catno2 
    //  ORDER BY catno, sort
    public function getInsuranceCompanyDivisionList(){
        $this->db->select("a.catno, a.catnm, a.depth, a.p_catno, b.depth_max_catno");
        $this->db->from("insurance_company_category a");
        $this->db->join("(SELECT catno catno2, MAX(catno) depth_max_catno FROM insurance_company_category GROUP BY p_catno) b", "a.p_catno = b.catno2", "left");
        $this->db->order_by("a.catno", "asc");
        return $this->db->get()->result();
    }

	// 보험사 구분 리스트 getInsuranceCompanyDivisionListForArray  insurance_company_category 테이블에서 가져온다. catno, catnm 를 가져온다.
	public function getInsuranceCompanyDivisionListForArray(){
		$this->db->select("catno, catnm");
		return $this->db->get('insurance_company_category')->result();
    }

    // 보험사 상세보기
    public function GetCustomer($seq)
    {
        $this->db->where("customer_users.no", $seq);
        return $this->db->get('customer_users')->result();
    }


    // 보험사 구분 1차 카테고리 가져오기 getInsuranceCompanyDivisionCate1List
    public function getInsuranceCompanyDivisionCate1List(){
        $this->db->where("depth", 1);
        $this->db->order_by("catno", "asc");
        return $this->db->get('insurance_company_category')->result();
    }


    // 카테고리에 해당하는 하위 보험사 목록 가져오기 getInsuranceCompanyListByCatno // 1차 카테고리는 제외하고 2차 카테고리만 가져온다.
    public function getInsuranceCompanyListByCatno($catno){
        $this->db->where("p_catno", $catno);
        $this->db->where("depth", 2);
        $this->db->order_by("no", "asc");
        return $this->db->get('insurance_company_category')->result();
    }


	// 보험사 등록 insurancecompany_reg
	public function insurancecompany_reg($data){
		return $this->db->insert("insurance_company", $data);
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 이미 insurance_company 에 해당 보험사에 해당하는 해당 부서가 있는지 확인 한다 getInsuranceCompanyListByDeptName($data['insuranceCompanyCate'] ,$data['insuranceCompanyDeptName']);
	public function getInsuranceCompanyListByDeptName($insuranceCompanyCate, $insuranceCompanyDeptName){
		$this->db->where("insuranceCompanyCate", $insuranceCompanyCate);
		$this->db->where("insuranceCompanyDeptName", $insuranceCompanyDeptName);
		return $this->db->get('insurance_company')->result();
	}
	

	// 이미 insurance_company 에 insuranceCompanyManagerMobile(보험사 담당자 휴대전화) 가 등록이 되어 있는지 확인 한다.
	public function getInsuranceCompanyListByManagerMobile($insuranceCompanyManagerMobile){
		$this->db->where("insuranceCompanyManagerMobile", $insuranceCompanyManagerMobile);
		return $this->db->get('insurance_company')->result();
	}


	// 이미 insurance_company 에 insuranceCompanyManagerEmail(보험사 담당자 이메일) 가 등록이 되어 있는지 확인 한다.
	public function getInsuranceCompanyListByManagerEmail($insuranceCompanyManagerEmail){
		$this->db->where("insuranceCompanyManagerEmail", $insuranceCompanyManagerEmail);
		return $this->db->get('insurance_company')->result();
	}

	// 보험사 리스트보기
	// 지금은 이렇게 하지만 추후 datatable 로 변경해야 한다.        
        /*  보험사 리스트 가져오기 검색 조건은 보험사 코드, 부서명, 담장자명, 연락처, 이메일 이다.
        SELECT 
            c.`no`, cc.catnm, c.insuranceCompanyDeptName, concat(c.insuranceCompanyManager, ' / ', c.insuranceCompanyManagerPosition) AS manager, 
            c.insuranceCompanyManagerTel, c.insuranceCompanyManagerMobile, c.insuranceCompanyManagerEmail, a.adminName, c.memo
        FROM 
            insurance_company c
            INNER JOIN insurance_company_category cc ON c.insuranceCompanyCate = cc.catno
            INNER JOIN admin_user a ON c.internalContactPerson = a.adminId 
        WHERE 
            1 = 1
            AND cc.catno = '001002'
            AND c.insuranceCompanyDeptName LIKE '%부서명%'
            AND c.insuranceCompanyManager LIKE '%담당자명%'
            AND c.insuranceCompanyManagerTel LIKE '%연락처%'
            AND c.insuranceCompanyManagerEmail LIKE '%이메일%'
        ORDER BY c.`no` DESC
		*/

	public function GetInsuranceCompanyList($search_param, $limit){
		$where = "where 1 = 1";
		if(isset($search_param['insuranceCompanyCate'])){
			if($search_param['insuranceCompanyCate']){
				$where .= " and cc.catno = '".$search_param['insuranceCompanyCate']."' ";
			}
		}

		if(isset($search_param['insuranceCompanyDeptName'])){
			if(trim($search_param['insuranceCompanyDeptName'])){
				$where .= " and c.insuranceCompanyDeptName like '%".$search_param['insuranceCompanyDeptName']."%' ";
			}
		}

		if(isset($search_param['insuranceCompanyManager'])){
			if(trim($search_param['insuranceCompanyManager'])){
				$where .= " and c.insuranceCompanyManager like '%".$search_param['insuranceCompanyManager']."%' ";
			}
		}

		if(isset($search_param['insuranceCompanyManagerTel'])){
			if(trim($search_param['insuranceCompanyManagerTel'])){
				$where .= " and c.insuranceCompanyManagerTel like '%".$search_param['insuranceCompanyManagerTel']."%' ";
			}
		}

		if(isset($search_param['insuranceCompanyManagerEmail'])){
			if(trim($search_param['insuranceCompanyManagerEmail'])){
				$where .= " and c.insuranceCompanyManagerEmail like '%".$search_param['insuranceCompanyManagerEmail']."%' ";
			}
		}

		$sql = "
				SELECT 
					SQL_CALC_FOUND_ROWS c.`no`, cc2.catnm as gubun, cc.catnm, c.insuranceCompanyDeptName, concat(c.insuranceCompanyManager, ' / ', c.insuranceCompanyManagerPosition) AS manager, 
					c.insuranceCompanyManagerTel, c.insuranceCompanyManagerMobile, c.insuranceCompanyManagerEmail, 
					a.adminName, c.memo 
				FROM 
					insurance_company c 
					INNER JOIN insurance_company_category cc ON c.insuranceCompanyCate = cc.catno 
					INNER JOIN insurance_company_category cc2 ON cc.p_catno = cc2.catno 
					INNER JOIN admin_user a ON c.internalContactPerson = a.adminId 
				$where 
				ORDER BY c.`no` DESC 
				$limit";
		return $this->db->query($sql)->result();
		// 쿼리 확인 하기
		//echo "SQL : ".$this->db->last_query();
	}


	//어드민 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetInsuranceCompanySearchTotalCnt(){
		return $this->db->query("
		SELECT FOUND_ROWS() as total_cnt
		")->result();
	}


	// insurance_company 테이블에서 등록된 부서명만 가져온다 ( 중복 제거 )
	public function getInsuranceCompanyDeptNameList(){
		$this->db->select("no, insuranceCompanyDeptName");
		$this->db->distinct();
		$this->db->order_by("insuranceCompanyDeptName", "asc");
		return $this->db->get('insurance_company')->result();
	}


	// 해당 보험사에 등록된 부서명을 가져온다.
	public function getInsuranceCompanyDeptNameListByInsuranceCompanyCate($catno){
		// no 값과 부서명을 가져온다.
		$this->db->select("no, insuranceCompanyDeptName");
		$this->db->where("insuranceCompanyCate", $catno);
		$this->db->where("delYn", "N");
		//$this->db->distinct();
		$this->db->order_by("insuranceCompanyDeptName", "asc");
		return $this->db->get('insurance_company')->result();
	}

/*
	// 고객사 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetInsuranceCompanyListTotalCnt(){
		return $this->db->query("
		SELECT FOUND_ROWS() as total_cnt
		")->result();
	}


	// 고객사 리스트 가져오기 ( 등록된 내용을 보기위한 임시 페이지에서 보기 위해 만듬 )
	public function GetCustomerListAll_TMP(){
		//$this->db->where("customer_users.del_yn", "N");
		$sql = "select * from customer_users order by 1 desc";
		$data['LIST'] = $this->db->query($sql)->result();
		$data['sql'] = $sql;
		return $data;
	}


	// 고객사를 등록 한다. CustomerRegProc ( 고객사 등록 ) 
	public function CustomerRegProc($data){
		return $this->db->insert("customer_users", $data);
		// 쿼리 확인 하기 
		echo "SQL : ".$this->db->last_query();
	}


	// 사업자 등록번호 중복 체크
	public function CheckBizNo($business_number){
		$this->db->where("customer_users.business_number", $business_number);
		return $this->db->get('customer_users')->result();
	}


	// 주민번호 중복 체크 (암호화 된 주민번호) 
	// 한개만 나올테니까 limit 1 을 사용해서 한개만 가져온다.
	public function CheckJuminNo($resident_number){
		// 결과가 한개만 나올테니까 limit 1 을 사용해서 한개만 가져온다.
		$this->db->limit(1);
		$this->db->where("customer_users.resident_number_encrypt", $resident_number);
		return $this->db->get('customer_users')->result();		
	}


	// 이메일 중복 체크
	public function CheckEmail($email){
		$this->db->where("customer_users.email", $email);
		return $this->db->get('customer_users')->result();
	}

	// 연락처 중복 체크
	public function CheckTel($tel){
		$this->db->where("customer_users.tel", $tel);
		return $this->db->get('customer_users')->result();
	}

	// 휴대전화 중복 체크
	public function CheckMobile($mobile){
		$this->db->where("customer_users.mobile", $mobile);
		return $this->db->get('customer_users')->result();
	}


	/*
	//이벤트 페이징
	public function GetAdminPage($db_req){
        return $this->db->query("
        SELECT  *  FROM ADMIN_USERS 
        WHERE `ad_del_yn` = 'N'
        ORDER BY `seq` 
        DESC  Limit  $db_req[0], $db_req[1]
        ")->result();
    }

	function edit_sql($search_param){
		$where = "del_yn = 'N' ";
		if(isset($search_param['ev_name'])) { if($search_param['ev_name']){$where .= " and event_seq = '".$search_param['ev_name']."'"; }}
		if(isset($search_param['sex'])) { if($search_param['sex']){$where .= " and sex = '".$search_param['sex']."'"; }}
		
		$where1 = "";
		$where2 = "";
		$where2_tmp = array();
		if(isset($search_param['sdate']) && isset($search_param['edate'])) {

			$where1 = " and pub_date between '".$search_param['sdate']."' and '".$search_param['edate']."'";
		} else {
			if(isset($search_param['sdate'])) { $where1 = " and pub_date >= '".$search_param['sdate']."'"; }
			if(isset($search_param['edate'])) { $where1 = " and pub_date <= '".$search_param['edate']."'"; }
		}

		if(isset($search_param['keyword']) && strlen($search_param['keyword']) > 0) { $where .= "and concat(name, tel) like '%".$search_param['keyword']."%'"; }

		if(isset($search_param['age_10'])) { array_push( $where2_tmp, " age between 10 and 19");}
		if(isset($search_param['age_20'])) { array_push( $where2_tmp, " age between 20 and 29");}
		if(isset($search_param['age_30'])) { array_push( $where2_tmp, " age between 30 and 39");}
		if(isset($search_param['age_40'])) { array_push( $where2_tmp, " age between 40 and 49");}
		if(isset($search_param['age_50'])) { array_push( $where2_tmp, " age >= 50");}

		if(count($where2_tmp) > 0) {
			$where2 = " and ";
			$where2 = $where2 . "( " .implode(' or ', $where2_tmp) . " )";
		}

		if(isset($search_param['ref'])) { if($search_param['ref']) { $where .= "and ref = '".$search_param['ref']."'"; } }

		$where = $where.$where1.$where2;

		return $where;
	}
	
	*/
}