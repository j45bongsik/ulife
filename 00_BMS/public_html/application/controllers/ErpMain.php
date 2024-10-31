<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
 * // ERP 메인 컨트롤러이며 대시보드 ( 로그인 후 바로 해당 페이지 )를 담당한다.
 *
 * 
 */

class ErpMain extends CI_Controller {
    function __construct(){
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


    public function index(){

        $this->customclass->loginCheckNGoLoginpage();
        
        $menuNo = array(0,1);


        // 기준일 설정 
        $thisYear = date('Y');
        $lastYear = date('Y', strtotime('-1 year'));
        $thisMonth = date('m');
        // 지난달 // 이번달 내용은 다음달에 들어오기 때문에 지난달로 설정
        $lastMonth = date('m', strtotime('-1 month'));

        $startThisYearMonth = $thisYear . '-01';
        $endThisYearMonth = $thisYear . '-' . $lastMonth;

        $startLastYearMonth = $lastYear . '-01';
        $endLastYearMonth = $lastYear . '-' . $lastMonth;

        // CustomClass 클래스의 debug 를 사용 하여 디버깅 확인 
        /*
        $this->customclass->debug($thisYear);
        $this->customclass->debug($lastYear);
        $this->customclass->debug($thisMonth);
        $this->customclass->debug($lastMonth);
        $this->customclass->debug($startThisYearMonth);
        $this->customclass->debug($endThisYearMonth);
        */

        if($thisMonth == '01'){
            $startThisYearMonth = $lastYear . '-01';
            $endThisYearMonth = $lastYear . '-12';
            $startLastYearMonth = $lastYear - 1 . '-01';
            $endLastYearMonth = $lastYear - 1 . '-12';
        }

        // CustomClass 클래스의 debug 를 사용 하여 디버깅 확인 
        /*
        $this->customclass->debug($startThisYearMonth);
        $this->customclass->debug($endThisYearMonth);
        $this->customclass->debug($startLastYearMonth);
        $this->customclass->debug($endLastYearMonth);
        */


        // 금년 총매출 
        $thisYearTotalSales = number_format($this->MainModel->getSalesBuyTotal($startThisYearMonth,$endThisYearMonth, 'S'));
        // 쿼리 확인          $this->customclass->debug($this->db->last_query());
        // 작년 총매출
        $lastYearTotalSales = number_format($this->MainModel->getSalesBuyTotal($startLastYearMonth, $endLastYearMonth, 'S'));
        // 쿼리 확인          $this->customclass->debug($this->db->last_query());
        // 금년 총매입
        $thisYearTotalPurchase = number_format($this->MainModel->getSalesBuyTotal($startThisYearMonth,$endThisYearMonth, 'B'));
        // 쿼리 확인          $this->customclass->debug($this->db->last_query());
        // 작년 총매입
        $lastYearTotalPurchase = number_format($this->MainModel->getSalesBuyTotal($startLastYearMonth, $endLastYearMonth, 'B'));
        // 쿼리 확인          $this->customclass->debug($this->db->last_query());


        // 해당년도 월별 통계 
        $salesBuyMonthly = $this->MainModel->getSalesBuyMonthTotal(date('Y'));
        // 쿼리 확인          $this->customclass->debug($this->db->last_query());


        /*
        결과는 다음과 같다 
        Array
(
    [0] => stdClass Object
        (
            [Y] => 2024
            [type] => S
            [M01] => 93811049
            [M02] => 29534760
            [M03] => 48765397
            [M04] => 0
            [M05] => 0
            [M06] => 0
            [M07] => 0
            [M08] => 0
            [M09] => 0
            [M10] => 0
            [M11] => 0
            [M12] => 0
        )

    [1] => stdClass Object
        (
            [Y] => 2024
            [type] => B
            [M01] => 13662746
            [M02] => 12150514
            [M03] => 374603481
            [M04] => 0
            [M05] => 0
            [M06] => 0
            [M07] => 0
            [M08] => 0
            [M09] => 0
            [M10] => 0
            [M11] => 0
            [M12] => 0
        )

)

        */

        /*
            $salesBuyMonthly 를 가지고 script 에서 차트를 그릴 수 있게 만들어줘야함

            data1 = [80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000];
            data2 = [40000, 45000, 50000,10000, 40000, 45000, 50000,10000, 40000, 45000, 50000,10000];
            이렇게 만들어서 json 으로 리턴
        */

        $chartJsdata1 = array();
        $chartJsdata2 = array();

        foreach($salesBuyMonthly as $key => $value){

            if($value->type == 'S'){
                // data: [80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000], 형식의 텍스트로 만들어줌
                $chartJsdata1 = " data : [{$value->M01}, {$value->M02}, {$value->M03}, {$value->M04}, {$value->M05}, {$value->M06}, {$value->M07}, {$value->M08}, {$value->M09}, {$value->M10}, {$value->M11}, {$value->M12}],
                ";
            }else if($value->type == 'B'){
                // 디버그 $salesBuyMonthly                 $this->customclass->debug($salesBuyMonthly);
                $chartJsdata2 = " data : [{$value->M01}, {$value->M02}, {$value->M03}, {$value->M04}, {$value->M05}, {$value->M06}, {$value->M07}, {$value->M08}, {$value->M09}, {$value->M10}, {$value->M11}, {$value->M12}],
                ";
            }else{
                // $key + 1 로 강제로 $data1, $data2 를 array 로 만들어서 0으로 채워줌
                $datanum = $key + 1;
                $chartJsdata.$datanum = " data : [0,0,0,0,0,0,0,0,0,0,0,0],
                ";
            }
        }

        // 매출 순위 TOP10
        $salesRanking = $this->MainModel->getSalesRanking($thisYear);
        $salesRankingTr = "";
        // json 으로 리턴 $salesRanking = json_encode($salesRanking);
        // debug $this->customclass->debug($salesRanking);
        // 해당 데이터로 <tr><td>10</td><td>에이스아메리칸화재해상보험(주)</td><td>30,000,000</td></tr> 이런식으로 만들어서 테이블에 넣어주면 됨
        foreach($salesRanking as $key => $value){
            $salesRankingTr .= "
            <tr>
                <td>".($key+1)."</td>
                <td>".$value->rec_sup_mutual."</td>
                <td>".number_format($value->total)."</td>
            </tr>";
        }


        // 매입 순위 TOP10
        $buyRanking = $this->MainModel->getBuyRanking($thisYear);
        $buyRankingTr = "";
        // json 으로 리턴 $buyRanking = json_encode($buyRanking);
        // debug $this->customclass->debug($buyRanking);
        // 해당 데이터로 <tr><td>10</td><td>에이스아메리칸화재해상보험(주)</td><td>30,000,000</td></tr> 이런식으로 만들어서 테이블에 넣어주면 됨
        foreach($buyRanking as $key => $value){
            $buyRankingTr .= "
            <tr>
                <td>".($key+1)."</td>
                <td>".$value->sup_mutual."</td>
                <td>".number_format($value->total)."</td>
            </tr>";
        }

        $this->load->view($this->serviceTab . '/inc/common');
        $this->load->view($this->serviceTab . '/inc/header', array('menuNo'=>$menuNo ));
        $this->load->view($this->serviceTab . '/inc/menu');
        $this->load->view($this->serviceTab . '/main/dashboard', array(
                                                                    'THISYEARTOTALSALES' => $thisYearTotalSales,
                                                                    'LASTYEARTOTALSALES' => $lastYearTotalSales,
                                                                    'THISYEARTOTALPURCHASE' => $thisYearTotalPurchase,
                                                                    'LASTYEARTOTALPURCHASE' => $lastYearTotalPurchase,
                                                                    'TOPSTARTDATE' => $startThisYearMonth,
                                                                    'TOPENDDATE' => $endThisYearMonth,
                                                                    'SALESRANKING' => $salesRankingTr,
                                                                    'BUYRANKING' => $buyRankingTr,
                                                                    'CHARTJSDATA1' => $chartJsdata1,
                                                                    'CHARTJSDATA2' => $chartJsdata2,
                                                                )
        );
        $this->load->view($this->serviceTab . '/inc/footer');
    }

    // ajaxGetSalesRanking
    public function ajaxGetSalesRanking(){
        $this->customclass->loginCheckNGoLoginpage();

        // 년도를 받아서 해당 연도의 매출 순위 TOP10 가져오기 getSalesRanking($year)
        $Year = $this->input->post('year');
        $salesRanking = $this->MainModel->getSalesRanking($Year);

        $salesRankingTr = "";
        // json 으로 리턴 $salesRanking = json_encode($salesRanking);
        // debug $this->customclass->debug($salesRanking);
        // 해당 데이터로 <tr><td>10</td><td>에이스아메리칸화재해상보험(주)</td><td>30,000,000</td></tr> 이런식으로 만들어서 테이블에 넣어주면 됨
        // 자료가 없으면 없다고 표시
        if(count($salesRanking) == 0){
            $salesRankingTr = "<tr><td colspan='3' class=\"disabled\">자료가 없습니다.</td></tr>";
        } else {
            foreach($salesRanking as $key => $value){
                $salesRankingTr .= "
                <tr>
                    <td>".($key+1)."</td>
                    <td>".$value->rec_sup_mutual."</td>
                    <td>".number_format($value->total)."</td>
                </tr>";
            }
        }
        // html 로 리턴
        echo $salesRankingTr;
        
    }

    // ajaxGetBuyRanking
    public function ajaxGetBuyRanking(){
        $this->customclass->loginCheckNGoLoginpage();

        // 년도를 받아서 해당 연도의 매입 순위 TOP10 가져오기 getBuyRanking($year)
        $Year = $this->input->post('year');
        $buyRanking = $this->MainModel->getBuyRanking($Year);

        $buyRankingTr = "";
        // json 으로 리턴 $buyRanking = json_encode($buyRanking);
        // debug $this->customclass->debug($buyRanking);
        // 해당 데이터로 <tr><td>10</td><td>에이스아메리칸화재해상보험(주)</td><td>30,000,000</td></tr> 이런식으로 만들어서 테이블에 넣어주면 됨
        // 자료가 없으면 없다고 표시
        if(count($buyRanking) == 0){
            $buyRankingTr = "<tr><td colspan='3' class=\"disabled\">자료가 없습니다.</td></tr>";
        } else {
            foreach($buyRanking as $key => $value){
                $buyRankingTr .= "
                <tr>
                    <td>".($key+1)."</td>
                    <td>".$value->sup_mutual."</td>
                    <td>".number_format($value->total)."</td>
                </tr>";
            }
        }
        
        // html 로 리턴
        echo $buyRankingTr;
        
    }

    // 년도를 받아서 해당 연도의 매출 순위 TOP10 가져오기 getSalesRanking($year)
    public function getSalesRanking($year = null){
        $this->customclass->loginCheckNGoLoginpage();

        // 년도가 없으면 현재 년도로 설정
        if($year == null){
            $year = date('Y');
        }
        
        $salesRanking = $this->MainModel->getSalesRanking($Year);
        // json 으로 리턴
        return $salesRanking;
    }

    // 년도를 받아서 해당 연도의 매입 순위 TOP10 가져오기 getBuyRanking($Year)
    public function getBuyRanking($year = null){
        $this->customclass->loginCheckNGoLoginpage();

        // 년도가 없으면 현재 년도로 설정
        if($year == null){
            $year = date('Y');
        }
        
        $buyRanking = $this->MainModel->getBuyRanking($Year);
        // json 으로 리턴
        return $buyRanking;
    }

    // 년도를 받아서 해당 연도의 월별 매출 매입을 가져오는 함수 getSalesBuyMonthTotal($year)
    public function getSalesBuyMonthTotal(){
        $this->customclass->loginCheckNGoLoginpage();

        // post로 넘어온 년도를 받아옴
        $Year = $this->input->post('year');
        

        $salesBuyMonthly = $this->MainModel->getSalesBuyMonthTotal($Year);

        // 마지막 쿼리 확인         $this->customclass->debug($this->db->last_query());

        // $salesBuyMonthly 데이터 확인         $this->customclass->debug($salesBuyMonthly);
        /*
        결과는 다음과 같다 
        Array
(
    [0] => stdClass Object
        (
            [Y] => 2024
            [type] => S
            [M01] => 93811049
            [M02] => 29534760
            [M03] => 48765397
            [M04] => 0
            [M05] => 0
            [M06] => 0
            [M07] => 0
            [M08] => 0
            [M09] => 0
            [M10] => 0
            [M11] => 0
            [M12] => 0
        )

    [1] => stdClass Object
        (
            [Y] => 2024
            [type] => B
            [M01] => 13662746
            [M02] => 12150514
            [M03] => 374603481
            [M04] => 0
            [M05] => 0
            [M06] => 0
            [M07] => 0
            [M08] => 0
            [M09] => 0
            [M10] => 0
            [M11] => 0
            [M12] => 0
        )

)

        */

        /*
            $salesBuyMonthly 를 가지고 script 에서 차트를 그릴 수 있게 만들어줘야함

            data1 = [80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000];
            data2 = [40000, 45000, 50000,10000, 40000, 45000, 50000,10000, 40000, 45000, 50000,10000];
            이렇게 만들어서 json 으로 리턴
        */

        $data1 = array();
        $data2 = array();

        foreach($salesBuyMonthly as $key => $value){

            if($value->type == 'S'){
                $data1 = array($value->M01, $value->M02, $value->M03, $value->M04, $value->M05, $value->M06, $value->M07, $value->M08, $value->M09, $value->M10, $value->M11, $value->M12);                
            }else if($value->type == 'B'){
                $data2 = array($value->M01, $value->M02, $value->M03, $value->M04, $value->M05, $value->M06, $value->M07, $value->M08, $value->M09, $value->M10, $value->M11, $value->M12);
            }else{
                // $key + 1 로 강제로 $data1, $data2 를 array 로 만들어서 0으로 채워줌
                $datanum = $key + 1;
                $data.$datanum = array_fill(0, 12, 0);
            }
        }

        // json 으로 리턴
        //return json_encode(array('data1'=>$data1, 'data2'=>$data2));
        echo json_encode(array('data1'=>$data1, 'data2'=>$data2));

    }





    
}