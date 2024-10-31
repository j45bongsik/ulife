<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model{

    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }

	/// 고객사 관련 모델 ///


    // 고객사 상세보기
    public function GetCustomer($seq)
    {
        $this->db->where("customer_users.no", $seq);
        return $this->db->get('customer_users')->result();
    }


	// 고객사 리스트보기
	public function GetCustomerList($per_page, $offset)
	{
		// 검색된 고객사 전체 리스트 개수를 SQL_CALC_FOUND_ROWS 힌트를 사용 해서 가져온다.
		// SQL_CALC_FOUND_ROWS 를 사용하면 LIMIT 절에 의해 제한된 전체 레코드 수를 구할 수 있다.
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM customer_users WHERE del_yn = 'N' ORDER BY no DESC LIMIT $per_page OFFSET $offset";
		return $this->db->query($sql)->result();
		// 쿼리 확인 하기
		//echo "SQL : ".$this->db->last_query();
	}

	// 고객사 리스트 보기 // 실제 거래처 리스트를 가져온다.
	/*
	SELECT 
		d.inflow_channel, d.inflow_channel_etc, a.no AS ano, a.division , a.customer_name, a.business_number, a.resident_number, a.manager_name, 
		b.contract_max_no, d.insurance_product_no, d.insurance_product_name, 
		d.insurance_period_start, d.insurance_period_end, d.contract_date, d.insurant, 
		a.manager_name, a.manager_tel,  d.contract_admin1, d.contract_admin2, 
		e.adminName, f.adminName, d.insurance_type 
	FROM 
		customer_users AS a 
		LEFT JOIN ( SELECT max(c.no) contract_max_no , c.customer_no FROM contract AS C GROUP BY customer_no ) AS b ON a.`no` = b.customer_no
		LEFT JOIN contract AS d ON b.contract_max_no = d.`no`
		LEFT JOIN admin_user AS e ON d.contract_admin1 = e.adminId
		LEFT JOIN admin_user AS f ON d.contract_admin2 = f.adminId
	WHERE
		a.del_yn = 'N'
		and a.customer_name like '%거래처명%'
		and a.business_number = '사업자번호'
		and a.resident_number = '증권번호'
		and a.manager_name = '%거래처 담당자%'
		and ( e.adminName like '%계약 담당자1%' or f.adminName like '%계약 담당자1%' )
		and d.insurance_type = '구분'
		order by a.no desc
	*/
	public function GetCustomerListNew($searchData, $per_page, $offset){
		// 검색된 고객사 전체 리스트 개수를 SQL_CALC_FOUND_ROWS 힌트를 사용 해서 가져온다.
		// SQL_CALC_FOUND_ROWS 를 사용하면 LIMIT 절에 의해 제한된 전체 레코드 수를 구할 수 있다.
		$sql = "
		SELECT SQL_CALC_FOUND_ROWS 
			d.inflow_channel, d.inflow_channel_etc, a.no AS ano, a.division , a.customer_name, a.business_number, a.resident_number, a.manager_name, 
			b.contract_max_no, d.insurance_product_no, d.insurance_product_name, 
			d.insurance_period_start, d.insurance_period_end, d.contract_date, d.insurant, 
			a.manager_tel, a.manager_mobile, a.email,  d.contract_admin1, d.contract_admin2, 
			e.adminName as adminName1, f.adminName as adminName2, d.insurance_type, a.update_date, a.tel
		FROM 
			customer_users AS a 
			LEFT JOIN ( SELECT max(c.no) contract_max_no , c.customer_no FROM contract AS c GROUP BY customer_no ) AS b ON a.`no` = b.customer_no
			LEFT JOIN contract AS d ON b.contract_max_no = d.`no`
			LEFT JOIN admin_user AS e ON d.contract_admin1 = e.adminId
			LEFT JOIN admin_user AS f ON d.contract_admin2 = f.adminId
		WHERE
			a.del_yn = 'N' ";
			if($searchData['customer_name'] != ''){ $sql .= " and a.customer_name like '%".$searchData['customer_name']."%'"; }
			if($searchData['business_number'] != ''){ $sql .= " and a.business_number = '".$searchData['business_number']."'"; }
			if($searchData['policy_number'] != ''){ $sql .= " and a.resident_number = '".$searchData['policy_number']."'"; }
			if($searchData['manager_name'] != ''){ $sql .= " and a.manager_name like '%".$searchData['manager_name']."%'"; }
			if($searchData['contract_admin_name'] != ''){ $sql .= " and ( e.adminName like '%".$searchData['contract_admin_name']."%' or f.adminName like '%".$searchData['contract_admin_name']."%' )"; }
			if($searchData['insuranceType'] != ''){ $sql .= " and d.insurance_type = '".$searchData['insuranceType']."'"; }
			$sql .= " order by a.no desc LIMIT $per_page OFFSET $offset";

		return $this->db->query($sql)->result();
		// 쿼리 확인 하기
		//echo "SQL : ".$this->db->last_query();
	}


	// 고객사 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetCustomerListTotalCnt(){
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

	// 고객사명으로 고객사 정보 가져오기 getCustomerListByCustomerName // no 와 customer_name 만 가져온다. 
	public function getCustomerListByCustomerName($customerName){
		$this->db->select("customer_users.no, customer_users.customer_name");
		$this->db->like("customer_users.customer_name", $customerName);
		return $this->db->get('customer_users')->result();
	}

	// 고객사 정보 수정 CustomerUpdateProc($data)
	public function CustomerUpdateProc($data){
		$this->db->where("no", $data['no']);
		return $this->db->update("customer_users", $data);
		// 쿼리 확인 하기 
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