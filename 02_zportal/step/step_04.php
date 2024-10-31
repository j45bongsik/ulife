

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
                    <form action="/step/step_04.php" method="post" id="" autocomplete="off">
                        <!-- section -->
                        <section class="section step">

                            <!-- <article class="titleArea">
                                <h3 class="title stepTitle">여행 출발전 고지사항</h3>

                                <div class="checkBox">
                                    <input type="checkbox" name="notifyAll" id="notifyAll">
                                    <label for="notifyAll">전체 아니요</label>
                                </div>

                            </article> -->

                            <!-- bodyArea -->
                            <div class="bodyArea">

                                <article class="agreeArea">
                                    <div class="titleArea">
                                        <h3 class="title stepTitle">여행 출발전 고지사항</h3>
                                    
                                        <div class="checkBox">
                                            <input type="checkbox" name="notifyAll" id="notifyAll">
                                            <label for="notifyAll">전체 아니요</label>
                                        </div>
                                    </div>

                                    <ul class="agreeCont">    
                                        <li class="alignSelfTop">
                                            <p class="desc agreeDesc">
                                                1. 현재 해외 체류중이신가요?<br />
                                                <span class="essential agree">(해외 체류시 가입불가, 국내 전 보험사 공통사항)</span>
                                            </p>
                                                
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="notify01" id="notify01Yes" value="notify01Yes" requ>
                                                    <label for="notify01Yes">예</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="notify01" id="notify01No" value="notify01No">
                                                    <label for="notify01No">아니요</label>
                                                </p>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="desc agreeDesc">
                                                2. 최근 3개월 내에 <span id="diseaseInfo" class="modalOpen essential underLine" title="상세보기">입원, 수술, 질병확진[보기]</span>을 받은 사실이 있나요?
                                            </p>
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="notify02" id="notify02Yes" value="notify02Yes">
                                                    <label for="notify02Yes">예</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="notify02" id="notify02No" value="notify02No">
                                                    <label for="notify02No">아니요</label>
                                                </p>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="desc agreeDesc">
                                                3. 위험한 운동이나 전문적인 체육활동을 목적으로 출국하시나요? 
                                            </p>
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="notify03" id="notify03Yes" value="notify03Yes">
                                                    <label for="notify03Yes">예</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="notify03" id="notify03No" value="notify03No">
                                                    <label for="notify03No">아니요</label>
                                                </p>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="desc agreeDesc">
                                                4. 여행지역이 <span id="dangerCountry" class="modalOpen essential underLine" title="상세보기">여행금지국가[보기]</span>인가요?
                                            </p>
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="notify04" id="notify04Yes" value="notify04Yes">
                                                    <label for="notify04Yes">예</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="notify04" id="notify04No" value="notify04No">
                                                    <label for="notify04No">아니요</label>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </article>

                                <article class="agreeArea type02">
                                    <div class="titleArea">
                                        <h3 class="title stepTitle">
                                            <span class="essential blue">(필수)</span> 
                                            이용동의
                                        </h3>
                                    
                                        <div class="checkBox">
                                            <input type="checkbox" name="agreeAll" id="agreeAll">
                                            <label for="agreeAll">전체 동의</label>
                                        </div>
                                    </div>

                                    <ul class="agreeCont">    
                                        <li>
                                            <div class="labelArea">
                                                <p class="desc agreeDesc">
                                                    이용약관
                                                </p>
                                                
                                                <div class="btnArea">
                                                    <button type="button" id="termUse" class="btn detailView modalOpen" >자세히보기</button>
                                                </div>
                                            </div>
                                                
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="agree01" id="agree01" value="agree01">
                                                    <label for="agree01">동의</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="agree01" id="disagree01" value="disagree01">
                                                    <label for="disagree01">동의하지 않음</label>
                                                </p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="labelArea">
                                                <p class="desc agreeDesc">
                                                    개인정보 수집 및 이용 동의
                                                </p>
                                                
                                                <div class="btnArea">
                                                    <button type="button" id="personalInfo" class="btn detailView modalOpen" >자세히보기</button>
                                                </div>
                                            </div>
                                                
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="agree02" id="agree02" value="agree02">
                                                    <label for="agree02">동의</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="agree02" id="disagree02" value="disagree02">
                                                    <label for="disagree02">동의하지 않음</label>
                                                </p>
                                            </div>
                                        </li>

                                        <li class="acco 1depth">
                                            <div class="accoLabel">
                                                <div class="labelArea">
                                                    <p class="desc agreeDesc accoDesc">
                                                        개인정보 처리 및 단체가입규약 동의
                                                    </p>
                                                    
                                                    <div class="btnArea">
                                                        <button type="button" id="groupInfo" class="btn detailView modalOpen" >자세히보기</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="radioGroup">
                                                    <p class="radio type02">
                                                        <input type="radio" name="agree03" id="agree03" value="agree03">
                                                        <label for="agree03">동의</label>
                                                    </p>
                                                    <p class="radio type02">
                                                        <input type="radio" name="agree03" id="disagree03" value="disagree03">
                                                        <label for="disagree03">동의하지 않음</label>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            
                                                
                                            <div class="accoCont 2depth">
                                                <ul>
                                                    <li>
                                                        <p class="desc agreeDescSub">단체가입규약 동의</p>
                                                        <div class="radioGroup">
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub01" id="agreeSub01" value="agreeSub01">
                                                                <label for="agreeSub01">동의</label>
                                                            </p>
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub01" id="disagreeSub01" value="disagreeSub01">
                                                                <label for="disagreeSub01">동의하지 않음</label>
                                                            </p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <p class="desc agreeDescSub">개인정보 수집 및 이용 및 제3자 제공 동의</p>
                                                        <div class="radioGroup">
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub02" id="agreeSub02" value="agreeSub02">
                                                                <label for="agreeSub02">동의</label>
                                                            </p>
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub02" id="disagreeSub02" value="disagreeSub02">
                                                                <label for="disagreeSub02">동의하지 않음</label>
                                                            </p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <p class="desc agreeDescSub">고유식별 정보 수집 및 이용제공 및 제3자 제공 동의</p>
                                                        <div class="radioGroup">
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub03" id="agreeSub03" value="agreeSub03">
                                                                <label for="agreeSub03">동의</label>
                                                            </p>
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub03" id="disagreeSub03" value="disagreeSub03">
                                                                <label for="disagreeSub03">동의하지 않음</label>
                                                            </p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <p class="desc agreeDescSub">마케팅 활용을 위한 개인정보 수집 및 이용 동의 (선택)</p>
                                                        <div class="radioGroup">
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub04" id="agreeSub04" value="agreeSub04" class="option">
                                                                <label for="agreeSub04">동의</label>
                                                            </p>
                                                            <p class="radio type03">
                                                                <input type="radio" name="agreeSub04" id="disagreeSub04" value="disagreeSub04" class="option">
                                                                <label for="disagreeSub04">동의하지 않음</label>
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="labelArea">
                                                <p class="desc agreeDesc">
                                                    보험약관
                                                    <a href="../download/overseas.pdf" download class="btn blueCircleLine type02" target="_blank" title="다운로드">해외여행보험약관 다운로드</a>
                                                </p>
                                                <div class="btnArea">
                                                    <button type="button" id="insuranceTerms" class="btn detailView modalOpen" >자세히보기</button>
                                                </div>
                                            </div>
                                                
                                            <div class="radioGroup">
                                                <p class="radio type02">
                                                    <input type="radio" name="agree04" id="agree04" value="agree04">
                                                    <label for="agree04">동의</label>
                                                </p>
                                                <p class="radio type02">
                                                    <input type="radio" name="agree04" id="disagree04" value="disagree04">
                                                    <label for="disagree04">동의하지 않음</label>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </article>
                            </div>
                            

                        </section>
                        <!-- //section -->

                        <!-- submitArea -->
                        <article class="submitArea">
                            <a href="step_03.php" class="btn beforePage" title="이전">이전</a>
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

            // 여행 출발전 고지사항 체크박스, radio 컨트롤
            document.addEventListener('DOMContentLoaded', function () {
                const notifyAllCheckbox = document.getElementById('notifyAll');
                const radioButtons = document.querySelectorAll('.agreeArea input[type="radio"]');

                // 모든 "아니요" 라디오 버튼을 체크하는 함수
                function checkNoRadioButtons() {
                    radioButtons.forEach(function (radio) {
                        if (radio.id.endsWith('No')) {
                            radio.checked = true;
                        }
                    });
                }

                // 모든 "예" 라디오 버튼을 체크하는 함수
                function checkYesRadioButtons() {
                    radioButtons.forEach(function (radio) {
                        if (radio.id.endsWith('Yes')) {
                            radio.checked = true;
                        }
                    });
                }

                // "전체 아니요" 체크박스 변경 이벤트 처리
                notifyAllCheckbox.addEventListener('change', function () {
                    if (notifyAllCheckbox.checked) {
                        checkNoRadioButtons();
                    } else {
                        checkYesRadioButtons();
                    }
                });

                // 라디오 버튼 클릭 이벤트 처리
                radioButtons.forEach(function (radio) {
                    radio.addEventListener('click', function () {
                        // "예" 라디오 버튼을 클릭하면 "전체 아니요" 체크 해제
                        if (radio.id.endsWith('Yes')) {
                            notifyAllCheckbox.checked = false;
                        }
                        // 모든 "아니요" 라디오 버튼이 클릭되면 "전체 아니요" 체크
                        const allNoChecked = Array.from(radioButtons).every(function (radio) {
                            return radio.id.endsWith('No') ? radio.checked : true;
                        });
                        notifyAllCheckbox.checked = allNoChecked;
                    });
                });
            });

            // 이용동의 체크박스, radio 컨트롤
            document.addEventListener('DOMContentLoaded', function () {
                const agreeAllCheckbox = document.getElementById('agreeAll');
                const radioButtons = document.querySelectorAll('.agreeArea.type02 input[type="radio"]');

                // 모든 "동의" 라디오 버튼을 체크하는 함수
                function checkAgreeRadioButtons() {
                    radioButtons.forEach(function (radio) {
                        if (radio.id.startsWith('agree')) {
                            radio.checked = true;
                        }
                    });
                }

                // 모든 "동의하지 않음" 라디오 버튼을 체크하는 함수
                function checkDisAgreeRadioButtons() {
                    radioButtons.forEach(function (radio) {
                        if (radio.id.startsWith('disagree')) {
                            radio.checked = true;
                        }
                    });
                }

                // "전체동의" 체크박스 변경 이벤트 처리
                agreeAllCheckbox.addEventListener('change', function () {
                    if (agreeAllCheckbox.checked) {
                        checkAgreeRadioButtons();
                    } else {
                        checkDisAgreeRadioButtons();
                    }
                });

                // 라디오 버튼 클릭 이벤트 처리
                radioButtons.forEach(function (radio) {
                    radio.addEventListener('click', function () {
                        // "동의" 라디오 버튼을 클릭하면 "전체 아니요" 체크 해제
                        if (radio.id.startsWith('agree')) {
                            agreeAllCheckbox.checked = false;
                        } else { // "동의하지 않음" 라디오 버튼을 클릭하면 "동의" 라디오 버튼 체크 해제
                            const yesRadio = document.getElementById(radio.id.replace('disagree', 'agree'));
                            yesRadio.checked = false;
                        }
                    });
                });
            });

            // accordions
            document.querySelector('.acco > .accoLabel').addEventListener('click', function(event) {
                let excludedSelectors = ['.btnArea', '.radio'];
                let isExcluded = excludedSelectors.some(selector => event.target.closest(selector));

                if (isExcluded) {
                    return;
                }

                let accoElement = event.currentTarget;

                if (accoElement.classList.contains('active')) {
                    accoElement.classList.remove('active');
                } else {
                    accoElement.classList.add('active');
                }
            });

            document.getElementById('inputSubmit').addEventListener('click', function(event) {
                let notify01No = document.getElementById('notify01No');
                let notify02No = document.getElementById('notify02No');
                let notify03No = document.getElementById('notify03No');
                let notify04No = document.getElementById('notify04No');

                let agree01 = document.getElementById('agree01');
                let agree02 = document.getElementById('agree02');
                let agree03 = document.getElementById('agree03');
                let agree04 = document.getElementById('agree04');


                let agreeSub01 = document.getElementById('agreeSub01');
                let agreeSub02 = document.getElementById('agreeSub02');
                let agreeSub03 = document.getElementById('agreeSub03');
                let agreeSub04 = document.getElementById('agreeSub04');
                let disagreeSub04 = document.getElementById('disagreeSub04');

                // 여행 출발전 고지사항 아무것도 체크 안되어있을때
                if (!notify01No.checked && !notify02No.checked && !notify03No.checked && !notify04No.checked) {
                    event.preventDefault();
                    alert('여행 출발전 고지사항을 선택해 주세요.')
                    return false;
                }

                //여행 출발전 고지사항 1번 아니요 체크 안되어있을때
                if (!notify01No.checked) {
                    event.preventDefault();
                    alert('현재 해외 체류중일경우 다음단계로 진행할수 없습니다.'); 
                    return false;
                } 

                //여행 출발전 고지사항 2번 아니요 체크 안되어있을때
                if (!notify02No.checked) {
                    event.preventDefault();
                    alert('최근 3개월 내에 입원, 수술, 질병확진을 받은경우 다음단계로 진행할수 없습니다.'); 
                    return false;
                } 

                //여행 출발전 고지사항 3번 아니요 체크 안되어있을때
                if (!notify03No.checked) {
                    event.preventDefault();
                    alert('위험한 운동이나 전문적인 체육활동을 목적으로 출국하는경우 다음단계로 진행할수 없습니다.');
                    return false;
                }

                //여행 출발전 고지사항 4번 아니요 체크 안되어있을때
                if (!notify04No.checked) {
                    event.preventDefault();
                    alert('여행지역이 여행금지국가일경우 다음단계로 진행할수 없습니다.');
                    return false;
                } 

                //이용동의 1번 동의 체크 안되어있을때
                if (!agree01.checked) {
                    event.preventDefault();
                    alert('이용약관에 동의해 주세요.');
                    return false;
                }

                //이용동의 2번 동의 체크 안되어있을때
                if (!agree02.checked) {
                    event.preventDefault();
                    alert('개인정보 수집 및 이용에 동의해 주세요.');
                    return false;
                }
                
                //이용동의 3번 동의 체크 안되어있을때
                if (!agree03.checked) {
                    event.preventDefault();
                    alert('개인정보 수집 및 이용 동의에 동의해 주세요.');
                    return false;
                }

                //이용동의 4번 동의 체크 안되어있을때
                if (!agree04.checked) {
                    event.preventDefault();
                    alert('보험약관에 동의해 주세요.');
                    return false;
                }

                //개인정보 처리 및 단테가입규약 하위 1번 동의 체크 안되어있을때
                if (!agreeSub01.checked) {
                    event.preventDefault();
                    alert('개인정보 처리 및 단체가입규약 \n→ 단체가입규약에\n동의해 주세요.');
                    return false;
                }

                //개인정보 처리 및 단테가입규약 하위 2번 동의 체크 안되어있을때
                if (!agreeSub02.checked) {
                    event.preventDefault();
                    alert('개인정보 처리 및 단체가입규약 \n→ 개인정보 수집 및 이용 및 제3자 제공에\n동의해 주세요.');
                    return false;
                }

                //개인정보 처리 및 단테가입규약 하위 3번 동의 체크 안되어있을때
                if (!agreeSub03.checked) {
                    event.preventDefault();
                    alert('개인정보 처리 및 단체가입규약 \n→ 고유식별 정보 수집 및 이용제공 및 제3자 제공에 \n동의해 주세요.');
                    return false;
                }

                //개인정보 처리 및 단테가입규약 하위 4번 동의 체크 안되어있을때
                if (!agreeSub04.checked && !disagreeSub04.checked) {
                    event.preventDefault();
                    alert('개인정보 처리 및 단체가입규약 \n→ 마케팅 활용을 위한 개인정보 수집 및 이용 동의\n선택해 주세요.');
                    return false;
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