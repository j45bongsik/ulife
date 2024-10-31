<script type="text/javascript">
// 달력 script
$(document).ready(function() {
    var today = new Date();
    var tomorrow = new Date(Date.parse(today) + (1000 * 60 * 60 * 24));

    $("#start_date_s").datepicker({
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
    $(" #start_date_e").datepicker({
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
                <h1>보험 계약</h1>
            </div>

            <form name="searchForm" id="searchForm" method="get" action="/contract">
                <article class="erpList reg table">
                    <table>
                        <caption>
                            보험계약 테이블로 거래처(고객사), 사업자번호, 증권번호, 구분, 거래처담당자, 청약일, 보험기간, 계약담당자 등의 정보를 입력하고 검색합니다.
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
                                    <label for="customer_name">거래처(고객사)</label>
                                </th>
                                <td>
                                    <input type="text" name="customer_name" id="customer_name" placeholder="거래처명 입력" value="<?=$SEARCHDATA['customerCompanyName']?>">
                                </td>
                                <th scope="row">
                                    <label for="business_number">사업자번호</label>
                                </th>
                                <td>
                                    <input type="text" name="business_number" id="business_number" placeholder="사업자번호 입력" value="<?=$SEARCHDATA['business_number']?>">
                                </td>
                                <th scope="row">
                                    <label for="policy_number">증권번호</label>
                                </th>
                                <td>
                                    <input type="text" name="policy_number" id="policy_number" placeholder="증권번호 입력" value="<?=$SEARCHDATA['policy_number']?>">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="insuranceType">구분</label>
                                </th>
                                <td>
                                    <div class="select-custom">
                                        <select name="insuranceType" id="insuranceType">
                                            <?=$INSURANCETYPESELECTBOX?>
                                        </select>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="manager_name">거래처 담당자</label>
                                </th>
                                <td>
                                    <input type="text" name="manager_name" id="manager_name" placeholder="거래처 담당자 입력" value="<?=$SEARCHDATA['manager_name']?>">
                                </td>
                                <th scope="row">
                                    <label for="searchDateY">청약일</label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <div class="select-custom">
                                            <select name="searchDateY" id="searchDateY">
                                                <option value="" selected>년 선택</option>
                                                <?=$FROMSINCEYEAR?>
                                            </select>
                                        </div>
                                        <span class="between">/</span>
                                        <div class="select-custom">
                                            <select name="searchDateM" id="searchDateM">
                                                <option value="" selected>월 선택</option>
                                                <?=$FROMSINCEMONTH?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="start_date_s">보험기간</label>
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
                                <th scope="row">
                                    <label for="contractAdmin">계약담당자</label>
                                </th>
                                <td>
                                    <input type="text" name="contractAdmin" id="contractAdmin" placeholder="계약 담당자 입력" value='<?=$SEARCHDATA['contract_admin_name']?>'>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <div class="btn-box-conts">
                    <!-- 클릭시 폼 서브밋 -->
                    <!-- <a onclick="search();" class="button search"><i class="icon-search"></i>검색</a> -->
                    
                    <!-- inputs submit -->
                    <div class="inputBox search">
                        <label for="inputSearch">
                            <i class="ico search"></i>
                            <input type="submit" id="inputSearch" class="btn search" value="검색" title="검색">
                        </label>
                    </div>
                    <!-- //inputs submit -->
                    
                </div>

                <!-- tableAlign ul별 개별 구성 각 ul의 자식인 li에 asc,desc 클래스 추가 여부에 따라 ui 변경 됨 -->
                <div class="tableAlign">
                    <!--
                    <ul class="contractDate">
                        
                        <li class="asc">
                            <button type="button" class="btn">청약일 빠른순</button>
                        </li>
                        <li class="desc">
                            <button type="button" class="btn">청약일 느린순</button>
                        </li>
                    </ul>
                    <ul class="insurancePeriod">
                        <li class="asc">
                            <button type="button" class="btn">보험기간 종료일 빠른순</button>
                        </li>
                        <li class="desc">
                            <button type="button" class="btn">보험기간 종료일 느린순</button>
                        </li>
                    </ul>
                    -->
                    
                    <!-- <span>정렬 : <span> -->
                    <!-- <a href="" class="alignBtn">청약일 <span class="arrow"></span></a> -->
                    <!-- <a href="" class="alignBtn">보험기간 <span class="arrow"></span></a> -->
                </div>
            </form>

            <div class="table-box mgT15">
                <table class="table-link">
                    <colgroup>
                        <col style="width: 50px;">
                        <col style="width: 80px;">
                        <col style="width: auto;">
                        <col style="width: auto;">
                        <col style="width: 75px;">
                        <col style="width: 75px;">
                        <col style="width: 150px;">
                        <col style="width: 85px;">
                        <col style="width: 110px;">
                        <col style="width: 120px;">
                        <col style="width: 100px;">
                        <!-- <col width="5%">
                        <col width="7%">
                        <col width="12%">
                        <col width="8%">
                        <col width="9%">
						<col width="9%">
                        <col width="12%">
                        <col width="8%">
                        <col width="9%">
                        <col width="*">
                        <col width="10%"> -->
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>유입경로</th>
                            <th>보험상품</th>
                            <th>계약자</th>                            
							<th>계약일</th>
                            <th>만기일</th>
                            <th>보험기간</th>
                            <th>담당자</th>
                            <th>연락처</th>
                            <th>계약 담당자<br />(주/부)</th>
                            <th>갱신알림</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$CONTRACTLISTTR?>

                        
                        <!-- tr>
                            <td onclick="location.href='mkCnt-modify.php';">14</td>
                            <td onclick="location.href='mkCnt-modify.php';">계약완료</td>
                            <td onclick="location.href='mkCnt-modify.php';">생산물배상책임보험</td>
                            <td onclick="location.href='mkCnt-modify.php';">청학씨엔씨</td>
                            <td onclick="location.href='mkCnt-modify.php';">-</td>
							<td onclick="location.href='mkCnt-modify.php';">-</td>
                            <td onclick="location.href='mkCnt-modify.php';">2023.01.01~2024.01.01</td>
                            <td onclick="location.href='mkCnt-modify.php';">김철수</td>
                            <td onclick="location.href='mkCnt-modify.php';">02-1234-1234</td>
                            <td onclick="location.href='mkCnt-modify.php';">김성일</td>
                            <td class="p0">
                                <div class="day-item">
                                    <span>60</span>
                                    <span>30</span>
                                    <span>15</span>
                                </div>
                            </td>
                        </!-->
                        <!-- tr>
                            <td onclick="location.href='mkCnt-modify.php';">13</td>
                            <td onclick="location.href='mkCnt-modify.php';">취소</td>
                            <td onclick="location.href='mkCnt-modify.php';">국내근로자재해보험</td>
                            <td onclick="location.href='mkCnt-modify.php';">디와이글로벌㈜</td>
                            <td onclick="location.href='mkCnt-modify.php';">2023.01.01</td>
							<td onclick="location.href='mkCnt-modify.php';">2023.01.01</td>
                            <td onclick="location.href='mkCnt-modify.php';">2023.01.01~2024.01.01</td>
                            <td onclick="location.href='mkCnt-modify.php';">김철수</td>
                            <td onclick="location.href='mkCnt-modify.php';">02-1234-1234</td>
                            <td onclick="location.href='mkCnt-modify.php';">민경선</td>
                            <td class="p0"></td>
                        </!-->
                        <!-- tr>
                            <td onclick="location.href='mkCnt-modify.php';">9</td>
                            <td onclick="location.href='mkCnt-modify.php';">계약완료</td>
                            <td onclick="location.href='mkCnt-modify.php';">국내근로자재해보험</td>
                            <td onclick="location.href='mkCnt-modify.php';">디와이글로벌㈜</td>
                            <td onclick="location.href='mkCnt-modify.php';">2023.01.01</td>
							<td onclick="location.href='mkCnt-modify.php';">2023.01.01</td>
                            <td onclick="location.href='mkCnt-modify.php';">2023.01.01~2024.01.01</td>
                            <td onclick="location.href='mkCnt-modify.php';">김철수</td>
                            <td onclick="location.href='mkCnt-modify.php';">02-1234-1234</td>
                            <td onclick="location.href='mkCnt-modify.php';">민경선</td>
                            <td class="p0">
                                <div class="day-item">
                                    <span class="active">60</span>
                                    <span class="active">30</span>
                                    <span>15</span>
                                </div>
                            </td>
                        </! -->
                    </tbody>
                </table>
                <?=$PAGINATION?>
            </div>
        </div>
    </div>
    

<?php include $_SERVER['DOCUMENT_ROOT']."/CRM/include/footer.php"; ?>