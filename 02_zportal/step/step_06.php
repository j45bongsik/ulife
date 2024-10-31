

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

                    <!-- section -->
                    <section class="section step">

                        <!-- <article class="titleArea">
                            <h3 class="title stepTitle">여행자보험 가입신청정보</h3>
                        </article> -->

                        <!-- bodyArea -->
                        <div class="bodyArea">

                            <div class="completeArea">
                                <div class="bodyArea">
                                    <div class="imgArea">
                                        <img src="../images/common/img_complete_visual.png" alt="보험가입완료 이미지">
                                    </div>
                                    <div class="descArea">
                                        <h4 class="desc headDesc">
                                            <b>여행자 보험 가입</b>이 
                                            <b>완료</b> 
                                            되었습니다.
                                        </h4>
                                        <p class="desc footDesc">
                                            
                                            <b>주말/공휴일</b> 또는 근무시간 외 접수된 가입 건에 대한 <b>가입증명서</b>는<br />
                                            <b>근무시작일</b>에 일괄 발송됩니다.
                                        </p>
                                    </div>
                                </div>
                                <div class="footArea">
                                    <ul>
                                        <li>
                                            <a href="">
                                                <div class="linkBox">
                                                    <img src="../images/common/img_signin.png" alt="가입내역조회 이미지">
                                                    <p class="desc boxDesc">가입내역 조회</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <div class="linkBox">
                                                    <img src="../images/common/img_signin.png" alt="가입내역조회 이미지">
                                                    <p class="desc boxDesc">가입내역 조회</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <div class="linkBox">
                                                    <img src="../images/common/img_signin.png" alt="가입내역조회 이미지">
                                                    <p class="desc boxDesc">가입내역 조회</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <!-- //bodyArea -->


                    </section>
                    <!-- //section -->

                    <!-- submitArea -->
                    <article class="submitArea">
                        <a href="../index.php" class="btn nextSubmit complete" title="완료">완료</a>
                    </article>
                    <!-- //submitArea -->

                    
                </div>
                <!-- //content -->
            </div>
            <!-- //contents -->
        </main>
        <!-- //main -->

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