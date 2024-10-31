$(function(){

    $('.startDate').datepicker({
        dateFormat: "yy-mm-dd",
        monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        dayNames: ['일요일' , '월요일' , '화요일' , '수요일' , '목요일' , '금요일' , '토요일'],
        showMonthAfterYear: true,
        changeYear:true,
        changeMonth:true,
        yearSuffix: "년",
        nextText:"다음달",
        prevText:"이전달",
        autoclose : false,
        altField: "#startDate", // 선택된 값은 해당 필드에 삽입
        onSelect: function(dateText, inst) {
            // 필요한 엘레멘트를 추적
            let colGroup = this.closest('.calGroup')
            let labelTag = colGroup.querySelector('label');

            // 선택되면 데이터가 있음을 의미하므로 클래스를 추가
            labelTag.classList.add('onValue')
        }
    }).datepicker('setDate', null);

    $('.endDate').datepicker({
        dateFormat: "yy-mm-dd",
        monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        dayNames: ['일요일' , '월요일' , '화요일' , '수요일' , '목요일' , '금요일' , '토요일'],
        showMonthAfterYear: true,
        changeYear:true,
        changeMonth:true,
        yearSuffix: "년",
        nextText:"다음달",
        prevText:"이전달",
        autoclose : false,
        altField: "#endDate", // 선택된 값은 해당 필드에 삽입
        onSelect: function(dateText, inst) {
            // 필요한 엘레멘트를 추적
            let colGroup = this.closest('.calGroup')
            let labelTag = colGroup.querySelector('label');

            // 선택되면 데이터가 있음을 의미하므로 클래스를 추가
            labelTag.classList.add('onValue')
        }
    }).datepicker('setDate', null);

    


    /* 자동 타이틀 달아주기 */
    $('a, .btn, .eps').each(function(){
        let attr = $(this).text().trim();
        attr = attr.replace(/(\r\n|\n|\r)/gm,""); //줄바꿈 제거
        attr = attr.replace(/\s{2,}/g, ' '); //공백 2칸이상일경우 1칸으로

        if (!$(this).is('[title]')) {
            $(this).attr("title", attr);
        }

        if($('.eps').find('a').length > 0){ //eps 하위에 a 태그가 있을경우 eps에 title 제거
            $('.eps').removeAttr('title');
        }
    });


    /* input 맞춤법 검사 제거 */
    $('input[type="text"]').attr('spellcheck', false);

    /* input disabled 자동 타이틀 */
    $('input[disabled].disabled').each(function(){
        $(this).attr('title', $(this).val());
    });

    /* textarea disabled 자동 타이틀 */
    $('textarea[disabled].disabled').each(function(){
        $(this).attr('title', $(this).text());
    });


    /* ========== 체크박스 접근성, 엔터키 활성화 / 라디오 접근성 ========== */
    const checkBoxes = document.querySelectorAll('.checkBox input[type="checkbox"]');
    const radios = document.querySelectorAll('.radio input[type="radio"]');

    // 문서가 로드되면 체크여부를 찾아 속성을 배정
    window.addEventListener('load', function() {
        // 각 checkbox 요소를 초기 속성 설정
        checkBoxes.forEach(function(checkBox) {
            checkBox.setAttribute('aria-checked', checkBox.checked ? 'true' : 'false');
        });
        
        // 각 라디오 요소 초기 속성 설정
        radios.forEach(function(radio){
            radio.setAttribute('aria-checked', radio.checked ? 'true' : 'false')
        })
    });

    // checkbox
    checkBoxes.forEach(function(checkBox) {
        // 엔터키 활성화 및 속성배정
        checkBox.addEventListener('keyup', function(event) {
            let keyCode = event.keyCode;
            if (keyCode === 13) {
                checkBox.checked = !checkBox.checked;
                checkBox.setAttribute('aria-checked', checkBox.checked ? 'true' : 'false');
            }
        });

        // 클릭 이벤트 속성배정
        checkBox.addEventListener('click', function(event) {
            checkBox.setAttribute('aria-checked', checkBox.checked ? 'true' : 'false');
        });
    });

    // radio
    radios.forEach(function(radio){
        radio.addEventListener('change', function(event){
            let radioSiblings = document.querySelectorAll('input[type="radio"][name="' + radio.name + '"]')
            radioSiblings.forEach(function(sibling){
                sibling.setAttribute('aria-checked', sibling.checked ? 'true' : 'false')
            })
        })
    })

    // .btn태그에 .ripple 클래스 클릭&터치시 좌표값을 기준으로 애니메이션 효과
    document.querySelectorAll('.ripple').forEach(function(ripples){ 
        ripples.addEventListener('click', function(e){ 
            let event = e.touches ? e.touches[0] : e; 

            let getBounding = ripples.getBoundingClientRect(); 
            let duration = Math.sqrt(Math.pow(getBounding.width, 2) + Math.pow(getBounding.height, 2)) * 2; 
            
            ripples.style.cssText = `--s: 0; --0: 1;`; 
            ripples.offsetTop; 
            ripples.style.cssText = `--t: 1; --o: 0; --d: ${duration}; --x:${event.clientX - getBounding.left}; --y:${event.clientY - getBounding.top};`; 
        }) 
    }) 

    // .btn 하위 텍스트가 있을때 i태그에 margin-left를 주기위해 hasText 추가
    document.querySelectorAll('.btn').forEach(function(btn){
        if (btn.textContent.trim() !== '') {
            btn.classList.add('hasText')
        }
    })

    // accordion
    document.querySelectorAll('.accordion .accoLabel').forEach(function(accoLabel){
        accoLabel.addEventListener('click', function(event){
            if(event.target === this) {
                let labelArea = this.parentNode;
                let accordion = labelArea.parentNode;
                let accordions = accordion.parentNode.children;

                hasClass = accordion.classList.contains('active');

                for (var i = 0; i < accordions.length; i++) {
                    accordions[i].classList.remove('active')
                }
                if (hasClass) {
                } else {
                    accordion.classList.add('active')
                }

            }
        })

        // 자식 요소에 클릭 이벤트 추가
        accoLabel.querySelectorAll('*').forEach(function(child) {
            child.addEventListener('click', function(event) {
                if (event.target === this) {
                    // 상위 요소인 .accoLabel의 클릭 이벤트를 호출
                    accoLabel.click();
                }
            });
        });

        //selectValue 요소에 클릭 이벤트 추가
    })

    // .layerClose 클릭시 팝업닫기
    document.querySelectorAll('.layerClose').forEach(function(closeBtns){
        closeBtns.addEventListener('click', function(){
            let layerPopup = this.closest('.layerPopup');
            if(layerPopup && layerPopup.classList.contains('active')) {
                layerPopup.classList.remove('active')
            }
        })
    })

    // .layer 외부(.dimm 영역) 클릭시 팝업닫기
    document.addEventListener('click', function(event){
        let layerPopup = event.target.closest('.layerPopup.active');
        if (layerPopup && event.target.closest('.layer') === null) {
            layerPopup.classList.remove('active');
        }
    })

    // selectArea dropDown
    document.querySelectorAll('.selectLabel input').forEach(function(dropDowns){
        dropDowns.addEventListener('click', function(event){
            let inputTag = event.target; // 클릭된 객체
            let selectLabel = inputTag.closest('.selectLabel') // 객체의 부모중 가장 가까운 .selectLabel
            let selectArea = inputTag.closest('.selectArea'); // 객체의 부모중 가장 가까운 .selectArea
            let inputType = event.target.getAttribute('type'); // input의 타입 비교를 위해 변수에 담는다
            let inputValue = event.target.value; // value 비교를 위해 변수에 담는다


            for (var i = 0; i < selectArea.length; i++) {
                selectArea[i].classList.remove('open')
            }

            // 클릭한 자신이면서 .selectArea에 open클래스가 없어 select가 drop이 아닐때
            if (selectArea && !selectArea.classList.contains('open')) {
                selectArea.classList.add('open') // open클래스를 추가해서 select를 drop한다
            } 

            // input[type="search"]를 클릭했을때 비어지 않으면 X버튼 호출 되도록
            if (inputType === 'search' && inputValue.trim() !== '') {
                selectLabel.classList.add('active'); // .selectLabel에 active 클래스를 추가한다.
            }

        })

        dropDowns.addEventListener('keyup', function(event) {
            if (event.keyCode === 32 || event.keyCode === 13) { // 스페이스바(32)와 엔터키(13)
                let inputTag = event.target; // 클릭된 객체
                let selectLabel = inputTag.closest('.selectLabel'); // 객체의 부모중 가장 가까운 .selectLabel
                let selectArea = inputTag.closest('.selectArea'); // 객체의 부모중 가장 가까운 .selectArea
                let inputType = event.target.getAttribute('type'); // input의 타입 비교를 위해 변수에 담는다
                let inputValue = event.target.value; // value 비교를 위해 변수에 담는다

                for (var i = 0; i < selectArea.length; i++) {
                    selectArea[i].classList.remove('open');
                }
                
                // 클릭한 자신이면서 .selectArea에 open클래스가 없어 select가 drop이 아닐때
                if(selectArea && !selectArea.classList.contains('open')) {
                    selectArea.classList.add('open');// open클래스를 추가해서 select를 drop한다
                } 

                // input[type="search"]를 클릭했을때 비어지 않으면 X버튼 호출 되도록
                if (inputType === 'search' && inputValue.trim() !== '') {
                    selectLabel.classList.add('active'); // .selectLabel에 active 클래스를 추가한다.
                }
            } 
        });

        //스페이스바 문서 하단으로 기본동작 제거 
        dropDowns.addEventListener('keydown', function(event) {
            if (event.keyCode === 32 || event.keyCode === 13) { // 스페이스바(32)와 엔터키(13)
                event.preventDefault(); // 기본 동작 막기
            }
        });
    })


    // customSelect 리스트 클릭시 이벤트 등록
    document.querySelectorAll('.selectList .btn').forEach(function(selectBtns){
        selectBtns.addEventListener('click', function(event){
            if (event.target === this) {
                let selectBtn = event.target;
                let selectBtnValue = selectBtn.value; 
                let selectBtnText = selectBtn.innerText;
                let selectBtnLi = selectBtn.closest('li');
                let selectArea = selectBtn.closest('.selectArea');
                let selectLabel = selectArea.querySelector('.selectLabel');
                let inputTag = selectLabel.querySelector('input:not(input[type="hidden"])');
                let inputHidden = selectLabel.querySelector('input[type="hidden"]');
                let selectBtnUl = selectBtnLi.closest('ul');
                let siblingsLi = selectBtnUl.querySelectorAll('li') 
                let hasClass = selectBtnLi.classList.contains('active'); 
                
                inputTag.value = selectBtnText; // 클릭된 버튼의 text를 hidden이 아닌 input에 삽입
                inputHidden.value = selectBtnValue; // 클릭된 버튼의 value를 input hidden에 삽입
                
                siblingsLi.forEach(function(siblingLi) {
                    siblingLi.classList.remove('active');
                    inputTag.value = null;
                    inputHidden.value = null;
                });
    
                if(hasClass) { 
                    
                } else {
                    selectBtnLi.classList.add('active'); 
                    inputTag.value = selectBtnText;
                    inputHidden.value = selectBtnValue;
                }

                if(inputTag.value.trim()) {
                    // selectLabel.classList.add('active')
                    selectArea.classList.add('listSelect')
                } else {
                    // selectLabel.classList.remove('active')
                    selectArea.classList.remove('listSelect')
                }
            }
        })
    })

    document.querySelectorAll('.selectLabel input[type="search"]').forEach(function(inputSearchs){
        inputSearchs.addEventListener('input', function(event){
            let value = this.value;
            let selectLabel = event.target.closest('.selectLabel'); 
            let selectArea = event.target.closest('.selectArea');
            let selectList = selectArea.querySelector('.selectList')
            let selectLi = selectList.querySelectorAll('li')
            let firstFilter = value.toUpperCase();

            let inputTag = selectLabel.querySelector('input:not(input[type="hidden"])');
            let inputHidden = selectLabel.querySelector('input[type="hidden"]');
            // input hidden 타입이 아닌 input에는  text를 삽입하고


            if (value.trim() === '') {
                selectArea.classList.remove('active')
                selectLi.forEach(function(li){
                    li.classList.remove('listSelect');
                    inputTag.value = null;
                    inputHidden.value = null;
                })
            } else {
                selectArea.classList.add('listSelect')
            }

            for (i = 0; i < selectLi.length; i++) {
                let button = selectLi[i].querySelector('.btn'); // li 요소의 자식 중 .btn 클래스인 요소를 찾음
                let txtValue = button.textContent || button.innerText; // .btn 요소의 텍스트를 가져옴
                if (txtValue.toUpperCase().indexOf(firstFilter) > -1) {
                    selectLi[i].style.display = ""; // 일치하는 경우 보이도록 함
                } else {
                    selectLi[i].style.display = "none"; // 일치하지 않는 경우 숨김
                }
            }
        })
    })

    document.querySelectorAll('.selectLabel .valueDelete').forEach(function(valueDeletes){
        valueDeletes.addEventListener('click', function(event){
            let deleteClick = event.target;
            let selectLabel = deleteClick.closest('.selectLabel');
            let inputTag = selectLabel.querySelector('input:not(input[type="hidden"])');
            let inputHidden = selectLabel.querySelector('input[type="hidden"]');
            let selectArea = selectLabel.closest('.selectArea');
            let selectList = selectArea.querySelector('.selectList')
            let selectLi = selectList.querySelectorAll('li')

            inputTag.value = null;
            inputHidden.value = null;
            selectArea.classList.remove('listSelect')
            
            selectLi.forEach(function(li){
                li.style.display = "";
                li.classList.remove('active');
            })
            
        })
    })
    

    // .selectArea 요소들을 모두 선택
    const selectAreas = document.querySelectorAll('.selectArea');

    // 각 .selectArea 요소에 대해 처리
    selectAreas.forEach(function(selectArea) {
        // .selectArea 이외의 영역을 클릭했을 때의 이벤트 리스너 추가
        document.addEventListener('click', function(event) {
            // 클릭된 요소가 현재 .selectArea 내부인지 확인
            const isClickedInside = selectArea.contains(event.target);
            
            let selectLabel = selectArea.querySelector('.selectLabel')

            // 클릭된 요소가 .selectArea 내부가 아니라면
            if (!isClickedInside) {
                // .selectArea 내부의 active 클래스 제거
                selectArea.classList.remove('open');
                selectLabel.classList.remove('active')
            }
        });
    });

    


});