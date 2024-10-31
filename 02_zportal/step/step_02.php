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
                    <form action="/step/step_02.php" method="post" autocomplete="off">
                        <!-- section -->
                        <section class="section step">

                            <article class="titleArea">
                                <h3 class="title stepTitle">보험료계산 결과</h3>
                            </article>

                            <!-- bodyArea -->
                            <div class="bodyArea">
                            
                                <!-- tabArea -->
                                <div class="tabArea contTab">
                                    <!-- tabList -->
                                    <ul class="tabList">
                                        <li class="active">
                                            <button type="button" class="btn">
                                                고급형<br />
                                                <span class="price">
                                                    11,250
                                                </span>
                                                <span class="betweenLeft">원</span>
                                            </button>
                                            <p class="radio">
                                                <input type="radio" name="planType" id="planType" value="highPlan" checked>
                                            </p>
                                        </li>
                                        <li>
                                            <button type="button" class="btn">
                                                표준형<br />
                                                <span class="price">
                                                    11,250
                                                </span>
                                                <span class="betweenLeft">원</span>
                                            </button>
                                            <p class="radio">
                                                <input type="radio" name="planType" id="planType" value="standardPlan">
                                            </p>
                                        </li>
                                        <li>
                                            <button type="button" class="btn">
                                                실속형<br />
                                                <span class="price">
                                                    11,250
                                                </span>
                                                <span class="betweenLeft">원</span>
                                            </button>
                                            <p class="radio">
                                                <input type="radio" name="planType" id="planType" value="lowPlan">
                                            </p>
                                        </li>
                                    </ul>
                                    <!-- //tabList -->

                                    <!-- tabCont -->
                                    <div class="tabCont active">
                                        <div class="tableArea">
                                            <div class="table">
                                                <table>
                                                    <caption>고급형 보장 테이블로 보장명 연령대별 보장금액 등의 정보를 제공합니다.</caption>
                                                    <colgroup>
                                                        <col style="width: 242px;">
                                                        <col style="width: 146px;">
                                                        <col style="width: 146px;">
                                                        <col style="width: 146px;">
                                                        <col style="width: auto;">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" rowspan="2">보장명</th>
                                                            <th scope="col" colspan="4">보장금액</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">0~14세</th>
                                                            <th scope="col">15~69세</th>
                                                            <th scope="col">70~79세</th>
                                                            <th scope="col">80~99세</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">해외여행중 상해 사망</th>
                                                            <td>-</td>
                                                            <td>3억원</td>
                                                            <td>1억원</td>
                                                            <td>5,000만원</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- //tabCont -->

                                    <!-- tabCont -->
                                    <div class="tabCont">
                                        2
                                    </div>
                                    <!-- //tabCont -->
                                    
                                    <!-- tabCont -->
                                    <div class="tabCont">
                                        3
                                    </div>
                                    <!-- //tabCont -->
                                </div>
                                <!-- //tabArea -->
                            </div>
                            <!-- //bodyArea -->


                        </section>
                        <!-- //section -->

                        <!-- submitArea -->
                        <article class="submitArea">
                            <a href="step_01.php" class="btn beforePage" title="이전">이전</a>
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