<div class="memContents">
    <form name="loginform" action="/Member/loginProc" method="post">
    <div class="login-box erp">
        <div class="logo">
            <img src="/assets/img/common/Logo.png" alt="bis_logo">
        </div>
        <div class="naming"><strong>E</strong>nterprise <strong>R</strong>esource <strong>P</strong>lanning</div>

        <div class="input-box">
            <div class="input-item radius-5">
                <strong>ID</strong>
                <input type="text" name="adminId" id="adminId" value="" placeholder="admin ID">
            </div>
            <div class="input-item radius-5">
                <strong>PW</strong>
                <input type="password" name="adminPwd" id="adminPwd" value="" placeholder="password">
                <label for="visible">
                    <input type="checkbox" name="visible" id="visible">
                    <svg class="eye" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                    <svg class="eye-slash" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"></path></svg>
                </label>
            </div>
        </div>

        <div class="check-box save">
            <div class="checkbox">
                <input type="checkbox" id="saveId" name="saveId" />
                <label for="saveId">
                아이디 저장
                </label>
            </div>
            
        </div>

        <div class="btn-box-conts">
            <a id="loginbtn" class="button gradient">로그인</a>
        </div>

    </div>
    </form>
</div>

<script>
    // 로그인 버튼 클릭시 로그인 하기 serialize 사용하여 데이터 전송
    $(document).on('click', '#loginbtn', function (){
        
        // 아이디와 비밀번호 입력 체크
        if($("#adminId").val() == ""){
            alert("아이디를 입력해주세요.");
            $("#adminId").focus();
            return false;
        }
        if($("#adminPwd").val() == ""){
            alert("비밀번호를 입력해주세요.");
            $("#adminPwd").focus();
            return false;
        }
        // 아이디 저장 체크
        if($("#saveId").is(":checked")){
            setCookie("idChk", $("#adminId").val(), 7);
        }else{
            deleteCookie("idChk");
        }
        
        // 로그인 처리 실제로 해당 파일로 가서 처리 하는 것으로 변경 
        var data = $("form[name=loginform]").serialize();
        $.ajax({
            url: "/login_proc",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.result == "success"){
                    location.href = "/dashboard";
                } else {
                    alert("아이디 또는 비밀번호가 일치하지 않습니다.");
                }
            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            }
        });
    });


    

    // 페이지 로딩시 쿠키값이 있으면 아이디 저장 체크박스에 체크를 하고 아이디 입력칸에 쿠키값을 넣어줌
    $(document).ready(function(){
        var key = getCookie("idChk");
        if(key!=""){
            $("#adminId").val(key);
        }
        
        if($("#adminId").val() != ""){
            $("#saveId").attr("checked", true);
        }
        
        $("#saveId").change(function(){
            if($("#saveId").is(":checked")){
                setCookie("idChk", $("#adminId").val(), 7);
            }else{
                deleteCookie("idChk");
            }
        });
        
        $("#adminId").keyup(function(){
            if($("#saveId").is(":checked")){
                setCookie("idChk", $("#adminId").val(), 7);
            }
        });
    });


    // 비밀번호 입력칸에서 엔터키를 누르면 로그인 버튼 클릭
    $(document).on('keydown', '#adminPwd', function (e){
        if(e.keyCode == 13){
            $("#loginbtn").click();
        }
    });
</script>


<!-- 

<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"/></script>
<script>
$(document).ready(function(){
	var key = getCookie("idChk"); //user1
	if(key!=""){
		$("#username").val(key); 
	}
	 
	if($("#username").val() != ""){ 
		$("#idSaveCheck").attr("checked", true); 
	}
	 
	$("#idSaveCheck").change(function(){ 
		if($("#idSaveCheck").is(":checked")){ 
			setCookie("idChk", $("#username").val(), 7); 
		}else{ 
			deleteCookie("idChk");
		}
	});
	 
	$("#username").keyup(function(){ 
		if($("#idSaveCheck").is(":checked")){
			setCookie("idChk", $("#username").val(), 7); 
		}
	});
});
function setCookie(cookieName, value, exdays){
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}
 
function deleteCookie(cookieName){
	var expireDate = new Date();
	expireDate.setDate(expireDate.getDate() - 1);
	document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}
	 
function getCookie(cookieName) {
	cookieName = cookieName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cookieName);
	var cookieValue = '';
	if(start != -1){
		start += cookieName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cookieValue = cookieData.substring(start, end);
	}
	return unescape(cookieValue);
}
</script>
<form>
  <label for="username">아이디:</label>
  <input type="text" id="username" name="username" autocomplete="off"><br>

  <label for="password">비밀번호:</label>
  <input type="password" id="password" name="password" autocomplete="off"><br>

  <label for="remember">아이디 저장:</label>
  <input type="checkbox" id="idSaveCheck"><br>

  <input type="submit" value="로그인">
</form>

-->