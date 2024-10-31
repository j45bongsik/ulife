$(function(){
	//로그인 버튼 클릭시 로그인 페이지로 이동
	$('.login').click(function(){
		location.href = '/login';
	});

	//로그 아웃 버튼 클릭시 로그아웃 처리
	$('.logout').click(function(){
		// 로그아웃 처리 /logout 페이지로 이동
		location.href = '/logout';
	});
});


// 쿠키 저장 함수 setCookie
function setCookie(cookieName, value, exdays){
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
	document.cookie = cookieName + "=" + cookieValue;
}


// 쿠키 가져오기 함수 getCookie
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


// 쿠키삭제 함수 deleteCookie
function deleteCookie(cookieName){
	var expireDate = new Date();
	expireDate.setDate(expireDate.getDate() - 1);
	document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}


// 다움 주소검색 함수 daumPostcode
function daumPostcode(){
	new daum.Postcode({
		oncomplete: function(data){
			var fullAddr = '';
			var extraAddr = '';
			if(data.userSelectedType === 'R'){
				fullAddr = data.roadAddress;
			}else{
				fullAddr = data.jibunAddress;
			}
			if(data.userSelectedType === 'R'){
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
			}
			document.getElementById('postcode').value = data.zonecode;
			document.getElementById('address').value = fullAddr;
			document.getElementById('address2').focus();
		}
	}).open();
}


// 고객사 등록시 법인사업자와 개인사업자 인 경우 사업자 번호 중복 체크
function checkBizNo(bizNo){
	$.ajax({
		url: '/checkBizNo',
		type: 'post',
		dataType: 'json',
		data: {bizNo: bizNo},
		success: function(data){
			console.log(data);
			if(data.result == 'ok'){
				// 호출한 페이지에서 
			}else{
				alert('이미 사용중인 사업자 번호 입니다.');
			}
		}
	});
}


// 고객사 등록시 개인인 경우 주민번호 중복 체크 inputId 값의 주민번호를 가져와서 중복체크한 후 outputId에 결과를 출력 
// 가입된 주민 번호인 경우 이미 가입되어 있다는 메세지를 resident_number_check 에 출력한다. 
// 가입되지 않은 주민 번호인 경우 return id로 받은 input 값을 1로 변경한다.
// inputId 에 값이 없으면 주민번호를 입력해 주세요 메세지를 출력한다.
// inputId 에 입력된 값이 주민번호 형식이 아니면 주민번호 형식에 맞게 입력해 주세요 메세지를 출력한다.
// inputId 에 입력된 값이 주민번호 형식이 맞으면 주민번호 중복체크를 한다.
// inputId 에 입력된 주민번호가 이미 가입된 주민번호인 경우 이미 가입되어 있다는 메세지를 출력한다.
// inputId 에 입력된 주민번호 '-' 이 없으면 자동으로 '-' 를 추가한다.
// 사용법 : checkJuminNo('inputId', 'outputId', 'returnId'); 
// inputId = 주민번호를 입력하는 input id / , outputId = 텍스트 결과를 출력할 span id, returnId = 결과를 리턴할 input type hidden id 이며 기본 0으로 되어 있다가 returnId 를 1로 변경한다.
function checkJuminNo(inputId, outputId, returnId){  
	var juminNo = $('#' + inputId).val();
	if(juminNo == ''){
		$('#' + outputId).html('주민번호를 입력해 주세요.');
		$('#' + inputId).focus();
		return false;
	} else {
		// 자동으로 '-' 추가
		console.log(juminNo);
		juminNo = autoHypenJuminNo(juminNo);

		// 주민번호 형식 체크
		var regexp = /^[0-9]{6}\-[0-9]{7}$/;
		if(!regexp.test(juminNo)){
			$('#' + outputId).html('주민번호 형식에 맞게 입력해 주세요.');
			$('#' + inputId).focus();
			return false;
		} else {
			$.ajax({
				url: '/checkJuminNo',
				type: 'post',
				dataType: 'json',
				data: {juminNo: juminNo},
				success: function(data){
					if(data.result == 'ok'){
						$('#' + outputId).html('이미 가입된 주민번호 입니다.');
						$('#' + inputId).focus();
						$('#' + returnId).val(0);
					}else{
						$('#' + outputId).html('가입 가능한 주민번호 입니다.');
						$('#' + returnId).val(1);
					}
				}
			});
		}
	}
}


// 주민번호 자동 '-' 추가 함수
function autoHypenJuminNo(str){
	str = str.replace(/[^0-9]/g, '');
	var tmp = '';
	if(str.length < 8){
		return str;
	}else if(str.length < 14){
		tmp += str.substr(0, 6);
		tmp += '-';
		tmp += str.substr(6);
		return tmp;
	}else{
		tmp += str.substr(0, 6);
		tmp += '-';
		tmp += str.substr(6, 7);
		tmp += '-';
		tmp += str.substr(13);
		return tmp;
	}
	return str;
}


// 사업자 번호 자동 '-' 추가 함수
function autoHypenBizNo(str){
	//alert("str : "+str);
	str = str.replace(/[^0-9]/g, '');
	var tmp = '';
	if(str.length < 4){
		return str;
	}else if(str.length < 6){
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3);
		return tmp;
	}else if(str.length < 10){
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3, 2);
		tmp += '-';
		tmp += str.substr(5);
		return tmp;
	}else{
		tmp += str.substr(0, 3);
		tmp += '-';
		tmp += str.substr(3, 2);
		tmp += '-';
		tmp += str.substr(5, 5);
		return tmp;
	}
	//return str;
}

// 연락처와 휴대전화번호를 입력 받으면 자동으로 '-' 를 추가하는 함수
// input 에서 onkeyup="autoHypenPhone(this);" 를 추가한다.
// 02-123-4567 , 02-1234-5678 이런 케이스도 함께 처리 한다.
function autoHypenPhone(str){
	//console.log(str);
	
	// 숫자만 입력
	str = str.replace(/[^0-9]/g, '');
	
	var tmp = '';

	// 02 로 시작하는 번호 체크
	if(str.substr(0, 2) == '02'){
		if(str.length < 3){
			return str;
		}else if(str.length < 6){
			tmp += str.substr(0, 2);
			tmp += '-';
			tmp += str.substr(2);
			return tmp;
		}else if(str.length < 10){
			tmp += str.substr(0, 2);
			tmp += '-';
			tmp += str.substr(2, 3);
			tmp += '-';
			tmp += str.substr(5);
			return tmp;
		}else{
			tmp += str.substr(0, 2);
			tmp += '-';
			tmp += str.substr(2, 4);
			tmp += '-';
			tmp += str.substr(6);
			return tmp;
		}
	} else if(str.substr(0, 2) == '15' && str.length < 9 ){ // 1588-1234 처럼 15로 시작하는 번호 체크
		if(str.length < 5){
			return str;
		}else if(str.length < 8){
			tmp += str.substr(0, 4);
			tmp += '-';
			tmp += str.substr(4);
			return tmp;
		}else if(str.length < 12){
			tmp += str.substr(0, 4);
			tmp += '-';
			tmp += str.substr(4, 4);
			return tmp;
		}
	} else {
		if(str.length < 4){
			return str;
		}else if(str.length < 7){
			tmp += str.substr(0, 3);
			tmp += '-';
			tmp += str.substr(3);
			return tmp;
		}else if(str.length < 11){
			tmp += str.substr(0, 3);
			tmp += '-';
			tmp += str.substr(3, 3);
			tmp += '-';
			tmp += str.substr(6);
			return tmp;
		}else{
			tmp += str.substr(0, 3);
			tmp += '-';
			tmp += str.substr(3, 4);
			tmp += '-';
			tmp += str.substr(7);
			return tmp;
		}
	}
}

// 이메일 중복 체크 함수
// 사용법 : input 에서 onblur="checkEmail(this.value);" 를 추가한다.
function checkEmail(email){

	// 이메일 형식 체크 후 이메일 형식이 아니면 이메일 형식에 맞게 입력해 주세요. 메세지를 출력한다. 맞으면 아래 코드를 실행한다. 이메일 형식 체크 함수를 활용한다 checkEmailType(email);
	if(!checkEmailType(email)){
		return false;
	}

	$.ajax({
		url: '/checkEmail',
		type: 'post',
		dataType: 'json',
		data: {email: email},
		success: function(data){
			if(data.result == 'ok'){
				alert('사용 가능한 이메일 입니다.');
			}else{
				alert('이미 사용중인 이메일 입니다.');
			}
		}
	});
}

// 이메일 형식 체크 함수
// 사용법 : input 에서 onblur="checkEmail(this.value);" 를 추가한다. 또는 checkEmail(email); 로 호출한다.
// 이메일 형식이 아니면 이메일 형식 aaa@aaa.aaa,     aaaa@aaa.aa.aa 에 맞게 입력해 주세요. 메세지를 출력한다.
function checkEmailType(email, outputId){
	var regexp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	if(!regexp.test(email)){
		if(outputId == '1'){
			alert('이메일 형식에 맞게 입력해 주세요.');
		} else {
			$('#' + outputId).html('이메일 형식에 맞게 입력해 주세요.');
		}
		return false;
	} else {
		$('#' + outputId).html('');
		
	}

}

// hypen 클래스가 있으면 하이픈(-) 표시 (날짜)
document.addEventListener('DOMContentLoaded', function(event){
    let hypens = document.querySelectorAll('.hypen');
    hypens.forEach(function(hypen){
        // 사용자 입력값은 모두 숫자만 받는다.(나머지는 ""처리)
        let val = hypen.innerText.replace(/\D/g, "");
        let leng = val.length;
        // 출력할 결과 변수
        let result = '';
        // 4개일때 - 20221 : 바로 출력
        if (leng < 5) {
            result = val;
        }
        // 5개일때 - 20221 : 2022-1
        else if(leng < 6) {
            result += val.substring(0,4);
            result += "-";
            result += val.substring(4);
        }
        // 6개일때 - 202210 : 2022-10
        else if (leng < 7) {
            result += val.substring(0,4);
            result += "-";
            result += val.substring(4);
        }
        // 7개부터 - 2022103 : 2022-10-3
        else {
            result += val.substring(0,4);
            result += "-";
            result += val.substring(4,6);
            result += "-";
            result += val.substring(6);
        }
        hypen.innerText = result;
    })
})


// hypenTel 클래스가 있으면 자릿수에 맞게 하이픈(-) 표시 (연락처)
document.addEventListener('DOMContentLoaded', function(event){
    let hypenTels = document.querySelectorAll('.hypenTel');
    hypenTels.forEach(function(hypen){
        let val = hypen.innerText.replace(/\D/g, "");
        let leng = val.length;
        let result = '';

        // 02 로 시작하는 번호 체크
        if(val.substr(0, 2) == '02'){
            if(leng < 3){
                result = val;
            } else if(leng < 6){
                result += val.substr(0, 2);
                result += '-';
                result += val.substr(2);
            } else if(leng < 10){
                result += val.substr(0, 2);
                result += '-';
                result += val.substr(2, 3);
                result += '-';
                result += val.substr(5);
            } else {
                result += val.substr(0, 2);
                result += '-';
                result += val.substr(2, 4);
                result += '-';
                result += val.substr(6);
            }
        } else if(val.substr(0, 2) == '15' && leng < 9 ){ // 1588-1234 처럼 15로 시작하는 번호 체크
            if(leng < 5){
                result = val;
            } else if(leng < 8){
                result += val.substr(0, 4);
                result += '-';
                result += val.substr(4);
            } else if(leng < 12){
                result += val.substr(0, 4);
                result += '-';
                result += val.substr(4, 4);
            }
        } else {
            if(leng < 4){
                result = val;
            } else if(leng < 7){
                result += val.substr(0, 3);
                result += '-';
                result += val.substr(3);
            } else if(leng < 11){
                result += val.substr(0, 3);
                result += '-';
                result += val.substr(3, 3);
                result += '-';
                result += val.substr(6);
            } else {
                result += val.substr(0, 3);
                result += '-';
                result += val.substr(3, 4);
                result += '-';
                result += val.substr(7);
            }
        }
        hypen.innerText = result; // hypen.innerText를 각 조건문에서 설정한 결과로 변경
    })
})

// 문서에서 comma 클래스를 찾아 텍스트와 숫자를 포맷팅해서 3자리수마다 ,(comma) 삽입
document.addEventListener('DOMContentLoaded', function(){        
	let totalAmounts = document.querySelectorAll('.comma')
	
	for(var i = 0; i < totalAmounts.length; i++) {
		let textFormat = totalAmounts[i].textContent;
		let numberGet = parseFloat(textFormat.replace(/[^\d.]/g, ''));
		
		let formattedText = addCommasToNumberString(numberGet);
		
		// 결과를 요소의 텍스트로 설정합니다.
		totalAmounts[i].textContent = formattedText;
	}
}); 

// 세 자리마다 쉼표를 추가하는 함수
function addCommasToNumberString(num) {
	return num.toLocaleString();
}


// datatable 한글 설정
var language = {
	processing: "처리중...",
	lengthMenu: "_MENU_ 개씩 보기",
	zeroRecords: "결과가 없습니다.",
	info: "_PAGE_ / _PAGES_",
	infoEmpty: "결과가 없습니다.",
	infoFiltered: "(전체 _MAX_ 개 중 검색결과)",
	infoPostFix: "",
	search: "검색 : ",
	url: "",
	emptyTable: "데이터가 없습니다.",
	paginate: {
		first: "첫 페이지",
		previous: "이전",
		next: "다음",
		last: "마지막 페이지"
	}
};


$(function() {
    $('.details-table li > input[type="text"], .details-table li > input[type="email"], .searchArea input[type="text"], .table input[type="text"]:not(.picker)').on('mousedown input', function() {
		$('.delete').remove();
		
        if ($(this).val() == '') {
            $(this).siblings('.delete').remove();
        } else {
            if ($(this).siblings('.delete').length === 0) {
                $(this).after("<button type='button' class='btn delete' title='삭제'></button>");
				let parentTag = $(this).parent(); // 부모 태그 선택
				parentTag.css({'position':'relative'})
			}
        }
    });
	
    // 수정된 부분: 동적으로 생성된 요소에 대한 이벤트 처리를 위해 document에서 이벤트를 위임합니다.
    $(document).on('click', '.btn.delete', function() {
        $(this).siblings('input[type="text"], input[type="email"]').val('').focus();
        $(this).remove();
    });
});

// lnb on&off
document.addEventListener('click', (event) => {
	let target = event.target;
	let menuBox = target.closest('.menu-box')
	let servContents = target.closest('.servContents')

	if (target.tagName.toLowerCase() === 'button' && target.classList.contains('menuBtn')) {
		toggleAction(menuBox, target)
		
	} else if (target.tagName.toLowerCase() === 'span' && target.closest('.menuBtn')) {
		toggleAction(menuBox, target.closest('.menuBtn'))
	
	}

	function toggleAction(menuBox, target) {
		if (menuBox.classList.contains('menuClose')) {
			menuBox.classList.remove('menuClose');
			target.setAttribute('title', '메뉴 닫기')
			servContents.classList.remove('active')
		} else {
			menuBox.classList.add('menuClose')
			target.setAttribute('title', '메뉴 열기')
			servContents.classList.add('active')

		}
	}
})


$(function(){
	// firstSlect 선택하면 그 value값을 secondSelect의 data attribute값과 비교해서 앞 3자리가 같은 option만 출력
	document.querySelectorAll('.firstSelect').forEach(function(optionInsert) {
		optionInsert.addEventListener('change', function(event) {
			// 엘리먼트 추적
			let firstSelectTag = event.target;
			let inputArea = firstSelectTag.closest('.inputArea');
			let secondSelectTag = inputArea.querySelector('.secondSelect select');
			let firstSelecttValue = firstSelectTag.options[firstSelectTag.selectedIndex].value;
	
			// secondSelect option  가져오기
			let secondSelectTagOptions = secondSelectTag.querySelectorAll('option');
			
			secondSelectTagOptions.forEach(function(secondSlectOption){
				let secondSelectDataAttribute = secondSlectOption.getAttribute('data');
				let selectLength = firstSelecttValue.length;
				
				if (firstSelecttValue == '') {
					secondSlectOption.style.display = 'block';
				} else if (secondSelectDataAttribute && firstSelecttValue.substring(0, selectLength) === secondSelectDataAttribute.substring(0, selectLength)) {
					secondSlectOption.style.display = 'block';
				} else {
					secondSlectOption.style.display = 'none';
				}
			});
		});
	});

})


$(function(){ 
    let timer; 
	
    $('#visible').on('click', function() {

        if($(this).is(':checked')) { 
            $(this).closest('label').siblings('input').attr("type","text"); 
            clearTimeout(timer); // 기존 타이머 제거
            timer = setTimeout(() => {
                $('#visible').prop('checked', false);
                $('#visible').closest('label').siblings('input').attr("type","password"); 
            }, 2000);
        } else { 
            $(this).closest('label').siblings('input').attr("type","password"); 
            clearTimeout(timer); // 체크 해제되면 타이머 제거
        } 
    
	})
})

$(document).ready(function(){
	$('#datepicker').datepicker({
		format: 'yyyy/mm/dd',
		daysOfWeekHighlighted: '0', // 일요일
		autoclose: true,
		todayHighlight: true
	});
});


