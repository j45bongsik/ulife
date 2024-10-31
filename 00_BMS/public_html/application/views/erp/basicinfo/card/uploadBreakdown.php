
<div class="conts-box">
    <div class="titleArea">
        <h1>법인카드 사용내역 업로드</h1>
    </div>

    <!-- form 엑셀 파일 업록드 -->
    <form name="excelUploadForm" id="excelUploadForm" method="post" action="/cardUploadBreakdownRegProc" enctype="multipart/form-data" autocomplete="off">
        <!-- searchArea -->
        <article class="searchArea">
            <div class="inputArea upload">

                <label for="searchDateY">
                    <input type="text" name="searchDateY" id="searchDateY" class="onlyNum" style="width: 126px;" placeholder="청구년도(숫자 4자리)" required maxlength="4" inputmode="numberic">
                </label>
                <!-- select-custom -->
                <div class="select-custom">
                    <select name="searchDateM" id="searchDateM" required>
                    <option value="" selected>청구월 선택</option>
                        <option value="01">01월</option>
                        <option value="02">02월</option>
                        <option value="03">03월</option>
                        <option value="04">04월</option>
                        <option value="05">05월</option>
                        <option value="06">06월</option>
                        <option value="07">07월</option>
                        <option value="08">08월</option>
                        <option value="09">09월</option>
                        <option value="10">10월</option>
                        <option value="11">11월</option>
                        <option value="12">12월</option>
                    </select>
                </div>
                <!-- //select-custom -->

                <!-- inputBox -->
                <div class="fileArea">
                    <label for="inputUpload" class="btn search">내역 업로드</label>
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
                법인카드내역 테이블로 순번 업로드코드, 업로드일, 해당월, 카드사, 관리 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: auto;">
                <col style="width: 150px;">
                <col style="width: 150px;">
                <col style="width: 150px;">
                <col style="width: 150px;">
                <col style="width: 150px;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">업로드코드</th>
                    <th scope="col">업로드일</th>
                    <th scope="col">해당월</th>
                    <th scope="col">카드사</th>
                    <th scope="col">건수</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- 페이지 당 tr은 max 10개까지만 -->
                <?=$CARDUPLOADHISTORYTABLE?>
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
    !-- //paginate -->
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

    // 청구년도 숫자만 입력받게
    document.querySelectorAll('.onlyNum').forEach(function(onlyNumber) {
        onlyNumber.addEventListener('input', function(event) {
            let value = event.target.value;
            event.target.value = value.replace(/[^0-9]/g, '');
        });
    });

    // 청구년월 선택안하고 업로드 버튼을 누르면 경고창을 띄운다.
    document.getElementById('inputUpload').addEventListener('click', function(event){
        let searchDateY = document.getElementById('searchDateY');
        let searchDateM = document.getElementById('searchDateM');
        
        if (searchDateY.value === '' && searchDateM.value === '') {
            alert('청구년도 입력 후, 청구월을 선택하세요.');
            event.preventDefault();
            searchDateY.focus();
            return false;
        } else if (searchDateY.value === '') {
            alert('청구년도를 입력하세요.');
            event.preventDefault();
            searchDateY.focus();
            return false;
        } else if (searchDateM.value === '') {
            alert('청구월을 선택하세요.');
            event.preventDefault();
            searchDateM.focus();
            return false;
        }
        let searchDateYM = searchDateY + searchDateM;
    })

    // id 값이 searchDateYM 인 select 박스의 값이 변경될 때마다 해당 값을 전송하여 해당 월의 업로드 내역이 있는지 확인
    // ajax 로 처리하여 해당 월의 업로드 내역이 있으면 "해당 청구월의 업로드 내역이 있습니다." 라는 메세지를 출력 하고 내역업로드 버튼을 비활성화 시킨다.
    document.getElementById('searchDateYM').addEventListener('change', function(event){
        let searchDateYM = event.target.value;
        if (searchDateYM !== '') {
            // ajax로 해당 월의 업로드 내역이 있는지 확인
            $.ajax({
                url: '/cardUploadBreakdownCheck',
                type: 'post',
                data: {
                    type: 'C', // 카드 
                    searchDateYM: searchDateYM // 청구년월
                },
                success: function(data) {
                    if (data === 'exist') {
                        alert('해당 청구월의 업로드 내역이 있습니다.');
                        document.getElementById('inputUpload').disabled = true;
                    } else {
                        document.getElementById('inputUpload').disabled = false;
                    }
                }
            })
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