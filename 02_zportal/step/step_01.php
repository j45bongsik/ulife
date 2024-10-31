<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#startDate').datepicker({
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
            autoclose: false,
            minDate: '0',
            onSelect: function(dateText, inst) {

            }
        }).datepicker('setDate', null);

        $('#endDate').datepicker({
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
            autoclose: false,
            minDate: '0',
            onSelect: function(dateText, inst) {

            }
        }).datepicker('setDate', null);
    })

</script>

<?php

    // echo $_SERVER['DOCUMENT_ROOT'];
    // exit;

    include $_SERVER['DOCUMENT_ROOT']."/include/head.php";
?>

<body class="page step">
    <div id="root">
        <!-- main -->
        <main id="container">

            <!-- header -->
            <?php
                include $_SERVER['DOCUMENT_ROOT']."/include/header_step.php";
            ?>
            <!-- //header -->

            <!-- contents -->
            <div id="contents">
                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/include/left_menu.php";
                ?>
                <!-- content -->
                <div class="content">

                    <!-- form -->
                    <form action="/step/step_01.php" method="post" autocomplete="off">
                        <!-- section -->
                        <section class="section step">

                            <article class="titleArea">
                                <h3 class="title stepTitle">여행 정보를 입력해 주세요.</h3>
                            </article>

                            <!-- bodyArea -->
                            <div class="bodyArea">
                                <!-- formArea -->
                                <article class="formArea" id="formArea">
                                    
                                    <!-- formGroup -->
                                    <div class="formGroup">
                                        <!-- //inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="travelCountry" class="title inputTitle">여행국가</label>
                                            </div>
                                            <!-- //titleArea -->

                                            <!-- selectArea -->
                                            <article class="selectArea">
                                                <!-- customSelect -->
                                                <div class="customSelect">
                                                    <label for="travelCountry" class="selectLabel">
                                                        <input type="hidden" name="travelCountryValue" id="travelCountryValue" value>
                                                        <input type="text" name="travelCountryText" id="travelCountryText" class="selectSearch deleteFnc" placeholder="여행국가명을 입력하세요." required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </label>
                                                    <div class="selectList">
                                                        <div class="inner">
                                                            <ul class="cScroll">
                                                                <li>
                                                                    <button type="button" class="btn" value="value01">태국</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="travel">
                                                                    태국 (파타니, 얄라, 나라티왓, 송클라주(Pattani, Yala, Narathiwat Provinces, Songkhla Provinces) 방문 체류시 청약불가)
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="싸와디깝~">태국2</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="천조국">미국</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="단풍국">캐나다</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="니혼진">이루본</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="여행지">여행지</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="여행지">여행지</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="여행지">여행지</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn" value="여행지">여행지</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //customSelect -->

                                            </article>
                                            <!-- //selectArea -->
                                        </div>
                                        <!-- //inputBox -->

                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="departurePurpose" class="title inputTitle">
                                                    출국목적
                                                </label>
                                            </div>
                                            <!-- //titleArea -->

                                            <article class="selectArea">
                                                <select name="departurePurpose" id="departurePurpose" required>
                                                    <option value="">출국목적을 선택하세요.</option>
                                                    <option value="shortTerm">단기여행</option>
                                                    <option value="longTerm">장기여행</option>
                                                </select>
                                            </article>
                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup">
                                        
                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="startDate" class="title inputTitle">
                                                    출발일시(출국일)
                                                </label>
                                            </div>
                                            <!-- //titleArea -->
                                            
                                            <!-- inputGroup -->
                                            <div class="inputGroup">
                                                <div class="inputArea seven">
                                                    <input type="text" class="cal starDate" name="startDate" id="startDate" placeholder="출발일선택" required>
                                                </div>
                                                
                                                <article class="selectArea three">
                                                    <select name="startDateHH" id="startDateHH" required>
                                                        <option value="">출발시각</option>
                                                        <option value="">00 시</option>
                                                        <option value="">01 시</option>
                                                    </select>
                                                </article>
                                            </div>
                                            <!-- //inputGroup -->
                                            
                                        </div>
                                        <!-- //inputBox -->

                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="endDate" class="title inputTitle">
                                                    도착일시(입국일)
                                                </label>
                                            </div>
                                            <!-- //titleArea -->

                                            <!-- inputGroup -->
                                            <div class="inputGroup">
                                                <div class="inputArea seven">
                                                    <input type="text" class="cal endDate" name="endDate" id="endDate" placeholder="출발일선택" required>
                                                </div>
                                                
                                                <article class="selectArea three">
                                                    <select name="endDateHH" id="endDateHH" required>
                                                        <option value="">도착시각</option>
                                                        <option value="">00 시</option>
                                                        <option value="">01 시</option>
                                                    </select>
                                                </article>
                                            </div>
                                            <!-- //inputGroup -->
                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup">
                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="birthMe" class="title inputTitle">
                                                    본인
                                                </label>
                                            </div>
                                            <!-- //titleArea -->

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="birthMe" class="title inputTitleSub">생년월일</label>
                                                    <div class="inputArea">
                                                        <input type="text" name="birth[]" id="birthMe" placeholder="숫자만 입력하세요." class="hypen deleteFnc" maxlength="10" required >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="male" class="title inputTitleSub">성별</label>
                                                    
                                                    <div class="inputArea">
                                                        <div class="radioGroup">
                                                            <p class="radio">
                                                                <input type="radio" name="genderMe" id="male" value="male" required>
                                                                <label for="male">남자</label>
                                                            </p>
                                                            <p class="radio">
                                                                <input type="radio" name="genderMe" id="female" value="female">
                                                                <label for="female">여자</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>
                                            
                                            
                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    

                                    <div class="btnArea center">
                                        <button type="button" class="btn addCompanion ripple" id="addCompanion">
                                            동반인 추가
                                        </button>
                                    </div>

                                </article>
                                <!-- //formArea -->
                            </div>
                            <!-- //bodyArea -->


                        </section>
                        <!-- //section -->

                        <!-- submitArea -->
                        <article class="submitArea">
                            <a href="../index.php" class="btn beforePage" title="이전">이전</a>
                            <label for="inputSubmit" class="btn nextSubmit" title="다음">
                                <input type="submit" id="inputSubmit" value="다음" title="다음">
                                <span class="ani"></span>
                            </label>
                        </article>
                        <!-- //submitArea -->

                    </form>
                    <!-- //form -->
                </div>
                <!-- //content -->
            </div>
            <!-- //contents -->

        </main>
        <!-- //main -->

        <script>
            
            // customSelect의 List 열기
            document.querySelectorAll('.customSelect .selectSearch').forEach(function(customSelectIn) {
                customSelectIn.addEventListener('focus', function(event) {
                    // 엘리먼트 추적
                    let action = event.target;
                    let value = action.value;
                    let customSelect = action.closest('.customSelect');
                    let selectLabel = action.closest('.selectLabel');
                    let selectList = customSelect.querySelector('.selectList');
                    let valueDelete = selectLabel.querySelector('.valueDelete');

                    customSelect.classList.add('active');
                    
                    if (value !=='') {
                        valueDelete.classList.add('active');
                    }
                });
            });

            // customSelect의 list btn 클릭시 컨트롤
            document.querySelectorAll('.customSelect .selectList .btn').forEach(function(selectBtns){
                selectBtns.addEventListener('click', function(event){
                    // 엘리먼트 추적
                    let action = event.target;
                    let selectList = action.closest('.selectList');
                    let selectLis = selectList.querySelectorAll('li')
                    let siblingBtns = selectList.querySelectorAll('.btn');
                    let customSelect = action.closest('.customSelect');
                    let inputHidden = customSelect.querySelector('input[type="hidden"]');
                    let inputNotHidden = customSelect.querySelector('input:not(input[type="hidden"])');
                    let selectLabel = customSelect.querySelector('.selectLabel')
                    let valueDelete = selectLabel.querySelector('.valueDelete');

                    // 값 추적
                    let tagText = action.innerText;
                    let tagValue = action.value;

                    // 값 삽입
                    inputHidden.value = tagValue;
                    inputNotHidden.value = tagText;

                    // 클래스 삽입&제거
                    siblingBtns.forEach(function(siblingBtn){
                        siblingBtn.classList.remove('active')
                    })
                    action.classList.add('active');
                    // valueDelete.classList.add('active');
                    customSelect.classList.remove('active');
                    
                    selectLis.forEach(function(selectLi){
                        selectLi.style.display = "";
                    })
                })
            })

            // customSelect input에 입력하면 일치하는 항목만 list에서 출력
            document.querySelectorAll('.customSelect label input:not(input[type="hidden"])').forEach(function(inputSearchs){
                inputSearchs.addEventListener('input', function(event){
                    // 엘리먼트 추적
                    let value = this.value;
                    let selectLabel = event.target.closest('.selectLabel')
                    let inputHidden =  selectLabel.querySelector('#travelCountryValue')
                    let customSelect = event.target.closest('.customSelect')
                    let valueDelete = selectLabel.querySelector('.valueDelete')
                    let selectList = customSelect.querySelector('.selectList')
                    let selectLis = selectList.querySelectorAll('li')
                    let firstFilter = value.toUpperCase();


                    for(var i = 0; i < selectLis.length; i++) {
                        let btn = selectLis[i].querySelector('.btn');
                    
                        if (btn) {
                            let txtValue = btn.textContent || btn.innerText;
                            if(txtValue.toUpperCase().indexOf(firstFilter) > -1) {
                                selectLis[i].style.display = "" ;
                                
                            } else {
                                selectLis[i].style.display = 'none';
                            }
                        }
                    }
                    
                    if(value !== '') {
                        valueDelete.classList.add('active');
                    } else {
                        valueDelete.classList.remove('active')
                        inputHidden.value = '';
                        selectLis.forEach(function(li) {
                            let valueNullBtn = li.querySelector('.btn');
                            valueNullBtn.classList.remove('active')
                        });
                        
                    }
                    
                })
                
            })

            // custom select focusout 될때 클래스 컨트롤
            document.querySelectorAll('.customSelect').forEach(function(customSelect) {
                customSelect.addEventListener('focusout', function(event) {
                    let selectLabel = customSelect.querySelector('.selectLabel');
                    let valueDelete = selectLabel.querySelector('.valueDelete');
                    
                    if (!customSelect.contains(event.relatedTarget)) {
                        let btnTag = selectLabel.querySelector('.btn');
                        btnTag.classList.remove('active');
                        customSelect.classList.remove('active');
                    }
                });
            });

            // customSelect의 valueDelete 클릭시 input text와 hidden에 담긴 값 삭제 및 클래스 컨트롤
            document.querySelectorAll('.customSelect .btn.valueDelete').forEach(function(valueDeletes){
                valueDeletes.addEventListener('click', function(event){
                    // 엘리먼트 추적
                    let action = event.target;
                    let selectLabel = action.closest('.selectLabel')
                    let customSelect = selectLabel.closest('.customSelect')
                    let selectList = customSelect.querySelector('.selectList')
                    let selectLis = selectList.querySelectorAll('li')
                    let inputHidden = selectLabel.querySelector('input[type="hidden"]');
                    let inputNotHidden = selectLabel.querySelector('input:not(input[type="hidden"])');
                    
                    // 값 설정
                    inputHidden.value = null;
                    inputNotHidden.value = null;
                    
                    // 컨트롤
                    inputNotHidden.focus();
                    action.classList.remove('active');

                    selectLis.forEach(function(selectLi){
                        selectLi.querySelector('.btn').classList.remove('active')
                        selectLi.style.display = "";
                    })
                    
                })
            })

            // custom select를 제외한 input(.deleteFnc 클래스 있는것)에 대한 삭제 버튼 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('input', function(event) {
                // 이벤트 타겟이 'input.deleteFnc'와 일치하는지 확인
                if (event.target && event.target.matches('input.deleteFnc')) {
                    let action = event.target;

                    // 입력 요소가 .customSelect 아닌지 확인
                    if (!action.closest('.customSelect')) {
                        let value = action.value;
                        let inputArea = action.closest('.inputArea');
                        
                        // inputArea가 null이 아닌지 확인
                        if (inputArea) {
                            let valueDelete = inputArea.querySelector('.valueDelete');
                            // valueDelete가 null이 아닌지 확인
                            if (valueDelete) {
                                if (value !== '') {
                                    valueDelete.classList.add('active');
                                } else {
                                    valueDelete.classList.remove('active');
                                }
                            }
                        }
                    }
                }
            });

            // .deleteFunc 클래스가 있는 input에 포커스 될때 삭제버튼 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('focus', function(event) {
                if (event.target && event.target.matches('input.deleteFnc')) {
                    let action = event.target;
                    let value = action.value;
                    let inputArea = action.closest('.inputArea');
                    let selectArea = action.closest('.selectArea');

                    // .inputArea 요소가 존재하는지 확인
                    if (inputArea) {
                        let valueDelete = inputArea.querySelector('.valueDelete');

                        // .valueDelete 요소가 존재하는지 확인
                        if (valueDelete) {
                            if (value !== '') {
                                valueDelete.classList.add('active');
                            }
                        }
                    }

                    // .selectArea 요소가 존재하는지 확인
                    if (selectArea) {
                        let valueDelete = selectArea.querySelector('.valueDelete');

                        // .valueDelete 요소가 존재하는지 확인
                        if (valueDelete) {
                            if (value !== '') {
                                valueDelete.classList.add('active');
                            }
                        }
                    }
                }
            }, true);

            // deleteFunc 클래스가 있는 input에서 포커스아웃 될때 삭제버튼 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('focusout', function(event) {
                if (event.target && event.target.matches('input.deleteFnc')) {
                    let inputArea = event.target.closest('.inputArea');

                    // .inputArea 요소가 존재하는지 확인
                    if (inputArea) {
                        let valueDelete = inputArea.querySelector('.valueDelete');

                        // .valueDelete 요소가 존재하는지 확인
                        if (valueDelete) {
                            // 포커스 아웃 시 관련된 타겟이 없는 경우에만 클래스 제거
                            if (!inputArea.contains(event.relatedTarget)) {
                                valueDelete.classList.remove('active');
                            }
                        }
                    }
                }
            }, true);

            // .valueDelete 버튼 클릭시 input value값 비우고 클래스 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('click', function(event) {
                if (event.target && event.target.matches('.btn.valueDelete')) {
                    let action = event.target;
                    let inputArea = action.closest('.inputArea');
                    
                    // inputArea가 존재하는지 확인
                    if (inputArea) {
                        let inputTag = inputArea.querySelector('input:not([type="hidden"])');
                        
                        // inputTag가 존재하는지 확인
                        if (inputTag) {
                            inputTag.value = '';
                        }
                        action.classList.remove('active');
                    }
                }
            });

            // .valueDelete focusout시 클래스 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('focusout', function(event) {
                if (event.target && event.target.matches('.btn.valueDelete')) {
                    let inputArea = event.target.closest('.inputArea');
                    let action = event.target;

                    // .inputArea 요소가 존재하는지 확인
                    if (action) {
                        // 포커스 아웃 시 관련된 타겟이 없는 경우에만 클래스 제거
                        if (!action.contains(event.relatedTarget)) {
                            action.classList.remove('active');
                        }
                    }
                }
            }, true);

            // 동반자 추가시 HTML생성
            document.getElementById('addCompanion').addEventListener('click', function(event) {
                let addCompanionBtn = event.target;
                let btnArea = addCompanionBtn.closest('.btnArea'); // addCompanion 버튼의 부모 요소인 .btnArea를 가져옴
                let topParent = btnArea.closest('#formArea'); // .btnArea의 부모 요소인 #formArea 가져옴

                let formGroups = topParent.querySelectorAll('.formGroup.companion');
                let companionCount = formGroups.length + 1; // 추가될 동반자의 번호 설정

                let companionHtml = createCompanionHtml(companionCount); // 새로운 동반자의 HTML 생성

                // .btnArea 앞에 새로운 동반자를 추가
                topParent.insertBefore(companionHtml, btnArea);
            });

            // HTML 생성 함수
            function createCompanionHtml(companionCount) {
                let companionHtml = document.createElement('div');
                companionHtml.setAttribute('class', 'formGroup companion');
                companionHtml.innerHTML = `
                    <div class="inputBox">
                        <div class="titleArea">
                            <label for="birthCompanion${companionCount}" class="title inputTitle companion">
                                동반자${companionCount}
                            </label>
                        </div>
                        <div class="columnArea">
                            <div class="inputGroup">
                                <label for="birthCompanion${companionCount}" class="title inputTitleSub">생년월일</label>
                                <div class="btnArea delete">
                                    <button type="button" class="btn deleteCompanion">삭제</button>
                                </div>
                                <div class="inputArea">
                                    <input type="text" name="birth${companionCount}" id="birthCompanion${companionCount}" placeholder="숫자만 입력하세요." class="hypen deleteFnc" maxlength="10">
                                    <button type="button" class="btn valueDelete" title="삭제"></button>
                                </div>
                            </div>

                            <div class="inputGroup">
                                <label for="male${companionCount}" class="title inputTitleSub">성별</label>
                                <div class="inputArea">
                                    <div class="radioGroup">
                                        <p class="radio">
                                            <input type="radio" name="gender${companionCount}" id="male${companionCount}" value="male${companionCount}" required>
                                            <label for="male${companionCount}">남자</label>
                                        </p>
                                        <p class="radio">
                                            <input type="radio" name="gender${companionCount}" id="female${companionCount}" value="female${companionCount}">
                                            <label for="female${companionCount}">여자</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                return companionHtml;
            }

            // 동반자 삭제 
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('deleteCompanion')) {
                    let action = event.target;
                    let inputBox = action.closest('.inputBox');
                    let companionTitle = inputBox.querySelector('.titleArea .inputTitle.companion');
                    let companionText = companionTitle.innerText;

                    if (confirm(`${companionText}을 삭제하시겠습니까?\n(입력한 정보가 삭제됩니다)`)) {
                        event.target.closest('.formGroup.companion').remove(); // 클릭된 삭제 버튼의 부모 요소인 동반자 formGroup 제거
                        updateCompanionNumbers(); // 동반자 번호 업데이트
                    }
                    
                }
            });

            // 동반자 번호 업데이트 함수
            function updateCompanionNumbers() {
                let formGroups = document.querySelectorAll('.formGroup.companion');
                formGroups.forEach((group, index) => {
                    
                    // 동반자 타이틀 라벨
                    let companionLabel = group.querySelector('.inputTitle.companion');
                    if (companionLabel) {
                        companionLabel.textContent = `동반자${index + 1}`;
                        let newFor = companionLabel.getAttribute('for').replace(/\d+$/, index + 1);
                        companionLabel.setAttribute('for', newFor);
                    }

                    // 생년월일 타이틀 라벨
                    let inputTitleSubLabels = group.querySelectorAll('.inputTitleSub');
                    inputTitleSubLabels.forEach((label, subIndex) => {
                        let newFor = label.getAttribute('for').replace(/\d+$/, index + 1);
                        label.setAttribute('for', newFor);
                    });

                    // 입력 input
                    let textInput = group.querySelector('.inputArea input[type="text"]');
                    if (textInput) {
                        let newName = textInput.getAttribute('name').replace(/\d+$/, index + 1);
                        textInput.setAttribute('name', newName);
                        let newId = textInput.getAttribute('id').replace(/\d+$/, index + 1);
                        textInput.setAttribute('id', newId);
                    }

                    // 라디오버튼
                    let radioInputs = group.querySelectorAll('.radio input[type="radio"]');
                    radioInputs.forEach((radio, radioIndex) => {
                        let newName = radio.getAttribute('name').replace(/\d+$/, index + 1);
                        let newId = radio.getAttribute('id').replace(/\d+$/, index + 1);
                        let newValue = radio.getAttribute('value').replace(/\d+$/, index + 1);
                        
                        radio.setAttribute('name', newName);
                        radio.setAttribute('id', newId);
                        radio.setAttribute('value', newValue);
                    })

                    // 라디오버튼 라벨
                    let radioLabel = group.querySelectorAll('.radio label');
                    radioLabel.forEach((label, labelIndex) => {
                        let newFor = label.getAttribute('for').replace(/\d+$/, index + 1);
                        label.setAttribute('for', newFor);
                    })
                });
            }

            // input에 hypen 클래스가 있으면 입력시 하이픈(-) 표시 (생년월일)
            document.addEventListener('DOMContentLoaded', function() {
                let formArea = document.getElementById('formArea');
                if (formArea) {
                    formArea.addEventListener('input', function(event) {
                        if (event.target && event.target.matches('.hypen')) {
                            // 사용자 입력값은 모두 숫자만 받는다.(나머지는 ""처리)
                            let val = event.target.value.replace(/\D/g, "");
                            let leng = val.length;
                            // 출력할 결과 변수
                            let result = '';
                            // 4개일때 - 20221 : 바로 출력
                            if (leng < 5) {
                                result = val;
                            }
                            // 5개일때 - 20221 : 2022-1
                            else if (leng < 6) {
                                result += val.substring(0, 4);
                                result += "-";
                                result += val.substring(4);
                            }
                            // 6개일때 - 202210 : 2022-10
                            else if (leng < 7) {
                                result += val.substring(0, 4);
                                result += "-";
                                result += val.substring(4);
                            }
                            // 7개부터 - 2022103 : 2022-10-3
                            else {
                                result += val.substring(0, 4);
                                result += "-";
                                result += val.substring(4, 6);
                                result += "-";
                                result += val.substring(6);
                            }
                            event.target.value = result;
                        }
                    });

                    // 숫자만 입력받게
                    formArea.addEventListener('keydown', function(event) {
                        if (event.target && event.target.matches('.hypen')) {
                            // 숫자키와 제어키 (백스페이스, Delete, 화살표 등)만 허용
                            if (!/[0-9]/.test(event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(event.key)) {
                                event.preventDefault();
                            }
                        }
                    });
                } 
            });

            // submit 버튼을 클릭할때 여행국가 value값 체크
            // 앞서 작성된 script중 // customSelect input에 입력하면 일치하는 항목만 list에서 출력 에
            // input이 비어있으면 hidden value를 비우게 설정
            document.getElementById('inputSubmit').addEventListener('click', function(event){
                let inputHidden = document.getElementById('travelCountryValue'); 
                let inputText = document.getElementById('travelCountryText'); 
                
                // hidden input과 text input 둘 다 비어있는 경우
                if (!inputHidden.value && !inputText.value) {
                    event.preventDefault();
                    alert('여행국가를 입력 후 리스트에서 선택해 주세요.'); 
                    inputText.focus(); 
                } 
                // hidden input이 비어있는 경우 (리스트에서 선택되지 않은 경우)
                else if (!inputHidden.value) {
                    event.preventDefault();
                    alert('여행국가를 입력 후 리스트에서 선택해 주세요'); 
                    inputText.focus(); 
                } 
                // text input이 비어있는 경우 (여행 국가를 입력하지 않은 경우)
                else if (!inputText.value) {
                    event.preventDefault();
                    alert('여행국가를 입력해 주세요.');
                    inputText.focus();
                }
            });


        </script>

        <!-- modal -->
        <aside id="modal">
            <?php
                include $_SERVER['DOCUMENT_ROOT']."/include/modal_step.php";
            ?>
        </aside>
        <!-- //modal -->

        <!-- footer -->
        <footer id="footer">
            <?php
                include $_SERVER['DOCUMENT_ROOT']."/include/footer_step.php";
            ?>
        </footer>
        <!-- //footer -->
    </div>
</body>