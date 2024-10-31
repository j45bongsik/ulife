
<div class="conts-box">
    <div class="titleArea">
        <h1>매출 내역</h1>
    </div>

    <!-- form -->
    <form name="searchForm" id="searchForm" method="get" action="/salesBreakdown">
        <!-- searchArea -->
        <article class="searchArea">
            <div class="inputArea">
                <!-- select-custom -->
                <div class="select-custom">
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
                    <select name="sup_business_number" id="sup_business_number">
                        <?=$SUP_BUSINESS_NUMBER_SELECT_BOX?>
                    </select>
                </div>
                <!-- //select-custom -->
                <label for="business_number">
                    <input type="text" name="rec_sup_business_number" id="business_number" placeholder="공급받는자 사업자번호" autocomplete='off' value="<?=$SEARCH_DATA_REC_SUP_BUSINESS_NUMBER?>">
                </label>
                <label for="business_name">
                    <input type="text" name="rec_sup_mutual" id="business_name" placeholder="상호명" autocomplete='off' value="<?=$SEARCH_DATA_REC_SUP_MUTUAL?>">
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
                <a <?=$SALESBREAKDOWNLISTEXCEL?> class="btn file">엑셀다운</a>
            </div>
            <!-- //btnArea -->
        </article>
        <!-- //searchArea -->
    </form>
    <!-- //form -->


    <!-- memb-table -->
    <article class="memb-table erpList">
        <table>
            <caption>
                매출내역 테이블로 순번, 공급자, 일자, 사업자번호, 공급받는자, 항목, 품목명, 금액, 금액의 총합계 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: auto;">
                <col style="width: 100px;">
                <col style="width: 120px;">
                <col style="width: auto;">
                <col style="width: 160px;">
                <col style="width: 160px;">
                <col style="width: 100px;">
                <col style="width: 120px;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">공급자</th>
                    <th scope="col">일자</th>
                    <th scope="col">사업자번호</th>
                    <th scope="col">공급받는자</th>
                    <th scope="col">항목</th>
                    <th scope="col">품목명</th>
                    <th scope="col">계산서종류</th>
                    <th scope="col">금액</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- 페이지 당 tr은 max 10개까지만 -->
                <?=$SALESUPLOADHISTORYTABLE?>
            </tbody>
        </table>
        
        <div class="sumArea">
            <ul>
                <li>
                    <p>총 합계</p>
                </li>
                <li>
                    <p class="totalAmount"><?=$SALESUPLOADHISTORYTOTALSUM?></p>
                </li>
            </ul>
        </div>
    </article>
    <!-- //memb-table -->

    <!-- paginate -->
    <?=$PAGINATION?>
    <!-- //paginate -->
</div>

<script>
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