<script type="text/javascript">
    // 달력 script
    $(document).ready(function() {
        $("#register_date").datepicker({
            dateFormat: "yy-mm-dd",
            buttonImage: "../assets/img/service/icon-calendar.svg?e",
            showOtherMonths: true,
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        });
    });

    $(document).ready(function() {
        $("#comprehensiveStartDate").datepicker({
            dateFormat: "yy-mm-dd",
            buttonImage: "../assets/img/service/icon-calendar.svg?e",
            showOtherMonths: true,
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        });
    });

    $(document).ready(function() {
        $("#comprehensiveEndDate").datepicker({
            dateFormat: "yy-mm-dd",
            buttonImage: "../assets/img/service/icon-calendar.svg?e",
            showOtherMonths: true,
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        });
    });
</script>
<div class="conts-box">
    <div class="titleArea">
        <h1>거래처 추가</h1>
    </div>
    
    <!-- form -->
    <form name="customerRegForm" id="customerRegForm" method="get" action="/erpCustomerInfo_reg">
        
        <!-- regBox -->
        <section class="regBox" style="max-width: 1200px;">
            <!-- erpList reg -->
            <article class="erpList reg">
                <div class="titleArea">
                    <h2 class="thirdTitle">기초정보</h2>
                </div>
                <table>
                    <caption>
                        거래처코드, 상태, 거래처명, 대표자명, 사업자번호, 주민등록번호, 대표번호, 등록일, 내부지정 담당자, 주소, 상세주소 등의 정보를 입력합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 175px;">
                        <col style="width: 300px;">
                        <col style="width: 175px;">
                        <col style="width: 300px;">
                    </colgroup>
                    <tbody>

                        <tr>
                            <th scope="row">
                                <label for="corporateCodeType" class="essential">
                                    거래처코드
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="corporateCodeType" id="corporateCodeType" required>
                                            <option value="" selected>거래처유형 선택</option>
                                            <option value="corporateP">P - 개인사업자</option>
                                            <option value="corporateT">T - 여행사</option>
                                            <option value="corporateC">C - 법인사업자</option>
                                            <option value="corporateM">M - 매집</option>
                                            <option value="corporateS">S - 설계사</option>
                                            <option value="corporateB">B - B2C개인</option>
                                            <option value="corporateE">E - 기타</option>
                                        </select>
                                    </div>
                                    <span class="between"></span>
                                    <!-- //select-custom -->
                                    <input type="text" name="corporateCodeNumber" id="corporateCodeNumber" class="onlyNumber" autocomplete="off" required placeholder="코드를 입력하세요.">
                                </div>
                            </td>

                            <th scope="row">
                                <label for="status" class="essential">
                                    상태
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="status" id="status" required>
                                            <option value="" selected>선택하세요</option>
                                            <option value="statusAdd">신규</option>
                                            <option value="statusClosure">폐업</option>
                                            <option value="statusChange">상호변경</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                    <span class="between"></span>
                                    <input type="text" name="statusChangeName" id="statusChangeName" autocomplete="off" disabled>
                                </div>
                                
                            </td>
                        </tr>

                        <!-- <tr>
                            <th scope="row">
                                <label for="corporate" class="essential">
                                    거래처구분
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="radiobox">
                                        <input type="radio" name="corporateType" class="radio-custom" value="corporate" id="corporate" required>
                                        <label for="corporate" class="radio-custom-label">법인사업자</label>
                                    </div>

                                    <div class="radiobox">
                                        <input type="radio" name="corporateType" class="radio-custom" value="individual" id="individual">
                                        <label for="individual" class="radio-custom-label">개인사업자</label>
                                    </div>

                                    <div class="radiobox">
                                        <input type="radio" name="corporateType" class="radio-custom" value="personal" id="personal">
                                        <label for="personal" class="radio-custom-label">개인</label>
                                    </div>
                                </div>
                            </td>

                            <th scope="row">
                                <label for="business_b2b" class="essential">
                                    거래방법
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="checkbox">
                                        <input type="checkbox" name="business_b2b" id="business_b2b" value="b2b" class="checkbox-custom">
                                        <label for="business_b2b" class="checkbox-custom-label">B2B</label>
                                    </div>

                                    <div class="checkbox">
                                        <input type="checkbox" name="business_b2c" id="business_b2c" value="b2c" class="checkbox-custom">
                                        <label for="business_b2c" class="checkbox-custom-label">B2C</label>
                                    </div>

                                    <div class="checkbox">
                                        <input type="checkbox" name="business_b2b2c" id="business_b2b2c" value="b2b2c" class="checkbox-custom">
                                        <label for="business_b2b2c" class="checkbox-custom-label">B2B2C</label>
                                    </div>
                                </div>
                                
                            </td>
                        </tr> -->

                        <tr>
                            <th scope="row">
                                <label for="business_name" class="essential">
                                    거래처명
                                </label>
                            </th>
                            <td>
                                <input type="text" id="business_name" name="business_name" value="" placeholder="거래처명을 입력하세요" required>
                            </td>

                            <th scope="row">
                                <label for="represent_name" class="essential">
                                    대표자명
                                </label>
                            </th>
                            <td>
                                <input type="text" id="represent_name" name="represent_name" value="" placeholder="대표자명을 입력하세요" required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="business_number">
                                    사업자번호
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <input type="text" name="business_number" id="business_number" value="" maxlength="12" disabled>
                                    <!-- 사업자 번호 체크 -->
                                    <input type="hidden" name="business_number_ok" id="business_number_ok" value="0">
                                    <span id="business_number_ok_msg" class="ok"></span>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="resident_number">
                                    주민등록번호
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <!-- 최대로 입력 받는 글자수 제한 -->
                                    <input type="text" name="resident_number" id="resident_number" value="" maxlength="14" disabled>
                                    <input type="hidden" name="resident_number_ok" id="resident_number_ok" value="0">
                                    <span name="resident_number_check" id="resident_number_check" style="width:300px;"></span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="represent_number" class="essential">
                                    대표번호
                                </label>
                            </th>
                            <td>
                                <input type="text" id="represent_number" name="represent_number" value="" maxlength="13" placeholder="대표번호를 입력하세요." onkeyup="callautoHypenPhone(this);" required>
                            </td>
                            <th>
                                <label for="register_date" class="essential">
                                    등록일
                                </label>
                            </th>
                            <td>
                            <input type="text" class="picker register_date" name="register_date" id="register_date"  placeholder="YYYY-MM-DD" maxlength="10" required>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="company_manager">
                                    내부 지정 담당자
                                </label>
                            </th>
                            <td>
                                <!-- select-custom -->
                                <div class="select-custom">
                                    <select name="company_manager" id="company_manager">
                                        <option value="" selected>담당자를 선택하세요.</option>
                                        <option value="">세글자</option>
                                        <option value="">다섯자이름</option>
                                        <option value="">여섯글자이름</option>
                                    </select>
                                </div>
                                <!-- //select-custom -->
                            </td>
                            <th>
                                <label for="accumulateYN">
                                    매집여부
                                </label>
                            </th>
                            <td>
                                <!-- select-custom -->
                                <div class="select-custom">
                                    <select name="accumulateYN" id="accumulateYN">
                                        <option value="accumulateN" selected>N</option>
                                        <option value="accumulateY">Y</option>
                                    </select>
                                </div>
                                <!-- //select-custom -->
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="searchaddr" class="essential">
                                    주소
                                </label>
                            </th>
                            <td colspan="3">
                                <div class="address">
                                    <input type="text" name="road_address" id="road_address" placeholder="우편번호 찾기" value="">
                                    <input type="hidden" name="postcode" id="postcode" readonly value="">
                                    <input type="hidden" name="jibun_address" id="jibun_address" readonly>
                                    <input type="hidden" name="extra_address" id="extra_address" placeholder="참고항목">
                                    <button type="button" class="searchaddr" id="searchaddr" onclick="sample4_execDaumPostcode()">주소검색</button>
                                    <input type="text" name="detail_address" id="detail_address" placeholder="상세주소 입력" value="" required>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <!-- //erpList reg -->

            <!-- erpList reg -->
            <article class="memb-table erpList reg center">
                <div class="titleArea">
                    <h2 class="thirdTitle">담당자 관리</h2>
                    <div class="btnArea rightArea">
                        <button type="button" class="btn file trAddSingle" title="1행 추가">
                            행 추가(+1)
                        </button>
                        <button type="button" class="btn file trAddThird" title="3행 추가">
                            행 추가(+3)
                        </button>
                    </div>
                </div>
                <table id="trInsertTable">
                    <caption>
                        담당자 관리 테이블로 성명, 연락처, 이메일, 네이트온명, 네이트온 이메일 보험사ID 등의 정보를 입력합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 80px;">
                        <col style="width: 100px;">
                        <col style="width: 120px;">
                        <col style="width: 160px;">
                        <col style="width: 160px;">
                        <col style="width: 160px;">
                        <col style="width: auto;">
                        <col style="width: 80px;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">순번</th>
                            <th scope="col">이름</th>
                            <th scope="col">연락처</th>
                            <th scope="col">이메일</th>
                            <th scope="col">네이트온명</th>
                            <th scope="col">네이트온 이메일</th>
                            <th scope="col">보험사ID</th>
                            <th scope="col">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <input type="text" name="manager_name0" id="manager_name0" placeholder="이름">
                            </td>
                            <td>
                                <input type="tel" name="manager_tel0" id="manager_tel0" placeholder="010-1234-5678" maxlength="13" onkeyup="callautoHypenPhone(this);">
                            </td>
                            <td>
                                <input type="email" name="manager_email0" id="manager_email0" placeholder="이메일">
                            </td>
                            <td>
                                <input type="text" name="manager_nate_name0" id="manager_nate_name0" placeholder="네이트온명">
                            </td>
                            <td>
                                <input type="email" name="manager_nate_email0" id="manager_nate_email0" placeholder="네이트온 이메일">
                            </td>

                            <td>
                                <div class="inputArea">
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="insuranceName0" id="insuranceName0">
                                            <option value="" selected>선택</option>
                                            <option value="">test01</option>
                                            <option value="">test02</option>
                                            <option value="">test03</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                    <input type="text" name="insuranceId0" id="insuranceId0" placeholder="ID">
                                    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <!-- //erpList reg -->

            <!-- erpList reg -->
            <article class="erpList reg">
                <div class="titleArea">
                    <h2 class="thirdTitle">정산정보</h2>
                </div>
                <table>
                    <caption>
                        정산정보 테이블로, 인보이스발행, 정산주기, 커미션지급일, 커미션지급정보, 결제정보, 세금계산서 등의 정보를 입력합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: auto;">
                        <col style="width: 120px;">
                        <col style="width: auto;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="basicType">
                                    인보이스 발행
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="invoiceType" class="radio-custom" value="basicType" id="basicType">
                                        <label for="basicType" class="radio-custom-label">발행</label>
                                    </div>
                                    <!-- //radiobox -->

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="invoiceType" class="radio-custom" value="accumulateType" id="accumulateType">
                                        <label for="accumulateType" class="radio-custom-label">매집발행</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <!-- <input type="text" name="accumulateContents" id="accumulateContents" disabled> -->

                                    <!-- select-custom -->
                                    <div class="select-custom" style="max-width: 120px;">
                                        <select name="accumulateContents" id="accumulateContents" disabled>
                                            <option value="" selected>선택</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="invoiceType" class="radio-custom" value="etcType" id="etcType">
                                        <label for="etcType" class="radio-custom-label">기타</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <input type="text" name="etcContents" id="etcContents" disabled>
                                    
                                </div>
                            </td>

                            <th scope="row" rowspan="2">
                                <label for="invoiceEmail">이메일</label>
                            </th>

                            <td>
                                <div class="checkArea">
                                    <input type="email" name="invoiceEmail" id="invoiceEmail" placeholder="수신자 이메일">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="taxBillPublished">세금계산서</label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="taxBill" class="radio-custom" value="taxBillPublished" id="taxBillPublished">
                                        <label for="taxBillPublished" class="radio-custom-label">발행</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <div class="checkbox">
                                        <input type="checkbox" name="otherTax" id="otherTax" value="otherTax" class="checkbox-custom" disabled>
                                        <label for="otherTax" class="checkbox-custom-label">기타소득세</label>
                                    </div>

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="taxBill" class="radio-custom" value="taxBillUnPublished" id="taxBillUnPublished">
                                        <label for="taxBillUnPublished" class="radio-custom-label">미발행</label>
                                    </div>
                                    <!-- //radiobox -->
                                </div>
                            </td>
                            
                            <td>
                                <div class="checkArea">
                                    <input type="text" name="invoiceReferrer" id="invoiceReferrer" placeholder="참조자 이메일">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="settleMonth">
                                    정산주기
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="settleTerm" class="radio-custom" value="settleMonth" id="settleMonth">
                                        <label for="settleMonth" class="radio-custom-label">월정산</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="settleTerm" class="radio-custom" value="settleCase" id="settleCase">
                                        <label for="settleCase" class="radio-custom-label">건정산</label>
                                    </div>
                                    <!-- //radiobox -->

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="settleTerm" class="radio-custom" value="settleEtc" id="settleEtc">
                                        <label for="settleEtc" class="radio-custom-label">기타</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <input type="text" name="settleEtcContents" id="settleEtcContents" disabled>
                                </div>
                            </td>

                            <th scope="row">
                                <label for="commissionChubb">
                                    커미션 지급일
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">

                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="commissionDate" class="radio-custom" value="commissionChubb" id="commissionChubb">
                                        <label for="commissionChubb" class="radio-custom-label">21일(CHUBB)</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="commissionDate" class="radio-custom" value="commissionLast" id="commissionLast">
                                        <label for="commissionLast" class="radio-custom-label">말일</label>
                                    </div>
                                    <!-- //radiobox -->


                                    <!-- radiobox -->
                                    <div class="radiobox">
                                        <input type="radio" name="commissionDate" class="radio-custom" value="commissionEtc" id="commissionEtc">
                                        <label for="commissionEtc" class="radio-custom-label">기타</label>
                                    </div>
                                    <!-- //radiobox -->
                                    <input type="text" name="commissionEtcContents" id="commissionEtcContents" disabled>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="bankNumber">
                                    커미션 지급정보
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <input type="number" name="bankNumber" id="bankNumber" placeholder="계좌번호 입력">
                                </div>
                            </td>
                            <th scope="row">
                                <label for="accountHolder">
                                    예금주/은행명
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <input type="text" name="accountHolder" id="accountHolder" placeholder="예금주 입력" style="text-align: center;">
                                    <span class="between">/</span>
                                    <input type="text" name="bankCompany" id="bankCompany" placeholder="은행명 입력" style="text-align: center;">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="numberFirst">
                                    결제정보
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="inputArea">
                                        <!-- data-length : 카드번호 or 유효기간 자릿수 구분을 위함 -->
                                        <input type="number" name="numberFirst" id="numberFirst" value="" data-length="4" placeholder="XXXX">
                                        <span class="between">-</span>
                                        <input type="number" name="numberSecond" id="numberSecond" value="" data-length="4" placeholder="XXXX">
                                        <span class="between">-</span>
                                        <input type="number" name="numberThird" id="numberThird" value="" data-length="4" placeholder="XXXX">
                                        <span class="between">-</span>
                                        <input type="number" name="numberFourth" id="numberFour" value="" data-length="4" placeholder="XXXX">
                                    </div>
                                </div>
                            </td>
                            
                            <th>
                                <label for="ValidM">
                                    유효기간/결제일
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="inputArea">
                                        <!-- data-length : 카드번호 or 유효기간 자릿수 구분을 위함 -->
                                        <input type="number" id="ValidM" name="ValidM" value="" placeholder="MM" data-length="2">
                                        <span class="between">-</span>
                                        <input type="number" id="ValidY" name="ValidY" value="" placeholder="YY" data-length="2">
                                    </div>
                                    <span class="between">/</span>
                                    <div class="inputArea">
                                        <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="paymentDays" style="text-align: center;">
                                            <option value="">날짜</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value=10>10</option>
                                            <option value=11>11</option>
                                            <option value=12>12</option>
                                            <option value=13>13</option>
                                            <option value=14>14</option>
                                            <option value=15>15</option>
                                            <option value=16>16</option>
                                            <option value=17>17</option>
                                            <option value=18>18</option>
                                            <option value=19>19</option>
                                            <option value=20>20</option>
                                            <option value=21>21</option>
                                            <option value=22>22</option>
                                            <option value=23>23</option>
                                            <option value=24>24</option>
                                            <option value=25>25</option>
                                            <option value=26>26</option>
                                            <option value=27>27</option>
                                            <option value=28>28</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <!-- //erpList reg -->


            <!-- erpList reg -->
            <article class="memb-table erpList reg center">
                <div class="titleArea">
                    <h2 class="thirdTitle">보험사/상품(수수료) 관리</h2>
                    <!-- btnArea -->
                    <div class="btnArea rightArea">
                            <button type="button" class="btn file" id="addCommissionBtn" title="추가">
                                수수료 추가
                            </button>
                        </div>
                        <!-- //btnArea -->
                </div>

                <!-- <article class="searchArea">
                    <div class="inputArea upload">
                        <div class="select-custom">
                            <select name="addCompany" id="addCompany">
                                <option value="" selected>보험사 선택</option>
                                <option value="test01">CHUBB</option>
                                <option value="test02">CHUBB2</option>
                                <option value="test03">CHIBB3</option>
                            </select>
                        </div>

                        <div class="select-custom">
                            <select name="addProduct" id="addProduct">
                                <option value="" selected>상품 선택</option>
                                <option value="test01-01">상품1</option>
                                <option value="test02-01">상품2</option>
                                <option value="test03-01">상품3</option>
                            </select>
                        </div>

                        <label for="addCommission">
                            <input type="number" name="addCommission" id="addCommission" placeholder="수수료(%)" autocomplete="off" style="width: 60px;">
                        </label>

                        
                    </div>
                </article> -->
                
                <table>
                    <caption>
                        보험사명 별, 상품명 별, 수수료(%) 정보를 입력합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 80px;">
                        <col style="width: auto">
                        <col style="width: auto">
                        <col style="width: 150px;">
                        <col style="width: 80px;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">순번</th>
                            <th scope="col">보험사</th>
                            <th scope="col">상품</th>
                            <th scope="col">수수료(%)</th>
                            <th scope="col">관리</th>
                        </tr>
                    </thead>
                    <tbody id="addBody">

                    </tbody>
                </table>
            </article>
            <!-- //erpList reg -->


            <!-- erpList reg -->
            <article class="memb-table erpList reg center">
                    <div class="titleArea">
                        <h2 class="thirdTitle">포괄계약 정보</h2>
                    </div>
                    <table>
                        <caption>
                            포괄계약정보 테이블로 보험사, 증권번호(포괄용), 개시일, 만료일, 예치금 등의 정보를 입력합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 200px;">
                            <col style="width: 200;">
                            <col style="width: 100;">
                            <col style="width: 100;">
                            <col style="width: auto;">
                        </colgroup>
                        
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label for="comprehensiveInsuranceName">
                                        보험사
                                    </label>
                                </th>
                                <th scope="col">
                                    <label for="comprehensiveInsuranceNumber">
                                        증권번호(포괄용)
                                    </label>
                                </th>
                                <th scope="col">
                                    <label for="comprehensiveStartDate">
                                        개시일
                                    </label>
                                </th>
                                <th scope="col">
                                    <label for="comprehensiveEndDate">
                                        만료일
                                    </label>
                                </th>
                                <th scope="col">
                                    <label for="deposit">
                                        예치금
                                    </label>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                
                                <td>
                                    <!-- <input type="text" name="comprehensiveInsuranceName" id="comprehensiveInsuranceName" placeholder="포괄계약 보험사명"> -->
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="comprehensiveInsuranceName" id="comprehensiveInsuranceName">
                                            <option value="" selected>포괄계약 보험사 선택</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                </td>
                                <td>
                                    <!-- <input type="text" name="comprehensiveInsuranceNumber" id="comprehensiveInsuranceNumber" placeholder="포괄계약 증권번호"> -->
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="comprehensiveInsuranceNumber" id="comprehensiveInsuranceNumber">
                                            <option value="" selected>포괄계약 증권번호 선택</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                </td>
                                <td>
                                    <input type="text" class="picker" name="comprehensiveStartDate" id="comprehensiveStartDate" placeholder="포괄계약 개시일">
                                </td>
                                <td>
                                    <input type="text" class="picker" name="comprehensiveEndDate" id="comprehensiveEndDate" placeholder="포괄계약 만료일">
                                </td>
                                <td>
                                    <input type="text" name="deposit" id="deposit" class="comma" placeholder="예치금">
                                </td>

                        </tbody>
                    </table>
                </article>
                <!-- //erpList reg -->
            

            <div class="inputBox">
                <a href="/erpCustomerInfo" class="btn list">목록</a>
                <label for="inputAdd">
                    <input type="submit" id="inputAdd" class="btn search" value="등록" title="등록">
                </label>
            </div>
        </section>
        <!-- //regBox -->

    </form>
    <!-- //form -->
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
    
    
    // 거래처코드 select 선택에 따른 input 활성화&비활성화
    document.getElementById('corporateCodeType').addEventListener('change', function(event){
        // 엘리먼트 추적
        let selectValue = event.target.value;
        let business_number_ok_msg = $("#business_number_ok_msg");
        let resident_number_check = $("#resident_number_check");
        
        // 사업자번호
        let businessNumber = document.getElementById('business_number');
        // 주민등록번호
        let residentNumber = document.getElementById('resident_number');

        // 개인사업자가 아닌경우 (사업자번호 입력폼 활성화)
        if (selectValue !== 'corporateP' && selectValue !== '') {
            
            businessNumber.removeAttribute('disabled');
            businessNumber.setAttribute('placeholder','123-45-67890');

            residentNumber.removeAttribute('placeholder');
            residentNumber.setAttribute('disabled','disabled');
            residentNumber.value = null;
            resident_number_check.html('');
        
        // 개인사업자일때 (주민등록번호 입력폼 활성화)
        } else if (selectValue == 'corporateP') {

            residentNumber.removeAttribute('disabled');
            residentNumber.setAttribute('placeholder','123456-1234567');

            businessNumber.removeAttribute('placeholder');
            businessNumber.setAttribute('disabled','disabled');
            businessNumber.value = null;
            business_number_ok_msg.html('');
            
        // 선택없음일때 (사업자, 주민등록번호 입력폼 비활성화)
        } else if (selectValue === '') {

            residentNumber.removeAttribute('placeholder');
            residentNumber.setAttribute('disabled','disabled');
            residentNumber.value = null;
            resident_number_check.html('');

            businessNumber.removeAttribute('placeholder');
            businessNumber.setAttribute('disabled','disabled');
            businessNumber.value = null;
            business_number_ok_msg.html('');
            
        }
    })

    // 상태 select 선택에 따른 input 활성화&비활성화
    document.getElementById('status').addEventListener('change', function(event){
        let selectValue = event.target.value;
        let statusChangeName = document.getElementById('statusChangeName');
    
        if (selectValue === 'statusChange') {
            statusChangeName.removeAttribute('disabled');
            statusChangeName.setAttribute('required','required');
            statusChangeName.setAttribute('placeholder','상호명을 입력하세요.');
        } else {
            statusChangeName.removeAttribute('required');
            statusChangeName.removeAttribute('placeholder');
            statusChangeName.setAttribute('disabled','disabled');
        }
    })

    // input 태그에 onlyNumber 클래스가 있으면 숫자만 입력되게
    document.addEventListener('keyup', function(event){
        if (event.target.classList.contains('onlyNumber')) {
            let inputValue = event.target.value;
            let numberValue = inputValue.replace(/[^-0-9]/g, '');
            
            event.target.value = numberValue;
        }
    })

    // input 태그에 포커스가 떠날 때 입력 필드의 값을 정리
    // (input에 입력된 문자열의 끝자리가 text일 경우 입력된 값이 출력되는것을 처리)
    document.addEventListener('focusout', function(event) {
        if (event.target.classList.contains('onlyNumber')) {
            let inputValue = event.target.value;
            let numberValue = inputValue.replace(/[^-0-9]/g, '');
            
            event.target.value = numberValue;
        }
    });
    
    // 연락처와 휴대전화번호에 자동으로 하이픈(-)을 넣어주는 함수 ( common.js 에서 가져옴 )
    function callautoHypenPhone(obj){
        var number = obj.value; // obj.value : input 태그의 value 값
        // autoHypenPhone 로 부터 리턴 받은 값을 다시 input 태그의 value 값으로 넣어준다.
        obj.value = autoHypenPhone(number);
    }

    // 법인사업자와 개인사업자 경우 business_number 에 값을 입력 받을때 마다 가입된 사업자 번호 인지 확인 한다.
    $("#business_number").keyup(function(){
        checkBizNo1();
    });

    // 개인인 경우 resident_number 에 값을 입력 받을때 마다 가입된 주민 번호 인지 확인 한다.
    $("#resident_number").keyup(function(){
        checkResidentNumber();
    });

    // resident_number 에서 포커스가 사라질 때에도 가입된 주민 번호인지 한 번 더 체크 한다.
    $("#resident_number").focusout(function(){
        checkResidentNumber();
    });

    // 가입된 사업자 번호인지 확인 하는 함수
    function checkBizNo1(){
        // 초기화
        //console.log("checkBizNo");
        $("#business_number_ok").val(0);

        var business_number = $("#business_number").val();
        var business_number_ok = $("#business_number_ok").val();
        var business_number_ok_msg = $("#business_number_ok_msg");
        var business_number_check_msg = "사용할 수 없는 사업자번호 입니다.";
        var business_number_check_msg2 = "가입 가능한 사업자번호 입니다.";
        var business_number_check_msg3 = "사업자번호를 입력해주세요.";
        var business_number_check_msg4 = "사업자번호를 정확히 입력해주세요.";

        // 사업자 번호에 하이픈(-)을 넣어준다.
        var restr = autoHypenBizNo(business_number);

        //사업자 번호 입력칸에 하이픈(-)을 넣어준다.
        $("#business_number").val(restr);

        // business_number 의 길이가 10자리가 아니면 에러 메시지를 출력한다.
        if(business_number.length != 12){
            business_number_ok_msg.html(business_number_check_msg4);
            business_number_ok_msg.css("color", "red");
            $("#business_number_ok").val(0);
            return false;
        }

        if(business_number == ''){
            business_number_ok_msg.html(business_number_check_msg3);
            business_number_ok_msg.css("color", "red");
            $("#business_number_ok").val(0);
            return false;
        } else if(business_number_ok == 1){
            business_number_ok_msg.html(business_number_check_msg2);
            business_number_ok_msg.css("color", "blue");
            $("#business_number_ok").val(1);
            return false;
        } else {
            $.ajax({
                url: "/checkBizNo",
                type: "POST",
                data: {business_number:business_number},
                dataType: "json",
                success: function(data){
                    console.log(data);
                    if(data.result == "fail"){
                        business_number_ok_msg.html(business_number_check_msg);
                        business_number_ok_msg.css("color", "red");
                        $("#business_number_ok").val(0);
                        return false;
                    } else {
                        business_number_ok_msg.html(business_number_check_msg2);
                        business_number_ok_msg.css("color", "blue");
                        $("#business_number_ok").val(1);
                        return false;
                    }

                },
                error: function(){
                    console.log("실패");
                }
            });
        }
    }

    // 가입된 주민 번호인지 확인 하는 함수
    function checkResidentNumber(){
        // 초기화
        $("#resident_number_ok").val(0);
        var resident_number = $("#resident_number").val();
        var resident_number_ok = $("#resident_number_ok").val();
        var resident_number_check = $("#resident_number_check");
        var resident_number_check_msg = "사용할 수 없는 주민번호 입니다.";
        var resident_number_check_msg2 = "가입 가능한 주민번호 입니다.";
        var resident_number_check_msg3 = "주민번호를 입력해주세요.";
        var resident_number_check_msg4 = "주민번호를 정확히 입력해주세요.";

        // 자동으로 하이픈(-)을 넣어주는 함수 ( common.js 에서 가져옴 )
        resident_number = autoHypenJuminNo(resident_number);
        $("#resident_number").val(resident_number);

        if(resident_number == ''){
            resident_number_check.html(resident_number_check_msg3);
            resident_number_check.css("color", "red");
            $("#resident_number_ok").val(0);
            return false;
        } else if(resident_number.length != 14){
            resident_number_check.html(resident_number_check_msg4);
            resident_number_check.css("color", "red");
            $("#resident_number_ok").val(0);
            return false;
        } else if(resident_number_ok == 1){
            resident_number_check.html(resident_number_check_msg2);
            resident_number_check.css("color", "blue");
            $("#resident_number_ok").val(1);
            return false;
        } else {
            $.ajax({
                url: "/checkJuminNo",
                type: "POST",
                data: {resident_number:resident_number},
                dataType: "json",
                success: function(data){
                    console.log(data);
                    if(data.result == "fail"){
                        resident_number_check.html(resident_number_check_msg);
                        resident_number_check.css("color", "red");
                        $("#resident_number_ok").val(0);
                        return false;
                    } else {
                        resident_number_check.html(resident_number_check_msg2);
                        resident_number_check.css("color", "blue");
                        $("#resident_number_ok").val(1);
                        return false;
                    }
                },
                error: function(){
                    console.log("실패");
                }
            });
        }
    }

    // .picker input에 직접 입력시 날짜 형식 하이픈 (-) 처리
    let datePickers = document.querySelectorAll(".picker");
    datePickers.forEach(datePicker => {
        // 문자열, 하이픈을 막기 위해 input event 사용
        datePicker.addEventListener("input", () => {
            // 사용자 입력값은 모두 숫자만 받는다.(나머지는 ""처리)
            let val = datePicker.value.replace(/\D/g, "");
            let leng = val.length;

            // 출력할 결과 변수
            let result = '';

            // 4개일때 - 20221 : 바로 출력
            if (leng < 5) {
                result = val;
            }
            // 5개일때 - 20221 : 2022-1 
            else if(leng < 6) {
                result += val.substring(0,4);
                result += "-";
                result += val.substring(4)
            // result = val;
            } 
            // 6개일때 - 202210 : 2022-10
            else if (leng < 7) {
                result += val.substring(0,4);
                result += "-";
                result += val.substring(4)
            }
            // 7개부터 - 2022103 : 2022-10-3 
            else {
                result += val.substring(0,4);
                result += "-";
                result += val.substring(4,6);
                result += "-";
                result += val.substring(6);
            }
            datePicker.value = result;
        })
    })
    // road_addres 클릭시 주소검색 버튼 작동
    document.getElementById("road_address").addEventListener("click", function() {
        document.getElementById("searchaddr").click();
    });


    function sample4_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postcode').value = data.zonecode;
                document.getElementById("road_address").value = roadAddr;
                document.getElementById("jibun_address").value = data.jibunAddress;
                
                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("extra_address").value = extraRoadAddr;
                } else {
                    document.getElementById("extra_address").value = '';
                }

                
            }
        }).open();
    }

    // 행추가 버튼 클릭시 생성될 태그들을 설정
    function addTableRow(trTags, startIndex, numToAdd) {
        // 엘리먼트 추적
        let trInsertTable = document.getElementById('trInsertTable'); 
        let tbodyTag = trInsertTable.querySelector('tbody'); 

        if (trTags.length + numToAdd <= 10) { 
            
            // numToAdd 값(10이하)만큼 반복하여 행을 추가
            for (let i = 0; i < numToAdd; i++) {

                // tr 생성
                let trElement = document.createElement('tr'); 
                tbodyTag.appendChild(trElement); 
                
                // td 생성 - 순번
                let tdNumber = document.createElement('td'); 
                trElement.appendChild(tdNumber); 
                let Numbering = tdNumber.innerText = startIndex + i + 1; 

                
                // td 생성 - 이름
                let tdName = document.createElement('td');
                trElement.appendChild(tdName);

                // input 생성 - 이름
                let inputName = document.createElement('input');
                inputName.type = 'text';
                inputName.name = 'manager_name' + (startIndex + i);
                inputName.id = 'manager_name' + (startIndex + i);
                inputName.placeholder = '이름';
                tdName.appendChild(inputName);

                
                // td 생성 - 연락처
                let tdTel = document.createElement('td');
                trElement.appendChild(tdTel);

                // input 생성 - 연락처
                let inputTel = document.createElement('input');
                inputTel.type = 'tel';
                inputTel.name = 'manager_tel' + (startIndex + i);
                inputTel.id = 'manager_tel' + (startIndex + i);
                inputTel.placeholder = '010-1234-5678';
                inputTel.maxLength = 13;
                inputTel.addEventListener('input', function() {
                    callautoHypenPhone(this);
                });
                tdTel.appendChild(inputTel);


                // td 생성 - 이메일
                let tdEmail = document.createElement('td');
                trElement.appendChild(tdEmail);
                
                // input 생성 - 이메일
                let inputEmail = document.createElement('input');
                inputEmail.type = 'email';
                inputEmail.name = 'manager_email' + (startIndex + i);
                inputEmail.id = 'manager_email' + (startIndex + i);
                inputEmail.placeholder = '이메일';
                tdEmail.appendChild(inputEmail);


                // td 생성 - 네이트온명
                let tdNateName = document.createElement('td');
                trElement.appendChild(tdNateName);

                // input 생성 - 네이트온명
                let inputNateName = document.createElement('input');
                inputNateName.type = 'text';
                inputNateName.name = 'manager_nate_name' + (startIndex + i);
                inputNateName.id = 'manager_nate_name' + (startIndex + i);
                inputNateName.placeholder = '네이트온명';
                tdNateName.appendChild(inputNateName);


                // td 생성 - 네이트온 이메일
                let tdNateEmail = document.createElement('td');
                trElement.appendChild(tdNateEmail);

                // input 생성 - 네이트온 이메일
                let inputNateEmail = document.createElement('input');
                inputNateEmail.type = 'email';
                inputNateEmail.name = 'manager_nate_email' + (startIndex + i);
                inputNateEmail.id = 'manager_nate_email' + (startIndex + i);
                inputNateEmail.placeholder = '네이트온 이메일';
                tdNateEmail.appendChild(inputNateEmail);


                // td 생성 - inputArea, select-custom, input
                let tdSelectAndInput = document.createElement('td');
                trElement.appendChild(tdSelectAndInput);

                // inputArea 생성
                let textArea = document.createElement('div');
                textArea.classList = 'inputArea'
                tdSelectAndInput.appendChild(textArea);

                // inputArea > select-custom 생성
                let selectCustom = document.createElement('div');
                selectCustom.classList = 'select-custom';
                textArea.appendChild(selectCustom)
                
                // inputArea > select-custom > select 생성
                let selectTag = document.createElement('select');
                selectTag.name = 'insuranceName' + (startIndex + i); 
                selectTag.id = 'insuranceName' + (startIndex + i); 
                selectCustom.appendChild(selectTag)
                
                
                // inputArea > select-custom > select > option 생성
                let selectOptions = document.createElement('option');
                selectOptions.value = '';
                selectOptions.innerText = '선택';
                selectTag.appendChild(selectOptions)

                // inputArea > input 생성
                let inputInsuranceId = document.createElement('input');
                inputInsuranceId.type = 'text';
                inputInsuranceId.name = 'insuranceId' + (startIndex + i);
                inputInsuranceId.id = 'insuranceId' + (startIndex + i);
                inputInsuranceId.placeholder = 'ID';
                textArea.appendChild(inputInsuranceId);

                // td생성 - tr삭제
                let tdTrDelete = document.createElement('td');
                trElement.appendChild(tdTrDelete);

                // button 생성 - trDelelte
                let buttnTag = document.createElement('button');
                buttnTag.type = 'button';
                buttnTag.title = ' 행 삭제';
                buttnTag.innerText = '삭제';
                buttnTag.classList.add('btn', 'lineDelete', 'type01');
                tdTrDelete.appendChild(buttnTag)
            }
        } else { 
            event.preventDefault() 
            alert('추가 가능한 행의 갯수는 10개 입니다.') 
        } 
    }

    // 행 추가(+1) 버튼 클릭시
    document.querySelectorAll('.trAddSingle').forEach(function(trAddSingle) { 
        trAddSingle.addEventListener('click', function(event) { 
            let trTags = document.getElementById('trInsertTable').querySelector('tbody').querySelectorAll('tr');
            addTableRow(trTags, trTags.length, 1);
        }); 
    });

    // 행 추가(+3) 버튼 클릭시
    document.querySelectorAll('.trAddThird').forEach(function(trAddThird) { 
        trAddThird.addEventListener('click', function(event) { 
            let trTags = document.getElementById('trInsertTable').querySelector('tbody').querySelectorAll('tr');
            addTableRow(trTags, trTags.length, 3);
        }); 
    });

    // lineDelete 클릭시 tr 삭제, 순번 및 모든 속성 number 재구성 
    document.addEventListener('click', function(event){
        // (동적으로 생선된 태그이므로 이벤트 위임)
        if (event.target.classList.contains('lineDelete') && event.target.classList.contains('type01')) {
            // 엘리먼트 추적
            let lineDeleteBtn = event.target;
            let targetTr = lineDeleteBtn.closest('tr');
            let tbody = targetTr.parentNode;
            let trs = tbody.querySelectorAll('tr');
            let serachNumber = parseInt(targetTr.querySelector('td').innerText);

            if (confirm(serachNumber + "번째 행을 삭제하시겠습니까?\n(입력된 정보가 삭제됩니다)")) {
                targetTr.remove();

                // 삭제된 행 다음의 순번 및 속성값 (name, id) 업데이트
                for (let i = serachNumber; i < trs.length; i++) {
                    let currentRow = trs[i];
                    let currentIndex = i;
                    currentRow.querySelector('td').innerText = currentIndex;
                    
                    // input 태그
                    let inputs = currentRow.querySelectorAll('input');
                    inputs.forEach(function(input) {
                        updateAttributes(input, 'name', currentIndex - 1);
                        updateAttributes(input, 'id', currentIndex - 1);
                    });
                    
                    // select 태그
                    let selects = currentRow.querySelectorAll('select');
                    selects.forEach(function(select) {
                        updateAttributes(select, 'name', currentIndex - 1);
                        updateAttributes(select, 'id', currentIndex - 1);
                    });
                }
                return false;
            }
        }
    });

    // 속성값 업데이트
    function updateAttributes(element, attributeName, currentIndex) {
        let currentValue = element.getAttribute(attributeName);
        if (currentValue) {
            let newValue = currentValue.replace(/\d+$/, currentIndex);
            element.setAttribute(attributeName, newValue);
        }
    }

    // 라디오 선택시 라디오 다음에 있는 input 태그 활성화/비활성화
    document.addEventListener("DOMContentLoaded", function() {

        let activateRadios = document.querySelectorAll('input[type="radio"]');

        activateRadios.forEach(function(activateRadio){
            activateRadio.addEventListener('change', function(){

                // input  추적
                let radiobox = activateRadio.closest('.radiobox');
                let parentTd = radiobox.closest('td')
                let inputSiblings = parentTd.querySelectorAll('.radiobox + input')
                let selectSiblings = parentTd.querySelectorAll('.radiobox + .select-custom select')
                let checkboxSiblings = parentTd.querySelectorAll('.radiobox + .checkbox input[type="checkbox"]')
                let nextSibling = radiobox.nextElementSibling;

                //체크박스 속성 삭제
                checkboxSiblings.forEach(function(checkboxSibling){
                    checkboxSibling.setAttribute('disabled','disabled');
                    checkboxSibling.checked = false;
                })

                // 텍스트 속성 삭제
                inputSiblings.forEach(function(inputSibling){
                    inputSibling.setAttribute('disabled','disabled');
                    inputSibling.value = '';
                    inputSibling.placeholder = ''
                })

                selectSiblings.forEach(function(selectSibling){
                    selectSibling.setAttribute('disabled','disabled');
                    selectSibling.removeAttribute('required');
                    selectSibling.selectedIndex = 0;

                })
                
                if (nextSibling) {
                    // 체크박스일때 추가
                    if (nextSibling.classList.contains('checkbox')) {
                        let checkBox = nextSibling.querySelector('input[type="checkbox"]')
                        checkBox.removeAttribute('disabled');

                    // 텍스트일대 추가
                    } else if (nextSibling.tagName.toLowerCase() === 'input' && nextSibling.getAttribute('type') === 'text') {
                        nextSibling.removeAttribute('disabled');
                        nextSibling.placeholder = '내용추가';
                    } else if (nextSibling.classList.contains('select-custom')) {
                        let selectTag = nextSibling.querySelector('select');
                        selectTag.removeAttribute('disabled');
                        selectTag.setAttribute('required','required');
                    }
                }
            })
        })
    })

    // 숫자 입력 필드들을 선택하고 각각에 대해 이벤트 리스너를 등록
    document.querySelectorAll('input[type="number"]').forEach(function(input, index, inputs) {
        input.addEventListener('keyup', function(event) {
            let currentInput = this;
            let currentValue = currentInput.value;
            let dataLength = currentInput.getAttribute('data-length'); 

            // 태그 data-length속성값이 4이면
            if (dataLength === "4") {
                if (currentValue.length > dataLength - 1) {
                    currentInput.value = currentValue.slice(0, 4);
                    if (index < inputs.length - 1) {
                        // 다음 입력 필드로 포커스 이동
                        inputs[index + 1].focus();
                    }
                }
            // 태그 data-length속성값이 2이면
            } else if (dataLength === "2") {
                if (currentValue.length > dataLength - 1) {
                    currentInput.value = currentValue.slice(0, 2);
                    if (index < inputs.length - 1) {
                        // 다음 입력 필드로 포커스 이동
                        inputs[index + 1].focus();
                    }
                }
            }
        });
    });

    // 등록 버튼 클릭시 checkbox 클릭여부 / 주소 삽입여부 확인
    document.getElementById('inputAdd').addEventListener('click', function(event){
        // 엘리먼트 추적
        let jibunAddress = document.getElementById('jibun_address');
        let jibunAddressValue = jibunAddress.value;
        
        // let checkBoxes = document.querySelectorAll('input[type="checkbox"]');
        // let allUnchecked = true;

        // checkBoxes.forEach(function(checkBox) {
        //     if (checkBox.checked) {
        //         allUnchecked = false;
        //     }
        // });

        // if (allUnchecked) {
        //     event.preventDefault();
        //     alert("거래방법을 선택해주세요.");
        //     return false
        // }

        if (jibunAddressValue == "") {
            event.preventDefault();
            alert("주소를 등록해주세요.")
            document.getElementById('road_address').click();
            return false
        }

    });

    // input 에 comma 클래스가 있으면 3자리수마다 콤마(,)찍기
    document.addEventListener('input', function(event){
        if(event.target.classList.contains('comma')) {
            let inputValue = event.target.value;
            event.target.value = inputValue.replace(/[^0-9]/g, "").replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    })

    // 보험사/상품(수수료) 관리 추가 버튼 클릭시 html생성
    document.getElementById('addCommissionBtn').addEventListener('click', function(event){
        let addBtn = event.target;
        // let inputArea = addBtn.closest('.inputArea');
        // let selectAddCompany = inputArea.querySelector('#addCompany');
        // let selectAddProduct = inputArea.querySelector('#addProduct');
        // let selectAddCommission = inputArea.querySelector('#addCommission');

        let addBody = document.getElementById('addBody');
        let lengTr = addBody.querySelectorAll('tr');
        let trCount = lengTr.length + 1;
        
        // value 추적
        // let selectAddCompanyValue = selectAddCompany.value;
        // let selectAddProductValue = selectAddProduct.value;
        // let selectAddCommissionValue = selectAddCommission.value;
        
        // text 추적
        // let selectAddCompanyText = selectAddCompany.options[selectAddCompany.selectedIndex].text;
        // let selectAddProductText = selectAddProduct.options[selectAddProduct.selectedIndex].text;
        
        let commissionHtml = createCommissionHtml(trCount); /* , selectAddCompanyValue, selectAddProductValue, selectAddCommissionValue, selectAddCompanyText, selectAddProductText */
        addBody.appendChild(commissionHtml);

        // if(selectAddCompanyValue === "") {
        //     alert('보험사를 선택하세요.');
        //     selectAddCompany.focus();
        // } else if (selectAddProductValue === "") {
        //     alert('상품을 선택하세요.');
        //     selectAddProduct.focus();
        // } else if (selectAddCommissionValue === "") {
        //     alert('수수료를 입력하세요.');
        //     selectAddCommission.focus();
        // } else if (selectAddCompanyValue !== "" && selectAddProductValue !== "" && selectAddCommissionValue !== "") {
        //     addBody.appendChild(commissionHtml);

        //     // select와 input 값 초기화
        //     selectAddCompany.selectedIndex = 0;
        //     selectAddProduct.selectedIndex = 0;
        //     selectAddCommission.value = '';
        // }
    })

    // html 구성 함수
    // 앞서 작성된 script에서 필요한 인수를 가져와 삽입
    function createCommissionHtml(trCount) { /* , selectAddCompanyValue, selectAddProductValue, selectAddCommissionValue, selectAddCompanyText, selectAddProductText */
        let commissionHtml = document.createElement('tr');
        commissionHtml.innerHTML = `
            <td>
                ${trCount}
            </td>
            <td>
                <div class="select-custom">
                    <select name="addCompany[]" id="addCompany${trCount}" required>
                        <option value="" selected="">보험사 선택</option>
                        <option value="">CHUBB</option>
                        <option value="">CHUBB2</option>
                        <option value="">CHIBB3</option>
                    </select>
                </div>

            </td>
            <td>
                <div class="select-custom">
                    <select name="addProduct[]" id="addProduct${trCount}" required>
                        <option value="" selected="">상품 선택</option>
                        <option value="">상품1</option>
                        <option value="">상품2</option>
                        <option value="">상품3</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="inputArea">
                    <input type="text" name="addedCommission[]" placeholder="수수료(%) 입력" id="addedCommission${trCount}" class="onlyNumber" maxlength="3" required>
                </div>
            </td>
            <td>
                <button type="button" class="btn lineDelete type02">삭제</button>
            </td>
        `;
        return commissionHtml;
    }

    // 삭제 버튼을 눌렀을때 tr 삭제 및 숫자 업데이트
    document.addEventListener('click', function(event){
        if(event.target.classList.contains('lineDelete') && event.target.classList.contains('type02')) {
            let action = event.target;
            let trTag = action.closest('tr');
            let tdTag = trTag.querySelector('td');
            let tdText = tdTag.innerText;
            
            if(confirm(`${tdText}번째 행을 삭제하시겠습니까?\n(입력된 정보가 삭제됩니다.`)) {
                event.target.closest('tr').remove();
                updateTrNumbers();
            }
        }
    })

    // 숫자를 업데이트 해주는 함수
    function updateTrNumbers() {
        let trTags = document.querySelectorAll('#addBody tr');
        trTags.forEach((trTag, index) => {

            // 순번
            let firstTd = trTag.querySelector('td');
            if(firstTd) {
                firstTd.textContent = `${index + 1}`;
            }

            // select
            selectTags = trTag.querySelectorAll('.select-custom select');
            selectTags.forEach((select, selectIndex) => {
                let newId = select.getAttribute('id').replace(/\d+$/, index + 1);
                
                select.setAttribute('id', newId);
            })

            // input number
            let numberInput = trTag.querySelector('.inputArea input[type="number"]');
            if(numberInput) {
                let newId = numberInput.getAttribute('id').replace(/\d+$/, index + 1);
                numberInput.setAttribute('id', newId);
            }

        });
    }

</script>