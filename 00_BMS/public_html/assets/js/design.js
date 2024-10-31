
// 셀렉트 박스
// $(".select-box ul").on("click", ".init", function() {
//     $(this).closest(".select-box").find('ul li:not(.init)').toggle();
// });
// // 클릭 이벤트를 비활성화합니다.
// $(".select-box.disabled ul").off("click", ".init");

// $(".select-box ul").each(function() {
//     var allOptions = $(this).children('li:not(.init)');
//     $(this).on("click", "li:not(.init)", function() {
//         allOptions.removeClass('selected');
//         $(this).addClass('selected');
//         $(this).closest(".select-box").find('.init').html($(this).html());
//         allOptions.toggle();
//     });
// });

// 검색 X아이콘 관련
/*
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector(".search-item input");
    const clearButton = document.querySelector(".btnClear");

    // 초기화 함수: 인풋 내용을 비우고 버튼을 감춤
    function resetInput() {
        input.value = "";
        clearButton.style.display = "none";
    }

    // 입력 내용이 변경될 때마다 버튼을 표시하거나 감춥니다.
    input.addEventListener("input", function () {
        if (input.value === "") {
            clearButton.style.display = "none";
        } else {
            clearButton.style.display = "block";
        }
    });

    // 버튼 클릭 시 초기화 함수 호출
    clearButton.addEventListener("click", resetInput);

    // 페이지 로딩 시 초기화
    resetInput();
});


// finle upload
var fileinput = document.querySelector(".add-file-input"),
    button = document.querySelector(".add-file-btn"),
    returntxt = document.querySelector(".add-file-txt");

button.addEventListener("keydown", function(event){
    if(event.keyCode == 13 || event.keyCode == 32){
    fileinput.focus();
    }
});
button.addEventListener("click", function(event){
    fileinput.focus();
    return false;
});
fileinput.addEventListener("change", function(event){
    if (this.value) {
        returntxt.innerHTML = this.value;
      } else {
        returntxt.innerHTML = "&nbsp;";
      }
});

*/



