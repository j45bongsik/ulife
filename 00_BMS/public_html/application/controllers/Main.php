<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class Main extends CI_Controller {

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

		@ini_set("allow_url_fopen", "1");        

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);
        
        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }

    //기본 메인페이지
    public function index()
    {
        $menuNo = array(1);
        //$homaageUrl = 'http://'.$_SERVER['HTTP_HOST'];
        //접속자 주소 확인 후 내부 인원만 접속 가능하게 처리 예정
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_arr = array("121.160.204.192", "192.168.0.13", "172.23.0.1");
        if(!in_array($ip, $ip_arr)){
            //header("Location: http://ubiz.co.kr"); //exit;
        } else {
            //header("Location: /admin/index"); //exit;
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/main/main');
        $this->load->view($this->serviceTab . '/inc/footer');
    }

}