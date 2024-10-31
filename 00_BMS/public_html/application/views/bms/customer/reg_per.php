                <!-- 개인 start -->

                <table>
                    <caption>
                        고객사등록(개인) 테이블로 성명, 주민번호, 연락처, 휴대전화번호, 이메일, 거래처담당자, 관리채널, 주소, 메모 등의 정보를 입력하고 저장합니다.
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
                                <label for="customer_name" class="essential">
                                    성명
                                </label>
                            </th>
                            <td>
                                <input type="text" name="customer_name" id="customer_name" placeholder="성명 입력" value="" required>
                            </td>
                            <th scope="row">
                                <label for="resident_number" class="essential">
                                    주민번호
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- 최대로 입력 받는 글자수 제한 -->
                                    <input type="text" name="resident_number" id="resident_number" maxlength="14" placeholder="800719-2232815" value="" required>
                                    <input type="hidden" name="resident_number_ok" id="resident_number_ok" value="0">
                                    <span name="resident_number_check" id="resident_number_check"></span>
                                </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="tel" class="essential">
                                    연락처
                                </label>
                            </th>
                            <td>
                                <input type="text" name="tel" id="tel" maxlength="13" placeholder="02-3456-7890" value="" onkeyup="callautoHypenPhone(this);" required autocomplete="off">
                            </td>
                            <th scope="row">
                                <label for="manager_mobile" class="essential">
                                    휴대전화번호
                                </label>
                            </th>
                            <td>
                                <input type="text" name="manager_mobile" id="manager_mobile" maxlength="13" placeholder="010-2345-6789" value="" onkeyup="callautoHypenPhone(this);" required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email" class="essential">
                                    이메일
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="email" name="email" id="email" placeholder="amdin@amdin.co.kr" value="" required autocomplete="off">
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
                                        <input type="radio" id="offline" class="radio-custom" name="management_channel" value="offline" required>
                                        <label for="offline" class="radio-custom-label">오프라인</label>
                                    </div>
                                    <div class="radiobox">
                                        <input type="radio" id="online" class="radio-custom" name="management_channel" value="ubiz">
                                        <label for="online" class="radio-custom-label">온라인(유비즈)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="manager_name">
                                    거래처 담당자
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="text" name="manager_name" id="manager_name" placeholder="담당자명 입력" value="">
                                    <span class="between">/</span>
                                    <input type="text" name="manager_position" id="manager_position" placeholder="직책 입력" value="">
                                </div>
                            </td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="searchaddr">
                                    주소
                                </label>
                            </th>
                            <td colspan="3">
                                <div class="inputArea">
                                    <input type="hidden" name="postcode" id="postcode" readonly>
                                    <input type="hidden" name="jibun_address" id="jibun_address" readonly>
                                    <input type="hidden" name="extra_address" id="extra_address" placeholder="참고항목">
                                    <input type="text" name="road_address" id="road_address" placeholder="우편번호 찾기" readonly>
                                    <button type="button" class="searchaddr" id="searchaddr" onclick="searchAddressZipcode()" >주소검색</button>
                                    <input type="text" name="detail_address" id="detail_address" placeholder="상세주소 입력" value="">
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
                                <textarea name="memo" id="memo" class="textarea" placeholder="추가 사항 입력"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- 개인 end -->

                
<script>
    // 연락처와 휴대전화번호에 자동으로 하이픈(-)을 넣어주는 함수 ( common.js 에서 가져옴 )
    function callautoHypenPhone(obj){
        var number = obj.value; // obj.value : input 태그의 value 값
        // autoHypenPhone 로 부터 리턴 받은 값을 다시 input 태그의 value 값으로 넣어준다.
        obj.value = autoHypenPhone(number);
    }


    // 개인인 경우 resident_number 에 값을 입력 받을때 마다 가입된 주민 번호 인지 확인 한다.
    $("#resident_number").keyup(function(){
        checkResidentNumber();
    });

    // resident_number 에서 포커스가 사라질 때에도 가입된 주민 번호인지 한 번 더 체크 한다.
    $("#resident_number").focusout(function(){
        checkResidentNumber();
    });


    // 가입된 주민 번호인지 확인 하는 함수
    function checkResidentNumber(){
        // 초기화
        $("#resident_number_ok").val(0);
        var resident_number = $("#resident_number").val();
        var resident_number_ok = $("#resident_number_ok").val();
        var resident_number_check = $("#resident_number_check");
        var resident_number_check_msg = "사용할 수 없는 주민번호 입니다.";
        var resident_number_check_msg2 = "가입 가능한 주민번호 입니다.";
        var resident_number_check_msg3 = "주민번호를 입력해주세요.";
        var resident_number_check_msg4 = "주민번호를 정확히 입력해주세요.";

        // 자동으로 하이픈(-)을 넣어주는 함수 ( common.js 에서 가져옴 )
        resident_number = autoHypenJuminNo(resident_number);
        $("#resident_number").val(resident_number);

        if(resident_number == ''){
            resident_number_check.html(resident_number_check_msg3);
            resident_number_check.css("color", "red");
            $("#resident_number_ok").val(0);
            return false;
        } else if(resident_number.length != 14){
            resident_number_check.html(resident_number_check_msg4);
            resident_number_check.css("color", "red");
            $("#resident_number_ok").val(0);
            return false;
        } else if(resident_number_ok == 1){
            resident_number_check.html(resident_number_check_msg2);
            resident_number_check.css("color", "blue");
            $("#resident_number_ok").val(1);
            return false;
        } else {
            $.ajax({
                url: "/checkJuminNo",
                type: "POST",
                data: {resident_number:resident_number},
                dataType: "json",
                success: function(data){
                    console.log(data);
                    if(data.result == "fail"){
                        resident_number_check.html(resident_number_check_msg);
                        resident_number_check.css("color", "red");
                        $("#resident_number_ok").val(0);
                        return false;
                    } else {
                        resident_number_check.html(resident_number_check_msg2);
                        resident_number_check.css("color", "blue");
                        $("#resident_number_ok").val(1);
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