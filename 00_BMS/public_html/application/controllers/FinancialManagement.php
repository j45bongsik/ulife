<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
/**
 * 회계관리 컨트롤러
 * 
 * // 회계관리 컨트롤러 파일
 * // 1. 회계관리 메뉴를 클릭하면 매출, 매입, 카드사용내역 리스트들을 볼 수 있음
 * // 1-1 매출 리스트
 * // 1-2 매입 리스트
 * // 1-3 카드사용내역 리스트
 */

class FinancialManagement extends CI_Controller {

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
        $this->load->model('ErpBasicInfoModel');
        $this->load->model('FinancialManagementModel');
        $this->load->model('ContractModel');
        $this->load->model('MemberModel');

		@ini_set("allow_url_fopen", "1");

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);

        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();
    } // end of __construct


    public function index() {
        $this->salesBreakdownList();
    } // end of index

    // 매출 리스트
    public function salesBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        //$this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(1,1,1);
        

        // get 방식으로 넘어온 데이터를 받는다.
        $searchData = array();
        $searchData['searchDateY'] = $this->input->get('searchDateY');
        $searchData['searchDateM'] = $this->input->get('searchDateM');
        $searchData['sup_business_number'] = $this->input->get('sup_business_number');
        $searchData['rec_sup_business_number'] = $this->input->get('rec_sup_business_number');
        $searchData['rec_sup_mutual'] = $this->input->get('rec_sup_mutual');        

        $BUYBREAKDOWNLISTEXCEL = ""; // 엑셀 다운로드 버튼을 위한 변수


        // 공급받는자 사업자 번호가 있으면 숫자만 남기고 다시 사업자 번호 형식( 000-00-00000 )으로 만드는 작업
        if(isset($searchData['rec_sup_business_number']) && $searchData['rec_sup_business_number'] != ''){
            $searchData['rec_sup_business_number'] = preg_replace("/[^0-9]/", "", $searchData['rec_sup_business_number']);
            $searchData['rec_sup_business_number'] = substr($searchData['rec_sup_business_number'],0,3)."-".substr($searchData['rec_sup_business_number'],3,2)."-".substr($searchData['rec_sup_business_number'],5,5);
        }

        // $FROM_SINCE_MONTH_SELECT_BOX
        $FROM_SINCE_MONTH_SELECT_BOX = "<option value='' selected>작성월 선택</option>\n";
        for($i = 1; $i <= 12; $i++){
            if($searchData['searchDateM'] == sprintf('%02d',$i)){
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."' selected>".sprintf('%02d',$i)."월"."</option>\n";
            } else {
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."'>".sprintf('%02d',$i)."월"."</option>\n";
            }
        }

        // FROM_SINCE_YEAR_SELECT_BOX
        $FROM_SINCE_YEAR_SELECT_BOX = "<option value='' selected>작성년도 선택</option>\n";
        for($i = 2015; $i <= date('Y'); $i++){
            if($searchData['searchDateY'] == $i){
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."'>".$i."</option>\n";
            }
        }

        $SUP_BUSINESS_ARRAY = array(
            '636-87-00912' => '주식회사 비아이에스',
            '118-88-00158' => '주식회사 유라이프파이낸셜',
            '720-81-01460' => '유라이프커뮤니케이션즈',
        );

        $SUP_BUSINESS_NUMBER_SELECT_BOX = "";
        // get 방식으로 넘어온 데이터를 받는다. rec_sup_business_number 값이 없으면 공급받는자를 선택하게 한다. 있으면 해당 사업자 번호를 선택하게 한다.
        if(isset($searchData['sup_business_number']) && $searchData['sup_business_number'] != '') {
            $SUP_BUSINESS_NUMBER_SELECT_BOX = "<option value=''>공급자</option>\n";
            foreach($SUP_BUSINESS_ARRAY as $key => $value){
                $SUP_BUSINESS_NUMBER_SELECT_BOX .= "                <option value='".$key."'";
                if($searchData['sup_business_number'] == $key){
                    $SUP_BUSINESS_NUMBER_SELECT_BOX .= " selected";
                }
                $SUP_BUSINESS_NUMBER_SELECT_BOX .= ">".$value."</option>\n";
            }
        } else {
            $SUP_BUSINESS_NUMBER_SELECT_BOX = "<option value='' selected>공급자</option>\n";
            foreach($SUP_BUSINESS_ARRAY as $key => $value){
                $SUP_BUSINESS_NUMBER_SELECT_BOX .= "                <option value='".$key."'>".$value."</option>\n";
            }
        }

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 매출 내역 가져오기
        $salesBreakdownListTmp = array();
        $salesBreakdownListTmp = $this->FinancialManagementModel->getSalesBreakdownList($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        $salesBreakdownList = $salesBreakdownListTmp;
        //쿼리 확인
        
        // 쿼리를 변수에 담아서 엑셀 다운로드를 위해 사용한다. // "order by a.no desc" 를 기준으로 나눠서 앞의 쿼리만 가져온다.
        $salesBreakdownListExcelTmp = $this->db->last_query();
        $salesBreakdownListExcelTmp = explode(" LIMIT ",$salesBreakdownListExcelTmp);

        // 엑셀 다운로드에 들어가는 헤더를 만들어서 앞에 붙인 뒤 한꺼번에 암호화 한다.
        $salesBreakdownListExcel = "회사(공급받는자)|일자|사업자번호|상호|항목|품목명|금액||";
        $salesBreakdownListExcel .= "rec_sup_mutual|issue_date|sup_business_number|sup_mutual|item_cate|item_name|total_amount||";
        $salesBreakdownListExcel .= $salesBreakdownListExcelTmp[0]."\n";

        // 암호화 한다
        $salesBreakdownListExcel = $this->customclass->encrypt($salesBreakdownListExcel);

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $salesBreakdownTotalSum = 0;
        $salesBreakdownTotalSum = $this->FinancialManagementModel->getSalesBreakdownListTotalSum($searchData);

        $salesBreakdownTotalPriceSum = number_format($salesBreakdownTotalSum[0]->sum_total_amount);
        $totalCnt = $salesBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/salesBreakdown/list/';
        $config['first_url']            = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows']           = $totalCnt; // 전체 리스트 갯수
        $config['per_page']             = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers']     = TRUE;
        $config['num_links']            = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE; 
        $config['reuse_query_string']   = TRUE;
        $config['cur_tag_open']         = '<strong>';
        $config['cur_tag_close']        = '</strong>';
        $config['uri_segment']          = 3; // 페이지 번호가 있는 세그먼트
        $config['use_page_numbers']     = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open']        = '<div class="paginate">';
        $config['full_tag_close']       = '</div>';
        $config['first_link']           = '<i class="prev-arrow-double"></i>';
        $config['last_link']            = '<i class="next-arrow-double"></i>';
        $config['prev_link']            = '<i class="prev-arrow"></i>';
        $config['next_link']            = '<i class="next-arrow"></i>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        // 페이징 처리E

        // 페이징에서 NO를 보여주기 위해서 전체 리스트 갯수에서 하나씩 빼서 보여준다. 검색된 데이터의 전체 수에서 해당 페이지의 첫번째 데이터의 순번을 빼서 보여준다.
        // 해당 페이지의 첫번쨰 열 계산
        $firstNo = $totalCnt - $per_page * ($page - 1);

        // 가져온 내용 customclass debug 출력  $this->customclass->debug($cardBreakdownList);
        // tr 태그로 만들어서 출력해보기
        $tr = '';
        if(!$salesBreakdownList){
            $tr .= "<tr>\n";
            $tr .= "    <td colspan='9'>데이터가 없습니다.</td>\n";
            $tr .= "</tr>\n";

            $salesBreakdownListExcel = "onclick=\"alert('데이터가 없거나 검색을 해주세요');\"";
        } else {
            $salesBreakdownListExcel = "href=\"/exceldown?param=".$salesBreakdownListExcel."\"";
            foreach($salesBreakdownList as $key => $value){
                $tr .= "<tr>\n";
                // 실제 검색된 데이터의 전체 개수에서 하나씩 빼서 no 값을 보여줌
                $tr .= "    <td no=\"".$value->no."\">".($firstNo - $key)."</td>\n";
                $tr .= "    <td>".$value->sup_mutual."</td>\n";
                $tr .= "    <td>".$value->issue_date."</td>\n";
                $tr .= "    <td>".$value->rec_sup_business_number."</td>\n";
                $tr .= "    <td>".$value->rec_sup_mutual."</td>\n";
                $tr .= "    <td>".$value->item_cate."</td>\n";
                $tr .= "    <td>".$value->item_name."</td>\n";
                if($value->tax_amount == 0){
                    $tr .= "    <td>계산서</td>\n";
                } else {
                    $tr .= "    <td>세금계산서</td>\n";
                }
                $tr .= "    <td>".number_format($value->total_amount)."</td>\n";
                $tr .= "</tr>\n";
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/financialManagement/sales/breakdownlist', array(
                                            'FROMSINCEMONTH'=>$FROM_SINCE_MONTH_SELECT_BOX,
                                            'FROMSINCEYEAR'=>$FROM_SINCE_YEAR_SELECT_BOX,
                                            'SALESBREAKDOWNLISTEXCEL' => $salesBreakdownListExcel,
                                            'SUP_BUSINESS_NUMBER_SELECT_BOX' => $SUP_BUSINESS_NUMBER_SELECT_BOX,
                                            'SEARCH_DATA_REC_SUP_BUSINESS_NUMBER' => $searchData['rec_sup_business_number'],
                                            'SEARCH_DATA_REC_SUP_MUTUAL' => $searchData['rec_sup_mutual'],
                                            'SALESUPLOADHISTORYTABLE' => $tr,
                                            'SALESUPLOADHISTORYTOTALSUM' => $salesBreakdownTotalPriceSum,
                                            'PAGINATION' => $pagination,
                                        
                                        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of salesBreakdown

    // 매입 리스트
    public function purchaseBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        $menuNo = array(1,2,2);

        // get 방식으로 넘어온 데이터를 받는다.
        $searchData = array();
        $searchData['searchDateY'] = $this->input->get('searchDateY');
        $searchData['searchDateM'] = $this->input->get('searchDateM');
        $searchData['rec_sup_business_number'] = $this->input->get('rec_sup_business_number');
        $searchData['sup_business_number'] = $this->input->get('sup_business_number');
        $searchData['sup_mutual'] = $this->input->get('sup_mutual');        

        $BUYBREAKDOWNLISTEXCEL = ""; // 엑셀 다운로드 버튼을 위한 변수


        // 공급자 사업자 번호가 있으면 숫자만 남기고 다시 사업자 번호 형식( 000-00-00000 )으로 만드는 작업
        if(isset($searchData['sup_business_number']) && $searchData['sup_business_number'] != ''){
            $searchData['sup_business_number'] = preg_replace("/[^0-9]/", "", $searchData['sup_business_number']);
            $searchData['sup_business_number'] = substr($searchData['sup_business_number'],0,3)."-".substr($searchData['sup_business_number'],3,2)."-".substr($searchData['sup_business_number'],5,5);
        }

        // $FROM_SINCE_MONTH_SELECT_BOX
        $FROM_SINCE_MONTH_SELECT_BOX = "<option value='' selected>작성월 선택</option>\n";
        for($i = 1; $i <= 12; $i++){
            if($searchData['searchDateM'] == sprintf('%02d',$i)){
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."' selected>".sprintf('%02d',$i)."월"."</option>\n";
            } else {
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."'>".sprintf('%02d',$i)."월"."</option>\n";
            }
        }

        // FROM_SINCE_YEAR_SELECT_BOX
        $FROM_SINCE_YEAR_SELECT_BOX = "<option value='' selected>작성년도 선택</option>\n";
        for($i = 2015; $i <= date('Y'); $i++){
            if($searchData['searchDateY'] == $i){
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."'>".$i."</option>\n";
            }
        }

        $REC_SUP_BUSINESS_ARRAY = array(
            '636-87-00912' => '주식회사 비아이에스',
            '118-88-00158' => '주식회사 유라이프파이낸셜',
            '720-81-01460' => '유라이프커뮤니케이션즈',
        );

        $REC_SUP_BUSINESS_NUMBER_SELECT_BOX = "";
        // get 방식으로 넘어온 데이터를 받는다. rec_sup_business_number 값이 없으면 공급받는자를 선택하게 한다. 있으면 해당 사업자 번호를 선택하게 한다.
        if(isset($searchData['rec_sup_business_number']) && $searchData['rec_sup_business_number'] != '') {
            $REC_SUP_BUSINESS_NUMBER_SELECT_BOX = "<option value=''>공급받는자</option>\n";
            foreach($REC_SUP_BUSINESS_ARRAY as $key => $value){
                $REC_SUP_BUSINESS_NUMBER_SELECT_BOX .= "                <option value='".$key."'";
                if($searchData['rec_sup_business_number'] == $key){
                    $REC_SUP_BUSINESS_NUMBER_SELECT_BOX .= " selected";
                }
                $REC_SUP_BUSINESS_NUMBER_SELECT_BOX .= ">".$value."</option>\n";
            }
        } else {
            $REC_SUP_BUSINESS_NUMBER_SELECT_BOX = "<option value='' selected>공급받는자</option>\n";
            foreach($REC_SUP_BUSINESS_ARRAY as $key => $value){
                $REC_SUP_BUSINESS_NUMBER_SELECT_BOX .= "                <option value='".$key."'>".$value."</option>\n";
            }
        }

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 매입 내역 가져오기
        $purchaseBreakdownListTmp = array();
        $purchaseBreakdownListTmp = $this->FinancialManagementModel->getPurchaseBreakdownList($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        $purchaseBreakdownList = $purchaseBreakdownListTmp;
        //쿼리 확인
        
        // 쿼리를 변수에 담아서 엑셀 다운로드를 위해 사용한다. // "order by a.no desc" 를 기준으로 나눠서 앞의 쿼리만 가져온다.
        $buyBreakdownListExcelTmp = $this->db->last_query();
        $buyBreakdownListExcelTmp = explode(" LIMIT ",$buyBreakdownListExcelTmp);

        // 엑셀 다운로드에 들어가는 헤더를 만들어서 앞에 붙인 뒤 한꺼번에 암호화 한다.
        $buyBreakdownListExcel = "회사(공급받는자)|일자|사업자번호|상호|항목|품목명|금액||";
        $buyBreakdownListExcel .= "rec_sup_mutual|issue_date|sup_business_number|sup_mutual|item_name|item_name|total_amount||";
        $buyBreakdownListExcel .= $buyBreakdownListExcelTmp[0]."\n";

        // 암호화 한다
        $buyBreakdownListExcel = $this->customclass->encrypt($buyBreakdownListExcel);

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $purchaseBreakdownTotalSum = 0;
        $purchaseBreakdownTotalSum = $this->FinancialManagementModel->getPurchaseBreakdownListTotalSum($searchData);

        $purchaseBreakdownTotalPriceSum = number_format($purchaseBreakdownTotalSum[0]->sum_total_amount);
        $totalCnt = $purchaseBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/purchaseBreakdown/list/';
        $config['first_url']            = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows']           = $totalCnt; // 전체 리스트 갯수
        $config['per_page']             = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers']     = TRUE;
        $config['num_links']            = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE; 
        $config['reuse_query_string']   = TRUE;
        $config['cur_tag_open']         = '<strong>';
        $config['cur_tag_close']        = '</strong>';
        $config['uri_segment']          = 3; // 페이지 번호가 있는 세그먼트
        $config['use_page_numbers']     = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open']        = '<div class="paginate">';
        $config['full_tag_close']       = '</div>';
        $config['first_link']           = '<i class="prev-arrow-double"></i>';
        $config['last_link']            = '<i class="next-arrow-double"></i>';
        $config['prev_link']            = '<i class="prev-arrow"></i>';
        $config['next_link']            = '<i class="next-arrow"></i>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        // 페이징 처리E

        // 페이징에서 NO를 보여주기 위해서 전체 리스트 갯수에서 하나씩 빼서 보여준다. 검색된 데이터의 전체 수에서 해당 페이지의 첫번째 데이터의 순번을 빼서 보여준다.
        // 해당 페이지의 첫번쨰 열 계산
        $firstNo = $totalCnt - $per_page * ($page - 1);

        // 가져온 내용 customclass debug 출력  $this->customclass->debug($cardBreakdownList);
        // tr 태그로 만들어서 출력해보기
        $tr = '';
        if(!$purchaseBreakdownList){
            $tr .= "<tr>\n";
            $tr .= "    <td colspan='8'>데이터가 없습니다.</td>\n";
            $tr .= "</tr>\n";

            $buyBreakdownListExcel = "onclick=\"alert('데이터가 없거나 검색을 해주세요');\"";
        } else {
            $buyBreakdownListExcel = "href=\"/exceldown?param=".$buyBreakdownListExcel."\"";
            foreach($purchaseBreakdownList as $key => $value){
                $tr .= "<tr>\n";
                // 실제 검색된 데이터의 전체 개수에서 하나씩 빼서 no 값을 보여줌
                $tr .= "    <td no=\"".$value->no."\">".($firstNo - $key)."</td>\n";
                $tr .= "    <td>".$value->rec_sup_mutual."</td>\n";
                $tr .= "    <td>".$value->issue_date."</td>\n";
                $tr .= "    <td>".$value->sup_business_number."</td>\n";
                $tr .= "    <td>".$value->sup_mutual."</td>\n";
                $tr .= "    <td>".$value->item_purchase_cate2."</td>\n";
                $tr .= "    <td>".$value->item_name."</td>\n";
                if($value->tax_amount == 0){
                    $tr .= "    <td>계산서</td>\n";
                } else {
                    $tr .= "    <td>세금계산서</td>\n";
                }
                $tr .= "    <td>".number_format($value->total_amount)."</td>\n";
                $tr .= "</tr>\n";
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/financialManagement/purchase/breakdownlist', array(
                                            'FROMSINCEMONTH'=>$FROM_SINCE_MONTH_SELECT_BOX,
                                            'FROMSINCEYEAR'=>$FROM_SINCE_YEAR_SELECT_BOX,
                                            'BUYBREAKDOWNLISTEXCEL' => $buyBreakdownListExcel,
                                            'REC_SUP_BUSINESS_NUMBER_SELECT_BOX' => $REC_SUP_BUSINESS_NUMBER_SELECT_BOX,
                                            'SEARCH_DATA_SUP_BUSINESS_NUMBER' => $searchData['sup_business_number'],
                                            'SEARCH_DATA_SUP_MUTUAL' => $searchData['sup_mutual'],
                                            'BUYUPLOADHISTORYTABLE' => $tr,
                                            'BUYUPLOADHISTORYTOTALSUM' => $purchaseBreakdownTotalPriceSum,
                                            'PAGINATION' => $pagination,
                                        
                                        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of purchaseBreakdown

    // 카드사용내역 리스트
    public function cardBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        $menuNo = array(1,3,3);

        // get 방식으로 넘어온 데이터를 받는다.
        $searchData = array();
        $searchData['searchDateY'] = $this->input->get('searchDateY');
        $searchData['searchDateM'] = $this->input->get('searchDateM');
        $searchData['useType'] = $this->input->get('useType');
        $searchData['useHistory'] = $this->input->get('useHistory');

        // $FROM_SINCE_MONTH_SELECT_BOX
        $FROM_SINCE_MONTH_SELECT_BOX = "<option value='' selected>승인월 선택</option>\n";
        for($i = 1; $i <= 12; $i++){
            if($searchData['searchDateM'] == sprintf('%02d',$i)){
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."' selected>".sprintf('%02d',$i)."월"."</option>\n";
            } else {
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."'>".sprintf('%02d',$i)."월"."</option>\n";
            }
        }

        // FROM_SINCE_YEAR_SELECT_BOX
        $FROM_SINCE_YEAR_SELECT_BOX = "<option value='' selected>승인년 선택</option>\n";
        for($i = 2015; $i <= date('Y'); $i++){
            if($searchData['searchDateY'] == $i){
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."'>".$i."</option>\n";
            }
        }

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        $getCardUseCategoryList = $this->FinancialManagementModel->getCardUseCategoryList();
        
            
        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 카드사용 카테고리 가져오기 getCardUseCategoryList
        // 카드 사용 내역 가져오기
        
        $cardBreakdownListTmp = array();
        
        // 카드 사용 내역과 검색결과의 전체 리스트 갯수, 토탈 사용금액을 가져온다. GetCardUseHistoryList
        $cardBreakdownListTmp = $this->ErpBasicInfoModel->getCardUseHistoryList($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        $cardBreakdownList = $cardBreakdownListTmp;
        //쿼리 확인  
        //echo "<br><br>SQL : ".$this->db->last_query()."<br><br>";        
        
        // 쿼리를 변수에 담아서 엑셀 다운로드를 위해 사용한다. // "order by a.no desc" 를 기준으로 나눠서 앞의 쿼리만 가져온다.
        $cardBreakdownListExcelTmp = $this->db->last_query();
        $cardBreakdownListExcelTmp = explode(" LIMIT ",$cardBreakdownListExcelTmp);
        
        // 엑셀 다운로드에 들어가는 헤더를 만들어서 앞에 붙인 뒤 한꺼번에 암호화 한다.
        $cardBreakdownListExcel = "승인일|청구일|카드번호|소유자|분류|가맹점|승인번호|사용내역|청구원금||";
        $cardBreakdownListExcel .= "billing_day|approval_date|card_number|adminName|cate_name|franchise_name|approval_number|memo|total||";
        $cardBreakdownListExcel .= $cardBreakdownListExcelTmp[0]."\n";

        // 암호화 한다
        $cardBreakdownListExcel = $this->customclass->encrypt($cardBreakdownListExcel);

        // exit;
        //$totalCnt = $this->ErpBasicInfoModel->getCardUseHistoryListTotalCnt();
        //$totalCnt = $totalCnt[0]->total_cnt; 

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $cardBreakdownTotalSum = 0;
        $cardBreakdownTotalSum = $this->ErpBasicInfoModel->getCardUseHistoryListTotalSum($searchData);

        $cardBreakdownTotalPriceSum = number_format($cardBreakdownTotalSum[0]->sum_total);
        $totalCnt = $cardBreakdownTotalSum[0]->total_cnt; 
        
        // 가져온 데이터 디버깅 //
        // $this->customclass->debug($getCardUseCategoryList); 
        //쿼리 확인  echo "SQL : ".$this->db->last_query();        exit;
        // 검색결과의 전체 리스트 갯수를 가져온다. GetContractListTotalCnt

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/cardBreakdown/list/';
        $config['first_url']            = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows']           = $totalCnt; // 전체 리스트 갯수
        $config['per_page']             = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers']     = TRUE;
        $config['num_links']            = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE; 
        $config['reuse_query_string']   = TRUE;
        $config['cur_tag_open']         = '<strong>';
        $config['cur_tag_close']        = '</strong>';
        $config['uri_segment']          = 3; // 페이지 번호가 있는 세그먼트
        $config['use_page_numbers']     = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open']        = '<div class="paginate">';
        $config['full_tag_close']       = '</div>';
        $config['first_link']           = '<i class="prev-arrow-double"></i>';
        $config['last_link']            = '<i class="next-arrow-double"></i>';
        $config['prev_link']            = '<i class="prev-arrow"></i>';
        $config['next_link']            = '<i class="next-arrow"></i>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        // 페이징 처리E

        // 페이징에서 NO를 보여주기 위해서 전체 리스트 갯수에서 하나씩 빼서 보여준다. 검색된 데이터의 전체 수에서 해당 페이지의 첫번째 데이터의 순번을 빼서 보여준다.
        // 해당 페이지의 첫번쨰 열 계산
        $firstNo = $totalCnt - $per_page * ($page - 1);

        // $getCardUseCategoryList 로 select box의 option을 만든다.
        $CARDUSECATEGORYLISTOPTION = "<option value='' selected>분류 선택</option>\n";
        foreach($getCardUseCategoryList as $key => $value){
            $CARDUSECATEGORYLISTOPTION .= "                <option value='".$value->cate_code."'>".$value->cate_name."</option>\n";
        }

        $SEARCHDATACARDUSECATEGORYLISTOPTION = "<option value='' selected>분류 선택</option>\n";
        foreach($getCardUseCategoryList as $key => $value){
            $SEARCHDATACARDUSECATEGORYLISTOPTION .= "                <option value='".$value->cate_code."'";
            if($searchData['useType'] == $value->cate_code){
                $SEARCHDATACARDUSECATEGORYLISTOPTION .= " selected";
            }
            $SEARCHDATACARDUSECATEGORYLISTOPTION .= ">".$value->cate_name."</option>\n";
        }

        // 카드 사용 카테고리를 가져온다 getCardUseCategoryListOption()
        //$getCardUseCategoryList = $this->FinancialManagementModel->getCardUseCategoryListOption();
        //$getCardUseCategoryList 를 가지고 $arr_card_use_category 라는 배열을 생성
        /*
            $arr_card_use_category = array(
                '000' => '분류0',
                '001' => '분류1',
                '002' => '분류2',
                '003' => '분류3',
                '004' => '분류4',
            );
        */
        //$arr_card_use_category = array('000' => '-',);
        //foreach($getCardUseCategoryList as $key => $value){
        //    $arr_card_use_category[$value->cate_code] = $value->cate_name;            
        //}

        // 가져온 내용 customclass debug 출력  $this->customclass->debug($cardBreakdownList);
        // tr 태그로 만들어서 출력해보기
        $tr = '';
        if(!$cardBreakdownList){
            $tr .= "<tr class='openModalBtn'>\n";
            $tr .= "    <td colspan='10'>데이터가 없습니다.</td>\n";
            $tr .= "</tr>\n";

            $cardBreakdownListExcel = "onclick=\"alert('데이터가 없거나 검색을 해주세요');\"";
        } else {
            $cardBreakdownListExcel = "href=\"/exceldown?param=".$cardBreakdownListExcel."\"";
            foreach($cardBreakdownList as $key => $value){
                $tr .= "<tr class='openModalBtn'>\n";
                // 실제 검색된 데이터의 전체 개수에서 하나씩 빼서 no 값을 보여줌
                $tr .= "    <td no=\"".$value->no."\">".($firstNo - $key)."</td>\n";
                $tr .= "    <td class='hypen'>".$value->approval_date."</td>\n";
                $tr .= "    <td class='hypen'>".$value->billing_day."</td>\n";
                $tr .= "    <td class='word'>".$value->card_number."</td>\n";
                
                if($value->adminName){
                    //$tr .= "    <td>".$value->adminName."<br>(".$value->admin_id.")</td>\n";
                    $tr .= "    <td>".$value->adminName."</td>\n";
                } else {
                    $tr .= "    <td>미등록카드</td>\n";  // 
                }
                
                if(!$value->category){$value->category = '000';}
                if(!$value->cate_name){$value->cate_name = '-';}
                $tr .= "    <td id='useTypeDetailMatch".$value->no."' data='".$value->category."'>".$value->cate_name."</td>\n";
                $tr .= "    <td>".$value->franchise_name."</td>\n";
                $tr .= "    <td>".$value->approval_number."</td>\n";
                $tr .= "    <td id='useHistoryDetailMatch".$value->no."'>".$value->memo."</td>\n";
                $tr .= "    <td>".number_format($value->total)."</td>\n";
                $tr .= "</tr>\n";
            }
        }
        
        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/financialManagement/card/breakdownlist', array(
                                                                                            'FROMSINCEMONTH'=>$FROM_SINCE_MONTH_SELECT_BOX,
                                                                                            'FROMSINCEYEAR'=>$FROM_SINCE_YEAR_SELECT_BOX,
                                                                                            'SEARCHDATACARDUSECATEGORYLISTOPTION' => $SEARCHDATACARDUSECATEGORYLISTOPTION,
                                                                                            'CARDUSECATEGORYLISTOPTION' => $CARDUSECATEGORYLISTOPTION,
                                                                                            'PAGINATION' => $pagination,
                                                                                            'TR' => $tr,
                                                                                            'CARDBREAKDOWNTOTALSUM' => $cardBreakdownTotalPriceSum,
                                                                                            'CARDBREAKDOWNLISTEXCEL' => $cardBreakdownListExcel,
                                                                                            'USEHISTORY' => $searchData['useHistory'],));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of cardBreakdown


    // 보험사 1차 가공 업로드 내용 insuranceCompanyBreakdown
    public function insuranceCompanyBreakdownlist() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        $menuNo = array(1,4);

        // get 방식으로 넘어온 데이터를 받는다.
        $searchData = array();
        $searchData['searchDateM'] = "";
        $searchData['searchDateY'] = "";
        $searchData['account'] = $this->input->get('account');
        $searchData['division'] = $this->input->get('division'); // 구분
        $searchData['stay_duration'] = $this->input->get('stayDuration');  // 체류기간 
        $searchData['channel'] = $this->input->get('channel'); // 채널
        $searchData['insurance_company'] = $this->input->get('insuranceCompanyCategory'); // 보험사 선택

        // 보험사 카테고리 가져오기
        $getInsuranceCompanyCategoryList = $this->FinancialManagementModel->getInsuranceCompanyCategoryList();
        
        // 해당 데이터로 select option 만들기 
        $INSURANCECOMPANYCATEGORYLISTOPTION = "<option value='' selected>보험사 선택</option>\n";
        foreach($getInsuranceCompanyCategoryList as $key => $value){
            $INSURANCECOMPANYCATEGORYLISTOPTION .= "                <option value='".$value->catno."'";
            if($searchData['insurance_company'] == $value->catno){
                $INSURANCECOMPANYCATEGORYLISTOPTION .= " selected";
            }
            $INSURANCECOMPANYCATEGORYLISTOPTION .= ">".$value->catnm."</option>\n";
        }

        // 구분 (DIVISIONOPTION) 옵션만들기 [구분 D 국내/ O 해외  domestic / Overseas]
        $DIVISIONOPTIONARRAY = array(
            'D' => '국내',
            'O' => '해외',
        );
        $DIVISIONOPTION = "<option value='' selected>구분 선택</option>\n";
        foreach($DIVISIONOPTIONARRAY as $key => $value){
            $DIVISIONOPTION .= "                <option value='".$key."'";
            if($searchData['division'] == $key){
                $DIVISIONOPTION .= " selected";
            }
            $DIVISIONOPTION .= ">".$value."</option>\n";
        }

        // 가입채널 옵션만들기 
        $CHANNELOPTIONARRAY = array(
            'B2B' => 'B2B',            
            'B2B2C' => 'B2B2C',
            'B2C' => 'B2C',
        );
        $CHANNELOPTION = "<option value='' selected>채널 선택</option>\n";
        foreach($CHANNELOPTIONARRAY as $key => $value){
            $CHANNELOPTION .= "                <option value='".$key."'";
            if($searchData['channel'] == $key){
                $CHANNELOPTION .= " selected";
            }
            $CHANNELOPTION .= ">".$value."</option>\n";
        }
        
        // 체류 기간 옵션만들기 [ 체류기간 'L','S' 장기 long time / 단기 short-term ]
        $STAYDURATIONOPTIONARRAY = array(
            'L' => '장기',
            'S' => '단기',
        );
        $STAYDURATIONOPTION = "<option value='' selected>체류기간 선택</option>\n";
        foreach($STAYDURATIONOPTIONARRAY as $key => $value){
            $STAYDURATIONOPTION .= "                <option value='".$key."'";
            if($searchData['stay_duration'] == $key){
                $STAYDURATIONOPTION .= " selected";
            }
            $STAYDURATIONOPTION .= ">".$value."</option>\n";
        }

        // $FROM_SINCE_MONTH_SELECT_BOX
        $FROM_SINCE_MONTH_SELECT_BOX = "<option value='' selected>작성월 선택</option>\n";
        for($i = 1; $i <= 12; $i++){
            if($searchData['searchDateM'] == sprintf('%02d',$i)){
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."' selected>".sprintf('%02d',$i)."월"."</option>\n";
            } else {
                $FROM_SINCE_MONTH_SELECT_BOX .= "                <option value='".sprintf('%02d',$i)."'>".sprintf('%02d',$i)."월"."</option>\n";
            }
        }

        // FROM_SINCE_YEAR_SELECT_BOX
        $FROM_SINCE_YEAR_SELECT_BOX = "<option value='' selected>작성년도 선택</option>\n";
        for($i = 2015; $i <= date('Y'); $i++){
            if($searchData['searchDateY'] == $i){
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."' selected>".$i."</option>\n";
            } else {
                $FROM_SINCE_YEAR_SELECT_BOX .= "                <option value='".$i."'>".$i."</option>\n";
            }
        }

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;
        
        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;
        // 페이징 설정 E

        // 보험사 1차 가공 업로드 내용 가져오기
        $insuranceCompanyBreakdownListTmp = array();
        $insuranceCompanyBreakdownListTmp = $this->FinancialManagementModel->getInsuranceCompanyBreakdownList($searchData,$per_page,$offset); // $searchData, $per_page, $offset
        $insuranceCompanyBreakdownList = $insuranceCompanyBreakdownListTmp;
        //쿼리 확인   echo "<br><br>SQL : ".$this->db->last_query()."<br><br>";

        // 쿼리를 변수에 담아서 엑셀 다운로드를 위해 사용한다. // "order by a.no desc" 를 기준으로 나눠서 앞의 쿼리만 가져온다.
        $insuranceCompanyBreakdownListExcelTmp = $this->db->last_query();
        $insuranceCompanyBreakdownListExcelTmp = explode(" LIMIT ",$insuranceCompanyBreakdownListExcelTmp);

        // 엑셀 다운로드에 들어가는 헤더를 만들어서 앞에 붙인 뒤 한꺼번에 암호화 한다.
        $insuranceCompanyBreakdownListExcel = "청약일|보험사|거래처|상품명|구분|체류기간|수수료율|보험료|수수료|커미션|수익|채널||";
        $insuranceCompanyBreakdownListExcel .= "subscription_date|insurance_company|account|product_name|division|stay_duration|commission_rate|premium|charge|commission|revenue|channel||";
        $insuranceCompanyBreakdownListExcel .= $insuranceCompanyBreakdownListExcelTmp[0]."\n";

        // 암호화 한다
        $insuranceCompanyBreakdownListExcel = $this->customclass->encrypt($insuranceCompanyBreakdownListExcel);

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $insuranceCompanyBreakdownTotalSum = 0;
        $insuranceCompanyBreakdownTotalSum = $this->FinancialManagementModel->getInsuranceCompanyBreakdownListTotalSum($searchData);

        // 디버깅          $this->customclass->debug($insuranceCompanyBreakdownTotalSum);

        $insuranceCompanyBreakdownTotalPriceSum = number_format($insuranceCompanyBreakdownTotalSum[0]->sum_revenue);
        $totalCnt = $insuranceCompanyBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/insuranceCompanyBreakdown/list/';
        $config['first_url']            = $config['base_url'].'?'.http_build_query($_GET);
        $config['total_rows']           = $totalCnt; // 전체 리스트 갯수
        $config['per_page']             = $per_page; // 페이지당 보여줄 리스트 갯수
        $config['use_page_numbers']     = TRUE;
        $config['num_links']            = 2; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정 모두 보여주려면 $totalCnt
        $config['enable_query_strings'] = TRUE;
        $config['reuse_query_string']   = TRUE;
        $config['cur_tag_open']         = '<strong>';
        $config['cur_tag_close']        = '</strong>';
        $config['uri_segment']          = 3; // 페이지 번호가 있는 세그먼트
        $config['use_page_numbers']     = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open']        = '<div class="paginate">';
        $config['full_tag_close']       = '</div>';
        $config['first_link']           = '<i class="prev-arrow-double"></i>';
        $config['last_link']            = '<i class="next-arrow-double"></i>';
        $config['prev_link']            = '<i class="prev-arrow"></i>';
        $config['next_link']            = '<i class="next-arrow"></i>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        // 페이징 처리E
        
        // 페이징에서 NO를 보여주기 위해서 전체 리스트 갯수에서 하나씩 빼서 보여준다. 검색된 데이터의 전체 수에서 해당 페이지의 첫번째 데이터의 순번을 빼서 보여준다.
        // 해당 페이지의 첫번쨰 열 계산
        $firstNo = $totalCnt - $per_page * ($page - 1);

        // 가져온 내용 customclass debug 출력  $this->customclass->debug($insuranceCompanyBreakdownList);
        // tr 태그로 만들어서 출력해보기

        $enumArr = array(
            'O' => '해외',
            'D' => '국내',
            'L' => '장기',
            'S' => '단기'
        );

        $tr = '';
        if(!$insuranceCompanyBreakdownList){
            $tr .= "<tr>\n";
            $tr .= "    <td colspan='14'>데이터가 없습니다.</td>\n";
            $tr .= "</tr>\n";

            $insuranceCompanyBreakdownListExcel = "onclick=\"alert('데이터가 없거나 검색을 해주세요');\"";
        } else {
            $insuranceCompanyBreakdownListExcel = "href=\"/exceldown?param=".$insuranceCompanyBreakdownListExcel."\"";
            foreach($insuranceCompanyBreakdownList as $key => $value){
                $tr .= "<tr>\n";
                // 실제 검색된 데이터의 전체 개수에서 하나씩 빼서 no 값을 보여줌
                $tr .= "    <td no=\"".$value->no."\">".($firstNo - $key)."</td>\n";
                $tr .= "    <td>".$value->subscription_date."</td>\n";
                $tr .= "    <td>".$value->insurance_company."</td>\n";
                $tr .= "    <td>".$value->account."</td>\n";
                $tr .= "    <td>".$value->product_name."</td>\n";
                $tr .= "    <td>".$value->channel."</td>\n";
                $tr .= "    <td>".$enumArr[$value->division]."</td>\n";
                $tr .= "    <td>".$enumArr[$value->stay_duration]."</td>\n";
                $tr .= "    <td>".$value->commission_rate."%</td>\n";
                $tr .= "    <td>".number_format($value->premium)."</td>\n";
                $tr .= "    <td>".number_format($value->charge)."</td>\n";
                $tr .= "    <td>".number_format($value->commission)."</td>\n";                
                $tr .= "    <td>마감일자</td>\n";
                $tr .= "    <td>".number_format($value->revenue)."</td>\n";
                $tr .= "</tr>\n";
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/financialManagement/insurancecompany/breakdownlist', array(
                                                                                            'FROMSINCEMONTH'=>$FROM_SINCE_MONTH_SELECT_BOX,
                                                                                            'FROMSINCEYEAR'=>$FROM_SINCE_YEAR_SELECT_BOX,
                                                                                            'PAGINATION' => $pagination,
                                                                                            'TR' => $tr,
                                                                                            'INSURANCECOMPANYBREAKDOWNTOTALSUM' => $insuranceCompanyBreakdownTotalPriceSum,
                                                                                            'INSURANCECOMPANYBREAKDOWNLISTEXCEL' => $insuranceCompanyBreakdownListExcel,
                                                                                            'DIVISIONOPTION' => $DIVISIONOPTION,
                                                                                            'STAYDURATIONOPTION' => $STAYDURATIONOPTION,
                                                                                            'CHANNELOPTION' => $CHANNELOPTION,
                                                                                            'INSURANCECOMPANYCATEGORYLISTOPTION' => $INSURANCECOMPANYCATEGORYLISTOPTION,
                                                                                            'ACCOUNT' => $searchData['account'],    
                                                                                            ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of insuranceCompanyBreakdown
        






    // 카드사용내역 업데이트 ( 카드사용내역, 분류코드 수정 )
    public function cardUseHistoryUpdate() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // post 방식으로 넘어온 데이터를 받는다.
        $data = array();
        $data['no'] = $this->input->post('no');
        //$data['no'] = '222222222222222';
        $data['category'] = $this->input->post('useType');
        $data['memo'] = $this->input->post('useHistory');

        // 카드사용내역 업데이트
        $result = $this->FinancialManagementModel->cardUseHistoryUpdate($data);

        // 결과값이 있으면 성공, 없으면 실패 했다고 json으로 리턴한다.
        if($result){
            echo json_encode(array('result' => 'success'));
        } else {
            echo json_encode(array('result' => 'fail'));
        }
    } // end of cardUseHistoryUpdate





} // end of class