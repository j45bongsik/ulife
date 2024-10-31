<!-- datatable 을 사용 하여 검색 -->
<!-- https://datatables.net/ -->
<!-- https://datatables.net/examples/data_sources/server_side.html -->
<!-- https://datatables.net/examples/basic_init/scroll_y.html -->
<!-- https://datatables.net/examples/basic_init/scroll_x.html -->
<!-- https://datatables.net/examples/basic_init/scroll_xy.html -->
<!-- https://datatables.net/examples/basic_init/scroll_infinite.html -->
<!-- https://datatables.net/examples/basic_init/scroll_vertical.html -->
<!-- https://datatables.net/examples/basic_init/scroll_horizontal.html -->
<!-- https://datatables.net/examples/basic_init/scroll_y_dynamic.html -->
<!-- https://datatables.net/examples/basic_init/scroll_x_dynamic.html -->
<!-- 
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "insuranceCompany_list_ajax",
                "type": "POST"
            },
            "columns": [
                { "data": "no" },
                { "data": "insuranceCompanyCate" },
                { "data": "insurancecompany" },
                { "data": "department" },
                { "data": "name" },
                { "data": "tel" },
                { "data": "mobile" },
                { "data": "email" },
                { "data": "internalmanager" },
                { "data": "memo" }
            ],
            "scrollY":        "500px",
            "scrollCollapse": true,
            "paging":         false,
            "searching": false,
            "info":     false,
            "order": [[ 0, "desc" ]]
        } );
    } );

</script>
-->
        <div class="conts-box">
            <div class="titleArea">
                <h1>보험사</h1>            
            </div>

            <article class="erpList reg table">
                <table>
                    <caption>보험사 검색 테이블로 보험사, 부서/채널, 담당자, 연락처, 이메일 등의 정보를 입력하고 검색합니다.</caption>
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
                                <label for="insuranceCompanyCate">
                                    보험사
                                </label>
                            </th>
                            <td>
                                <select name="insuranceCompanyCate" id="insuranceCompanyCate">
                                <?= $INSURANCECOMPANYDIVISIONLISTSELECTBOX ?>
                                </select>
                            </td>
                            <th scope="row">
                                <label for="insuranceCompanyDeptName">부서/채널</label>
                            </th>
                            <td>
                                <div class="select-custom">
                                    <select name="insuranceCompanyDeptName" id="insuranceCompanyDeptName">
                                        <?=$DEPTLISTSELECTBOX;?>
                                    </select>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="insuranceCompanyManager">
                                    담당자
                                </label>
                            </th>
                            <td>
                                <input type="text" name="insuranceCompanyManager" id="insuranceCompanyManager" value="<?=$SEARCH_PARAM['insuranceCompanyManager']?>" placeholder="담당자 실명">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="insuranceCompanyManagerTel">
                                    연락처
                                </label>
                            </th>
                            <td>
                                <input type="text" name="insuranceCompanyManagerTel" id="insuranceCompanyManagerTel" value="<?=$SEARCH_PARAM['insuranceCompanyManagerTel']?>" placeholder="010-2345-6789">
                            </td>
                            <th scope="row">
                                <label for="insuranceCompanyManagerEmail">
                                    이메일
                                </label>
                            </th>
                            <td>
                                <input type="email" name="insuranceCompanyManagerEmail" id="insuranceCompanyManagerEmail" value="<?=$SEARCH_PARAM['insuranceCompanyManagerEmail']?>" placeholder="aa@bis.co.kr">
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
                
                <a href="/insuranceCompany_reg" class="button point rgstr">등록</a>
            </div>
            

            <div class="table-box">
                <table>
                    <colgroup>
                        <col width="50px;">
                        <col width="80px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="100px;">
                        <col width="150px;">
                        <col width="80px;">
                        <col width="auto;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>구분</th>
                            <th>보험사</th>
                            <th>부서/채널</th>
                            <th>담당자/직책</th>
                            <th>연략처</th>
                            <th>휴대전화번호</th>
                            <th>이메일</th>
                            <th>내부<br />담당자</th>
                            <th>메모</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($INSURANCECOMPANY)) {
                            foreach ($INSURANCECOMPANY as $key => $val) {
                                ?>
                                <tr>
                                    <td><?= $TOTAL_CNT ?></td>
                                    <td><?= $val->gubun ?></td>
                                    <td><?= $val->catnm ?></td>
                                    <td><?= $val->insuranceCompanyDeptName ?></td>
                                    <td><?= $val->manager ?></td>
                                    <td><?= $val->insuranceCompanyManagerTel ?></td>
                                    <td><?= $val->insuranceCompanyManagerMobile ?></td>
                                    <td><?= $val->insuranceCompanyManagerEmail ?></td>
                                    <td><?= $val->adminName ?></td>
                                    <td><pre><?= $val->memo ?></pre></td>
                                <?php
                                $TOTAL_CNT--;
                            }
                        }
                        ?>
                        
                    </tbody>
                </table>
                
                <!-- 페이징 -->
                <div class="paginate">
                    <?=$PAGING;?>
                </div>
            </div>
        </div>

<script>        
// 검색 버튼 클릭시 검색 폼을 get 방식으로 /insuranceCompany/list 전송한다.
$(".search").click(function(){
    // #insuranceCompanyCate 에서 선택된 값을 insuranceCompanyCate 에 담는다.
    var insuranceCompanyCate = $("select[name='insuranceCompanyCate']").val();
    var insuranceCompanyDeptName = $("select[name='insuranceCompanyDeptName']").val();
    var insuranceCompanyManager = $("input[name='insuranceCompanyManager']").val();
    var insuranceCompanyManagerTel = $("input[name='insuranceCompanyManagerTel']").val();
    var insuranceCompanyManagerEmail = $("input[name='insuranceCompanyManagerEmail']").val();

    var url = "/insuranceCompany/list?insuranceCompanyCate="+insuranceCompanyCate+"&insuranceCompanyDeptName="+insuranceCompanyDeptName+"&insuranceCompanyManager="+insuranceCompanyManager+"&insuranceCompanyManagerTel="+insuranceCompanyManagerTel+"&insuranceCompanyManagerEmail="+insuranceCompanyManagerEmail;
    //alert(url);
    location.href = url;
    return false;
});





//// 페이지 로딩시 #insuranceCompanyCate 에 get 으로 받은 insuranceCompanyDivision 값을 selected 한다.
//$(document).ready(function(){
//    var insuranceCompanyCate = "<?php //$SEARCH_PARAM['insuranceCompanyCate'];?>";
//    $("#insuranceCompanyCate").val(insuranceCompanyCate);
//});
//
//// 페이지 로딩시에 보험사테이블에 등록되어 있는 부서명 리스트를 컨트롤에서 가져온다 $DEPTLIST 해당 리스트를 기반으로 부서/채널에 INPUT TEXT에 자동완성 기능을 추가한다.
//// 사용자가 부서/채널 INPUT TEXT에 값을 입력하면 해당 값이 $DEPTLIST 에 있는지 확인하여 있으면 자동완성 기능을 추가한다.
//// $DEPTLIST 를 하나의 배열로 만든다.
//// autocomplete 를 인클루드 한다.
//// https://jqueryui.com/autocomplete/
//
//var deptList = [];
//<?php
//if (isset($DEPTLIST)) {
//    foreach ($DEPTLIST as $key => $val) {
//        ?>
//        deptList.push("<?php //$val->insuranceCompanyDeptName ?>");
//        <?php
//    }
//}
//?>
//// 부서/채널 INPUT TEXT 에 자동완성 기능을 추가한다.
//$("#insuranceCompanyDeptName").autocomplete({
//    source: deptList
//});

</script>