        <div class="conts-box">
            <div class="titleArea">
                <h1>보험 상품</h1>
            </div>


            <form name="searchForm" id="searchForm" method="get" action="/insuranceProduct">
                <article class="erpList reg table">
                    <table>
                        <caption>
                            보험상품 검색 테이블로 구분, 보험종목, 보험사, 보험상품, 내부담당, 상품수수료 등의 정보를 입력하고 검색합니다.
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
                                <th scopr="row">
                                    <label for="insurance">
                                        구분
                                    </label>
                                </th>
                                <td>
                                    <div class="select-custom">
                                        <select name="insurance" id="insurance">
                                            <?=$INSURANCECOMPANYDIVISIONLISTSELECTBOX?>
                                        </select>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="insuranceType">
                                        보험종목
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
                                    <label for="InsurancecompanySelectBox">
                                        보험사
                                    </label>
                                </th>
                                <td>
                                    <div class="select-custom">
                                        <select name="InsurancecompanySelectBox" id="InsurancecompanySelectBox">
                                            <?=$INSURANCECOMPANYLISTSELECTBOX?>                                
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="insuranceProductName">
                                        보험상품
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="insuranceProductName" id="insuranceProductName" value="<?=$SEARCHDATAINSURANCEPRODUCTNAME?>" placeholder="보험상품 입력">
                                </td>
                                <th scope="row">
                                    <label for="internalContactPerson">
                                        내부담당
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="internalContactPerson" id="internalContactPerson" value="<?=$SEARCHDATAINTERNALCONTACTPERSON?>" placeholder="내부담당 입력">
                                </td>
                                <th scope="row">
                                    <label for="insuranceProductCommissionS">
                                        상품수수료
                                    </label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <input type="number" name="insuranceProductCommissionS" id="insuranceProductCommissionS" class="textRight" value="<?=$SEARCHDATAINSURANCEPRODUCTCOMMISSIONS?>" placeholder="0">
                                        <span class="between">%</span>
                                        <span class="between">~</span>
                                        <input type="number" name="insuranceProductCommissionE" id="insuranceProductCommissionE" class="textRight" value="<?=$SEARCHDATAINSURANCEPRODUCTCOMMISSIONE?>" placeholder="0">
                                        <span class="between">%</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

            
                <div class="btn-box-conts">
                    <div class="inputBox search">

                        <label for="inputSearch">
                            <i class="ico search"></i>
                            <input type="submit" id="inputSearch" class="btn search" value="검색" title="검색">
                        </label>
                    </div>
                    
                    <a href="/insuranceProduct_reg" class="button point rgstr">등록</a>
                </div>
            </form>

            <div class="table-box">
                <table>
                    <colgroup>
                        <col width="50px;">
                        <col width="80px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="150px;">
                        <col width="80px;">
                        <col width="80px;">
                        <col width="80px;">
                        <col width="auto;">
                        <!-- <col width="8%"> -->
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>구분</th>
                            <th>보험사</th>
                            <th>분류</th>
                            <th>보험종목</th>
                            <th>보험상품</th>
                            <th>내부<br />당당자</th>
                            <th>상품<br />수수료</th>
                            <th>추가<br />수수료</th>
                            <th>상품 설명</th>
                            <!-- <th>자료</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?=$INSURANCEPRODUCTLISTDATA?>
                    </tbody>
                </table>

                <?php //include $_SERVER['DOCUMENT_ROOT']."/CRM/service/pagination.php"; ?>
                <?=$PAGINATION?>
            </div>
        </div>

<script>        
    function formsubmit(){
        document.getElementById("searchForm").submit();
    }

</script>