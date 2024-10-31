<div class="conts-box">
    <div class="titleArea">
        <h1>보험사 추가</h1>
        <span class="essential">* 는 필수 항목 입니다.</span>
    </div>

    <article class="erpList reg">
        <table>
            <caption>
                보험사추가 테이블로 구분, 보험사명, 부서, 담당자정보, 이메일, 연락처, 휴대전화번호, 내부담당, 메모 등의 정보를 입력하고 저장합니다.
            </caption>
            <colgroup>
                <col style="width: 175px;">
                <col style="width: auto;">
                <col style="width: 175px;">
                <col style="width: auto;">
            </colgroup>
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="in001" class="essential">
                            구분
                        </label>
                    </th>
                    <td>
                        <div class="checkArea">
                            <?=$INSURANCERADIOBOX;?>
                        </div>
                    </td>
                    <th scope="row">
                        <label for="InsurancecompanySelectBox" class="essential">
                            보험사명
                        </label>
                    </th>
                    <td>
                        <div class="select-custom">
                            <select name="InsurancecompanySelectBox" id="InsurancecompanySelectBox" required>
                                <option value="" selected>선택</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="department" class="essential">
                            부서
                        </label>
                    </th>
                    <td>
                        <input type="text" name="department" id="department" value="" placeholder="부서명 입력" required autocomplete="off">
                    </td>
                    <th scope="row">
                        <label for="insuranceCompanyManager" class="essential">
                            담당자
                        </label>
                    </th>
                    <td>
                        <div class="inputArea">
                            <input type="text" name="insuranceCompanyManager" id="insuranceCompanyManager" class="second" placeholder="담당자명 입력" value="" required autocomplete="off">
                            <span class="between">/</span>
                            <input type="text" name="insuranceCompanyManagerPosition" id="insuranceCompanyManagerPosition" class="second" placeholder="직책 입력" value="" required autocomplete="off">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="insuranceCompanyManagerEmail" class="essential">
                            이메일
                        </label>
                    </th>
                    <td>
                        <div class="inputArea">
                            <input type="email" name="insuranceCompanyManagerEmail" id="insuranceCompanyManagerEmail" value="" placeholder="aaa@aaa.aaa" required autocomplete="off">
                            <!-- 이메일 형식이 맞는지 틀리는지 보여주는 공간 -->
                            <span class="email-check" id="email-check" style="color:red"></span>
                        </div>
                    </td>
                    <th scope="row">
                        <label for="insuranceCompanyManagerTel" class="essential">
                            연락처
                        </label>
                    </th>
                    <td>
                        <input type="tel" name="insuranceCompanyManagerTel" id="insuranceCompanyManagerTel" class="second" placeholder="연락처 입력" maxlength="13" value="" required autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="insuranceCompanyManagerMobile" class="essential">
                            휴대전화번호
                        </label>
                    </th>
                    <td>
                        <input type="tel" name="insuranceCompanyManagerMobile" id="insuranceCompanyManagerMobile" placeholder="휴대전화번호 입력" maxlength="13" value="" required autocomplete="off">
                    </td>
                    <th scope="row">
                        <label for="dept_no">
                            내부담당
                        </label>
                    </th>
                    <td>
                        <div class="inputArea">

                            <div class="select-custom">
                                <select name="dept_no" id="dept_no">
                                    <?=$DEPTLISTSELECTBOX;?>
                                </select>
                            </div>
                            <span class="between">/</span>
                            <div class="select-custom">
                                <select name="internalContactPerson" id="internalContactPerson">
                                    <option value="" selected>담당자선택</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="memo">
                            메모
                        </label>
                    </th>
                    <td colspan="3">
                        <textarea name="memo" id="memo" class="textarea" placeholder="추가 사항 입력" autocomplete="off"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </article>

    <div class="btn-box-conts">
        <a class="button point rgstr">추가</a>
    </div>
</div>


<script>
// 보험사 구분 선택시 보험사 명을 가져온다.
$(document).on("click", ".radio-custom", function(){
    var catno = $(this).val();
    var url = "/insurancecompany_SelectBox";
    var data = {
        "catno" : catno
    };
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
        success: function(data){
            $("#InsurancecompanySelectBox").html(data.html);
        },
        error: function(){
            alert("error");
        }
    });
});

// 내부 담당 부서 선택시 해당 부서의 담당자목록을 가져온다.
$(document).on("change", "#dept_no", function(){
    var dept_no = $(this).val();
    var url = "/member_SelectBox";
    var data = {
        "dept_no" : dept_no
    };
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
        success: function(data){
            $("#internalContactPerson").html(data.html);
        },
        error: function(){
            alert("error");
        }
    });
});


// 연락처와 휴대 전화 입력시 자동 하이픈 common.js 에서 가져옴
$(document).on("keyup", "#insuranceCompanyManagerTel", function(){
    $(this).val(autoHypenPhone( $(this).val() ));
});

$(document).on("keyup", "#insuranceCompanyManagerMobile", function(){
    $(this).val(autoHypenPhone( $(this).val() ));
});

// 이메일 입력시 정규식으로 이메일 형식인지 체크 common.js 에서 가져옴 결과 값은 email-check 에 출력
$(document).on("keyup", "#insuranceCompanyManagerEmail", function(){
    var email = $(this).val();
    if(email == ""){
        $(".email-check").html("");
    }else{
        checkEmailType(email, "email-check");
    }
});


// 보험사 추가 버튼 클릭시 보험사 추가
$(document).on("click", ".rgstr", function(){
    var catno = $("input[name='insurance']:checked").val();
    var catnm = $("input[name='insurance']:checked").next().text();
    var insuranceCompanyCatno = $("#InsurancecompanySelectBox").val();
    var insuranceCompanyCatnm = $("#InsurancecompanySelectBox option:selected").text();
    var department = $("#department").val();
    var internalContactPerson = $("#internalContactPerson").val();
    var insuranceCompanyManager = $("#insuranceCompanyManager").val();
    var insuranceCompanyManagerPosition = $("#insuranceCompanyManagerPosition").val();
    var insuranceCompanyManagerEmail = $("#insuranceCompanyManagerEmail").val();
    var insuranceCompanyManagerTel = $("#insuranceCompanyManagerTel").val();
    var insuranceCompanyManagerMobile = $("#insuranceCompanyManagerMobile").val();
    var dept_no = $("#dept_no").val();

    var memo = $("#memo").val();

    if(catno == "" || catno == null){
        alert("구분을 선택해주세요.");
        document.getElementById('in001').focus();
        return false;
    }
    if(insuranceCompanyCatno == "" || insuranceCompanyCatno == null){
        alert("보험사명을 선택해주세요.");
        document.getElementById('InsurancecompanySelectBox').focus();
        return false;
    }
    if(department == "" || department == null){
        alert("보험사 담당자의 부서를 선택해주세요.");
        document.getElementById('department').focus();
        return false;
    }
    if(insuranceCompanyManager == "" || insuranceCompanyManager == null){
        alert("보험사 담당자의 이름을 입력해주세요.");
        document.getElementById('insuranceCompanyManager').focus();
        return false;
    }
    if(insuranceCompanyManagerPosition == "" || insuranceCompanyManagerPosition == null){
        alert("보험사 담당자의 직책을 입력해주세요.");
        document.getElementById('insuranceCompanyManagerPosition').focus();
        return false;
    }
    if(insuranceCompanyManagerEmail == "" || insuranceCompanyManagerEmail == null){
        alert("보험사 담당자의 이메일을 입력해주세요.");
        document.getElementById('insuranceCompanyManagerEmail').focus();
        return false;
    }
    if(insuranceCompanyManagerTel == "" || insuranceCompanyManagerTel == null){
        alert("보험사 담당자의 연락처를 입력해주세요.");
        document.getElementById('insuranceCompanyManagerTel').focus();
        insuranceCompanyManagerTel.focus();
        return false;
    }
    if(insuranceCompanyManagerMobile == "" || insuranceCompanyManagerMobile == null){
        alert("보험사 담당자분 휴대전화번호를 입력해주세요.");
        document.getElementById('insuranceCompanyManagerMobile').focus();
        insuranceCompanyManagerMobile.focus();
        return false;
    }
    if(dept_no == "" || dept_no == null){
        alert("내부 담당자 부서를 선택해주세요.");
        document.getElementById('dept_no').focus();
        return false;
    }
    if(internalContactPerson == "" || internalContactPerson == null){
        alert("내부 담당자를 선택해주세요.");
        document.getElementById('internalContactPerson').focus();
        return false;
    }


    var url = "/insurancecompany_reg_ajax";
    var data = {
        "insuranceCompanyCate" : insuranceCompanyCatno,
        "insuranceCompanyName" : insuranceCompanyCatnm,
        "insuranceCompanyDeptName" : department,
        "internalContactPerson" : internalContactPerson,
        "insuranceCompanyManager" : insuranceCompanyManager,
        "insuranceCompanyManagerPosition" : insuranceCompanyManagerPosition,
        "insuranceCompanyManagerEmail" : insuranceCompanyManagerEmail,
        "insuranceCompanyManagerTel" : insuranceCompanyManagerTel,
        "insuranceCompanyManagerMobile" : insuranceCompanyManagerMobile,
        "memo" : memo
    };

    //console.log(data);
    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
        success: function(data){
            console.log(data);
            if(data.result == "success"){
                alert("보험사가 추가되었습니다.");
                location.href = "/insuranceCompany";
            }else{
                alert(data.message);
            }
        },
        error: function(){
            alert("error");
        }
    });
    
});
</script>