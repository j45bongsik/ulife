                <!-- 법인 사업자 start -->
            
                <table>
                    <caption>
                        고객사등록(법인) 테이블로 법인명,업종, 대표자명, 사업자번호, 거래처담당자, 부서, 연락처, 휴대전화번호, 대표번호, 홈페이지, 이메일, 관리채널, 소재지, 메모 등의 정보를 입력하고 저장합니다
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
                                <label for="customer_name" class="essential">
                                    법인명
                                </label>
                            </th>
                            <td>
                                <input type="text" name="customer_name" id="customer_name" placeholder="법인명 입력" value="" required>
                            </td>
                            <th scope="row">
                                <label for="industry" class="essential">
                                    업종
                                </label>
                            </th>
                            <td>
                                <input type="text" name="industry" id="industry" placeholder="업종 입력" value="" required>
                            </td>
                            <th scope="row">
                                <label for="ceo_name" class="essential">
                                    대표자명
                                </label>
                            </th>
                            <td>
                                <input type="text" name="ceo_name" id="ceo_name" placeholder="대표자명 입력" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="business_number" class="essential">
                                    사업자번호
                                </label>
                            </th>
                            <td >
                                <div class="inputArea">
                                    <input type="text" name="business_number" id="business_number" placeholder="012-34-34567" value="" maxlength="12" required>
                                    <!-- 사업자 번호 체크 -->
                                    <input type="hidden" name="business_number_ok" id="business_number_ok" value="0">
                                    <span id="business_number_ok_msg" class="ok" style=""></span>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="manager_name" class="essential">
                                    거래처 담당자
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="text" name="manager_name" id="manager_name" placeholder="담당자명 입력" value="" required>
                                    <span class="between">/</span>
                                    <input type="text" name="manager_position" id="manager_position" placeholder="직책 입력" value="" required>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="manager_dept" class="essential">
                                    부서
                                </label>
                            </th>
                            <td>
                                <input type="text" name="manager_dept" id="manager_dept" placeholder="총무부" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="manager_tel" class="essential">
                                    연락처
                                </label>
                            </th>
                            <td>
                                <input type="text" name="manager_tel" id="manager_tel" maxlength="13" placeholder="02-3456-7890" value="" onkeyup="callautoHypenPhone(this);" required>
                            </td>
                            <th scope="row">
                                <label for="manager_mobile" class="essential">
                                    휴대전화번호
                                </label>
                            </th>
                            <td>
                                <input type="text" name="manager_mobile" id="manager_mobile" maxlength="13" placeholder="010-2345-6789" value="" onkeyup="callautoHypenPhone(this);" required>
                            </td>
                            <th scope="row">
                                <label for="tel" class="essential">
                                    대표번호
                                </label>
                            </th>
                            <td>
                                <input type="text" name="tel" id="tel" maxlength="13" placeholder="1566-1234" value="" onkeyup="callautoHypenPhone(this);" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            
                            <th scope="row">
                                <label for="homepage">
                                    홈페이지
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <span class="between rightPadding">https://</span>
                                    <input type="text" name="homepage" id="homepage" placeholder="bis.co.kr" value="">
                                </div>
                            </td>
                            <th scope="row">
                                <label for="email" class="essential">
                                    이메일
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="email" name="email" id="email" placeholder="amdin@amdin.co.kr" value=""  autocomplete="off" required>
                                    <input type="hidden" name="email_ok" id="email_ok" value="0">
                                    <span name="email_check" id="email_check"></span>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="offline" class="essential">
                                    관리채널
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="radiobox">
                                        <input type="radio" id="offline" name="management_channel" class="radio-custom" value="offline" required>
                                        <label for="offline" class="radio-custom-label">오프라인</label>
                                    </div>
                                    <div class="radiobox">
                                        <input type="radio" id="online" name="management_channel" class="radio-custom" value="ubiz">
                                        <label for="online" class="radio-custom-label">온라인(유비즈)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                            <th scope="row">
                                <label for="searchaddr" class="essential">
                                    소재지
                                </label>
                            </th>
                            <td colspan="5">
                                <div class="inputArea">
                                    <input type="hidden" name="postcode" id="postcode" readonly value="">
                                    <input type="hidden" name="jibun_address" id="jibun_address" readonly>
                                    <input type="hidden" name="extra_address" id="extra_address" placeholder="참고항목">
                                    <input type="text" name="road_address" id="road_address" placeholder="우편번호 찾기" readonly value="" required>
                                    <button type="button" class="searchaddr" id="searchaddr" onclick="searchAddressZipcode()" >주소검색</button>
                                    <input type="text" name="detail_address" id="detail_address" placeholder="상세주소 입력" value="" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="memo">
                                    메모
                                </label>
                            </th>
                            <td colspan="5">
                                <textarea name="memo" id="memo" class="textarea" placeholder="추가 사항 입력"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- 법인 사업자 end -->

<script>
    // 연락처와 휴대전화번호에 자동으로 하이픈(-)을 넣어주는 함수 ( common.js 에서 가져옴 )
    function callautoHypenPhone(obj){
        var number = obj.value; // obj.value : input 태그의 value 값
        // autoHypenPhone 로 부터 리턴 받은 값을 다시 input 태그의 value 값으로 넣어준다.
        obj.value = autoHypenPhone(number);
    }


    // 법인사업자와 개인사업자 경우 business_number 에 값을 입력 받을때 마다 가입된 사업자 번호 인지 확인 한다.
    $("#business_number").keyup(function(){
        checkBizNo1();
    });

    // 개인인 경우 resident_number 에 값을 입력 받을때 마다 가입된 주민 번호 인지 확인 한다.
    $("#resident_number").keyup(function(){
        checkResidentNumber();
    });

    // resident_number 에서 포커스가 사라질 때에도 가입된 주민 번호인지 한 번 더 체크 한다.
    $("#resident_number").focusout(function(){
        checkResidentNumber();
    });


    // 가입된 사업자 번호인지 확인 하는 함수
    function checkBizNo1(){
        // 초기화
        //console.log("checkBizNo");
        $("#business_number_ok").val(0);

        var business_number = $("#business_number").val();
        var business_number_ok = $("#business_number_ok").val();
        var business_number_ok_msg = $("#business_number_ok_msg");
        var business_number_check_msg = "사용할 수 없는 사업자번호 입니다.";
        var business_number_check_msg2 = "가입 가능한 사업자번호 입니다.";
        var business_number_check_msg3 = "사업자번호를 입력해주세요.";
        var business_number_check_msg4 = "사업자번호를 정확히 입력해주세요.";

        // 사업자 번호에 하이픈(-)을 넣어준다.
        var restr = autoHypenBizNo(business_number);

        //사업자 번호 입력칸에 하이픈(-)을 넣어준다.
        $("#business_number").val(restr);

        // business_number 의 길이가 10자리가 아니면 에러 메시지를 출력한다.
        if(business_number.length != 12){
            business_number_ok_msg.html(business_number_check_msg4);
            business_number_ok_msg.css("color", "red");
            $("#business_number_ok").val(0);
            return false;
        }

        if(business_number == ''){
            business_number_ok_msg.html(business_number_check_msg3);
            business_number_ok_msg.css("color", "red");
            $("#business_number_ok").val(0);
            return false;
        } else if(business_number_ok == 1){
            business_number_ok_msg.html(business_number_check_msg2);
            business_number_ok_msg.css("color", "blue");
            $("#business_number_ok").val(1);
            return false;
        } else {
            $.ajax({
                url: "/checkBizNo",
                type: "POST",
                data: {business_number:business_number},
                dataType: "json",
                success: function(data){
                    console.log(data);
                    if(data.result == "fail"){
                        business_number_ok_msg.html(business_number_check_msg);
                        business_number_ok_msg.css("color", "red");
                        $("#business_number_ok").val(0);
                        return false;
                    } else {
                        business_number_ok_msg.html(business_number_check_msg2);
                        business_number_ok_msg.css("color", "blue");
                        $("#business_number_ok").val(1);
                        return false;
                    }

                },
                error: function(){
                    console.log("실패");
                }
            });
        }
        
    }


    // 이메일 입력시 이메일 중복 체크
    $("#email").keyup(function(){
        checkEmail();
    });

    // 이메일 입력시 포커스가 사라질 때에도 이메일 중복 체크
    $("#email").focusout(function(){
        checkEmail();
    });


    // 이메일 중복 체크
    function checkEmail(email){
        // 초기화
        console.log("checkEmail");
        $("#email_ok").val(0);

        var email = $("#email").val();
        var email_check = $("#email_check");
        var email_check_ok = $("#email_ok").val();
        var email_check_msg = "사용할 수 없는 이메일 입니다.";
        var email_check_msg2 = "가입 가능한 이메일 입니다.";
        var email_check_msg3 = "이메일을 입력해주세요.";
        var email_check_msg4 = "이메일을 정확히 입력해주세요.";
        
        if(email == ''){
            email_check.html(email_check_msg3);
            email_check.css("color", "red");
            $("#email_ok").val(0);
            return false;
        } else if(email_check_ok == 1){
            email_check.html(email_check_msg2);
            email_check.css("color", "blue");
            $("#email_ok").val(1);
            return false;
        } else {
            $.ajax({
                url: "/checkEmail",
                type: "POST",
                data: {email:email},
                dataType: "json",
                success: function(data){
                    if(data.result == "fail"){
                        email_check.html(email_check_msg);
                        email_check.css("color", "red");
                        $("#email_ok").val(0);
                        return false;
                    } else {
                        email_check.html(email_check_msg2);
                        email_check.css("color", "blue");
                        $("#email_ok").val(1);
                        return false;
                    }
                },
                error: function(){
                    console.log("실패");
                }
            });
        }
    }

    // road_addres 클릭시 주소검색 버튼 작동
    document.getElementById("road_address").addEventListener("click", function() {
        document.getElementById("searchaddr").click();
    });

</script>