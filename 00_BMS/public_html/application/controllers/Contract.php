<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class Contract extends CI_Controller {

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
        $this->load->model('InsuranceProductModel');
        $this->load->model('ContractModel');
        $this->load->model('MemberModel');

		@ini_set("allow_url_fopen", "1");

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);

        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }


    // 보험 종목 select option 형식으로 가져오기
    public function insuranceTypeListSelectOption($insuranceType = ''){
        // 보험 상품테이블에 등록된 보험 종목 가져오기 
        $insuranceTypeListFromInsuranceProduct = $this->InsuranceProductModel->getInsuranceTypeListFromInsuranceProduct();
        // 보험종목 코드 값을 가져왔으니 해당 데이터들의 앞 3자리를 가져와서 보험분류를 만든다.

        // 보험분류를 만든다.
        $insuranceClassificationListTmp = array();
        foreach($insuranceTypeListFromInsuranceProduct as $key => $val){
            $insuranceClassificationListTmp[$key] = substr($val->insuranceType, 0,3);
        }

        $insuranceTypeListFromInsuranceProductTmp = array();
        foreach($insuranceTypeListFromInsuranceProduct as $key => $val){
            $insuranceTypeListFromInsuranceProductTmp[] = $val->insuranceType;
        }

        // 보험 분류 데이터 중복 제거
        $insuranceClassificationListTmp = array_unique($insuranceClassificationListTmp); // 보험 분류 데이터 중복 제거된 상태

        // 보험 종목 데이터를 만들기 위해서 보험 분류 데이터를 가지고 보험 종목 데이터를 만든다.

        //$this->customclass->Debug($insuranceTypeListFromInsuranceProduct);

        $insuranceTypeListFromInsuranceProductTmp = array();
        foreach($insuranceTypeListFromInsuranceProduct as $key => $val){
            $insuranceTypeListFromInsuranceProductTmp[] = $val->insuranceType;
        }
        
        //$insuranceTypeListFromInsuranceProduct = array_unique($insuranceTypeListFromInsuranceProduct); // 보험 종목 데이터 중복 제거된 상태
        
        // 두개의 배열을 합친다.
        $insuranceTypeListTmp = array_merge($insuranceClassificationListTmp, $insuranceTypeListFromInsuranceProductTmp);

        // 배열을 텍스트로 만든다.
        $insuranceTypeListTmp = implode(',', $insuranceTypeListTmp);

        // 보험 분류와 보험 종목을 가져온다.
        $insuranceTypeListTmp = $this->InsuranceProductModel->getInsuranceTypeListFromInsuranceType($insuranceTypeListTmp);

        // 배열 데이터를 디버그 한다.
        //$this->customclass->Debug($insuranceTypeListTmp);


        // 보험 분류를 select box 로 만든다.
        $insuranceTypeSelectBox = "    <option value='' selected>보험종목 선택</option>\n";
        foreach($insuranceTypeListTmp as $key => $val){
            if($val->depth == 1){
                $insuranceTypeSelectBox .= "                                <optgroup label='".$val->typeNm."'>\n";
            } else if($val->depth == 2){
                // 만약 $searchData['insuranceType'] 값이 있으면 해당 값이 선택되어 있도록 한다.
                if($insuranceType != ''){
                    if($insuranceType == $val->typeNo){
                        $insuranceTypeSelectBox .= "                                    <option value='".$val->typeNo."' selected>".$val->typeNm."</option>\n";
                    } else {
                        $insuranceTypeSelectBox .= "                                    <option value='".$val->typeNo."'>".$val->typeNm."</option>\n";
                    }
                } else {
                    $insuranceTypeSelectBox .= "                                    <option value='".$val->typeNo."'>".$val->typeNm."</option>\n";
                }
                // 만약 $val->typeNo == $val->depth_max_typeNo 이면 </optgroup> 를 추가한다.
                if($val->typeNo == $val->depth_max_typeNo){
                    $insuranceTypeSelectBox .= "                                </optgroup>\n";
                }
            }
        }
        return $insuranceTypeSelectBox;
    }


    // 보험계약 보기 및 수정 페이지 modify



    //보험계약 등록
    public function reg(){

        /*
        ☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        ☆★☆★☆★2차 업그레이드시 고객정보관리에서 넘어 온 경우에는 고객정보관리에서 넘어온 데이터를 가져와서 보여준다. (사용자 편의성 관련 업그레이드)☆★☆★☆★
        ☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        */

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,2,1);

        // 등록된 보험사 정보 가져오기
        $insuranceCompanyList = $this->InsuranceProductModel->getInsuranceCompanyList();
        // debug // 
        // $this->customclass->debug($insuranceCompanyList);
        
        // 보험사 select box 를 만든다.
        $insuranceCompanySelectBox = "";
        $insuranceCompanySelectBox .= "                                    <option value=''>보험사 선택</option>\n";
        foreach($insuranceCompanyList as $key => $val){
            $insuranceCompanySelectBox .= "                                    <option value='".$val->insuranceCompanyCate."'>".$val->catnm."</option>\n";
        }


        // 보험 상품테이블에 등록된 보험 종목 가져오기 
        $insuranceTypeSelectBox = $this->insuranceTypeListSelectOption();
        
        // 계약담당자 select box 를 만든다. 계약담당자는 admin_user 테이블에서 deptno 가 002002 로 시작하는 관리자를 가져온다.         
        $adminUserList = $this->MemberModel->GetMemberListByDeptNo('002002'); // 002002 일반보험(기업보험) 부서라서 해당 부서 코드를 넣었지만 언젠가는 선택해서 가져 올 수 있게 변경 해야 할 수도 있음.
        
        $adminUserListSelectBox = "";
        $adminUserListSelectBox .= "                                    <option value=''>선택</option>\n";
        foreach($adminUserList as $key => $val){
            
            $adminUserListSelectBox .= "                                    <option value='".$val->adminId."'>".$val->adminName."</option>\n";
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/contract/reg', array(
                                                'INSURANCETYPESELECTBOX' => $insuranceTypeSelectBox,
                                                'ADMINUSERLISTSELECTBOX' => $adminUserListSelectBox,
                                                'INSURANCECOMPANYSELECTBOX' => $insuranceCompanySelectBox
        ));
        $this->load->view($this->serviceTab . '/inc/footer');

    }

    //보험계약 리스트
    public function list(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 왼쪽 메뉴 선택을 위한 변수
        $menuNo = array(3,1,1);

        $searchData = array(); // 검색 조건 데이터

        // $searchData 초기 설정 
        $searchData['searchDate'] = ''; // 진행일자
        $searchData['customerCompanyName'] = ''; // 거래처명
        $searchData['manager_name'] = ''; // 거래처담당자명
        $searchData['business_number'] = ''; // 사업자번호
        $searchData['policy_number'] = ''; // 계약번호 // 증권번호  
        $searchData['insuranceType'] = ''; // 구분
        $searchData['searchDateType'] = ''; // 보험시작일 범위
        $searchData['searchDateType2'] = ''; // 보험시작일 범위
        $searchData['contract_admin_name'] = ''; // 계약 담당자
        $searchData['searchDateY'] = ''; // 진행일자 년
        $searchData['searchDateM'] = ''; // 진행일자 월
        $searchData['contractAdmin'] = ''; // 계약 담당자
        $searchData['sort1'] = ''; // 정렬
        $searchData['sort2'] = ''; // 정렬
        $searchData['orderByField'] = ''; 
        $searchData['page'] = '';

        // get 방식으로 넘어온 데이터가 있는지 확인 한다.

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 진행일자가 있는 경우
        if(isset($_GET['searchDateY']) && isset($_GET['searchDateM'])){
            // 년도와 월 모두 있는 경우 // 년도만 있는경우 // 월만 있는 경우 ( 월만 있는경우는 월을 선택하라고 알려주는 메세지를 띄워야 할듯...)
            if($_GET['searchDateY'] != '' && $_GET['searchDateM'] != ''){
                $searchData['searchDate'] = $_GET['searchDateY']."-".$_GET['searchDateM'];
            } else if($_GET['searchDateY'] != '' && $_GET['searchDateM'] == ''){
                $searchData['searchDate'] = $_GET['searchDateY'];
            } else if($_GET['searchDateY'] == '' && $_GET['searchDateM'] != ''){ // 월만 있으면 연도를 선택하라고 알려주는 메세지를 띄워야 함 그후 이전 페이지로 이동 시킨다.
                // 커스텀 클래스에 있는 AlertMsgBackPage() 함수를 호출하여 메세지를 띄우고 이전 페이지로 이동 시킨다.
                $this->customclass->AlertMsgBackPage('연도를 선택해 주세요.');
                exit;
            }
        }

        // 진행일자가 있는 경우
        if(isset($_GET['searchDateY'])){
            $searchData['searchDateY'] = $_GET['searchDateY'];
        }
        // 진행일자가 있는 경우
        if(isset($_GET['searchDateM'])){
            $searchData['searchDateM'] = $_GET['searchDateM'];
        }

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
        // insuranceType 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['insuranceType'])){
            $searchData['insuranceType'] = $_GET['insuranceType'];
        }
        // manager_name 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['manager_name'])){
            $searchData['manager_name'] = $_GET['manager_name'];
        }
        // start_date_s 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['start_date_s'])){
            $searchData['searchDateType'] = $_GET['start_date_s'];
        }
        // start_date_e 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['start_date_e'])){
            $searchData['searchDateType2'] = $_GET['start_date_e'];
        }
        // contractAdmin 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['contractAdmin'])){
            $searchData['contract_admin_name'] = $_GET['contractAdmin'];
        }
        // 정렬 // sort1, sort2

        // 검색폼 필드 관련 데이터 가져오기 S
        // 보험 종목 select option 형식으로 가져오기
        $insuranceTypeSelectBox = $this->insuranceTypeListSelectOption($searchData['insuranceType']);
        
        

        // 진행기간 을 가져와야 하는 select box 에서 사용할 년도를 설정한다 따라서 창립년도 부터 지금까지의 년도를 가져온다. ( 오래되면 다른 방식으로 바꿔야 할듯... )
        // $FROM_SINCE_YEAR 회사가 시작한 년도 부터 올해 까지의 년도를 가져온다. 회사 창립 년도 = 2013년도 부터 올해 까지의 년도를 가져온다.
        $FROM_SINCE_YEAR = 2013; // 회사 창립년도        
        $FROM_SINCE_YEAR_SELECT_BOX = "";
        for($i = date('Y'); $i >= $FROM_SINCE_YEAR; $i--){
            if($searchData['searchDateY'] == $i){
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."'>".$i."</option>\n";
            }
        }

        // $FROM_SINCE_MONTH_SELECT_BOX
        $FROM_SINCE_MONTH_SELECT_BOX = "";
        for($i = 1; $i <= 12; $i++){
            if($searchData['searchDateM'] == sprintf('%02d',$i)){
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."'>".$i."</option>\n";
            }
        }
        // 검색폼 필드 관련 데이터 가져오기 E

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 보험계약 리스트를 가져온다.
        $contractList = "";
        $contractList = $this->ContractModel->getContractList($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        //가져온 데이터 디버깅 //         //$this->customclass->debug($contractList); 

        // 쿼리 확인         echo "<xmp>SQL : ".$this->db->last_query();

        // 검색결과의 전체 리스트 갯수를 가져온다. GetContractListTotalCnt
        $totalCnt = $this->ContractModel->GetContractListTotalCnt();
        $totalCnt = $totalCnt[0]->total_cnt;    
        
        // 페이징 처리S
        $config = array();
        $config['base_url'] = '/contract/list/';
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows'] = $totalCnt; // 전체 리스트 갯수
        $config['per_page'] = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE; 
        $config['reuse_query_string'] = TRUE;
        $config['cur_tag_open'] = '<strong>';
        $config['cur_tag_close'] = '</strong>';
        $config['uri_segment'] = 3; // 페이지 번호가 있는 세그먼트
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


        $ARR_CONTRACT_TYPE = array(
            '1' => '신규',
            '0' => '갱신'
        );

        $contractListTr = "";

        // $contractList 디버깅 //$this->customclass->debug($contractList);
        // 가져온 데이터로 테이블을 만든다.        
        foreach($contractList as $key => $val){
            //print_r($val);
            $arr_expiration_notice = "";
            $contractListTr .= "        <tr>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->no."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->inflow_channel."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->insurance_product_name."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->customerCompanyName."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->contract_date."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->insurance_period_end."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->insurance_period_start."~".$val->insurance_period_end."</td>\n";
            //$contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->insurant."</td>\n";
            //$contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->insurant_tel."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->manager_name."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->manager_tel."</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='/contract_view/{$val->no}';\">".$val->contract_admin_name1;
            if($val->contract_admin_name2 != ''){
                $contractListTr .= " / ".$val->contract_admin_name2;
            } 
            $contractListTr .= "</td>\n";
            $contractListTr .= "            <td onclick=\"location.href='contract_view.php?no={$val->no}';\" class=\"p0\">\n";


            $expiration_notice_result_tmp_arr = explode(',', $val->expiration_notice_result); // "만기일 알림발송 전날"을 메일 발송 후 따로 저장 했던 내용을 배열로 만든다.

            if($val->expiration_notice != ''){
                $expiration_notice = explode(',', $val->expiration_notice);
                $contractListTr .= "                <div class=\"day-item\">\n";
                foreach($expiration_notice as $key2 => $val2){
                    // $val2 가 $expiration_notice_result_tmp_arr 에 있으면 active 를 빼고 없으면 active 를 넣는다.
                    if(in_array($val2, $expiration_notice_result_tmp_arr)){
                        $contractListTr .= "                    <span>".$val2."</span>\n";
                    } else {
                        $contractListTr .= "                    <span class=\"active\">".$val2."</span>\n";
                    }
                }
                $contractListTr .= "                </div>\n";
            } else {
                // $val->expiration_notice 은 텍스트 이기 때문에 ','로 explode를 사용해서 배열로 만들어서 처리 한다.
                $arr_expiration_notice = explode(',' , $val->expiration_notice);
                $contractListTr .= "                <div class=\"day-item\">\n";
                foreach($arr_expiration_notice as $key2 => $val2){
                    // $val2 가 $expiration_notice_result_tmp_arr 에 있으면 active 를 빼고 없으면 active 를 넣는다.
                    if(in_array($val2, $expiration_notice_result_tmp_arr)){
                        $contractListTr .= "                    <span>".$val2."</span>\n";
                    } else {
                        $contractListTr .= "                    <span class=\"active\">".$val2."</span>\n";
                    }
                }
                $contractListTr .= "                </div>\n";
            }
            $contractListTr .= "            </td>\n";
            $contractListTr .= "        </tr>\n";
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/contract/list', array(
                                                'INSURANCETYPESELECTBOX' => $insuranceTypeSelectBox,
                                                'FROMSINCEYEAR' => $FROM_SINCE_YEAR_SELECT_BOX,
                                                'FROMSINCEMONTH' => $FROM_SINCE_MONTH_SELECT_BOX,
                                                'CONTRACTLISTTR' => $contractListTr,
                                                'SEARCHDATA' => $searchData,
                                                'PAGINATION' => $pagination
        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    }

    // 보험계약 수정페이지 
    public function view(){
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,1,2);
        $contractNo = ""; // 보험계약 코드 값
        $userName = $_SESSION['CRM_NAME'];
        $userId = $_SESSION['CRM_ID'];

        // 두번째 세그먼트 값이 없으면 리스트 페이지로 이동 시킨다. // 잘못된 접근입니다 라는 메세지와 함께 리스트 페이지로 이동 시킨다.
        $contractNo = $this->uri->segment(2);
        if($contractNo == ''){ // 두번째 세그먼트 값이 보험계약 코드 값이다.
            // redirect('/contract/list');
            $this->customclass->AlertMsgMovePage('잘못된 접근입니다.', '/contract/list');
        }

        // 해당 코드 값으로 보험계약 정보를 가져온다.
        $contractData = $this->ContractModel->getContractData($contractNo);
        // 실행된 쿼리 확인 
        //echo "<xmp>SQL : ".$this->db->last_query();
        
        // 디버깅 
        //$this->customclass->debug($contractData);

        $contractDataForView = $contractData[0];
        
        $no                                         = ""; // 보험계약 코드 값
        $contract_type                              = ""; // 계약 타입
        $customerCompanyName                        = ""; // 거래처명
        $inflow_channel                             = ""; // 유입경로
        $inflow_channel_etc                         = ""; // 유입경로 기타 내용
        $insurance_product_additional_commission    = ""; // 보험상품 추가 수수료
        $insurance_product_name                     = ""; // 보험상품명
        $insurance_period_start                     = ""; // 보험시작일
        $insurance_period_end                       = ""; // 보험종료일
        $estimate_insurance_premium                 = ""; // 예상보험료
        $customer_no                                = ""; // 거래처 코드
        $insurant                                   = ""; // 피보험자
        $insurance_type                             = ""; // 보험종목 
        $policy_number                              = ""; // 증권번호
        $contract_insurance                         = ""; // 계약보험
        $insurance_premium                          = ""; // 보험료
        $contract_date                              = ""; // 계약일
        $expiration_notice                          = ""; // 만기통보
        $expiration_notice_result                   = ""; // 만기통보결과
        $contract_admin1                            = ""; // 계약담당자1
        $contract_admin2                            = ""; // 계약담당자2
        $distribution1                              = ""; // 배분1
        $distribution2                              = ""; // 배분2
        $insurance_product_commission               = ""; // 보험상품 수수료
        $insurance_product_additional_commission    = ""; // 보험상품 추가 수수료
        $advert_cost_company                        = ""; // 지급광고비_거래처명
        $advert_cost_commission_rate                = ""; // 지급광고비_수수료율
        $memo                                       = ""; // 메모
        $first_contract_date                        = ""; // 최초계약일
        $update_date                                = ""; // 수정일
        $update_user_id                             = ""; // 수정자
        $reg_date                                   = ""; // 등록일
        $reg_admin_id                               = ""; // 등록자
        $delete_yn                                  = ""; // 삭제여부
        $insurance_company_category_catenm          = ""; // 보험회사카테고리명
        $contract_admin_name1                       = ""; // 계약담당자1 이름
        $contract_admin_name2                       = ""; // 계약담당자2 이름
        $upload_files_name                          = ""; // 업로드 파일명  
        $manager_name                               = ""; // 거래처 담당자명
        $manager_tel                                = ""; // 거래처 담당자 연락처


        // $contractDataForView 를 돌리면서 변수에 값을 넣는다. 예를 들어 $no = $contractDataForView['no']; 이런식으로 넣는다. foreach 문을 사용해서 넣는다.
        foreach($contractDataForView as $key => $val){
            $$key = $val;
        }

        // 손해보험사 또는 생명보험사에서 앞에서 4글자만 가져와서 보여준다 
        $insurance_type = mb_substr($insurance_company_category_catenm, 0, 4);


        // $manager_name , $manager_tel 는 암호화가 되어 있어서 복호화를 해서 보여준다.
        $manager_name = $this->customclass->decrypt($manager_name);
        $manager_tel = $this->customclass->decrypt($manager_tel);

        //보험 추가 수수료 값이 없으면 0 으로 넣는다.
        $insurance_product_additional_commission = $insurance_product_additional_commission == '' ? 0 : $insurance_product_additional_commission; 

        // 보험계약 상태 BOX 만들기 해당상태가 동일하면 selected 를 넣는다.
        $contractStatusBox = "";
        $contractStatusBox = $inflow_channel;

        // 계약 구분 (신규/갱신) 관련 
        $contractTypeBox = "";
        $ARR_CONTRACT_TYPE = array(
            '1' => '신규',
            '0' => '갱신'
        );
        $contractTypeBox = $ARR_CONTRACT_TYPE[$contract_type];

        // 실적배분 select box1 를 만든다.
        $distribution1SelectBox = "<option value=\"\" >선택</option>";
        for($i = 100; $i >= 50; $i = $i - 10){
            if($distribution1 == $i){
                $distribution1SelectBox .= "                                    <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $distribution1SelectBox .= "                                    <option value='".$i."'>".$i."</option>\n";
            }
        }

        // 실적배분 select box2 를 만든다.
        $distribution2SelectBox = "<option value=\"\" >선택</option>";
        for($i = 40; $i >= 0; $i = $i - 10){
            if($distribution2 == $i){
                $distribution2SelectBox .= "                                    <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $distribution2SelectBox .= "                                    <option value='".$i."'>".$i."</option>\n";
            }
        }
        
        // 보험 상품테이블에 등록된 보험 종목 가져오기 
        $insuranceTypeSelectBox = $this->insuranceTypeListSelectOption();

        // 계약담당자 select box 를 만든다. 계약담당자는 admin_user 테이블에서 deptno 가 002002 로 시작하는 관리자를 가져온다.         
        $adminUserList = $this->MemberModel->GetMemberListByDeptNo('002002'); // 002002 일반보험(기업보험) 부서라서 해당 부서 코드를 넣었지만 언젠가는 선택해서 가져 올 수 있게 변경 해야 할 수도 있음.
        
        $adminUserListSelectBox1 = "";
        $adminUserListSelectBox1 .= "                                    <option value=''>선택</option>\n";
        foreach($adminUserList as $key => $val){
            if($contract_admin1 == $val->adminId){
                $adminUserListSelectBox1 .= "                                    <option value='".$val->adminId."' selected>".$val->adminName."</option>\n";
            } else {
                $adminUserListSelectBox1 .= "                                    <option value='".$val->adminId."'>".$val->adminName."</option>\n";
            }
        }

        $adminUserListSelectBox2 = "";
        $adminUserListSelectBox2 .= "                                    <option value=''>선택</option>\n";
        foreach($adminUserList as $key => $val){
            if($contract_admin2 == $val->adminId){
                $adminUserListSelectBox2 .= "                                    <option value='".$val->adminId."' selected>".$val->adminName."</option>\n";
            } else {
                $adminUserListSelectBox2 .= "                                    <option value='".$val->adminId."'>".$val->adminName."</option>\n";
            }
        }

        $consultHistoryListLi = $this->getMakeConsultHistoryList($contractNo); // 상담이력 리스트를 만든다.

        if($contract_insurance != '' || $contract_insurance != null){

            // $contract_insurance 을 , 로 나누어서 배열로 만든다.
            $contract_insurance_arr = explode(',', $contract_insurance);

            // 파일 네임도 , 로 나누어서 배열로 만든다.
            $upload_files_name_arr = explode(',', $upload_files_name);

            // $contract_insurance_arr 의 갯수 만큼 반복문을 돌려서 다운로드 버튼을 만든다.
            $contract_insurance_down = '';
            foreach($contract_insurance_arr as $key => $val){
                $contract_insurance_down .= '
                <ul>
                    <li>
                        <a href="/upload/contract/'.$val.'" class="aTagFocus" download title="'.$upload_files_name_arr[$key].' 다운로드">'.$upload_files_name_arr[$key].'</a>
                    </li>
                </ul>
                ';
            }

        } else {
            $contract_insurance_down = "
            <p class=\"lineThrough\">등록된 계약서가 없습니다.</p>
            ";
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/contract/view', array(
                                                'CONTRACTTYPEBOX'               => $contractTypeBox, // 계약구분
                                                'CONTRACTSTATUSBOX'             => $contractStatusBox, // 유입경로
                                                'USERID'                        => $userId, // 사용자 아이디
                                                'USERNAME'                      => $userName, // 사용자 이름
                                                'CUSTOMERCOMPANYNAME'           => $customerCompanyName, // 거래처명
                                                'DISTRIBUTION1SELECTBOX'        => $distribution1SelectBox, // 실적배분1
                                                'DISTRIBUTION2SELECTBOX'        => $distribution2SelectBox, // 실적배분2
                                                'INSURANCETYPESELECTBOX'        => $insuranceTypeSelectBox, // 보험종목
                                                'ADMINUSERLISTSELECTBOX1'       => $adminUserListSelectBox1, // 계약담당자1
                                                'ADMINUSERLISTSELECTBOX2'       => $adminUserListSelectBox2, // 계약담당자2
                                                'CONTRACTDATA'                  => $contractData, // 보험계약 데이터
                                                'NO'                            => $no, // 보험계약 코드 값
                                                'CONTRACT_TYPE'                 => $contract_type, // 계약 타입
                                                'INFLOW_CHANNEL'                => $inflow_channel, // 유입 경로
                                                'INFLOW_CHANNEL_ETC'           => $inflow_channel_etc, // 유입 경로
                                                'INSURANCE_PRODUCT_ADDITIONAL_COMMISSION'=> $insurance_product_additional_commission, // 보험상품 추가 수수료
                                                'INSURANCE_PRODUCT_NAME'        => $insurance_product_name, // 보험상품명
                                                'INSURANCE_PERIOD_START'        => $insurance_period_start, // 보험시작일
                                                'INSURANCE_PERIOD_END'          => $insurance_period_end, // 보험종료일
                                                'ESTIMATE_INSURANCE_PREMIUM'    => number_format($estimate_insurance_premium), // 예상보험료
                                                'CUSTOMER_NO'                   => $customer_no, // 거래처 코드
                                                'INSURANT'                      => $insurant, // 피보험자
                                                'INSURANCE_TYPE'                => $insurance_type, // 보험종목
                                                'POLICY_NUMBER'                 => $policy_number, // 증권번호
                                                'CONTRACT_INSURANCE'            => $contract_insurance, // 계약보험
                                                'CONTRACT_INSURANCE_DOWN'       => $contract_insurance_down, // 계약보험 다운로드 버튼
                                                'INSURANCE_PREMIUM'             => $insurance_premium, // 보험료
                                                'CONTRACT_DATE'                 => $contract_date, // 계약일
                                                'EXPIRATION_NOTICE'             => $expiration_notice, // 만기통보
                                                'EXPIRATION_NOTICE_RESULT'      => $expiration_notice_result, // 만기통보결과
                                                'CONTRACT_ADMIN1'               => $contract_admin1, // 계약담당자1
                                                'CONTRACT_ADMIN2'               => $contract_admin2, // 계약담당자2
                                                'DISTRIBUTION1'                 => $distribution1, // 배분1
                                                'DISTRIBUTION2'                 => $distribution2, // 배분2
                                                'INSURANCE_PRODUCT_COMMISSION'  => $insurance_product_commission, // 보험상품 수수료
                                                'ADVERT_COST_COMPANY'           => $advert_cost_company, // 지급광고비_거래처명
                                                'ADVERT_COST_COMMISSION_RATE'   => $advert_cost_commission_rate,  // 지급광고비_수수료율
                                                'MEMO'                          => $memo, // 메모
                                                'FIRST_CONTRACT_DATE'           => $first_contract_date, // 최초계약일
                                                'UPDATE_DATE'                   => $update_date, // 수정일
                                                'UPDATE_USER_ID'                => $update_user_id, // 수정자
                                                'REG_DATE'                      => $reg_date, // 등록일
                                                'REG_ADMIN_ID'                  => $reg_admin_id, // 등록자
                                                'DELETE_YN'                     => $delete_yn, // 삭제여부
                                                'CONSULTHISTORYLISTLI'          => $consultHistoryListLi, // 상담이력 리스트
                                                'CONTRACT_ADMIN_NAME1'          => $contract_admin_name1, // 계약담당자1 이름
                                                'CONTRACT_ADMIN_NAME2'          => $contract_admin_name2, // 계약담당자2 이름
                                                'UPLOAD_FILES_NAME'             => $upload_files_name, // 업로드 파일명
                                                // 보험사, 보험종목, 계약일, 전년도 보험료, 보험료, 담당자이름, 연락처 추가, 전년도 보험료
                                                'INSURANCE_COMPANY_CATEGORY_CATENM' => $insurance_company_category_catenm, // 보험회사카테고리명
                                                'MANAGERNAME'                   => $manager_name, // 담당자이름
                                                'MANAGERTEL'                    => $manager_tel, // 담당자연락처
                                                'PREVYEARPREMIUM'               => $prev_year_premium // 전년도 보험료


        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    }






    // 보험사 구분 값을 받아서 해당 보험사 구분에 포함 된 보험 상품을 가져온다.
    public function insuranceProductListAjax(){
        $insuranceType = $this->input->post('insuranceType');
        $insuranceProductList = $this->InsuranceProductModel->getInsuranceProductListByInsuranceType($insuranceType);
        // 디버깅 customclass 에 있는 디버깅 함수를 호출하여 디버깅 한다. //$this->customclass->debug($insuranceProductList); 
        // $insuranceProductListRadio 를 json 형태로 변환해서 전달 한다
        echo json_encode($insuranceProductList);
    }

    // 두글자 이상 입력했을때 고객사 리스트 가져오기
    public function list_ajax(){
        $customerName = $this->input->post('customerCompanyName');
        $customerList = $this->CustomerModel->getCustomerListByCustomerName($customerName);
        // 쿼리 확인 하기
        //echo "SQL : ".$this->db->last_query();
        // 디버깅 customclass 에 있는 디버깅 함수를 호출하여 디버깅 한다. //$this->customclass->debug($insuranceProductList); 
        // $insuranceProductListRadio 를 json 형태로 변환해서 전달 한다
        echo json_encode($customerList);
    }

    // 보험계약 등록페이지에서 넘어온 값을 가지고 보험계약을 등록한다.
    public function regProc(){
        // 보험계약 등록페이지에서 넘어온 값들을 받는다.

        // 넘어온 값들을 디버깅 한다.        
        //$this->customclass->debug($_POST);

        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        /*

        [contractType] => on
        [inflow_channel] => ONLINE
        [insuranceType] => 004014
        [insuranceProductName] => 현대해상 동물농장15팀 상해 및 기타 특송 선원근로자재해 상품
        [insuranceProductNo] => 17
        [start_date] => 2024-01-21
        [end_date] => 2024-01-31
        [estimateInsurancePremium] => 10,000
        [customerCompanyName] => 야옹주식회사2
        [customerNo] => 2
        [insurant] => 피보험자 이름
        [policyNumber] => A01234567
        [insurancePremium] => 10,000
        [contract_date] => 2024-01-18
        [expirationNotice] => Array
            (
                [0] => 90
                [1] => 60
                [2] => 30
            )

        [contractAdmin1] => tony.kim
        [contractAdmin2] => es.choi
        [distribution1] => 50
        [insuranceProductCommission] => 50
        [insuranceProductAdditionalCommission] => 10
        [advertCostCompany] => 지급광고비_거래처명
        [advertCostCommissionRate] => 5
        companyManager
        companyManagerTel
        */

        //$this->customclass->debug($_FILES);

/*

        Array
(
    [contractType] => 1
    [inflow_channel] => ETC
    [inflow_channel_etc] => 기탈~
    [customerCompanyName] => 야옹이개인
    [customerNo] => 105
    [insurant] => 피보험야옹
    [insuranceCompany] => 001002
    [policyNumber] => P01071174995Q
    [insuranceType] => 001001
    [insuranceProductName] => kb 개발 종합 재산종합보험
    [insuranceProductNo] => 32
    [start_date] => 2024-07-12
    [end_date] => 2024-07-31
    [contract_date] => 2024-07-12
    [prevYearPremium] => 300,000
    [insurancePremium] => 100,000
    [expirationNotice] => Array
        (
            [0] => 90
            [1] => 45
            [2] => 15
        )

    [companyManager] => 담당야옹
    [companyManagerTel] => 010-7117-4995
    [contractAdmin1] => tony.kim
    [contractAdmin2] => es.choi
    [distribution1] => 60
    [insuranceProductCommission] => 25
    [insuranceProductAdditionalCommission] => 2
    [advertCostCompany] => 야옹거래처
    [advertCostCommissionRate] => 10
    [memo] => 기타메모입니당
)
        */

        $contractData['contract_type']                              = $this->input->post('contractType');
        $contractData['inflow_channel']                             = $this->input->post('inflow_channel');
        $contractData['inflow_channel_etc']                         = $this->input->post('inflow_channel_etc');
        $contractData['insurance_type']                             = $this->input->post('insuranceType');
        $contractData['insurance_product_name']                     = $this->input->post('insuranceProductName');
        $contractData['insurance_product_no']                       = $this->input->post('insuranceProductNo');
        $contractData['insurance_period_start']                     = $this->input->post('start_date');
        $contractData['insurance_period_end']                       = $this->input->post('end_date');
        $contractData['estimate_insurance_premium']                 = $this->input->post('estimateInsurancePremium');
        //$contractData['customerCompanyName']                      = $this->input->post('customerCompanyName');
        $contractData['customer_no']                                = $this->input->post('customerNo');
        $contractData['insurant']                                   = $this->input->post('insurant');
        $contractData['insurance_company']                          = $this->input->post('insuranceCompany');
        $contractData['policy_number']                              = $this->input->post('policyNumber');
        $contractData['prev_year_premium']                          = $this->input->post('prevYearPremium'); // 숫자만
        $contractData['prev_year_premium']                          = str_replace(',', '', $contractData['prev_year_premium']); // 콤마 제거
        $contractData['contract_insurance']                         = ''; // $this->input->post('contract_insurance'); // 보험계약서
        $contractData['insurance_premium']                          = $this->input->post('insurancePremium'); // 숫자만
        $contractData['insurance_premium']                          = str_replace(',', '', $contractData['insurance_premium']); // 콤마 제거
        $contractData['contract_date']                              = $this->input->post('contract_date');
        $contractData['expiration_notice']                          = implode(',', $this->input->post('expirationNotice'));        
        $contractData['contract_admin1']                            = $this->input->post('contractAdmin1');
        $contractData['contract_admin2']                            = $this->input->post('contractAdmin2');
        $contractData['distribution1']                              = $this->input->post('distribution1');
        $contractData['distribution2']                              = $this->input->post('distribution2');
        if($contractData['distribution2'] == ''){ 
            $contractData['distribution2']                          = 100 - $contractData['distribution1'];
        };
        $contractData['insurance_product_commission']               = $this->input->post('insuranceProductCommission');
        $contractData['insurance_product_additional_commission']    = $this->input->post('insuranceProductAdditionalCommission');
        $contractData['advert_cost_company']                        = $this->input->post('advertCostCompany');
        $contractData['advert_cost_commission_rate']                = $this->input->post('advertCostCommissionRate');
        $contractData['memo']                                       = $this->input->post('memo');
        $contractData['first_contract_date']                        = date('Y-m-d H:i:s');
        $contractData['reg_date']                                   = date('Y-m-d H:i:s');
        $contractData['reg_admin_id']                               = $_SESSION['CRM_ID'];
        $contractData['delete_yn']                                  = 'N';
        // $contractData['insurance_company_category_catenm']          = $this->input->post('insuranceType');


        // 담당자와 연락처 추가
        $contract_customer_manager_info['company_manager']          = $this->input->post('companyManager');
        $contract_customer_manager_info['company_manager_tel']      = $this->input->post('companyManagerTel');


        // 보험계약서 파일 업로드
        $config['upload_path']      = '/upload/contract/';
        $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
        $config['encrypt_name']     = TRUE;
        $arr_allowed_types          = array('gif','jpg','png','pdf','jpeg');
        $uploadFiles                = $_FILES['contractInsurance'];

        // 디버깅
        $this->customclass->debug($_FILES);
/*

Array
(
    [contractInsurance] => Array
        (
            [name] => Array
                (
                    [0] => logo-simbol-s.png
                )

            [type] => Array
                (
                    [0] => image/png
                )

            [tmp_name] => Array
                (
                    [0] => /tmp/phpZ9bPGX
                )

            [error] => Array
                (
                    [0] => 0
                )

            [size] => Array
                (
                    [0] => 8027
                )

        )

)

*/

        $contractData['upload_files_name'] = $uploadFiles['name'][0];

        $uploadFiles['name']        = $this->customclass->Encrypt(date('YmdHis').'###'.$uploadFiles['name'][0]); // 날짜와 "###" 와  파일명을 합친다음 암호화 한다.
        $uploadFiles['encrypt']     = $uploadFiles['name'];
        // image/png // 여기서 / 뒤에 있는 것이 파일 확장자이다. 해당 확장자만 가져온다
        $uploadFiles['typeTmp']        = explode('/', $uploadFiles['type'][0]); // png
        $uploadFiles['type']        = $uploadFiles['typeTmp'][1]; // png

        //echo $this->customclass->Decrypt($uploadFiles['encrypt'])."<br>"; // 20240111155733###스크린샷 2023-06-07 150502.png
        // 디버깅 
        $this->customclass->debug($uploadFiles);

        /*

Array
(
    [name] => bzhSTVhEMlBEWlB0TlE1ZWt3MnQ5OVJjNUVpdUZCNzlhdHY1ZFZES3NYdCszS3o5OEUvQWsvckZqcCs4cGVoVw
    [type] => png
    [tmp_name] => Array
        (
            [0] => /tmp/phpZ9bPGX
        )

    [error] => Array
        (
            [0] => 0
        )

    [size] => Array
        (
            [0] => 8027
        )

    [encrypt] => bzhSTVhEMlBEWlB0TlE1ZWt3MnQ5OVJjNUVpdUZCNzlhdHY1ZFZES3NYdCszS3o5OEUvQWsvckZqcCs4cGVoVw
    [typeTmp] => Array
        (
            [0] => image
            [1] => png
        )
)
        */


        $this->customclass->debug($_POST);


        /*

        Array
(
    [contractType] => 1
    [inflow_channel] => ETC
    [inflow_channel_etc] => 기탈~
    [customerCompanyName] => 야옹이개인
    [customerNo] => 105
    [insurant] => 피보험야옹
    [insuranceCompany] => 001002
    [policyNumber] => P01071174995Q
    [insuranceType] => 001001
    [insuranceProductName] => kb 개발 종합 재산종합보험
    [insuranceProductNo] => 32
    [start_date] => 2024-07-12
    [end_date] => 2024-07-31
    [contract_date] => 2024-07-12
    [prevYearPremium] => 300,000
    [insurancePremium] => 100,000
    [expirationNotice] => Array
        (
            [0] => 90
            [1] => 45
            [2] => 15
        )

    [companyManager] => 담당야옹
    [companyManagerTel] => 010-7117-4995
    [contractAdmin1] => tony.kim
    [contractAdmin2] => es.choi
    [distribution1] => 60
    [insuranceProductCommission] => 25
    [insuranceProductAdditionalCommission] => 2
    [advertCostCompany] => 야옹거래처
    [advertCostCommissionRate] => 10
    [memo] => 기타메모입니당
)
        */



        



        // 업로드 파일 아래에 추가 경로를 만들까 하다가 그냥 './upload/contract/' 에 저장하기로 함.
        // 파일 업로드
        if(!in_array($uploadFiles['type'], $arr_allowed_types)){
            //echo json_encode(array('result' => 'faile', 'msg' => '업로드 할 수 없는 파일 형식입니다. 이미지 파일만 또는 PDF 파일만 업로드 가능합니다.'));
            $this->customclass->AlertMsgBackPage('업로드 할 수 없는 파일 형식입니다. 이미지 파일만 또는 PDF 파일만 업로드 가능합니다.');
            exit;
        } else {

            // 디버깅
            //echo "파일 업로드 성공 & UPLOADFILES :";
            //echo "<br>==========================================================================<br>";
            //$this->customclass->debug($uploadFiles);
            //echo "<br>==========================================================================<br>";




            if(move_uploaded_file($uploadFiles['tmp_name'][0], $_SERVER['DOCUMENT_ROOT'] . $config['upload_path'] . $uploadFiles['name'].".".$uploadFiles['type'])){
                //$contractData['contract_insurance'] = implode(',', $uploadFiles);
                $contractData['contract_insurance'] = $uploadFiles['name'].".".$uploadFiles['type'];
                // 실제 DB 에 저장한다.


                // 디버그
                //echo "파일 업로드 성공 & CONTRACTDATA :  ";
                //echo "<br>==========================================================================<br>";
                //$this->customclass->debug($contractData);
                //echo "<br>==========================================================================<br>";
//                exit;
                $contract_no = $this->ContractModel->regContract($contractData);
                // $result에 방금 저장된 데이터의 아이디를 리턴한해서 받을 수 있으며, 이것을 이용해서 해당 계약건의 보험가입한 회사의 담당자명과 연락처를 저장 할 수 있다.
                // 저장시 연락처와 담당자 명을 암호화 한다. 
                // libaray 에 있는 customclass.php 에 있는 Encrypt 함수를 사용한다.
                $contract_customer_manager_info['manager_name'] = $this->customclass->Encrypt($contract_customer_manager_info['company_manager']);
                $contract_customer_manager_info['manager_tel']  = $this->customclass->Encrypt($contract_customer_manager_info['company_manager_tel']);
                // 보험계약에 담당자와 연락처를 저장한다. regContractCustomerManager($contractNo, $managerName, $managerTel);

                // 디버깅
                $this->customclass->debug($contract_customer_manager_info);

                $this->ContractModel->regContractCustomerManager($contract_no, $contract_customer_manager_info['manager_name'], $contract_customer_manager_info['manager_tel']);
                $this->customclass->AlertMsgMovePage('보험계약이 등록 되었습니다.', '/contract/list'); //echo json_encode(array('result' => 'success', 'msg' => '성공' , 'insuranceCompanyCate' => $insuranceCompanyCate));
                exit;
            } else {
                $this->customclass->AlertMsgBackPage('파일 업로드에 실패하였습니다.'); //echo json_encode(array('result' => 'faile', 'msg' => '파일 업로드에 실패하였습니다.'));
                exit;
            }
        }

        // 잘못된 접근이라면
        $this->customclass->AlertMsgBackPage('잘못된 접근입니다.');
        exit;
        
    }  // public function regProc() end


    // 보험계약 수정페이지에서 ajax로 넘어온 값을 저장 한다 (ajaxhistoryAdd)
    public function ajaxhistoryAdd(){
        /*
            POST 로 넘어온다.
            [contractNo] => 1
            taskGr: taskGr,
            add_history: add_history,
            username: username,
            fileAdd: fileAdd
        */
        $contractNo = $this->input->post('contract_no');
        $taskGr = $this->input->post('taskGr');
        $add_history = $this->input->post('add_history');
        $username = $this->input->post('username');
        $userid = $this->input->post('userid');

        //$this->customclass->debug($this->input->post());

        // 받은 파일 
        $uploadFiles = $_FILES['str-Image1'];

        //$this->customclass->debug($_FILES['str-Image1']);
        
        // 디버깅   
        //$this->customclass->debug($uploadFiles);
        $consultHistoryListLi = "";
        // 첨부파일이 있으면
        if($uploadFiles['name'] != ''){
            // 파일 업로드 세팅
            $config['upload_path']      = '/upload/contract/history/';
            $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
            $config['encrypt_name']     = TRUE;
            $arr_allowed_types          = array('gif','jpg','png','pdf','jpeg');

            $uploadFiles['name'] = $this->customclass->Encrypt(date('YmdHis').'###'.$uploadFiles['name']); // 날짜와 "###" 와  파일명을 합친다음 암호화 한다.
            $uploadFiles['encrypt'] = $uploadFiles['name'];
            // image/png // 여기서 / 뒤에 있는 것이 파일 확장자이다. 해당 확장자만 가져온다.
            $uploadFiles['type'] = explode('/', $uploadFiles['type'])[1]; // png
            $lastFileName = $uploadFiles['name'].".".$uploadFiles['type'];

            if(!in_array( strtolower($uploadFiles['type']) , $arr_allowed_types)){
                echo json_encode(array('result' => 'fail', 'msg' => '업로드 할 수 없는 파일 형식입니다. 이미지 파일만 또는 PDF 파일만 업로드 가능합니다.['.$uploadFiles['type'].']'));
                exit;
            } else {
                if(move_uploaded_file($uploadFiles['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $config['upload_path'] . $lastFileName)){
                    //$add_history .= "<br><a href='/upload/contract/".$this->customclass->Decrypt($uploadFiles['encrypt'])."' target='_blank'>".$this->customclass->Decrypt($uploadFiles['encrypt'])."</a>";

                    $img = $config['upload_path'] . $this->customclass->Decrypt($uploadFiles['encrypt']);
                    $result = $this->ContractModel->addHistory($contractNo, $taskGr, $add_history, $userid, $lastFileName); // 디비에 저장

                    // 저장 후 결과 값을 다시 가져온다... 
                    $consultHistoryListLi = $this->getMakeConsultHistoryList($contractNo, 1); // 상담이력 리스트를 만든다.
                    
                    echo json_encode(array('result' => 'success', 'msg' => '성공', 'consultHistoryListLi' => $consultHistoryListLi));
                    exit;
                } else {
                    echo json_encode(array('result' => 'fail', 'msg' => '파일 업로드에 실패하였습니다.'));
                    exit;
                }
            }
        } else {
            $result = $this->ContractModel->addHistory($contractNo, $taskGr, $add_history, $userid);
            // 저장 후 결과 값을 다시 가져온다.
            $consultHistoryListLi = $this->getMakeConsultHistoryList($contractNo, 1); // 상담이력 리스트를 만든다.
            echo json_encode(array('result' => 'success', 'msg' => '성공', 'consultHistoryListLi' => $consultHistoryListLi));
            exit;
        }

        // 잘못된 접근이라면
        echo json_encode(array('result' => 'fail', 'msg' => '잘못된 접근입니다.'));

    }

    // 히스토리 가져오기 consultHistoryList // 보험 계약 번호를 받으면 해당 보험 계약 번호에 해당하는 히스토리 리스트를 가져와서 <li> 로 만들어서 리턴한다.
    public function getMakeConsultHistoryList($contractNo, $Piece = false){
        // Piece 이 1인 경우에는 1개만 가져온다.
        if($Piece == true){
            $consultHistoryList = $this->ContractModel->getConsultHistoryListPiece($contractNo);
        } else {
            $consultHistoryList = $this->ContractModel->getConsultHistoryList($contractNo);
        }
        
        // 가져온 데이터 디버깅 //$this->customclass->debug($consultHistoryList);
        // 가져온 데이터로 상담 히스토리 리스트를 만든다.
        $consultHistoryListLi = "";
        $arr_uploadFiles = array();
        foreach($consultHistoryList as $key => $val){
            $consultHistoryListLi .= "            <tr>\n";
            $consultHistoryListLi .= "                <th>\n";
            $consultHistoryListLi .= "                <div class=\"thBox\">\n";
            $consultHistoryListLi .= "                    <div class=\"icon-box-item\"><i class=\"icon-".$val->task_group."\"></i></div>\n";
            $consultHistoryListLi .= "                    <div class=\"text-box-item\"><strong>".$val->adminName."</strong><p>".date("Y.m.d", strtotime($val->add_date))."</p></div>\n";
            $consultHistoryListLi .= "                </div>\n";
            $consultHistoryListLi .= "                </th>\n";
            $consultHistoryListLi .= "                <td>\n";
            $consultHistoryListLi .= "                    <div class=\"cont-box-item\"><p>".$val->add_history."</p>\n";
            if($val->uploadFiles != ''){
                // $val->uploadFiles 은 텍스트 이기 때문에 ','로 explode를 사용해서 배열로 만들어서 처리 한다.
                $arr_uploadFiles = explode(',' , $val->uploadFiles);
                foreach($arr_uploadFiles as $key2 => $val2){
                    // 이미지가 실제 서버에 있는지 확인 한다.
                    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/contract/history/" . $val2)){
                        $consultHistoryListLi .= "                    <img src=\"/upload/contract/history/" . $val2 . "\" alt=\"첨부파일\" class=\"img-fluid\" onclick=\"window.open(this.src)\" >\n";
                    }
                }
            }
            $consultHistoryListLi .= "                    </div>\n";
            $consultHistoryListLi .= "                </td>\n";

            $consultHistoryListLi .= "            </tr>\n";
        }

        return $consultHistoryListLi;
    }


    // 보험계약 수정페이지에서 ajax로 넘어온 값을 저장 한다 ajaxModify
    public function ajaxModify(){
        // 넘어온 값들을 디버깅 한다.
        //$this->customclass->debug($this->input->post());
        /*
        Array
            (
                [no] => 4
                [radioGr] => on
                [inflow_channel] => 유입경로
                [insurance] => on
                [insurance_product_name] => 
                [start_date] => 2024-02-01
                [end_date] => 2024-02-29
                [estimate_insurance_premium] => 
                [customer_company_name] => 야옹주식회사
                [insurant] => 야옹1
                [contract_admin1] => es.choi
                [contract_admin2] => tony.kim
                [distribution1] => 90
                [distribution2] => 10
                [insurance_product_commission] => 50
                [insurance_product_additional_commission] => 5
                [advert_cost_company] => 지급광고비_거래처명6
                [advert_cost_commission_rate] => 6
                [memo] => memo4
            )
        */
        // post호 넘어온 값을 변수에 넣는다. // php 함수 extract 를 사용 해서 
        extract($this->input->post());

        

        



        


        
        
    }



}