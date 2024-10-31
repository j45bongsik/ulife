<div class="conts-box">
        <div class="titleArea">
            <h1>보험 계약 정보</h1>
            <!-- <div class="indvd-bsns">
                <?=$CONTRACTSTATUSBOX?>
            </div> -->
        </div>

        <article class="erpList reg view">
            <div class="titleArea">
                <h2 class="thirdTitle">계약정보</h2>
            </div>
            <table>
                <caption>
                    보험계약정보 - 계약정보 테이블로 계약자(고객), 피보험자, 증권번호, 보험계약서, 보험료, 계약일 등의 정보를 제공합니다.
                </caption>
                <colgroup>
                    <col style="width: 175px;">
                    <col style="width: auto;">
                    <col style="width: 175px;">
                    <col style="width: auto;">
                </colgroup>
                <tbody>
                    <tr>
                        <th>계약구분</th>
                        <td>
                            <p>
                                <?=$CONTRACTTYPEBOX?>
                            </p>
                        </td>
                        <th>
                            유입경로
                        </th>
                        <td>
                            <p>
                                <?=$CONTRACTSTATUSBOX?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            계약자
                        </th>
                        <td>
                            <p>
                                <?=$CUSTOMERCOMPANYNAME?>
                            </p>
                        </td>
                        <th>
                            피보험자
                        </th>
                        <td>
                            <p>
                                <?=$INSURANT?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            보험사
                        </th>
                        <td>
                            <p>
                                보험사 추가
                            </p>
                        </td>
                        <th>
                            증권번호
                        </th>
                        <td>
                            <p>
                                <?=$POLICY_NUMBER?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            보험종목
                        </th>
                        <td>
                            <p>
                                <?=$INSURANCE_TYPE?>
                            </p>
                        </td>
                        <th>
                            보험상품
                        </th>
                        <td>
                            <p>
                                <?=$INSURANCE_PRODUCT_NAME?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            보험기간
                        </th>
                        <td>
                            <div class="checkArea">
                                <p>
                                    <?=$INSURANCE_PERIOD_START?>
                                </p>
                                <span class="between">~</span>
                                <p>
                                    <?=$INSURANCE_PERIOD_END?>
                                </p>
                            </div>
                        </td>
                        <th>
                            계약일
                        </th>
                        <td>
                            <p>
                                계약일 추가
                            </p>
                        </td>
                        
                    </tr>
                    <tr>
                        <th>
                            전년도 보험료
                        </th>
                        <td>
                            <div class="checkArea">
                                <p class="comma">
                                    <?=$PREVYEARPREMIUM?>
                                </p>
                                <span class="between leftPadding">
                                    원
                                </span>  
                            </div>
                        </td>
                        <th>
                            보험료
                        </th>
                        <td>
                            <div class="checkArea">
                                <p class="comma">
                                    <?=$INSURANCE_PREMIUM?>
                                </p>
                                <span class="between leftPadding">
                                    원
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        
                        <th>
                            청약서류
                        </th>
                        <td colspan="3">
                            <?=$CONTRACT_INSURANCE_DOWN?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            담당자
                        </th>
                        <td>
                            <p>
                                <?=$MANAGERNAME?>
                            </p>
                        </td>
                        <th>
                            연락처
                        </th>
                        <td>
                            <p>
                            <?=$MANAGERTEL?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article class="erpList reg view">
            <div class="titleArea">
                <h2 class="thirdTitle">
                    계약담당
                </h2>
            </div>
            <table>
                <caption>
                    보험계약정보 - 계약담당 테이블로 계약담당자(주/부), 실적배분(주/부) 등의 정보를 제공합니다.
                </caption>
                <colgroup>
                    <col style="width: 175px;">
                    <col style="width: auto;">
                    <col style="width: 175px;">
                    <col style="width: auto;">
                </colgroup>
                <tbody>
                    <tr>
                        <th>
                            계약담당자
                        </th>
                        <td>
                            <div class="inputArea">
                            <div class="second-wrap">
                                <span class="between rightPadding">주 :</span>
                                    <p>
                                        <?=$CONTRACT_ADMIN_NAME1?>
                                    </p>
                                </div>

                                <div class="second-wrap">
                                    <span class="between rightPadding">부 :</span>
                                    <p>
                                        <?=$CONTRACT_ADMIN_NAME2?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <th>
                            실적배분
                        </th>
                        <td>
                            <div class="inputArea">
                                <div class="second-wrap">
                                    <span class="between rightPadding">주 :</span>
                                    <p>
                                        <span>
                                            <?=$DISTRIBUTION1?>
                                        </span>
                                    </p>
                                    <span class="between leftPadding">
                                        %
                                    </span>
                                    
                                </div>
                                
                                <div class="second-wrap">
                                    <span class="between rightPadding">부 :</span>
                                    <p>
                                        <span>
                                            <?=$DISTRIBUTION2?>
                                        </span>
                                    </p>
                                    <span class="between leftPadding">
                                        %
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article class="erpList reg view">
            <div class="titleArea">
                <h2 class="thirdTitle">수수료</h2>
            </div>
            <table>
                <caption>
                    보험계약정보 - 수수료 테이블로 상품수수료, 지급광고비 등의 정보를 제공합니다.
                </caption>
                <colgroup>
                    <col style="width: 175px;">
                    <col style="width: auto;">
                    <col style="width: 175px;">
                    <col style="width: auto;">
                </colgroup>
                <tbody>
                    <tr>
                        <th>
                            상품수수료
                        </th>
                        <td>
                            <div class="inputArea">
                                <div class="third-wrap">
                                    <span class="between rightPadding">
                                        기본 :
                                    </span>
                                    <p>
                                        <span>
                                            <?=$INSURANCE_PRODUCT_COMMISSION?>
                                        </span>
                                    </p>
                                    <span class="between leftPadding">%</span>
                                </div>
                                <span class="between">+</span>
                                <div class="third-wrap">
                                    <span class="between rightPadding">
                                        추가 :
                                    </span>
                                    <p>
                                        <span>
                                            <?=$INSURANCE_PRODUCT_ADDITIONAL_COMMISSION?>
                                        </span>
                                    </p>
                                    <span class="between leftPadding">%</span>
                                </div>
                            </div>
                        </td>
                        <th>
                            지급광고비
                        </th>
                        <td>
                            <div class="inputArea">
                                <div class="advert-cost">
                                    <div class="cost">

                                        <span class="between rightPadding">거래처 :</span>
                                        <p>
                                            <?=$ADVERT_COST_COMPANY?>
                                        </p>
                                    </div>
                                    <span class="between">|</span>
                                    <div class="cost">
                                        <p>
                                            <?=$ADVERT_COST_COMMISSION_RATE?>
                                            
                                        </p>
                                        <span class="between leftPadding">%</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article class="erpList reg view">
            <div class="titleArea">
                <h2 class="thirdTitle">
                    기타
                </h2>
            </div>
            <table>
                <caption>
                    보험계약정보 - 기타 테이블로 메모 등의 정보를 제공합니다.
                </caption>
                <colgroup>
                    <col style="width: 175px;">
                    <col style="width: auto;">
                    <col style="width: 175px;">
                    <col style="width: auto;">
                </colgroup>
                <tbody>
                    <tr>
                        <th>
                            메모
                        </th>
                        <td>
                            <p>
                                <?=$MEMO?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>

        <form name="history_form" id="history_form" method="post" enctype="multipart/form-data">
            <article class="erpList reg">
                <div class="titleArea">
                    <h2 class="thirdTitle">작업</h2>
                </div>
                <table>
                    <caption>
                        보험계약정보 - 작업 테이블로 전화/이메일/방문/견적발행 종류를 선택하고 추가사항 파일을 추가 작성합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 175px;">
                        <col style="width: auto;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>
                                <strong><?=$USERNAME?></strong>
                                <button type="button" class="button file-btn" id="historyAdd"><i class="icon-file">저장 아이콘</i>저장</button>
                            </th>
                            <td>
                                <div class="taskWrap">
                                    <div class="task-box">
                                        <div class="radiobox">
                                            <input type="hidden" name="contract_no" value="<?=$NO?>" id="contract_no">
                                            <input type="hidden" name="userid" value="<?=$USERID?>" id="userid">
                                            <input type="hidden" name="username" value="<?=$USERNAME?>" id="username">
                                            <input type="radio" name="taskGr" class="radio-custom" value="tel" id="task1" checked>
                                            <label for="task1" class="radio-custom-label">전화</label>
                                        </div>
                                        <div class="radiobox">
                                            <input type="radio" name="taskGr" class="radio-custom" value="email" id="task2">
                                            <label for="task2" class="radio-custom-label">이메일</label>
                                        </div>
                                        <div class="radiobox">
                                            <input type="radio" name="taskGr" class="radio-custom" value="visit" id="task3">
                                            <label for="task3" class="radio-custom-label">방문</label>
                                        </div>
                                        <div class="radiobox">
                                            <input type="radio" name="taskGr" class="radio-custom" value="estimate" id="task4">
                                            <label for="task4" class="radio-custom-label">견적발행</label>
                                        </div>
                                    </div>

                                    <div class="inputArea">
                                        <textarea name="add_history" id="add_history" class="textarea1" placeholder="추가 사항 입력"></textarea>
                                    </div>

                                    <div class="fileArea file-add">
                                        <label for="fileAdd" class="add-file-btn">찾아보기</label>
                                        <input type="file" name="str-Image1" id="fileAdd">
                                        <p class="noFile">등록된 파일이 없습니다.</p>
                                        <ul class="fileList">
                                        </ul>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>
        </form>

        <article class="erpList reg view">
            <div class="titleArea">
                <h2 class="thirdTitle">히스토리</h2>
            </div>
            <table>
                <caption>
                    보험계약정보 - 히스토리 테이블로  전화/이메일/방문/견적발행 중에 입력된 정보와 입력된 추가사항 등의 정보를 제공합니다.
                </caption>
                <colgroup>
                    <col style="width: 175px;">
                    <col style="width: auto;">
                </colgroup>
                <tbody id="historyList">
                    <?=$CONSULTHISTORYLISTLI?>
                    
                </tbody>
            </table>
        </article>
    </div>


<script>        


// add_histoty인 textarea태그에 empty 클래스가 있는상태에서 textarea의 value값이 비어있지 않게 될경우 empty 클래스 삭제
document.getElementById('add_history').addEventListener('input', function(event) {
    if (this.classList.contains('empty') && this.value !== '') {
        this.classList.remove('empty');
    }
});

// historyAdd 버튼 클릭시 히스토리 추가 ajax로 처리 후 성공시 히스토리 id가 historyList 에 해당 내용을 append 한다.
document.getElementById("historyAdd").addEventListener("click", function() {
    var form = $('#history_form')[0]; 
    var data = new FormData(form);

    let addHistory = document.getElementById('add_history');
    let addHistoryValue = addHistory.value;



    if (addHistoryValue !== '') {
        $.ajax({
            url: "/contract/ajaxhistoryAdd",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,    
            contentType: false, 
            cache: false,
            data: data,
            dataType: "json",        
            success: function(data) {
                // 히스토리 리스트 최상단에 prepend를 사용해서 추가
                $('#historyList').prepend(data.consultHistoryListLi);
                // 작업내용 초기화
                $('#add_history').val('');
                // 파일 초기화
                $('#fileAdd').val('');
                //console.log(data.msg);

                // 엘리먼트 추적
                let noFile = document.querySelector('.noFile');
                let fileList = document.querySelector('.fileList');
                let liTag = fileList.querySelector('li')

                noFile.classList.remove('off');
                fileList.classList.remove('on')
                
                if (liTag) {
                    liTag.remove();
                }
            },
            error: function(data) {
                alert("히스토리 추가 실패");
            }
            
        });
        } else {
            event.preventDefault();
            alert('추가사항을 입력해 주세요.');
            addHistory.classList.add('empty');
            addHistory.focus();
        }


    // ajax ( url : /contract/ajaxhistoryAdd ) 처리 후 성공시 아래 내용을 append 한다. // 리턴 받는 data type 은 json 으로 한다.
    
});



/*
// 수정 버튼을 누르면 수정하고 리스트 페이지로 이동
document.getElementById("info").addEventListener("click", function() {
    var form = $('#modify_form')[0]; 
    var data = new FormData(form);

    // ajax ( url : /contract/ajaxModify ) 처리 후 성공시 리스트 페이지로 이동
    $.ajax({
        url: "/contract/ajaxModify",
        type: "POST",
        enctype: 'multipart/form-data',
        processData: false,    
        contentType: false, 
        cache: false,
        data: data,
        success: function(data) {
            // 리스트 페이지로 이동
            //location.href = "/contract";
            console.log(data);
        },
        error: function(data) {
            alert("수정 실패");

        }
        
    });
});
*/



</script>



<!--

                                <a class="button file-btn" id="historyAdd"><i class="icon-file">저장 아이콘</i>저장</a> ->
                                <label for="historyAdd" class="button file-btn">
                                    <i class="icon-file">저장 아이콘</i>저장
                                    <input type="submit" id="historyAdd" value="" >
                                </label>
                                <button type="button" class="button file-btn" id="historyAdd"><i class="icon-file">저장 아이콘</i>저장</button> --



-->