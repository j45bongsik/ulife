    <div class="conts-box">
        <h1>회원 관리</h1>
        <h2 class="subtitle">회원 등록</h2>
        <div class="write-table mgT10">
            <form name="adminRegForm" id="adminRegForm">
            <ul>
                <li class="title">아이디 *</li>
                <li>
                    <input type="text" name="adminId" id="adminId" placeholder="아이디 입력" maxlength ="20" value="master">
                    <!-- id 에 입력할때 마다 javascript idCheck 함수를 사용해서 idCheck_return 에 결과 값을 보여줌 -->
                    <div id="idCheck_return" style="width:400px"></div>
                    <input type="hidden" name="idtf" id="idtf" value="0">
                </li>
                <li class="title">비밀번호 *</li>
                <li>
                    <input type="password" name="adminPwd" id="adminPwd" placeholder="비밀번호 입력" value="masterpassword">
                </li>
                
                <li class="title">이름 *</li>
                <li>
                    <input type="text" name="adminName" id="adminName" placeholder="이름 입력" value="디지털사업부">
                </li>
                <li class="title">하이웍스 아이디</li>
                <li>
                    <input type="text" name="adminHwId" id="adminHwId" placeholder="하이웍스 아이디 입력" value="lsm">
                </li>
                
                <li class="title">휴대폰번호</li>
                <li>
                    <input type="tel" name="adminMobile" id="adminMobile" placeholder="휴대폰번호 입력" value="01071174995">
                    <div id="mobileCheck_return" style="width:400px"></div>
                </li>
                <li class="title">이메일</li>
                <li>
                    <input type="email" name="adminEmail" id="adminEmail" placeholder="이메일 입력" value="lsm@bis.co.kr">
                </li>

                <li class="title">권한</li>
                <li class="first check-box">
                    <div class="checkbox">
                        <input type="checkbox" name="authCustomerAccount" id="authCustomerAccount" class="checkbox-custom" checked>
                        <label for="authCustomerAccount" class="checkbox-custom-label">고객관리</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="authInsuranceContract" id="authInsuranceContract" class="checkbox-custom" checked>
                        <label for="authInsuranceContract" class="checkbox-custom-label">계약 관리</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="authBasicInformation" id="authBasicInformation" class="checkbox-custom" checked>
                        <label for="authBasicInformation" class="checkbox-custom-label">기초 정보 관리</label>
                    </div>
                </li>
            </ul>
            </form>
        </div>
        <div class="memb-table mgT15">
            <div class="btn-pot-right">
                <a class="button point rgstr" id="admin_reg_btn">등록</a>
            </div>
        </div>
    </div>

    <script>
        // 회원 등록 버튼 클릭시 회원 등록 처리
        $(document).on('click', '#admin_reg_btn', function (){

            // 아이디 중복 체크를 하지 않았으면 아이디 중복 체크를 하라는 메세지를 띄움
            if(document.getElementById("idtf").value == "0"){
                alert("아이디 중복 체크를 해주세요.");
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
            // 핸드폰번호를 입력하지 않으면 핸드폰번호 체크를 하지 않음 그리고 핸드폰번호 체크 결과 값을 지움
            if(adminMobile == ""){
                document.getElementById("mobileCheck_return").innerHTML = "";
                mobiletf = document.getElementById("mobiletf").value = "0";
                return false;
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