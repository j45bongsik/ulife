<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }


	// 아이디 중복 체크 IdCheck
	public function IdCheck($adminId){
		$this->db->where("admin_user.adminId", $adminId);
		return $this->db->get('admin_user')->result();
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 비밀번호 체크
	public function PwCheck($adminId, $adminPwd){
		$this->db->where("admin_user.adminId", $adminId);
		$this->db->where("admin_user.adminPwd", $adminPwd);
		$this->db->get('admin_user')->result();
		return $this->db->get('admin_user')->result();
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 어드민 이메일 존재여부 체크
	public function GetAdminIsChkEmail($q_email){
		/*
        $this->db->where("admin_user.ad_del_yn", "N");
        $this->db->from("admin_user");
        return $this->db->count_all_results();
		*/
		$where = "where u.ad_del_yn = 'N' ";

		if(isset($q_email)){
			if($q_email){
				$where .= "and u.ad_email = '".$q_email."' ";
			}
		}

		return $this->db->query("
        SELECT count(*) as num
		FROM 
			`admin_user` AS u 			
		$where
        ")->result();
    }


	// 어드민 로그인 날짜 업데이트 LoginTimeUpdate
	public function LoginTimeUpdate($data){
		$this->db->where("admin_user.adminId", $data['adminId']);
		return $this->db->update("admin_user", $data);
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 어드민 로그인 프로세스 LoginProc
	public function LoginProc($adminId, $adminPwd){
		$this->db->where("admin_user.adminId", $adminId);
		$this->db->where("admin_user.adminPwd", $adminPwd);
		return $this->db->get('admin_user')->result();
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 어드민 등록 
	public function AdminRegProc($data){
		return $this->db->insert('admin_user', $data);
	}


	// 어드민 정보 유무 확인
	public function IsAdmin($ad_id, $ad_email){
		/*
        $this->db->where("admin_user.adminYn", "Y");
        $this->db->from("admin_user");
        return $this->db->count_all_results();
		*/
		$where = "where u.ad_del_yn = 'N' ";
		
		if($ad_id && $ad_email){
			$where .= "and u.ad_id = '".$ad_id."' ";
			$where .= "and u.ad_email = '".$ad_email."' ";
		}

		//echo "SELECT count(*) as num FROM `admin_user` AS u ".$where ; exit;
		return $this->db->query("
        SELECT count(*) as num
		FROM 
			`admin_user` AS u 			
		$where
        ")->result();
    }


	// 핸드폰 번호 중복 체크 mobileCheck
	public function MobileCheck($adminMobile){
		$this->db->where("admin_user.adminMobile", $adminMobile);
		return $this->db->get('admin_user')->result();
		// 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();
	}


	// 어드민 리스트
    public function GetAdminList($search_param){
		$where = "where u.adminYn = 'Y'";
		if(isset($search_param['t_seq'])){
			if($search_param['t_seq']){
				$where .= "and t.t_seq = '".$search_param['t_seq']."' ";
			}
		}

		if(isset($search_param['keyword'])){
			if(trim($search_param['keyword'])){
				$where .= "and u.ad_name like '%".$search_param['keyword']."%' ";
			}
		}

		return $this->db->query("
        SELECT count(*) as num
		FROM 
			`admin_user` AS u 
		$where
        ")->result();
    }


	// 어드민 리스트 
	public function GetAdminListData($per_page, $offset){
		// @rnum:=@rnum+1 as rnum 또는 SQL_CALC_FOUND_ROWS 를 사용해서 admin_user 에서 조건에 맞는 전체 리스트를 가져온다
		// select 절에 @rnum:=@rnum+1 as rnum 이처럼 변수 지정해서 하나씩 증가하는 방법이나 또는 SQL_CALC_FOUND_ROWS 를 사용하면 전체 리스트를 가져올 수 있다.
		// 차이점은 리밋을 걸어서 가져온 리스트의 전체 갯수를 가져오는 것과 리밋 제한 없이 검색 조건의 전체 값을 가져온다는 것이 차이다.
		// 결과 값을 변수에 담아서 SQL_CALC_FOUND_ROWS 의 값도 함께 리턴 한다.
		// master id 를 제외한 리스트만 가져온다

		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM admin_user WHERE adminYn = 'Y' and adminId != 'master' ORDER BY regdate DESC LIMIT $per_page OFFSET $offset";
		return $this->db->query($sql)->result();
    }


	// 어드민 리스트 마스터 계정용
	public function GetAdminListDataForMaster($per_page, $offset){
		// @rnum:=@rnum+1 as rnum 또는 SQL_CALC_FOUND_ROWS 를 사용해서 admin_user 에서 조건에 맞는 전체 리스트를 가져온다
		// select 절에 @rnum:=@rnum+1 as rnum 이처럼 변수 지정해서 하나씩 증가하는 방법이나 또는 SQL_CALC_FOUND_ROWS 를 사용하면 전체 리스트를 가져올 수 있다.
		// 차이점은 리밋을 걸어서 가져온 리스트의 전체 갯수를 가져오는 것과 리밋 제한 없이 검색 조건의 전체 값을 가져온다는 것이 차이다.
		// 결과 값을 변수에 담아서 SQL_CALC_FOUND_ROWS 의 값도 함께 리턴 한다.
		// master id 를 제외한 리스트만 가져온다

		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM admin_user ORDER BY regdate DESC LIMIT $per_page OFFSET $offset";
		return $this->db->query($sql)->result();
    }


	//어드민 리스트 전체 카운트 (리밋 제외 하고 검색 조건으로 검색한 전체 카운트 대신 검색 SELECT 문에 SQL_CALC_FOUND_ROWS 라는 MYSQL 힌트를 사용해서 가져온 경우에만 사용 할 수 있음.)
	public function GetAdminListSearchTotalCnt(){
		return $this->db->query("
		SELECT FOUND_ROWS() as total_cnt
		")->result();
	}


	// 어드민 추가
	public function AdminAddProc($data){
        return $this->db->insert('admin_user', $data);
    }


	// 어드민 삭제
	public function AdminUpdateProc($data){
        $this->db->where("admin_user.ad_id", $data['ad_id']);
        return $this->db->update("admin_user", $data);
    }


	// 어드민 정보 가져오기
	public function GetAdminData($data){
		$this->db->where("admin_user.ad_id", $data['ad_id']);
		return $this->db->get('admin_user')->result();
	}


	// 부서 리스트
	public function GetDepartmentList($dept_code = '002'){

		$sql = "
		SELECT concat(d3.dept_name, '||', d3.dept_no ) AS pp, CONCAT(d2.dept_name, '||', d2.dept_no) AS p, CONCAT(d1.dept_name, '||', d1.dept_no) AS i FROM 
			admin_depts AS d1
			right JOIN admin_depts AS d2 ON d1.p_dept_no = d2.dept_no 
			right JOIN admin_depts AS d3 ON d2.p_dept_no = d3.dept_no
		WHERE d3.depth = '1'
		";

		return $this->db->query("
		SELECT * FROM `admin_depts` where `dept_no` like '002002%' ORDER BY `dept_no` ASC
		")->result();
	}


	// 사용자 리스트 GetMemberList()  이름과 부서코드 아이디 가져오기
	public function GetMemberList(){
		$this->db->select('admin_user.adminId, admin_user.adminName, admin_user.deptNo');
		$this->db->where("admin_user.adminYn", "Y");
		$this->db->where("admin_user.adminId != 'master'");
		$this->db->where("admin_user.adminId != 'admin'");
		return $this->db->get('admin_user')->result();
	}


	// 해당 부서코드에 속한 어드민 리스트 getMemberListByDeptNo like '002002%' 검색으로 가져온다 
	// adminYn 값이 Y 인 어드민만 가져온다
	// adminId 값이 master 인 어드민은 제외 한다
	// 해당 업무에 접근 권한이 있는 어드민만 가져온다  <----- todo 추가 해야 함 
	public function GetMemberListByDeptNo($dept_no){
		$this->db->where("admin_user.deptNo like '".$dept_no."%'");
		$this->db->where("admin_user.adminYn", "Y");
		$this->db->where("admin_user.adminId != 'master'");
		return $this->db->get('admin_user')->result();
	}

	// 부서코드와 부서명 가져오기
	public function GetDeptNoName($dept_no){
		$this->db->where("admin_depts.dept_no", $dept_no);
		return $this->db->get('admin_depts')->result();
	}


	// 부서코드와 부서명 가져오기2 
	/*
	SELECT concat(d3.dept_name, '||', d3.dept_no ) AS pp, CONCAT(d2.dept_name, '||', d2.dept_no) AS p, CONCAT(d1.dept_name, '||', d1.dept_no) AS i FROM 
			admin_depts AS d1
			LEFT JOIN admin_depts AS d2 ON d1.p_dept_no = d2.dept_no 
			LEFT JOIN admin_depts AS d3 ON d2.p_dept_no = d3.dept_no
		WHERE d3.depth = '1'
			AND d1.dept_no = '002001002'
	*/
	public function GetDeptNoName2(){
		$sql = "
		SELECT concat(d3.dept_name, '||', d3.dept_no ) AS pp, CONCAT(d2.dept_name, '||', d2.dept_no) AS p, CONCAT(d1.dept_name, '||', d1.dept_no) AS i FROM 
			admin_depts AS d1
			LEFT JOIN admin_depts AS d2 ON d1.p_dept_no = d2.dept_no 
			LEFT JOIN admin_depts AS d3 ON d2.p_dept_no = d3.dept_no
		WHERE 
			d3.depth = '1'
		";
		// obj가 아닌 배열로 리턴
		return $this->db->query($sql)->result_array();
	}





// 이하 삭제 예정 


	/*
	// 수정 페이지 에서 법인 카드 정보 가져오기 GetCardInfo
	public function GetCardInfo($seq){
		$this->db->where("erp_card_manage.no", $seq);
		return $this->db->get('erp_card_manage')->result();
	}
	*/


	/* 도메인 관리
	public function GetDomainList(){
		$this->db->order_by("DNS_SET.end_date", "asc");
		return $this->db->get('DNS_SET')->result();
	}


    public function GetDomainEndList(){
        return $this->db->query("
        SELECT * FROM (
            SELECT *, DATEDIFF(end_date, NOW()) AS edd FROM `DNS_SET` WHERE end_date < DATE_FORMAT(DATE_ADD(NOW(),INTERVAL +1000 DAY ),'%Y-%m-%d')
        ) AS a WHERE edd IN (10, 15, 20, 30, 40, 50, 60, 100  ) OR edd <= 7
        ")->result();
	}


    public function GetDomain($seq){
		$this->db->where("DNS_SET.seq", $seq);
		return $this->db->get('DNS_SET')->result();
	}


    public function InsertDomain($data){
        return $this->db->insert('DNS_SET', $data);
	}

    public function UpdateDomain($data){
        $this->db->where("DNS_SET.seq", $data['seq']);
        return $this->db->update("DNS_SET", $data);
    }

	public function GetAdminResultRand($ad_seq){
        return $this->db->query("
        SELECT * FROM admin_user where ad_seq = $ad_seq ORDER BY RAND() LIMIT 8;
        ")->result();
    }

	public function GetAdminMaxNum(){
		return $this->db->query("
        SELECT max(seq) as seq FROM admin_user;
        ")->result();
    }

	*/

}