

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
                    <form action="/step/step_03.php" method="post" autocomplete="off">
                        <!-- section -->
                        <section class="section step">

                            <article class="titleArea">
                                <h3 class="title stepTitle">피보험자 정보 입력</h3>
                            </article>

                            <!-- bodyArea -->
                            <div class="bodyArea">
                                <!-- formArea -->
                                <article class="formArea" id="formArea">
                                    
                                
                                    <!-- formGroup -->
                                    <div class="formGroup">
                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <!-- titleArea -->
                                            <div class="titleArea">
                                                <label for="mainNameKo" class="title inputTitle">
                                                    대표피보험자
                                                </label>
                                            </div>
                                            <!-- //titleArea -->

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameKo" class="title inputTitleSub">한글 성명</label>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameKo" id="mainNameKo" placeholder="홍길동" class="deleteFnc" required >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameEnLast" class="title inputTitleSub">영문 성명</label>
                                                    <div class="inputArea noneFlex" style="width: 116px;">
                                                        <input type="text" name="mainNameEnLast" id="mainNameEnLast" placeholder="성" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameEnFirst" id="mainNameEnFirst" placeholder="이름" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>
                                            

                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup">
                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="idFirst" class="title inputTitleSub">주민등록번호</label>
                                                    <div class="inputArea">
                                                        <input type="number" name="idFirst" id="idFirst" value="840322" readonly>
                                                    </div>
                                                    <span class="betweenCenter">-</span>
                                                    <div class="inputArea">
                                                        <input type="password" name="idLast" id="idLast" class="deleteFnc onlyNum" maxlength="7" required autocomplete="off">
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="dualYes" class="title inputTitleSub">
                                                        영주권자 / 이중국적자
                                                        <span class="essential">※ 모국여행은 가입 불가</span>
                                                    </label>
                                                    <div class="inputArea noneFlex">
                                                        <div class="radioGroup" id="#dualCkd">
                                                            <p class="radio">
                                                                <input type="radio" name="dual" id="dualYes" value="dualYes" checked>
                                                                <label for="dualYes">예</label>
                                                            </p>
                                                            <p class="radio">
                                                                <input type="radio" name="dual" id="dualNo" value="dualNo" >
                                                                <label for="dualNo">아니오</label>
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="dualCountry" id="dualCountry" class="deleteFnc" placeholder="해당국가를 입력해주세요." required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>
                                            

                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup ">
                                        <!-- inputBox -->
                                        <div class="inputBox">
                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="tel" class="title inputTitleSub">휴대폰 번호</label>
                                                    <div class="inputArea">
                                                        <input type="tel" name="tel" id="tel" class="hypenTel deleteFnc" placeholder="숫자만 입력하세요." maxlength="13" required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    
                                                </div>
                                                <!-- //inputGroup -->

                                                 <!-- inputGroup -->
                                                 <div class="inputGroup">
                                                    <label for="emailAddress" class="title inputTitleSub">이메일</label>
                                                    <div class="inputArea">
                                                        <input type="text" name="emailAddress" id="emailAddress" class="deleteFnc" required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    <span class="betweenCenter">@</span>
                                                    <div class="inputArea">
                                                        <input type="text" name="emailDomain" id="emailDomain" class="deleteFnc" required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    
                                                </div>
                                                <!-- //inputGroup -->

                                        
                                            </div>
                                            

                                        </div>
                                        <!-- //inputBox -->
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup companion">
                                        <div class="inputBox">
                                            <div class="titleArea">
                                                <label for="birthCompanion01" class="title inputTitle companion">
                                                    동반인 1
                                                </label>
                                            </div>

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameKoCompanion01" class="title inputTitleSub">한글 성명</label>
                                                    <div class="btnArea delete">
                                                        <button type="button" class="btn deleteCompanion">삭제</button>
                                                    </div>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameKoCompanion01" id="mainNameKoCompanion01" placeholder="홍길동" class="deleteFnc" required >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameEnLastCompanion01" class="title inputTitleSub">영문 성명</label>
                                                    <div class="inputArea noneFlex" style="width: 116px;">
                                                        <input type="text" name="mainNameEnLastCompanion01" id="mainNameEnLastCompanion01" placeholder="성" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameEnFirstCompanion01" id="mainNameEnFirstCompanion01" placeholder="이름" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="idFirstCompanion01" class="title inputTitleSub">주민등록번호</label>
                                                    <div class="inputArea">
                                                        <input type="number" name="idFirstCompanion01" id="idFirstCompanion01" value="840322" readonly>
                                                    </div>
                                                    <span class="betweenCenter">-</span>
                                                    <div class="inputArea">
                                                        <input type="password" name="idLastCompanion01" id="idLastCompanion01" class="deleteFnc onlyNum" maxlength="7" required autocomplete="off">
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="dualYesCompanion01" class="title inputTitleSub">
                                                        영주권자 / 이중국적자
                                                        <span class="essential">※ 모국여행은 가입 불가</span>
                                                    </label>
                                                    <div class="inputArea noneFlex">
                                                        <div class="radioGroup" id="#dualCkd">
                                                            <p class="radio">
                                                                <input type="radio" name="dualCompanion01" id="dualYesCompanion01" value="dualYesCompanion01" checked>
                                                                <label for="dualYesCompanion01">예</label>
                                                            </p>
                                                            <p class="radio">
                                                                <input type="radio" name="dualCompanion01" id="dualNoCompanion01" value="dualNoCompanion01" >
                                                                <label for="dualNoCompanion01">아니오</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="dualCountryCompanion01" id="dualCountryCompanion01" class="deleteFnc" placeholder="해당국가를 입력해주세요." required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>


                                        </div>
                                    </div>
                                    <!-- //formGroup -->

                                    <!-- formGroup -->
                                    <div class="formGroup companion">
                                        <div class="inputBox">
                                            <div class="titleArea">
                                                <label for="birthCompanion02" class="title inputTitle companion">
                                                    동반인 2
                                                </label>
                                            </div>

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameKoCompanion02" class="title inputTitleSub">한글 성명</label>
                                                    <div class="btnArea delete">
                                                        <button type="button" class="btn deleteCompanion">삭제</button>
                                                    </div>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameKoCompanion02" id="mainNameKoCompanion02" placeholder="홍길동" class="deleteFnc" required >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="mainNameEnLastCompanion02" class="title inputTitleSub">영문 성명</label>
                                                    <div class="inputArea noneFlex" style="width: 116px;">
                                                        <input type="text" name="mainNameEnLastCompanion02" id="mainNameEnLastCompanion02" placeholder="성" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="mainNameEnFirstCompanion02" id="mainNameEnFirstCompanion02" placeholder="이름" class="deleteFnc onlyEn" >
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>

                                            <div class="columnArea">
                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="idFirstCompanion02" class="title inputTitleSub">주민등록번호</label>
                                                    <div class="inputArea">
                                                        <input type="number" name="idFirstCompanion02" id="idFirstCompanion02" value="830322" readonly>
                                                    </div>
                                                    <span class="betweenCenter">-</span>
                                                    <div class="inputArea">
                                                        <input type="password" name="idLastCompanion02" id="idLastCompanion02" class="deleteFnc onlyNum" maxlength="7" required autocomplete="off">
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->

                                                <!-- inputGroup -->
                                                <div class="inputGroup">
                                                    <label for="dualYesCompanion02" class="title inputTitleSub">
                                                        영주권자 / 이중국적자
                                                        <span class="essential">※ 모국여행은 가입 불가</span>
                                                    </label>
                                                    <div class="inputArea noneFlex">
                                                        <div class="radioGroup" id="#dualCkd">
                                                            <p class="radio">
                                                                <input type="radio" name="dualCompanion02" id="dualYesCompanion02" value="dualYesCompanion02" checked>
                                                                <label for="dualYesCompanion02">예</label>
                                                            </p>
                                                            <p class="radio">
                                                                <input type="radio" name="dualCompanion02" id="dualNoCompanion02" value="dualNoCompanion02" >
                                                                <label for="dualNoCompanion02">아니오</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span class="betweenCenter"></span>
                                                    <div class="inputArea">
                                                        <input type="text" name="dualCountryCompanion02" id="dualCountryCompanion02" class="deleteFnc" placeholder="해당국가를 입력해주세요." required>
                                                        <button type="button" class="btn valueDelete" title="삭제"></button>
                                                    </div>
                                                </div>
                                                <!-- //inputGroup -->
                                            </div>


                                        </div>
                                    </div>
                                    <!-- //formGroup -->


                                </article>
                                <!-- //formArea -->
                            </div>
                            <!-- //bodyArea -->


                        </section>
                        <!-- //section -->

                        <!-- submitArea -->
                        <article class="submitArea">
                            <a href="step_02.php" class="btn beforePage" title="이전">이전</a>
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

            // 문서 로드 시 .onlyEn 클래스가 있는 input에 영어만 입력되게
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input.onlyEn').forEach(function(input) {
                    input.addEventListener('input', function(event) {
                        // 입력된 값을 영어 알파벳만 남기고 제거
                        let val = input.value;
                        let filteredVal = val.replace(/[^a-zA-Z]/g, ''); // 영어 알파벳 이외의 문자 제거
                        if (val !== filteredVal) {
                            input.value = filteredVal;
                        }
                    });
                });
            });

            // 문서 로드 시 .onlyNum 클래스가 있는 input에 숫자만 입력되게
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input.onlyNum').forEach(function(input) {
                    input.addEventListener('input', function(event) {
                        // 입력된 값을 숫자만 남기고 제거
                        let val = input.value;
                        let filteredVal = val.replace(/[^0-9]/g, ''); // 숫자 이외의 문자 제거
                        if (val !== filteredVal) {
                            input.value = filteredVal;
                        }
                    });
                });
            });

            // 영주권자, 이중국적자 체크 여부에 따른 input 컨트롤
            document.querySelectorAll('.radio input[name="dual"]').forEach(function(radioCkds) {
                radioCkds.addEventListener('change', function(event) {
                    let dualCountry = document.getElementById('dualCountry');
                    if (event.target.checked) {
                        if (event.target.value === 'dualYes') {
                            dualCountry.setAttribute('required', '');
                            dualCountry.setAttribute('placeholder', '해당국가를 입력해주세요.');
                            dualCountry.removeAttribute('disabled');
                        } else {
                            dualCountry.setAttribute('disabled', '');
                            dualCountry.removeAttribute('placeholder');
                            dualCountry.removeAttribute('required');
                        }
                    }
                });
            });

            // 동반자 = 영주권자, 이중국적자 체크 여부에 따른 input 컨트롤
            document.querySelectorAll('.radio input[name^="dualCompanion"]').forEach(function(radioCkdsCompanion){
                radioCkdsCompanion.addEventListener('change', function(event){
                    let action = event.target;
                    let inputGroup = action.closest('.inputGroup')
                    let targetTag = inputGroup.querySelector('input[name^="dualCountryCompanion"]');
                    

                    if(action.value.startsWith('dualYesCompanion')) {
                        targetTag.setAttribute('required', '');
                        targetTag.setAttribute('placeholder', '해당국가를 입력해주세요.');
                        targetTag.removeAttribute('disabled');
                    } else {
                        targetTag.setAttribute('disabled', '');
                        targetTag.removeAttribute('placeholder');
                        targetTag.removeAttribute('required');
                    }
                    
                })
            })
            
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

            // hypenTel 클래스가 있으면 자릿수에 맞게 하이픈(-) 표시 (연락처)
            document.addEventListener('DOMContentLoaded', function() {
                let formArea = document.getElementById('formArea');
                if (formArea) {
                    formArea.addEventListener('input', function(event) {
                        if (event.target && event.target.matches('.hypenTel')) {
                            // 사용자 입력값은 모두 숫자만 받는다.(나머지는 ""처리)
                            let val = event.target.value.replace(/\D/g, ""); // value를 사용합니다.
                            let leng = val.length;
                            let result = '';

                            // 02로 시작하는 번호 체크
                            if (val.startsWith('02')) {
                                if (leng < 3) {
                                    result = val;
                                } else if (leng < 6) {
                                    result += val.substr(0, 2);
                                    result += '-';
                                    result += val.substr(2);
                                } else if (leng < 10) {
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
                            } else if (val.startsWith('15') && leng < 9) { // 1588-1234처럼 15로 시작하는 번호 체크
                                if (leng < 5) {
                                    result = val;
                                } else if (leng < 8) {
                                    result += val.substr(0, 4);
                                    result += '-';
                                    result += val.substr(4);
                                } else if (leng < 12) {
                                    result += val.substr(0, 4);
                                    result += '-';
                                    result += val.substr(4, 4);
                                }
                            } else {
                                if (leng < 4) {
                                    result = val;
                                } else if (leng < 7) {
                                    result += val.substr(0, 3);
                                    result += '-';
                                    result += val.substr(3);
                                } else if (leng < 11) {
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
                            event.target.value = result; // value를 사용하여 입력된 값 설정
                        }
                    });

                    formArea.addEventListener('keydown', function(event) {
                        if (event.target && event.target.matches('.hypenTel')) {
                            // 숫자키와 제어키 (백스페이스, Delete, 화살표 등)만 허용
                            if (!/[0-9]/.test(event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(event.key)) {
                                event.preventDefault();
                            }
                        }
                    });
                }
            });

            
            // custom select를 제외한 input(.deleteFnc 클래스 있는것)에 대한 삭제 버튼 컨트롤
            // 동적으로 생선된 태그도 대응하기위해 이벤트 위임을 사용
            document.getElementById('formArea').addEventListener('input', function(event) {
                if (event.target && event.target.matches('input.deleteFnc')) {
                    let action = event.target;
                    let value = action.value;
                    let inputArea = action.closest('.inputArea');
                    let valueDelete = inputArea.querySelector('.valueDelete');
 
                    if (value !== '') {
                        valueDelete.classList.add('active');
                    } else {
                        valueDelete.classList.remove('active');
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