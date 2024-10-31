<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$mAgent = array("iPhone", "iPod", "Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony" );
$chkMobile = false;
$str = "";



// 도메인 네임의 앞 세자리가 BMS 이면 BMS 서버로 접속, ERP 이면 ERP 서버로 접속 // $service_tab 는 모든 페이지에서 사용 가능
// $service_tab 초기화 및 정의 
$service_tab = "";
$service_tab = substr($_SERVER['HTTP_HOST'], 0, 3); // crm , erp, bms
$_SERVER['service_tab'] = $service_tab;
if(!in_array($service_tab , array('crm','erp','bms'))){
    $service_tab = "bms";
}

// 접속자 주소 확인 후 내부 인원만 접속 가능하게 처리 예정 // CRM 또는 ERP 또는 BMS 인지에 따라 변경 가능 
$ip = $_SERVER['REMOTE_ADDR'];
$ip_arr = array("121.160.204.192", "192.168.0.13", "172.23.0.1");
if(!in_array($ip, $ip_arr)){
    //header("Location: http://ubiz.co.kr"); //exit;
} else {
    //header("Location: /admin/index"); //exit;
}



// 모바일 접속시 접속 페이지를 모바일 페이지로 이동
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        break;
    }
}



if($chkMobile){ //모바일 여부 체크 나눌지 몰라서 .... 
    //$str = $service_tab."/".'main_m';
}else {
    //$str = $service_tab."/".'main';
}



// 기본 페이지
if($service_tab == "crm" || $service_tab == "bms"){
    $route['default_controller'] = $str.'customer/list';
} else if($service_tab == "erp"){
    $route['default_controller'] = $str.'dashboard';
} 

// Crontab 페이지
// 보험 종료일이 15일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
$route['sendMailToContractListByEndDate15InternalManager'] = $str.'crontab/sendMailToContractListByEndDate15InternalManager';

// 보험 종료일이 30일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
$route['sendMailToContractListByEndDate30InternalManager'] = $str.'crontab/sendMailToContractListByEndDate30InternalManager'; 

// 보험 종료일이 45일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
$route['sendMailToContractListByEndDate45InternalManager'] = $str.'crontab/sendMailToContractListByEndDate45InternalManager';

// 보험 종료일이 60일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
$route['sendMailToContractListByEndDate60InternalManager'] = $str.'crontab/sendMailToContractListByEndDate60InternalManager';

// 보험 종료일이 90일 이내인 상품이 있으면 해당 사내 담당자에게 메일 발송
$route['sendMailToContractListByEndDate90InternalManager'] = $str.'crontab/sendMailToContractListByEndDate90InternalManager';


// ----------------- 로그인 & 로그아웃 페이지 S -----------------
// 로그인 페이지
$route['login'] = $str.'member/login'; // 로그인 페이지
$route['login_proc'] = $str.'member/loginProc'; // 로그인 처리

// 로그아웃 처리
$route['logout'] = $str.'member/logout'; // 로그아웃 처리
// ----------------- 로그인 & 로그아웃 페이지 E -----------------



// ----------------- 마이페이지 S -----------------
// 마이페이지
$route['mypage'] = $str.'member/mypage'; // 마이페이지
$route['mypage/(:num)'] = $str.'member/mypage/$1'; // 계약 리스트

$route['excelDownContractListByEndDate'] = $str.'member/excelDownContractListByEndDate'; // 마이페이지 만기 도래 리스트 엑셀 다운로드
// ----------------- 마이페이지 E -----------------



// ----------------- 고객 관리 페이지 Customer S -----------------
// 고객 관리 페이지 Customer S
$route['customer'] = $str.'customer/list';  // 거래처(고객사) 리스트
$route['customer/(:num)'] = $str.'customer/list/$1'; // 거래처 리스트
$route['customer/list'] = $str.'customer/list/1'; // 거래처 리스트
$route['customer/list/(:num)'] = $str.'customer/list/$1'; // 거래처 리스트
$route['customer/list/(:num)/(:any)'] = $str.'customer/list/$1/$2'; // 거래처 리스트
//$route['contract_view'] = $str.'contract/view';   // 거래처 상세보기
$route['customer_view/(:any)'] = $str.'customer/view/$1';  // 거래처 상세보기

$route['customer2'] = $str.'Customer/list2';  // 거래처(고객사) 리스트
$route['customer_view'] = $str.'Customer/view';  // 거래처(고객사) 상세보기
$route['customer_view/(:any)'] = $str.'Customer/view/$1';  // 거래처(고객사) 상세보기
$route['customer_reg'] = $str.'Customer/reg';  // 거래처(고객사) 등록


// 고객관리 기타 페이지
// 사업자 번호 중복 체크 CustomerClass -> CheckBizNo
$route['checkBizNo'] = $str.'Customer/checkBizNo'; // 실제 코드는 사업자 번호 중복체크 CustomerClass -> CheckBizNo 

// 주민 번호 중복체크 CustomerClass -> CheckJuminNo
$route['checkJuminNo'] = $str.'Customer/checkJuminNo'; // 실제 코드는 주민 번호 중복체크 CustomerClass -> CheckJuminNo

// 이메일 중복체크 libraries 에있는 CustomClass -> CheckEmail
$route['checkEmail'] = $str.'Customer/checkEmail'; // 실제 코드는 이메일 중복체크 libraries 에있는 CustomClass -> CheckEmail

// 오픈 후 삭제 페이지 /customerlist  // 임시페이지 
$route['customerlist'] = $str.'Customer/customerlist';  // 거래처(고객사) 리스트
// ----------------- 고객 관리 페이지 Customer E -----------------



// ----------------- 계약 관리 페이지 Customer S -----------------
// 계약 관리 페이지 Contract S
$route['contract'] = $str.'contract'; // 계약 리스트
$route['contract/(:num)'] = $str.'contract/list/$1'; // 계약 리스트 
$route['contract/list'] = $str.'contract/list/1'; // 계약 리스트
$route['contract/list/(:num)'] = $str.'contract/list/$1'; // 계약 리스트
$route['contract/list/(:num)/(:any)'] = $str.'contract/list/$1/$2'; // 계약 리스트
//$route['contract_view'] = $str.'contract/view';   // 계약 상세보기
$route['contract_view/(:any)'] = $str.'contract/view/$1';  // 계약 상세보기
$route['contract_reg'] = $str.'contract/reg';  // 계약 등록
$route['customer_list_ajax'] = $str.'contract/list_ajax';  // 계약 고객사 리스트 ajax
// 계약 관리 페이지 Contract E
// ----------------- 계약 관리 페이지 Customer E -----------------



// ----------------- 보험사 관리 페이지 Customer S -----------------
// 보험사 관리 페이지 InsuranceCompany
$route['insuranceCompany'] = $str.'insuranceCompany/list';    // 보험사 리스트
$route['insuranceCompany/(:any)'] = $str.'insuranceCompany/list/$1';    // 보험사 리스트
$route['insuranceCompany_view'] = $str.'insuranceCompany/view'; // 보험사 상세보기
$route['insuranceCompany_view/(:any)'] = $str.'insuranceCompany/view/$1';    // 보험사 상세보기
$route['insuranceCompany_reg'] = $str.'insuranceCompany/reg';    // 보험사 등록
$route['insurancecompany_reg_ajax'] = $str.'insuranceCompany/insurancecompany_reg_ajax';    // 보험사 등록 ajax
$route['insuranceCompany_list_ajax'] = $str.'insuranceCompany/list_ajax';    // 보험사 리스트 ajax 검색
$route['insurancecompany_SelectBox'] = $str.'insuranceCompany/insurancecompany_SelectBox';  // 거래처(고객사) 등록


// 보험 가입 관련
$route['contract_reg'] = $str.'Contract/reg';  // 보험 가입
$route['contract'] = $str.'Contract/list';  // 보험 리스트
$route['insuranceProduct_list_ajax'] = $str.'Contract/insuranceProductListAjax';   // 보험 상세보기
$route['contractRegProc'] = $str.'Contract/regProc';  // 보험 가입 처리

// 보험상품 관리 페이지 Insurance
$route['insuranceProduct'] = $str.'insuranceProduct/list';  // 보험상품 리스트
$route['insuranceProduct/(:num)'] = $str.'insuranceProduct/list/$1';  // 보험상품 리스트
$route['insuranceProduct/list'] = $str.'insuranceProduct/list/1'; // 거래처 리스트
$route['insuranceProduct/list/(:num)'] = $str.'insuranceProduct/list/$1'; // 거래처 리스트
$route['insuranceProduct/list/(:num)/(:any)'] = $str.'insuranceProduct/list/$1/$2'; // 거래처 리스트

$route['insuranceProduct_view'] = $str.'insuranceProduct/view';   // 보험상품 상세보기
$route['insuranceProduct_view/(:any)'] = $str.'insuranceProduct/view/$1';  // 보험상품 상세보기
$route['insuranceProduct_reg'] = $str.'insuranceProduct/reg';  // 보험상품 등록
$route['insuranceProduct_reg_ajax'] = $str.'insuranceProduct/regProc';  // 보험상품 등록 ajax
$route['insuranceproductRegProc'] = $str.'insuranceProduct/regProc';  // 보험상품 등록 처리

//$route['getInsuranceCompanyDeptNameListByInsuranceCompanyCate'] = $str.'insuranceproduct/getInsuranceCompanyDeptNameListByInsuranceCompanyCate';  // 보험사 부서명 가져오기
//$route['insuranceCompanyDept'] = $str.'insuranceProduct/getinsurance_CompanyDept';  // 보험사 부서명 가져오기
$route['getInsuranceCompanyDeptNameListByInsuranceCompanyCate'] = $str.'insuranceProduct/getInsuranceCompanyDeptNameListByInsuranceCompanyCate';
$route['getInsuranceTypeListByInsuranceClassification'] = $str.'insuranceProduct/getInsuranceTypeListByInsuranceClassification';  // 보험 종목 가져오기
//$route['getInsuranceTypeListByInsuranceClassification'] = $str.'insuranceProduct/abc123'; //getInsuranceTypeListByInsuranceClassification';  // 보험 종목 가져오기
$route['abc123'] = $str.'insuranceProduct/abc123';
// ----------------- 보험사 관리 페이지 Customer E -----------------


// ----------------- 관리자 관리 페이지 Admin & Department S -----------------
// 관리자 관리 페이지 Member
$route['member'] = $str.'member/list';  // 관리자 리스트
$route['member_view'] = $str.'member/view';   // 관리자 상세보기
$route['member_view/(:any)'] = $str.'member/view/$1';  // 관리자 상세보기
$route['member_reg'] = $str.'member/reg';   // 관리자 등록

// 해당 부서의 맴버가져오기 ( ajax )
$route['member_SelectBox'] = $str.'member/member_SelectBox';  // 해당 부서의 맴버가져오기
// ----------------- 관리자 관리 페이지 Admin & Department E -----------------



// ************************************************************************************************
// ************************************************************************************************
// ************************************************************************************************
// 
//                                            ERP                                                  
//
// ************************************************************************************************
// ************************************************************************************************
// ************************************************************************************************
/*


<li class="list-item <?=($menuNo[0]==2)?"active":""?>"><span>회계관리</span>
            <ul class="items">
                <li class="<?=($menuNo[0]==2 && $menuNo[1]==1)?"on":""?>"><a href="/salesBreakdown">매출</a></li>
                <li class="<?=($menuNo[0]==2 && $menuNo[1]==2)?"on":""?>"><a href="/purchaseBreakdown">매입</a></li>
                <li class="<?=($menuNo[0]==2 && $menuNo[1]==2)?"on":""?>"><a href="/cardBreakdown">카드사용내역</a></li>
            </ul>
        </li>
        
        <li class="list-item <?=($menuNo[0]==3)?"active":""?>"><span>계약관리</span>
            <ul class="items">
                <li class="<?=($menuNo[0]==3 && $menuNo[1]==1)?"on":""?>"><a href="/">보험료 매출/수익</a></li>
                <li class="<?=($menuNo[0]==3 && $menuNo[1]==2)?"on":""?>"><a href="/">계약업로드</a></li>
            </ul>
        </li>
        <li class="list-item <?=($menuNo[0]==4)?"active":""?>"><span>기초 정보 관리</span>
            <ul class="items">
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==1)?"on":""?>"><a href="/cardUploadBreakdown">법인카드 내역 업로드</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==2)?"on":""?>"><a href="/purchaseUploadBreakdown">매입 내역 업로드</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==2)?"on":""?>"><a href="/salesUploadBreakdown">매출 내역 업로드</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==3)?"on":""?>"><a href="/">거래처 정보</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==3)?"on":""?>"><a href="/">보험사 정보</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==3)?"on":""?>"><a href="/">보험상품 정보</a></li>
                <li class="<?=($menuNo[0]==4 && $menuNo[1]==3)?"on":""?>"><a href="/">회원 정보</a></li>
            </ul>
        </li>




*/

// ERP 접속시 기본 페이지를 ERP 로 이동
if(($_SERVER['HTTP_HOST'] == "erp.localhost.com" && $_SERVER['REQUEST_URI'] == "/" ) || ($_SERVER['HTTP_HOST'] == "erp.toursafe.co.kr" && $_SERVER['REQUEST_URI'] == "/")){
    header("Location: /erpindex");
    exit; 
}

// ----------------- ERP 대시보드 페이지 S -----------------

// ERP 대시보드 페이지
$route['dashboard'] = $str.'erpMain/index';  // ERP 대시보드 페이지

// ajax getSalesRanking
$route['ajaxGetSalesRanking'] = $str.'erpMain/ajaxGetSalesRanking';  // ajax  getSalesRanking

// ajax getBuyRanking
$route['ajaxGetBuyRanking'] = $str.'erpMain/ajaxGetBuyRanking';  // ajax  getBuyRanking

// ajax  getSalesBuyMonthTotal
$route['getSalesBuyMonthTotal'] = $str.'erpMain/getSalesBuyMonthTotal';  // ajax  getSalesBuyMonthTotal


// ----------------- ERP 대시보드 페이지 E -----------------



// ----------------- ERP 고객 관리 페이지 Customer S -----------------
// 회계 관리 페이지 S
// 매출
//$route['erpindex'] = $str.'financialManagement/salesBreakdownList';  // 매출 리스트
$route['erpindex'] = $str.'erpMain/index';  // 매출 리스트
$route['salesBreakdown'] = $str.'financialManagement/salesBreakdownList';  // 매출 리스트
$route['salesBreakdown/(:num)'] = $str.'financialManagement/salesBreakdownList/$1';  // 매출 리스트
$route['salesBreakdown/list'] = $str.'financialManagement/salesBreakdownList/1'; // 매출 리스트
$route['salesBreakdown/list/(:num)'] = $str.'financialManagement/salesBreakdownList/$1'; // 매출 리스트
$route['salesBreakdown/list/(:num)/(:any)'] = $str.'financialManagement/salesBreakdownList/$1/$2'; // 매출 리스트
$route['salesBreakdown_view'] = $str.'financialManagement/salesBreakdownView';   // 매출 상세보기
$route['salesBreakdown_view/(:any)'] = $str.'financialManagement/salesBreakdownView/$1';  // 매출 상세보기
$route['salesBreakdown_reg'] = $str.'financialManagement/salesBreakdownReg';  // 매출 등록
$route['salesBreakdown_reg_ajax'] = $str.'financialManagement/salesBreakdownRegProc';  // 매출 등록 ajax
$route['salesBreakdownRegProc'] = $str.'financialManagement/salesBreakdownRegProc';  // 매출 등록 처리

// 매입
$route['purchaseBreakdown'] = $str.'financialManagement/purchaseBreakdownList';  // 매입 리스트
$route['purchaseBreakdown/(:num)'] = $str.'financialManagement/purchaseBreakdownList/$1';  // 매입 리스트
$route['purchaseBreakdown/list'] = $str.'financialManagement/purchaseBreakdownList/1'; // 매입 리스트
$route['purchaseBreakdown/list/(:num)'] = $str.'financialManagement/purchaseBreakdownList/$1'; // 매입 리스트
$route['purchaseBreakdown/list/(:num)/(:any)'] = $str.'financialManagement/purchaseBreakdownList/$1/$2'; // 매입 리스트
$route['purchaseBreakdown_view'] = $str.'financialManagement/purchaseBreakdownView';   // 매입 상세보기
$route['purchaseBreakdown_view/(:any)'] = $str.'financialManagement/purchaseBreakdownView/$1';  // 매입 상세보기
$route['purchaseBreakdown_reg'] = $str.'financialManagement/purchaseBreakdownReg';  // 매입 등록
$route['purchaseBreakdown_reg_ajax'] = $str.'financialManagement/purchaseBreakdownRegProc';  // 매입 등록 ajax
$route['purchaseBreakdownRegProc'] = $str.'financialManagement/purchaseBreakdownRegProc';  // 매입 등록 처리

// 카드사용내역
$route['breakdownlist'] = $str.'financialManagement/cardBreakdownList';
$route['breakdownlist/(:num)'] = $str.'financialManagement/cardBreakdownList/$1';
$route['breakdownlist/list'] = $str.'financialManagement/cardBreakdownList/1';
$route['breakdownlist/list/(:num)'] = $str.'financialManagement/cardBreakdownList/$1';
$route['breakdownlist/list/(:num)/(:any)'] = $str.'financialManagement/cardBreakdownList/$1/$2';

$route['cardBreakdown'] = $str.'financialManagement/cardBreakdownList';  // 카드사용내역 리스트
$route['cardBreakdown/(:num)'] = $str.'financialManagement/cardBreakdownList/$1';  // 카드사용내역 리스트
$route['cardBreakdown/list'] = $str.'financialManagement/cardBreakdownList/1'; // 카드사용내역 리스트
$route['cardBreakdown/list/(:num)'] = $str.'financialManagement/cardBreakdownList/$1'; // 카드사용내역 리스트
$route['cardBreakdown/list/(:num)/(:any)'] = $str.'financialManagement/cardBreakdownList/$1/$2'; // 카드사용내역 리스트
$route['cardBreakdown_view'] = $str.'financialManagement/cardBreakdownView';   // 카드사용내역 상세보기
$route['cardBreakdown_view/(:any)'] = $str.'financialManagement/cardBreakdownView/$1';  // 카드사용내역 상세보기
$route['cardBreakdown_reg'] = $str.'financialManagement/cardBreakdownReg';  // 카드사용내역 등록
$route['cardBreakdown_reg_ajax'] = $str.'financialManagement/cardBreakdownRegProc';  // 카드사용내역 등록 ajax
$route['cardBreakdownRegProc'] = $str.'financialManagement/cardBreakdownRegProc';  // 카드사용내역 등록 처리

// 보험사 1차가공 업로드 
$route['insuranceCompanyBreakdown'] = $str.'financialManagement/insuranceCompanyBreakdownlist';  // 보험사 1차가공 업로드 리스트
$route['insuranceCompanyBreakdown/(:num)'] = $str.'financialManagement/insuranceCompanyBreakdownlist/$1';  // 보험사 1차가공 업로드 리스트
$route['insuranceCompanyBreakdown/list'] = $str.'financialManagement/insuranceCompanyBreakdownlist/1'; // 보험사 1차가공 업로드 리스트
$route['insuranceCompanyBreakdown/list/(:num)'] = $str.'financialManagement/insuranceCompanyBreakdownlist/$1'; // 보험사 1차가공 업로드 리스트
$route['insuranceCompanyBreakdown/list/(:num)/(:any)'] = $str.'financialManagement/insuranceCompanyBreakdownlist/$1/$2'; // 보험사 1차가공 업로드 리스트




// 회계 관리 페이지 E



// 기초 정보 관리 페이지 S

// 법인카드 내역 업로드
$route['cardUploadBreakdown'] = $str.'erpBasicInfoManagement/cardUploadBreakdownList';  // 법인카드 내역 업로드 리스트
$route['cardUploadBreakdown/(:num)'] = $str.'erpBasicInfoManagement/cardUploadBreakdownList/$1';  // 법인카드 내역 업로드 리스트
$route['cardUploadBreakdown/list'] = $str.'erpBasicInfoManagement/cardUploadBreakdownList/1'; // 법인카드 내역 업로드 리스트
$route['cardUploadBreakdown/list/(:num)'] = $str.'erpBasicInfoManagement/cardUploadBreakdownList/$1'; // 법인카드 내역 업로드 리스트
$route['cardUploadBreakdown/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/cardUploadBreakdownList/$1/$2'; // 법인카드 내역 업로드 리스트
$route['cardUploadBreakdown_view'] = $str.'erpBasicInfoManagement/cardUploadBreakdownView';   // 법인카드 내역 업로드 상세보기
$route['cardUploadBreakdown_view/(:any)'] = $str.'erpBasicInfoManagement/cardUploadBreakdownView/$1';  // 법인카드 내역 업로드 상세보기
$route['cardUploadBreakdown_reg'] = $str.'erpBasicInfoManagement/cardUploadBreakdownReg';  // 법인카드 내역 업로드 등록
$route['cardUploadBreakdown_reg_ajax'] = $str.'erpBasicInfoManagement/cardUploadBreakdownRegProc';  // 법인카드 내역 업로드 등록 ajax
$route['cardUploadBreakdownRegProc'] = $str.'erpBasicInfoManagement/cardUploadBreakdownRegProc';  // 법인카드 내역 업로드 등록 처리

// 법인카드 내역 삭제
$route['cardUploadBreakdownDelProc'] = $str.'erpBasicInfoManagement/cardUploadBreakdownDelProc';  // 법인카드 내역 삭제 처리

// 업로드 내역이 있는지 확인 cardUploadBreakdownCheck
$route['cardUploadBreakdownCheck'] = $str.'erpBasicInfoManagement/cardUploadBreakdownCheck';  // 업로드 내역이 있는지 확인

// 업로드 내역이 있는지 확인 salesBuyUploadBreakdownCheck
$route['salesBuyUploadBreakdownCheck'] = $str.'erpBasicInfoManagement/salesBuyUploadBreakdownCheck';  // 업로드 내역이 있는지 확인



// 법인카드 정보
$route['cardInfo'] = $str.'erpBasicInfoManagement/cardInfoList';  // 법인카드 정보 리스트
$route['cardInfo/(:num)'] = $str.'erpBasicInfoManagement/cardInfoList/$1';  // 법인카드 정보 리스트
$route['cardInfo/list'] = $str.'erpBasicInfoManagement/cardInfoList/1'; // 법인카드 정보 리스트
$route['cardInfo/list/(:num)'] = $str.'erpBasicInfoManagement/cardInfoList/$1'; // 법인카드 정보 리스트
$route['cardInfo/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/cardInfoList/$1/$2'; // 법인카드 정보 리스트
$route['cardInfo_view'] = $str.'erpBasicInfoManagement/cardInfoView';   // 법인카드 정보 상세보기
$route['cardInfo_view/(:any)'] = $str.'erpBasicInfoManagement/cardInfoView/$1';  // 법인카드 정보 상세보기
$route['cardInfo_reg'] = $str.'erpBasicInfoManagement/cardInfoReg';  // 법인카드 정보 등록
$route['cardInfo_reg_ajax'] = $str.'erpBasicInfoManagement/cardInfoRegProc';  // 법인카드 정보 등록 ajax
$route['cardInfoRegProc'] = $str.'erpBasicInfoManagement/cardInfoRegProc';  // 법인카드 정보 등록 처리

// 법인카드 등록페이지
$route['cardInfoReg'] = $str.'erpBasicInfoManagement/cardInfoReg';  // 법인카드 등록페이지

$route['cardInfoRegProc'] = $str.'erpBasicInfoManagement/cardInfoRegProc';  // 법인카드 등록 백엔드페이지

// 법인카드 수정페이지
$route['cardInfoEdit/(:num)'] = $str.'erpBasicInfoManagement/cardInfoEdit/$1';  // 법인카드 수정페이지
$route['cardInfoEdit/'] = $str.'erpBasicInfoManagement/cardInfoEdit/$1';  // 법인카드 수정페이지
$route['cardInfoEdit'] = $str.'erpBasicInfoManagement/cardInfoEdit/$1';  // 법인카드 수정페이지


// 법인카드 수정 proc
$route['cardInfoEditProc'] = $str.'erpBasicInfoManagement/cardInfoEditProc';  // 법인카드 수정 proc

// 매입 내역 업로드
$route['purchaseUploadBreakdown'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownList';  // 매입 내역 업로드 리스트
$route['purchaseUploadBreakdown/(:num)'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownList/$1';  // 매입 내역 업로드 리스트
$route['purchaseUploadBreakdown/list'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownList/1'; // 매입 내역 업로드 리스트
$route['purchaseUploadBreakdown/list/(:num)'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownList/$1'; // 매입 내역 업로드 리스트
$route['purchaseUploadBreakdown/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownList/$1/$2'; // 매입 내역 업로드 리스트
$route['purchaseUploadBreakdown_view'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownView';   // 매입 내역 업로드 상세보기
$route['purchaseUploadBreakdown_view/(:any)'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownView/$1';  // 매입 내역 업로드 상세보기
$route['purchaseUploadBreakdown_reg'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownReg';  // 매입 내역 업로드 등록
$route['purchaseUploadBreakdown_reg_ajax'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownRegProc';  // 매입 내역 업로드 등록 ajax
$route['purchaseUploadBreakdownRegProc'] = $str.'erpBasicInfoManagement/purchaseUploadBreakdownRegProc';  // 매입 내역 업로드 등록 처리

// 매출 내역 업로드
$route['salesUploadBreakdown'] = $str.'erpBasicInfoManagement/salesUploadBreakdownList';  // 매출 내역 업로드 리스트
$route['salesUploadBreakdown/(:num)'] = $str.'erpBasicInfoManagement/salesUploadBreakdownList/$1';  // 매출 내역 업로드 리스트
$route['salesUploadBreakdown/list'] = $str.'erpBasicInfoManagement/salesUploadBreakdownList/1'; // 매출 내역 업로드 리스트
$route['salesUploadBreakdown/list/(:num)'] = $str.'erpBasicInfoManagement/salesUploadBreakdownList/$1'; // 매출 내역 업로드 리스트
$route['salesUploadBreakdown/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/salesUploadBreakdownList/$1/$2'; // 매출 내역 업로드 리스트
$route['salesUploadBreakdown_view'] = $str.'erpBasicInfoManagement/salesUploadBreakdownView';   // 매출 내역 업로드 상세보기
$route['salesUploadBreakdown_view/(:any)'] = $str.'erpBasicInfoManagement/salesUploadBreakdownView/$1';  // 매출 내역 업로드 상세보기
$route['salesUploadBreakdown_reg'] = $str.'erpBasicInfoManagement/salesUploadBreakdownReg';  // 매출 내역 업로드 등록
$route['salesUploadBreakdown_reg_ajax'] = $str.'erpBasicInfoManagement/salesUploadBreakdownRegProc';  // 매출 내역 업로드 등록 ajax
$route['salesUploadBreakdownRegProc'] = $str.'erpBasicInfoManagement/salesUploadBreakdownRegProc';  // 매출 내역 업로드 등록 처리


// 보험사에서 받은 엑셀 1차 가공분 업로드 페이지 insuranceComExcelUpload
$route['insuranceCompanyExcelUpload'] = $str.'erpBasicInfoManagement/insuranceCompanyExcelUpload';  // 보험사에서 받은 엑셀 1차 가공분 업로드 페이지
$route['insuranceCompanyExcelUploadRegProc'] = $str.'erpBasicInfoManagement/insuranceCompanyExcelUploadRegProc';  // 보험사에서 받은 엑셀 1차 가공분 업로드 페이지



// 회원 정보
$route['erpMemberInfo'] = $str.'erpBasicInfoManagement/erpMemberInfoList';  // 회원 정보 리스트
$route['erpMemberInfo/(:num)'] = $str.'erpBasicInfoManagement/erpMemberInfoList/$1';  // 회원 정보 리스트
$route['erpMemberInfo/list'] = $str.'erpBasicInfoManagement/erpMemberInfoList/1'; // 회원 정보 리스트
$route['erpMemberInfo/list/(:num)'] = $str.'erpBasicInfoManagement/erpMemberInfoList/$1'; // 회원 정보 리스트
$route['erpMemberInfo/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/erpMemberInfoList/$1/$2'; // 회원 정보 리스트
$route['erpMemberInfo_view'] = $str.'erpBasicInfoManagement/erpMemberInfoView';   // 회원 정보 상세보기
$route['erpMemberInfo_view/(:any)'] = $str.'erpBasicInfoManagement/erpMemberInfoView/$1';  // 회원 정보 상세보기
$route['erpMemberInfo_reg'] = $str.'erpBasicInfoManagement/erpMemberInfoReg';  // 회원 정보 등록
$route['erpMemberInfo_reg_ajax'] = $str.'erpBasicInfoManagement/erpMemberInfoRegProc';  // 회원 정보 등록 ajax
$route['erpMemberInfoRegProc'] = $str.'erpBasicInfoManagement/erpMemberInfoRegProc';  // 회원 정보 등록 처리

// 거래처 정보
$route['erpCustomerInfo'] = $str.'erpBasicInfoManagement/erpCustomerInfoList';  // 거래처 정보 리스트
$route['erpCustomerInfo/(:num)'] = $str.'erpBasicInfoManagement/erpCustomerInfoList/$1';  // 거래처 정보 리스트
$route['erpCustomerInfo/list'] = $str.'erpBasicInfoManagement/erpCustomerInfoList/1'; // 거래처 정보 리스트
$route['erpCustomerInfo/list/(:num)'] = $str.'erpBasicInfoManagement/erpCustomerInfoList/$1'; // 거래처 정보 리스트
$route['erpCustomerInfo/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/erpCustomerInfoList/$1/$2'; // 거래처 정보 리스트
$route['erpCustomerInfo_view'] = $str.'erpBasicInfoManagement/erpCustomerInfoView';   // 거래처 정보 상세보기
$route['erpCustomerInfo_view/(:any)'] = $str.'erpBasicInfoManagement/erpCustomerInfoView/$1';  // 거래처 정보 상세보기
$route['erpCustomerInfo_reg'] = $str.'erpBasicInfoManagement/erpCustomerInfoReg';  // 거래처 정보 등록
$route['erpCustomerInfo_reg_ajax'] = $str.'erpBasicInfoManagement/erpCustomerInfoRegProc';  // 거래처 정보 등록 ajax
$route['erpCustomerInfoRegProc'] = $str.'erpBasicInfoManagement/erpCustomerInfoRegProc';  // 거래처 정보 등록 처리


// 보험사 정보
$route['erpInsuranceCompanyInfo'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoList';  // 보험사 정보 리스트
$route['erpInsuranceCompanyInfo/(:num)'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoList/$1';  // 보험사 정보 리스트
$route['erpInsuranceCompanyInfo/list'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoList/1'; // 보험사 정보 리스트
$route['erpInsuranceCompanyInfo/list/(:num)'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoList/$1'; // 보험사 정보 리스트
$route['erpInsuranceCompanyInfo/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoList/$1/$2'; // 보험사 정보 리스트
$route['erpInsuranceCompanyInfo_view'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoView';   // 보험사 정보 상세보기
$route['erpInsuranceCompanyInfo_view/(:any)'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoView/$1';  // 보험사 정보 상세보기
$route['erpInsuranceCompanyInfo_reg'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoReg';  // 보험사 정보 등록
$route['erpInsuranceCompanyInfo_reg_ajax'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoRegProc';  // 보험사 정보 등록 ajax
$route['erpInsuranceCompanyInfoRegProc'] = $str.'erpBasicInfoManagement/erpInsuranceCompanyInfoRegProc';  // 보험사 정보 등록 처리

// 보험상품 정보
$route['erpInsuranceProductInfo'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoList';  // 보험상품 정보 리스트
$route['erpInsuranceProductInfo/(:num)'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoList/$1';  // 보험상품 정보 리스트
$route['erpInsuranceProductInfo/list'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoList/1'; // 보험상품 정보 리스트
$route['erpInsuranceProductInfo/list/(:num)'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoList/$1'; // 보험상품 정보 리스트
$route['erpInsuranceProductInfo/list/(:num)/(:any)'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoList/$1/$2'; // 보험상품 정보 리스트
$route['erpInsuranceProductInfo_view'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoView';   // 보험상품 정보 상세보기
$route['erpInsuranceProductInfo_view/(:any)'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoView/$1';  // 보험상품 정보 상세보기
$route['erpInsuranceProductInfo_reg'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoReg';  // 보험상품 정보 등록
$route['erpInsuranceProductInfo_reg_ajax'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoRegProc';  // 보험상품 정보 등록 ajax
$route['erpInsuranceProductInfoRegProc'] = $str.'erpBasicInfoManagement/erpInsuranceProductInfoRegProc';  // 보험상품 정보 등록 처리



$route['exceldown'] = $str.'erpBasicInfoManagement/excelDown/';  // 엑셀 다운로드




// 기초 정보 관리 페이지 E

