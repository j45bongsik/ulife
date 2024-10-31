

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

                        <article class="titleArea">
                            <h3 class="title stepTitle">여행자보험 가입신청정보</h3>
                        </article>

                        <!-- bodyArea -->
                        <div class="bodyArea">

                            <!-- tableArea -->
                            <div class="tableArea">
                                <!-- table -->
                                <div class="table rowType">
                                    <table>
                                        <caption>여행자보험 가입신청정보 테이블로 상품명, 피보험자/계약자, 출발일시, 도착일시, 여행목적(지역), 인원 등의 정보를 제공합니다.</caption>
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                            <col style="width: 20%;">
                                            <col style="width: 30%;">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th scope="row">상품명</th>
                                                <td>
                                                    <div class="flexStart">
                                                        <span class="type">해외여행실손의료보험</span>
                                                        <span class="betweenCenter">-</span>
                                                        <span class="plan">고급형</span>
                                                    </div>
                                                </td>
                                                <th scope="row">피보험자/계약자</th>
                                                <td>
                                                    <span class="mainName">
                                                        홍길동
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    출발일시(출국일)
                                                </th>
                                                <td>
                                                    <span class="startDate">
                                                        2024-05-21
                                                    </span>
                                                    <span class="startHH">
                                                        00시
                                                    </span>
                                                </td>
                                                <th scope="row">
                                                    도착일시(입국일)
                                                </th>
                                                <td>
                                                    <span class="endDate">
                                                        2024-12-31
                                                    </span>
                                                    <span class="endHH">
                                                        24시
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    여행목적<br/>(지역)
                                                </th>
                                                <td>
                                                    <span class="travelPurpose">연수/출장</span>
                                                    <br />
                                                    <span class="travelCountry">(미국)</span>
                                                </td>
                                                <th scope="row">
                                                    인원(1명)
                                                </th>
                                                <td>
                                                    <span class="head">
                                                        홍길동 (950523)
                                                    </span>
                                                    <br />
                                                    <span class="price">
                                                        ￦17,280원
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="totalPrice">
                                        <ul>
                                            <li>
                                                <p class="desc">총 금액(일시납)</p>
                                            </li>
                                            <li>
                                                <p class="price counterNum">17,280</p>
                                                <span>원</span>
                                            </li>
                                        </ul>
                                        
                                    </div>
                                </div>
                                <!-- //table -->
                            </div>
                            <!-- //tableArea -->
                        </div>
                        <!-- //bodyArea -->


                    </section>
                    <!-- //section -->

                    <!-- submitArea -->
                    <article class="submitArea">
                        <a href="step_04.php" class="btn beforePage" title="이전">이전</a>
                        <label for="inputSubmit" class="btn nextSubmit" title="다음">
                            <input type="submit" id="inputSubmit" value="다음" title="다음">
                            <span class="ani"></span>
                        </label>
                    </article>
                    <!-- //submitArea -->

                    
                </div>
                <!-- //content -->
            </div>
            <!-- //contents -->

        </main>
        <!-- //main -->

        <!-- counterup.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>


        <script>

            // 숫자를 증가시켜주는 애니메이션
            $(".counterNum").counterUp({
                delay: 50,
                time: 300
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