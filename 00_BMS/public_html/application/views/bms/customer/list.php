            <style>
                th {
                    vertical-align: middle;
                    }
                .list-cont-wrap {
                    display: block;
                    /* min-width: 1280px; */
                    overflow-x: scroll;
                    white-space: nowrap;
                    clear: both;
                }
            </style>
            <div class="conts-box">
                <div class="titleArea">
                    <h1>거래처 리스트</h1> 
                </div>
                <!-- <a href="/customerlist" style="color:red">[  ☞ 등록 된 거래처만 입력값 확인을 위한 임시페이지로 이동 ] </a><br> -->

                <form name="searchForm" id="searchForm" method="get" action="/customer">
                
                    <article class="erpList reg table">
                        <table>
                            <caption>
                                거래처 리스트 테이블로 거래처명, 사업자번호, 증권번호, 구분, 거래처담당자, 계약담당자 등의 정보를 입력하고 검색합니다.
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
                                            거래처명
                                        </label>
                                    </th>
                                    <td>
                                        <input type="text" name="customer_name" id="customer_name" placeholder="거래처명 입력" value="<?=$SEARCHDATA['customer_name']?>">
                                    </td>
                                    <th scope="row">
                                        <label for="business_number">
                                            사업자번호
                                        </label>
                                    </th>
                                    <td>
                                        <input type="text" name="business_number" id="business_number" placeholder="사업자번호 입력" value="<?=$SEARCHDATA['business_number']?>">
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
                                        <label for="insuranceType">
                                            구분
                                        </label>
                                    </th>
                                    <td>
                                        <div class="select-custom">
                                            <select name="insuranceType" id="insuranceType">
                                                <?=$INSURANCETYPESELECTBOX?>
                                            </select>
                                        </div>
                                    </td>
                                    <th scope="row">
                                        <label for="manager_name">
                                            거래처 담당자
                                        </label>
                                    </th>
                                    <td>
                                        <input type="text" name="manager_name" id="manager_name" placeholder="거래처 담당자 입력" value="<?=$SEARCHDATA['manager_name']?>">
                                    </td>
                                    <th scope="row">
                                        <label for="contractAdmin">
                                            계약 담당자
                                        </label>
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
                
                </form>


                <div class="table-box">
                    <table class="table-link">
                    <colgroup>
                        <col width="4%">
                        <col width="7%">
                        <col width="12%">
                        <col width="8%">
                        <col width="9%">
						<col width="9%">
                        <col width="12%">
                        <col width="8%">
                        <col width="9%">
                        <col width="*">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>거래처명</th>
                            <th>가입상품</th>
                            <th>거래처담당자</th>
                            <th>대표번호</th>
							<th>휴대폰번호</th>
                            <th>이메일</th>
                            <th>최근업데이트</th>
                            <th>계약담당자</th>
                            <th>상태</th>
                        </tr>
                    </thead>
                        <tbody>

    <?php
    if($CONTRACTLISTTR == null){
        echo "<tr><td colspan='11'>데이터가 없습니다.</td></tr>";
    } else {
        echo $CONTRACTLISTTR;
    ?>                    
                            <!-- tr>
                                <td onclick="location.href='customer_view';">DB손해보험</td>
                                <td onclick="location.href='customer_view';">22</td>
                                <td onclick="location.href='customer_view';">2023</td>
                                <td onclick="location.href='customer_view';">사업자</td>
                                <td onclick="location.href='customer_view';">법인사업자</td>
                                <td onclick="location.href='customer_view';">종합</td>
                                <td onclick="location.href='customer_view';">재산종합</td>
                                <td onclick="location.href='customer_view';">DB 재산종합보험2</td>
                                <td onclick="location.href='customer_view';">단독</td>
                                <td onclick="location.href='customer_view';">BIS</td>
                                <td onclick="location.href='customer_view';">2023</td>
                                <td onclick="location.href='customer_view';">05-01</td>
                                <td onclick="location.href='customer_view';">2024</td>
                                <td onclick="location.href='customer_view';">04-30</td>
                                <td onclick="location.href='customer_view';">삼성화재</td>
                                <td onclick="location.href='customer_view';">5,000,000원</td>
                                <td onclick="location.href='customer_view';">5,500,000원</td>
                                <td onclick="location.href='customer_view';">알톤스포츠</td>
                                <td onclick="location.href='customer_view';">-</td>
                                <td onclick="location.href='customer_view';">-</td>
                                <td onclick="location.href='customer_view';">Y</td>
                                <td onclick="location.href='customer_view';">전화 받지 않음</td>
                                <td onclick="location.href='customer_view';">https://bis.co.kr/</td>
                                <td onclick="location.href='customer_view';">경영지원부</td>
                                <td onclick="location.href='customer_view';">홍길동</td>
                                <td onclick="location.href='customer_view';">1800-9010</td>
                                <td onclick="location.href='customer_view';">02-1234-1234</td>
                                <td onclick="location.href='customer_view';">bis@bis.co.kr</td>
                                <td onclick="location.href='customer_view';">김성일</td>
                                <td onclick="location.href='customer_view';">매월 15일</td>
                                <td onclick="location.href='customer_view';">2023-05-06</td>
                                <td onclick="location.href='customer_view';">회사</td>
                                <td onclick="location.href='customer_view';">회사</td>
                                <td onclick="location.href='customer_view';">삼성화재</td>
                                <td onclick="location.href='customer_view';">6,000,000원</td>
                                <td onclick="location.href='customer_view';">상담 종료</td>
                                <td onclick="location.href='customer_view';">서울시</td>
                                <td onclick="location.href='customer_view';">중구</td>
                                <td onclick="location.href='customer_view';">성우빌딩 10F</td>                       
                            </! -->
    <?php
        // }
    }
    ?>
                        </tbody>
                    </table>

                    <?=$PAGINATION?>
                </div>
            </div>

        <script>
            // 검색버튼 클릭시 검색하기
            $(".search").click(function(){
                $("form[name=searchform]").submit();
            });


        </script>