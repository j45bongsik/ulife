<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
/**
 * 사용자 인증 컨트롤러
 */
require_once APPPATH . '/third_party/PHPExcel/Classes/PHPExcel.php';
 
class Member extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('download');
		$this->load->helper('cookie');
        
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('CustomClass');
        $this->load->library('PHPExcel');
        
        $this->load->model('MemberModel');
		$this->load->model('MainModel');
        $this->load->model('ContractModel');

        // 도메인 네임의 앞 세자리가 CRM 이면 CRM 서버로 접속, ERP 이면 ERP 서버로 접속 // $service_tab 는 모든 페이지에서 사용 가능
        $this->service_tab = $_SERVER['service_tab'];

		//@ini_set("allow_url_fopen", "1");
        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);
        
        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }

    // 로그인 처리
    public function loginProc(){
        // 로그인 처리
        // 받은 데이터 확인 하기
        $data = $this->input->post();

        // get 방식으로 넘어온 데이터가 있으면 post 데이터에 넣어준다.
        $return_url = '/';
        $return_url_tmp = $_SERVER['HTTP_REFERER']; // http://bms.localhost.com/login?SCPID=S3UwMHNiL09hMkZ4OG14Mk5aTXp4MndjRTA4SmN3NE4xR1Bsck9pUStsVT0

        // ? 으로 나누어서 배열로 만든다.
        $return_url_tmp = explode('?', $return_url_tmp);
        if(count($return_url_tmp) == 2){
            $return_url_tmp = explode('=', $return_url_tmp[1]);
            if(count($return_url_tmp) == 2 && $return_url_tmp[0] == 'SCPID'){
                $return_url = $this->customclass->Decrypt($return_url_tmp[1]);
            }            
        }

        //디버깅 $this->customclass->Debug($_POST); exit;
        
        // 아이디 체크
        $return = $this->MemberModel->IdCheck($data['adminId']);        
        if(sizeof($return) == 0){
            $data['result'] = 'fail';
            $data['msg'] = '아이디가 존재하지 않습니다.';             // 메세지 추가 
            echo json_encode($data);
            exit;
        }
        
        // 비밀번호 체크
        $data['adminPwd'] =$this->customclass->EncryptLogin($data['adminPwd']);
        $return = $this->MemberModel->PwCheck($data['adminId'], $data['adminPwd']);
        
        if(sizeof($return) == 0){
            $data['result'] = 'fail';
            $data['msg'] = '비밀번호가 일치하지 않습니다.';             // 메세지 추가 
            echo json_encode($data);
            exit;
        }
        
        // 로그인 처리
        $return = $this->MemberModel->LoginProc($data['adminId'], $data['adminPwd']);
        // object 를 array 로 변경
        $return = json_decode(json_encode($return), True);
        $data = array();
        if($return){
            $data['result'] = 'success';                
                // 로그인 세션 처리
                $this->session->set_userdata('CRM_ID', $return[0]['adminId']);
                $this->session->set_userdata('CRM_NAME', $return[0]['adminName']);
                $this->session->set_userdata('CRM_LEVEL', $return[0]['adminLevel']);
                $this->session->set_userdata('CRM_DEPT', $return[0]['deptNo']);
                $this->session->set_userdata('CRM_AUTH', $return[0]['authCustomerAccount'].','.$return[0]['authInsuranceContract'].','.$return[0]['authBasicInformation']);
                $this->session->set_userdata('CRM_AUTH_CUSTOMER_ACCOUNT', $return[0]['authCustomerAccount']);
                $this->session->set_userdata('CRM_AUTH_INSURANCE_CONTRACT', $return[0]['authInsuranceContract']);
                $this->session->set_userdata('CRM_AUTH_BASIC_INFORMATION', $return[0]['authBasicInformation']);
                $this->session->set_userdata('CRM_AUTH_FINANCIAL_MANAGEMENT', $return[0]['authFinancialManagement']);
                

                // 로그인 시간 업데이트 처리 어드민 아이디와 현제 시간을 넘겨줌 
                $lastloginAdmin['adminId'] = $return[0]['adminId'];
                $lastloginAdmin['lastLogin'] = date("Y-m-d H:i:s");
                $return = $this->MemberModel->LoginTimeUpdate($lastloginAdmin);

            $data['msg'] = '로그인 되었습니다.';             // 메세지 추가 
        } else {
            $data['result'] = 'fail';
            $data['msg'] = '로그인에 실패 하였습니다.';             // 메세지 추가 
        }
        $data['url'] = $return_url;             // 리다이렉트 페이지 추가

        echo json_encode($data);

    }


    // 관리자 리스트
    public function list(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        // 왼쪽 메뉴 활성화 관견된 변수 설정
        $menuNo = array(4,3,1); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,7);
        }
        
        //$homaageUrl = 'http://'.$_SERVER['HTTP_HOST'];
        //접속자 주소 확인 후 내부 인원만 접속 가능하게 처리 예정

        //페이지당 표시할 목록 갯수
        $per_page = 20;
        //$num_links = 5;
        $this->input->get('page') ? $page = $this->input->get('page') : $page = 1;
        $offset = ($page - 1) * $per_page;
        
        // 페이징에 맞게 관리자 리스트 데이터를 가져온다.
        $data['LISTDATA'] = $this->MemberModel->GetAdminListData($per_page, $offset);
        $data['SEARCH_TOTAL_CNT'] = $this->MemberModel->GetAdminListSearchTotalCnt(); // limit은 빼고 전체 데이터 수를 가져온다.
        //$data['LISTDATA'] = $this->MemberModel->GetAdminListData(1,1);

        $Totalnum = sizeof($data['LISTDATA']); // 전체 데이터 수 ( 리밋조건 포함 )

        // 오브젝트를 배열로 변경
        $data['LISTDATA'] = json_decode(json_encode($data['LISTDATA']), True);
        $data['SEARCH_TOTAL_CNT'] = json_decode(json_encode($data['SEARCH_TOTAL_CNT'][0]->total_cnt), True);

        // 한페이지에 3개 씩 페이징 처리
        $config['base_url'] = '/member/list';
        $config['total_rows'] = $data['SEARCH_TOTAL_CNT'];
        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        foreach($data['LISTDATA'] as $key => $val){
            // 각 권한 별로 Y 이면 이름을 가져온다. authCustomerAccount, authInsuranceContract, authBasicInformation
            if($val['authCustomerAccount'] == 'Y'){
                $data['LISTDATA'][$key]['authCustomerAccount'] = '고객관리';
            } else {
                $data['LISTDATA'][$key]['authCustomerAccount'] = '';
            }
            if($val['authInsuranceContract'] == 'Y'){
                $data['LISTDATA'][$key]['authInsuranceContract'] = '계약관리';
            } else {
                $data['LISTDATA'][$key]['authInsuranceContract'] = '';
            }
            if($val['authBasicInformation'] == 'Y'){
                $data['LISTDATA'][$key]['authBasicInformation'] = '기초정보관리';
            } else {
                $data['LISTDATA'][$key]['authBasicInformation'] = '';
            }

            // adminYn  'Y'인경우 '정상' , 'N'인경우 '퇴사' 로 변경
            if($val['adminYn'] == 'Y'){
                $data['LISTDATA'][$key]['admin_STATUS'] = '정상';
            } else {
                $data['LISTDATA'][$key]['admin_STATUS'] = '퇴사';
            }

            // $data['LISTDATA']의 전체 수에서 1씩을 빼준다.
            $data['LISTDATA'][$key]['admin_no'] = $Totalnum - $key;

            // 최종 로그인 시간이 없으면 '-' 로 표시
            if($val['lastLogin'] == '0000-00-00 00:00:00'){
                $data['LISTDATA'][$key]['lastLogin'] = '-';
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/member/member_list', array('DATA'=>$data));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 어드민 등록 페이지
    public function reg(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // 어드민을 등록하는 페이지 입니다.
        // 로그인 개발 되면 로그인 체크 하는 로직 추가예정

        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        // 왼쪽 메뉴 활성화 관견된 변수 설정
        $menuNo = array(4,3,1); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,7);
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/member/member_reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 어드민 등록 처리
    public function regProc(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // 받은 데이터 확인 하기
        $data = $this->input->post();

        // 디버깅
        // $this->customclass->Debug($_POST); //exit;

        // 아이디 중복 체크를 했는지 확인
        if($data['idtf'] == 0){
            $data['result'] = 'fail';
            $data['msg'] = '아이디 중복 체크를 해주세요.';             // 메세지 추가 
            echo json_encode($data);
            exit;
        }

        // 이미 등록되어 있는 아이디가 있는지 확인
        $return = $this->MemberModel->IdCheck($data['adminId']);
        if(sizeof($return) > 0){
            $data['result'] = 'fail';
            $data['msg'] = '이미 등록되어 있는 아이디 입니다.';             // 메세지 추가 
            echo json_encode($data);
            exit;
        }

        // 비밀번호 암호화
        $data['adminPwd'] = $this->customclass->EncryptLogin($data['adminPwd']);

        // 아이디 체크 변수 언셋
        unset($data['idtf']);

        // 권한들은 체크가 되어 있으면 $data['authCustomerAccount'] = 'ON' 으로 넘어옴 체크가 안되어 있으면 $data['authCustomerAccount'] 변수 자체가 없음
        // 체크가 되어 있으면 'Y' 로 체크가 안되어 있으면 'N' 으로 처리
        // 권한 관련 변수(authCustomerAccount,authInsuranceContract,authBasicInformation) 가 있는지 확인 있으면 ON 인지 확인 변수가 있고 ON 인 경우에만 Y 변수가 없거나 OFF 인 경우에는 N 으로 처리
        
        if(isset($data['authCustomerAccount'])){            
            if($data['authCustomerAccount'] == 'on'){
                $data['authCustomerAccount'] = 'Y';
            } else {
                $data['authCustomerAccount'] = 'N';
            }
        } else {
            $data['authCustomerAccount'] = 'N';
        }
        if(isset($data['authInsuranceContract'])){
            if($data['authInsuranceContract'] == 'on'){
                $data['authInsuranceContract'] = 'Y';
            } else {
                $data['authInsuranceContract'] = 'N';
            }
        } else {
            $data['authInsuranceContract'] = 'N';
        }
        if(isset($data['authBasicInformation'])){
            if($data['authBasicInformation'] == 'on'){
                $data['authBasicInformation'] = 'Y';
            } else {
                $data['authBasicInformation'] = 'N';
            }
        } else {
            $data['authBasicInformation'] = 'N';
        }

        // 어드민 등록 처리
        $data['adminProgram'] = substr($_SERVER['HTTP_HOST'], 0, 3);
        $data['adminId'] = $data['adminId'];
        $data['adminPwd'] = $data['adminPwd'];
        $data['adminName'] = $data['adminName'];
        $data['adminHwId'] = $data['adminHwId']; 
        $data['adminMobile'] = $data['adminMobile'];       
        $data['adminEmail'] = $data['adminEmail'];
        $data['authCustomerAccount'] = $data['authCustomerAccount'];
        $data['authInsuranceContract'] = $data['authInsuranceContract'];
        $data['authBasicInformation'] = $data['authBasicInformation'];
        $data['adminLevel'] = '1';
        $data['adminYn'] = 'Y';
        $data['regId'] = $_SESSION['CRM_ID'];
        $data['regdate'] = date("Y-m-d H:i:s");

        $return = $this->MemberModel->AdminRegProc($data);
        if($return){
            $data['result'] = 'success';
        } else {
            $data['result'] = 'fail';
        }
        echo json_encode($data);
    }


    // 로그인 페이지
    public function login(){
        // 로그인 페이지 입니다.
        
        // 이미 로그인 되어 있는 경우는 /customer 로 이동
        $this->customclass->LoginChkNgoMain();

        // view 페이지 로드
        $this->load->view($this->service_tab.'/inc/common');
        $this->load->view($this->service_tab.'/member/login');
        $this->load->view($this->service_tab.'/inc/footer');
    }


    // 로그 아웃 
    public function logout(){
        // 로그 아웃 처리
        $this->customclass->Logout();
        // 로그 아웃 후 로그아운 되었다는 메세지 띄우고 로그인 페이지로 이동
        $this->customclass->AlertMsgMovePage('로그아웃 되었습니다.', '/login');
    }


    // 아이디 중복 체크 idCheck
    public function idCheck(){
        $adminId = $this->input->post('adminId');
        $return = $this->MemberModel->IdCheck($adminId);

        if(sizeof($return) == 0){
            $data['result'] = 'success';
        } else {
            $data['result'] = 'fail';
        }
        echo json_encode($data);
    }


    // 핸드폰 번호 중복 체크 mobileCheck
    public function mobileCheck(){
        $adminMobile = $this->input->post('adminMobile');
        $return = $this->MemberModel->MobileCheck($adminMobile);

        if(sizeof($return) == 0){
            $data['result'] = 'success';
        } else {
            $data['result'] = 'fail';
        }
        echo json_encode($data);
    }


    // 부서 선택시 해당 부서에 속한 직원 명을 가져온다. member_SelectBox
    public function member_SelectBox(){
        $dept_no = $this->input->post('dept_no');
        $memberlist = $this->MemberModel->getMemberListByDeptNo($dept_no);
        $memberlistSelectBox['result'] = 'success';
        $memberlistSelectBox['html'] = "    <option value='' selected>담당자선택</option>\n";
        foreach($memberlist as $key => $val){
            $memberlistSelectBox['html'] .= "
                                                <option value='".$val->adminId."'>".$val->adminName."</option>\n";
        }
        echo json_encode($memberlistSelectBox);
    }


    // 마이페이지
    public function mypage(){
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 왼쪽 메뉴 활성화 관견된 변수 설정
        $menuNo = array(0,3);
        $searchData = array();


        // 계약중인 리스트에서 내가 계약중인 보험계약 내용중에 보험상품명만 가져온다
        $getMyContractList = $this->ContractModel->getMyContractList($_SESSION['CRM_ID'], $searchData);
        $getMyContractList = $this->ContractModel->getMyContractList('es.choi', $searchData);

        // 보험상품명을 라디오 버튼으로 만든다.
        $getMyContractListRadio = "";
        if(sizeof($getMyContractList) > 0){
            foreach($getMyContractList as $key => $val){
                $getMyContractListRadio .= "<input type='radio' name='bhItem' id='bhItem-".$key."' class='radio-custom' value='".$val->insurance_product_name."' onclick='insert_bhItemInput(this.value)'><label for='bhItem-".$key."' class='radio-custom-label'>".$val->insurance_product_name."</label>\n";
            }
        } else {
            $getMyContractListRadio .= "<div>보험상품이 없습니다. 등록하기로 등록 가능 합니다.</div>\n";
        }

        // $searchData 초기 설정 
        $searchData['customerCompanyName'] = ''; // 거래처명
        $searchData['business_number'] = ''; // 사업자번호
        $searchData['policy_number'] = ''; // 계약번호 // 증권번호  
        $searchData['insuranceProductName'] = ''; // 보험상품명 
        $searchData['searchDateType'] = ''; // 보험시작일 범위
        $searchData['searchDateType2'] = ''; // 보험시작일 범위        
        /*
        $searchData['sort1'] = ''; // 정렬
        $searchData['sort2'] = ''; // 정렬
        $searchData['orderByField'] = ''; 
        $searchData['page'] = '';
        */

        // 페이징 설정 S
        $per_page = "5"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $page = $this->uri->segment(2);
        if($page == ''){ $page = 1; }
        $offset = ($page - 1) * $per_page;
        $searchData['page'] = $page;
        //페이징 설정 E

        // customer_name 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['customer_name'])){
            $searchData['customerCompanyName'] = $_GET['customer_name'];
        }
        // business_number 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['business_number'])){
            $searchData['business_number'] = $_GET['business_number'];
        }
        // policy_number 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['policy_number'])){
            $searchData['policy_number'] = $_GET['policy_number'];
        }
        // insuranceProductName 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['insuranceProductName'])){
            $searchData['insuranceProductName'] = $_GET['insuranceProductName'];
        }
        // start_date_s 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['start_date_s'])){
            $searchData['searchDateType'] = $_GET['start_date_s'];
        }
        // start_date_e 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['start_date_e'])){
            $searchData['searchDateType2'] = $_GET['start_date_e'];
        }

        // getMyContractListData(세션아이디, 거래처명, 사업자번호, 증권번호, 보험상품명, 보험기간시작일검색스타트일, 보험기간시작일검색엔드일, 페이지, 페이지당 보여줄 리스트 갯수, 오프셋);
        
        $getMyContractListDataList = $this->ContractModel->getMyContractListData('es.choi', $searchData['customerCompanyName'], $searchData['business_number'], $searchData['policy_number'], $searchData['insuranceProductName'], $searchData['searchDateType'], $searchData['searchDateType2'], $per_page, $offset);
        //디버깅 $this->customclass->debug($getMyContractListDataList);
        // 쿼리 확인 $this->customclass->debug($this->db->last_query());



        $getMyContractListDataListTable = "";
        if(sizeof($getMyContractListDataList) > 0){
            foreach($getMyContractListDataList as $key => $val){
                $getMyContractListDataListTable .= "    <tr>\n";
                $getMyContractListDataListTable .= "        <td>".$val->no."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->inflow_channel."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->insurance_type_name."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->insurance_product_name."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->customerCompanyName."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->insurant."</td>\n";
                $getMyContractListDataListTable .= "        <td>".str_replace('-', '.', $val->insurance_period_start). " ~ " . str_replace('-', '.', $val->insurance_period_end)."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->manager_name."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->insurant_tel."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->insurant_email."</td>\n";
                $getMyContractListDataListTable .= "        <td>".$val->contract_admin_names."</td>\n";
                $getMyContractListDataListTable .= "    </tr>\n";
            }
        } else {
            $getMyContractListDataListTable .= "        <tr>\n";
            $getMyContractListDataListTable .= "            <td colspan='12'>검색된 데이터가 없습니다.</td>\n";
            $getMyContractListDataListTable .= "        </tr>\n";
        }

        // 검색결과의 전체 리스트 갯수를 가져온다. GetContractListTotalCnt
        $totalCnt = $this->ContractModel->GetContractListTotalCnt();
        $totalCnt = $totalCnt[0]->total_cnt;

        // 페이징 처리S 
        $config = array();
        $config['base_url'] = '/mypage';
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows'] = $totalCnt; // 전체 리스트 갯수
        $config['per_page'] = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE; 
        $config['reuse_query_string'] = TRUE;
        $config['cur_tag_open'] = '<strong>';
        $config['cur_tag_close'] = '</strong>';
        $config['uri_segment'] = 2; // 페이지 번호가 있는 세그먼트
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<div class="paginate">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = '<i class="prev-arrow-double"></i>';
        $config['last_link'] = '<i class="next-arrow-double"></i>';
        $config['prev_link'] = '<i class="prev-arrow"></i>';
        $config['next_link'] = '<i class="next-arrow"></i>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        // 페이징 처리E

        // 만기도래 리스트를 가져온다. // 기준은 오늘 기준으로 3개월 이내 만기도래 리스트를 가져온다.        
        $contractList2 = "";
        $dueDate = date("Y-m-d", strtotime("+3 month"));

        $getContractListByEndDateList = array();
        $getContractListByEndDateList = $this->ContractModel->getContractListByEndDate($dueDate); // $searchData, $per_page, $offset
        
        $getContractListByEndDateListTable = "";
        if(sizeof($getContractListByEndDateList) > 0){            
            foreach($getContractListByEndDateList as $key => $val){
                $getContractListByEndDateListTable .= "    <tr>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['no']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['inflow_channel']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurance_type_name']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurance_product_name']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['customerCompanyName']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurant']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['contract_date']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurance_period_start']. " ~ " . $val['insurance_period_end'] ."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['manager_name']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurant_tel']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>".$val['insurant_email']."</td>\n";
                $getContractListByEndDateListTable .= "        <td>&nbsp;</td>\n";
                $getContractListByEndDateListTable .= "    </tr>\n";
            }
        } else {
            $getContractListByEndDateListTable .= "        <tr>\n";
            $getContractListByEndDateListTable .= "            <td colspan='12'>만기 도래 리스트 데이터가 없습니다.[ 종료일이 오늘부터 3개월뒤 ( " . $dueDate . " ) 사이 종료되는 보험계약건 ]</td>\n";
            $getContractListByEndDateListTable .= "        </tr>\n";
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/member/mypage', array(            
            'SEARCHDATA' => $searchData,
            'GETCONTRACTLISTBYENDDATELIST' => $getContractListByEndDateList,
            'GETCONTRACTLISTBYENDDATELISTTABLE' => $getContractListByEndDateListTable,
            'GETMYCONTRACTLISTRADIO' => $getMyContractListRadio,
            'GETMYCONTRACTLISTDATALISTTABLE' => $getMyContractListDataListTable,
            'PAGINATION' => $pagination,
        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    }



    // 마이페이지에서 만기도래 리스트 엑셀다운받기 누를때 처리 excelDownContractListByEndDate()
    public function excelDownContractListByEndDate(){
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 만기도래 리스트를 가져온다. // 기준은 오늘 기준으로 3개월 이내 만기도래 리스트를 가져온다.        
        $contractList2 = "";
        $dueDate = date("Y-m-d", strtotime("+3 month"));
        $getContractListByEndDateList = array();
        $getContractListByEndDateList = $this->ContractModel->getContractListByEndDate($dueDate); // $searchData, $per_page, $offset

        // 엑셀 다운로드 처리
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('만기도래 리스트');

        // 엑셀 헤더 설정
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '번호');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '유입경로');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '구분');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '상품명');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '거래처명');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '계약일');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '보험기간');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '거래처 담당자명');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '거래처 담당자 연락처');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', '거래처 담당자 이메일');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', '비고');


        $row = 2;
        foreach($getContractListByEndDateList as $key => $val){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $val['no']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $val['inflow_channel']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $val['insurance_type_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $val['insurance_product_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $val['customerCompanyName']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $val['contract_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $val['insurance_period_start']. " ~ " . $val['insurance_period_end']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $val['insurant']);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $val['insurant_tel']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $val['insurant_email']);
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, '');
            $row++;
        }

        // 엑셀 다운로드 처리
        $filename = '만기도래리스트_'.date('Ymd').'.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        



    }

}