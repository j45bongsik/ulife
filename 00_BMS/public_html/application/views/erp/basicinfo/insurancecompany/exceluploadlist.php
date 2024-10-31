
<div class="conts-box">
    <div class="titleArea">
        <h1>월결산 내역 업로드</h1>
    </div>

    <!-- form -->
    <form name="excelUploadForm" id="excelUploadForm" method="post" action="/insuranceCompanyExcelUploadRegProc" enctype="multipart/form-data">
        <!-- searchArea -->
        <article class="searchArea">
            <div class="inputArea upload">
                <!-- select-custom -->
                <!--
                <div class="select-custom">
                <select name="searchDateYM" id="searchDateYM" required>
                        <option value="" selected>작성년월 선택</option>
                        <option value="202403" >2024년 03월</option>
                        <option value="202402" >2024년 02월</option>
                    </select>
                </div>
                -->
                <!-- //select-custom -->

                <!-- inputBox -->
                <div class="fileArea">
                    <label for="inputUpload" class="btn search">보험사 1차가공 업로드</label>
                    <input type="file" id="inputUpload" name="inputUpload" value="">
                </div>
                <!-- //inputBox -->
            </div>
            
        </article>
        <!-- //searchArea -->
    </form>
    <!-- //form -->


    <!-- memb-table -->
    <article class="memb-table erpList">
        <table>
            <caption>
                매입내역 테이블로 순번 업로드코드, 업로드일, 해당월, 회사명, 관리 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: auto;">
                <col style="width: 150px;">
                <col style="width: 150px;">
                <col style="width: 150px;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">업로드코드</th>
                    <th scope="col">업로드일</th>
                    <th scope="col">건수</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- 페이지 당 tr은 max 10개까지만 -->
                <?=$EXCELUPLOADHISTORYTABLE?>
            </tbody>
        </table>

    </article>
    <!-- //memb-table -->

    <!-- paginate ->
    <div class="paginate">
        <a href="" rel="start"><i class="prev-arrow-double"></i></a>
        <a href="" rel="prev"><i class="prev-arrow"></i></a>
        <a href="">1</a>
        <strong>2</strong>
        <a href="">3</a>
        <a href="" rel="next"><i class="next-arrow"></i></a>
        <a href="" rel="last"><i class="next-arrow-double"></i></a>
    </div>
    <!- //paginate -->
    <!-- paginate -->
    <?=$PAGINATION?>
    <!-- //paginate -->
</div>

<script>
    // 파일 업로드시 excel파일인지 검사
    document.getElementById('inputUpload').addEventListener('input', function(event){
        let filePath = event.target.value;
        let lastDotIndex = filePath.lastIndexOf('.');
        let lastBackSlash = filePath.lastIndexOf('\\');
        let fileExtension = filePath.substring(lastDotIndex + 1);
        let fileName = filePath.substring(lastBackSlash + 1);
        
        if (fileExtension === 'xlsx' || fileExtension === 'xlsm' || fileExtension === 'xlsb' || fileExtension === 'xltx' || fileExtension === 'xls') {
            if (confirm(fileName + '\n업로드 하시겠습니까?')) {
                document.getElementById('excelUploadForm').submit();
                
            } else {
                event.target.value = '';
            }
        } else {
            //alert('엑셀 파일을 업로드 하세요. \n지원하는 형식 : xls, xlsx, xlsm, xlsb, xltx')
            alert('엑셀(xls) 파일을 업로드 하세요.');
            event.target.value = '';
        }
    })

    // 삭제 버튼 클릭시 해당 업로드 코드를 전송하여 삭제 delHistory('C_1') //변수는 타입과 프라이머리키 조합 ('타입_프라이머리키') ajax로 처리 후 성공시 새로고침
    function delHistory(code) {
        if (confirm('해당 업로드 내역을 삭제하시겠습니까?')) {
            $.ajax({
                url: '/cardUploadBreakdownDelProc',
                type: 'post',
                data: {
                    code: code
                },
                success: function(data) {
                    if (data === 'success') {
                        alert('삭제 성공');
                        location.reload();
                    } else {
                        alert('삭제 실패');
                    }
                }
            })
        }
    }

</script>