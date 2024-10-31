<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class Customer extends CI_Controller {

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

		@ini_set("allow_url_fopen", "1");        

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);
        
        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }

    //기본 메인페이지 && 고객사 리스트
    public function list(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(2,1,1);
        //$homaageUrl = 'http://'.$_SERVER['HTTP_HOST'];
        //접속자 주소 확인 후 내부 인원만 접속 가능하게 처리 예정
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_arr = array("121.160.204.192", "192.168.0.13", "172.23.0.1");
        if(!in_array($ip, $ip_arr)){
            //header("Location: http://ubiz.co.kr"); //exit;
        } else {
            //header("Location: /admin/index"); //exit;
        }

        $searchData = array(); // 검색 조건 데이터

        // $searchData 초기 설정 
        $searchData['customer_name'] = ''; // 거래처명
        $searchData['business_number'] = ''; // 사업자번호
        $searchData['policy_number'] = ''; // 증권번호
        $searchData['manager_name'] = ''; // 거래처 담당자  
        $searchData['contract_admin_name'] = ''; // 계약 담당자
        $searchData['insuranceType'] = ''; // 구분

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

        // customer_name 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['customer_name'])){
            $searchData['customer_name'] = $_GET['customer_name'];
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
        // contractAdmin 값이 있으면 검색 조건에 추가 한다.
        if(isset($_GET['contractAdmin'])){
            $searchData['contract_admin_name'] = $_GET['contractAdmin'];
        }

        // 검색폼 필드 관련 데이터 가져오기 S
        // 보험 종목 select option 형식으로 가져오기
        $insuranceTypeSelectBox = $this->insuranceTypeListSelectOption($searchData['insuranceType']);
        // 검색폼 필드 관련 데이터 가져오기 E

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 보험계약 리스트를 가져온다.
        $contractList = "";
        $contractList = $this->CustomerModel->GetCustomerListNew($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        // 가져온 데이터 디버깅 //         
        // $this->customclass->debug($contractList); 
        //쿼리 확인         echo "SQL : ".$this->db->last_query();        exit;
        // 검색결과의 전체 리스트 갯수를 가져온다. GetContractListTotalCnt

        $totalCnt = $this->CustomerModel->GetCustomerListTotalCnt();
        $totalCnt = $totalCnt[0]->total_cnt;    
        
        // 페이징 처리S
        $config = array();
        $config['base_url'] = '/customer/list/';
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows'] = $totalCnt; // 전체 리스트 갯수
        $config['per_page'] = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
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

        // 가져온 데이터로 테이블을 만든다.
        if(empty($contractList)){
            $contractListTr .= "        <tr>\n";
            $contractListTr .= "            <td colspan=\"10\">검색된 데이터가 없습니다.</td>\n";
            $contractListTr .= "        </tr>\n";
        } else {
            foreach($contractList as $key => $val){
                $arr_expiration_notice = "";

                $contractListTr .= "        <tr>\n";
                // val 값의 존재여부에 따라 td 값을 만든다.
                if(isset($val->ano)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->ano."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }   
                if(isset($val->customer_name)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->customer_name."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->insurance_product_name)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->insurance_product_name."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->manager_name)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->manager_name."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->tel)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->tel."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->manager_mobile)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->manager_mobile."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->email)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->email."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->update_date)){
                    if($val->update_date == '0000-00-00 00:00:00'){$val->update_date = "";}
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".substr($val->update_date, 0, 10)."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->adminName1)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">".$val->adminName1."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                if(isset($val->inflow_channel)){
                    $contractListTr .= "            <td onclick=\"location.href='/customer_view/{$val->ano}';\">". $val->inflow_channel."</td>\n";
                } else {
                    $contractListTr .= "            <td></td>\n";
                }
                
                
                $contractListTr .= "        </tr>\n";
            }
        }

        //print_r($contractListTr);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/customer/list', array(
                                                'INSURANCETYPESELECTBOX' => $insuranceTypeSelectBox,
                                                'CONTRACTLISTTR' => $contractListTr,
                                                'SEARCHDATA' => $searchData,
                                                'PAGINATION' => $pagination
        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    }

    public function list2(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(2,1,1);
        //$homaageUrl = 'http://'.$_SERVER['HTTP_HOST'];
        //접속자 주소 확인 후 내부 인원만 접속 가능하게 처리 예정
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_arr = array("121.160.204.192", "192.168.0.13", "172.23.0.1");
        if(!in_array($ip, $ip_arr)){
            //header("Location: http://ubiz.co.kr"); //exit;
        } else {
            //header("Location: /admin/index"); //exit;
        }

        // 고객사 리스트를 가져온다.
        $data['LIST'] = $this->CustomerModel->GetCustomerList(1,1);


        // 검색된 고객사 리스트 개수를 가져온다.


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/customer/list2', array('CUSTOMERLIST'=>$data['LIST']));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 등록된 고객사를 보기 위한 임시 페이지 customerlist
    public function customerlist(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(2,1,1);
        
        // 고객사 리스트를 가져온다.
        $data = $this->CustomerModel->GetCustomerListAll_TMP();
        // 쿼리 확인 하기
        //echo "SQL : ".$this->db->last_query();

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/customer/customerlist', array('CUSTOMERLIST'=>$data['LIST']));
        $this->load->view($this->serviceTab . '/inc/footer');
    }        


    // 고객사 상세보기
    public function view(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        if(!isset($_SERVER['HTTP_REFERER']) or $_SERVER['HTTP_REFERER'] == ''){
            // 레퍼러가 없는 경우 잘못된 접근으로 판단하여 이전페이지로 이동 시킨다.
            //$this->customclass->AlertMsgBackPage('잘못된 접근입니다. 이전페이지로 이동 합니다.');
        }

        // 왼쪽 메뉴 활성화 관견된 변수 설정 
        $menuNo = array(2,1,2);

        // url 에서 고객사 번호를 가져온다.
        $get_ev_num = $this->uri->segment(2);
        if($get_ev_num === ''){
            header("Location: /customer/list"); 
            exit;
        }

        // 모델에서 고객사 정보를 가져온다.
		$data_temp = $this->CustomerModel->GetCustomer($get_ev_num);

        // 디버깅 echo "SQL : ".$this->db->last_query();

        // 결과 디버깅 debug 함수
        //$this->customclass->debug($data_temp);

        // 주소검색 스크립트 가져오기
        $SearchAddress = $this->customclass->SearchAddress();


        $ARR_CONTRACT_TYPE = array(
            '1' => '신규',
            '0' => '갱신'
        );

        // 리턴되는 배열 data_temp 이 비어 있는 배열 인경우 리스트로 이동 
        if(empty($data_temp)){
            // 고객사 정보가 없는 경우 고객사 없다는 메세지 추가보여주고 리스트 페이지로 이동 --> 메세지 따로 없어도 되는지 ..... 
            header("Location: /customer/list");
            exit;
        }

        $data_temp = $data_temp[0];
        //echo "division : ".$data_temp->division;
        //$this->customclass->debug($data_temp); // 디버깅용 커스텀 클래스

        // 클래스를 배열로 변환 
        $data_temp = (array)$data_temp;
        //$this->customclass->debug($data_temp);
        // division_checked 배열에 따라 radio 버튼에 checked 속성을 추가한다. 0 : corporate / 1 : individual / 2 : personal
        if($data_temp['division'] == 'corporate'){
            $division_checked = '
            <div class="selector">
                <input type="radio" id="corporate" name="division" checked>
                <label for="corporate">법인 사업자</label>
            </div>
            ';
        } else if($data_temp['division'] == 'individual'){
            $division_checked = '
            <div class="selector">
                <input type="radio" id="individual" name="division" checked>
                <label for="individual">개인 사업자</label>
            </div>
            ';
        } else if($data_temp['division'] == 'personal'){
            $division_checked = '
            <div class="selector">
                <input type="radio" id="personal" name="division" checked>
                <label for="personal">개인</label>
            </div>
            ';
        }

        // 채널별로 온 오프 체크값 배열에 추가
        if($data_temp['management_channel'] == 'offline'){
            $data_temp['onoffGr'][0] = 'checked';
            $data_temp['onoffGr'][1] = '';
        } else {
            $data_temp['onoffGr'][0] = '';
            $data_temp['onoffGr'][1] = 'checked';
        }



        // 보험가입 정보 가져오기 // contract.php 에서 getContractListFromCustomerNo() 함수를 호출하여 보험가입 정보를 가져온다.
        // NO	종목	상품명	증권번호	청약일	보험 기간	보험료	피보험자	취급 담당자	부 담당자	상태	기타
        $insuranceProductList = $this->ContractModel->getContractListFromCustomerNo($get_ev_num);
        // 가입한 보험 개수를 가져온다.
        $insuranceProductListCnt = count($insuranceProductList);
        // 보험가입 정보를 테이블로 만든다.
        $insuranceProductListTr = "";
        if(empty($insuranceProductList)){
            $insuranceProductListTr .= "        <tr>\n";
            $insuranceProductListTr .= "            <td colspan=\"12\">검색된 데이터가 없습니다.</td>\n";
            $insuranceProductListTr .= "        </tr>\n";
        } else {
            foreach($insuranceProductList as $key => $val){
                $insuranceProductListTr .= "        <tr>\n";
                $insuranceProductListTr .= "            <td>".($insuranceProductListCnt-$key)."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->typeNm."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->insurance_product_name."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->policy_number."</td>\n";
                $insuranceProductListTr .= "            <td>".date('Y.m.d', strtotime($val->contract_date))."</td>\n";
                $insuranceProductListTr .= "            <td>".date('Y.m.d', strtotime($val->insurance_period_start))."~".date('Y.m.d', strtotime($val->insurance_period_end))."</td>\n";
                $insuranceProductListTr .= "            <td>".number_format($val->insurance_premium)."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->customer_name."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->adminName."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->adminName2."</td>\n";
                $insuranceProductListTr .= "            <td>".$val->inflow_channel."</td>\n";
                $insuranceProductListTr .= "            <td>-</td>\n";
                $insuranceProductListTr .= "        </tr>\n";
            }
        }


        // 보험 가입된 정보의 히스토리를 가져온다.
        $insuranceProductListHistory = $this->ContractModel->getContractListHistoryFromCustomerNo($get_ev_num);
        // 가입한 보험 개수를 가져온다.
        $insuranceProductListHistoryCnt = count($insuranceProductListHistory);
        // debug $this->customclass->debug($insuranceProductListHistory);

        $ARR_TASK_GROUP = array(
            'email' => '이메일',
            'tel' => '전화기',
            'file' => '파일',
            'estimate' => '견적서',
            'visit' => '방문'
        );

        $insuranceProductListHistoryTr = "";
        if(!empty($insuranceProductListHistory)){
            foreach($insuranceProductListHistory as $key => $val){
                $insuranceProductListHistoryTr .= "        <li>\n";
                $insuranceProductListHistoryTr .= "            <div class=\"title\">\n";
                $insuranceProductListHistoryTr .= "                <div class=\"icon-box-item\">\n";
                $insuranceProductListHistoryTr .= "                    <i class=\"icon-".$val->task_group."\">".$ARR_TASK_GROUP[$val->task_group]."</i>\n";
                $insuranceProductListHistoryTr .= "                </div>\n";
                $insuranceProductListHistoryTr .= "                <div class=\"text-box-item\">\n";
                $insuranceProductListHistoryTr .= "                    <strong>".$val->adminName."</strong>\n";
                $insuranceProductListHistoryTr .= "                    <p>".date('Y.m.d', strtotime($val->add_date))."</p>\n";
                $insuranceProductListHistoryTr .= "                </div>\n";
                $insuranceProductListHistoryTr .= "            </div>\n";
                $insuranceProductListHistoryTr .= "        </li>\n";
                $insuranceProductListHistoryTr .= "        <li>\n";
                $insuranceProductListHistoryTr .= "            <div class=\"cont-box-item\">\n";
                $insuranceProductListHistoryTr .= "                <strong>".$val->insurance_product_name."</strong>\n";
                $insuranceProductListHistoryTr .= "                <p>".$val->add_history."</p>\n";
                $insuranceProductListHistoryTr .= "            </div>\n";
                $insuranceProductListHistoryTr .= "        </li>\n";
            }
        }

        //$this->customclass->debug($data_temp); // 디버깅용 커스텀 클래스
        $this->load->view($this->serviceTab . '/inc/common', array('SearchAddress' => $SearchAddress));
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/customer/view', array('CUSTOMERDATA'=>$data_temp, 
                                                                    'DIVISION_CHECKED'=>$division_checked,
                                                                    'INSURANCEPRODUCTLISTTR'=>$insuranceProductListTr,
                                                                    'INSURANCEPRODUCTLISTHISTORYTR'=>$insuranceProductListHistoryTr,
                                                                    'ONOFFRADIOCHECKED1' => $data_temp['onoffGr'][0],
                                                                    'ONOFFRADIOCHECKED2' => $data_temp['onoffGr'][1]
                                                                    ));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 고객사 등록
    public function reg(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(2,2,1);

        // 고객사 등록 페이지에서 주소 검색을 위한 다음 주소 API 를 사용하기 위한 키값을 설정한다.
        $SearchAddress = $this->customclass->SearchAddress();

        $this->load->view($this->serviceTab . '/inc/common', array('SearchAddress' => $SearchAddress));
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/customer/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // ------------------------------------------------------------
    // 해당 페이지는 그때그때 필요시마다 ajax 로 호출하여 사용한다.
    // 고객사 사업자별 보여주는 등록 페이지
    // 법인사업자, 개인사업자인 경우
    public function reg_com(){
        $this->load->view($this->serviceTab . '/customer/reg_com');
    }
    // 개인 인경우
    public function reg_per(){
        $this->load->view($this->serviceTab . '/customer/reg_per');
    }
    // ------------------------------------------------------------


    // 고객사 등록 프로세스
    public function regProc(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // reg.php 에서 넘어온 값들을 변수에 담는다.
        $data = $this->input->post();
        
        $data['regdate'] = date("Y-m-d H:i:s");
        
        // 들어온 값이 사업자 형태 별로 빠짐이 없는지 확인한다.
        if($data['division'] == 'corporate' || $data['division'] == 'individual'){
            // $data 값 확인 후 값이 없으면 '누락된 정보가 있습니다.' 라는 메세지를 보여준다음 json 으로 리턴한다.
            if($data['customer_name'] == '' || $data['industry'] == '' || $data['ceo_name'] == '' || $data['business_number'] == '' || $data['manager_name'] == '' || $data['manager_position'] == '' || $data['manager_dept'] == '' || $data['manager_tel'] == '' || $data['manager_mobile'] == '' || $data['tel'] == '' || $data['email'] == '' || $data['management_channel'] == '' || $data['road_address'] == '' || $data['detail_address'] == '' || $data['postcode'] == ''){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '누락된 정보가 있습니다.';
                echo json_encode($return_data);
                exit;
            }

            // 사업자번호 정규식 체크
            if($data['business_number'] != ''){
                if(!$this->customclass->BizNumChk($data['business_number'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '사업자번호 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }

            // 매니저 핸드폰 번호 정규식 체크
            if($data['manager_mobile'] != ''){
                if(!$this->customclass->PhoneNumChk($data['manager_mobile'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '매니저 핸드폰 번호 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }

            // 이메일 정규식 체크
            if($data['email'] != ''){
                if(!$this->customclass->EmailChk($data['email'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '이메일 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }


        } else if($data['division'] == 'personal'){
            // $data 값 확인 후 값이 없으면 '누락된 정보가 있습니다.' 라는 메세지를 보여준다음 json 으로 리턴한다.
            if($data['customer_name'] == '' || $data['road_address'] == '' || $data['resident_number'] == '' || $data['detail_address'] == '' || $data['postcode'] == '' || $data['tel'] == '' || $data['manager_mobile'] == '' || $data['email'] == '' || $data['management_channel'] == '' ){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '누락된 정보가 있습니다.';
            } 

            // resident_number_ok 값이 0 이면 주민번호가 문제가 있는것이므로 리턴한다.
            if($data['resident_number_ok'] == 0){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '주민번호 형식이 올바르지 않거나 중복입니다.';
                echo json_encode($return_data);
                exit;
            }

            $data['ceo_name'] = $data['customer_name'];

            if(isset($data['resident_number'])){
                // 주민번호 정규식 체크
                if($data['resident_number'] != ''){
                    if(!$this->customclass->JuminNumChk($data['resident_number'])){
                        $return_data['result'] = 'fail';
                        $return_data['msg'] = '주민번호 형식이 올바르지 않습니다.';
                        echo json_encode($return_data);
                        exit;
                    }
                }

                // 주민번호 암호화 처리 Encrypt
                $data['resident_number_encrypt'] = $this->customclass->Encrypt($data['resident_number']);
                // 주민번호 중복 체크
                $result = $this->CustomerModel->CheckJuminNo($data['resident_number_encrypt']);
                // 쿼리 확인 하기
                //echo "SQL : ".$this->db->last_query();
                // 주민번호 중복 체크 결과가 있으면 리턴한다.
                if($result){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '주민번호가 중복입니다.';
                    echo json_encode($return_data);
                    exit;
                }
                
                // 주민번호 처리
                // 주민번호를 - 으로 구분해서 - 뒷자리 1자리까지만 보여준다.
                $resident_number = explode('-', $data['resident_number']);
                $resident_number[1] = substr($resident_number[1], 0, 1);
                $data['resident_number'] = $resident_number[0].'-'.$resident_number[1];
            }

            // 휴대전화 번호 정규식 체크
            if($data['manager_mobile'] != ''){
                if(!$this->customclass->PhoneNumChk($data['manager_mobile'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '휴대전화 번호 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }

            // 이메일 정규식 체크
            if($data['email'] != ''){
                if(!$this->customclass->EmailChk($data['email'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '이메일 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }
        }


        // 등록전 DB에 없는 resident_number_ok , email_ok, business_number_ok 값은 삭제한다.
        unset($data['resident_number_ok']);
        unset($data['email_ok']);
        unset($data['business_number_ok']);


        // 고객사 등록 프로세스를 실행한다.
        $result = $this->CustomerModel->CustomerRegProc($data);

        // 쿼리 확인 하기
        //echo "SQL : ".$this->db->last_query();


        if($result){
            $return_data['result'] = 'success';
            $return_data['msg'] = '고객사 등록이 완료 되었습니다.';
            echo json_encode($return_data);
            exit;
        } else {
            $return_data['result'] = 'fail';
            $return_data['msg'] = '고객사 등록에 실패 하였습니다.';
            echo json_encode($return_data);
            exit;
        }
    }


    // 사업자 번호 중복 체크
    public function CheckBizNo(){
        $bizNo = $this->input->post('business_number');
        $result = $this->CustomerModel->CheckBizNo($bizNo);

        // 쿼리 확인 하기
        //echo "SQL : ".$this->db->last_query();
        
        if(!$result){
            $return_data['result'] = 'success';
            $return_data['msg'] = '사용 가능한 사업자 번호 입니다.';
            echo json_encode($return_data);
            exit;
        } else {
            $return_data['result'] = 'fail';
            $return_data['msg'] = '이미 등록된 사업자 번호 입니다.';
            echo json_encode($return_data);
            exit;
        }
    }


    public function CheckEmail(){
        $email = $this->input->post('email');

        // 이메일 정규식 체크
        if($email != ''){
            if(!$this->customclass->EmailChk($email)){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '이메일 형식이 올바르지 않습니다.';
                echo json_encode($return_data);
                exit;
            }
        }

        // customermodel 에서 이메일 중복체크를 한다.
        $result = $this->CustomerModel->CheckEmail($email);        
        // 쿼리 확인 하기
        //echo "SQL : ".$this->db->last_query();
        if(!$result){
            $return_data['result'] = 'success';
            $return_data['msg'] = '사용 가능한 이메일 입니다.';            
            echo json_encode($return_data);
            exit;
        } else {
            $return_data['result'] = 'fail';
            $return_data['msg'] = '이미 등록된 이메일 입니다.';            
            echo json_encode($return_data);
            exit;
        }
        
    }


    // 주민 번호 중복체크 CustomerClass -> CheckJuminNo
    public function CheckJuminNo(){
        $juminNo = $this->input->post('resident_number');

        // 글자수가 14자리가 아니면 리턴
        if(strlen($juminNo) != 14){
            $return_data['result'] = 'fail';
            $return_data['msg'] = '주민번호 형식이 올바르지 않습니다.';
            echo json_encode($return_data);
            exit;
        }
        // 주민번호 정규식 체크
        if($juminNo != ''){
            if(!$this->customclass->JuminNumChk($juminNo)){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '주민번호 형식이 올바르지 않습니다..';
                echo json_encode($return_data);
                exit;
            }
        }

        // 주민번호 암호화 처리 Encrypt
        $juminNo = $this->customclass->Encrypt($juminNo);

        $result = $this->CustomerModel->CheckJuminNo($juminNo);
        // 쿼리 확인 하기
		//echo "SQL : ".$this->db->last_query();
        if($result){
            $return_data['result'] = 'fail';
            $return_data['msg'] = '이미 등록된 주민 번호 입니다.';
            echo json_encode($return_data);
            exit;
        } else {
            $return_data['result'] = 'success';
            $return_data['msg'] = '사용 가능한 주민 번호 입니다.';
            echo json_encode($return_data);
            exit;
        }
    }


    // 추후 공통으로 빼야 할듯... Contract Controller 에도 중복되는 부분이 있음
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


    // 거래처 customer_view 에서 수정 버튼 클릭시 Ajax 로 수정 데이터를 전달한다
    // 해당 데이터를 받아서 ajax_customer_update_proc 를 실행 한다    
    public function ajax_customer_update_proc(){

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // reg.php 에서 넘어온 값들을 변수에 담는다.
        $data = $this->input->post(); 
        
        // 들어온 값이 사업자 형태 별로 빠짐이 없는지 확인한다.
        if($data['division'] == 'corporate' || $data['division'] == 'individual'){
            // $data 값 확인 후 값이 없으면 '누락된 정보가 있습니다.' 라는 메세지를 보여준다음 json 으로 리턴한다.
            if( $data['manager_name'] == '' || $data['manager_position'] == '' || $data['manager_dept'] == '' || $data['manager_tel'] == '' || $data['manager_mobile'] == '' || $data['tel'] == '' || $data['email'] == '' || $data['management_channel'] == '' ||  ( $data['road_address'] == '' &&  $data['jibun_address'] == '' ) || $data['detail_address'] == '' || $data['postcode'] == ''){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '누락된 정보가 있습니다.';
                echo json_encode($return_data);
                exit;
            }
            // 사업자번호 정규식 체크
            /*
            if($data['business_number'] != ''){
                if(!$this->customclass->BizNumChk($data['business_number'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '사업자번호 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }
            */
            
            // 매니저 핸드폰 번호 정규식 체크
            if($data['manager_mobile'] != ''){
                if(!$this->customclass->PhoneNumChk($data['manager_mobile'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '매니저 핸드폰 번호 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }
            
            // 이메일 정규식 체크
            if($data['email'] != ''){
                if(!$this->customclass->EmailChk($data['email'])){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '이메일 형식이 올바르지 않습니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }
            
        } else if($data['division'] == 'personal'){

            // $data 값 확인 후 값이 없으면 '누락된 정보가 있습니다.' 라는 메세지를 보여준다음 json 으로 리턴한다.
            if( $data['road_address'] == '' || $data['detail_address'] == '' || $data['postcode'] == '' || $data['tel'] == '' || $data['manager_mobile'] == '' || $data['email'] == '' || $data['management_channel'] == '' ){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '누락된 정보가 있습니다.';
                echo $return_data['msg'];
            } 
            
            // resident_number_ok 값이 0 이면 주민번호가 문제가 있는것이므로 리턴한다.
            /*
            if($data['resident_number_ok'] == 0){
                $return_data['result'] = 'fail';
                $return_data['msg'] = '주민번호 형식이 올바르지 않거나 중복입니다.';
                echo json_encode($return_data);
                exit;
            }
            */
            
            // $data['ceo_name'] = $data['customer_name'];
            unset($data['customer_name']);
            if(isset($data['resident_number'])){
            
                // 주민번호 정규식 체크
                if($data['resident_number'] != ''){
                    if(!$this->customclass->JuminNumChk($data['resident_number'])){
                        $return_data['result'] = 'fail';
                        $return_data['msg'] = '주민번호 형식이 올바르지 않습니다.';
                        echo json_encode($return_data);
                        exit;
                    }
                }
            
                // 주민번호 암호화 처리 Encrypt
                $data['resident_number_encrypt'] = $this->customclass->Encrypt($data['resident_number']);
                // 주민번호 중복 체크
                $result = $this->CustomerModel->CheckJuminNo($data['resident_number_encrypt']);
                // 쿼리 확인 하기
                //echo "SQL : ".$this->db->last_query();
                // 주민번호 중복 체크 결과가 있으면 리턴한다.
                if($result){
                    $return_data['result'] = 'fail';
                    $return_data['msg'] = '주민번호가 중복입니다.';
                    echo json_encode($return_data);
                    exit;
                }
            }
        }


        // 등록전 DB에 없는 resident_number_ok , email_ok 값은 삭제한다.
        unset($data['resident_number_ok']);
        unset($data['email_ok']);
        

        // 고객사 등록 프로세스를 실행한다.
        $result = $this->CustomerModel->CustomerUpdateProc($data);

        // 쿼리 확인 하기
        $sqlmasg = "SQL : ".$this->db->last_query();

        if($result){
            $return_data['result'] = 'success';
            $return_data['msg'] = '고객사 수정이 완료 되었습니다.';
            echo json_encode($return_data);
            exit;
        } else {
            $return_data['result'] = 'fail';
            $return_data['msg'] = '고객사 수정에 실패 하였습니다.';
            echo json_encode($return_data);
            exit;
        }

    }



}