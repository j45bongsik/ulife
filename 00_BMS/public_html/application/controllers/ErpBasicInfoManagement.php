<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/third_party/PHPExcel/Classes/PHPExcel.php';
/**
 * 기초정보관리 컨트롤러
 * 
 * // 기초정보관리 컨트롤러 파일
 * // 3-1 법인카드 내역 업로드
 * // 3-2 매입 내역 업로드
 * // 3-3 매출 내역 업로드
 * // 3-4 거래처 정보
 * // 3-5 보험사 정보
 * // 3-6 보험상품 정보 
 * // 3-7 회원 정보
 */

class ErpBasicInfoManagement extends CI_Controller {

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
        $this->load->model('ErpBasicInfoModel');
        $this->load->model('ContractModel');
        $this->load->model('MemberModel');

        // third_party 에 있는 PHPExcel 라이브러리를 로드한다.
        $this->load->library('PHPExcel');

		@ini_set("allow_url_fopen", "1");

        // $URI = $_SERVER['REQUEST_URI'];
        // $this->customclass->CheckAgent($URI);

        // 서비스 탭을 가져온다.
        $this->serviceTab = $this->customclass->ServiceTab();


    } // end of __construct


    public function index() {
        $this->cardUploadBreakdownList();
    } // end of index


    // 법인카드 내역 업로드&리스트
    public function cardUploadBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(3,1);


        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $cardBreakdownTotalSum = 0;
        $cardBreakdownTotalSum = $this->ErpBasicInfoModel->GetExcelUploadCount('C');

        $totalCnt = $cardBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/purchaseUploadBreakdown/list/';
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

        // 매입 내역 업로드 히스토리를 가져온다 해당 테이블 t_excel_upload_history // type 필드 = 'C','S','B'  카드, 매입, 매출 'C:카드','B:매입','S:매출'
        // 페이지당 리스트 갯수와 오프셋을 넘겨준다.
        $cardUploadHistory = $this->ErpBasicInfoModel->getExcelUploadHistory('C', $per_page, $offset); 
        // 쿼리 확인 $this->customclass->debug($this->db->last_query());


        $cardUploadHistoryTable = "";
        if(count($cardUploadHistory) == 0) {
            $cardUploadHistoryTable = "<tr><td colspan='7'>데이터가 없습니다.</td></tr>";
        } else {
            foreach($cardUploadHistory as $key => $value) {
                $cardUploadHistoryTable .= "<tr>";
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->no."</a></td>";
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->code."</a></td>";                
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->reg_date."</a></td>";
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->use_year_month."</a></td>";
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->com_name."</a></td>";
                $cardUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".number_format($value->total)."</a></td>";
                $cardUploadHistoryTable .= "<td><button type=\"button\" class=\"btn lineDelete\" onclick=\"delHistory('C_{$value->no}')\">삭제</button></td>";
                $cardUploadHistoryTable .= "</tr>";
            }
        }


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/card/uploadBreakdown' , array(
                                                                        'CARDUPLOADHISTORYTABLE'=>$cardUploadHistoryTable,
                                                                        'PAGINATION' => $pagination,
                                                                    ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of cardUploadBreakdownList


    // 법인카드 내역 업로드 삭제 프로세스 (실제로 삭제하지 않고 삭제처리한다.) cardUploadBreakdownDelProc
    public function cardUploadBreakdownDelProc() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 넘어온 데이터 확인 $this->customclass->debug($this->input->post());

        // post 로 넘어온 데이터를 받는다.
        $data_tmp = $this->input->post('code'); //넘어온 변수는 타입과 프라이머리키 조합 ('타입_프라이머리키')
        $data = explode('_', $data_tmp);
        $type = $data[0];
        $seq = $data[1];

        // 해당 데이터 CustomClass debug 로 확인 // $this->customclass->debug($seq);

        // 데이터를 배열로 만든다.
        $data = array(
            'no' => $seq,
            'del_yn' => 'Y',
        );

        // 해당 데이터 CustomClass debug 로 확인 // $this->customclass->debug($data);

        // 데이터를 저장한다.
        // 데이터 저장전 데이터 확인을 위해 CustomClass debug 로 확인한다.        $this->customclass->debug($data);        exit;
        // t_excel_upload_history 테이블에서 해당 seq 의 del_yn 값을 'Y' 로 변경한다.
        
        $result = $this->ErpBasicInfoModel->excelUploadBreakdownDelProc($data['no']);
        
        $result2 = false;
        // 쿼리 확인 //    echo $this->db->last_query();

        // if $result 의 결과가 true 이면 
        // t_excel_upload_history.no 로 t_excel_upload_history.code 을 가져와서 erp_card_use_history.code 값이 동일한 데이터들의 del_yn 값을 'Y' 로 변경한다.
        if($result) {
            // 코드 값을 가져온다.
            $t_excel_upload_historyCode = $this->ErpBasicInfoModel->getExcelUploadHistoryCode($data['no']);
            // 쿼리 확인 echo $this->db->last_query();
            // 해당 데이터 CustomClass debug 로 확인 // $this->customclass->debug($t_excel_upload_historyCode);
            // $t_excel_upload_historyCode 로 erp_card_use_history 테이블에서 code 값이 동일한 데이터들의 del_yn 값을 'Y' 로 변경한다. 
            if($t_excel_upload_historyCode[0]->code){
                if($type == "C"){
                    $result2 = $this->ErpBasicInfoModel->cardUploadBreakdownDelProc($t_excel_upload_historyCode[0]->code);
                } else {
                    $result2 = $this->ErpBasicInfoModel->salesBuyUploadBreakdownDelProc($t_excel_upload_historyCode[0]->code);
                }
                //echo $this->db->last_query();
            } else {
                // 해당 데이터가 없으면 업데이트를 할 수 없다. 
                // 따라서 t_excel_upload_history 테이블의 no 값이 $data['no'] 인 del_yn 값을 'N' 로 변경한다.
                if($type == "C"){
                    $result = $this->ErpBasicInfoModel->cardUploadBreakdownDelRollBack($data['no']);
                } else {
                    $result = $this->ErpBasicInfoModel->salesBuyUploadBreakdownDelRollBack($data['no']);
                }
                //echo $this->db->last_query();
            }
        }

        // 해당 데이터 CustomClass debug 로 확인 // 
        //$this->customclass->debug($result);
        //$this->customclass->debug($result2);

        //exit;
        // 저장 되었다는 메세지 출력 후 리스트로 이동한다.
        if($result2) {
            echo "success";
        } else {
            echo "fail";
        }
    } // end of cardUploadBreakdownDelProc

    // 엑셀 데이터 업로드 내역 확인 cardUploadBreakdownCheck
    public function cardUploadBreakdownCheck() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // post 로 넘어온 데이터를 받는다.
        $type = $this->input->post('type');
        // $searchDateYM = $this->input->post('searchDateYM'); // 청구년월 // 202302 -> 2023-02 로 변경한다.
        // $searchDateYM = str_replace('-', '', $searchDateYM);
        // $searchDateYM = substr($searchDateYM, 0, 4)."-".substr($searchDateYM, 4, 2);
        $searchDateYM = $this->input->post('searchDateY')."-".$this->input->post('searchDateM'); // 청구년월 // 202302 -> 2023-02 로 변경한다.
        


        // t_excel_upload_history 테이블에서 해당 청구년월의 업로드 내역이 있는지 확인한다.
        $result = $this->ErpBasicInfoModel->getExcelUploadHistoryCheck($type, $searchDateYM);
        // 쿼리 확인 // echo $this->db->last_query();
        
        // 해당 데이터 CustomClass debug 로 확인 // 
        if($result) {
            echo "exist";
        } else {
            echo "not exist";
        }
        

    }

    // 엑셀 데이터 업로드 내역 확인 salesBuyUploadBreakdownCheck
    public function salesBuyUploadBreakdownCheck() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // post 로 넘어온 데이터를 받는다.
        $type = $this->input->post('type');
        // $searchDateYM = $this->input->post('searchDateYM'); // 청구년월 // 202302 -> 2023-02 로 변경한다.
        // $searchDateYM = str_replace('-', '', $searchDateYM);
        // $searchDateYM = substr($searchDateYM, 0, 4)."-".substr($searchDateYM, 4, 2);
        $searchDateYM = $this->input->post('searchDateY')."-".$this->input->post('searchDateM'); // 청구년월 // 202302 -> 2023-02 로 변경한다.


        // t_excel_upload_history 테이블에서 해당 청구년월의 업로드 내역이 있는지 확인한다.
        $result = $this->ErpBasicInfoModel->getExcelUploadHistoryCheck($type, $searchDateYM);
        // 쿼리 확인 // echo $this->db->last_query();
        
        // 해당 데이터 CustomClass debug 로 확인 // 
        if($result) {
            echo "exist";
        } else {
            echo "not exist";
        }
        

    }



    // 매입 내역 업로드&리스트
    public function purchaseUploadBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(3,2);

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $purchaseBreakdownTotalSum = 0;
        $purchaseBreakdownTotalSum = $this->ErpBasicInfoModel->GetExcelUploadCount('B');

        $totalCnt = $purchaseBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/purchaseUploadBreakdown/list/';
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

        // 매입 내역 업로드 히스토리를 가져온다 해당 테이블 t_excel_upload_history // type 필드 = 'C','S','B'  카드, 매입, 매출 'C:카드','B:매입','S:매출'
        // 페이지당 리스트 갯수와 오프셋을 넘겨준다.
        $purchaseUploadHistory = $this->ErpBasicInfoModel->getExcelUploadHistory('B', $per_page, $offset); 
        // 쿼리 확인 $this->customclass->debug($this->db->last_query());

        $buyUploadHistoryTable = "";
        if(count($purchaseUploadHistory) == 0) {
            $buyUploadHistoryTable = "<tr><td colspan='8'>데이터가 없습니다.</td></tr>";
        } else {
            foreach($purchaseUploadHistory as $key => $value) {
                $buyUploadHistoryTable .= "<tr>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$firstNo."</a></td>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->code."</a></td>";                
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->reg_date."</a></td>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->use_year_month."</a></td>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->com_name."</a></td>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".number_format($value->total)."</a></td>";
                $buyUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->tax_yn."</a></td>";
                $buyUploadHistoryTable .= "<td><button type=\"button\" class=\"btn lineDelete\" onclick=\"delHistory('B_{$value->no}')\">삭제</button></td>";
                $buyUploadHistoryTable .= "</tr>";
                $firstNo--;
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/purchase/uploadBreakdown' , array(
                'BUYUPLOADHISTORYTABLE'=>$buyUploadHistoryTable,
                'PAGINATION' => $pagination,

        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of purchaseUploadBreakdownList


    // 매출 내역 업로드&리스트
    public function salesUploadBreakdownList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(3,3);

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $salesBreakdownTotalSum = 0;
        $salesBreakdownTotalSum = $this->ErpBasicInfoModel->GetExcelUploadCount('S');

        $totalCnt = $salesBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/salesUploadBreakdown/list/';
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

        // 매출 내역 업로드 히스토리를 가져온다 해당 테이블 t_excel_upload_history // type 필드 = 'C','S','B'  카드, 매입, 매출 'C:카드','B:매입','S:매출'
        // 페이지당 리스트 갯수와 오프셋을 넘겨준다.
        $salesUploadHistory = $this->ErpBasicInfoModel->getExcelUploadHistory('S', $per_page, $offset); 
        // 쿼리 확인 $this->customclass->debug($this->db->last_query());

        $salesUploadHistoryTable = "";
        if(count($salesUploadHistory) == 0) {
            $salesUploadHistoryTable = "<tr><td colspan='8'>데이터가 없습니다.</td></tr>";
        } else {
            foreach($salesUploadHistory as $key => $value) {
                $salesUploadHistoryTable .= "<tr>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$firstNo."</a></td>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->code."</a></td>";                
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->reg_date."</a></td>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->use_year_month."</a></td>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->com_name."</a></td>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".number_format($value->total)."</a></td>";
                $salesUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->tax_yn."</a></td>";
                $salesUploadHistoryTable .= "<td><button type=\"button\" class=\"btn lineDelete\" onclick=\"delHistory('S_{$value->no}')\">삭제</button></td>";
                $salesUploadHistoryTable .= "</tr>";
                $firstNo--;
            }
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/sales/uploadBreakdown', array(
                            'SALESUPLOADHISTORYTABLE'=>$salesUploadHistoryTable,
                            'PAGINATION' => $pagination,
                        ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of salesUploadBreakdownList


    // 법인카드 정보
    public function cardInfoList() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다. 
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(3,8);

        // ErpBasicInfoModel 에 있는 카드 리스트를 가져온다.
        $cardList = $this->ErpBasicInfoModel->getCardList();
        // 마지막 쿼리 확인하기 
        // $this->customclass->debug($this->db->last_query());

        // 해당 데이터 CustomClass debug 로 확인         $this->customclass->debug($cardList);  // NO	카드사	카드번호	구분	사용자	상태	카드상태	메모
        // 해당 데이터로 테이블 만들기
        
        $cardListTable = "";
        $today_Y = date('Y');
        $today_M = date('m');

        foreach($cardList as $key => $value) {
            $cardListTable .= "<tr onclick=\"location.href='/cardInfoEdit/".$value->no."';\">";
            $cardListTable .= "<td>".$value->no."</td>";
            $cardListTable .= "<td>".$value->financial_name."</td>";
            $cardListTable .= "<td>".$value->cardNo."</td>";
            $cardListTable .= "<td>법인용 개인카드</td>";

            $cardListTable .= "<td>".$value->adminName;
            
            if($value->adminName && $value->admin_id) {
                $cardListTable .= "(".$value->admin_id.")</td>";
            } else {
                $cardListTable .= "</td>";
            }

            if($value->admin_id && $value->use_yn == 'Y') {
                $cardListTable .= "<td>사용</td>";
            } else {
                $cardListTable .= "<td>미사용</td>";
            }

            if($value->use_yn == 'Y') {
                $cardListTableTmp1 = "<div>사용</div>";
            } else {
                $cardListTableTmp1 = "<div>미사용</div>";
            }

            // 카드사용 년 월 기간으로 오늘 날짜의 년 월과 비교 하여 사용기간이 지난 카드인지 확인한다.
            
            if(!$value->card_year || !$value->card_month){
                $cardListTableTmp2 = "<div style=\"color:red\">카드유효기간없음</div>";
            } else {
                if("20".$value->card_year < $today_Y) {
                    $cardListTableTmp2 = "<div style=\"color:red\">카드유효기간만료</div>";
                } else if("20".$value->card_year == $today_Y) {
                    if(number($value->card_month) < number($today_M)) {
                        $cardListTableTmp2 = "<div style=\"color:red\">카드유효기간만료</div>";
                    } else {
                        $cardListTableTmp2 = "<div>카드유효기간정상</div>";
                    }
                } else {
                    $cardListTableTmp2 = "<div>카드유효기간정상</div>";
                }
            }

            $cardListTable .= "<td>".$cardListTableTmp1.$cardListTableTmp2."</td>";
            
            $cardListTable .= "<td>".$value->card_nicname."</td>";
            $cardListTable .= "</tr>";
        }
        $cardListTable .= "</tbody>";


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array(
                                                                    'menuNo'=>$menuNo, 
                                                                    'CARDLISTTABLE'=>$cardListTable, 
                                                                ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/card/info');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of cardInfoList


    // 법인카드 등록페이지 
    public function cardInfoReg() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,8);

        // ErpBasicInfoModel 에 있는 카드사 리스트를 가져온다.
        $cardCompanyList = $this->ErpBasicInfoModel->getCardCompanyList();

        // 해당 데이터 CustomClass debug 로 확인 // $this->customclass->debug($cardCompanyList);
        // 해당 데이터로 select box option 만들기
        $cardCompanyOptionSelectBox = "<select name='cardCompany' id='cardCompany' required>";
        $cardCompanyOptionSelectBox .= "<option value='' selected>카드사를 선택하세요.</option>";
        foreach($cardCompanyList as $key => $value) {
            $cardCompanyOptionSelectBox .= "<option value='".$value->code."'>".$value->financial_name."</option>";
        }
        $cardCompanyOptionSelectBox .= "</select>";

        // 부서 정보 가져오기
        $deptList = $this->MemberModel->GetDeptNoName2();
        
        // 중복 제거 후 select box 만들기
        $deptListSelectBox = "<select name='useDep ' id='useDep' required><option value='' selected>부서</option>";
        foreach($deptList as $key => $value) {
            $optionDeptCode = "";
            $optionDeptName = array();

            // 배열 중복 제거 
            $deptList[$key] = array_unique($deptList[$key]); // $this->customclass->debug($deptList[$key]);  // 해당 데이터 CustomClass debug 로 확인
            
            // $deptList[$key] 을 offset 이 0부터 시작하는 배열로 만든다.
            $deptList[$key] = array_values($deptList[$key]); // $this->customclass->debug($deptList[$key]);  // 해당 데이터 CustomClass debug 로 확인
            // 배열의 개수 확인 후 마지막 배열의 값이 부서코드이므로 부서코드를 가져온다.
            // 부서코드를 가져와서 부서코드를 select box option 으로 만든다.
            // 부서명은 배열의 처음 값부터 마지막 까지 가져와서 마케팅>여행자보험 이렇게 표시한다
            // $deptList[$key][count($deptList[$key])-1] 를 '||' 로 나누어서 뒤에 있는 부서코드만 가져온다.
            $optionDeptCode = explode('||', $deptList[$key][count($deptList[$key])-1]);
            // 해당 데이터 디버그로 확인            $this->customclass->debug($optionDeptCode[1]);
            $deptListSelectBox .= "<option value='".$optionDeptCode[1]."'>";

            for($i=0; $i<count($deptList[$key]); $i++) {
                // '||' 값을 기준으로 앞에는 부서명 뒤에는 부서코드가 있다.
                // option value 에는 마지막 배열의 부서코드를 넣고 option text 에는 부서명을 마케팅>여행자보험 이렇게 넣는다.
                $optionDeptNameTmp = explode('||', $deptList[$key][$i]);
                $optionDeptName = $optionDeptNameTmp[0];
                if($i == count($deptList[$key])-1) {
                    $deptListSelectBox .= $optionDeptName;
                } else {
                    $deptListSelectBox .= $optionDeptName . ">";
                }
            }
        }
        $deptListSelectBox .= "</select>";

        // 부서와 사용자 아이디와 이름을 가져온다.
        $memberList = $this->MemberModel->GetMemberList(); // admin_user.adminId, admin_user.adminName, admin_user.deptNo
        
        // 해당 데이터로 select box option 만들기
        $memberSelectBox = "<select name='useName' id='useName' data='' required><option value='' selected>이름(ID)</option>";
        foreach($memberList as $key => $value) {
            $memberSelectBox .= "<option value='".$value->adminId."' data='".$value->deptNo."'>".$value->adminName."(".$value->adminId.")</option>";
        }
        $memberSelectBox .= "</select>";

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array(
                                                                'menuNo'=>$menuNo, 
                                                                'CARDCOMPANYOPTIONSELECTBOX'=>$cardCompanyOptionSelectBox, 
                                                                'DEPTLISTSELECTBOX'=>$deptListSelectBox,
                                                                'MEMBERSELECTBOX'=>$memberSelectBox
                                                            ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/card/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of cardInfoReg


    // 법인카드 저장 프로세스 cardInfoRegProc
    public function cardInfoRegProc() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        //넘어온 데이터 확인 $this->customclass->debug($this->input->post());
        
        // post 로 넘어온 데이터를 받는다.
        $cardCompany = $this->input->post('cardCompany');
        $numberFirst = $this->input->post('numberFirst');
        $numberSecond = $this->input->post('numberSecond');
        $numberThird = $this->input->post('numberThird');
        $numberFourth = $this->input->post('numberFourth');
        $ValidM = $this->input->post('ValidM');
        $ValidY = $this->input->post('ValidY');
        $paymentDays = $this->input->post('paymentDays');
        $useDep = $this->input->post('useDep');
        $useName = $this->input->post('useName');
        $cardNicname = $this->input->post('memo');
        

        // 해당 데이터 CustomClass debug 로 확인 //
        // $this->customclass->debug($cardCompany);


        // $cardCompany, $numberFirst, $numberSecond, $numberThird, $numberFourth, $ValidM, $ValidY, $useName 값이 없으면 에러 메세지 출력 후 history.back() 한다.
        if($cardCompany == "" || $numberFirst == "" || $numberSecond == "" || $numberThird == "" || $numberFourth == "" || $ValidM == "" || $ValidY == "" || $useName == "") {
            echo "<script>alert('필수 입력값이 없습니다.'); history.back();</script>";
            exit;
        }


        // 데이터를 배열로 만든다.
        $data = array(
            'card_com' => $cardCompany,
            'cardNo' => $numberFirst.'-'.$numberSecond.'-'.$numberThird.'-'.$numberFourth,
            'admin_id' => $useName,
            'card_year' => $ValidY,
            'card_month' => $ValidM,
            'pay_day' => $paymentDays,            
            'card_nicname' => $cardNicname,
            'regdate' => date('Y-m-d H:i:s'),
            'reg_admin_id' => $this->session->userdata('CRM_ID'),
        );

        // 해당 데이터 CustomClass debug 로 확인 //
        // $this->customclass->debug($data);

        // 데이터를 저장한다.
        // 데이터 저장전 데이터 확인을 위해 CustomClass debug 로 확인한다.        $this->customclass->debug($data);        exit;
        $result = $this->ErpBasicInfoModel->cardInfoRegProc($data);

        // 해당 데이터 CustomClass debug 로 확인 // $this->customclass->debug($result);

        // 저장 되었다는 메세지 출력 후 리스트로 이동한다.
        if($result) {
            // 메세지 출력 후 cardinfo 페이지로 이동 한다. // costomclass 에 있는 AlertMsgMovePage 함수를 호출한다.
            $this->customclass->AlertMsgMovePage('저장되었습니다!', '/cardInfo');
        } else {
            $this->customclass->AlertMsgBackPage('저장에 실패하였습니다.');
        }
    } // end of cardInfoRegProc


    // 법인카드 수정페이지
    public function cardInfoEdit() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,8);

        // 두번째 인자값 으로 넘어온 seq 값(두번째 인자값) 을 받는다. // 두번째 인자는 없으면 '' 이다.
        // 만약 두번째 인자값이 없으면 에러 메세지 출력 후 history.back() 한다.
        if(!$this->uri->segment(2)) {
            // 메세지 출력 후 cardinfo 페이지로 이동 한다. // costomclass 에 있는 AlertMsgMovePage 함수를 호출한다.
            $this->customclass->AlertMsgMovePage('잘못된 접근입니다!', '/cardInfo');
            exit;
        }

        $seq = $this->uri->segment(2);

        // 법인 카드 정보 수정페이지
        // ErpBasicInfoModel 에 있는 카드 정보를 가져온다.
        $cardInfo = $this->ErpBasicInfoModel->GetCardInfo($seq);
        // 해당 데이터 CustomClass debug 로 확인            $this->customclass->debug($cardInfo);

        // 하나씩 변수 처리 한다. 프론트에서 편하게 사용하기 위해서
        $cardSeq = $cardInfo[0]->no;
        $cardNo = explode('-', $cardInfo[0]->cardNo);        
        $cardNoFirst = $cardNo[0];
        $cardNoSecond = $cardNo[1];
        $cardNoThird = $cardNo[2];
        $cardNoFourth = $cardNo[3];
        $cardCompany = $cardInfo[0]->card_com;
        $cardCompanyName = $cardInfo[0]->financial_name;
        $useName = $cardInfo[0]->admin_id;
        $useDep = $cardInfo[0]->deptNo;
        $useDepName = $cardInfo[0]->dept_name;
        $paymentDays = $cardInfo[0]->pay_day;
        $cardMemo = $cardInfo[0]->memo;
        $cardYear = $cardInfo[0]->card_year;
        $cardMonth = $cardInfo[0]->card_month;


        // 부서 정보 가져오기
        $deptList = $this->MemberModel->GetDeptNoName2();
        
        // 중복 제거 후 select box 만들기
        $deptListSelectBox = "<select name='useDep ' id='useDep' required><option value='' selected>부서</option>";
        foreach($deptList as $key => $value) {
            $optionDeptCode = "";
            $optionDeptName = array();

            // 배열 중복 제거 
            $deptList[$key] = array_unique($deptList[$key]); // $this->customclass->debug($deptList[$key]);  // 해당 데이터 CustomClass debug 로 확인
            
            // $deptList[$key] 을 offset 이 0부터 시작하는 배열로 만든다.
            $deptList[$key] = array_values($deptList[$key]); // $this->customclass->debug($deptList[$key]);  // 해당 데이터 CustomClass debug 로 확인
            // 배열의 개수 확인 후 마지막 배열의 값이 부서코드이므로 부서코드를 가져온다.
            // 부서코드를 가져와서 부서코드를 select box option 으로 만든다.
            // 부서명은 배열의 처음 값부터 마지막 까지 가져와서 마케팅>여행자보험 이렇게 표시한다
            // $deptList[$key][count($deptList[$key])-1] 를 '||' 로 나누어서 뒤에 있는 부서코드만 가져온다.
            $optionDeptCode = explode('||', $deptList[$key][count($deptList[$key])-1]);
            // 해당 데이터 디버그로 확인            $this->customclass->debug($optionDeptCode[1]);

            if($optionDeptCode[1] == $useDep){
                $deptListSelectBox .= "<option value='".$optionDeptCode[1]."' selected>";
            } else {
                $deptListSelectBox .= "<option value='".$optionDeptCode[1]."'>";
            }
            

            for($i=0; $i<count($deptList[$key]); $i++) {
                // '||' 값을 기준으로 앞에는 부서명 뒤에는 부서코드가 있다.
                // option value 에는 마지막 배열의 부서코드를 넣고 option text 에는 부서명을 마케팅>여행자보험 이렇게 넣는다.
                $optionDeptNameTmp = explode('||', $deptList[$key][$i]);
                $optionDeptName = $optionDeptNameTmp[0];
                if($i == count($deptList[$key])-1) {
                    $deptListSelectBox .= $optionDeptName;
                } else {
                    $deptListSelectBox .= $optionDeptName . ">";
                }
            }
        }
        $deptListSelectBox .= "</select>";

        // 부서와 사용자 아이디와 이름을 가져온다.
        $memberList = $this->MemberModel->GetMemberList(); // admin_user.adminId, admin_user.adminName, admin_user.deptNo
        
        // 해당 데이터로 select box option 만들기
        $memberSelectBox = "<select name='useName' id='useName' data='' required><option value='' selected>이름(ID)</option>";
        foreach($memberList as $key => $value) {
            if($useName == $value->adminId){
                $memberSelectBox .= "<option value='".$value->adminId."' data='".$value->deptNo."' selected>".$value->adminName."(".$value->adminId.")</option>";
            } else {
                $memberSelectBox .= "<option value='".$value->adminId."' data='".$value->deptNo."'>".$value->adminName."(".$value->adminId.")</option>";
            }
        }
        $memberSelectBox .= "</select>";

        // 결제일 select box 만들기
        $paymentDaysSelectBox = "<select name='paymentDays' id='paymentDays' required>";
        // 결제일은 1일~28일까지 선택 가능
        // $paymentDays 값이 없으면 "날짜를 선택하세요." 로 선택되게 한다.
        if($paymentDays == ""){
            $paymentDaysSelectBox .= "<option value='' selected>날짜를 선택하세요.</option>";
        } else {
            $paymentDaysSelectBox .= "<option value=''>날짜를 선택하세요.</option>";
        }
        for($i=1; $i<=28; $i++) {
            if($paymentDays == $i) {
                $paymentDaysSelectBox .= "<option value='".$i."' selected>".$i."</option>";
            } else {
                $paymentDaysSelectBox .= "<option value='".$i."'>".$i."</option>";
            }
        }
        $paymentDaysSelectBox .= "</select>";

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array(
                                                                'menuNo'=>$menuNo,
                                                                'CARDSEQ' => $cardSeq,
                                                                'CARDNO1'=>$cardNoFirst,
                                                                'CARDNO2'=>$cardNoSecond,
                                                                'CARDNO3'=>$cardNoThird,
                                                                'CARDNO4'=>$cardNoFourth,
                                                                'CARDCOMPANY'=>$cardCompany,
                                                                'CARDCOMPANYNAME'=>$cardCompanyName,
                                                                'USENAME'=>$useName,
                                                                'USEDEP'=>$useDep,
                                                                'USEDEPNAME'=>$useDepName,
                                                                'PAYMENTDAYS'=>$paymentDays,
                                                                'CARDMEMO'=>$cardMemo,
                                                                'CARDYEAR'=>$cardYear,
                                                                'CARDMONTH'=>$cardMonth,
                                                                'DEPTLISTSELECTBOX'=>$deptListSelectBox,
                                                                'MEMBERSELECTBOX'=>$memberSelectBox,
                                                                'PAYMENTDAYSSELECTBOX'=>$paymentDaysSelectBox
                                                            ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/card/mod');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of cardInfoEdit


    // 법인카드 수정 프로세스 cardInfoEditProc
    public function cardInfoEditProc() {
        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();
        
        // post 로 넘어온 데이터를 받는다.
        $data['no']                 = $this->input->post('seq');
        $data['card_month']         = $this->input->post('ValidM');
        $data['card_year']          = $this->input->post('ValidY');
        $data['pay_day']            = $this->input->post('paymentDays');
        $data['admin_id']           = $this->input->post('useName');
        $data['card_nicname']       = $this->input->post('memo');
        $data['update_admin_id']    = $_SESSION['CRM_ID']; // $this->session->userdata('CRM_ID') // 수정자 아이디

        // DB 에 저장 
        $result = $this->ErpBasicInfoModel->UpdateCardInfo($data);

        // 수정되었는지 확인
        if($result) {
            // 수정되었다는 메세지 출력 후 리스트로 이동한다.
            $this->customclass->AlertMsgMovePage('수정되었습니다.', '/cardInfo');
        } else {
            // 실패 하면 이전 페이지로 이동 한다.
            $this->customclass->AlertMsgBackPage('수정에 실패하였습니다.');
        }
    }


    // 회원정보 리스트
    public function erpMemberInfoList() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,7);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/member/list');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpMemberInfoList


    // 회원정보 등록
    public function erpMemberInfoReg() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,7);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/member/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpMemberInfoReg


    // 거래처정보 리스트
    public function erpCustomerInfoList() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,4);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/customer/list');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpCustomerInfoList


    // 거래처정보 등록
    public function erpCustomerInfoReg() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,4);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/customer/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpCustomerInfoReg

    
    // 보험사정보 리스트
    public function erpInsuranceCompanyInfoList() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,5);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/insurancecompany/list');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpInsuranceCompanyInfoList


    // 보험사정보 등록
    public function erpInsuranceCompanyInfoReg() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,5);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/insurancecompany/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpInsuranceCompanyInfoReg


    // 보험상품정보 리스트
    public function erpInsuranceProductInfoList() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,6);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/insuranceproduct/list');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpInsuranceProductInfoList


    // 카드 사용 내역 가져오기 


    // 보험상품정보 등록
    public function erpInsuranceProductInfoReg() {
        // 로그인 체크 CustomClass 클래스에서 login
        // CheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,6);

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/insuranceproduct/reg');
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of erpInsuranceProductInfoReg


    // 법인카드 내역 업로드 프로세스 cardUploadBreakdownRegProc
    public function cardUploadBreakdownRegProc() {
        //error_reporting( E_ALL );
        ini_set( "display_errors", 0 );

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 파일 업로드
        // 파일 확인 
        if($_FILES['inputUpload']['name'] == "") {
            echo "<script>alert('파일을 선택하세요.'); history.back();</script>";
            exit;
        }

        // post로 넘어온 데이터 확인         $this->customclass->debug($this->input->post());
        // 넘어온 파일 확인         $this->customclass->debug($_FILES['inputUpload']);

        // 파일 업로드 설정
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 0;
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;

        // 넘어온 파일이 type=="application/vnd.ms-excel" 또는 "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 이면 엑셀 파일 이다.
        // tmp_name 을 읽어 온다 

        // 엑셀 데이터를 읽어서 배열로 만든다.
        $excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['inputUpload']['tmp_name']);
        $excelObj = $excelReader->load($_FILES['inputUpload']['tmp_name']);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();

        $regdate = date('Y-m-d H:i:s');
        $regdatemd5 = md5($regdate);
        $startRow = 1;


        // 세번째 시트를 읽어서 배열로 만든다.
        //$excelReader2 = PHPExcel_IOFactory::createReaderForFile($_FILES['inputUpload']['tmp_name']);
        //$excelObj2 = $excelReader2->load($_FILES['inputUpload']['tmp_name']);
        //$worksheet2 = $excelObj2->getSheet(2);
        //$lastRow2 = $worksheet2->getHighestRow();

        //echo "lastRow : ". $lastRow;

        $lastcell = "";
        // 두번째 시트의 1번째 행이 '등록일' 인 데이터가 있는 열을 마지막 열로 한다.
        for ($col = 0; $col <= 100; $col++) {
            $cell = $worksheet->getCellByColumnAndRow($col, 1);
            $val = $cell->getValue();

            //echo "<br>" . $col . " : " . $val;

            if ($val == '가맹점전화번호') {
                $lastcell = $col;
                break;
            }
        }
        ?>

        <?
        /*
        <!DOCTYPE html>
        <html lang="ko">
        <head>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width">
        <title>임초딩 테스트 페이지</title>

        <!-- 부트스트랩 가져오기 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!-- 부트스트랩 테마 가져오기 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <!-- 부트스트랩 자바스크립트 가져오기 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        */
        ?>
        <?
        //echo "마지막 열은 " . $lastcell . " 입니다.<br>";
        /*
        청구일	승인일	부서번호	부서명	카드번호	이용자명	가맹점명	결제방법	승인금액	할인금액	청구원금	원금	수수료	합계	매입일	승인번호	과세유형	가맹점상태	가맹점번호	가맹점사업자번호	대표자성명	가맹점주소	가맹점전화번호
        */


        // 세번째 시트의 데이터를 가지고 테이블을 만든다.
        //echo "<table class='table table-bordered'>";

        $values = "";







        /*
        추후 추가 건 
        카드사용 내역시 카드 지급 받은날짜기준 사용자 id 추가 해서 사용 내역 테이블에 저장 필요 + 사용자 id 는 admin_user 테이블에서 가져온다.
        카드 담당자 변경된 최근 날짜를 
        */








        $yearNmonthFieldAddArr = array('청구일','승인일');
        $onlyNumberFieldArr = array('부서번호', '승인금액', '할인금액', '청구원금', '원금', '수수료');

        //for ($row = 1; $row <= 5; $row++) {    // 테스트용
        for ($row = 1; $row <= $lastRow; $row++) {    
            // 첫번째 행은 헤더로 사용한다. // 실제로 데이터가 아니라 테이블의 헤더로 사용한다.
            if ($row == 1) {
                /*
                //echo "<tr class='success'>";
                for ($col = 0; $col <= $lastcell; $col++) {
                    echo "<td>";
                    echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    echo "</td>";
                }
                echo "</tr>";
                */
                continue;
            } else {
                //echo "<tr>";
                $values .= "(";
                for ($col = 0; $col <= $lastcell; $col++) {
                    // echo "<td>";
                    // echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $worksheet->getCellByColumnAndRow($col, 1) 갑이 $yearNmonthFieldAddArr 에 포함되면 추가적으로 $worksheet->getCellByColumnAndRow($col, 1) 에서 년도와 월을 추가적으로 뽑아서 넣는다.
                    if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), $yearNmonthFieldAddArr)){
                        $values .= "'" . str_replace("'","",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                        $values .= "'" . str_replace("'","",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4)) . "',"; // 년도만
                        $values .= "'" . str_replace("'","",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 4, 2)) . "',"; // 월만
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), $onlyNumberFieldArr)){
                        // 숫자만 
                        $numbercode = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                        //$numbercode = preg_replace("/[^0-9]/", "", $numbercode);
                        $numbercode = preg_replace(",", "", $numbercode);
                        if(!$numbercode || $numbercode == '' || $numbercode == null){
                            $numbercode = 0;
                        }
                        $values .= "'" . str_replace("'","",$numbercode) . "',";
                    } else {
                        $values .= "'" . str_replace("'","",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                    }
                    //echo "</td>";
                }
                //echo "</tr>";
                $values = substr($values, 0, -1); // 마지막 콤마를 제거한다.
                $values .= ",'','','N','".$regdatemd5."', '".$regdate."'),";
                continue;
            }

            /*
            //echo "<tr>";
            // 엑셀 데이터를 읽어서 테이블로 만든다.
            $values .= "(";
            for ($col = 0; $col <= $lastcell; $col++) {
                echo $worksheet2->getCellByColumnAndRow($col, $row)->getValue();
                $values .= "'" . $worksheet2->getCellByColumnAndRow($col, $row)->getValue() . "',";
            }
            $values = substr($values, 0, -1); // 마지막 콤마를 제거한다.
            $values .= "),";
            echo "</tr>";
            */
        }

        if($values != ''){
            // 마지막 콤마를 제거한다.
            $values_insertsql_start = "
            insert into `erp_card_use_history` ( `billing_day`, `billing_year`, `billing_month`, `approval_date`, `use_year`, `use_month`, 
                `department_number`, `department_name`, `card_number`,
                `user_name`, `franchise_name`, `payment_method`, `approval_amount`, `discount_amount`,
                `billing_principal`, `principal`, `fee`, `total`, `purchase_date`, `approval_number`,
                `tax_type`, `franchise_status`, `franchise_number`, `franchise_business_number`, `representative_name`,
                `franchise_address`, `franchise_tel`, `category`, `memo`, `del_yn`, `code`, `regdate`
                ) values 
            ";
            $values = substr($values, 0, -1);
            // 맨마지막에 세미콜론을 붙인다.
            $values .= ";";
            $values = $values_insertsql_start . $values;
        }

        //echo "values : ".$values;
        // 디비에 저장한다.
        $re = $this->ErpBasicInfoModel->GetSqlData2($values);
        if($re){
            // 업로드 history 에 저장한다.
            $upload_history_data = array();
            $upload_history_data['code'] = $regdatemd5;
            $upload_history_data['type'] = "C"; // card
            $upload_history_data['total'] = $lastRow - $startRow;
            $upload_history_data['com_name'] = '국민카드';
            $upload_history_data['reg_date'] = $regdate;
            $upload_history_data['reg_admin'] = $_SESSION['CRM_ID']; // $this->session->userdata('CRM_ID') // 등록자 아이디
            // $this->input->post('searchDateYM'); // 202403 를  // 2024-03 으로 변경 하여서 use_year_month 에 저장한다.
            //$upload_history_data['use_year_month'] = substr($this->input->post('searchDateYM'), 0, 4) . "-" . substr($this->input->post('searchDateYM'), 4, 2);
            $upload_history_data['use_year_month'] = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');
            $re2 = $this->ErpBasicInfoModel->InsertUploadHistory($upload_history_data);

            echo "<script>alert('업로드 되었습니다.'); history.back();</script>";
        } else {
            echo "<script>alert('업로드에 실패하였습니다. \\n해당 파일을 개발담당자에게 전달 부탁드립니다.'); history.back();</script>";
        }

        /*
        // 업로드 데이터 베이스에 어떤종류(card, buy, sales), 언제, 누가,    저장한다 
                // post 로 넘어온 데이터를 받는다.
                $cardCompany = $this->input->post('cardCompany');
                $cardNo = $this->input->post('cardNo');
                $cardYear = $this->input->post('cardYear');
                $cardMonth = $this->input->post('cardMonth');
                $cardUseDate = $this->input->post('cardUseDate');
                $cardUseTime = $this->input->post('cardUseTime');
                $cardUsePlace = $this->input->post('cardUsePlace');
        */
    }


    // 보험사 1차 가공데이터 업로드 페이지 insuranceCompanyExcelUpload
    public function insuranceCompanyExcelUpload() {
        //error_reporting( E_ALL );
        ini_set( "display_errors", 0 );

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        $menuNo = array(3,9);

        // 페이지 번호가 있는 경우
        $page = $this->uri->segment(3);
        if($page == '' || $page < 1 ){ $page = 1; }
        $searchData['page'] = $page;

        // 페이징 설정 S
        $per_page = "10"; // 페이징 처리를 위한 페이지당 보여줄 리스트 갯수
        $offset = "0"; // 페이징 처리를 위한 오프셋
        $offset = ($page - 1) * $per_page;

        // 금액은 페이징 없이 검색 전체 금액을 가져와서 합산해서 보여준다. 그리고 숫자에 콤마를 찍어서 보여준다.
        $firstBreakdownTotalSum = 0;
        $firstBreakdownTotalSum = $this->ErpBasicInfoModel->GetExcelUploadCount('F');

        $totalCnt = $firstBreakdownTotalSum[0]->total_cnt;

        // 페이징 처리S
        $config = array();
        $config['base_url']             = '/purchaseUploadBreakdown/list/';
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

        // 매입 내역 업로드 히스토리를 가져온다 해당 테이블 t_excel_upload_history // type 필드 = 'C','S','B'  카드, 매입, 매출 'C:카드','B:매입','S:매출'
        // 페이지당 리스트 갯수와 오프셋을 넘겨준다.
        $excelUploadHistory = $this->ErpBasicInfoModel->getExcelUploadHistory('F', $per_page, $offset);
        // 쿼리 확인 $this->customclass->debug($this->db->last_query());
        
        
        $excelUploadHistoryTable = "";
        if(count($excelUploadHistory) == 0) {
            $excelUploadHistoryTable = "<tr><td colspan='5'>데이터가 없습니다.</td></tr>";
        } else {
            foreach($excelUploadHistory as $key => $value) {
                $excelUploadHistoryTable .= "<tr>";
                $excelUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->no."</a></td>";
                $excelUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->code."</a></td>";                
                $excelUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".$value->reg_date."</a></td>";
                $excelUploadHistoryTable .= "<td> <!-- <a></a> tag 사용 해서 카드사용내역으로 이동해서 해당내용으로만 검색된 결과 보이도록 추가 예정(청구일기준)--> ".number_format($value->total)."</a></td>";
                $excelUploadHistoryTable .= "<td><button type=\"button\" class=\"btn lineDelete\" onclick=\"delHistory('C_{$value->no}')\">삭제</button></td>";
                $excelUploadHistoryTable .= "</tr>";
            }
        }

        


        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/basicinfo/insurancecompany/exceluploadlist' , array(
                                                                                'EXCELUPLOADHISTORYTABLE'=>$excelUploadHistoryTable,
                                                                                'PAGINATION'=>$pagination,
                                                                            ));
        $this->load->view($this->serviceTab . '/inc/footer');
    } // end of insuranceCompanyExcelUpload

    // 보험사 1차 가공데이터 엑셀 업로드 프로세스 insuranceCompanyExcelUploadRegProc
    public function insuranceCompanyExcelUploadRegProc() {
        //error_reporting( E_ALL );
        ini_set( "display_errors", 0 );

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 파일 업로드
        // 파일 확인 
        if($_FILES['inputUpload']['name'] == "") {
            echo "<script>alert('파일을 선택하세요.'); history.back();</script>";
            exit;
        }

        // post로 넘어온 데이터 확인         $this->customclass->debug($this->input->post());
        // 넘어온 파일 확인         $this->customclass->debug($_FILES['inputUpload']);

        // 파일 업로드 설정
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 0;
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;

        // 넘어온 파일이 type=="application/vnd.ms-excel" 또는 "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 이면 엑셀 파일 이다.
        // tmp_name 을 읽어 온다 

        // 엑셀 데이터를 읽어서 배열로 만든다.
        $excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['inputUpload']['tmp_name']);
        $excelObj = $excelReader->load($_FILES['inputUpload']['tmp_name']);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();

        $regdate = date('Y-m-d H:i:s');
        $regdatemd5 = md5($regdate);
        $startRow = 1;

        $lastcell = "";
        // 두번째 시트의 1번째 행이 '등록일' 인 데이터가 있는 열을 마지막 열로 한다.
        for ($col = 1; $col <= 100; $col++) {
            $cell = $worksheet->getCellByColumnAndRow($col, 1);
            $val = $cell->getValue();
            if ($val == '증권번호') {
            //if ($val == '채널') {
                $lastcell = $col;
                break;
            }
        }
        $values = "";

        $yearNmonthFieldAddArr = array('청약일');
        $onlyNumberFieldArr = array('수수료율', '보험료', '수수료', '커미션', '수익');
        $changeFieldArr = array('구분', '체류기간');

        // 구분, 체류기간인 경우 enum 으로 처리한다. D, O / L, S 미리 배열로 만들어 놓는다 
        $enumArr = array(
            '해외' => 'O',
            '국내' => 'D',
            '장기' => 'L',
            '단기' => 'S'
        );

        // 보험사 명을 보험사 코드로 변경
        $insuranceCompanyArr = array(
            '삼성생명' => '001001',
            '한화생명' => '001002',
            '메리츠' => '002001',
            '메리츠화재' => '002001',
            'CHUBB' => '002002',
            'DB손해보험' => '002003',
            '삼성화재' => '002004',
            '현대해상' => '002005',
            '현대해상보험' => '002005',
            'AIG손해보험' => '002006',
            'KB손해보험' => '002007',
            '롯데손해보험' => '002008',
            'MG손해보험' => '002009',
            '한화손해보험' => '002010',
            '흥국화재' => '002011',
            '어시스트카드' => '002012'
        );

        // for ($row = 1; $row <= 5; $row++) {    // 테스트용
        for ($row = 1; $row <= $lastRow; $row++) {    
            // 첫번째 행은 헤더로 사용한다. // 실제로 데이터가 아니라 테이블의 헤더로 사용한다.
            if ($row == 1) {
                continue;
            } else {
                $values .= "('".$regdatemd5."', ";



                for ($col = 1; $col <= $lastcell; $col++) {
                    if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), $yearNmonthFieldAddArr)){                        
                        $values .= "'" . substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4) . "-"; // 년도만
                        $values .= "" . substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 5, 2) . "',"; // 월만
                        $values .= "'" . $worksheet->getCellByColumnAndRow($col, $row)->getValue() . "',";
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), $onlyNumberFieldArr)){
                        // 숫자만 
                        $numbercode = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $numbercode = preg_replace("/[^0-9-]/", "", $numbercode);
                        if(!$numbercode || $numbercode == '' || $numbercode == null){
                            $numbercode = 0;
                        }
                        $values .= "'" . $numbercode . "',";
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 1)->getValue(), $changeFieldArr)){
                        $values .= "'" . $enumArr[$worksheet->getCellByColumnAndRow($col, $row)->getValue()] . "',";
                    } else if( $worksheet->getCellByColumnAndRow($col, 1)->getValue() == '보험사'){
                        // 보험사 명을 보험사 코드로 변경
                        $values .= "'" . $insuranceCompanyArr[$worksheet->getCellByColumnAndRow($col, $row)->getValue()] . "',";
                    } else {
                        $values .= "'" . $worksheet->getCellByColumnAndRow($col, $row)->getValue() . "',";
                    }
                }
                $values = substr($values, 0, -1); // 마지막 콤마를 제거한다.
                $values .= ",'".$regdate."'),";
                continue;
            }
        }

        if($values != ''){
            // 마지막 콤마를 제거한다.
            $values_insertsql_start = "
            insert into `insurance_company_first_processed_data` ( 
                `code`, `use_year_month`, `subscription_date`, `insurance_company`, `account`, 
                `product_name`, `division`, `stay_duration`, `commission_rate`, `premium`, 
                `charge`, `commission`, `revenue`, `channel`, `product_number`, `regdate`
            ) values 
                ";
        }

        $values = substr($values, 0, -1);
        // 맨마지막에 세미콜론을 붙인다.
        $values .= ";";
        $values = $values_insertsql_start . $values;
        /*
        echo "<xmp>";
        echo "values : ".$values;
        echo "</xmp>";
        */
        // 디비에 저장한다.
        
        $re = $this->ErpBasicInfoModel->GetSqlData2($values);
        if($re){
            // 업로드 history 에 저장한다.
            $upload_history_data = array();
            $upload_history_data['code'] = $regdatemd5;
            $upload_history_data['type'] = "F"; // insurance
            $upload_history_data['total'] = $lastRow - $startRow;
            $upload_history_data['com_name'] = '보험사별1차가공데이터';
            $upload_history_data['reg_date'] = $regdate;
            $upload_history_data['reg_admin'] = $_SESSION['CRM_ID']; // $this->session->userdata('CRM_ID') // 등록자 아이디
            // $this->input->post('searchDateYM'); // 202403 를  // 2024-03 으로 변경 하여서 use_year_month 에 저장한다.
            // $upload_history_data['use_year_month'] = substr($this->input->post('searchDateYM'), 0, 4) . "-" . substr($this->input->post('searchDateYM'), 4, 2);
            $upload_history_data['use_year_month'] = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');
            $re2 = $this->ErpBasicInfoModel->InsertUploadHistory($upload_history_data);
            echo "<script>alert('업로드 되었습니다.'); history.back();</script>";
        } else {
            echo "<script>alert('업로드에 실패하였습니다. \\n해당 파일을 개발담당자에게 전달 부탁드립니다.'); history.back();</script>";
        }
        /*
        보험사 데이터 1차 가공 분 업로드 자료 테이블 

                CREATE TABLE `insurance_company_first_processed_data` (
        `no` int(11) NOT NULL,
        `code` varchar(35) NOT NULL DEFAULT '' COMMENT 't_excel_upload_history 테이블의 업로드코드',
        `use_year_month` varchar(7) NOT NULL DEFAULT '' COMMENT '엑셀파일에 들어간 청약일 년도와 월 ''YYYY-MM'' 부분',
        `subscription_date` date DEFAULT NULL COMMENT '청약일',
        `insurance_company` varchar(50) NOT NULL DEFAULT '' COMMENT '보험사',
        `account` varchar(200) NOT NULL DEFAULT '' COMMENT '거래처 (추후에 상황 보고 줄여야 함)',
        `product_number` varchar(50) NOT NULL DEFAULT '' COMMENT '보험상품번호',
        `product_name` varchar(100) NOT NULL DEFAULT '' COMMENT '상품명',
        `division` enum('D','O') NOT NULL DEFAULT 'D' COMMENT '구분 D 국내/ O 해외  domestic / Overseas',
        `stay_duration` enum('L','S') NOT NULL DEFAULT 'S' COMMENT '체류기간 ''L'',''S'' 장기 long time / 단기 short-term',
        `commission_rate` varchar(5) NOT NULL DEFAULT '' COMMENT '수수료율',
        `premium` int(11) NOT NULL DEFAULT 0 COMMENT '보험료',
        `charge` int(11) NOT NULL DEFAULT 0 COMMENT '수수료',
        `commission` int(11) NOT NULL DEFAULT 0 COMMENT '커미션',
        `revenue` int(10) unsigned zerofill NOT NULL DEFAULT 0000000000 COMMENT '수익',
        `channel` enum('B2B','B2B2C','B2C','M') NOT NULL DEFAULT 'B2B' COMMENT '채널 ''B2B'',''B2B2C'',''B2C'',''M'' ( M : 모바일 ) ',
        `del_yn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부 (Y 삭제 / N삭제 안함)',
        `regdate` datetime DEFAULT NULL COMMENT '등록일',
        PRIMARY KEY (`no`),
        KEY `code` (`code`),
        KEY `use_year_month` (`use_year_month`),
        KEY `insurance_company` (`insurance_company`),
        KEY `division` (`division`),
        KEY `stay_duration` (`stay_duration`),
        KEY `channel` (`channel`),
        KEY `account` (`account`),
        KEY `product_name` (`product_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='보험사 데이터 1차 가공 분 업로드 자료.'


        // 해당 테이블에서 다음과 같이 보험사별, 상품별, 해외 국내별, 장기 단기별 토탈보험료를 가져와서 보여준다.
        SELECT 
            b.catnm, a.insurance_company, a.product_name, a.division, a.stay_duration, SUM(premium) AS total_premium, a.product_number
        FROM 
            insurance_company_first_processed_data AS a 
            INNER JOIN insurance_company_category AS `b` ON a.insurance_company = b.catno
        WHERE 
            use_year_month = '2024-03'
        GROUP BY a.insurance_company, a.product_name, a.division, a.stay_duration, a.product_number


        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

        <html>
        <head>
            <title>insurance_company_first_processed_data</title>
            <meta name="GENERATOR" content="HeidiSQL 12.7.0.6850">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <style type="text/css">
            th, td {vertical-align: top;}
            table, td {border: 1px solid silver; padding: 2px;}
            table {border-collapse: collapse;}
            .col6 {text-align: right;}
            </style>
        </head>

        <body>

            <table caption="insurance_company_first_processed_data (13 rows)">
            <thead>
                <tr>
                <th class="col1">catnm</th>
                <th class="col2">insurance_company</th>
                <th class="col3">product_name</th>
                <th class="col4">division</th>
                <th class="col5">stay_duration</th>
                <th class="col6">total_premium</th>
                <th class="col7">product_number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="col1">메리츠화재</td>
                <td class="col2">002001</td>
                <td class="col3">국내여행보험Ⅱ</td>
                <td class="col4">D</td>
                <td class="col5">S</td>
                <td class="col6">12021510</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">메리츠화재</td>
                <td class="col2">002001</td>
                <td class="col3">전문직해외장기체류보험</td>
                <td class="col4">O</td>
                <td class="col5">L</td>
                <td class="col6">1335550</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">메리츠화재</td>
                <td class="col2">002001</td>
                <td class="col3">해외여행 실손의료비보험</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">69362280</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">메리츠화재</td>
                <td class="col2">002001</td>
                <td class="col3">해외장기체류보험</td>
                <td class="col4">O</td>
                <td class="col5">L</td>
                <td class="col6">632420</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">CHUBB</td>
                <td class="col2">002002</td>
                <td class="col3">Chubb 국내여행보험</td>
                <td class="col4">D</td>
                <td class="col5">S</td>
                <td class="col6">54032640</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">CHUBB</td>
                <td class="col2">002002</td>
                <td class="col3">Chubb 멀티해외여행보험</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">218850</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">CHUBB</td>
                <td class="col2">002002</td>
                <td class="col3">Chubb 해외여행보험</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">227162394</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">DB손해보험</td>
                <td class="col2">002003</td>
                <td class="col3">프로미 해외여행보험II</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">7183410</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">삼성화재</td>
                <td class="col2">002004</td>
                <td class="col3">삼성화재 국내여행보험</td>
                <td class="col4">D</td>
                <td class="col5">S</td>
                <td class="col6">691840</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">삼성화재</td>
                <td class="col2">002004</td>
                <td class="col3">삼성화재 해외여행보험</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">23978270</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">현대해상</td>
                <td class="col2">002005</td>
                <td class="col3">현대장기</td>
                <td class="col4">O</td>
                <td class="col5">L</td>
                <td class="col6">9333800</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">MG손해보험</td>
                <td class="col2">002009</td>
                <td class="col3">MG 해외여행보험</td>
                <td class="col4">O</td>
                <td class="col5">S</td>
                <td class="col6">8443277</td>
                <td class="col7"></td>
                </tr>
                <tr>
                <td class="col1">한화손해보험</td>
                <td class="col2">002010</td>
                <td class="col3">한화장기</td>
                <td class="col4">O</td>
                <td class="col5">L</td>
                <td class="col6">5649720</td>
                <td class="col7"></td>
                </tr>
            </tbody>
            </table>

            <p>
            <em>generated 2024-05-31 09:15:09      by <a href="https://www.heidisql.com/">HeidiSQL 12.7.0.6850</a></em>
            </p>

        </body>
        </html>




        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.6억이 넘는 경우 보험사 수수료가 45%를(30%+15%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.2억 초과 1.6억 이하 인경우 보험사 수수료가 44%를(30%+14%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 8천만 초과 1.2억 이하 인경우 보험사 수수료가 43%를(30%+13%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 6천만 초과 8천만 이하 인경우 보험사 수수료가 42%를(30%+12%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 4천만 초과 6천만 이하 인경우 보험사 수수료가 41%를(30%+11%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 2천만 초과 4천만 이하 인경우 보험사 수수료가 40%를(30%+10%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 1.5천만 초과 2천만 이하 인경우 보험사 수수료가 39%를(30%+9%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 800만 초과 1.5천만 이하 인경우 보험사 수수료가 38%를(30%+8%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 초과 800만 이하 인경우 보험사 수수료가 37%를(30%+7%) 곱해서 수수료를 계산한다.
        // 보험사가 CHUBB 인 경우 국내 국외 보험료를 합해서 500만 이하 인경우 보험사 수수료가 36%를(30%+6%) 곱해서 수수료를 계산한다.

        // 보험사가 메리츠화재 인경우 '해외장기체류보험(15680)' 인경우 기본 25% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '전문직해외장기체류보험(15780)' 인경우 기본 24.5% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '해외단기체류보험(15880)[팜투어,허니문]' 인경우 기본 30% 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '해외실손의료보험(15540)' 인경우 기본 45% 수수료 + 5% 시책을 적용 해서 총 50% 를 적용한다.
        //                                               -- 보험료가 2000만원 미만인 경우 50% (45+5) 수수료를 적용한다.
        //                                               -- 보험료가 2000만원 이상이면서 1억원 미만인경우 53% (48+5) 수수료를 적용한다.
        //                                               -- 보험료가 1억원 이상인경우 55% (50+5) 수수료를 적용한다.
        // 보험사가 메리츠화재 인경우 '국내여행보험(15920)' 인경우 기본 40% 수수료 + 5% 시책을 적용한다.
        //                                               -- 보험료가 1000만원 미만인 경우 45% (40+5) 수수료를 적용한다.
        //                                               -- 보험료가 1000만원 이상이면서 2000만원 미만인경우 47% (42+5) 수수료를 적용한다.
        //                                               -- 보험료가 2000만원 이상이면서 3000만원 미만인경우 49% (44+5) 수수료를 적용한다.
        //                                               -- 보험료가 3000만원 이상이면서 4000만원 미만인경우 51% (46+5) 수수료를 적용한다.
        //                                               -- 보험료가 4000만원 이상이면서 5000만원 미만인경우 53% (48+5) 수수료를 적용한다.
        //                                               -- 보험료가 5000만원 이상인경우 55% (50+5) 수수료를 적용한다.
        // 이와 별도로 성과급이 주어지는 케이스는 다음과 같다.
        // 해외실손의료보험(15540)와 전문직해외장기체류보험(15780) 를 제외한 
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 100만원 이상인 경우 합산금액 * 1.5% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 300만원 이상인 경우 합산금액 * 2.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 500만원 이상인 경우 합산금액 * 2.50% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 1000만원 이상인 경우 합산금액 * 3.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 5000만원 이상인 경우 합산금액 * 4.00% 를 성과급으로 준다.
        // 해외장기체류보험(15680) 와 해외단기체류보험(15880) 와 국내여행보험(15920) 의 보험료 합산 금액이 10000만원 이상인 경우 합산금액 * 4.50% 를 성과급으로 준다.

        // MG는 국내는 없음 해외 패키지만 있음
        // MG는 해외기본 단기 30% 수수료
        // MG는 해외성과 단기 1백만원 이상 2.0% 성과급
        // MG는 해외성과 단기 5백만원 이상 2.5% 성과급
        // MG는 해외성과 단기 1천만원 이상 3.0% 성과급
        // MG는 해외성과 단기 2천만원 이상 3.5% 성과급
        // MG는 해외성과 단기 4천만원 이상 4.0% 성과급
        // MG는 해외성과 단기 7천만원 이상 4.5% 성과급
        // MG는 해외성과 단기 1억원 이상 5.0% 성과급

        // DB는 국내기본 단기 20% 수수료
        // DB는 해외기본 단기 10% 수수료
        // DB는 해외기본 장기 22% 수수료
        // DB는 국내해외성과 단기 3백만원 초과 1.0% 성과급
        // DB는 국내해외성과 단기 5백만원 초과 2.0% 성과급
        // DB는 국내해외성과 단기 1천만원 초과 2.5% 성과급
        // DB는 국내해외성과 단기 2천만원 초과 3.0% 성과급
        // DB는 국내해외성과 단기 3천만원 초과 3.5% 성과급
        // DB는 국내해외성과 단기 5천만원 초과 4.0% 성과급
        // DB는 국내해외성과 단기 1억 이상 4.5% 성과급

        // 삼성화재는 국내기본 단기 24% 수수료
        // 삼성화재는 해외기본 단기 5% 수수료
        // 삼성화재는 해외성과 단기 3백만원 이상 2% 성과급
        // 삼성화재는 해외성과 단기 5백만원 이상 2.5% 성과급
        // 삼성화재는 해외성과 단기 1천만원 이상 3% 성과급
        // 삼성화재는 해외성과 단기 3천만원 이상 4% 성과급
        // 삼성화재는 해외성과 단기 5천만원 이상 4.5% 성과급
        // 삼성화재는 해외성과 단기 1억원 이상 5% 성과급 시책한도는 1천만원 ( 1억원 이상인 경우 1천만원까지만 성과급을 준다.)

        // 현대는 국내기본 단기 10% 수수료
        // 현대는 해외기본 단기 30% 수수료
        // 현대는 해외기본 장기 30% 수수료
        // 현대는 해외기본 장기단체 28% 수수료

        // 한화는 국내기본 단기 24% 수수료
        // 한화는 해외기본 단기 30% 수수료
        // 한화는 해외기본 장기 30% 수수료
        // 한화는 해외기본 장기단체상품이 없음

        // 어시스트카드는 국내기본 단기 수수료가 없음
        // 어시스트카드는 해외기본 단기 20% 수수료
        // 어시스트카드는 해외기본 장기 20% 수수료
        // 어시스트카드는 해외기본 장기단체상품이 없음

        */ 

    } // end of insuranceCompanyExcelUploadRegProc

    // 엑셀 파일 다운로드 excelDown()
    /**
     *  get 방식으로 엑셀상단에서 사용할 필드명 예 : "NO|승인일|청구일|카드번호|소유자|분류|가맹점|승인번호|사용내역|청구원금"  과 
     *  SQL 문에서 가져올 필드명 "billing_day|approval_date|card_number|adminName|cate_name|franchise_name|approval_number|memo|billing_principal" 과
     *  SQL 문 "select card_use_date, card_approval_date, card_no, from ..... 어쩌구 저쩌구 ... WHERE 1=1;" 를 "||" 로 묶어서 
     *  암호화 하여 get 방식으로 넘긴다.
     *  => $test = "NO|승인일|청구일|카드번호||billing_day|approval_date|card_number||select card_use_date, card_approval_date, card_no, from ..... 어쩌구 저쩌구 ... WHERE 1=1 order by 1 desc" ;
     *  $test = $this->customclass->encrypt($test);
     *  프론트에서 
     *  <a href="/exceldown?param=bXZvSkRyMFpUZ3llUmpwY1p5T2tyWHNWc01ZelZKYXRWRzk0bUUvMWx3eWZDZmd0dTBUblRzWTlEdjZKTHlzRGJTNnliVXBWQjVKVHZnM3YwbC9KeURLbGtQWGQ4aEg5T2RPRW8wZnJ0QXpROHk5NFNXMTBNcldpaW9yZ0taR0pBWFNneHRWZ096SVhQalZFVUptbW1ueFJjeVFVY0JtbExPcGlyNUhGZlhRb0pLNTh0d3ZwdlRUSlNncDY4a0l6d2w1SjZZS0tFK0dmbGlvb05tdGhvMDJmbWt4RmFodHIvKzEyUW9ra1hxSExiQjJVeVNaL2JZbWxQOVRBbUdpWVRRa2VlUG9BYnovR052OW1SN2pGM1VwbXJrSFFOc2N3QzYwSTYrZGpFQ0tkTlpWUFpDYnVJN2hUdWZ4TitaYThQQWpuVWtyVkd5eUdOcU4rZnVKRjBaNVlmZTVXRno5VGlueFAzMCtjZEQxbDZRdVlidkRGUTBlMGZkeHBwU3VvMU5aT1RWUVZDVnFRZXNoL1dNcU1lS2Z0SHFKNE5OSU9mV2lKR2VjMHBVN3JQQS90S3l3UExPRmh6YzNwZW03Y0FEOEdYRDZtdEllbXZiT21Wd2k5c3BoMGx0S3ZZa1BFejRrTEt2aURzTEs4YXcrYUdxSUI3QWQxL3NhdlMzd0V0Z3AzTWhac09BWEtBdytxZmZ5OEJGdEVUNFN2dFBRKzRjdVVFeVNSbnFFVlpuZHRmZStQK2t0cDZ3L1VDVDhyZkRkMEg4cSt4allJTGFPQUhsTkRmbTA2SjE4Wk9QRGx3ZlR0MWFuWHU3eWxhbVBKMnNJWEQ0VlBBQ0FwUVdBVERuYk1GM25GbXdEcHZ3TE9IVDFrbFVnMWdwaURiMTQ3RVRHSmVRMkZYN09GbVpVb1NTeDFkcHZyNkI3cTVORDFkRSt2dXFwSWZxUnkrZkpMTzNnaEo4a1VjR05HK2l4RDR6emZwU2hKNW5WRms0dFNMQS91aVJ5M3Fqd1UvMFdnbXo1dDFGTnRjYTJyNk81Wis2Qnd3ZWN0dklUb3ZVQ1RDS2hhdEhIZ3FFd0pWQ3BCcDgxZUVOblRDOXNNS281NjJkTlVrQ0VxNU12U2g1QUdQMVF5OHRtVDBuUzREMzhTd2VpR2cxUzJCMWVOMnVUMWJaUGpsNWtEQy9TZ1JRSVNMY0lQbWFiaGUwT2FzZTFZbnVGNzZrMWsvWDFYZ2hUeUNWWThUazhCaFAxbUF5UWVObDRha0wxMHFhZDdqMVpBUXVHQ0YxN0NESEJlVUs2M253eGVORWhmTDJxdHVqS05pQTNiR2E1MjNkdmxEd1VKYkR5bjloSVdLdkdBdlpSSjRKbzE3ZlE5UjhTdjR6T2x4dmVkMSswV1hKV3NVVEpoeGFudXdGUFN3SGpRdSs5N1dGdmMzaXdFcnlWcEt3TG0rMklodVlxK1p6NDJieU9OR0N2V1lJR2Z0Y3NrZlR2T1QySFMvcm5KMVBJUktqZC9hY0duNVh4WmFVRkVIZEpwZVdMenV4bWlkakR5ckZUZWdXVEZnZVNMRUxMQ05YQ1dtVGg3eDVobk0wWFhZdHZmRFJkalpLaWpORE81RWw1WGVIcnZ5SmVpSUw2SEYwajREZmJNU3VvRXlKdGFPUVZOZVNXY3BNYUZQS3JBN1ZSNnFLdFV1eG1iVzMvQys2bWtXdmU1UGpQVTFtNGhRd21lNVNiL0xYVVJIZGFIKzF2UzZIZTJqbkZ3L0FRS0FKV3RSaDVJdVdIaUtGWFpnUmtWdHU0VWhJR3VUdnFpUjVYZzd5RU5OWEJwOUp4bHEvWGg1ZEc2WW1OK2dUTmR5aVBodEkwWUFmM1NtWFBFd2t6OFhSMnJUT2dsZFhhSmUyUmZEQ1JEWUhsNUZxbUQ3R2NVQUU1MTA5MThlNjJTV2EzcnFZYU1zdXdCdVd5cllxRjJtT21vZFBZdzNEdURIYmtsK3FLT3BVWW40a3k1MHVieHp3aGN6RGZkMEhwSHg2UFNpMVU3cGJLekpLSzV3Z1dJQ3Y0aVBsZDRRNm00WmVseE5lbnpLL09vOFY1UVZDckZiOEwzM2JjY3FnV2NmZXhvaEl5M2I1WGp3VGU4cEUrZ2hVMjBub0pRWi8vcnhET29tREpGR1BFVVNIZEhGMDJpZG94SnFrNmRVd3BLbmJ3NlZKci9IcjM0YjBZNU5yRDdObExJUEU2ZE5EQmVReVd2ekpXM0RSQjhPQ0Q4RHF1RTVlaU0yT1E3RGpzNFhYbzNPZDBuWDJ2SjhsNUo2NGVpdFNiM1hCdURUc0orcll3ZWkwQ3p3S3lnTmFlandYZ3FNemRWYTlhdlpVQT0" class="btn file" target="_blank">엑셀다운</a>
     */
    public function excelDown() {  
        
        // 메모리 해제
        ini_set('memory_limit', '-1');


        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        //$this->customclass->loginCheckNGoLoginpage();
        // 넘어온 데이터 확인 $this->customclass->debug($this->input->get());
        // 넘어온 데이터를 받는다.
        $param = $this->input->get('param');

        // 넘어온 데이터의 암호화를 해제한다.
        $param = $this->customclass->decrypt($param); // 넘어온 데이터 확인 $this->customclass->debug($param);

        // $param 을 배열로 만든다. || 으로 나눠서 배열로 만든다.
        $paramArr = explode('||', $param);

        // $paramArr[0] 은 엑셀로 만들 데이터의 헤더이다.  // NO|승인일|청구일|카드번호|소유자|분류|가맹점|승인번호|사용내역|청구원금 
        // $paramArr[1] 은 엑셀로 만들 데이터의 SQL문이다. // select no, card_use_date, card_approval_date, card_no, card_owner, card_class, card_place from ..... 어쩌구 저쩌구 ... WHERE 1=1;
        // $paramArr[0] 을 배열로 만든다. | 으로 나눠서 배열로 만든다.
        // 엑셀에 들어갈 헤더를 배열로 만든다.
        $excel1RowTitle = explode('|', $paramArr[0]);

        // 엑셀에 들어갈 내용의 SQL 문에서 가져올 필드를 배열로 만든다. 추후 해당 필드에 없는 데이터는 엑셀 생성시 제외된다.
        $paramArr1 = explode('|', $paramArr[1]);

        //실행시킬 SQL문
        $sql = $paramArr[2];

        // 모델에 SQL 을 전달 해서 데이터를 가져온다.
        $resulttmp = $this->ErpBasicInfoModel->GetSqlData($sql);
        $result = json_decode(json_encode($resulttmp), true);

        //var_dump($result);

        // 날짜와 시간으로 엑셀파일 제목을 만든다.
        $filename = date('YmdHis').'.xls';

        // 엑셀 다운로드 처리
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($filename);

        // 엑셀 헤더 설정
        // $excel1RowTitle 을 반복문으로 돌려서 엑셀 헤더를 만든다. 형식은 다음과 같다.
        /*
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '승인일');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '청구일'); .....
        */
        
        for($i=0; $i<count($excel1RowTitle); $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue($this->customclass->getExcelColumn($i).'1', $excel1RowTitle[$i]);
        }

        // 날짜 형식으로 쓸 필드를 배열로 만든다.
        $date_type = array('billing_day','approval_date');

        // 화폐 형식으로 쓸 필드를 배열로 만든다.
        $currency_type = array('total');

        $row = 2;
        foreach($result as $key => $val){
            for($i=0; $i<count($paramArr1); $i++) {
                // 만약 화폐 형식 필드에 포함이면 화폐 형식으로 쓴다. // 화폐인 경우는 오른쪽 정렬이 되어야 한다.
                if(in_array($paramArr1[$i], $currency_type)) {
                    $objPHPExcel->getActiveSheet()->getStyle($this->customclass->getExcelColumn($i).$row)->getNumberFormat()->setFormatCode('#,##0');
                    $objPHPExcel->getActiveSheet()->getStyle($this->customclass->getExcelColumn($i).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet()->setCellValue($this->customclass->getExcelColumn($i).$row, $val[$paramArr1[$i]]);
                    
                } else {
                    // 날짜 형식 필드에 포함이면 날짜 형식으로 쓴다.
                    if(in_array($paramArr1[$i], $date_type)) {
                        $objPHPExcel->getActiveSheet()->setCellValue($this->customclass->getExcelColumn($i).$row, date('Y-m-d', strtotime($val[$paramArr1[$i]])));
                    } else {
                        $objPHPExcel->getActiveSheet()->setCellValue($this->customclass->getExcelColumn($i).$row, $val[$paramArr1[$i]]);
                    }
                }
            }
            $row++;
        }
        //exit;
        // 엑셀 다운로드 처리

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }


    // 매입 내역 엑셀 업로드 프로세스 purchaseUploadBreakdownRegProc
    public function purchaseUploadBreakdownRegProc() {
        //error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 파일 업로드
        // 파일 확인 
        if($_FILES['inputUpload']['name'] == "") {
            echo "<script>alert('파일을 선택하세요.'); history.back();</script>";
            exit;
        }

        // post로 넘어온 데이터 확인         $this->customclass->debug($this->input->post());
        // 넘어온 파일 확인         $this->customclass->debug($_FILES['inputUpload']);

        // 파일 업로드 설정
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 0;
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;

        // 넘어온 파일이 type=="application/vnd.ms-excel" 또는 "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 이면 엑셀 파일 이다.
        // tmp_name 을 읽어 온다 

        // 엑셀 데이터를 읽어서 배열로 만든다.
        $excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['inputUpload']['tmp_name']);
        $excelObj = $excelReader->load($_FILES['inputUpload']['tmp_name']);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();
        $cell = $worksheet->getCellByColumnAndRow(1, 1);
        $excel_cop_number = $cell->getValue(); // 엑셀에 있는 사업자 번호 // 123-45-67890  엑셀이 비아이에스인지 또는 (주)비아이에스인지 아니면 유라이프인지 확인하기 위해서 사용한다.
        $tax_yn = "";
        
        $SUP_BUSINESS_ARRAY = array(
            '636-87-00912' => '주식회사 비아이에스',
            '118-88-00158' => '주식회사 유라이프파이낸셜',
            '720-81-01460' => '유라이프커뮤니케이션즈',
        );

        $regdate = date('Y-m-d H:i:s');
        $regdatemd5 = md5($regdate);

        //$use_year_month_tmp = $this->input->post('searchDateYM');
        //$use_year_month = substr($use_year_month_tmp, 0, 4) . "-" . substr($use_year_month_tmp, 4, 2);
        $use_year_month = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');
        
        $lastcell = "";
        // 첫번째 시트의 6번째 행이 '등록일' 인 데이터가 있는 열을 마지막 열로 한다.
        for ($col = 0; $col <= 100; $col++) {
            $cell = $worksheet->getCellByColumnAndRow($col, 6);
            $val = $cell->getValue();
            if ($val == '세부 분류') {
                $lastcell = $col;
                break;
            }
        }

        //echo "마지막 열은 " . $lastcell . " 입니다.<br>";  // 2017-2기_유라이프_매입 세금계산서 
        //echo "마지막 열은 " . $lastcell . " 입니다.<br>";  // 2018-1기_유라이프_ 매입계산서 2
        //exit;

        /*
        erp_sales_buy_invoice table 형식은 다음과 같다 
        CREATE TABLE `erp_sales_buy_invoice` (
            `no` int(11) NOT NULL AUTO_INCREMENT,
            `code` varchar(35) NOT NULL DEFAULT '0' COMMENT '업로드코드',
            `type` enum('S','B') NOT NULL COMMENT '매출(S) 매입(B)',
            `use_year_month` varchar(7) NOT NULL COMMENT '사용년월',
            `issue_year_month` varchar(7) NOT NULL COMMENT '엑셀에 표시된 작성일자 년월',
            `issue_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '엑셀에 표시된 작성일자',
            `approval_number` varchar(50) NOT NULL DEFAULT '0000-00-00' COMMENT '승인번호',
            `issuance_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '발급일자',
            `tran_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '전송일자',
            `sup_business_number` varchar(15) NOT NULL COMMENT '공급자 사업자등록번호',
            `sup_workplace_number` varchar(50) NOT NULL COMMENT '공급자 종사업장번호',
            `sup_mutual` varchar(100) NOT NULL COMMENT '공급자 상호',
            `sup_representative_name` varchar(50) NOT NULL COMMENT '공급자 대표자명',
            `sup_address` varchar(200) NOT NULL COMMENT '공급자 주소',
            `rec_sup_business_number` varchar(15) NOT NULL COMMENT '공급받는자 사업자 등록번호',
            `rec_sup_workplace_number` varchar(50) NOT NULL COMMENT '공급받는자 종사업장 번호',
            `rec_sup_mutual` varchar(100) NOT NULL COMMENT '공급받는자 상호',
            `rec_sup_ceo_name` varchar(50) NOT NULL COMMENT '공급받는자 대표자명',
            `rec_sup_address` varchar(200) NOT NULL COMMENT '공급받는자 주소',
            `total_amount` int(11) NOT NULL DEFAULT 0 COMMENT '합계금액',
            `supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '공급가액',
            `tax_amount` int(11) DEFAULT 0 COMMENT '세액',
            `tax_invoice_classification` varchar(20) NOT NULL COMMENT '전자세금계산서분류',
            `tax_invoice_types` varchar(20) NOT NULL COMMENT '전자세금계산서종류',
            `issuance_type` varchar(30) NOT NULL COMMENT '발급유형',
            `note` text DEFAULT NULL COMMENT '비고',
            `receipt_billing` varchar(5) NOT NULL COMMENT '영수/청구 구분	',
            `provider_email` varchar(100) NOT NULL COMMENT '공급자 이메일',
            `supplier_email1` varchar(100) NOT NULL COMMENT '공급받는자 이메일1',
            `supplier_email2` varchar(100) DEFAULT NULL COMMENT '공급받는자 이메일2',
            `item_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '품목일자',
            `item_name` varchar(100) NOT NULL COMMENT '품목명',
            `item_cate` varchar(100) DEFAULT NULL COMMENT '분류(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매출엑셀에서 분류열)',
            `item_purchase_cate1` varchar(100) DEFAULT NULL COMMENT '매입내역 분류1(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매입엑셀에서 계정과목열)',
            `item_purchase_cate2` varchar(100) DEFAULT NULL COMMENT '매입내역 분류2(엑셀에 갑자기 추가된 열로 인해 추가된 필드매입엑셀에서 세부분류열)',
            `item_specifications` varchar(100) NOT NULL COMMENT '품목규격',
            `item_quantity` int(11) NOT NULL DEFAULT 0 COMMENT '품목수량',
            `item_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목단가',
            `item_supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목공급가액',
            `item_tax_amount` int(11) DEFAULT 0 COMMENT '품목세액',
            `item_remarks` text NOT NULL COMMENT '품목비고',
            `del_yn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부 (Y 삭제 / N삭제 안함)',
            `update_date` datetime DEFAULT NULL COMMENT '업데이트날짜',
            `regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
            PRIMARY KEY (`no`),
            KEY `type` (`type`),
            KEY `issue_date` (`issue_date`),
            KEY `sup_business_number` (`sup_business_number`),
            KEY `sup_mutual` (`sup_mutual`),
            KEY `rec_sup_business_number` (`rec_sup_business_number`),
            KEY `rec_sup_mutual` (`rec_sup_mutual`),
            KEY `regdate` (`regdate`),
            KEY `code` (`code`),
            KEY `use_year_month` (`use_year_month`),
            KEY `issue_year_month` (`issue_year_month`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='매출전자계산서목록';
        */
        // echo "<table class='table table-bordered'>";
        $values = "";
        $yearNmonthFieldAddArr = array('청구일','승인일');
        $onlyNumberFieldArr = array('합계금액', '공급가액', '세액', '품목수량', '품목단가', '품목공급가액', '품목세액');
        $issue_year_monthArr = array('작성일자');
        $type = "B";
        $startRow = 6;
        $issue_year_month = "";
        $removeCharArr = array("'","\\");

        //for ($row = 1; $row <= 5; $row++) {    // 테스트용
        for ($row = $startRow; $row <= $lastRow; $row++) {    
            // 첫번째 행은 헤더로 사용한다. // 실제로 데이터가 아니라 테이블의 헤더로 사용한다.
            if ($row == 6) {
                //echo "<tr class='success'>";
                //for ($col = 0; $col <= $lastcell; $col++) {
                    //echo "<td>";
                    //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    //echo "</td>";
                //}
                continue;
            } else {
                //echo "<tr>";
                $values .= "(";
                for ($col = 0; $col <= $lastcell; $col++) {
                    //echo "<td>";
                    //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $worksheet->getCellByColumnAndRow($col, 1) 갑이 $yearNmonthFieldAddArr 에 포함되면 추가적으로 $worksheet->getCellByColumnAndRow($col, 1) 에서 년도와 월을 추가적으로 뽑아서 넣는다.
                    if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $yearNmonthFieldAddArr)){
                        $values .= "'" . str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                        $values .= "'" . str_replace($removeCharArr,"",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4)) . "',"; // 년도만
                        $values .= "'" . str_replace($removeCharArr,"",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 4, 2)) . "',"; // 월만
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $onlyNumberFieldArr)){
                        // 숫자만
                        $numbercode = str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue());
                        $numbercode = preg_replace("/[^0-9-]/", "", $numbercode);

                        if(!$numbercode || $numbercode == '' || $numbercode == null){
                            $numbercode = 0;
                        }
                        
                        //echo $numbercode;

                        $values .= "'" . $numbercode . "',";
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $issue_year_monthArr)){
                        $values .= "'" . $worksheet->getCellByColumnAndRow($col, $row)->getValue() . "',";
                        $issue_year_month = substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4) . "-" . substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 5, 2);
                        // 디버그함수를 이용해서 확인한다. $this->customclass->debug($issue_year_month."000");
                        //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    } else if($worksheet->getCellByColumnAndRow($col, 6)->getValue() == "서소문사옥"){
                        $values .= "'삼성생명보험주식회사',";
                    } else {
                        $values .= "'" . str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                    }
                    //echo "</td>";
                }
                //echo "</tr>";
                $values = substr($values, 0, -1); // 마지막 콤마를 제거한다.
                $values .= ",'N', '". $regdate ."' ,'".$regdatemd5."', '".$type."','".$use_year_month."','".$issue_year_month."'),";
                continue;
            }
        }

        if($values != ''){
            // 마지막 콤마를 제거한다.
            // erp_sales_buy_invoice 테이블에 insert 한다.

            if($lastcell == 34){  // 매입 세금 계산서
            $tax_yn = "Y";
            $values_insertsql_start = "
                insert into `erp_sales_buy_invoice` ( 
                    `issue_date`, `approval_number`, `issuance_date`, `tran_date`, `sup_business_number`, 
                    `sup_workplace_number`, `sup_mutual`, `sup_representative_name`, `sup_address`, `rec_sup_business_number`, 
                    `rec_sup_workplace_number`, `rec_sup_mutual`, `rec_sup_ceo_name`, `rec_sup_address`, `total_amount`, 
                    `supply_price`, `tax_amount`, `tax_invoice_classification`, `tax_invoice_types`, `issuance_type`, 
                    `note`, `receipt_billing`, `provider_email`, `supplier_email1`, `supplier_email2`, 
                    `item_date`, `item_name`, `item_specifications`, `item_quantity`, `item_price`, 
                    `item_supply_price`, `item_tax_amount`, `item_remarks`,
                    `item_purchase_cate1`, `item_purchase_cate2`,
                    
                    `del_yn`, `regdate`, `code`, `type`, `use_year_month`, `issue_year_month`
                    ) values 
                ";
            } else if($lastcell == 32){ // 매입 계산서
                $tax_yn = "N";
                $values_insertsql_start = "
                insert into `erp_sales_buy_invoice` ( 
                    `issue_date`, `approval_number`, `issuance_date`, `tran_date`, `sup_business_number`, 
                    `sup_workplace_number`, `sup_mutual`, `sup_representative_name`, `sup_address`, `rec_sup_business_number`, 
                    `rec_sup_workplace_number`, `rec_sup_mutual`, `rec_sup_ceo_name`, `rec_sup_address`, `total_amount`, 
                    `supply_price`, `tax_invoice_classification`, `tax_invoice_types`, `issuance_type`, 
                    `note`, `receipt_billing`, `provider_email`, `supplier_email1`, `supplier_email2`, 
                    `item_date`, `item_name`, `item_specifications`, `item_quantity`, `item_price`, 
                    `item_supply_price`, `item_remarks`,
                    `item_purchase_cate1`, `item_purchase_cate2`,
                    
                    `del_yn`, `regdate`, `code`, `type`, `use_year_month`, `issue_year_month`
                    ) values 
                ";

            }
            $values = substr($values, 0, -1);
            // 맨마지막에 세미콜론을 붙인다.
            $values .= ";";
            $values = $values_insertsql_start . $values;
        }

        //echo "<xmp>SQL : ".$values; 
        //exit;

        //echo "values : ".$values;
        // 디비에 저장한다.

        $re = $this->ErpBasicInfoModel->GetSqlData2($values);



        if($re){
            // 업로드 history 에 저장한다.
            $upload_history_data = array();
            $upload_history_data['code'] = $regdatemd5;
            $upload_history_data['tax_yn'] = $tax_yn;
            $upload_history_data['type'] = $type; // buy 매입
            $upload_history_data['total'] = $lastRow - $startRow; // 업로드 된 전체 건수
            $upload_history_data['reg_date'] = $regdate;
            $upload_history_data['reg_admin'] = $_SESSION['CRM_ID']; // $this->session->userdata('CRM_ID') // 등록자 아이디
            // 해당 엑셀업로드의 사업자를 확인하여 회사명을 저장한다. // 사업자 번호로 회사명을 확인한다.
            $upload_history_data['com_name'] = $SUP_BUSINESS_ARRAY[$excel_cop_number];
            // $this->input->post('searchDateYM'); // 202403 를  // 2024-03 으로 변경 하여서 use_year_month 에 저장한다.
            // $upload_history_data['use_year_month'] = substr($this->input->post('searchDateYM'), 0, 4) . "-" . substr($this->input->post('searchDateYM'), 4, 2);
            $upload_history_data['use_year_month'] = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');
            $re2 = $this->ErpBasicInfoModel->InsertUploadHistory($upload_history_data);

            echo "<script>alert('업로드 되었습니다.'); history.back();</script>";
        } else {
            echo "<script>alert('업로드에 실패하였습니다. \\n해당 파일을 개발담당자에게 전달 부탁드립니다.'); history.back();</script>";
        }
    } // end of function purchaseUploadBreakdownRegProc


    // 매출 내역 엑셀 업로드 프로세스 salesUploadBreakdownRegProc
    public function salesUploadBreakdownRegProc() {
        //error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        // 로그인 체크 CustomClass 클래스에서 loginCheckNGoLoginpage() 를 호출하여 로그인 체크를 한다.
        // 로그인 안되어 있으면 로그인 페이지로 이동 함, 호출만 하면 된다.
        $this->customclass->loginCheckNGoLoginpage();

        // 파일 업로드
        // 파일 확인 
        if($_FILES['inputUpload']['name'] == "") {
            echo "<script>alert('파일을 선택하세요.'); history.back();</script>";
            exit;
        }

        // post로 넘어온 데이터 확인         $this->customclass->debug($this->input->post());
        // 넘어온 파일 확인         $this->customclass->debug($_FILES['inputUpload']);

        // 파일 업로드 설정
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 0;
        $config['overwrite'] = true;
        $config['encrypt_name'] = true;

        // 넘어온 파일이 type=="application/vnd.ms-excel" 또는 "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 이면 엑셀 파일 이다.
        // tmp_name 을 읽어 온다 

        // 엑셀 데이터를 읽어서 배열로 만든다.
        $excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['inputUpload']['tmp_name']);
        $excelObj = $excelReader->load($_FILES['inputUpload']['tmp_name']);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();
        $cell = $worksheet->getCellByColumnAndRow(1, 1);
        $excel_cop_number = $cell->getValue(); // 엑셀에 있는 사업자 번호 // 123-45-67890  엑셀이 비아이에스인지 또는 (주)비아이에스인지 아니면 유라이프인지 확인하기 위해서 사용한다.
        $tax_yn = "";


        $SUP_BUSINESS_ARRAY = array(
            '636-87-00912' => '주식회사 비아이에스',
            '118-88-00158' => '주식회사 유라이프파이낸셜',
            '720-81-01460' => '유라이프커뮤니케이션즈',
        );
        
        $regdate = date('Y-m-d H:i:s');
        $regdatemd5 = md5($regdate);

        //$use_year_month_tmp = $this->input->post('searchDateYM');
        //$use_year_month = substr($use_year_month_tmp, 0, 4) . "-" . substr($use_year_month_tmp, 4, 2);
        $use_year_month = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');

        
        $lastcell = "";
        // 첫번째 시트의 6번째 행이 '등록일' 인 데이터가 있는 열을 마지막 열로 한다.
        for ($col = 0; $col <= 100; $col++) {
            $cell = $worksheet->getCellByColumnAndRow($col, 6);
            $val = $cell->getValue();
            if ($val == '분류') {
                $lastcell = $col;
                break;
            }
        }

        //echo "마지막 열은 " . $lastcell . " 입니다.<br>";
        //exit;
        /*


작성일자    issue_date
승인번호    approval_number
발급일자    issuance_date
전송일자    tran_date
공급자사업자등록번호    sup_business_number
종사업장번호    sup_workplace_number
상호    sup_mutual
대표자명 sup_representative_name
주소    sup_address
공급받는자사업자등록번호    rec_sup_business_number
종사업장번호    rec_sup_workplace_number
상호    rec_sup_mutual
대표자명    rec_sup_ceo_name
주소    rec_sup_address
합계금액    total_amount
공급가액    supply_price
전자세금계산서분류  tax_invoice_classification
전자세금계산서종류  tax_invoice_types
발급유형    issuance_type
비고    note
영수/청구 구분  receipt_billing
공급자 이메일   provider_email
공급받는자 이메일1  supplier_email1
공급받는자 이메일2  supplier_email2
품목일자    item_date
품목명  item_name
품목규격    item_specifications
품목수량    item_quantity
품목단가    item_price
품목공급가액    item_supply_price
품목비고    item_remarks
분류    item_cate


        erp_sales_buy_invoice table 형식은 다음과 같다 
        CREATE TABLE `erp_sales_buy_invoice` (
            `no` int(11) NOT NULL AUTO_INCREMENT,
            `code` varchar(35) NOT NULL DEFAULT '0' COMMENT '업로드코드',
            `type` enum('S','B') NOT NULL COMMENT '매출(S) 매입(B)',
            `use_year_month` varchar(7) NOT NULL COMMENT '사용년월',
            `issue_year_month` varchar(7) NOT NULL COMMENT '엑셀에 표시된 작성일자 년월',
            `issue_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '엑셀에 표시된 작성일자',
            `approval_number` varchar(50) NOT NULL DEFAULT '0000-00-00' COMMENT '승인번호',
            `issuance_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '발급일자',
            `tran_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '전송일자',
            `sup_business_number` varchar(15) NOT NULL COMMENT '공급자 사업자등록번호',
            `sup_workplace_number` varchar(50) NOT NULL COMMENT '공급자 종사업장번호',
            `sup_mutual` varchar(100) NOT NULL COMMENT '공급자 상호',
            `sup_representative_name` varchar(50) NOT NULL COMMENT '공급자 대표자명',
            `sup_address` varchar(200) NOT NULL COMMENT '공급자 주소',
            `rec_sup_business_number` varchar(15) NOT NULL COMMENT '공급받는자 사업자 등록번호',
            `rec_sup_workplace_number` varchar(50) NOT NULL COMMENT '공급받는자 종사업장 번호',
            `rec_sup_mutual` varchar(100) NOT NULL COMMENT '공급받는자 상호',
            `rec_sup_ceo_name` varchar(50) NOT NULL COMMENT '공급받는자 대표자명',
            `rec_sup_address` varchar(200) NOT NULL COMMENT '공급받는자 주소',
            `total_amount` int(11) NOT NULL DEFAULT 0 COMMENT '합계금액',
            `supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '공급가액',
            `tax_amount` int(11) DEFAULT 0 COMMENT '세액',
            `tax_invoice_classification` varchar(20) NOT NULL COMMENT '전자세금계산서분류',
            `tax_invoice_types` varchar(20) NOT NULL COMMENT '전자세금계산서종류',
            `issuance_type` varchar(30) NOT NULL COMMENT '발급유형',
            `note` text DEFAULT NULL COMMENT '비고',
            `receipt_billing` varchar(5) NOT NULL COMMENT '영수/청구 구분	',
            `provider_email` varchar(100) NOT NULL COMMENT '공급자 이메일',
            `supplier_email1` varchar(100) NOT NULL COMMENT '공급받는자 이메일1',
            `supplier_email2` varchar(100) DEFAULT NULL COMMENT '공급받는자 이메일2',
            `item_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '품목일자',
            `item_name` varchar(100) NOT NULL COMMENT '품목명',
            `item_cate` varchar(100) DEFAULT NULL COMMENT '분류(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매출엑셀에서 분류열)',
            `item_purchase_cate1` varchar(100) DEFAULT NULL COMMENT '매입내역 분류1(엑셀에 갑자기 추가된 열로 인해 추가된 필드=매입엑셀에서 계정과목열)',
            `item_purchase_cate2` varchar(100) DEFAULT NULL COMMENT '매입내역 분류2(엑셀에 갑자기 추가된 열로 인해 추가된 필드매입엑셀에서 세부분류열)',
            `item_specifications` varchar(100) NOT NULL COMMENT '품목규격',
            `item_quantity` int(11) NOT NULL DEFAULT 0 COMMENT '품목수량',
            `item_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목단가',
            `item_supply_price` int(11) NOT NULL DEFAULT 0 COMMENT '품목공급가액',
            `item_tax_amount` int(11) DEFAULT 0 COMMENT '품목세액',
            `item_remarks` text NOT NULL COMMENT '품목비고',
            `del_yn` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부 (Y 삭제 / N삭제 안함)',
            `update_date` datetime DEFAULT NULL COMMENT '업데이트날짜',
            `regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
            PRIMARY KEY (`no`),
            KEY `type` (`type`),
            KEY `issue_date` (`issue_date`),
            KEY `sup_business_number` (`sup_business_number`),
            KEY `sup_mutual` (`sup_mutual`),
            KEY `rec_sup_business_number` (`rec_sup_business_number`),
            KEY `rec_sup_mutual` (`rec_sup_mutual`),
            KEY `regdate` (`regdate`),
            KEY `code` (`code`),
            KEY `use_year_month` (`use_year_month`),
            KEY `issue_year_month` (`issue_year_month`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='매출전자계산서목록'
        */
        // echo "<table class='table table-bordered'>";
        $values = "";
        $yearNmonthFieldAddArr = array('청구일','승인일');
        $onlyNumberFieldArr = array('합계금액', '공급가액', '세액', '품목수량', '품목단가', '품목공급가액', '품목세액');
        $issue_year_monthArr = array('작성일자');
        $type = "S";
        $startRow = 6;
        $issue_year_month = "";
        $removeCharArr = array("'","\\");

        //for ($row = 1; $row <= 5; $row++) {    // 테스트용
        for ($row = $startRow; $row <= $lastRow; $row++) {  
            $issue_year_month = "";  
            // 첫번째 행은 헤더로 사용한다. // 실제로 데이터가 아니라 테이블의 헤더로 사용한다.
            if ($row == 6) {
                //echo "<tr class='success'>";
                //for ($col = 0; $col <= $lastcell; $col++) {
                    //echo "<td>";
                    //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    //echo "</td>";
                //}
                continue;
            } else { 
                //echo "<tr>";
                $values .= "(";
                for ($col = 0; $col <= $lastcell; $col++) {
                    //echo "<td>";
                    //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $worksheet->getCellByColumnAndRow($col, 1) 갑이 $yearNmonthFieldAddArr 에 포함되면 추가적으로 $worksheet->getCellByColumnAndRow($col, 1) 에서 년도와 월을 추가적으로 뽑아서 넣는다.
                    if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $yearNmonthFieldAddArr)){
                        $values .= "'" . str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                        $values .= "'" . str_replace($removeCharArr,"",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4)) . "',"; // 년도만
                        $values .= "'" . str_replace($removeCharArr,"",substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 4, 2)) . "',"; // 월만
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $onlyNumberFieldArr)){
                        // 숫자만
                        $numbercode = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $numbercode = preg_replace("/[^0-9-]/", "", $numbercode);

                        if(!$numbercode || $numbercode == '' || $numbercode == null){
                            $numbercode = 0;
                        }
                        
                        //echo $numbercode;

                        $values .= "'" . str_replace($removeCharArr,"",$numbercode) . "',";
                    } else if(in_array($worksheet->getCellByColumnAndRow($col, 6)->getValue(), $issue_year_monthArr)){
                        $values .= "'" . str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                        $issue_year_month = substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 4) . "-" . substr($worksheet->getCellByColumnAndRow($col, $row)->getValue(), 5, 2);
                        // 디버그함수를 이용해서 확인한다. $this->customclass->debug($issue_year_month."123");
                    
                        //echo $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    } else if($worksheet->getCellByColumnAndRow($col, 6)->getValue() == "서소문사옥"){
                        $values .= "'삼성생명보험주식회사',";
                    } else {
                        $values .= "'" . str_replace($removeCharArr,"",$worksheet->getCellByColumnAndRow($col, $row)->getValue()) . "',";
                    }
                    //echo "</td>";
                }
                //echo "</tr>";
                $values = substr($values, 0, -1); // 마지막 콤마를 제거한다.
                $values .= ",'N', '". $regdate ."' ,'".$regdatemd5."', '".$type."','".$use_year_month."','".$issue_year_month."'),";
                continue;
            }
        }

        if($values != ''){
            // 마지막 콤마를 제거한다.
            // erp_sales_buy_invoice 테이블에 insert 한다.
            if($lastcell == 33){  // 매출 세금 계산서
            $tax_yn = "Y";
            $values_insertsql_start = "
            insert into `erp_sales_buy_invoice` ( 
                `issue_date`, `approval_number`, `issuance_date`, `tran_date`, `sup_business_number`, 
                `sup_workplace_number`, `sup_mutual`, `sup_representative_name`, `sup_address`, `rec_sup_business_number`, 
                `rec_sup_workplace_number`, `rec_sup_mutual`, `rec_sup_ceo_name`, `rec_sup_address`, `total_amount`, 
                `supply_price`, `tax_amount`, `tax_invoice_classification`, `tax_invoice_types`, `issuance_type`, 
                `note`, `receipt_billing`, `provider_email`, `supplier_email1`, `supplier_email2`, 
                `item_date`, `item_name`, `item_specifications`, `item_quantity`, `item_price`, 
                `item_supply_price`, `item_tax_amount`, `item_remarks`, `item_cate`, 
                
                `del_yn`, `regdate`, `code`, `type`, `use_year_month`, `issue_year_month`
                ) values 
            ";
            } else if($lastcell == 31){ // 매출 계산서
                $tax_yn = "N";
                $values_insertsql_start = "
                insert into `erp_sales_buy_invoice` ( 
                    `issue_date`, `approval_number`, `issuance_date`, `tran_date`, `sup_business_number`, 
                `sup_workplace_number`, `sup_mutual`, `sup_representative_name`, `sup_address`, `rec_sup_business_number`, 
                `rec_sup_workplace_number`, `rec_sup_mutual`, `rec_sup_ceo_name`, `rec_sup_address`, `total_amount`, 
                `supply_price`, `tax_invoice_classification`, `tax_invoice_types`, `issuance_type`, 
                `note`, `receipt_billing`, `provider_email`, `supplier_email1`, `supplier_email2`, 
                `item_date`, `item_name`, `item_specifications`, `item_quantity`, `item_price`, 
                `item_supply_price`, `item_remarks`, `item_cate`, 
                
                `del_yn`, `regdate`, `code`, `type`, `use_year_month`, `issue_year_month`
                    ) values 
                ";
            }
            $values = substr($values, 0, -1);
            // 맨마지막에 세미콜론을 붙인다.
            $values .= ";";
            $values = $values_insertsql_start . $values;
        }

        //echo "<xmp>SQL : ".$values; exit;

        //echo "values : ".$values;
        // 디비에 저장한다.
        
        $re = $this->ErpBasicInfoModel->GetSqlData2($values);

        if($re){
            // 업로드 history 에 저장한다.
            $upload_history_data = array();
            $upload_history_data['tax_yn'] = $tax_yn;
            $upload_history_data['code'] = $regdatemd5;
            $upload_history_data['type'] = $type; // sales 매출
            $upload_history_data['total'] = $lastRow - $startRow; // 업로드 된 전체 건수
            $upload_history_data['reg_date'] = $regdate;
            $upload_history_data['reg_admin'] = $_SESSION['CRM_ID']; // $this->session->userdata('CRM_ID') // 등록자 아이디
            // 해당 엑셀업로드의 사업자를 확인하여 회사명을 저장한다. // 사업자 번호로 회사명을 확인한다.
            $upload_history_data['com_name'] = $SUP_BUSINESS_ARRAY[$excel_cop_number];
            // $this->input->post('searchDateYM'); // 202403 를  // 2024-03 으로 변경 하여서 use_year_month 에 저장한다.
            // $upload_history_data['use_year_month'] = substr($this->input->post('searchDateYM'), 0, 4) . "-" . substr($this->input->post('searchDateYM'), 4, 2);
            $upload_history_data['use_year_month'] = $this->input->post('searchDateY')."-".$this->input->post('searchDateM');
            $re2 = $this->ErpBasicInfoModel->InsertUploadHistory($upload_history_data);

            echo "<script>alert('업로드 되었습니다.'); history.back();</script>";
        } else {
            echo "<script>alert('업로드에 실패하였습니다. \\n해당 파일을 개발담당자에게 전달 부탁드립니다.'); history.back();</script>";
        }
    } // end of function salesUploadBreakdownRegProc



} // end of class FinancialManagement