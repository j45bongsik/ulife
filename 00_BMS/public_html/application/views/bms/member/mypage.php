
<script type="text/javascript">
// 달력 script
$(document).ready(function() {
    var today = new Date();
    var tomorrow = new Date(Date.parse(today) + (1000 * 60 * 60 * 24));
    $("#start_date_s").datepicker({
        // showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "../img/service/icon-calendar.svg?e",
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

    $(" #start_date_e").datepicker({
        // showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "../img/service/icon-calendar.svg?e",
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
            <div class="tableArea">
                <h1>내 업무</h1> <!--마이페이지-->
            </div>
            
            <form name="searchForm" id="searchForm" method="get" action="/mypage" autocomplete="off">
                <article class="erpList reg table">
                    <div class="titleArea">
                        <h2 class="thirdTitle">
                            계약중인 리스트
                        </h2>
                    </div>
                    <table>
                        <caption>
                            내업무 - 계약중인 리스트 테이블로 거래처명, 사업자번호, 증권번호, 보험상품, 보험기간 등의 정보를 입력하고 검색합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="customer_name">
                                        계약자
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="customer_name" id="customer_name" placeholder="거래처명 입력" value="<?=$SEARCHDATA['customerCompanyName']?>">
                                    
                                </td>
                                <th scope="row">
                                    <label for="business_number">
                                        사업자번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="business_number" id="business_number" placeholder="사업자번호 입력(111-22-33333)" value="<?=$SEARCHDATA['business_number']?>">
                                </td>
                                <th scope="row">
                                    <label for="policy_number">
                                        증권번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="policy_number" id="policy_number" placeholder="증권번호 입력" value="<?=$SEARCHDATA['policy_number']?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="">
                                        보험상품
                                    </label>
                                </th>
                                <td>
                                    <div class="search-item radius-5">
                                        <i class="icon-search" id="openModalBtn">검색아이콘</i>
                                        <input type="search" name="insuranceProductName" id="bhItemInput" class="input" placeholder="보험상품명" value="<?=$SEARCHDATA['insuranceProductName']?>">
                                        <button class="btnClear"></button>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="">
                                        보험기간
                                    </label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="date_picker">
                                            <input type="text" class="picker format-date" name="start_date_s" id="start_date_s"  placeholder="YYYY-MM-DD" maxlength="10" autocomplete='off' value='<?=$SEARCHDATA['searchDateType']?>'>
                                        </div>
                                        <span class="between">~</span>
                                        <div class="date_picker">
                                            <input type="text" class="picker format-date" name="start_date_e" id="start_date_e"  placeholder="YYYY-MM-DD" maxlength="10" autocomplete='off' value='<?=$SEARCHDATA['searchDateType2']?>'>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <div class="btn-box-conts">
                    <!-- inputs submit -->
                    <div class="inputBox search">
                        <label for="inputSearch">
                            <i class="ico search"></i>
                            <input type="submit" id="inputSearch" class="btn search" value="검색" title="검색">
                        </label>
                    </div>
                    <!-- //inputs submit -->
                </div>
            </form>

            <div class="memb-table">
                <table>
                    <colgroup>
                        <col width="4%">
                        <col width="7%">
                        <col width="8%">
                        <col width="*">
                        <col width="8%">                        
                        <col width="8%">
                        <col width="12%">
                        <col width="7%">
                        <col width="8%">
                        <col width="10%">
                        <col width="auto;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>상태</th>
                            <th>보험종목</th>
                            <th>보험상품</th>
                            <th>계약자</th>
                            <th>피보험자</th>
                            <th>보험 기간</th>
                            <th>거래처 담당자</th>
                            <th>연락처</th>
                            <th>이메일</th>
                            <th>계약 담당자 (주/부)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$GETMYCONTRACTLISTDATALISTTABLE?>
                    </tbody>
                </table>
				<?=$PAGINATION?>
            </div>

            
            <div class="memb-table">
                <article class="searchArea">
                    <div class="titleArea">
                        <h2 class="thirdTitle">만기 도래 리스트</h2>
                    </div>
                    <div class="btnArea">
                        <a href="member/excelDownContractListByEndDate" class="btn file">엑셀다운</a>
                    </div>
                </article>
                <table>
                    <colgroup>
                        <col width="4%">
                        <col width="7%">
                        <col width="8%">
                        <col width="6%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="12%">
                        <col width="7%">
                        <col width="10%">
                        <col width="10%">
                        <col width="12%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>상태</th>
                            <th>보험종목</th>
                            <th>상품명</th>
                            <th>계약자</th>
                            <th>피보험자</th>
                            <th>계약일</th>
                            <th>보험 기간</th>
                            <th>거래처 담당자</th>
                            <th>연락처</th>
                            <th>이메일</th>
                            <th>갱신 알림</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$GETCONTRACTLISTBYENDDATELISTTABLE?>
                    </tbody>
                </table>
				<?php //include $_SERVER['DOCUMENT_ROOT']."/CRM/service/pagination.php"; ?>
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
			<form>
                <?=$GETMYCONTRACTLISTRADIO?>
			</form>
			<div class="modalBtn">
				<button type="button" class="button selectBtn">선택</button>
    
                <button onclick="location.href='/insuranceProduct_reg'" class="button">추가</button>

			</div>
		</div>
	</div>
</div>

<script>

//******모달창_보험상품 검색

 // 모달 열기 버튼 클릭 시
document.getElementById("openModalBtn").addEventListener("click", function() {
    document.getElementById("myModal").style.display = "flex";
});

// 모달 닫기 버튼 클릭 시
document.getElementById("closeModalBtn").addEventListener("click", function() {
    document.getElementById("myModal").style.display = "none";
});

// 선택 버튼 클릭시 모달 닫기
document.querySelector('.selectBtn').addEventListener('click', function(){
    document.getElementById("myModal").style.display = "none";
})

// 모달 바깥 영역 클릭 시 모달 닫기
window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});


// 엔터 키 클릭 이벤트
document.getElementById("bhItemInput").addEventListener("keyup", function(event) {
	if (event.key === "Enter") {
		document.getElementById("openModalBtn").click();
	}
});

// 모달창_보험상품 검색_라디오버튼 클릭 시 value 값을 input에 넣기 함수로 처리
function insert_bhItemInput(value) {
    var bhItemInput = document.getElementById("bhItemInput");
    bhItemInput.value = value;
}





</script>