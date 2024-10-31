<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class Insurance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('download');
		$this->load->helper('cookie');

        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('CustomClass');

        $this->load->model('MainModel');
        $this->load->model('CustomerModel');
        $this->load->model('MemberModel');
        $this->load->model('InsuranceCompanyModel');

		@ini_set("allow_url_fopen", "1");        

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);
        
        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }


    public function index() {
        $menuNo = array(4,1,1);
        $data['LIST'] = $this->InsuranceCompanyModel->getInsuranceCompanyList();
        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/insurancecompany/list', array('INSURANCECOMPANY'=>$data['LIST']));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    /**
     * 보험상품 리스트
     */
    public function list() {
        $menuNo = array(4,1,1);

        

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/insurancecompany/list');
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 등록 페이지
    public function reg() {
        $menuNo = array(4,1,2);

        

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/insurancecompany/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    }



}