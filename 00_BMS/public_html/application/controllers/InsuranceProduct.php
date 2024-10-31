<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 사용자 인증 컨트롤러
 */

class InsuranceProduct extends CI_Controller {

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
        $this->load->model('InsuranceProductModel');
        
		@ini_set("allow_url_fopen", "1");        

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);
        
        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    }


    // 보험상품 인덱스
    public function index() {
        // index 라고는 하지만 지금은 list를 호출 하도록 한다.
        //$this->list();
    }

    // 보험상품 리스트
    public function list() {

        //phpinfo();
        //exit;

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        

        
        $menuNo = array(4,2,1); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,6);
        }

        // 검색 데이터를 담을 배열 초기화 
        $searchData = array();
        $searchDataInsurance = "";
        $searchDataInsuranceType = "";
        $searchDataInsurancecompanySelectBox = "";
        $searchDataInsuranceProductName = "";
        $searchDataInternalContactPerson = "";
        $searchDataInsuranceProductCommissionS = "";
        $searchDataInsuranceProductCommissionE = "";
        
        // get 변수를 가져온다.
        $searchData = $this->input->get();
        // get 변수가 있으면 해당 변수를 검색 데이터에 넣는다.
        if(isset($searchData['insurance'])){ $searchDataInsurance = $searchData['insurance'];} 
        if(isset($searchData['insuranceType'])){ $searchDataInsuranceType = $searchData['insuranceType'];}
        if(isset($searchData['InsurancecompanySelectBox'])){ $searchDataInsurancecompanySelectBox = $searchData['InsurancecompanySelectBox'];}
        if(isset($searchData['insuranceProductName'])){ $searchDataInsuranceProductName = $searchData['insuranceProductName'];}
        if(isset($searchData['internalContactPerson'])){ $searchDataInternalContactPerson = $searchData['internalContactPerson'];}
        if(isset($searchData['insuranceProductCommissionS'])){ $searchDataInsuranceProductCommissionS = $searchData['insuranceProductCommissionS'];}
        if(isset($searchData['insuranceProductCommissionE'])){ $searchDataInsuranceProductCommissionE = $searchData['insuranceProductCommissionE'];}

        // 보험사(구분, 보험사)를 가져와서 배열로 만든다.
        $insuranceCompanyList = $this->InsuranceCompanyModel->getInsuranceCompanyDivisionListForArray();
        $insuranceCompanyArray = array();
        foreach($insuranceCompanyList as $key => $val){
            $insuranceCompanyArray[$val->catno] = $val->catnm;
        }

        // 보험 상품테이블에 등록된 보험사 구분 리스트를 가져온다.
        $insuranceCompanyDivisionList = $this->InsuranceProductModel->getInsuranceCompanyList();

        // $insuranceCompanyDivisionList 를 가지고 앞에 3자리만 가져와서 보험사 구분을 만든다.
        $insuranceCompanyDivisionListTmp = array();
        foreach($insuranceCompanyDivisionList as $key => $val){
            $insuranceCompanyDivisionListTmp[$key] = substr($val->insuranceCompanyCate, 0,3);
        }

        // 배열 중복 제거
        $insuranceCompanyDivisionListTmp = array_unique($insuranceCompanyDivisionListTmp);
        
        // 보험사 구분 select box 를 만든다.
        $insuranceCompanyDivisionListSelectBox = "    <option value='' selected>보험사 구분 선택</option>\n";
        foreach($insuranceCompanyDivisionListTmp as $key => $val){
            // 만약 $searchData['insurance'] 값이 있으면 해당 값이 선택되어 있도록 한다. 
            // 만약 $val 이 001 이면 한화생명, 002 이면 동양생명, 003 이면 삼성생명 이런식으로 보여준다.
            if(isset($searchData['insurance'])){
                if($searchData['insurance'] == $val){
                    $insuranceCompanyDivisionListSelectBox .= "                                    <option value='".$val."' selected>".$insuranceCompanyArray[$val]."</option>\n";
                } else {
                    $insuranceCompanyDivisionListSelectBox .= "                                    <option value='".$val."'>".$insuranceCompanyArray[$val]."</option>\n";
                }
            } else {
                $insuranceCompanyDivisionListSelectBox .= "                                    <option value='".$val."'>".$insuranceCompanyArray[$val]."</option>\n";
            }
        }

        // 보험사 select box 를 만든다.
        $insuranceCompanyListSelectBox = "    <option value='' selected>보험사 선택</option>\n";
        foreach($insuranceCompanyDivisionList as $key => $val){
            // 만약 $searchData['insurance'] 값이 있으면 해당 값이 선택되어 있도록 한다.
            if(isset($searchData['InsurancecompanySelectBox'])){
                if($searchData['InsurancecompanySelectBox'] == $val->insuranceCompanyCate){
                    $insuranceCompanyListSelectBox .= "                                    <option value='".$val->insuranceCompanyCate."' selected>".$insuranceCompanyArray[$val->insuranceCompanyCate]."</option>\n";
                } else {
                    $insuranceCompanyListSelectBox .= "                                    <option value='".$val->insuranceCompanyCate."'>".$insuranceCompanyArray[$val->insuranceCompanyCate]."</option>\n";
                }
            } else {
                $insuranceCompanyListSelectBox .= "                                    <option value='".$val->insuranceCompanyCate."'>".$insuranceCompanyArray[$val->insuranceCompanyCate]."</option>\n";
            }
        }

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
                if(isset($searchData['insuranceType'])){
                    if($searchData['insuranceType'] == $val->typeNo){
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


        // 보험사와 부서명을 가져와서 배열로 만든다.
        $insuranceCompanyDeptNameList = $this->InsuranceCompanyModel->getInsuranceCompanyDeptNameList();
        $insuranceCompanyDeptNameListTmp = array();
        foreach($insuranceCompanyDeptNameList as $key => $val){
            $insuranceCompanyDeptNameListTmp[$val->no] = $val->insuranceCompanyDeptName;
        }

        // insurance_type 보험 분류와 종목을 가져와서 배열로 만든다
        $insuranceTypeList = $this->InsuranceProductModel->getInsuranceTypeList();
        $insuranceTypeArray = array();
        foreach($insuranceTypeList as $key => $val){
            $insuranceTypeArray[$val->typeNo] = $val->typeNm;
        }
        // 디버그 확인
        //$this->customclass->Debug($insuranceTypeArray);

        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 페이징에 맞게 관리자 리스트 데이터를 가져온다.
        // $data['LISTDATA'] = $this->InsuranceProductModel->getInsuranceProductList($searchData, $per_page, $offset);
        // $data['SEARCH_TOTAL_CNT'] = $this->InsuranceProductModel->GetInsuranceProductListSearchTotalCnt(); // limit은 빼고 전체 데이터 수를 가져온다.
        // $data['LISTDATA'] = $this->MemberModel->GetAdminListData(1,1);
        // 모델에서 검색 데이터를 가져온다
        $insuranceProductList = "";
        $insuranceProductList = $this->InsuranceProductModel->getInsuranceProductList($searchData, $per_page, $offset);

        // 쿼리 확인
        // echo $this->db->last_query(); 
        // exit;

        $totalCnt = $this->InsuranceProductModel->GetInsuranceProductListSearchTotalCnt();
        $totalCnt = $totalCnt[0]->total_cnt;    

        // 페이징 처리S
        $config = array();
        $config['base_url'] = '/insuranceProduct/list/';
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


        
        $insuranceProductListData = "";

        if(sizeof($insuranceProductList) == 0){
            $insuranceProductListData = "<tr><td colspan='11'>데이터가 없습니다.</td></tr>";
        } else {
            foreach($insuranceProductList as $key => $val){
                $insuranceProductListData .= "                        <tr>\n";
                $insuranceProductListData .= "                            <td>".$val->no."</td>\n";
                $insuranceProductListData .= "                            <td>".$insuranceCompanyArray[substr($val->insuranceCompanyCate, 0,3)]."</td>\n";
                $insuranceProductListData .= "                            <td>".$insuranceCompanyArray[$val->insuranceCompanyCate]."</td>\n";
                $insuranceProductListData .= "                            <td>".$insuranceTypeArray[$val->insuranceClassification]."</td>\n";
                $insuranceProductListData .= "                            <td>".$insuranceTypeArray[$val->insuranceType]."</td>\n";
                $insuranceProductListData .= "                            <td>".$val->insuranceProductName."</td>\n";
                $insuranceProductListData .= "                            <td>".$val->adminName."</td>\n";
                $insuranceProductListData .= "                            <td>".$val->insuranceProductCommission."%</td>\n";
                $insuranceProductListData .= "                            <td>".$val->insuranceProductAdditionalCommission."</td>\n";
                $insuranceProductListData .= "                            <td><pre>".$val->insuranceProductDescription."</pre></td>\n";
                //$insuranceProductListData .= "                            <td>".$val->insuranceProductDocument."</td>\n";
                $insuranceProductListData .= "                        </tr>\n";
            }
                
        }

        
        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/insuranceproduct/list' , array('INSURANCEPRODUCTLISTDATA'=>$insuranceProductListData,
                            'INSURANCECOMPANYDIVISIONLISTSELECTBOX' => $insuranceCompanyDivisionListSelectBox, 
                            'INSURANCECOMPANYLISTSELECTBOX' => $insuranceCompanyListSelectBox, 
                            'INSURANCETYPESELECTBOX' => $insuranceTypeSelectBox, 
                            'SEARCHDATA'=>$searchData,
                            'SEARCHDATAINSURANCE' => $searchDataInsurance,
                            'SEARCHDATAINSURANCETYPE' => $searchDataInsuranceType,
                            'SEARCHDATAINSURANCECOMPANYSELECTBOX' => $searchDataInsurancecompanySelectBox,
                            'SEARCHDATAINSURANCEPRODUCTNAME' => $searchDataInsuranceProductName,
                            'SEARCHDATAINTERNALCONTACTPERSON' => $searchDataInternalContactPerson,
                            'SEARCHDATAINSURANCEPRODUCTCOMMISSIONS' => $searchDataInsuranceProductCommissionS,
                            'SEARCHDATAINSURANCEPRODUCTCOMMISSIONE' => $searchDataInsuranceProductCommissionE,
                            'PAGINATION' => $pagination) );
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 보험상품 등록 페이지
    public function reg() {

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        //해당 페이지는 EPR와 BMS가 동일한 페이지를 사용한다.
        $skinFolder = "bms";
        
        $menuNo = array(4,2,2); // 보험상품 등록 메뉴 번호
        if($this->serviceTab == 'erp'){
            $menuNo = array(3,6);
        }

        //print_r($skinFolder);


        // 보험사 구분 리스트 
        $insurancecompanydivisionlist = $this->InsuranceCompanyModel->getInsuranceCompanyDivisionList();
        // SQL 확인
        //echo $this->db->last_query();

        // 보험사 구분 리스트를 select box 로 만든다.
        $insurancecompanydivisionlistSelectBox = "    <option value='' selected>보험사 선택</option>\n";
        foreach($insurancecompanydivisionlist as $key => $val){
            if($val->depth == 1){
                $insurancecompanydivisionlistSelectBox .= "                                <optgroup label='".$val->catnm."'>\n";
            } else if($val->depth == 2){
                $insurancecompanydivisionlistSelectBox .= "                                    <option value='".$val->catno."'>".$val->catnm."</option>\n";
                if($val->catno == $val->depth_max_catno){
                    $insurancecompanydivisionlistSelectBox .= "                                </optgroup>\n";
                }
            }
        }

        // 보험 분류 선택을 가져와서 select box 로 만든다. INSURANCECLASSIFICATIONSELECTBOX
        $insuranceclassificationlist = $this->InsuranceProductModel->getInsuranceClassificationList();

        // 보험 분류 선택을 가져와서 select box 로 만든다.
        $insuranceclassificationselectbox = "    <option value='' selected>분류 선택</option>\n";
        foreach($insuranceclassificationlist as $key => $val){
            $insuranceclassificationselectbox .= "                                    <option value='".$val->typeNo."'>".$val->typeNm."</option>\n";
        }


        // 내부 담당자 리스트를 가져온다.
        $deptNo = '002002'; // 우선 일반 보험(기업보험) 에서만 가져오는 것으로 
        $internalContactPersonListTmp = $this->MemberModel->GetMemberListByDeptNo($deptNo);

        // 쿼리 확인
        // echo $this->db->last_query();

        // 디버그 확인
        //$this->customclass->Debug($internalContactPersonListTmp);

        // 내부 담당자 리스트를 select box 로 만든다.
        $internalContactPersonListSelectBox = "    <option value='' selected>담당자 선택</option>\n";
        foreach($internalContactPersonListTmp as $key => $val){
            $internalContactPersonListSelectBox .= "                                    <option value='".$val->adminId."'>".$val->adminName."</option>\n";
        }


        $plan_info_tr = "";
        if($this->serviceTab == 'erp'){
                    $plan_info_tr .= "
                        <tr>
                            <th scope=\"row\">
                            <label for=\"planInfoName\">
                                플랜 정보
                            </label>
                        </th>
                        <td colspan=\"3\">
                            <div class=\"inputArea type02\" style=\"width: 350px;\">
                                <input type=\"text\" name=\"planInfoName\" id=\"planInfoName\" class=\"onlyEnNumber\" autocomplete=\"off\" placeholder=\"플랜명(영문+숫자)\" style=\"text-transform: uppercase;\">
                                <span class=\"between\">/</span>
                                <input type=\"text\" name=\"planInfoSummary\" id=\"planInfoSummary\" autocomplete=\"off\" placeholder=\"요약설명\">
                                <span class=\"between\"></span>
                                <div class=\"btnArea\">
                                    <button type=\"button\" id=\"planAdd\" class=\"btn file\" style=\"min-width: auto;\">추가</button>
                                </div>
                            </div>
                                
                            <article class=\"planResult type02\">
                                <ul>
                                    
                                </ul>
                            </article>
                        </td>
                        </tr>
                    ";
        }


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($skinFolder . '/insuranceproduct/reg', array('INSURANCECOMPANYDIVISIONLISTSELECTBOX'=>$insurancecompanydivisionlistSelectBox, 'INSURANCECLASSIFICATIONSELECTBOX'=>$insuranceclassificationselectbox, 'INTERNALCONTACTPERSONLISTSELECTBOX'=>$internalContactPersonListSelectBox, 'PLANINFOTR' => $plan_info_tr));
        $this->load->view($this->serviceTab . '/inc/footer');
    }


    // 보험사에 등록된 해당 보험사에 소속된 부서이름을 가져온다. getInsuranceCompanyDeptNameListByInsuranceCompanyCate($insuranceCompanyCate)
    public function getInsuranceCompanyDeptNameListByInsuranceCompanyCate() {
		/*
        $insuranceCompanyCate = $this->input->post('insuranceCompanyCate');

        $insurancecompanydeptnamelist = $this->InsuranceCompanyModel->getInsuranceCompanyDeptNameListByInsuranceCompanyCate($insuranceCompanyCate);

        // 만약 $insurancecompanydeptnamelist 값이 없으면 에러 메시지를 보낸다.
        if(empty($insurancecompanydeptnamelist)){
            $insurancecompanydeptnamelistSelectBox = "    <option value='' selected>부서/채널 선택</option>\n";
            echo json_encode(array('result' => 'faile', 'msg' => '해당 보험사에 등록된 부서가 없습니다.', 'insurancecompanydeptnamelistSelectBox' => $insurancecompanydeptnamelistSelectBox));
            exit;
        }

        // 보험사 정보에서 등록된 부서이름을 select box 로 만든다.
        $insurancecompanydeptnamelistSelectBox = "    <option value='' selected>부서/채널 선택</option>\n";

        foreach($insurancecompanydeptnamelist as $key => $val){
            $insurancecompanydeptnamelistSelectBox .= "                                    <option value='".$val->no."'>".$val->insuranceCompanyDeptName."</option>\n";
        }

        echo json_encode(array('result' => 'success', 'msg' => '성공', 'insurancecompanydeptnamelistSelectBox' => $insurancecompanydeptnamelistSelectBox));
		*/
		$insuranceCompanyCate = $this->input->post('insuranceCompanyCate');
        $insurancecompanydeptnamelist = $this->InsuranceCompanyModel->getInsuranceCompanyDeptNameListByInsuranceCompanyCate($insuranceCompanyCate);
		
		$insurancecompanydeptnamelistSelectBox = array();
		$msg_txt = "";

		// 만약 $insurancecompanydeptnamelist 값이 없으면 에러 메시지를 보낸다.
        if(count($insurancecompanydeptnamelist) == 0){
			$msg_txt = "해당 보험사에 등록된 부서가 없습니다.";
            $insurancecompanydeptnamelistSelectBox['result'] = 'fail';
            $insurancecompanydeptnamelistSelectBox['msg'] = $msg_txt;
            $insurancecompanydeptnamelistSelectBox['html'] = "    <option value='' selected>".$msg_txt."</option>\n";          
            echo json_encode($insurancecompanydeptnamelistSelectBox);
            exit;
        }

        // 보험사 정보에서 등록된 부서이름을 select box 로 만든다.
        $insurancecompanydeptnamelistSelectBox['result'] = 'success';
        $insurancecompanydeptnamelistSelectBox['msg'] = '성공';
        $insurancecompanydeptnamelistSelectBox['count'] = count($insurancecompanydeptnamelist);
		
		// 결과값이 1개인 경우 처음부터 선택이 되어지도록
		if(count($insurancecompanydeptnamelist) == 1){
			foreach($insurancecompanydeptnamelist as $key => $val){
				$insurancecompanydeptnamelistSelectBox['html'] = "                                    <option value='".$val->no."' selected>".$val->insuranceCompanyDeptName."</option>\n";
			}
			echo json_encode($insurancecompanydeptnamelistSelectBox);
			exit;
		}
	
		// 결과값이 다수인 경우 선택을 하도록
		$insurancecompanydeptnamelistSelectBox['html'] = "    <option value='' selected>부서/채널 선택 !!!</option>\n";
		foreach($insurancecompanydeptnamelist as $key => $val){
			$insurancecompanydeptnamelistSelectBox['html'] .= "                                    <option value='".$val->no."'>".$val->insuranceCompanyDeptName."</option>\n";
		}
		echo json_encode($insurancecompanydeptnamelistSelectBox);
		exit;
    }

	public function abc123() {
		echo "abc123"; // 통신 확인용
        exit;
	}
	

    // 보험분류에 따른 보험 종목을 가져온다. getInsuranceTypeListByInsuranceClassification($insuranceClassification)
    public function getInsuranceTypeListByInsuranceClassification() {
		
        $insuranceClassification = $this->input->post('insuranceClassification');
        $insurancetypelist = $this->InsuranceProductModel->getInsuranceTypeListByInsuranceClassification($insuranceClassification);

        // 결과 디버그 확인 customclass.php 의 debugLog() 함수를 사용하여 디버그 로그를 확인한다.
        //$this->customclass->Debug($insurancetypelist);
        
		$insurancetypelistSelectBox = array();
        // 만약 $insurancetypelist 값이 없으면 에러 메시지를 보낸다.

		$msg_txt = "";
		if(count($insurancetypelist) == 0){
			$msg_txt = "해당 보험분류에 등록된 보험종목이 없습니다.";
            $insurancetypelistSelectBox['result'] = 'fail';
            $insurancetypelistSelectBox['msg'] = $msg_txt;
            $insurancetypelistSelectBox['html'] = "    <option value='' selected>".$msg_txt."</option>\n";          
            echo json_encode($insurancetypelistSelectBox);
            exit;
        }

        // 보험분류에 따른 보험종류를 select box 로 만든다.
		$insurancetypelistSelectBox['result'] = 'success';
        $insurancetypelistSelectBox['msg'] = '성공';
        $insurancetypelistSelectBox['count'] = count($insurancetypelist);
		
		// 결과값이 1개인 경우 처음부터 선택이 되어지도록
		if(count($insurancetypelist) == 1){
			foreach($insurancetypelist as $key => $val){
				$insurancetypelistSelectBox['html'] = "                                    <option value='".$val->typeNo."' selected>".$val->typeNm."</option>\n";
			}
			echo json_encode($insurancetypelistSelectBox);
			exit;
		}

		// 결과값이 다수인 경우 선택을 하도록
		$insurancetypelistSelectBox['html'] = "    <option value='' selected>종목 선택 !!!</option>\n";
		foreach($insurancetypelist as $key => $val){
			$insurancetypelistSelectBox['html'] .= "                                    <option value='".$val->typeNo."'>".$val->typeNm."</option>\n";
		}
        echo json_encode($insurancetypelistSelectBox);
		exit;

	}

    // 보험상품 등록 처리
    public function regProc() {

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // 입력받은 값들을 가져온다.
        $insuranceProductData = $this->input->post();
        
        //디버깅        $this->customclass->debug($insuranceProductData);
        // 파일 디버깅        $this->customclass->debug($_FILES);

        $product_code = date('YmdHis');
        $insuranceProductPlansData = array();

        /*
        Array
        (
            [insuranceCompanyCate] => 001001
            [insuranceCompanyDeptName] => 14
            [insuranceClassification] => 007
            [insuranceType] => 007001
            [insuranceProductName] => 일반화재
            [internalContactPerson] => tony.kim
            [insuranceProductCommission] => 10
            [insuranceProductAdditionalCommission] => Y
            [insuranceProductDescription] => 상품설명 입니다
            [insuranceProductDocument] => 제출 서류 정보 입니다 
            [planInfoName] => 
            [planInfoSummary] => 
            [planNameResult] => Array
                (
                    [0] => P1
                    [1] => P2
                )

            [planSummaryResult] => Array
                (
                    [0] => 플랜1
                    [1] => 플랜2
                )

        )
        Array
        (
            [insuranceProductDocumentFile] => Array
                (
                    [name] => Array
                        (
                            [0] => 스크린샷 2023-07-28 134010.png
                            [1] => 스크린샷_20221227_020732.png
                            [2] => 스크린샷_20221230_023302.png
                        )

                    [type] => Array
                        (
                            [0] => image/png
                            [1] => image/png
                            [2] => image/png
                        )

                    [tmp_name] => Array
                        (
                            [0] => /tmp/phpQNye0P
                            [1] => /tmp/php0iZKKX
                            [2] => /tmp/phpodvCv5
                        )

                    [error] => Array
                        (
                            [0] => 0
                            [1] => 0
                            [2] => 0
                        )

                    [size] => Array
                        (
                            [0] => 357941
                            [1] => 275702
                            [2] => 17897
                        )

                )

        )

            planNameResult
            planSummaryResult

            해당건 추가해야함 DB에도 필드 추가해야함
            추가 테이블 생성해서 planNameResult, planSummaryResult 관리 필요함
            다른 페이지에서 해당 보험상품 선택시 플랜명과 플랜설명을 가져와서 보여줘야함
        */

        // rha




        // 1. 업로드된 파일이 실제 이미지인지 (jpg, jpeg, png, gif, pdf) 확인하기 위해 확장자와 타입을 체크한다.
        // 2. 업로드된 파일이 이미지인지 확인하기 위해 getimagesize() 함수를 사용한다.
        // 3. 파일명을 date('YmdHis') 함수를 사용하여 파일명을 변경후 한번 더 파일명을 암호화 , 암호와 방식은 Customclass->Encrypt 함수를 사용한다.
        // 4. 파일명을 변경후 파일을 업로드 한다.
        // 5. 파일 업로드가 성공하면 파일명을 DB 에 저장한다.
        // 6. 파일 업로드가 실패하면 에러 메시지를 보낸다.
        
        // 파일 업로드를 위한 설정

        //$this->customclass->debug($_FILES);

        //exit;

        // 파일 업로드를 위한 설정 및 이미지 처리 S
        $config['upload_path'] = '/upload/insuranceproduct/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['encrypt_name'] = TRUE;
        $arr_allowed_types = array('gif','jpg', 'jpeg','png','pdf');

        $uploadFiles = $_FILES['insuranceProductDocumentFile'];

        $uploadFileNamesTmp = array();
        if ( isset($_FILES['insuranceProductDocumentFile']['name'])) {
            $cnt = count($_FILES['insuranceProductDocumentFile']['name']);

            for ( $i = 0; $i < $cnt; $i++) {
                $filetype = "";
                if ( isset($_FILES['insuranceProductDocumentFile']['name'][$i])
                && $_FILES['insuranceProductDocumentFile']['size'][$i] > 0 ) {

                    // 파일 타입 체크 업로드 할 수 없는 파일 형식입니다. 이미지 파일만 업로드 가능합니다.
                    $filetype = explode('/', $_FILES['insuranceProductDocumentFile']['type'][$i])[1];
                    if ( !in_array($filetype, $arr_allowed_types) ) {
                        //------------------$this->customclass->AlertMsgMovePage('업로드 할 수 없는 파일 형식입니다. 이미지 파일만 업로드 가능합니다.', '/insuranceProduct_reg');
                        exit;
                    }

                    $filename = $_FILES['insuranceProductDocumentFile']['name'][$i];
                    $filename = $this->customclass->Encrypt(date('YmdHis').'###'.$filename); // 날짜와 "###" 와  파일명을 합친다음 암호화 한다.
                    
                    $target = $config['upload_path'].$filename.'.'.$filetype;
                    $file = $_FILES['insuranceProductDocumentFile']['tmp_name'][$i];
                    //echo "파일명 : ".$filename."<br>";
                    //echo "타겟 : ".$target."<br>";
                    //echo "파일 : ".$file."<br>";


                    // AlertMsgMovePage 파일 업로드에 실패하였습니다. 라는 메세지를 띄우고 리스트 페이지로 이동한다.
                    if ( !move_uploaded_file($file, $_SERVER['DOCUMENT_ROOT'].$target) ) {
                        //---------------------$this->customclass->AlertMsgMovePage('파일 업로드에 실패하였습니다.', '/insuranceProduct/list');
                        exit;
                    }

                    // 파일 명을 배열에 넣는다.
                    $uploadFileNamesTmp[] = $filename.'.'.$filetype;
                }
            }
        }
        // 파일 업로드를 위한 설정 및 이미지 처리 E

        // 파일 업로드가 성공하면 모든내용을 DB 에 저장한다.
        $insuranceProductData['insuranceProductDocumentFile'] = implode(',', $uploadFileNamesTmp);

        // DB 에 저장하기 전에 내용을 디버깅 한다.
        //$this->customclass->debug($insuranceCompanyCate);

        // 실제 DB 에 저장한다.
        // DB 에 저장 전에 $insuranceProductData['planInfoName'], $insuranceProductData['planInfoSummary']  $insuranceProductData['planNameResult'] $insuranceProductData['planSummaryResult'] 변수는 $insuranceProductPlansData 에 담아서 저장 한 다음 
        // $insuranceProductData['planNameResult'] $insuranceProductData['planSummaryResult'] 변수는 삭제한다.

        if(isset($insuranceProductData['planNameResult']) && isset($insuranceProductData['planSummaryResult'])){
            $insuranceProductPlansData['planNameResult'] = $insuranceProductData['planNameResult'];
            $insuranceProductPlansData['planSummaryResult'] = $insuranceProductData['planSummaryResult'];

            unset($insuranceProductData['planInfoName']);
            unset($insuranceProductData['planInfoSummary']);
            unset($insuranceProductData['planNameResult']);
            unset($insuranceProductData['planSummaryResult']);
        }

        $result = $this->InsuranceProductModel->regInsuranceProduct($insuranceProductData);


        // 디버그 확인  $this->customclass->debug($result); // 성공시 성공 메시지가 나온다.

/*
        $planNameResult['planNameResult'] 와 $planNameResult['planSummaryResult'] 변수가 있는경우라면 
        [planNameResult] => Array
        (
            [0] => P1
            [1] => P2
            [2] => P3
        )

        [planSummaryResult] => Array
        (
            [0] => 플랜1
            [1] => 플랜2
            [2] => 플랜3
        )

        이런 데이터가 들어온다.
        해당 데이터를 가지고 DB에 저장을 해야한다.


        insurance_product 에 product_code 라는 필드와 insurance_product_plans 라는 테이블에 product_code 와 매칭을 할 것이며 
        product_code 는 date('YmdHis') 함수를 사용하여 생성하고 해당 product_code 를 가지고 insurance_product_plans 테이블의 product_code 필드에 저장을 한다.

        insurance_product 의 1개의 데이터에 여러개의 플랜이 들어갈 수 있으며
        insurance_product_plans 테이블에는 product_code, plan_name, plan_summary 필드가 들어간다.

        insurance_product_plans 테이블에는 product_code 가 같은 데이터가 여러개 들어갈 수 있다.        


        CREATE TABLE `insurance_product_plans` (
            `no` int(11) NOT NULL AUTO_INCREMENT,
            `product_code` varchar(14) NOT NULL,
            `plan_name` varchar(50) NOT NULL,
            `plan_summary` text NOT NULL,
            `del_yn` enum('Y','N') NOT NULL DEFAULT 'N',
            `update_date` datetime DEFAULT NULL,
            `reg_date` datetime NOT NULL,
            PRIMARY KEY (`no`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci

        */

        // $planNameResult['planNameResult'] 와 $planNameResult['planSummaryResult'] 변수가 있는지 체크
        if(isset($insuranceProductPlansData['planNameResult']) && isset($insuranceProductPlansData['planSummaryResult'])){
            // insurance_product_plans 테이블에 데이터를 넣는다.
            for($i=0; $i<count($insuranceProductPlansData['planNameResult']); $i++){
                $planData = array();
                //$planData['product_code'] = $product_code;
                $planData['product_code'] = $result;
                $planData['plan_name'] = $insuranceProductPlansData['planNameResult'][$i];
                $planData['plan_summary'] = $insuranceProductPlansData['planSummaryResult'][$i];

                // 업데이트날짜, 등록일, 추가
                $planData['reg_date'] = date('Y-m-d H:i:s');

                $insert_id = $this->InsuranceProductModel->insertInsuranceProductPlans($planData);

                // 디버그 확인 
                // echo "<br>=======================<br>";
                // $this->customclass->debug($insert_id);
                // echo "<br>=======================<br>";
            }
        }

        // 결과 디버깅
        //$this->customclass->debug($result); // 성공시 성공 메시지가 나온다.
        //커스텀 클래스에 있는 AlertMsgMovePage() 함수를 호출하여 성공했다는 메세지와 함께 리스트 페이지로 이동한다.

        $this->customclass->AlertMsgMovePage('등록되었습니다.', '/insuranceProduct/list');
        //exit;
    }

    public function regAjax() {
        $insuranceCompanyCate = $this->input->post();
        print_r($insuranceCompanyCate);
        exit;

    }


} // end of class