<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class InsuranceCompany extends CI_Controller {

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
     * 보험사 리스트
     */
    public function list() {

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        
        $menuNo = array(4,1,1); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,5);
        }

        // 보험사 구분 리스트 
        $insurancecompanydivisionlist = $this->InsuranceCompanyModel->getInsuranceCompanyDivisionList();
        // SQL 확인
        //echo $this->db->last_query();

        // 보험사 구분 리스트를 select box 로 만든다.
        // $this->input->get('insuranceCompanyCate') 값이 없는경우 전체를 선택한것으로 간주 하여 selected 처리
        if ($this->input->get('insuranceCompanyCate') == "") {
            $insurancecompanydivisionlistSelectBox = "    <option value='' selected>선택</option>\n";
        } else {
            $insurancecompanydivisionlistSelectBox = "    <option value=''>선택</option>\n";
        }

        foreach($insurancecompanydivisionlist as $key => $val){
            if($val->depth == 1){
                $insurancecompanydivisionlistSelectBox .= "                                <optgroup label='".$val->catnm."'>\n";
            } else if($val->depth == 2){
                // $this->input->get('insuranceCompanyCate') 값이 있을 경우 selected 처리
                if($this->input->get('insuranceCompanyCate') == $val->catno){
                    $insurancecompanydivisionlistSelectBox .= "                                    <option value='".$val->catno."' selected>".$val->catnm."</option>\n";
                } else {
                    $insurancecompanydivisionlistSelectBox .= "                                    <option value='".$val->catno."'>".$val->catnm."</option>\n";
                }
                if($val->catno == $val->depth_max_catno){
                    $insurancecompanydivisionlistSelectBox .= "                                </optgroup>\n";
                }
            }
        }


        // 보험사에 등록되어 있는 부서 리스트 가져오기
        $deptlist = $this->InsuranceCompanyModel->getInsuranceCompanyDeptNameList();


        // insuranceCompanyDeptName 을 검색 조건으로 사용하기 위해 select box 로 만든다.
        // $this->input->get('insuranceCompanyDeptName'); 값이 없는경우 전체를 선택한것으로 간주 하여 selected 처리
        $deptlistSelectBox = "";
        if ($this->input->get('insuranceCompanyDeptName') == "") {
            $deptlistSelectBox = "    <option value='' selected>부서선택</option>\n";
        } else {
            $deptlistSelectBox = "    <option value=''>부서선택</option>\n";
        }

        foreach($deptlist as $key => $val){
            // $this->input->get('insuranceCompanyDeptName'); 값이 있을 경우 selected 처리
            if($this->input->get('insuranceCompanyDeptName') == $val->insuranceCompanyDeptName){
                $deptlistSelectBox .= "                                    <option value='".$val->insuranceCompanyDeptName."' selected>".$val->insuranceCompanyDeptName."</option>\n";
            } else {
                $deptlistSelectBox .= "                                    <option value='".$val->insuranceCompanyDeptName."'>".$val->insuranceCompanyDeptName."</option>\n";
            }
        }

        // 검색 조건이 있을 경우 public function GetInsuranceCompanyList($search_param, $limit)
        $search_param = array();
        $search_param['insuranceCompanyCate'] = $this->input->get('insuranceCompanyCate');
        $search_param['insuranceCompanyDeptName'] = $this->input->get('insuranceCompanyDeptName');
        $search_param['insuranceCompanyManager'] = $this->input->get('insuranceCompanyManager');
        $search_param['insuranceCompanyManagerTel'] = $this->input->get('insuranceCompanyManagerTel');
        $search_param['insuranceCompanyManagerEmail'] = $this->input->get('insuranceCompanyManagerEmail');

        //페이지당 표시할 목록 갯수
        $per_page = 10;
        $this->input->get('page') ? $page = $this->input->get('page') : $page = 1;
        $offset = ($page - 1) * $per_page;

        // 페이징에 맞게 관리자 리스트 데이터를 가져온다.
        $limit = "LIMIT $per_page OFFSET $offset";

        //$this->MemberModel->GetAdminListData($per_page, $offset);
        $data['LISTDATA'] = $this->InsuranceCompanyModel->GetInsuranceCompanyList($search_param, $limit);
        $data['SEARCH_TOTAL_CNT'] = $this->MemberModel->GetAdminListSearchTotalCnt(); // limit은 빼고 전체 데이터 수를 가져온다.
        //$data['LISTDATA'] = $this->MemberModel->GetAdminListData(1,1);

        $Totalnum = sizeof($data['LISTDATA']); // 전체 데이터 수 ( 리밋조건 포함 )

        // 오브젝트를 배열로 변경
        $data['LISTDATA'] = $data['LISTDATA'];
        $data['SEARCH_TOTAL_CNT'] = $data['SEARCH_TOTAL_CNT'][0]->total_cnt;

        // 한페이지에 3개 씩 페이징 처리
        $config['base_url'] = '/insuranceCompany/list';
        $config['total_rows'] = $data['SEARCH_TOTAL_CNT'];
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = TRUE;
        
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        // SQL 확인
        //echo $this->db->last_query();
        
        $this->pagination->initialize($config); // 페이징 초기화
        $data['PAGING'] = $this->pagination->create_links(); // 페이징 링크를 생성하여 view에서 사용하 변수에 할당
        
        // 검색한 결과가 없을 경우
        if(!$data['LISTDATA']){
            $data['LISTDATA'] = array();
        }


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/insurancecompany/list', array('INSURANCECOMPANY'=>$data['LISTDATA'], 'INSURANCECOMPANYDIVISIONLISTSELECTBOX'=>$insurancecompanydivisionlistSelectBox, 'PAGING'=>$data['PAGING'], 'TOTAL_CNT'=>$config['total_rows'], 'SEARCH_PARAM'=>$search_param, 'DEPTLIST'=>$deptlist, 'DEPTLISTSELECTBOX'=>$deptlistSelectBox));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 등록 페이지
    public function reg() {

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        
        $menuNo = array(4,1,2); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,5);
        }

        // 보험사 구분 리스트 1차 카테고리만 가져온다.
        // 가져와서 select box 로 만든다.
        // <div class="radiobox">
        //     <input id="in1" class="radio-custom" name="insurance" type="radio" value="001"  >
        //     <label for="in1" class="radio-custom-label">손해보험</label>
        // </div>
        $insuranceRadioBox = "";
        $insurancecompanydivisionlist = $this->InsuranceCompanyModel->getInsuranceCompanyDivisionCate1List();

        foreach($insurancecompanydivisionlist as $key => $val){
            $insuranceRadioBox .= "                <div class='radiobox'>\n";
            $insuranceRadioBox .= "                    <input id='in".$val->catno."' class='radio-custom' name='insurance' type='radio' value='".$val->catno."'  >\n";
            $insuranceRadioBox .= "                    <label for='in".$val->catno."' class='radio-custom-label'>".$val->catnm."</label>\n";
            $insuranceRadioBox .= "                </div>\n";
        }

        // 내부담당자 입력란의 부서 정보 가져오기
        $deptlist = $this->MemberModel->getDepartmentList();

        // customclass 에서 디버그 메서드를 호출하여 디버그를 한다.
        //$this->customclass->debug($deptlist);

        // 내부담당자 입력란의 부서 정보를 select box 로 만든다.
        $deptlistSelectBox = "<option value='' selected>부서선택</option>\n";
        foreach($deptlist as $key => $val){
            // dept_no = 002002 일반보험(기업보험) 부서와 그 하위부서만 가져오고 있음 depth = 2, 3
            // 만약 depth 가 3이면 옵션 text 에 '　'를 추가하고 들여쓰기를 한다.  '　'는 ㄱ 한자키 눌렀을때 1번쨰 나오는 문자임 
            // 만약 depth 가 2이면 옵션 text 에 굵은 글씨로 표시한다.
            if($val->depth == 2){
                $deptlistSelectBox .= "                        <option value='".$val->dept_no."' style='font-weight:bold;'>".$val->dept_name."</option>\n";
            } else if($val->depth == 3){
                $deptlistSelectBox .= "                        <option value='".$val->dept_no."'>　".$val->dept_name."</option>\n";
            }
        }

        // SQL 확인
        //echo $this->db->last_query();

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/insurancecompany/reg', array('INSURANCERADIOBOX'=>$insuranceRadioBox, 'DEPTLISTSELECTBOX'=>$deptlistSelectBox));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 구분에 해당하는 보험사 명 가져오기 insurancecompany_SelectBox ( 보험사 구분 선택시 해당 카테고리에 속한 2차 카테고리에 해당하는 보험사 명을 가져온다. )
    public function insurancecompany_SelectBox(){
        $catno = $this->input->post('catno');
        $insurancecompanylist = $this->InsuranceCompanyModel->getInsuranceCompanyListByCatno($catno);
        $insurancecompanylistSelectBox['result'] = 'success';
        $insurancecompanylistSelectBox['html'] = "    <option value='' selected>선택</option>\n";
        foreach($insurancecompanylist as $key => $val){
            $insurancecompanylistSelectBox['html'] .= "                                    <option value='".$val->catno."'>".$val->catnm."</option>\n";
        }
        echo json_encode($insurancecompanylistSelectBox);
    }


    // 보험사 등록 
    public function insurancecompany_reg_ajax(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // 등록시 필수값 체크
        $data = array(); // 리턴할 데이터 초기화
        $data['insuranceCompanyCate'] = $this->input->post('insuranceCompanyCate');
        $data['insuranceCompanyDeptName'] = $this->input->post('insuranceCompanyDeptName');
        $data['internalContactPerson'] = $this->input->post('internalContactPerson');
        $data['insuranceCompanyManager'] = $this->input->post('insuranceCompanyManager');
        $data['insuranceCompanyManagerPosition'] = $this->input->post('insuranceCompanyManagerPosition');
        $data['insuranceCompanyManagerEmail'] = $this->input->post('insuranceCompanyManagerEmail');
        $data['insuranceCompanyManagerTel'] = $this->input->post('insuranceCompanyManagerTel');
        $data['insuranceCompanyManagerMobile'] = $this->input->post('insuranceCompanyManagerMobile');
        $data['memo'] = $this->input->post('memo');
        $data['regDate'] = date("Y-m-d H:i:s");

        // 등록시 해당 보험사의 같은 부서가 이미 등록이 되어있는지 확인한다. 이미 등록 되어 있는경우 중복 메세지 표시 하고 등록하지 않는다.
        $result = $this->InsuranceCompanyModel->getInsuranceCompanyListByDeptName($data['insuranceCompanyCate'] ,$data['insuranceCompanyDeptName']);
        // 이미 등록 되어 있는 경우 중복메세지 표시 하고 등록하지 않는다.
        if($result){
            $rdata = array();
            $rdata['result'] = 'fail';
            $rdata['message'] = "이미 [해당 보험사에 해당 부서는 등록되어 있는] 부서입니다. \n검색이 안되는경우 관리자에게 문의해주세요.";
            echo json_encode($rdata);
            exit;
        }

        // 등록시 이미 등록된 핸드폰 번호가 있는지 확인한다.
        $result = $this->InsuranceCompanyModel->getInsuranceCompanyListByManagerMobile($data['insuranceCompanyManagerMobile']);
        // 이미 등록 되어 있는 경우 중복메세지 표시 하고 등록하지 않는다.
        if($result){
            $rdata = array();
            $rdata['result'] = 'fail';
            $rdata['message'] = "이미 등록된 [보험사 담당자 휴대전화] 입니다. \n검색이 안되는경우 관리자에게 문의해주세요.";
            echo json_encode($rdata);
            exit;
        }

        // 등록시 이미 등록된 이메일이 있는지 확인한다.
        $result = $this->InsuranceCompanyModel->getInsuranceCompanyListByManagerEmail($data['insuranceCompanyManagerEmail']);
        // 이미 등록 되어 있는 경우 중복메세지 표시 하고 등록하지 않는다.
        if($result){
            $rdata = array();
            $rdata['result'] = 'fail';
            $rdata['message'] = "이미 등록된 [보험사 담당자 이메일] 입니다. \n검색이 안되는경우 관리자에게 문의해주세요.";
            echo json_encode($rdata);
            exit;
        }

        // 등록 처리
        $result = $this->InsuranceCompanyModel->insurancecompany_reg($data);

        // 쿼리 확인 하기 
		//echo "SQL : ".$this->db->last_query();

        //exit;
        $rdata = array();
        if($result){
            $rdata['result'] = 'success';
            $rdata['message'] = '등록되었습니다.';
        } else {
            $rdata['result'] = 'fail';
            $rdata['message'] = '등록에 실패하였습니다.';
        }        
        echo json_encode($rdata);
    }

}