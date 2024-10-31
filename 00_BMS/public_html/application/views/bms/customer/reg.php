        
        <div class="conts-box">
            <div class="titleArea">

                <h1>고객(사) 등록</h1>
                <span class="essential">* 는 필수 항목 입니다.</span>
            </div>
            <form action="" method="post" name="customer_reg_form" id="customer_reg_form" class="customer_reg_form" autocomplete="off">
            
            <div class="indvd-bsns">
                <div class="selector">
                    <input type="radio" id="corporate" value="corporate" name="division" checked>
                    <label for="corporate">법인 사업자</label>
                </div>
                
                <div class="selector">
                    <input type="radio" id="individual" value="individual" name="division" >
                    <label for="individual">개인 사업자</label>
                </div>
                
                <!-- div class="selector disabled" -->
                <div class="selector">
                    <!-- input type="radio" id="personal" value="personal" name="division" disabled -->
                    <input type="radio" id="personal" value="personal" name="division" >
                    <label for="personal">개인</label>
                </div>
            </div>

            <article id="writeTable" class="erpList reg">
                
            </article>


            </form>
            <div class="btn-box-conts">
                <a class="button point rgstr">추가</a>
            </div>
        </div>


        
<script>

    
// 처음로딩시에는 법인사업자를 기본으로 보여준다.
$(document).ready(function(){
    $("#writeTable").load("/customer/reg_com");
});

// 사업자 구분을 클릭 할때에 따라 입력 폼을 다르게 보여준다. 
// 법인사업자와 개인사업자인 경우에는 reg_com.php , 
// 개인인 경우에는 reg_per.php 를 
// id값이 writeTable 인 div 에 보여준다.
$( "input[name=division]" ).click(function() {
    var division = $("input[name=division]:checked").val();
    if(division == 'corporate' || division == 'individual'){
        $("#writeTable").load("/customer/reg_com");
    } else if(division == 'personal'){
        $("#writeTable").load("/customer/reg_per");
    }
});

// 추가 버튼 클릭시 유효성 검사 후 등록 처리 , 등록 처리 후 리스트 페이지로 이동 , 등록 실패시 에러 메세지 출력 , 등록 성공시 메세지 출력 
// customer_name 은 컨트롤 단으로 넘길때 name 으로 넘긴다.
// 유효성 검사 
// 법인사업자와 또는 개인사업자인 경우에는 필수값이 모두 입력되어야 한다. 
// 개인 인경우에는 필수 값이 모두 입력되어야 한다. 사업자 종류(법인사업자, 개인사업자, 개인)에 따라 입력받는 값이 다르다.
// 필수값이 모두 입력되지 않았을 경우 에러 메세지를 출력한다.
// 필수값이 모두 입력되었을 경우 등록 처리를 한다.
// 등록 처리 후 리스트 페이지로 이동한다.
// 등록 실패시 에러 메세지를 출력한다.
// 등록 성공시 메세지를 출력한다.
$( ".rgstr" ).click(function() {
    var division = $("input[name=division]:checked").val();
    
    // 필수값이 모두 입력되지 않았을 경우 에러 메세지를 출력한다.
    if(division == 'corporate' || division == 'individual'){        
        if($("#customer_name").val() == ''){
            alert("법인명을 입력해주세요.");
            $("#customer_name").focus();
            return false;
        } else if($("#industry").val() == ''){
            alert("업종을 입력해주세요.");
            $("#industry").focus();
            return false;
        } else if($("#ceo_name").val() == ''){
            alert("대표자명을 입력해주세요.");
            $("#ceo_name").focus();
            return false;
        } else if($("#business_number").val() == ''){
            alert("사업자번호를 입력해주세요.");
            $("#business_number").focus();
            return false;
        } else if($("#manager_name").val() == ''){
            alert("고객사 담당자명을 입력해주세요.");
            $("#manager_name").focus();
            return false;
        } else if($("#manager_position").val() == ''){
            alert("고객사 담당자 직책을 입력해주세요.");
            $("#manager_position").focus();
            return false;
        } else if($("#manager_dept").val() == ''){
            alert("고객사 담당자 부서를 입력해주세요.");
            $("#manager_dept").focus();
            return false;
        } else if($("#manager_tel").val() == ''){
            alert("고객사 담당자 연락처를 입력해주세요.");
            $("#manager_tel").focus();
            return false;
        } else if($("#manager_mobile").val() == ''){
            alert("고객사 담당자 휴대전화번호를 입력해주세요.");
            $("#manager_mobile").focus();
            return false;
        } else if($("#tel").val() == ''){
            alert("대표번호를 입력해주세요.");
            $("#tel").focus();
            return false;
        } else if($("#email").val() == ''){
            alert("이메일을 입력해주세요.");
            $("#email").focus();
            return false;
        } else if($('input:radio[name="management_channel"]').is(':checked') == false){
            alert("관리 채널을 선택해주세요.");
            $('#offline').focus();
            return false;
        } else if($("#road_address").val() == ''){
            alert("주소를 입력해주세요.");
            $("#searchaddr").click();
            return false;
        } else if($("#detail_address").val() == ''){
            alert("상세주소를 입력해주세요.");
            $("#detail_address").focus();
            return false;
        } else if($("#postcode").val() == ''){
            alert("우편번호를 입력해주세요.");
            $("#postcode").focus();
            return false;
        }

    } else if(division == 'personal'){
        if($("#customer_name").val() == ''){
            alert("성명을 입력해주세요.");
            $("#customer_name").focus();
            return false;
        } else if($("#resident_number").val() == '') {
            alert("주민번호를 입력해주세요.");
            $("#resident_number").focus();
            return false;
        } else if($("#tel").val() == ''){
            alert("연락처를 입력해주세요.");
            $("#tel").focus();
            return false;
        } else if($("#manager_mobile").val() == ''){
            alert("휴대전화번호를 입력해주세요.");
            $("#manager_mobile").focus();
            return false;
        } else if($("#email").val() == ''){
            alert("이메일을 입력해주세요.");
            $("#email").focus();
            return false;
        } else if($('input:radio[name="management_channel"]').is(':checked') == false){
            alert("관리 채널을 선택해주세요.");
            return false;
        } else if($("#road_address").val() == ''){
            alert("주소를 입력해주세요.");
            $("#road_address").focus();
            return false;
        } else if($("#detail_address").val() == ''){
            alert("상세주소를 입력해주세요.");
            $("#detail_address").focus();
            return false;
        } else if($("#postcode").val() == ''){
            alert("우편번호를 입력해주세요.");
            $("#postcode").focus();
            return false;
        }
    }

    // 필수값이 모두 입력되었을 경우 등록 처리를 한다.
    // 등록 처리 후 리스트 페이지로 이동한다.
    // 등록 실패시 에러 메세지를 출력한다.
    // 등록 성공시 메세지를 출력한다.

    var data = $("#customer_reg_form").serialize();
    
    $.ajax({
        type: "POST",
        url: "/customer/regProc",
        data: data,
        dataType: "json",
        success: function(data){
            if(data.result == 'success'){
                alert(data.msg);
                location.href = "/customer/list";
            } else {
                alert(data.msg);
            }
        },
        error: function(xhr, status, error) {
            alert("에러발생");
            console.log(data);
        }
    });

});





</script>