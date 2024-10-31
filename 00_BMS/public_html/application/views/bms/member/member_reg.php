    <div class="conts-box">
        <div class="titleArea">
            <h1>회원 관리</h1>
            <span class="essential">* 는 필수 항목 입니다.</span>
        </div>


        <form name="adminRegForm" id="adminRegForm" autocomplete="off">
            <article class="erpList reg">
                <div class="titleArea">
                    <h2 class="thirdTitle">회원등록</h2>
                </div>
                <table>
                    <caption>
                        회원관리 - 회원등록 테이블로 아이디, 비밀번호, 이름, 하이웍스아이디, 휴대폰번호, 이메일, 권한(고객관리/계약관리/기초정보관리) 등의 정보를 입력하고 저장합니다.
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
                                <label for="adminId" class="essential">
                                    아이디
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="text" name="adminId" id="adminId" placeholder="아이디 입력" maxlength ="20" value="" required>
                                    <!-- id 에 입력할때 마다 javascript idCheck 함수를 사용해서 idCheck_return 에 결과 값을 보여줌 -->
                                    <div id="idCheck_return"></div>
                                    <input type="hidden" name="idtf" id="idtf" value="0">
                                </div>
                            </td>
                            <th scope="row">
                                <label for="adminPwd" class="essential">
                                    비밀번호
                                </label>
                            </th>
                            <td>
                                <input type="password" name="adminPwd" id="adminPwd" placeholder="비밀번호 입력" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="adminName" class="essential">
                                    이름
                                </label>
                            </th>
                            <td>
                                <input type="text" name="adminName" id="adminName" placeholder="이름 입력" value="" required>
                            </td>
                            <th scope="row">
                                <label for="adminHwId">
                                    하이웍스 아이디
                                </label>
                            </th>
                            <td>
                                <input type="text" name="adminHwId" id="adminHwId" placeholder="하이웍스 아이디 입력" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="adminMobile">
                                    휴대폰번호
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <input type="tel" name="adminMobile" id="adminMobile" placeholder="휴대폰번호 입력" value="">
                                    <div id="mobileCheck_return"></div>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="adminEmail">
                                    이메일
                                </label>
                            </th>
                            <td>
                                <input type="email" name="adminEmail" id="adminEmail" placeholder="이메일 입력" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="authCustomerAccount">
                                    권한
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="checkbox">
                                        <input type="checkbox" name="authCustomerAccount" id="authCustomerAccount" class="checkbox-custom" >
                                        <label for="authCustomerAccount" class="checkbox-custom-label">고객관리</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="authFinancialManagement" id="authFinancialManagement" class="checkbox-custom" >
                                        <label for="authFinancialManagement" class="checkbox-custom-label">회계 관리</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="authInsuranceContract" id="authInsuranceContract" class="checkbox-custom" >
                                        <label for="authInsuranceContract" class="checkbox-custom-label">계약 관리</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="authBasicInformation" id="authBasicInformation" class="checkbox-custom" >
                                        <label for="authBasicInformation" class="checkbox-custom-label">기초 정보 관리</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>

            <div class="memb-table mgT15">
                <div class="btn-pot-right">
                    <a class="button point rgstr" id="admin_reg_btn">등록</a>
                </div>
            </div>

        </form>
        
    </div>

    <script>
        // 회원 등록 버튼 클릭시 회원 등록 처리
        $(document).on('click', '#admin_reg_btn', function (){

            // 아이디 중복 체크를 하지 않았으면 아이디 중복 체크를 하라는 메세지를 띄움
            if(document.getElementById("idtf").value == "0"){
                alert("아이디 중복 체크를 해주세요.");
                document.getElementById('adminId').focus();
                return false;
            }
            if(document.getElementById('adminPwd').value == "") {
                alert("비밀번호를 입력 해주세요.")
                document.getElementById('adminPwd').focus();
                return false;
            }
            if(document.getElementById('adminName').value == "") {
                document.getElementById('adminName').focus();
                alert("이름을 입력 해주세요.")
                return false;
            }

            // 아이디 중복 체크를 했으면 회원 등록 처리를 함
            $.ajax({
                type: 'post'
                , async: true
                , data: $("#adminRegForm").serialize()
                , url: "/Member/regProc"
                , dataType: "json"
                , success: function(data) {
                    // 콘솔 디버깅
                    console.log(data);
                    if(data['result'] == 'success'){
                        alert("회원 등록이 완료 되었습니다.");
                        location.href = "/member";
                    } else {
                        alert("회원 등록에 실패 하였습니다.");
                    }
                }
                , error: function(data, status, err) {
                        console.log("code:"+data.status+"\n"+"message:"+data.responseText+"\n"+"error:"+err);
                }
            })
        })


        // 아이디 입력할때 마다 중복아이디가 있는지 idCheck 함수를 사용해서 실시간 체크 하여 idCheck_return 에 결과 값을 보여줌
        $(document).on('keyup', '#adminId', function (){
            f_idCheck();
        })
        
        // 아이디 입력칸에서 포커스가 사라질때 아이디 체크 결과값을 한번더 확인함
        $(document).on('focusout', '#adminId', function (){
            f_idCheck();
        })
        
        // 핸드폰 번호 입력할 때마다 중복 핸드폰 번호가 있는지 확인하여 mobileCheck_return 에 결과 값을 보여줌
        $(document).on('keyup', '#adminMobile', function (){
            f_mobileCheck();
        })

        // 핸드폰 번호 입력칸에서 포커스가 사라질때 핸드폰 번호 체크 결과값을 한번더 확인함
        $(document).on('focusout', '#adminMobile', function (){
            f_mobileCheck();
        })

        // 아이디 중복 체크 함수
        function f_idCheck(){
            var adminId = document.getElementById("adminId").value;
            // 아이디를 입력하지 않으면 아이디 체크를 하지 않음 그리고 아이디 체크 결과 값을 지움
            if(adminId == ""){
                document.getElementById("idCheck_return").innerHTML = "";
                idtf = document.getElementById("idtf").value = "0";
                return false;
            }
            $.ajax({
                type: 'post'
                , async: true
                , data: {"adminId" : adminId}
                , url: "/Member/idCheck"
                , dataType: "json"
                , success: function(data) {
                    if(data['result'] == 'success'){
                        console.log(data);
                        document.getElementById("idCheck_return").innerHTML = "<span style='color:#0F6244; font-weight:1000 '>사용 가능한 아이디 입니다.</span>";
                        idtf = document.getElementById("idtf").value = "1";
                    } else {
                        document.getElementById("idCheck_return").innerHTML = "<span style='color:#fa1100' font-weight:1000 '>이미 사용중인 아이디 입니다.</span>";
                        idtf = document.getElementById("idtf").value = "0";
                    }
                }
                , error: function(data, status, err) {
                        console.log("code:"+data.status+"\n"+"message:"+data.responseText+"\n"+"error:"+err);
                }
            })
        }

        // 핸드폰번호 중복 체크 함수
        function f_mobileCheck(){
            var adminMobile = document.getElementById("adminMobile").value;

            if (adminMobile === "") {
                var mobileCheckReturn = document.getElementById("mobileCheck_return");
                var mobiletf = document.getElementById("mobiletf");

                if (mobileCheckReturn) {
                    mobileCheckReturn.innerHTML = ""; // Clear the inner content
                }

                if (mobiletf) {
                    mobiletf.value = "0"; // Set the default value
                }

                return false; // Exit early if there's no mobile number
            }
            $.ajax({
                type: 'post'
                , async: true
                , data: {"adminMobile" : adminMobile}
                , url: "/Member/mobileCheck"
                , dataType: "json"
                , success: function(data) {
                    if(data['result'] == 'success'){
                        console.log(data);
                        document.getElementById("mobileCheck_return").innerHTML = "<span style='color:#0F6244; font-weight:1000 '>사용 가능한 핸드폰번호 입니다.</span>";
                        mobiletf = document.getElementById("mobiletf").value = "1";
                    } else {
                        document.getElementById("mobileCheck_return").innerHTML = "<span style='color:#fa1100' font-weight:1000 '>이미 사용중인 핸드폰번호 입니다.</span>";
                        mobiletf = document.getElementById("mobiletf").value = "0";
                    }
                }
                , error: function(data, status, err) {
                        console.log("code:"+data.status+"\n"+"message:"+data.responseText+"\n"+"error:"+err);
                }
            })
        }

        function f_mobileCheck() {
            var adminMobile = document.getElementById("adminMobile").value;

            if (adminMobile === "") {
                var mobileCheckReturn = document.getElementById("mobileCheck_return");
                var mobiletf = document.getElementById("mobiletf");

                if (mobileCheckReturn) {
                    mobileCheckReturn.innerHTML = ""; // Clear the inner content
                }

                if (mobiletf) {
                    mobiletf.value = "0"; // Set the default value
                }

                return false; // Exit early if there's no mobile number
            }

            $.ajax({
                type: 'post',
                async: true,
                data: { "adminMobile": adminMobile },
                url: "/Member/mobileCheck",
                dataType: "json",
                success: function (data) {
                    var mobileCheckReturn = document.getElementById("mobileCheck_return");
                    var mobiletf = document.getElementById("mobiletf");

                    if (data['result'] === 'success') {
                        if (mobileCheckReturn) {
                            mobileCheckReturn.innerHTML = "<span style='color:#0F6244; font-weight:1000 '>사용 가능한 핸드폰번호 입니다.</span>";
                        }

                        if (mobiletf) {
                            mobiletf.value = "1"; // Set the success flag
                        }
                    } else {
                        if (mobileCheckReturn) {
                            mobileCheckReturn.innerHTML = "<span style='color:#fa1100; font-weight:1000 '>이미 사용중인 핸드폰번호 입니다.</span>";
                        }

                        if (mobiletf) {
                            mobiletf.value = "0"; // Set the error flag
                        }
                    }
                },
                error: function (data, status, err) {
                    console.log("code:" + data.status + "\n" + "message:" + data.responseText + "\n" + "error:" + err);
                }
            });
        }


    </script>



    <script>
		$(document).ready( function () {
			Date.prototype.format = function (f) {

			if (!this.valueOf()) return " ";	
				var weekKorName = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
				var weekKorShortName = ["일", "월", "화", "수", "목", "금", "토"];
				var weekEngName = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
				var weekEngShortName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				var d = this;
				return f.replace(/(yyyy|yy|MM|dd|KS|KL|ES|EL|HH|hh|mm|ss|a\/p)/gi, function ($1) {
				switch ($1) {
					case "yyyy": return d.getFullYear(); // 년 (4자리)
					case "yy": return (d.getFullYear() % 1000).zf(2); // 년 (2자리)
					case "MM": return (d.getMonth() + 1).zf(2); // 월 (2자리)
					case "dd": return d.getDate().zf(2); // 일 (2자리)
					case "KS": return weekKorShortName[d.getDay()]; // 요일 (짧은 한글)
					case "KL": return weekKorName[d.getDay()]; // 요일 (긴 한글)
					case "ES": return weekEngShortName[d.getDay()]; // 요일 (짧은 영어)
					case "EL": return weekEngName[d.getDay()]; // 요일 (긴 영어)
					case "HH": return d.getHours().zf(2); // 시간 (24시간 기준, 2자리)
					case "hh": return ((h = d.getHours() % 12) ? h : 12).zf(2); // 시간 (12시간 기준, 2자리)
					case "mm": return d.getMinutes().zf(2); // 분 (2자리)
					case "ss": return d.getSeconds().zf(2); // 초 (2자리)
					case "a/p": return d.getHours() < 12 ? "오전" : "오후"; // 오전/오후 구분
					default: return $1;
				}
			});
			};
			String.prototype.string = function (len) { var s = '', i = 0; while (i++ < len) { s += this; } return s; };
			String.prototype.zf = function (len) { return "0".string(len - this.length) + this; };
			Number.prototype.zf = function (len) { return this.toString().zf(len); };
		})

	</script>