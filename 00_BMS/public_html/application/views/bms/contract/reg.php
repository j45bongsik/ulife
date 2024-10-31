<script type="text/javascript">
// 달력 script
$(document).ready(function() {
    var today = new Date();
    var tomorrow = new Date(Date.parse(today) + (1000 * 60 * 60 * 24));
    $("#start_date").datepicker({
        // showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "../assets/img/service/icon-calendar.svg?e",
        // buttonImageOnly: true,
        showOtherMonths: true,
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // buttonText: "Select date",
        // minDate: today,
        onClose: function( selectedDate ) {
        }
    });
    $(" #end_date").datepicker({
        // showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "../assets/img/service/icon-calendar.svg?e",
        // buttonImageOnly: true,
        showOtherMonths: true,
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // buttonText: "Select date",
        // minDate: tomorrow              
    });
    $(" #contract_date").datepicker({
        // showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "../assets/img/service/icon-calendar.svg?e",
        // buttonImageOnly: true,
        showOtherMonths: true,
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // buttonText: "Select date",
        // minDate: tomorrow              
    });
});
</script>
        
        <div class="conts-box">
            <div class="titleArea">
                <h1>보험 계약 등록</h1>
                <span class="essential">* 는 필수 항목 입니다.</span>
            </div>
            <form action="/contractRegProc" name="contractRegForm" method="post" enctype="multipart/form-data" id="contractRegForm" autocomplete="off">
                
                <article class="erpList reg">
                    <div class="titleArea">
                        <h2 class="thirdTitle">계약정보</h2>
                    </div> 
                    <table>
                        <caption>
                            보험계약등록 - 계약정보 테이블로 계약구분(신규/갱신), 유입경로, 계약자, 피보험자, 보험사, 증권번호, 보험종목, 보험상품, 보험기간, 계약일, 전년도보험료, 갱신보험료, 만기알림, 청약서류, 담당자, 연락처 등의 정보를 입력합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 175px;">
                            <col style="width: auto;">
                            <col style="width: 175px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="new" class="essential">계약구분</label>
                                </th>
                                <td>
                                    <div class="checkArea">
                                        <div class="radiobox">
                                            <input id="new" class="radio-custom" name="contractType" value="1" type="radio">
                                            <label for="new" class="radio-custom-label">신규</label>
                                        </div>
                                        <div class="radiobox">
                                            <input id="novation" class="radio-custom"name="contractType" value="0" type="radio">
                                            <label for="novation" class="radio-custom-label">갱신</label>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="inflow_channel" class="essential">유입경로</label>
                                </th>
                                <td>
                                    <!-- <div class="select-custom"> -->
                                        <?php
                                        /*
                                            추후에 값이 추가되거나 빠지거나 변경 되는 건이 많다면 DB에서 코드화 시켜서 가져오는 것이 좋다.
                                            지금은 코드화 시키지 않고 하드코딩으로 작성함. 계약등록 페이지와 수정 페이지에서만 사용하는 값이기 때문에 하드코딩으로 작성함.
                                        */                            
                                        ?>
                                        <!-- <select name="inflow_channel" id="inflow_channel">
                                            <option value="CS">상담</option> consult 
                                            <option value="SR">심사</option>screening 
                                            <option value="EM">검토</option>examination 
                                            <option value="SC">심사 후 종결</option>screening_close
                                            <option value="EC">검토 후 종결</option>examination_close                                
                                            <option value="CC">계약완료</option>contract_completed
                                            <option value="XX">취소</option>contract_cancel => XX
                                        </select> -->

                                        <!-- 리스트 값을 삭제하고
                                        option 온라인
                                        option 오프라인
                                        option 기타
                                        기타를 선택시 추가 작성할수 있는 input을 생성 -->
                                    <!-- </div> -->
                                    <div class="inputArea">
                                        <div class="select-custom">
                                            <select name="inflow_channel" id="inflow_channel" required>

                                                <option value="" selected>유입경로 선택</option>
                                                <option value="ONLINE">온라인</option>
                                                <option value="OFFLINE">오프라인</option>
                                                <option value="ETC">기타</option>
                                            </select>
                                        </div>
                                        <span class="between"></span>
                                        <input type="text" id="inflow_channel_etc" name="inflow_channel_etc" disabled>
                                    </div>
                                </td>
                                
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="customerCompanyName" class="essential">계약자</label>
                                </th>
                                <td>
                                    <div class="search-item radius-5">
                                        <i class="icon-search" id="openModalBtn-2">검색아이콘</i>
                                        <input type="search" class="input" id="customerCompanyName" name="customerCompanyName" placeholder="홍길동" required>
                                        <input type="hidden" name="customerNo" id="customerNo">
                                        <!-- <button class="btnClear"></button> -->
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="insurant" class="essential">피보험자</label>
                                </th>
                                <td>
                                    <input type="text" name="insurant" id="insurant" placeholder="피보험자 입력" required>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="insuranceCompany" class="essential">
                                        보험사
                                    </label>
                                </th>
                                <td>
                                    <div class="select-custom">
                                        <select name="insuranceCompany" id="insuranceCompany" required>
                                            <?=$INSURANCECOMPANYSELECTBOX?>
                                        </select>

                                        <!-- 리스트 값을 삭제하고
                                        option 온라인
                                        option 오프라인
                                        option 기타
                                        기타를 선택시 추가 작성할수 있는 input을 생성 -->
                                    </div>

                                </td>
                                <th scope="row">
                                    <label for="policyNumber" class="essential">증권번호</label>
                                </th>
                                <td>
                                    <input type="text" name="policyNumber" id="policyNumber" placeholder="증권번호 입력" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="insuranceType" class="essential">보험종목</label>
                                </th>
                                <td>
                                    <div class="select-custom">
                                        <select name="insuranceType" id="insuranceType" required>
                                            <?=$INSURANCETYPESELECTBOX?>
                                        </select>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="insuranceProductName" class="essential">보험상품</label>
                                </th>
                                <td>
                                    <div class="search-item radius-5">
                                        <i class="icon-search" id="openModalBtn">검색아이콘</i>
                                        <!-- #insuranceProductName 를 클릭시 #openModalBtn 를 클릭한 이벤트 효과 주기 -->
                                        <input type="text"  class="input" id="insuranceProductName" name="insuranceProductName" placeholder="보험상품명" required>
                                        <input type="hidden" name="insuranceProductNo" id="insuranceProductNo">
                                        <!-- button class="btnClear"></!-->
                                    </div>
                                    <!--div class="select-custom">
                                        <select name="" id="">
                                            <option value="" selected>분류</option>
                                            <option value="">심사</option>
                                            <option value="">계약완료</option>
                                            <option value="">취소</option>
                                        </select>
                                    </div>
                                    
                                    <div class="select-custom">
                                        <select name="" id="">
                                            <option value="" selected>심사</option>
                                            <option value="">종목</option>
                                            <option value="">계약완료</option>
                                            <option value="">취소</option>
                                        </select>
                                    </div-->
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="start_date" class="essential">보험기간</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="date_picker">
                                            <input type="text" class="picker format-date" name="start_date" id="start_date"  placeholder="YYYY-MM-DD" maxlength="10" required autocomplete='off'>
                                        </div>
                                        <span class="between">~</span>
                                        <div class="date_picker">
                                            <input type="text" class="picker format-date" name="end_date" id="end_date"  placeholder="YYYY-MM-DD" maxlength="10" required autocomplete='off'>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="contract_date" class="essential">계약일</label>
                                </th>
                                <td>
                                    <input type="text" class="picker format-date" name="contract_date" id="contract_date"  placeholder="YYYY-MM-DD" maxlength="10" required>
                                </td>

                                <!-- 필요없음 -->
                                <!-- <th scope="row">
                                    <label for="estimateInsurancePremium" class="essential">견적보험료</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <input type="text" name="estimateInsurancePremium" id="estimateInsurancePremium" class="" placeholder="금액 입력" required>
                                        <span class="between">원</span>
                                    </div>
                                </td> -->
                            </tr>


                            <tr>
                                
                            </tr>

                            <tr>
                                
                            </tr>

                            <tr>
                                <th>
                                    <label for="prevYearPremium">
                                        전년도 보험료
                                    </label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <input type="text" name="prevYearPremium" id="prevYearPremium" placeholder="전년도 보험료 입력" >
                                        <span class="between">원</span>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="insurancePremium" class="essential">보혐료</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <input type="text" name="insurancePremium" id="insurancePremium" placeholder="보험료 입력" required>
                                        <span class="between">원</span>
                                    </div>
                                </td>
                                
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="expirationNotice90" class="essential">만기알림</label>
                                </th>
                                <td>
                                    <div class="checkArea">
                                        <div class="checkbox">
                                            <input type="checkbox" name="expirationNotice[]" id="expirationNotice90" value="90" class="checkbox-custom" required>
                                            <label for="expirationNotice90" class="checkbox-custom-label">90</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="expirationNotice[]" id="expirationNotice60" value="60" class="checkbox-custom">
                                            <label for="expirationNotice60" class="checkbox-custom-label">60</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="expirationNotice[]" id="expirationNotice45" value="45" class="checkbox-custom">
                                            <label for="expirationNotice45" class="checkbox-custom-label">45</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="expirationNotice[]" id="expirationNotice30" value="30" class="checkbox-custom">
                                            <label for="expirationNotice30" class="checkbox-custom-label">30</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="expirationNotice[]" id="expirationNotice15" value="15" class="checkbox-custom">
                                            <label for="expirationNotice15" class="checkbox-custom-label">15</label>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="contractInsurance" class="essential">
                                        청약서류
                                    </label>
                                </th>
                                <td>
                                    <!-- <div class="fileArea">
                                        <label for="contractInsurance">파일 선택</label>
                                        <input type="file" name="contractInsurance[]" id="contractInsurance" required multiple>
                                        <p class="noFile ">등록된 보험계약서가 없습니다.</p>
                                        <ul class="fileList">
                                            
                                        </ul>
                                    </div> -->
                                    <div class="file-add">
                                    <!-- 
                                        <input type="file" name="str-Image1" id="fileAdd" class="add-file-input class-img">
                                        <div class="add-file-txt">파일선택</div>
                                        <label for="fileAdd"><div class="add-file-btn">찾아보기</div></label>
                                    -->
                                    <article class="filecontainer type02">
                                        <label class="filelabel type02" id="label" for="contractInsurance">
                                            파일선택
                                            <!-- 점선으로 테두리 있는 박스  -->
                                            <!-- <div class="fileinner" id="inner">드래그하거나 클릭해서 업로드(최대 5개)</div> -->
                                        </label>
                                        <input type="file" name="contractInsurance[]" id="contractInsurance" multiple class="input" accept="image/*, .pdf" hidden="true"  >
                                        <p class="noFile">등록된 청약서류가 없습니다.</p>
                                        <!-- <span class="filepreview" id="preview"></span> -->
                                        <ul class="filepreview" id="preview">

                                        </ul>
                                    </article>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="companyManager">
                                        담당자
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="companyManager" id="companyManager" placeholder="담당자명 입력">
                                </td>
                                <th>
                                    <label for="companyManagerTel">
                                        연락처
                                    </label>
                                </th>
                                <td>
                                <input type="tel" name="companyManagerTel" id="companyManagerTel"  placeholder="연락처 입력" maxlength="13" value="" required="" autocomplete="off">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <article class="erpList reg">
                    <div class="titleArea">
                        <h2 class="thirdTitle">계약담당</h2>
                    </div>
                    <table>
                        <caption>
                            보혐계약등록 - 계약담당 테이블로 계약담당자(주/부), 실적배분(주/부) 등의 정보를 입력합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 175px;">
                            <col style="width: auto;">
                            <col style="width: 175px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="contractAdmin1" class="essential">계약담당자</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="second-wrap">
                                            <strong>주 :</strong>
                                            <div class="select-custom">
                                                <select name="contractAdmin1" id="contractAdmin1" required>
                                                    <?=$ADMINUSERLISTSELECTBOX?>
                                                </select>
                                            </div>
                                        </div>
                                        <span class="between">/</span>
                                        <div class="second-wrap">
                                            <strong>부 :</strong>
                                            <div class="select-custom">
                                                <select name="contractAdmin2" id="contractAdmin2" required>
                                                    <?=$ADMINUSERLISTSELECTBOX?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="distribution1" class="essential">실적배분</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="second-wrap">
                                            <strong>주 :</strong>
                                            <div class="select-custom width-35p">
                                                <select name="distribution1" id="distribution1">
                                                    <option value="100" >100</option>
                                                    <option value="95" >95</option>
                                                    <option value="90" >90</option>
                                                    <option value="80" >80</option>
                                                    <option value="70" selected>70</option>
                                                    <option value="60" >60</option>
                                                    <option value="50" >50</option>
                                                </select>
                                            </div>
                                            <span class="between">%</span>
                                        </div>
                                        <span class="between">/</span>
                                        <div class="second-wrap">
                                            <strong>부 :</strong>
                                            <div class="select-custom width-35p disabled">
                                                <select name="distribution2" id="distribution2" disabled>
                                                    <option value="0" >0</option>
                                                    <option value="50" >50</option>
                                                    <option value="40" >40</option>
                                                    <option value="30" selected>30</option>
                                                    <option value="20" >20</option>
                                                    <option value="10" >10</option>
                                                    <option value="5" >5</option>
                                                    <option value="0" >0</option>
                                                </select>
                                            </div>
                                            <span class="between">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <article class="erpList reg">
                    <div class="titleArea">
                        <h2 class="thirdTitle">수수료</h2>
                    </div>
                    <table>
                        <caption>
                            보험계약등록 - 수수료 테이블로 상품수수료(기본/추가), 지급광고비(거래처/수수료율) 등의 정보를 입력합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 175px;">
                            <col style="width: auto;">
                            <col style="width: 175px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="insuranceProductCommission" class="essential">상품수수료</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="third-wrap">
                                            <span class="between rightPadding">기본 : </span>
                                            <input type="number" name="insuranceProductCommission" id="insuranceProductCommission" class="" placeholder="0" required> 
                                            <span class="between leftPadding">%</span>
                                        </div>

                                        <span class="between">+</span>
                                        
                                        <div class="third-wrap">
                                            <span class="between rightPadding">추가 : </span>
                                            <input type="number" name="insuranceProductAdditionalCommission" id="insuranceProductAdditionalCommission" class="" placeholder="0"> 
                                            <span class="between leftPadding">%</span>
                                        </div>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="advertCostCompany" class="essential">지급광고비</label>
                                </th>
                                <td>
                                    <div class="advert-cost">
                                        <span class="between rightPadding">거래처 :</span>
                                        <input type="text" name="advertCostCompany" id="advertCostCompany" class="" placeholder="거래처명 입력" required>
                                        <span class="between">|</span>
                                        <input type="number" name="advertCostCommissionRate" id="advertCostCommissionRate" class="" placeholder="수수료율" required>
                                        <span class="between leftPadding">%</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <article class="erpList reg">
                    <div class="titleArea">
                        <h2 class="thirdTitle">기타</h2>
                    </div>
                    <table>
                        <caption>
                            보험계약등록 - 기타 테이블로 메모 등의 정보를 입력합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 175px;">
                            <col style="width: auto;">
                            <col style="width: 175px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="memo">메모</label>
                                </th>
                                <td colspan="3">
                                    <textarea name="memo" id="memo" class="textarea" placeholder="추가 사항 입력"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <div class="btn-box-conts mgB30">
                    <a onclick="formSubmit();" class="button point rgstr">등록</a>
                </div>
            </form>


            
        </div>

    </div>

<!-- /** 모달창_보험상품 검색 -->

<div id="myModal" class="modal">
	<div class="modal-content">
		<div class="close" id="closeModalBtn">
			<span class="x-top"></span>
			<span class="x-bottom"></span>
		</div>
		<h4>보험 상품 검색 결과</h4>
		<div class="modal-form">
            <div id="insuranceProductList"></div>
			<div class="modalBtn">
				<button onclick="choiceInsuranceProduct();" class="button">선택</button>  
				<button onclick="location.href='/insuranceProduct_reg'" class="button">추가</button>
			</div>
		</div>
	</div>
</div>

<!-- /** 모달창_계약자 검색 -->

<div id="myModal-2" class="modal">
	<div class="modal-content">
		<div class="close" id="closeModalBtn-2">
			<span class="x-top"></span>
			<span class="x-bottom"></span>
		</div>
		<h4>계약자(고객) 검색 결과</h4>
		<div class="modal-form">
        <div id="insuranceCustomerList"></div>
			<div class="modalBtn">
				<button onclick="choiceCustomer();" class="button">선택</button> 
				<button onclick="location.href='/customer_reg'" class="button">추가</button>   
			</div>
		</div>
	</div>
</div>

    

<script>

//******모달창_보험상품 검색

 // 모달 열기 버튼 클릭 시 
<?
// 모달 열기 버튼 클릭 시 -> 구분 선택시 보험 상품 리스트 가져오기 로 변경 예정 (2차때 : 버튼 클릭시 가져오니까 느림 .... 젠장)
?> 
document.getElementById("openModalBtn").addEventListener("click", function() {
    // 구분(insuranceType)이 selectbox 선택이 되어있지 않으면 구분을 선택하라는 alert 창을 띄우고 모달창을 열지 않는다.
    if(document.getElementById("insuranceType").value === ""){
        alert("구분을 선택해주세요.");
        return false;
    }

    //구분이 선택이 되어있으면 해당 value 값을 가져와서 변수 insuranceType 에 담는다.
    var insuranceType = "";
    insuranceType = document.getElementById("insuranceType").value;
    

    // insuranceType 값을 ajax 로 보내서 보험 상품 리스트를 가져온다.
    $.ajax({
        url: "/insuranceProduct_list_ajax",
        type: "POST",
        data: {
            insuranceType: insuranceType
        },
        dataType: "json",
        success: function(result) {
            // insuranceProductListHtml 변수에 html 을 담는다.
            var insuranceProductListHtml = "";
            // result 값의 갯수만큼 반복문을 돌린다.
            for (var i = 0; i < result.length; i++) {
                // insuranceProductListHtml 변수에 html 을 담는다.
                insuranceProductListHtml += "<input type='radio' name='insuranceProduct' id='insuranceProduct-" + result[i].no + "' data='"+result[i].insuranceProductName+"' insuranceProductCommission = '"+result[i].insuranceProductCommission+"' insuranceProductAdditionalCommission = '"+result[i].insuranceProductAdditionalCommission+"' class='radio-custom' value='" + result[i].no + "'><label for='insuranceProduct-" + result[i].no + "' class='radio-custom-label'>" + result[i].insuranceProductName + "</label>";
            }
            document.getElementById("insuranceProductList").innerHTML = insuranceProductListHtml;
        },
        error: function(request, status, error) {
            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
        }
    });
    
    // insurance

    document.getElementById("myModal").style.display = "flex";
});

// 모달 닫기 버튼 클릭 시
document.getElementById("closeModalBtn").addEventListener("click", function() {
    document.getElementById("myModal").style.display = "none";
});

// 모달 바깥 영역 클릭 시 모달 닫기
window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});


// 엔터 키 클릭 이벤트
document.getElementById("insuranceProductName").addEventListener("keyup", function(event) {
	if (event.key === "Enter") {
		document.getElementById("openModalBtn").click();
	}
});



//******모달창_계약자 검색

// 모달 열기 버튼 클릭 시
document.getElementById("openModalBtn-2").addEventListener("click", function() {
    // id 가 customerCompanyName 인 input 에 값이 영문두글자 또는 한글 두글자 이하면 '최소 두글자 이상 입력해주세요' 라는 alert 창을 띄우고 모달창을 열지 않는다.
    if(document.getElementById("customerCompanyName").value.length < 2){
        alert("최소 두글자 이상 입력해주세요.");
        return false;
    }

    // customerCompanyName 값을 ajax 로 보내서 고객사 리스트를 가져온다.
    $.ajax({
        url: "/customer_list_ajax",
        type: "POST",
        data: {
            customerCompanyName: document.getElementById("customerCompanyName").value
        },
        dataType: "json",
        success: function(result) {
            // customerListHtml 변수에 html 을 담는다.
            var customerListHtml = "";
            // result 값의 갯수만큼 반복문을 돌린다.
            for (var i = 0; i < result.length; i++) {
                // customerListHtml 변수에 html 을 담는다.
                customerListHtml += "<input type='radio' name='customer' id='customer-" + result[i].no + "' class='radio-custom' value='" + result[i].no + "' data='" + result[i].customer_name + "' ><label for='customer-" + result[i].no + "' class='radio-custom-label'>" + result[i].customer_name + "</label>";
            }
            document.getElementById("insuranceCustomerList").innerHTML = customerListHtml;
        },
        error: function(request, status, error) {
            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
        }
    });

    
    document.getElementById("myModal-2").style.display = "flex";
});

// 모달 닫기 버튼 클릭 시
document.getElementById("closeModalBtn-2").addEventListener("click", function() {
    document.getElementById("myModal-2").style.display = "none";
});

// 모달 바깥 영역 클릭 시 모달 닫기
window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal-2");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});


// 엔터 키 클릭 이벤트
document.getElementById("customerCompanyName").addEventListener("keyup", function(event) {
	if (event.key === "Enter") {
		document.getElementById("openModalBtn-2").click();
	}
});


/* choiceInsuranceProduct 함수 
    모달창에서 보험 상품을 선택하고 선택 버튼을 누르면 실행되는 함수
    보험 상품 선택 후 선택 버튼을 누르면 해당 보험 상품의 no 값을 insuranceProductNo 에 담는다.
    해당 보험의 수수료와 추가수수료를 가져와서 input insuranceProductCommission, insuranceProductAdditionalCommission 에 담는다. */
function choiceInsuranceProduct(){
    // 보험 상품의 no 값을 가져온다.
    var insuranceProductNo = document.querySelector('input[name="insuranceProduct"]:checked').value;
    // 보험 상품의 이름을 가져온다. 상품의 이름은 선택된 라디오 버튼의 data 속성에 담겨있다.
    var insuranceProductName = document.querySelector('input[name="insuranceProduct"]:checked').getAttribute("data");
    // 보험 상품의 no 값을 가져와서 해당 보험 상품의 정보를 가져와서 input insuranceProductNo 에 담는다.
    document.getElementById("insuranceProductNo").value = insuranceProductNo;
    document.getElementById("insuranceProductName").value = insuranceProductName;
    
    // 보험 상품의 수수료를 가져온다. 상품의 수수료는 선택된 라디오 버튼의 insuranceProductCommission 속성에 담겨있다. input insuranceProductCommission 에 담는다.
    document.getElementById("insuranceProductCommission").value = document.querySelector('input[name="insuranceProduct"]:checked').getAttribute("insuranceProductCommission");

    // 보험 상품에서 insuranceProductAdditionalCommission 의 값이 Y 이면 추가 수수료 input 을 활성화 시킨다. N 이면 비활성화 시킨다.
    if(document.querySelector('input[name="insuranceProduct"]:checked').getAttribute("insuranceProductAdditionalCommission") === "Y"){
        document.getElementById("insuranceProductAdditionalCommission").disabled = false;
    } else {
        document.getElementById("insuranceProductAdditionalCommission").disabled = true;
    }

    // 모달창을 닫는다.
    document.getElementById("myModal").style.display = "none";
}


/* */
function choiceCustomer(){
    // 고객사의 no 값을 가져온다.
    var customerNo = document.querySelector('input[name="customer"]:checked').value;
    // 고객사의 이름을 가져온다. 고객사의 이름은 선택된 라디오 버튼의 data 속성에 담겨있다.
    var customerCompanyName = document.querySelector('input[name="customer"]:checked').getAttribute("data");
    // 고객사의 no 값을 가져와서 해당 고객사의 정보를 가져와서 input customerNo 에 담는다.
    document.getElementById("customerNo").value = customerNo;
    document.getElementById("customerCompanyName").value = customerCompanyName;
    
    // 모달창을 닫는다.
    document.getElementById("myModal-2").style.display = "none";

}

// 실적배분에서 주 담당자의 수수료를 변경하면 부 담당자의 수수료는 100 - 주 담당자의 수수료가 된다.
document.getElementById("distribution1").addEventListener("change", function() {
    document.getElementById("distribution2").value = 100 - document.getElementById("distribution1").value;
});


// 견적 보험료(estimateInsurancePremium)/ 갱신보험료(insurancePremium)/ 전년도보험료(prevYear)에는 자동으로 3자리마다 콤마(,)를 찍어준다.
document.getElementById("insurancePremium").addEventListener("keyup", function() {
    document.getElementById("insurancePremium").value = document.getElementById("insurancePremium").value.replace(/[^0-9]/g, "").replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});
document.getElementById("prevYearPremium").addEventListener("keyup", function() {
    document.getElementById("prevYearPremium").value = document.getElementById("prevYearPremium").value.replace(/[^0-9]/g, "").replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});
// document.getElementById("estimateInsurancePremium").addEventListener("keyup", function() {
//     document.getElementById("estimateInsurancePremium").value = document.getElementById("estimateInsurancePremium").value.replace(/[^0-9]/g, "").replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// });

//등록 버튼 클릭시 formSubmit 함수 실행
function formSubmit(){
    // 계약구분(contractType)이 선택이 되어있지 않으면 계약구분을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.querySelector('input[name="contractType"]:checked') === null){
        alert("계약구분을 선택해주세요.");
        document.getElementById('new').focus();
        return false;
    }

    // 유입경로(status)가 선택이 되어있지 않으면 상태를 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("inflow_channel").value === ""){
        alert("유입경로를 선택해주세요.");
        document.getElementById('inflow_channel').focus();
        return false;
    }

    // 계약자(고객)가 선택이 되어있지 않으면 계약자(고객)을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("customerNo").value === ""){
        alert("계약자를 선택해주세요.");
        document.getElementById("customerCompanyName").focus();
        return false;
    }

    // 피보험자(insurant)가 입력이 되어있지 않으면 피보험자를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insurant").value === ""){
        alert("피보험자를 입력해주세요.");
        document.getElementById("insurant").focus();
        return false;
    }

    // 보험사(insuranceCompany)가 입력이 되어있지 않으면 피보험자를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insuranceCompany").value === ""){
        alert("보험사를 입력해주세요.");
        document.getElementById("insuranceCompany").focus();
        return false;
    }

    //증권번호(policyNumber)가 입력이 되어있지 않으면 증권번호를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("policyNumber").value === ""){
        alert("증권번호를 입력해주세요.");
        document.getElementById("policyNumber").focus();
        return false;
    }

    // 보험종목(insuranceType)이 선택이 되어있지 않으면 구분을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insuranceType").value === ""){
        alert("보험종목을 선택해주세요.");
        document.getElementById("insuranceType").focus();
        return false;
    }

    // 보험 상품(insuranceProductNo)이 선택이 되어있지 않으면 보험 상품을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insuranceProductNo").value === ""){
        alert("보험 상품을 선택해주세요.");
        document.getElementById("insuranceProductName").focus();
        return false;
    }

    // 보험기간 시작(insurancePeriodStart)이 선택이 되어있지 않으면 보험기간 시작을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("start_date").value === ""){
        alert("보험기간 시작을 선택해주세요.");
        document.getElementById("start_date").focus();
        return false;
    }

    // 보험기간 종료(insurancePeriodEnd)이 선택이 되어있지 않으면 보험기간 종료를 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("end_date").value === ""){
        alert("보험기간 종료를 선택해주세요.");
        document.getElementById("end_date").focus();

        return false;
    }

    // 계약일(contract_date)이 선택이 되어있지 않으면 보험기간 종료를 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("contract_date").value === ""){
        alert("계약일을 선택해주세요.");
        document.getElementById("contract_date").focus();

        return false;
    }

    // 보험료(insurancePremium)가 입력이 되어있지 않으면 보험료를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insurancePremium").value === ""){
        alert("보험료를 입력해주세요.");
        document.getElementById("insurancePremium").focus();
        return false;
    }

    // 만기 알림(expirationNotice)이 선택이 되어있지 않으면 만기 알림을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.querySelector('input[name="expirationNotice[]"]:checked') === null){
        alert("만기 알림을 선택해주세요.");
        return false;
    }

    // 청약서류(contractInsurance)가 선택이 되어있지 않으면 보험계약서를 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("contractInsurance").value === ""){
        alert("청약서류를 선택해주세요.");
        document.getElementById("contractInsurance").click();
        return false;
    }

    // 계약 담당자1(contractAdmin1)이 선택이 되어있지 않으면 계약 담당자1을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("contractAdmin1").value === ""){
        alert("계약 담당자1을 선택해주세요.");
        document.getElementById("contractAdmin1").focus();
        return false;
    }

    // 계약 담당자2(contractAdmin2)이 선택이 되어있지 않으면 계약 담당자2을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("contractAdmin2").value === ""){
        alert("계약 담당자2을 선택해주세요.");
        document.getElementById("contractAdmin2").focus();
        return false;
    }

    // 실적배분1(distribution1)이 선택이 되어있지 않으면 실적배분1을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("distribution1").value === ""){
        alert("실적배분1을 선택해주세요.");
        document.getElementById("distribution1").focus();
        return false;
    }

    // 실적배분2(distribution2)이 선택이 되어있지 않으면 실적배분2을 선택하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("distribution2").value === ""){
        alert("실적배분2을 선택해주세요.");
        document.getElementById("distribution2").focus();
        return false;
    }

    // 상품 수수료(insuranceProductCommission)가 입력이 되어있지 않으면 상품 수수료를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("insuranceProductCommission").value === ""){
        alert("상품 수수료를 입력해주세요.");
        document.getElementById("insuranceProductCommission").focus();
        return false;
    }

    // 지급광고비 거래처(advertCostCompany)가 입력이 되어있지 않으면 지급광고비 거래처를 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("advertCostCompany").value === ""){
        alert("지급광고비 거래처를 입력해주세요.");
        document.getElementById("advertCostCompany").focus();
        return false;
    }

    // 지급광고비 수수료율(advertCostCommissionRate)이 입력이 되어있지 않으면 지급광고비 수수료율을 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("advertCostCommissionRate").value === ""){
        alert("지급광고비 수수료율을 입력해주세요.");
        document.getElementById("advertCostCommissionRate").focus();
        return false;
    }

    // 지급광고비 수수료율(advertCostCommissionRate)이 0보다 작거나 100보다 크면 지급광고비 수수료율을 0 ~ 100 사이의 숫자로 입력하라는 alert 창을 띄우고 form 을 submit 하지 않는다.
    if(document.getElementById("advertCostCommissionRate").value < 0 || document.getElementById("advertCostCommissionRate").value > 100){
        alert("지급광고비 수수료율을 0 ~ 100 사이의 숫자로 입력해주세요.");
        document.getElementById("advertCostCommissionRate").focus();
        return false;
    }

    // form 을 submit 한다.
    document.getElementById("contractRegForm").submit();
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

// 종료일이 시작일보다 빠르면 alert출력, focus처리 (팝업된 달력 선택 시)
$(function() {
	$("#end_date").datepicker({
		onSelect: function() {
		var end_date = $("#end_date").datepicker("getDate");
		var start_date = $("#start_date").datepicker("getDate");

		if (end_date < start_date) {
			alert("보험기간 종료일이 보험기간 시작일보다 빠릅니다.");
			$('#end_date').focus()
		}
		},
		dateFormat: "yy-mm-dd"  // 날짜 형식을 YYYY-MM-DD로 설정
	});

});

// 종료일이 시작일보다 빠르면 alert출력, focus처리 (input에 직접 입력시)
document.getElementById("end_date").addEventListener('change', function() {

    console.log(document.getElementById('end_date').value)
    if (document.getElementById('end_date').value < document.getElementById('start_date').value) {
        alert('보험기간 종료일이 보험기간 시작일보다 빠릅니다.');
        document.getElementById('end_date').focus();
        return false;
    }
});

// 만기 알림은 3개까지만 선택할 수 있다.
var expirationNotice = document.getElementsByName("expirationNotice[]");
for (var i = 0; i < expirationNotice.length; i++) {
    expirationNotice[i].addEventListener("change", function() {
        var count = 0;
        for (var i = 0; i < expirationNotice.length; i++) {
            if (expirationNotice[i].checked) {
                count++;
            }
        }
        if (count > 3) {
            alert("만기 알림은 3개까지만 선택할 수 있습니다.");
            this.checked = false;
        }
    });
}


// insuranceProductName 클릭시 openModalBtn 를 클릭한 이벤트 효과 주기
document.getElementById("insuranceProductName").addEventListener("click", function() {
    document.getElementById("openModalBtn").click();
});


// 파일 업로드 다시 개발 S
var contractInsurance = document.getElementById("contractInsurance");
var initLabel = document.getElementById("label");
var maxFileCnt = 5;

contractInsurance.addEventListener("change", (event) => {
    const files = changeEvent(event);

    let parentElement = contractInsurance.parentNode; // 부모노드
    let siblingUls = parentElement.children; // 부모 노드의 자식 들

    let filePreview = findUl(parentElement)
    let noFile = findPtag(parentElement)

    if (filePreview, noFile) {
        let liElements = filePreview.querySelectorAll('li')
        let liLength = liElements.length;
        if (liLength >= 0) {
            filePreview.classList.add('on')
            noFile.classList.add('off')
        } else {
            filePreview.classList.remove('on')
            noFile.classList.remove('off')
        }

    }

    // filepreview 클래스를 가진 태그 찾기
    function findUl(parentNode) {
        let siblings = parentNode.children;
        for (var i = 0; i < siblingUls.length; i++) {
            let siblingUl = siblingUls[i]
            if(siblingUl !== this && siblingUl.classList.contains('filepreview')) {
                return siblingUl
            }
        }
        return null;
    }

    // noFile 클래스를 가진 태그 찾기
    function findPtag(parentNode) {
        let siblings = parentNode.children;
        for (var i = 0; i < siblingUls.length; i++) {
            let siblingUl = siblingUls[i]
            if(siblingUl !== this && siblingUl.classList.contains('noFile')) {
                return siblingUl
            }
        }
        return null;
    }

    // 파일의 개수는 최대 5개까지만 가능합니다. 그리고 자동으로 5개까지만 받습니다.
    if(files.length > maxFileCnt){
        alert("파일은 5개까지만 업로드 가능합니다.");
        files = files.slice(0, maxFileCnt);
    }

    handleUpdate(files);

});

// 파일 삭제 버튼 클릭시
document.querySelector('.filecontainer').addEventListener('click', (event) => {
    if (event.target.classList.contains('fileDelete')) {
        // '.fileDelete'를 클릭한 경우
        let closestLi = event.target.closest('li');
        let parentUl = event.target.closest('.filepreview')
        
        let liLength = parentUl.children.length;
        closestLi.remove()
        
        let fileContainer = parentUl.parentNode;
        let siblingsNofile = fileContainer.children;


        if (liLength <= 1) {
            parentUl.classList.remove('on')
                for (var i = 0; i< siblingsNofile.length; i++) {
                let sibling = siblingsNofile[i]
                if (sibling !== this && sibling.classList.contains('noFile')) {
                    sibling.classList.remove('off')
                }
            }
        }
    }
});



function changeEvent(event){
    const { target } = event;
    return [...target.files];
};

// 파일에 대한 정보를 받아서 preview 에 띄워준다.
/*
추후 고민 할 것 
UI상으로 새로 자료파일이 업로드 되면 예를들어 처음에 1개 올리고 또 다른 폴더에서 3개 올릴때 기존에 올라와 보이는 1개의 파일을 삭제를 해서 안보이게 해야 하는데
지금은 4개가 보이고 백엔드로는 나중에 들어간 3개만 들어가는 상황이다.
*/
function handleUpdate(fileList){
    const preview = document.getElementById("preview");

    // preview 의 자식 노드의 개수가 5개 이면 alert 를 띄우고 5개 까지만 받는다.
    if(preview.childElementCount == maxFileCnt){
        alert("파일은 "+maxFileCnt+"개까지만 업로드 가능합니다.");
        return;
    }

    // fileList 의 개수가 5개 보다 크면 alert 를 띄우고 5개 까지만 받는다.
    if(fileList.length > maxFileCnt){
        alert("파일은 "+maxFileCnt+"개까지만 업로드 가능합니다.");
        fileList = fileList.slice(0, maxFileCnt);
    }

    fileList.forEach((file) => {
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {

            const img = el("img", {
                className: "embed-img",
                src: event.target?.result,
                id: "test",
                onClick:"window.open(this.src)" 
            });
            
            const imgContainer = el("li", { className: "container-img" }, img);
            
            // p태그와 button 태그를 감쌀 div 추가
            new_divTag = document.createElement('div');


            // 파일 이름을 html 로 append 해준다.
            let new_pTag = document.createElement('p');
            let file_name = file.name;
            new_pTag.innerHTML = file_name;


            // 삭제 버튼을 추가한다.
            let new_bTag = document.createElement('button')
            new_bTag.setAttribute("type", "button");
            new_bTag.setAttribute("class", "btn fileDelete");
            new_bTag.setAttribute("title", file_name + " 삭제");

            imgContainer.append(new_divTag);
            new_divTag.append(new_pTag);
            new_divTag.append(new_bTag)


            preview.append(imgContainer);
        });
        reader.readAsDataURL(file);
    });

};

function el(nodeName, attributes, ...children) {
    const node =
    nodeName === "fragment"
        ? document.createDocumentFragment()
        : document.createElement(nodeName);

    Object.entries(attributes).forEach(([key, value]) => {
        if (key === "events") {
            Object.entries(value).forEach(([type, listener]) => {
                node.addEventListener(type, listener);
            });
        } else if (key in node) {
            try {
                node[key] = value;
            } catch (err) {
                node.setAttribute(key, value);
            }
        } else {
            node.setAttribute(key, value);
        }
    });

    children.forEach((childNode) => {
        if (typeof childNode === "string") {
            node.appendChild(document.createTextNode(childNode));
        } else {
            node.appendChild(childNode);
        }
    });

    return node;
}

// 파일 업로드 다시 개발 E

// 연락처와 휴대 전화 입력시 자동 하이픈 common.js 에서 가져옴
$(document).on("keyup", "#companyManagerTel", function(){
    $(this).val(autoHypenPhone( $(this).val() ));
});

// 유입경로 선택에 따른 input 태그 컨트롤
document.getElementById('inflow_channel').addEventListener('change', function(event){
    let action = event.target;
    let selectValue = action.value;
    
    if (selectValue === "ETC") {
        document.getElementById('inflow_channel_etc').disabled = false;
        document.getElementById('inflow_channel_etc').placeholder = '기타경로 입력.';
    } else {
        document.getElementById('inflow_channel_etc').disabled = true;
        document.getElementById('inflow_channel_etc').placeholder = '';
        document.getElementById('inflow_channel_etc').value = '';
    }
})





</script>

<?php
/*
// db table create contract 내용으로는 
계약구분
상태
구분
보험상품
보험기간시작
보험기간종료
견적보험료
계약자(고객)
피보험자
증권번호
보험계약서
보험료
계약일(YYYY-MM-DD)
만기알림
계약담당자 정
계약담당자 부
실적배분 정
실적배분 부
상품수수료 기본
상품수수료 추가
지급광고비 거래처
지급광고비 수수료율
메모
수정일
수정자
등록일
등록자
삭제여부

테이블 생성시 코멘트 까지 포함해서

create table contract (
    no int not null auto_increment comment '계약번호',
    contract_type varchar(10) not null comment '계약구분',
    status varchar(10) not null comment '상태',
    insurance_type varchar(10) not null comment '구분',
    insurance_product_no int not null comment '보험상품',
    insurance_period_start date not null comment '보험기간시작',
    insurance_period_end date not null comment '보험기간종료',
    estimate_insurance_premium int not null comment '견적보험료',
    customer_no int not null comment '계약자(고객)',
    insurant varchar(50) not null comment '피보험자',
    policy_number varchar(50) not null comment '증권번호',
    contract_insurance varchar(50) not null comment '보험계약서',
    insurance_premium int not null comment '보험료',
    contract_date date not null comment '계약일(YYYY-MM-DD)',
    expiration_notice varchar(50) not null comment '만기알림',
    contract_admin1 varchar(30) not null comment '계약담당자 정',
    contract_admin2 varchar(30) not null comment '계약담당자 부',
    distribution1 int NOT NULL DEFAULT '0' comment '실적배분 정',
    distribution2 int NOT NULL DEFAULT '0' comment '실적배분 부',
    insurance_product_commission int not null comment '상품수수료 기본',
    insurance_product_additional_commission int  comment '상품수수료 추가',
    advert_cost_company varchar(50) not null comment '지급광고비 거래처',
    advert_cost_commission_rate int NOT NULL DEFAULT '0' comment '지급광고비 수수료율',
    memo text DEFAULT NULL comment '메모', 
    update_date datetime DEFAULT NULL comment '수정일',
    update_user_no int not null comment '수정자',
    create_date datetime DEFAULT NULL comment '등록일',
    create_user_no int not null comment '등록자',
    delete_yn enum('Y','N') NOT NULL DEFAULT 'N' comment '삭제여부',
    primary key(no)
) comment '계약';



*/



