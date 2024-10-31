
<div class="conts-box">
    <!-- tabList -->
    <article class="tabList">
        <ul>
            <li class="active">
                <button type="button" class="btn">전체</button>
            </li>
            <li>
                <button type="button" class="btn">여행자보험</button><!-- cantClick -->
            </li>
        </ul>
        <div class="tabCont active">
            <!-- contentBox -->
            <section class="contentBox">
                <div class="titleArea">
                    <h2 class="thirdTitle">총 매출액/매입액</h2>
                    
                    <article class="rightBox">
                        <div class="checkArea">
                            <p class="summaryM prevM"><?=$TOPSTARTDATE?></p>
                            <span class="between">~</span>
                            <p class="summaryM currentM"><?=$TOPENDDATE?></p>
                        </div>
                    </article>
                </div>
                <article class="summaryArea">
                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent sales">
                            <p>금년 총 매출</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                <?=$THISYEARTOTALSALES?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->
                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent sales">
                            <p>작년 총 매출</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                <?=$LASTYEARTOTALSALES?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->

                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent purchase">
                            <p>금년 총 매입</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                <?=$THISYEARTOTALPURCHASE?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->

                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent purchase">
                            <p>작년 총 매입</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                <?=$LASTYEARTOTALPURCHASE?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->
                </article>
            </section>
            <!-- //contentBox -->
            
            <!-- contentBox -->
            <section class="contentBox">
                <!-- form -->
                <form name="searchChart" id="searchChart" method="get" action="/dashboard">
                    <div class="titleArea">
                        <h2 class="thirdTitle">
                            <span class="dateY active">2024</span>
                            년 월별 통계
                        </h2>
                        <!-- select-custom -->
                        <div class="select-custom">
                            <select name="searchChartY" id="searchChartY" class="searchChartY">
                                <option value="2024" selected>2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                            </select>
                        </div>
                        <!-- //select-custom -->
                    </div>
                </form>
                <!-- //form -->
                <!-- chartArea -->
                <article class="chartArea">
                    <canvas id="myChartYearSummary"></canvas>
                </article>
                <!-- //chartArea -->
            </section>
            <!-- //contentBox -->

            <!-- tableArea -->
            <div class="tableArea">
                <!-- memb-table -->
                <article class="memb-table erpList dashboard">
                    <div class="titleArea">
                        <h2 class="thirdTitle">매출 순위</h2>
                    </div>

                    <table>
                        <caption>
                            매출 순위 테이블로 순번, 업체명, 보험금액 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 60px;">
                            <col style="width: auto;">
                            <col style="width: 120px;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">업체명</th>
                                <th scope="col">보험금액</th>
                            </tr>
                        </thead>
                        
                        <tbody id="tbody_SALESRANKING">
                            <!-- 페이지 당 tr은 max 10개까지만 -->
                            <?=$SALESRANKING?>
                        </tbody>
                    </table>
                </article>
                <!-- //memb-table -->

                <!-- memb-table -->
                <article class="memb-table erpList dashboard">
                    <div class="titleArea">
                        <h2 class="thirdTitle">매입 순위</h2>
                    </div>

                    <table>
                        <caption>
                            매입 순위 테이블로 순번 보험사, 보험금액 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 60px;">
                            <col style="width: auto;">
                            <col style="width: 120px;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">보험사</th>
                                <th scope="col">보험금액</th>
                            </tr>
                        </thead>
                        
                        <tbody  id="tbody_BUYRANKING">
                            <!-- 페이지 당 tr은 max 10개까지만 -->
                            <?=$BUYRANKING?>
                        </tbody>
                    </table>
                </article>
                <!-- //memb-table -->
            </div>
            <!-- //tableArea -->
        </div>
        <div class="tabCont">
            <!-- contentBox -->
            <section class="contentBox">
                <div class="titleArea">
                    <h2 class="thirdTitle">여행자보험</h2>
                </div>
                <article class="summaryArea">
                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent sales">
                            <p>지난달 보험액</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                999999999999
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->

                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent purchase">
                            <p>지난달 수익</p>
                            <p class="sum">
                                <span class="currency">￦</span>
                                <span class="totalAmount comma counterNum">
                                999999999999
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->

                    <!-- summary -->
                    <div class="summary">
                        <div class="sumContent member">
                            <p>지난달 보험 가입자수</p>
                            <p class="sum">
                                <span class="totalAmount comma counterNum">
                                    999999999999
                                </span>
                                <span>건</span>
                            </p>
                        </div>
                    </div>
                    <!-- //summary -->
                </article>
            </section>
            <!-- //contentBox -->
            
            <!-- contentBox -->
            <section class="contentBox">
                <!-- form -->
                <form name="searchChartTravel" id="searchChartTravel" method="get" action="/dashboard">
                    <div class="titleArea">
                        <h2 class="thirdTitle">
                            <span class="dateY active">2024</span>
                            년 월별 통계
                        </h2>
                        <!-- select-custom -->
                        <div class="select-custom">
                            <select name="searchChartYTravel" id="searchChartYTravel" class="searchChartY">
                                <option value="" selected>2024</option>
                                <option value="">2023</option>
                                <option value="">2022</option>
                                <option value="">2021</option>
                                <option value="">2020</option>
                            </select>
                        </div>
                        <!-- //select-custom -->
                    </div>
                </form>
                <!-- //form -->
                <!-- chartArea -->
                <article class="chartArea">
                    <canvas id="myChartTravelSummary"></canvas>
                </article>
                <!-- //chartArea -->
                <!-- memb-table -->
                <article class="memb-table erpList">
                    <table>
                        <caption>
                            월별 통계 테이블로 1월부터 12월까지 월별 보험액, 매출액, 광고비 수익 금액과 합계금액 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width:50px;">
                            <col style="width:200px;">
                            <col style="width:200px;">
                            <col style="width:200px;">
                            <col style="width:200px;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">보험액</th>
                                <th scope="col">매출액</th>
                                <th scope="col">광고비</th>
                                <th scope="col">수익</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">2월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">3월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">4월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">5월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">6월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">7월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">8월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">9월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">10월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">11월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                            <tr>
                                <th scope="row">12월</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row">합계</th>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                                <td>99,999,999,999</td>
                            </tr>
                        </tfoot>
                    </table>
                </article>
                <!-- //memb-table -->
            </section>
            <!-- //contentBox -->

            <!-- contentBox -->
            <section class="contentBox">
                <div class="titleArea">
                    <h2 class="thirdTitle">
                        카테고리별
                    </h2>
                </div>
                <!-- chartGroup -->
                <div class="chartGroup">
                    <!-- box -->
                    <div class="box pie">
                        <div class="inner">
                            <div class="titleArea">
                                <h3 class="chartTitle">채널별</h3>
                            </div>
                            <!-- chartArea -->
                            <article class="chartArea type02">
                                <canvas id="myChartChannelSummary"></canvas>
                            </article>
                            <!-- //chartArea -->
                        </div>
                        
                        <div class="inner">
                            <div class="titleArea">
                                <h3 class="chartTitle">상품별</h3>
                            </div>
                            <!-- chartArea -->
                            <article class="chartArea type02">
                                <canvas id="myChartProductSummary"></canvas>
                            </article>
                            <!-- //chartArea -->
                        </div>
                    </div>
                    <!-- //box -->

                    <!-- box -->
                    <div class="box">
                        <div class="inner">
                            <div class="titleArea">
                                <h3 class="chartTitle">보험사별</h3>
                            </div>
                            <!-- chartArea -->
                            <article class="chartArea type02">
                                <canvas id="myChartCompanySummary"></canvas>
                            </article>
                            <!-- //chartArea -->
                        </div>
                    </div>
                    <!-- //box -->
                </div>
                <!-- //chartGroup -->
            </section>
            <!-- //contentBox -->

            <div class="titleArea">
                <h2 class="thirdTitle">
                    거래처 별 보험액 순위
                </h2>
            </div>

            <!-- tabList -->
            <article class="tabList">
                <ul>
                    <li class="active">
                        <button type="button" class="btn">전체</button>
                    </li>
                    <li>
                        <button type="button" class="btn">신규</button>
                    </li>
                </ul>
                <div class="tabCont active">
                    <!-- tableArea -->
                    <div class="tableArea">
                        <!-- memb-table -->
                        <article class="memb-table erpList dashboard">
                            <table>
                                <caption>
                                    거래처 별 보험액 순위 테이블로 거래처 전체의 순번, 거래처명, 보험금액, 보험건수 등의 정보를 제공합니다.
                                </caption>
                                <colgroup>
                                    <col style="width: 60px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">거래처명</th>
                                        <th scope="col">보험금액</th>
                                        <th scope="col">보험건수</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- 페이지 당 tr은 max 10개까지만 -->
                                    <tr>
                                        <td>1</td>
                                        <td>전체전체전체</td>
                                        <td>30,000,000</td>
                                        <td>30,000</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </article>
                        <!-- //memb-table -->

                        <!-- memb-table -->
                        <article class="memb-table erpList">
                            <table>
                                <caption>
                                거래처 별 보험액 순위 테이블로 거래처 전체의 순번, 거래처명, 보험금액, 보험건수 등의 정보를 제공합니다.
                                </caption>
                                <colgroup>
                                    <col style="width: 60px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">거래처명</th>
                                        <th scope="col">보험금액</th>
                                        <th scope="col">보험건수</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- 페이지 당 tr은 max 10개까지만 -->
                                    <tr>
                                        <td>11</td>
                                        <td>전체전체전체</td>
                                        <td>30,000,000</td>
                                        <td>30,000</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </article>
                        <!-- //memb-table -->
                    </div>
                    <!-- //tableArea -->
                </div>
                <div class="tabCont">
                    <!-- tableArea -->
                    <div class="tableArea">
                        <!-- memb-table -->
                        <article class="memb-table erpList dashboard">
                            <table>
                                <caption>
                                    거래처 별 보험액 순위 테이블로 신규 거래처의 순번, 거래처명, 보험금액, 보험건수 등의 정보를 제공합니다.
                                </caption>
                                <colgroup>
                                    <col style="width: 60px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">거래처명</th>
                                        <th scope="col">보험금액</th>
                                        <th scope="col">보험건수</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- 페이지 당 tr은 max 10개까지만 -->
                                    <tr>
                                        <td>1</td>
                                        <td>신규신규신규</td>
                                        <td>30,000,000</td>
                                        <td>30,000</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </article>
                        <!-- //memb-table -->

                        <!-- memb-table -->
                        <article class="memb-table erpList">
                            <table>
                                <caption>
                                거래처 별 보험액 순위 테이블로 신규 거래처의 순번, 거래처명, 보험금액, 보험건수 등의 정보를 제공합니다.
                                </caption>
                                <colgroup>
                                    <col style="width: 60px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                    <col style="width: 120px;">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">거래처명</th>
                                        <th scope="col">보험금액</th>
                                        <th scope="col">보험건수</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- 페이지 당 tr은 max 10개까지만 -->
                                    <tr>
                                        <td>11</td>
                                        <td>신규신규신규</td>
                                        <td>30,000,000</td>
                                        <td>30,000</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </article>
                        <!-- //memb-table -->
                    </div>
                    <!-- //tableArea -->
                </div>
            </article>
            <!-- //tabList -->
        </div>
    </article>
    <!-- //tabList -->
</div>

<!-- counterup.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>

<script>

    // 숫자를 증가시켜주는 애니메이션
    $(".counterNum").counterUp({
        delay: 10,
        time: 500
    });

    //tab 기능
    document.querySelectorAll('.tabList').forEach(function(tabLists){
        tabLists.querySelectorAll('ul li .btn').forEach(function(tabBtns, tabIndex){

            tabBtns.addEventListener('click', function(event){
                let tabBtn = event.target;
                let clickLiTag = tabBtn.closest('li')
                let tabList = tabBtn.closest('.tabList')
                let liTags = tabList.querySelectorAll('ul li')
                let tabConts = tabList.querySelectorAll('.tabCont')

                liTags.forEach(function(liTag){
                    if (liTag.closest('.tabList') === tabList) {
                        liTag.classList.remove('active')
                    }
                });

                if (clickLiTag.closest('.tabList') === tabList) {
                    clickLiTag.classList.add('active')
                }

                tabConts.forEach(function(tabCont){
                    let tabContParent = tabCont.closest('.tabList');
                    
                    if (tabContParent === tabList) {
                        if (Array.prototype.indexOf.call(tabConts, tabCont) === tabIndex) {
                            tabCont.classList.add('active')
                        } else {
                            tabCont.classList.remove('active')
                        }
                    }
                }) 
            })
        })
    });

    // 문서에서 comma 클래스를 찾아 텍스트와 숫자를 포맷팅해서 3자리수마다 ,(comma) 삽입
    document.addEventListener('DOMContentLoaded', function(){        
        let totalAmounts = document.querySelectorAll('.comma')
        
        for(var i = 0; i < totalAmounts.length; i++) {
            let textFormat = totalAmounts[i].textContent;
            let numberGet = parseFloat(textFormat.replace(/[^\d.]/g, ''));
            
            let formattedText = addCommasToNumberString(numberGet);
            
            // 결과를 요소의 텍스트로 설정합니다.
            totalAmounts[i].textContent = formattedText;
        }
    }); 

    // 세 자리마다 쉼표를 추가하는 함수
    function addCommasToNumberString(num) {
        return num.toLocaleString();
    }

    // select를 선택하면 년도 text 변경
    document.querySelectorAll('.searchChartY').forEach(function(selectChanges){
        selectChanges.addEventListener('change', function(event){
            // 엘리먼트 추적
            let selectTag = event.target;
            let selectText = selectTag.options[selectTag.selectedIndex].innerText;
            let titleArea = selectTag.closest('.titleArea');
            let dateY = titleArea.querySelector('.dateY');
            

            if(dateY.classList.contains('active')) {
                dateY.classList.remove('active')
            }

            setTimeout(function() {
                dateY.classList.add('active');
            }, 300); 

            // select를 선택하면 text를 title에 삽입
            dateY.innerText = selectText;

            // ajax로 데이터 받아오기 post 방식으로 selectText 전송
            // url = getSalesBuyMonthTotal 
            // data = selectText
            // dataType = json
            // success = function(data) { chartDataChange(data) }
            // error = function() { alert('error') }
            $.ajax(
                {
                    url: '/getSalesBuyMonthTotal',
                    type: 'post',
                    data: {year: selectText},
                    dataType: 'json',
                    success: function(data){
                        chartDataChange(data.data1, data.data2);
                    },
                    error: function(){
                        alert('error');
                    }
                }
            );

            $.ajax(
                // 매출 순위 데이터 받아오기 // 리턴되는 data는 html 형식으로 받아옴 // tbody_SALESRANKING 에 삽입
                {
                    url: '/ajaxGetSalesRanking',
                    type: 'post',
                    data: {year: selectText},
                    dataType: 'html',
                    success: function(data){
                        // tbody_SALESRANKING에 삽입
                        $('#tbody_SALESRANKING').html(data);
                    },
                    error: function(){
                        alert('error');
                        //console.log(data1);
                    }
                }
            );

            $.ajax(
                // 매입 순위 데이터 받아오기 // 리턴되는 data는 html 형식으로 받아옴 // tbody_BUYRANKING 에 삽입
                {
                    url: '/ajaxGetBuyRanking',
                    type: 'post',
                    data: {year: selectText},
                    dataType: 'html',
                    success: function(data){
                        // tbody_BUYRANKING에 삽입
                        $('#tbody_BUYRANKING').html(data);
                    },
                    error: function(){
                        alert('error');
                        //console.log(data2);
                    }
                }
            );

        })
        
    })

    /* ==================== chart.js ==================== */

    // 총 매출액/매입액 차트
    const YearSummary = document.getElementById('myChartYearSummary');
    let YearSummaryChart = new Chart(YearSummary, {
        data: {
            datasets: [
                {
                    type: 'bar',
                    label: '매출',
                    //data: [80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000],
                    <?=$CHARTJSDATA1?>
                    borderColor: '#16BFD6',
                    backgroundColor:'#16BFD6',
                    barPercentage: 1, // 막대의 폭을 100%로 설정
                    // categoryPercentage: 0.5 // 카테고리의 폭을 100%로 설정하여 막대 사이의 간격을 0으로 설정
                },
                {
                    type: 'bar',
                    label: '매입',
                    //data: [40000, 45000, 50000,10000, 40000, 45000, 50000,10000, 40000, 45000, 50000,10000],
                    <?=$CHARTJSDATA2?>
                    borderColor: '#F765A3',
                    backgroundColor:'#F765A3',
                    barPercentage: 1, // 막대의 폭을 100%로 설정
                    // categoryPercentage: 0.5 // 카테고리의 폭을 100%로 설정하여 막대 사이의 간격을 0으로 설정
                }
            ],
            labels: ['01월', '02월', '03월', '04월', '05월', '06월', '07월', '08월', '09월', '10월', '11월', '12월']
        },
        
        options: {
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        boxWidth: 80,
                    },
                    align: 'center',
                    position: 'left'
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false // x 축의 그리드 라인 비활성화하여 세로줄 삭제
                    },
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: false,
                        min: 500000, // y 축의 최소값 설정
                        stepSize: 500000, // y 축 값의 간격 설정
                        font: {
                            size: 14
                        }
                    },
                },
            },
            // maxBarThickness: 36,
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // 여행자보험 - 월별통계 차트
    const travelSummary = document.getElementById('myChartTravelSummary');
    let travelSummaryChart = new Chart(travelSummary, {
        data: {
            datasets: [
                {
                    type: 'bar',
                    label: '보험액',
                    data: [80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000, 80000, 90000, 100000, 20000],
                    borderColor: '#16BFD6',
                    backgroundColor:'#16BFD6',
                    // categoryPercentage: 0.8, // 카테고리의 폭을 100%로 설정하여 막대 사이의 간격을 0으로 설정
                    barPercentage: 0.6, // 막대의 폭을 100%로 설정
                    stack: 0,
                    order: 2,
                },
                {
                    type: 'bar',
                    label: '매출',
                    data: [40000, 45000, 50000,10000, 40000, 45000, 50000,10000, 40000, 45000, 50000,10000],
                    borderColor: '#F765A3',
                    backgroundColor:'#F765A3',
                    // categoryPercentage: 0.8, // 카테고리의 폭을 100%로 설정하여 막대 사이의 간격을 0으로 설정
                    barPercentage: 0.6, // 막대의 폭을 100%로 설정
                    stack: 0,
                    order: 1,
                },
                {
                    type: 'line',
                    label: '수익',
                    data: [40000, 45000, 50000,10000, 40000, 45000, 50000,10000, 40000, 45000, 50000,10000],
                    borderColor: '#FFC107',
                    backgroundColor:'#FFC107',
                    stack: 1,
                    order: 0,
                }
            ],
            labels: ['01월', '02월', '03월', '04월', '05월', '06월', '07월', '08월', '09월', '10월', '11월', '12월']
        },
        
        options: {
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        boxWidth: 80,
                    },
                    align: 'center',
                    position: 'left'
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false // x 축의 그리드 라인 비활성화하여 세로줄 삭제
                    },
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: false,
                        min: 1000, // y 축의 최소값 설정
                        stepSize: 1000, // y 축 값의 간격 설정
                        font: {
                            size: 14
                        }
                    },
                },
                
            },
            // maxBarThickness: 28,
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // 여행자보험 - 카테고리별 - 채널별 차트
    const channelSummary = document.getElementById('myChartChannelSummary');
    let channelSummaryChart = new Chart(channelSummary, {
        type: 'pie',
        data: {
            labels: ['B2B', 'B2C', 'B2B2C'],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: [
                    '#165BAA',
                    '#F765A3',
                    '#16BFD6'
                ],
                hoverOffset: 0
            }],
        },
        options: {
            plugins: {
                tooltip: {
                    enabled: true, // 항상 툴팁 표시
                    callbacks: {
                        label: function(context) {
                            let label = context.chart.data.labels[context.dataIndex];
                            let value = context.parsed;
                            return value + '%';
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)', // 툴팁 배경색
                    titleColor: '#fff', // 타이틀 텍스트 색상
                    titleFont: {
                        // weight: 'bold',
                        size: 16,
                    },
                    bodyColor: '#fff', // 본문 텍스트 색상
                    bodyFont: {
                        weight: 'normal',
                        size: 14
                    },
                    padding: 10 // 툴팁 내부 여백
                },
                legend: {
                    position: 'top',
                    align: 'center',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        boxWidth: 15,
                        generateLabels: function(chart) {
                            let data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function(label, i) {
                                    let dataset = data.datasets[0];
                                    let value = dataset.data[i];
                                    return {
                                        text: label + ':\n' + value + '%',
                                        fillStyle: dataset.backgroundColor[i],
                                        hidden: isNaN(dataset.data[i]),

                                        // Extra data used for toggling the correct item
                                        index: i
                                    };
                                });
                            }
                            return [];
                        },
                        
                    },
                },
            },
            responsive: true,
        },
    });

    // 여행자보험 - 카테고리별 - 상품별 차트
    const productSummary = document.getElementById('myChartProductSummary');
    let productSummaryChart = new Chart(productSummary, {
        type: 'pie',
        data: {
            labels: ['국내', '해외', '장기체류'],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: [
                    '#165BAA',
                    '#F765A3',
                    '#16BFD6'
                ],
                hoverOffset: 0
            }],
        },
        options: {
            plugins: {
                tooltip: {
                    enabled: true, // 항상 툴팁 표시
                    callbacks: {
                        label: function(context) {
                            let label = context.chart.data.labels[context.dataIndex];
                            let value = context.parsed;
                            return value + '%';
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)', // 툴팁 배경색
                    titleColor: '#fff', // 타이틀 텍스트 색상
                    titleFont: {
                        // weight: 'bold',
                        size: 16,
                    },
                    bodyColor: '#fff', // 본문 텍스트 색상
                    bodyFont: {
                        weight: 'normal',
                        size: 14
                    },
                    padding: 10 // 툴팁 내부 여백
                },
                legend: {
                    position: 'top',
                    align: 'center',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        boxWidth: 15,
                        generateLabels: function(chart) {
                            let data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function(label, i) {
                                    let dataset = data.datasets[0];
                                    let value = dataset.data[i];
                                    return {
                                        text: label + ':\n' + value + '%',
                                        fillStyle: dataset.backgroundColor[i],
                                        hidden: isNaN(dataset.data[i]),

                                        // Extra data used for toggling the correct item
                                        index: i
                                    };
                                });
                            }
                            return [];
                        },
                        
                    },
                },
            },
            responsive: true,
        },
    });

    // 여행자보험 - 카테고리별 - 보험사별 차트
    const companySummary = document.getElementById('myChartCompanySummary');
    let companySummaryChart = new Chart(companySummary, {
        data: {
            datasets: [
                {
                    type: 'bar',
                    label: '보험액',
                    data: [120, 80, 20, 90, 10, 70],
                    borderColor: '#165BAA',
                    backgroundColor: '#63ABFD',
                    barPercentage: 0.6, // 막대의 폭을 100%로 설정
                },
            ],
            labels: ['Chubb', '메리츠화재', '현대해상', 'DB손해보험', 'MG손해보험', '삼성화재']
        },
        
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        boxWidth: 50,
                    },
                    // display: false,
                    align: 'start',
                    position: 'bottom'
                },
            },
            scales: {
                x: {

                    ticks: {
                        font: {
                            size: 14
                        },
                        min: 0,
                        stepSize: 20,
                    }
                },
                y: {
                    grid: {
                        display: false // x 축의 그리드 라인 비활성화하여 세로줄 삭제
                    },
                    ticks: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                    }
                },
                
                
            },
            maxBarThickness: 20,
            responsive: true,
            maintainAspectRatio: false,
        }
    });


    function chartDataChange(data1, data2){
        // YearSummaryChart 의 매출과 매입 데이터 변경
        YearSummaryChart.data.datasets[0].data = data1;
        YearSummaryChart.data.datasets[1].data = data2;
        YearSummaryChart.update();
        
    }




</script>