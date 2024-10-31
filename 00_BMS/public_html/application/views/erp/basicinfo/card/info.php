
<div class="conts-box">
    <div class="titleArea">
        <h1>
            법인카드 정보
        </h1>
    </div>

    <!-- searchArea -->
    <article class="searchArea">
        <div class="inputArea upload">
            <div class="btnArea">
                <a href="/cardInfoReg" class="btn file">카드등록</a> 
            </div>
        </div>
    </article>
    <!-- //searchArea -->



    <!-- memb-table -->
    <article class="memb-table erpList link">
        <table>
            <caption>
                법인카드 정보 테이블로 순번, 카드사, 카드번호, 구분, 사용자, 상태, 카드상태, 메모 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: 120px;">
                <col style="width: 180px;">
                <col style="width: 130px;">
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: auto;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">카드사</th>
                    <th scope="col">카드번호</th>
                    <th scope="col">구분</th>
                    <th scope="col">사용자</th>
                    <th scope="col">상태</th>
                    <th scope="col">카드상태</th>
                    <th scope="col">메모</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- 페이지 당 tr은 max 10개까지만 -->
                <?=$CARDLISTTABLE?>
            </tbody>
        </table>

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
    <!-- //paginate -->
</div>

<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="/cardInfoEdit">[ 카드 수정 ]</a>  -->

