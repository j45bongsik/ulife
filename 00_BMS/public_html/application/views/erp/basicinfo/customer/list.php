<div class="conts-box">

    <div class="titleArea">
        <h1>거래처 정보</h1>
    </div>

    <!-- form -->
    <form name="searchForm" id="searchForm" method="get" action="/erpCustomerInfo">
        <!-- searchArea -->
        <article class="searchArea">
            <div class="inputArea">
                
                <label for="customer_name">
                    <input type="text" name="customer_name" id="customer_name" placeholder="거래처명" autocomplete='off' value="">
                </label>
                <label for="customer_admin">
                    <input type="text" name="customer_admin" id="customer_admin" placeholder="담당자명" autocomplete='off' value="">
                </label>

                <label for="customer_nate">
                    <input type="text" name="customer_nate" id="customer_nate" placeholder="네이트온명" autocomplete='off' value="">
                </label>

                <!-- inputBox -->
                <div class="inputBox">
                    <label for="inputSearch">
                        <i class="ico search"></i>
                        <input type="submit" id="inputSearch" class="btn search" value="검색" title="검색">
                    </label>
                </div>
                <!-- //inputBox -->
            </div>
            
            <!-- btnArea -->
            <div class="btnArea">
                <a href="" download class="btn file">엑셀다운</a>
                <a href="/erpCustomerInfo_reg" class="btn file">거래처추가</a>
            </div>
            <!-- //btnArea -->
        </article>
        <!-- //searchArea -->
    </form>
    <!-- //form -->

    <!-- memb-table -->
    <article class="memb-table erpList link array">
        <table>
            <caption>
                거래처정보 테이블로 순번, 매집, 거래처명, 정산, 보험사ID, 거래처담당, 연락처, 이메일, 네이트온명, 지정담당 등의 정보를 제공합니다.
            </caption>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: 70px;">
                <col style="width: 120px;">
                <col style="width: 40px;">
                <col style="width: 150px;">
                <col style="width: 70px;">
                <col style="width: 120px;">
                <col style="width: 120px;">
                <col style="width: 70px;">
                <col style="width: 70px;">
                <col style="width: 70px;">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">매집</th>
                    <th scope="col">거래처명</th>
                    <th scope="col">정산</th>
                    <th scope="col">보험사ID</th>
                    <th scope="col">거래처담당</th>
                    <th scope="col">연락처</th>
                    <th scope="col">이메일</th>
                    <th scope="col">네이트온명</th>
                    <th scope="col">지정담당</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>99999</td>
                    <td>첫번째이름</td>
                    <td>첫번째여행사</td>
                    <td>M</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance db">D</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910첫번째</span>
                        </div>
                    </td>
                    <td>첫번째이름</td>
                    <td>010-1234-5678첫번째</td>
                    <td>length.length@naver.com첫번째</td>
                    <td>첫번째이름</td>
                    <td>첫번째이름</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
                <tr>
                    <td>88888</td>
                    <td>두번째이름</td>
                    <td>두번째여행사</td>
                    <td>D</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance hd">H</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910두번째</span>
                        </div>
                    </td>
                    <td>두번째다섯자</td>
                    <td>070-0070-0700두번째</td>
                    <td>value.value@naver.com두번째</td>
                    <td>두번째</td>
                    <td>두번째</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
                <tr>
                    <td>77777</td>
                    <td>세번째이름</td>
                    <td>세번째여행사</td>
                    <td>D</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance meritz">M</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910세번째</span>
                        </div>
                    </td>
                    <td>세번째</td>
                    <td>070-0070-0700세번째</td>
                    <td>value.value@naver.com세번째</td>
                    <td>세번째</td>
                    <td>세번째</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
                <tr>
                    <td>66666</td>
                    <td>네번째이름</td>
                    <td>네번째여행사</td>
                    <td>D</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance samsung">S</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910네번째</span>
                        </div>

                    </td>
                    <td>네번째</td>
                    <td>070-0070-0700네번째</td>
                    <td>value.value@naver.com네번째</td>
                    <td>네번째</td>
                    <td>네번째</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
                <tr>
                    <td>55555</td>
                    <td>다섯번째이름</td>
                    <td>다섯번째여행사</td>
                    <td>D</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance chubb">C</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910다섯번째</span>
                        </div>

                    </td>
                    <td>다섯번째</td>
                    <td>070-0070-0700다섯번째</td>
                    <td>value.value@naver.com다섯번째</td>
                    <td>다섯번째</td>
                    <td>다섯번째</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
                <tr>
                    <td>55555</td>
                    <td>여섯번째이름</td>
                    <td>여섯번째여행사</td>
                    <td>D</td>
                    <td>
                        <div class="insuranceTypeArea">
                            <i class="ico insurance mg">M</i>
                            <span class="between">:</span>
                            <span class="insuranceCont">ABC12345678910여섯번째</span>
                        </div>
                    </td>
                    <td>여섯번째</td>
                    <td>070-0070-0700여섯번째</td>
                    <td>value.value@naver.com여섯번째</td>
                    <td>여섯번째</td>
                    <td>여섯번째</td>
                    <td class="edit">
                        <!-- <button type="button" class="btn lineEdit">수정</button> -->
                        <a href="#" class="btn lineEdit">수정</a>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="sumArea">
            <div class="inner">
                <div class="insuranceTypeArea">
                    <i class="ico insurance db">D</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">DB손해보험</span>
                </div>

                <div class="insuranceTypeArea">
                    <i class="ico insurance hd">H</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">현대해상</span>
                </div>

                <div class="insuranceTypeArea">
                    <i class="ico insurance meritz">M</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">메리츠화재</span>
                </div>

                <div class="insuranceTypeArea">
                    <i class="ico insurance samsung">S</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">삼성화재</span>
                </div>

                <div class="insuranceTypeArea">
                    <i class="ico insurance chubb">C</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">CHUBB</span>
                </div>

                <div class="insuranceTypeArea">
                    <i class="ico insurance mg">M</i>
                    <span class="between">:</span>
                    <span class="insuranceCont">MG손해보험</span>
                </div>
            </div>
        </div>
    </article>
    <!-- //memb-table -->

    <!-- paginate -->
    <div class="paginate">
        <a href="" rel="start"><i class="prev-arrow-double"></i></a>
        <a href="" rel="prev"><i class="prev-arrow"></i></a>
        <a href="">1</a>
        <strong>2</strong>
        <a href="">3</a>
        <a href="" rel="next"><i class="next-arrow"></i></a>
        <a href="" rel="last"><i class="next-arrow-double"></i></a>
    </div>
    <!-- //paginate -->

    <!-- aside -->
    <!-- asideOpen 클래스 삭제해주세요 -->
    <aside class="aside asideOpen">
        <button type="button" class="btn asideBtn" id="asideBtn" title="상세정보 열기">
            <span></span>
        </button>
        <div class="titleArea">
            <h2 class="title thirdTitle" id="customerName">-</h2>
        </div>
        <article class="asideArea">
            
            <!-- asideCont -->
            <div class="asideCont">
                <div class="titleArea">
                    <h3 class="title chartTitle">기본정보</h3>
                </div>
                <!-- erpList -->
                <div class="erpList reg">
                    <table>
                        <caption>
                            기본정보 테이블로 보험사ID, 거래처담당자, 연락처, 이메일, 네이트온명 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width:18%;">
                            <col style="width:32%;">
                            <col style="width:18%;">
                            <col style="width:32%;">
                        </colgroup>
                        <tbody>
                            
                            <tr>
                                <th scope="row">
                                    보험사<br />ID
                                </th>
                                <td id="insuranceId">-</td>

                                <th scope="row">
                                    거래처<br />담당자
                                </th>
                                <td id="customerAdmin">-</td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    연락처
                                </th>
                                <td id="tel">-</td>

                                <th scope="row">
                                    이메일
                                </th>
                                <td id="email">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //erpList -->
            </div>
            <!-- //asideCont -->

            <!-- asideCont -->
            <div class="asideCont">
                <div class="titleArea">
                    <h3 class="title chartTitle">주 사용 플랜</h3>
                </div>
                <!-- erpList -->
                <div class="memb-table erpList">
                    <table>
                        <caption>
                            주 사용 플랜 게시물로 국내플랜, 해외플랜 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width:50%;">
                            <col style="width:50%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">국내</th>
                                <th scope="col">해외</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="through">추가된 국내 플랜이 없습니다.</td>
                                <td class="through">추가된 해외 플랜이 없습니다.</td>
                            </tr>
                            <tr>
                                <td id="customerAdmin">
                                    <span>DB손해보험</span>
                                    <span class="between">:</span>
                                    <span>T03 (사망 1억)</span>
                                </td>
                                <td id="customerAdmin">
                                    <span>메리츠 화재</span>
                                    <span class="between">:</span>
                                    <span>T03 (사망 1억)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //erpList -->
                <div class="inputBox">
                    <button type="button" class="btn search openModalBtn">플랜 추가</button>
                </div>
            </div>
            <!-- //asideCont -->

            <!-- asideCont -->
            <div class="asideCont">
                <div class="titleArea">
                    <h3 class="title chartTitle">정산정보</h3>
                </div>
                <!-- erpList -->
                <div class="erpList reg">
                    <table>
                        <caption>
                            정산정보 테이블로 인보이스, 매집발행, 정산주기, 커미션 지급일, 결제정보, 세금계산서 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width:18%;">
                            <col style="width:32%;">
                            <col style="width:18%;">
                            <col style="width:32%;">
                        </colgroup>
                        <tbody>
                            
                            <tr>
                                <th scope="row">
                                    인보이스
                                </th>
                                <td>-</td>

                                <th scope="row">
                                    매집발행
                                </th>
                                <td id="accumulate">-</td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    정산주기
                                </th>
                                <td id="settleType">-</td>

                                <th scope="row">
                                    커미션<br />지급일
                                </th>
                                <td id="">-</td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    결제정보
                                </th>
                                <td id="">-</td>

                                <th scope="row">
                                    세금<br />계산서
                                </th>
                                <td id="">-</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- //erpList -->
            </div>
            <!-- //asideCont -->

            <!-- asideCont -->
            <div class="asideCont">
                <!-- form -->
                <form name="issueForm" id="issueForm" method="get" action="/erpCustomerInfo">
                    <div class="titleArea">
                        <h3 class="title chartTitle">특이사항</h3>
                    </div>
                    
                    <div class="textArea">
                        <textarea name="add_issue" id="add_issue" class="textarea1" placeholder="특이사항을 입력하세요."></textarea>
                    </div>

                    <div class="inputBox">
                        <label for="issueAdd">
                            <input type="submit" id="issueAdd" class="btn search" value="저장" title="저장">
                        </label>
                    </div>
                </form>
                <!-- //form -->
            </div>
            <!-- //asideCont -->

            <!-- asideCont -->
            <div class="asideCont">
                <!-- form -->
                <form name="historyForm" id="historyForm" method="get" action="/erpCustomerInfo">
                    <div class="titleArea">
                        <h3 class="title chartTitle">처리내역</h3>
                    </div>
                    <div class="checkArea">
                        <!-- radiobox -->
                        <div class="radiobox">
                            <input type="radio" name="contactType" class="radio-custom" value="messenger" id="contactType01" checked>
                            <label for="contactType01" class="radio-custom-label">메신저</label>
                        </div>
                        <!-- //radiobox -->

                        <!-- radiobox -->
                        <div class="radiobox">
                            <input type="radio" name="contactType" class="radio-custom" value="tel" id="contactType02">
                            <label for="contactType02" class="radio-custom-label">전화</label>
                        </div>
                        <!-- //radiobox -->

                        <!-- radiobox -->
                        <div class="radiobox">
                            <input type="radio" name="contactType" class="radio-custom" value="email" id="contactType03">
                            <label for="contactType03" class="radio-custom-label">이메일</label>
                        </div>
                        <!-- //radiobox -->
                    </div>

                    <div class="textArea">
                        <textarea name="add_history" id="add_history" class="textarea1" placeholder="처리내역을 입력하세요."></textarea>
                    </div>
                    
                    <div class="inputBox">
                        <label for="historyAdd">
                            <input type="submit" id="historyAdd" class="btn search" value="저장" title="저장">
                        </label>
                    </div>
                </form>
                <!-- //form -->
            </div>
            <!-- //asideCont -->
            
            <!-- asideCont -->
            <div class="asideCont">
                <div class="titleArea">
                    <h3 class="title chartTitle">히스토리</h3>
                </div>
                
                <article class="historyArea">
                    <div class="btnArea">
                        <!-- 선택된 태그에 active 클래스 추가 나머지는 삭제 -->
                        <button type="button" class="btn file active">전체</button>
                        <button type="button" class="btn file">담당자1</button>
                        <button type="button" class="btn file">담당자2</button>
                        <button type="button" class="btn file">담당자3</button>
                    </div>
                    <!-- columnArea -->
                    <div class="columnArea">
                        <ul>
                            <!-- messenger -->
                            <li class="messenger">
                                <div class="columnBox">
                                    <p class="typeDate">
                                        <span class="type">Messenger</span>
                                        <span class="between">:</span>
                                        <span class="date">2024-12-31 12:07 PM</span>
                                    </p>
                                    <p class="historyCont">
                                        입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 입금계좌 변경 
                                    </p>
                                    <p class="historyRegAdmin">
                                        <span>작성자</span>
                                        <span class="between">:</span>
                                        <span class="admin">권기형</span>
                                    </p>
                                </div>
                            </li>
                            <!-- //messenger -->
                            <!-- tel -->
                            <li class="tel">
                                <div class="columnBox">
                                    <p class="typeDate">
                                        <span class="type">Call</span>
                                        <span class="between">:</span>
                                        <span class="date">2024-12-31 12:07 PM</span>
                                    </p>
                                    <p class="historyCont">
                                        입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경입금계좌변경
                                    </p>
                                    <p class="historyRegAdmin">
                                        <span>작성자</span>
                                        <span class="between">:</span>
                                        <span class="admin">권기형</span>
                                    </p>
                                </div>
                            </li>
                            <!-- //tel -->
                            <!-- email -->
                            <li class="email">
                                <div class="columnBox">
                                    <p class="typeDate">
                                        <span class="type">Email</span>
                                        <span class="between">:</span>
                                        <span class="date">2024-12-31 12:07 PM</span>
                                    </p>
                                    <p class="historyCont">
                                        입금계좌 변경
                                    </p>
                                    <p class="historyRegAdmin">
                                        <span>작성자</span>
                                        <span class="between">:</span>
                                        <span class="admin">권기형</span>
                                    </p>
                                </div>
                            </li>
                            <!-- //email -->
                            <li class="dataStart">
                                <div class="columnBox">
                                    <p class="typeDate">
                                        <span>시작일</span>
                                        <span class="between">:</span>
                                        <span class="date">1984-01-01 00:01 AM</span>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- //columnArea -->
                </article>  
            </div>
            <!-- //asideCont -->
            
            
        </article>
    </aside>
    <!-- //aside -->

    <!-- /** 모달창_주사용 플랜 -->

    <!--속성,속성값 삭제해주세요 style="display: flex;" -->
    <div id="myModal" class="modal" style="display: flex;">
        <div class="modal-content">
            <!-- form -->
            <form id="mainlyPlanModal" name="mainlyPlanModal" >
                <div class="close closeModalBtn">
                    <span class="x-top"></span>
                    <span class="x-bottom"></span>
                </div>
                <h4>주사용 플랜</h4>
                <div class="modal-form">
                    <div class="table modalList">
                        <span class="essential type02">* 국내/해외 각각 3개까지 추가 가능합니다.</span>
                        <table>
                            <caption>
                                주사용 플랜 테이블로 구분, 보험사, 상품, 플랜을 선택해서 추가할수 있다.
                            </caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 75%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <label for="planDivision" class="essential">
                                            구분
                                        </label>
                                    </th>
                                    <td>
                                        <!-- select-custom -->
                                        <div class="select-custom">
                                            <select name="planDivision" id="planDivision" class="planSelect">
                                                <option value="" selected>선택</option>
                                                <option value="domestic">국내</option>
                                                <option value="overseas">해외</option>
                                            </select>
                                        </div>
                                        <!-- //select-custom -->
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">
                                        <label for="planCompany" class="essential">
                                            보험사
                                        </label>
                                    </th>
                                    <td>
                                        <!-- select-custom -->
                                        <div class="select-custom">
                                            <select name="planCompany" id="planCompany" class="planSelect">
                                                <option value="" selected>선택</option>
                                                <option value="db">DB손해보험</option>
                                                <option value="hd">현대해상</option>
                                                <option value="meritz">메리츠화재</option>
                                                <option value="samsung">삼성화재</option>
                                                <option value="chubb">CHUBB</option>
                                                <option value="mg">MG손해보험</option>
                                            </select>
                                        </div>
                                        <!-- //select-custom -->
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <label for="planProduct" class="essential">
                                            상품
                                        </label>
                                    </th>
                                    <td>
                                        <!-- select-custom -->
                                        <div class="select-custom">
                                            <select name="planProduct" id="planProduct" class="planSelect">
                                                <option value="" selected>선택</option>
                                                <option value="product01">상품1</option>
                                                <option value="product02">상품2</option>
                                                <option value="product03">상품3</option>
                                            </select>
                                        </div>
                                        <!-- //select-custom -->
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <label for="planType" class="essential">
                                            플랜
                                        </label>
                                    </th>
                                    <td>
                                        <!-- select-custom -->
                                        <div class="select-custom">
                                            <select name="planType" id="planType" class="planSelect">
                                                <option value="">선택</option>
                                                <option value="t5">T5(사망1억)</option>
                                                <option value="a3">A3(사망2억)</option>
                                                <option value="x6">X6(사망12억)</option>
                                            </select>
                                        </div>
                                        <!-- //select-custom -->
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        
                        <div class="modalBtn">
                            <button type="button" id="mainlyPlanAdd" class="btn file">추가</button>  
                        </div>

                        <div class="planResult">
                            <ul>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="modalBtn">
                        
                        <button type="submit" id="mainlyPlanSave" class="button">저장</button>  
                        <button type="button" class="button closeModalBtn">닫기</button>
                    </div>
                </div>
            </form>
            <!-- //form -->
        </div>
    </div>

    <script>
        // tr 클릭시 값을 찾아 배열에 담아 aside 지정한곳에 추가
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.erpList.array table tr td:not(.edit)').forEach(function(trTags) {
                trTags.addEventListener('click', function(event) {
                    let customerArray = [];

                    let trTag = this.closest('tr');
                    trTag.querySelectorAll('td').forEach(function(td, index) {
                        let text = td.innerText.trim();
                        let propertyName;
                        switch(index) {
                            case 0:
                                propertyName = 'number';
                                break;
                            case 1:
                                propertyName = 'accumulate';
                                break;
                            case 2:
                                propertyName = 'customerName';
                                break;
                            case 3:
                                propertyName = 'settleType';
                                break;
                            case 4:
                                propertyName = 'insuranceId';
                                break;
                            case 5:
                                propertyName = 'customerAdmin';
                                break;
                            case 6:
                                propertyName = 'tel';
                                break;
                            case 7:
                                propertyName = 'email';
                                break;
                            case 8:
                                propertyName = 'nateName';
                                break;
                            case 9:
                                propertyName = 'companyManager';
                                break;
                            default:
                                propertyName = '';
                        }
                        if (propertyName) {
                            customerArray.push({ [propertyName]: text });
                            let element = document.getElementById(propertyName);
                            if (element) element.textContent = text;
                        }
                    });

                    let aside = document.querySelector('.aside')
                    aside.classList.add('asideOpen');
                });
            });
        });

        // aside on&off
        document.getElementById('asideBtn').addEventListener('click', function(event){
            let asideBtn = event.target;
            let asideArea = asideBtn.closest('.aside')

            if (asideBtn.tagName.toLowerCase() === 'button' && asideBtn.classList.contains('asideBtn')) {
                toggleAction02(asideArea, asideBtn)
                
            } else if (asideBtn.tagName.toLowerCase() === 'span' && asideBtn.closest('.asideBtn')) {
                toggleAction02(asideArea, asideBtn.closest('.asideBtn'))
            }

            function toggleAction02(asideArea, asideBtn) {
                if (asideArea.classList.contains('asideOpen')) {
                    asideArea.classList.remove('asideOpen');
                    asideBtn.setAttribute('title', '상세정보 열기')
                } else {
                    asideArea.classList.add('asideOpen')
                    asideBtn.setAttribute('title', '상세정보 닫기')
                }
            }
        })

        // 지정영역 외 클릭시 aside off
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.memb-table.erpList') && !event.target.closest('.modal') && !event.target.closest('.aside') && !event.target.closest('.asideBtn')) {
                let asideArea = document.querySelector('.aside');
                let asideBtn = asideArea.querySelector('.asideBtn')
                asideArea.classList.remove('asideOpen');
                asideBtn.setAttribute('title', '상세정보 열기')
            }
        });
        
        // aside 상세정보 히스토리영역 버튼 이벤트
        document.querySelectorAll('.asideCont .btn.file').forEach(function(historyBtns){
            historyBtns.addEventListener('click', function(event){
                let clickBtn = event.target;
                let btnArea = clickBtn.closest('.btnArea');
                let btnTags = btnArea.querySelectorAll('.btn.file')

                for(var i = 0; i < btnTags.length; i++) {
                    btnTags[i].classList.remove('active');
                }

                clickBtn.classList.add('active');
            })
        })

        // 모달 열기 버튼 클릭 시
        document.querySelectorAll('.openModalBtn').forEach(function(opens){
            opens.addEventListener('click', function(event){
                document.getElementById("myModal").style.display = "flex";
                document.getElementById('planDivision').focus();
            })
        })

        // 모달 닫기 버튼 클릭 시
        document.querySelectorAll(".closeModalBtn").forEach(function(closes){
            closes.addEventListener("click", function() {
                document.getElementById("myModal").style.display = "none";
                
                // select 요소를 초기화
                document.querySelectorAll('.planSelect').forEach(function(planSelect) {
                    planSelect.selectedIndex = 0;
                });

                // 배열 초기화
                planSelectArray = [];
            });
        })

        // 모달 바깥 영역 클릭 시 모달 닫기
        window.addEventListener("click", function(event) {
            var modal = document.getElementById("myModal");
            if (event.target === modal) {
                modal.style.display = "none";

                // select 요소를 초기화
                document.querySelectorAll('.planSelect').forEach(function(planSelect) {
                    planSelect.selectedIndex = 0;
                });

                // 배열 초기화
                planSelectArray = [];
            }
        });

        // 모달 select 선택시 list삽입 및 inputhidden에 담기
        let planSelectArray = [];

        // 모달 각 select 요소에 대해 이벤트 리스너를 등록.
        document.querySelectorAll('.planSelect').forEach(function(planSelect) {
            planSelect.addEventListener('change', function(event) {
                // 엘리먼트 및 값 추적
                let selectTag = event.target;
                let selectText = selectTag.options[selectTag.selectedIndex].innerText;
                let selectValue = selectTag.options[selectTag.selectedIndex].value;

                let propertyName = selectTag.getAttribute('name');
                
                // 배열의 길이를 최소한 4로 설정
                while (planSelectArray.length < 4) {
                    planSelectArray.push(null); // 또는 다른 기본 값
                }

                

                // select option innerText "선택"이 아닌 경우에만 배열에 추가.
                if (selectText !== "선택") {
                    if(propertyName) {
                        let newArrayElement = { [propertyName]: {text: selectText, value: selectValue} };
                        // 기존에 같은 propertyName이 있다면 해당 값을 갱신.
                        let existingIndex = planSelectArray.findIndex(item => item && Object.keys(item)[0] === propertyName);
                        if(existingIndex !== -1) {
                            planSelectArray[existingIndex] = newArrayElement;
                        } else {
                            // 새로운 값이 선택된 경우, 해당 위치에 추가.
                            if (propertyName === 'planDivision') {
                                // 구분은 첫번째에 추가
                                planSelectArray[0] = newArrayElement;
                            } else if (propertyName === 'planCompany') {
                                // 보험사는 두번째에 추가
                                planSelectArray[1] = newArrayElement;
                            }  else if (propertyName === 'planProduct') {
                                // 상품은 세번째에 추가
                                planSelectArray[2] = newArrayElement;
                            } else if (propertyName === 'planType') {
                                // 플랜은 네번째에 추가
                                planSelectArray[3] = newArrayElement;
                            }
                        }
                    }
                } else {
                    // 선택된 값이 "선택"인 경우 해당 배열 위치를 null로 설정
                    if (propertyName) {
                        if (propertyName === 'planDivision') {
                            planSelectArray[0] = null;
                        } else if (propertyName === 'planCompany') {
                            planSelectArray[1] = null;
                        } else if (propertyName === 'planProduct') {
                            planSelectArray[2] = null;
                        } else if (propertyName === 'planType') {
                            planSelectArray[3] = null;
                        }
                    }
                }
            });
        });

        // 추가 버튼 클릭시 li를 포함한 하위태그 생성
        document.getElementById('mainlyPlanAdd').addEventListener('click', function() {
            // li 생성
            let liElement = document.createElement('li');

            // hiddenBox 생성
            let hiddenBox = document.createElement('div');
            hiddenBox.className = 'hiddenBox';
            liElement.appendChild(hiddenBox); // 생성된 li 자식으로 추가
        
            // resultBox 생성
            let resultBox = document.createElement('div');
            resultBox.className = 'resultBox';
            liElement.appendChild(resultBox); // 생성된 li 자식으로 추가

            // 배열이 비어있는지 확인하기 위해 null의 갯수를 구함
            let nullCount = planSelectArray.filter(item => item === null).length;

            // select 갯수만큼 선택하지 않은경우 4 = select의 갯수 or 배열의 null의 갯수가 0보다 큰경우
            if (planSelectArray.length < 4 || nullCount > 0) {
                alert('추가할 플랜을 선택해 주세요.')
            
            // 추가된 배열의 length의 갯수만큼
            } else if(nullCount == 0) {
                // 배열의 length만큼 반복
                for (var i = 0; i < planSelectArray.length; i++) {
                    // i번째 인덱스에 해당하는 요소를 가져와서 할당 (select의 갯수와 동일)
                    var resultArray = planSelectArray[i]; 
                    
                    // resultArray 객체의 모든 속성을 반복하며, 각 속성의 이름을 propertyName 변수에 순차적으로 할당
                    // 순차적으로 할당
                    for (var propertyName in resultArray) {
                        if (resultArray.hasOwnProperty(propertyName)) {
                            var hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.id = propertyName;
                            hiddenInput.name = propertyName;
                            hiddenInput.value = resultArray[propertyName].value;
                            hiddenBox.appendChild(hiddenInput);
                        }
                    }

                    // resultArray 객체의 모든 속성을 반복하며, 각 속성의 이름을 propertyName 변수에 순차적으로 할당
                    // 순차적으로 할당
                    for (var propertyName in resultArray) {
                        if (resultArray.hasOwnProperty(propertyName)) {
                            var pElement = document.createElement('p');
                            pElement.className = propertyName;
                            pElement.textContent = resultArray[propertyName].text;
                            resultBox.appendChild(pElement);
                        }
                    }
                }

                // 국내플랜 해외플랜 3개씩 추가하기위한 엘리먼트 추적
                let planDivisionSelect = document.getElementById('planDivision');
                let planDivisionSelectValue = planDivisionSelect.value;
                let planResult = document.querySelector('.planResult')

                // 추가사항으로 .fileDelete button에 타이틀 추가 하기위한 엘리먼트 추적
                let planCompanySelect = document.getElementById('planCompany');
                let planProductSelect = document.getElementById('planProduct');
                let planTypeSelect = document.getElementById('planType');

                let planDivisionSelectText = planDivisionSelect.options[planDivisionSelect.selectedIndex].text; // 구분
                let planCompanySelectText = planCompanySelect.options[planCompanySelect.selectedIndex].text; // 보험사
                let planProductSelectText = planProductSelect.options[planProductSelect.selectedIndex].text; // 상품
                let planTypeSelectText = planTypeSelect.options[planTypeSelect.selectedIndex].text; // 플랜

                // domestic일때
                if(planDivisionSelectValue === 'domestic') {
                    let domestic = planResult.querySelectorAll('input[value="domestic"]')
                    
                    if (domestic.length >= 3) {
                        alert('국내 플랜은 최대 3개까지 추가할 수 있습니다.');
                            
                        // select 엘리먼트 추적해서 option을 "선택" 으로 변경
                        let planSelects = document.querySelectorAll('.planSelect')
                        planSelects.forEach(function(planSelect){
                            planSelect.selectedIndex = 0;
                        })

                        // 배열을 안비우면 추가버튼을 다시 클릭하면 추가 되기에 배열을 비움
                        planSelectArray = [];
                        
                        return; // domestic 3이상이면 실행 중단
                    }
                // overseas일때
                } else if (planDivisionSelectValue === 'overseas') {
                    let overseas = planResult.querySelectorAll('input[value="overseas"]')

                    if (overseas.length >= 3) {
                        alert('해외 플랜은 최대 3개까지 추가할 수 있습니다.');
                            
                        // select 엘리먼트 추적해서 option을 "선택" 으로 변경
                        let planSelects = document.querySelectorAll('.planSelect')
                        planSelects.forEach(function(planSelect){
                            planSelect.selectedIndex = 0;
                        })

                        // 배열을 안비우면 추가버튼을 다시 클릭하면 추가 되기에 배열을 비움
                        planSelectArray = [];
                        
                        return; // overseas 3이상이면 실행 중단
                    }
                }

                // 추가된 후 배열을 비움
                planSelectArray = [];

                // select 엘리먼트 추적해서 option을 "선택" 으로 변경
                let planSelects = document.querySelectorAll('.planSelect')
                planSelects.forEach(function(planSelect){
                    planSelect.selectedIndex = 0;
                })

                // planDivisionSelectText // 구분
                // planCompanySelectText // 보험사
                // planProductSelectText // 상품
                // planTypeSelectText // 플랜
                
                // .fileDelete button 태그 추가
                var fileDeleteButton = document.createElement('button');
                fileDeleteButton.type = 'button';
                fileDeleteButton.className = 'btn fileDelete';
                fileDeleteButton.setAttribute('title', '' +planDivisionSelectText+ '/' +planCompanySelectText+ '/' +planProductSelectText+ '/' +planTypeSelectText+ ' 삭제')
                liElement.appendChild(fileDeleteButton);
                
                //엘리먼트 추적
                var ulElement = document.querySelector('.planResult ul');
                if (ulElement.children.length >= 6) {
                    alert('최대 6개까지만 추가할 수 있습니다.');
                
                    // li의 갯수가 6개 이하일때
                } else {
                    // input[type="hidden"] 태그의
                    // id와 name 중복되지않도록 li의 index값을 +
                    var liIndex = ulElement.children.length;
                    var hiddenInputs = liElement.querySelectorAll('.hiddenBox input[type="hidden"]');
                    hiddenInputs.forEach(function(hiddenInput) {
                        hiddenInput.id += liIndex;
                        hiddenInput.name += liIndex;
                    });

                    // li가 추가 될때 input[type="hidden"] value값이 같은 쌍이 있으면
                    // 추가 되지 않도록 그렇지 않으면 추가 되도록
                    var lis = ulElement.querySelectorAll('li');
                    var allSame = false;
                    for (var j = 0; j < lis.length; j++) {
                        var currentHiddenInputs = lis[j].querySelectorAll('.hiddenBox input[type="hidden"]');
                        var newHiddenInputs = hiddenBox.querySelectorAll('input[type="hidden"]');
                        allSame = true;
                        for (var k = 0; k < currentHiddenInputs.length; k++) {
                            if (currentHiddenInputs[k].value !== newHiddenInputs[k].value) {
                                allSame = false;
                                break;
                            }
                        }
                        if (allSame) {
                            alert('이미 선택된 플랜입니다.');
                            break;
                        }
                    }
                    if (!allSame) {
                        ulElement.appendChild(liElement);
                    }
                }
            }
        });

        
        // 저장 버튼을 누를때 추가된 플랜이 없을때(li가 0일때) submit 기능 막기
        document.getElementById('mainlyPlanSave').addEventListener('click', function(){
            let planResultUl = document.querySelector('.planResult ul');
            let planResultLis = planResultUl.querySelectorAll('li')
            
            if (planResultLis.length === 0) {
                event.preventDefault();
                alert("추가된 플랜이 없습니다")
            }
        })

        // fileDelete 클래스가 있으면 = fileDelete를 클릭하면
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fileDelete')) {
                // 가장 근접한 부모 li를 찾고
                let targetLi = event.target.closest('li');
                // 유효하면
                if (targetLi) {
                    // 현재 클릭된 요소를 기준 li의 index를 구함
                    let liIndex = [...targetLi.parentElement.children].indexOf(targetLi);
                    
                    // 근접한 li를 삭제
                    targetLi.remove();

                    // 엘리먼트 추적 
                    let planResultUl = document.querySelector('.planResult ul');
                    let planResultLis = planResultUl.querySelectorAll('li');

                    // 현재 생성된 li의 갯수만큼 반복
                    planResultLis.forEach(function(li, index) {
                        // 엘리먼트 추적
                        let hiddenInputs = li.querySelectorAll('.hiddenBox input[type="hidden"]');
                        
                        // input 갯수만큼 반복(4)
                        hiddenInputs.forEach(function(hiddenInput) {
                            // name 속성값에서 숫자부분을 제거한 새로운 문자열을 할당 = 문자열은 그대로 두고 숫자는 삭제
                            let propertyName = hiddenInput.getAttribute('name').replace(/\d+$/, '');
                            
                            // li가 삭제될때 index 순번에 맞추기 위해 재 설정된다
                            hiddenInput.id = propertyName + index;
                            hiddenInput.name = propertyName + index;
                        });
                    });
                }
            }
        });


    </script>

</div>
