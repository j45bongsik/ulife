<!--
개발 메모 
카드 승인 내역 검색 조건 날짜 범위 검색 기준은 청구일 기준검색 추가 
예를 들어 청구일이 2023 01 ~ 2023 12 내에 사용한 내용을 검색
년도는 숫자 입력, 월은 01~12월 까지 선택select box 사용

분류는 대 중 소 카테고리 
대 선택시 중 / 중 선택시 소 해당 내용은 [메일로 받은 : ERP 매출, 매일 분류표 첨부 : 2024-04-16 15:30:07 ] 참고 




-->
<div class="conts-box">
    <div class="titleArea">
        <h1>법인카드 사용내역</h1>
    </div>

    <!-- form -->
    <form name="searchForm" id="searchForm" method="get" action="/cardBreakdown">
        <!-- searchArea -->
        <article class="searchArea">
            <div class="inputArea">
                <!-- select-custom -->
                <div class="select-custom"><!-- 승인일 : -->
                    <select name="searchDateY" id="searchDateY">
                        <?=$FROMSINCEYEAR?>
                    </select>
                </div>
                <!-- //select-custom -->

                <!-- select-custom -->
                <div class="select-custom">
                    <select name="searchDateM" id="searchDateM">
                        <?=$FROMSINCEMONTH?>
                    </select>
                </div>
                <!-- //select-custom -->

                <!-- select-custom -->
                <div class="select-custom">
                    <select name="useType" id="useType">
                        <?=$CARDUSECATEGORYLISTOPTION?>
                    </select>
                </div>
                <!-- //select-custom -->

                <label for="useHistory">
                    <input type="text" name="useHistory" id="useHistory" placeholder="사용내역" autocomplete='off' value="">
                </label>

                <!-- inputBox -->
                <div class="inputBox">
                    <label for="inputSearch">
                        <i class="ico search"></i>
                        <input type="submit" id="inputSearch" class="btn search" value="검색" title="검색">
                    </label>
                </div>
                <!-- //inputBox -->
            </div>

            <!-- btnArea -->
            <div class="btnArea">
                <a <?=$CARDBREAKDOWNLISTEXCEL?> class="btn file">엑셀다운</a>
            </div>
            <!-- //btnArea -->
        </article>
        <!-- //searchArea -->
    </form>
    <!-- //form -->


    <!-- memb-table -->
    <article class="memb-table erpList link">
        <table>
            <caption>
                카드사용내역 테이블로 순번, 승인일, 청구일, 카드번호, 소유자, 분류, 가맹점, 승인번호, 사용내역, 청구원금, 청구원금 합계 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: 80px;">
                <col style="width: 80px;">
                <col style="width: 130px;">
                <col style="width: 100px;">
                <col style="width: 70px;">
                <col style="width: auto;">
                <col style="width: 120px;">
                <col style="width: auto;">
                <col style="width: 100px;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">승인일</th>
                    <th scope="col">청구일</th>
                    <th scope="col">카드번호</th>
                    <th scope="col">소유자</th>
                    <th scope="col">분류</th>
                    <th scope="col">가맹점</th>
                    <th scope="col">승인번호</th>
                    <th scope="col">사용내역</th>
                    <th scope="col">청구원금</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- 페이지 당 tr은 max 10개까지만 -->
                <?=$TR?>
            </tbody>
        </table>
        
        <div class="sumArea">
            <ul>
                <li>
                    <p>총 합계</p>
                </li>
                <li>
                    <p class="totalAmount"><?=$CARDBREAKDOWNTOTALSUM?></p>
                </li>
            </ul>
        </div>
    </article>
    <!-- //memb-table -->

    <!-- paginate -->
    <!--
    <div class="paginate">        
        <a href="" rel="start"><i class="prev-arrow-double"></i></a>
        <a href="" rel="prev"><i class="prev-arrow"></i></a>
        <a href="">1</a>
        <strong>2</strong>
        <a href="">3</a>
        <a href="" rel="next"><i class="next-arrow"></i></a>
        <a href="" rel="last"><i class="next-arrow-double"></i></a>
    </div>
    -->
    <?=$PAGINATION?>
    <!-- //paginate -->
</div>

<!-- /** 모달창_사용내역 등록 -->

<!--속성,속성값 삭제해주세요 style="display: flex;" -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <!-- form -->
        <form id="useHistoryModal" name="useHistoryModal" >
            <div class="close closeModalBtn">
                <span class="x-top"></span>
                <span class="x-bottom"></span>
            </div>
            <h4>사용 내역 등록</h4>
            <div class="modal-form">
                <div class="table modalList">
                    <table>
                        <caption>
                            사용내역등록 테이블로 승인일, 가맹점의 정보를 제공하고 분류, 사용내역을 등록할수 있습니다.
                        </caption>
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 75%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">승인일</th>
                                <td id="confirmDate" class="hypen">-</td>
                            </tr>
                            
                            <tr>
                                <th scope="row">가맹점</th>
                                <td id="franchise">-</td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="useTypeDetail" class="essential">
                                        분류
                                    </label>
                                </th>
                                <td>
                                    <!-- select-custom -->
                                    <div class="select-custom">
                                        <select name="useTypeDetail" id="useTypeDetail">
                                            <?=$CARDUSECATEGORYLISTOPTION?>
                                        </select>
                                    </div>
                                    <!-- //select-custom -->
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="useHistoryDetail" class="essential">
                                        사용내역
                                    </label>
                                </th>
                                <td>
                                    <label for="useHistoryDetail">
                                        <input type="text" name="useHistoryDetail" id="useHistoryDetail" value="" placeholder="사용내역을 입력하세요.">
                                    </label>
                                </td>
                            </tr>
                            <tr style="display: none;">
                                <th> 사용내역<br />번호 </th>
                                <td> <input type="hidden" name="cardhistoryno" id="cardhistoryno" value=""> </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modalBtn">
                    
                    <button type="button" id="useHitorySave" class="button">저장</button>  
                    <button type="button" class="button closeModalBtn">닫기</button>
                </div>
            </div>
        </form>
        <!-- //form -->
    </div>
</div>

<div class="toastArea success">
    <span class="ico">
        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" fill-rule="evenodd"></path>
        </svg>
    </span>

    <div class="descArea">
        <p class="toastTitle">
            사용내역 등록(변경) 완료
        </p>
        <p class="desc editFranchise">
            <span id="toastFranchise" class="franchise">
                
            </span>
        </p>
        <p class="desc editDate">
            <span>승인일</span>
            <span class="between">:</span>
            <span id="toastDate" class="date hypen">
                
            </span>
            
        </p>
        
    </div>
</div>

<div class="toastArea fail">
    <span class="ico">
        <svg
            class="error-svg"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            aria-hidden="true"
            >
            <path
            fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
            clip-rule="evenodd"
            ></path>
        </svg>
    </span>

    <div class="descArea">
        <p class="toastTitle">
            사용내역 변경 실패
        </p>
    </div>
</div>



<script>

//******모달창_보험상품 검색

// 모달 열기 버튼 클릭 시
/*

<tr class='openModalBtn'>
    <td no="1591">38</td>
    <td>20230607</td>
    <td>20230715</td>
    <td>5585-2693-9559-4800</td>
    <td>권기형<br>(thekwons)</td>
    <td histiryCode="002">주유비</td>
    <td>KCP(통신판매)-파킹클라우드(주)</td>
    <td>30086448</td>
    <td>사용내역입니다. </td>
    <td>750</td>
</tr>


// 모달창 구조
<th scope="row">
        <label for="useHistoryDetail" class="essential">
            사용내역
        </label>
    </th>
    <td>
        <label for="useHistoryDetail">
            <input type="text" name="useHistoryDetail" id="useHistoryDetail" value="" required placeholder="사용내역을 입력하세요.">
        </label>
    </td>
</tr>
<tr>
    <th> 사용내역 번호 </th>
    <td> <input type="text" name="cardhistoryno" id="cardhistoryno" value=""> </td>
*/


// 모달 닫기 버튼 클릭 시
document.querySelectorAll(".closeModalBtn").forEach(function(closes){
    closes.addEventListener("click", function() {
        document.getElementById("myModal").style.display = "none";
    });
})

// 모달 바깥 영역 클릭 시 모달 닫기
window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// tr을 클릭하면 td의 값을 배열에 담고 각각의 tag를 추적해 attr, value, text를 팝업창에 설정
document.querySelectorAll('.openModalBtn').forEach(function(opens){
    opens.addEventListener('click', function(event){
        let cardArray = [];

        // 각각의 td를 추적해 배열에 담는다
        this.querySelectorAll('td').forEach(function(td, index){
            // 엘리먼트 추적
            let text = td.innerText.trim();
            let noAttr = td.getAttribute('no')
            let dataAttr = td.getAttribute('data')
            let propertyName;

            switch(index) {
                case 0:
                    propertyName = 'cardhistoryno';
                    break;
                case 1:
                    propertyName = 'confirmDate';
                    break;
                case 2:
                    propertyName = 'demandDate';
                    break;
                case 3:
                    propertyName = 'cardNumber';
                    break;
                case 4:
                    propertyName = 'owner';
                    break;
                case 5:
                    propertyName = 'useTypeDetail';
                    break;
                case 6:
                    propertyName = 'franchise';
                    break;
                case 7:
                    propertyName = 'confirmNumber';
                    break;
                case 8:
                    propertyName = 'useHistoryDetail';
                    break;
                case 9:
                    propertyName = 'price';
                    break;
            }

            if (propertyName) {
                cardArray.push({ [propertyName]: text });
                let idName = document.getElementById(propertyName);
                if (idName) {

                    // input[text]일때
                    if (idName.tagName.toLowerCase() === 'input' && idName.type.toLowerCase() === 'text') {
                        idName.value = text;
                    
                    // input[hidden]일때
                    } else if (idName.tagName.toLowerCase() === 'input' && idName.type.toLowerCase() === 'hidden') {
                        idName.value = noAttr;

                    // select일때
                    } else if (idName.tagName.toLowerCase() === 'select') {
                        let options = idName.querySelectorAll('option');
                        let selectedOptionIndex = 0;

                        options.forEach((option, index) => {
                            if (dataAttr === option.value) {
                                selectedOptionIndex = index;
                            }
                        });

                        idName.selectedIndex = selectedOptionIndex;
                    
                    // 그 외 (form태그가 아닐때)
                    } else {
                        idName.innerText = text;
                    }
                }
            }
        });

        document.getElementById("myModal").style.display = "flex";
    });
});

let zIndexPlus = 1;

// 팝업창의 submit 클릭시 값들을 담아 list에 설정
document.getElementById('useHitorySave').addEventListener('click', function(event){
    // 엘리먼트 추적 
    let noValue = document.getElementById('cardhistoryno').value; // hidden에 담긴 value(number)
    let useTypeDetailValue = document.getElementById('useTypeDetail'); // 분류
    let selectedOption = useTypeDetailValue.options[useTypeDetailValue.selectedIndex]; // 선택된 select의 option
    let selectedOptionText = selectedOption.innerText; // 선택된 option의 텍스트
    let selectedOptionValue = selectedOption.value; // 선택된 option의 값
    let useHistoryDetailValue = document.getElementById('useHistoryDetail').value; // 사용내역의 value값

    // select 요소의 값이 "000"이거나 비어 있으면 alert 호출(분류)
    if (selectedOptionValue === "000" || selectedOptionValue === "") {
        alert("분류를 선택하세요.");
        useTypeDetail.focus()
        return false;
    }

    // input 요소의 값이 비어있으면 alert 호출(사용내역)
    if (useHistoryDetailValue === "") {
        alert("사용내역을 입력하세요.")
        useHistoryDetail.focus()
        return false;
    }

    // select 요소의 값이 "000" or 비어있지 않고 input value값이 비어있지 않으면 실행
    if ((selectedOptionValue !== "000" || selectedOptionValue !== "") && useHistoryDetailValue !== "") {
        // 분류와 사용내역을 각각의 매치된 영역에 설정
        document.getElementById('useTypeDetailMatch'+ noValue).innerText = selectedOptionText;
        document.getElementById('useTypeDetailMatch'+ noValue).setAttribute('data', selectedOptionValue);
        document.getElementById('useHistoryDetailMatch' + noValue).innerText = useHistoryDetailValue;

        // 모달 닫기
        document.getElementById("myModal").style.display = "none";

        // toast에 담기위한 text 추적
        let confirmDate = document.getElementById('confirmDate').innerText;
        let franchise = document.getElementById('franchise').innerText;
        
        let toastDate = document.getElementById('toastDate');
        let toastFranchise = document.getElementById('toastFranchise');


        toastDate.innerText = confirmDate;
        toastFranchise.innerText = franchise;
        zIndexPlus++;

        // ajax로 데이터 전송 (사용내역번호, 분류속성코드, 사용내역) 넘어온 데이터 타입은 json
        $.ajax({
            url: '/financialmanagement/cardUseHistoryUpdate',
            type: 'POST',
            data: {
                no: noValue,
                useType: selectedOptionValue,
                useHistory: useHistoryDetailValue
            },
            dataType: 'json',
            success: function(data){
                // data 의 result 값이 success이면 콘솔에 성공 출력
                let toastAreaSeccess = document.querySelector('.toastArea.success');
                let toastAreaFail = document.querySelector('.toastArea.fail');

                if(data.result === 'success') {

                    toastAreaFail.classList.remove('active')
                    toastAreaSeccess.classList.add('active');
                    toastAreaSeccess.style.zIndex = zIndexPlus;

                    let timeoutID = setTimeout(function() {
                        toastAreaSeccess.classList.remove('active');
                        clearTimeout(timeoutID); // 작업 완료 후 타이머 삭제
                    }, 5000);

                } else {
                    // 그 외의 값이면 콘솔에 data 출력
                    console.log(data);

                    toastAreaSeccess.classList.remove('active')
                    toastAreaFail.classList.add('active');
                    toastAreaFail.style.zIndex = zIndexPlus;

                    let timeoutID = setTimeout(function() {
                        toastAreaFail.classList.remove('active');
                        clearTimeout(timeoutID); // 작업 완료 후 타이머 삭제
                    }, 5000);
                }
            }
        });

    }

});

// 마지막 td에 있는 값(금액)이 마이너스(-) 값이면 파란색 볼드 표기
document.addEventListener('DOMContentLoaded', function(){
    let tdTags = document.querySelectorAll('.erpList tr td:last-child');
    
    tdTags.forEach(function(td){
        let tdText = td.innerText;
        
        let firstChar = tdText.trim().charAt(0);
        if (firstChar === '-') {
            td.style.color = 'blue';
            td.style.fontWeight = '600';
        }
    });
});






</script>