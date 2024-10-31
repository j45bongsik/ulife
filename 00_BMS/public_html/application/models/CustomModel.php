<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
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










} // end class