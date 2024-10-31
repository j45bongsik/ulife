<!-- 
.modalOpen 클래스가 있는 태그의 id를 가져와
열고자하는 layerPopup의 id를 매칭시켜 해당 팝업을 오픈한다

ex ) 
.modalOepn의 id=test
열고자 하는 layerPopup의 id=testLayerPopup
test + LayerPopup 오픈 

모달 기본 구성(.default)은 .inner 하위의 .headArea와 .bodyArea로 구성된다
.bodyArea 하위의 각각의 components로 작성해서 style한다
-->

<!-- 알아두실 사항 -->
<article id="insuranceInfoLayerPopup" class="layerPopup">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="utilArea">
                <button type="button" class="btn modalClose black" title="닫기"></button>
            </div>
            <div class="titleArea">
                <h3 class="title insuranceInfoTitle">해외여행보험</h3>
                <div class="logoArea">
                    <img src="../images/common/img_logo_meritz.png" alt="메리츠화재 로고">
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">
            <!-- tabArea -->
            <article class="tabArea">
                <!-- tabList -->
                <ul class="tabList">
                    <li>
                        <button type="button" class="btn">상품설명</button>
                    </li>
                    <li>
                        <button type="button" class="btn">보장내용</button>
                    </li>
                    <li class="active">
                        <button type="button" class="btn">알아두실 내용</button>
                    </li>
                </ul>
                <!-- //tabList -->
                <div class="tabCont">
                    1
                </div>
                <div class="tabCont">
                    2
                </div>

                <!-- tabCont -->
                <div class="tabCont active">
                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">보험 가입 전 유의사항</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        보험계약 청약 시에는 보험상품명, 보험기간, 보험료, 보험료납입기간, 피보험자 등을 반드시 확인하시고, 보험약관을 반드시 수령•설명 받으시기 바랍니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        계약 체결 전 자세한 내용은 상품설명서와 약관을 참조하시기 바랍니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        ㈜비아이에스은 다수의 보험사와 계약체결을 대리/중개하는 보험대리점입니다. 보험계약 체결권한은 유라이프대리점에게 있지 않고, 보험사에 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        지급한도, 면책사항 등에 따라 보험금 지급이 제한될 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">가입자의 계약 전 알릴 의무</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        계약자 또는 피보험자는 보험계약 청약 시 과거의 건강 상태, 직업 등 청약서(전자문서 포함)의 질문한 사항에 대하여 알고 있는 내용을 반드시 사실대로 알려야 하며(청약서 또는 전자청약서에 기재), 그렇지 않은 경우 보험금의 지급이 거절되거나 계약이 해지될 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">가입자의 계약 후 알릴 의무</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        계약자 또는 피보험자는 보험계약을 맺은 후 보험약관에 정한 계약 후 알릴 의무사항이 발생하였을 경우 지체 없이 회사에 알려야 합니다. 그렇지 않을 경우 보험금 지급이 거절되거나 계약이 해지될 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">예금자보호 안내</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        이 보험계약은 예금자보호법에 따라 예금보험공사가 보호하되, 보호 한도는 본 보험회사에 있는 귀하의 모든 예금보호대상 금융상품의 해약환급금(또는 만기시 보험금이나 사고보험금)에 기타지급금을 합하여 1인당 “최고 5천만원”이며, 5천만원을 초과하는 나머지 금액은 보호하지 않습니다. 다만, 보험계약자 및 보험료 납부자가 법인인 보험계약은 예금자보호법에 따라 예금보험공사가 보호하지 않습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">보험계약 해지 후 다른 보험 계약시 유의사항</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        보험계약자가 기존 보험계약을 해지하고 새로운 보험 계약을 체결하는 경우 보험 인수가 거절되거나 보험료가 인상될 수 있으며 보장내용(면책기간 재적용 등)이 달라질 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">보험금 지급 유의사항</h4>
                        </div>
                        <div class="contArea">
                            <ul class="numLine">
                                <li>
                                    <p>
                                        피보험자/보험수익자/계약자의 고의로 인한 보험사고는 보장하지 않습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        전쟁, 외국의 무력행사, 혁명, 내란, 사변, 폭동으로 인한 손해는 보장하지 않습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        직업, 직무 또는 동호회 활동목적으로 아래에 열거된 행위를 하는 동안에 발생한 사고로 인한 의료비는 지급하지 않습니다.
                                    </p>
                                    <ul class="secondLine">
                                        <li>
                                            <p>
                                                ① 전문등반, 글라이더 조종, 스카이다이빙, 스쿠버다이빙, 수상보트, 행글 라이딩, 패러글라이딩
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                ② 모터보트, 자동차 또는 오토바이에 의한 경기, 시범, 흥행 (연습 포함) 또는 시운전
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                ③ 선박승무원, 어부, 사공, 그밖에 선박에 탑승하는 것을 직무로 하는 사람 이 직무상 선박에 탑승하여 얻은 사고
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">청약철회</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        계약자는 보험증권을 받은 날부터 15일 이내에 그 청약을 철회할 수 있습니다. 다만, 의무보험의 경우에는 철회의사를 표시한 시점에 동종의 다른 의무보험에 가입된 경우에만 철회할 수 있으며, 보험기간이 90일 이내인 계약 또는 전문금융소비자가 체결한 계약은 청약을 철회할 수 없습니다. 단 청약한 날부터 30일이 초과된 계약은 청약을 철회할 수 없습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        계약의 해지 및 보험료의 환급
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        해약환급금이 이미 납부한 보험료보다 적거나 없을 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">품질보증제도</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        제공될 약관 및 계약자 보관용 청약서를 청약할 때 계약자에게 전달하지 않거나 약관의 중요한 내용을 설명하지 않은 때 또는 계약을 체결할 때 계약자가 청약서에 자필서명을 하지 않은 때에는 계약자는 계약이 성립한 날부터 3개월 이내에 계약을 취소할 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">금융감독원 보험범죄 신고센터</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        전화 : 1332
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        인터넷 : 금융감독원 홈페이지(<a href="http://www.fss.or.kr" class="link">http://www.fss.or.kr</a>)내 인터넷보험범죄신고
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">금융소비자보호법에 따른 고지</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        모집종사자는 ㈜비아이에스 대리점으로 다수의 보험사와 계약 체결 및 대리·중개하는 보험설계사(보험대리점)이며 보험사로부터 보험계약체결권을 부여받지 아니한 금융상품판매 대리 중개업자임을 알려드립니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        ㈜비아이에스은 위 보험사들로부터 금융상품계약체결권을 부여받지 않은 경우 금융상품 계약을 체결할 권한이 없으며, 금융소비자보호법위반으로 금융소비자에게 손해를 발생시킨 경우 금융소비자보호법 제 44조 및 제45조에따라 그 손해를 배상할 책임이 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        ㈜비아이에스은 보험사들로부터 금전수령에 관한 권한을 부여받은 경우를 제외하고는 금융소비자가 계약에 따라 지급해야 하는 금전을 수령할 권한이 없으며, 대리,중개시 보험사들로부터 직접판매업자로부터 정해진 수수료 외에 금품 그밖에 재산상 이익을 요구하거나 받을 수 없습니다.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        금융소비자가 제공하는 개인(신용)정보 등은 보험사들이 보유,관리하며, ㈜비아이에스은 기타 금융소비자보호법에서 요구하는 금융소비자 보호 또는 건전한 질서유지를 위한 내용을 준수하고 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                    <!-- infoBox -->
                    <div class="infoBox">
                        <div class="titleArea">
                            <h4 class="title infoHeadTitle">금융소비자보호법에 관한 사항</h4>
                        </div>
                        <div class="contArea">
                            <ul>
                                <li>
                                    <p>
                                        삼성화재해상보험은 해당 상품에 대해 충분히 설명할 의무가 있으며, 가입자는 가입에 앞서 이에 대한 충분한 설명을 받으시기 바랍니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //infoBox -->

                </div>
                <!-- //tabCont -->
            </article>
            <!-- //tabArea -->

            <div class="footArea">
                <p>
                    보험대리점 등록번호 : 2018020005
                </p>
            </div>

        </div>
        <!-- //bodyArea -->
    </div>
</article>
<!-- //알아두실 사항 -->

<!-- 상품안내 -->
<article id="productInfoLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">상품안내</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">
            
            <article class="productInfoArea">
                <div class="infoBox gray">
                    <div class="contArea">

                        <div class="circleBox">
                            <div class="circle">
                                <img src="../images/common/img_browser.png" alt="편리한가입 이미지">
                            </div>
                            <p class="desc circleMain">편리한 가입</p>
                        </div>
                        <div class="circleBox">
                            <div class="circle">
                                <img src="../images/common/img_person.png" alt="든든한보장 이미지">
                            </div>
                            <p class="desc circleMain">든든한 보장</p>
                        </div>
                        <div class="circleBox">
                            <div class="circle">
                                <img src="../images/common/img_notebook.png" alt="간편 보험청구 이미지">
                            </div>
                            <p class="desc circleMain">간편 보험청구</p>
                        </div>
                    </div>
                </div>
                <div class="infoBox white">
                    <div class="titleArea">
                        <h4 class="title stepTitle">상품 설명</h4>
                    </div>
                    <div class="contArea">
                        <div class="rect first">
                            <p class="desc rectMain">해외 의료실비<br />보장</p>
                            <p class="desc rectSub">해외여행 중 발생한 입원, 통원, 수술비 등 보장</p>
                        </div>

                        <div class="rect second">
                            <p class="desc rectMain">중대사고<br />구조송환비용<br />보장</p>
                            <p class="desc rectSub">예상치 못한 중대사고 발생 시 구조송환비용 보장</p>
                        </div>

                        <div class="rect third">
                            <p class="desc rectMain">우리말 도움<br />서비스</p>
                            <p class="desc rectSub">긴급상황 발생시 해외 어디서나 전화로 24시간 우리말 상담</p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <!-- //bodyArea -->

        <!-- footArea -->
        <div class="footArea">
            <p class="desc modalFoot">
            ※ 준법감시인 심의필 제2022-광고-1566호(2022.11.04~2023.11.03)
            </p>
            <div class="logoArea">
                <img src="../images/common/logo_meritz_col.png" alt="메리츠화재 로고">
            </div>
        </div>
        <!-- //footArea -->
    </div>
</article>
<!-- //상품안내 -->

<!-- 입원, 수술, 질병 확진 -->
<article id="diseaseInfoLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">입원, 수술, 질병확진</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">
            <div class="inner">
                <article class="modalCont" style="height: 300px;">
                    <div class="contBox">
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        암, 백혈병, 협심증, 심근경색, 심장판막증, 간경화증, 뇌졸중증(뇌출혈, 뇌경색), 에이즈 및 HIV
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                    
                </article>
            </div>
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //입원, 수술, 질병 확진 -->

<!-- 보험인수 제한 국가 안내 -->
<article id="dangerCountryLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">보험인수 제한 국가 안내</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">

            <article class="modalCont" style="height: 500px;">
                <div class="inner cScroll">
                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">아시아</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        아프가니스탄, 이라크, 이란, 북한, 레바논, 파키스탄, 팔레스타인 자치구, 시리아, 타지키스탄, 예멘
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">아프리카</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        부르키나파소, 부룬디, 콩고(자이레), 중앙아프리카, 콩고, 코트디브와르, 알제리, 이집트, 기니, 리비아, 말리, 나이지리아, 수단, 시에라리온, 소말리아, 챠드, 자이레
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">유럽</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        우크라이나, 크림반도
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">북아메리카</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        쿠바, 니카라과
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">남아메리카</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        아이티, 베네수엘라
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">기타</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDescFirst">남극</p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc">
                                        * 외교부의 여행금지대상 국가정보는 수시로 변경됩니다. 여행금지대상국가의 경우 가입이 불가하거나 또는 보상 대상에서 제외될 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <a href="https://www.0404.go.kr/dev/main.mofa" title="바로가기" target="_blank" class="desc simpleDesc">외교부 해외안전여행 여행제한 및 금지구역 확인</a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>

            </article>
            
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //보험인수 제한 국가 안내 -->

<!-- 이용약관 -->
<article id="termUseLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">이용약관</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">

            <article class="modalCont" style="height: 500px;">
                <div class="inner cScroll">
                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제1조 (목적)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        이 약관은 ㈜유라이프파이낸셜(이하 ‘회사’라 한다)이 운영하는 인터넷/모바일 홈페이지(이하 “홈페이지”라 한다.)에서 제공하는 보험토탈케어 서비스(이하 ‘서비스’라 한다)를 이용함에 있어 회사와 이용자의 권리·의무 및 책임사항을 규정함을 목적으로 합니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제2조(정의)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① "회사"란 이용자의 가입편의성을 위하여 보험회사와 약정한 포괄계약에 의거하여 대표계약자로 설정된 ㈜유라이프파이낸셜을 의미하며 모든 이용자는 대표계약자를 통해 청약이 이루어 집니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② "이용자"란 홈페이지에 접속하여 이 약관에 따라 홈페이지이 제공하는 서비스를 받는 회원 및 준회원(동반자)를 말합니다
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ "회원"이라 함은 회사에 가입서비스의 이용을 위하여 필요한 개인정보를 입력하고 해당 약관에 동의한 자를 말합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ④ "준회원(동반자)"이라 함은 회원에게 개인정보를 제공하여 간접적으로 서비스를 이용하는 자를 의미합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑤ "서비스"라 함은 "회원 및 준회원이" 이용하는 것으로 회사가 요구하는 개인정보를 제공하여만 이용이 가능한 서비스(여행자보험 가입등)을 말합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑥ "준회원(동반자)"의 개인정보제공 및 동의에 관한 절차는 회원이 대신하여 진행할 수 있으나 회사의 과실을 제외한 법적책임은 회원에게 있습니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제3조 (약관의 명시와 개정)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사는 이 약관의 내용과 상호, 영업소 소재지, 대표자의 성명, 사업자 등록번호, 연락처(전화, 전자우편 주소), 개인정보관리 책임자 등을 이용자가 알 수 있도록 홈페이지의 초기화면(전면)에 게시합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 전자상거래 등에서의 소비자 보호에 관한 법률, 약관의 규제에 관한 법률, 전자거래기본법, 전자서명법, 정보통신망 이용 촉진 및 정보보호 등에 관한 법률, 방문판매 등에 관한 법률, 소비자보호법 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회사가 약관을 개정할 경우에는 적용 일자 및 개정사유를 명시하여 현행 약관과 함께 "홈페이지"의 초기화면에 그 적용일자 7일이전부터 적용일자 전일까지 공지합니다. 다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 회사가 개정전 내용과 개정후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ④ 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래등에서의 소비자보호에관한법률, 약관의규제등에관한법률, 공정거래위원회가 정하는 전자상거래등에서의소비자보호지침 및 관계법령 또는 상관례에 따릅니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제4조(서비스의 이용)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사는 다음의 서비스를 제공합니다.
                                    </p>
                                    <ul class="secondLine">
                                        <li>
                                            <p class="desc simpleDesc number">
                                                1. 보험상품에 대한 정보의 제공 및 보험 계약의 중개
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                2. 보험료 산출서비스
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                3. 보험 진단서비스
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                4. 보험 추천서비스
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                5. 보험 계약관리서비스
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                6. 고객혜택제공
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                7. 기타 회사가 정하는 서비스
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 불가피한 사정이나 기술적 사양의 변경 등의 경우에는 서비스의 내용을 변경할 수 있습니다. 이 경우에는 변경된 서비스의 내용 및 제공일자를 명시하여 현재의 서비스의 내용을 게시한 곳에 그 제공일자 이전 7일부터 공지합니다. 단, 회사는 불가피한 여건이나 사정이 있는 경우, 위 공지를 하지 않을 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회사가 제공하기로 이용자와 계약을 체결한 서비스의 내용을 기술적 사양의 변경 등의 사유로 변경할 경우에는 회사는 이로 인하여 이용자가 입은 손해를 배상합니다. 단, 회사에 고의 또는 과실이 없는 경우에는 그러하지 아니합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ④ 서비스의 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴를 원칙으로 합니다. 다만 이용시간은 정기점검 등의 필요로 인하여 회사가 정한 날 및 시간에 대해서는 예외 적용합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑤ 회사는 시스템 등의 보수, 점검, 교체, 시스템의 고장, 통신의 두절, 기타 불가 항력적 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑥ 회사는 ⑤항의 사유로 서비스 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대해서는 배상하지 아니합니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제5조(회원 관리)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 이용자는 회사가 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각호에 해당하지 않는 한 회원으로 등록합니다.
                                    </p>
                                    <ul class="secondLine">
                                        <li>
                                            <p class="desc simpleDesc number">
                                                1. 등록 내용에 허위, 기재누락, 오기가 있는 경우
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                2. 기타 회원으로 등록하는 것이 회사의 기술상 현저히 지장이 있다고 판단되는 경우
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회원가입계약의 성립시기는 회사의 승낙이 회원에게 도달한 시점으로 합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회원은 등록사항에 변경이 있는 경우, 즉시 전자우편 기타 방법으로 회사에 대하여 그 변경사항을 알려야 합니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제6조(회원자격 득실)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 이용자는 제휴사 등에 회사가 제공하는 서비스에서 서비스 계약신청시 본 약관과 개인정보 처리 방침을 읽고 "동의"또는 "확인"버튼을 체크한 경우 본 약관에 동의함으로 회원자격을 얻게 됩니다
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회원은 회원의 준회원(동반자)를 위해 여행자보험에 일괄가입하며 이때 회원과 회원의 동반자(준회원)의 개인(신용)정보를 보험사에 제공합니다. 회원의 동반자(준회원)의 개인(신용)정보는 "회원"에게 제공 받습니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제7조(회원 탈퇴 및 자격 상실 등)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회원은 회사에 언제든지 탈퇴를 요청할 수 있으며 회사는 즉시 회원탈퇴를 처리합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회원이 다음 각호의 사유에 해당하는 경우, 회사는 회원자격을 제한 및 정지시킬 수 있습니다.
                                    </p>
                                    <ul class="secondLine">
                                        <li>
                                            <p class="desc simpleDesc number">
                                                1. 가입 신청시에 허위 내용을 등록한 경우
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                2. 홈페이지를 이용하여 구입한 재화 등의 대금, 기타 홈페이지 이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                3. 다른 사람의 홈페이지 이용을 방해하거나 그 정보를 도용하는 등 전자상거래 질서를 위협하는 경우
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                4. 홈페이지를 이용하여 법령 또는 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회사가 회원자격을 상실시키는 경우에는 회원등록을 말소합니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제8조(회원에 대한 통지)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사가 이용자에 대한 통지를 하는 경우, 이용자가 회사에 제출한 전자우편 주소로 할 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 불특정다수 이용자에 대한 통지의 경우 1주일 이상 홈페이지 게시판에 게시함으로써 개별 통지에 갈음할 수 있습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제9조(전자금융거래 이용 신청)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        회사에서 서비스를 이용하기 위해서는 전자금융거래 이용 신청을 하셔야 하며, 신청하는 방법은 다음의 절차에 의하여야 합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        1. 본 약관에 동의
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        2. 최초 이용 시 전자금융거래이용약관 동의
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        3. 주민등록번호 및 성명 제공을 통한 실명인증 확인
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        4. 보험상품 및 서비스 제공 시 요구하는 항목 입력
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        5. 공인인증서, 신용카드 등에 회사가 정한 방법에 따른 결제
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제10조(개인정보보호)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사는 이용자의 정보 수집 시 서비스 이용상의 필요한 최소한의 정보를 수집합니다. 수집하는 정보 항목에 대해서는 개인정보처리방침을 참고하시기 바랍니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 이용자의 개인식별이 가능한 개인정보를 수집하는 때에는 반드시 당해 이용자의 동의를 받습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회사는 이용자가 제공한 개인정보를 다음 각 호의 목적 이외에는 제공, 이용할 수 없습니다.
                                    </p>
                                    <ul class="secondLine">
                                        <li>
                                            <p class="desc simpleDesc number">
                                                1. 관련 법률상의 근거에 따른 제공, 이용
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                2. 회사에서 제공하는 서비스의 제공, 이용
                                            </p>
                                        </li>
                                        <li>
                                            <p class="desc simpleDesc number">
                                                3. 통계작성 등의 목적을 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태의 개인정보 제공, 이용
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ④ 이용자는 언제든지 회사가 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있습니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑤ 회사는 개인정보 보호를 위하여 관리자를 한정하여 그 수를 최소화하며, 이용자의 개인정보가 회사의 고의 또는 과실로 인하여 분실, 도난, 유출, 변조되어 이용자에게 손해가 발생한 경우 책임을 집니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ⑥ 회사 또는 그로부터 개인정보를 제공받은 제3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 개인정보를 지체없이 파기합니다.
                                    </p>
                                </li>
                                <li>
                                    <P class="desc simpleDesc number">
                                        ⑦ 기타 홈페이지 이용시의 개인정보보호 관련 사항은 개인정보처리방침에 준하여 적용됩니다.
                                    </P>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제11조 (회사의 의무)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사는 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며, 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화, 용역을 제공하는데 최선을 다하여야 합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 이용자가 안전하게 인터넷서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안시스템을 갖추어야 합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ③ 회사가 상품이나 용역에 대하여 표시 광고의공정화에관한법률 제3조 소정의 부당한 표시 광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ④ 회사는 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제12조 (이용자의 의무)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        이용자는 다음 행위를 하여서는 안됩니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        1. 신청 또는 변경시 허위내용의 등록
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        2. 회사에 게시된 정보의 변경
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        3. 회사가 정한 정보 이외의 정보(컴퓨터 프로그램 등)의 송신 또는 게시
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        4. 회사와 제3자의 저작권 등 지적재산권에 대한 침해
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        5. 회사와 제3자의 명예를 손상시키거나 업무를 방해하는 행위
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        6. 외설 또는 폭력적인 메시지, 화상, 음성 기타 공서양속에 반하는 정보를 홈페이지에 공개 또는 게시하는 행위
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제13조(저작권의 귀속 및 이용제한)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사가 작성한 저작물에 대한 저작권 기타 지적재산권은 회사에 귀속합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 이용자는 홈페이지를 이용함으로써 얻은 정보를 회사의 사전 승낙없이 복제, 송신, 출판, 배포, 방송, 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다.
                                    </p>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제14조(분쟁해결)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사는 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 홈페이지 내 연락처로 연락하시면 됩니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사는 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 통보해 드립니다.
                                    </p>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">제15조(재판권 및 준거법)</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ① 회사와 이용자간에 발생한 전자거래 분쟁에 관한 소송은 민사소송법상의 관할법원에 제기합니다.
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        ② 회사와 이용자간에 제기된 전자거래 소송에는 한국법을 적용합니다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">부칙</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        본 약관은 2022년 9월 1일부터 시행한다.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </article>
            
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //이용약관 -->

<!-- 개인정보 수집 및 이용 동의 -->
<article id="personalInfoLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">개인정보 수집 및 이용</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">

            <article class="modalCont" style="height: 300px;">
                <div class="inner cScroll">
                    <div class="contBox">
                        <div class="titleArea">
                            <h4 class="title modalContTitle">㈜비아이에스 귀중</h4>
                        </div>
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        본인은 귀사가 유라이프파이낸셜 보험토탈케어서비스 회원가입을 위하여 본인의 개인정보를 수집/이용하는 것에 동의합니다
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        - 수집하는 개인정보 항목 : (회원가입) 성명, 생년월일 / (보험료 산출) 성별, 출발일, 귀국일
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        - 개인정보 수집/제공 목적 : ㈜비아이에스 여행자 보험가입
                                    </p>
                                </li>
                                <li>
                                    <p class="desc simpleDesc number">
                                        - 개인정보 보유 및 이용 기간 : <span class="essential">회원 탈퇴 시까지</span> 동의 거부 시 서비스 이용이 불가합니다.
                                    </p>
                                </li>

                            </ul>
                            
                        </div>
                    </div>

                </div>

            </article>
            
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //개인정보 수집 및 이용 동의 -->

<!-- 개인정보 처리 및 단체가입규약 동의 -->
<article id="groupInfoLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">개인정보 처리 및 단체가입규약</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">

            <article class="modalCont" style="height: 500px;">
                <div class="inner cScroll">

                    <div class="innerBox">
                        <div class="titleArea">
                            <h4 class="title innerTitle">단체가입규약</h4>
                        </div>
                        <div class="contBox">
                            
                            <div class="titleArea">
                                <h4 class="title modalContTitle">제1조 (단체규약 목적)</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            이 규약은 회사가 회원들을 위하여 제공하는 서비스 이용에 관하여 회원들간 협약사항을 규정함을 그 목적으로 합니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">제2조 (회원자격)</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ① 회사가 운영하는 서비스 이용약관에 동의한 회원은 이 협약의 당사자가 됩니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ② 회원의 자격득실 등에 관하여는 이용약관에서 정하는 바에 따릅니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">제3조 (단체보험 가입)</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ① 회사는 회사를 계약자로, 회원(동행자포함)을 피보험자로 하는 단체보험계약을 체결할 수 있습니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ② 회원(동행자포함)은 회사가 회원(동행자포함)을 피보험자로 하는 단체보험을 체결함에 있어 회사가 일괄로 가입하는 방식에 동의합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ③ 회원(동행자포함)은 제1항의 보험계약에 따른 담보항목 및 내용을 회사가 제공하는 범주 내에서 선택할 수 있으며, 소정의 절차에 따라 보험 청약을 합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ④ 회원(동행자포함)이 가입하는 단체보험의 보험금 수익자는 사망보험금인 경우에는 피보험자의 법정상속인, 그 외의 경우에는 피보험자 본인으로 합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ⑤ 보험계약에 관한 세부내용은 보험사가 제공하는 보험약관에 따르며 이 규약에서 정하지 않은 사항은 회사가 보험사와 약정한 바에 따릅니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">제4조 (기타사항)</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ① 회사의 기존 서비스 변경, 새로운 서비스 출시, 법령의 개폐, 회원 요구 등의 사정이 있어 이 규약을 변경할 필요가 있는 경우, 회사는 회원들을 위하여 규약을 즉시 변경합니다. 그리고 변경된 규약은 그 즉시 효력을 발합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ② 회사는 규약변경을 위해 필요한 경우 회원들에게 의견을 구할 수 있으며, 회원들은 이에 성실히 응합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ③ 규약변경을 희망하는 회원은 회사에 그 구체적 변경안과 이유를 제시하여 규약변경을 제안할 수 있습니다. 이에 대하여는 회사는 전항에 따라 처리합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ④ 회사는 단체보험가입 등 규약에 직접적으로 영향을 받는 서비스를 이용하는 회원에게는 개별적으로 규약적용에 부동의하는지 의견을 구합니다. 이 때 규약에 부동의하는 회원은 해당서비스를 이용하지 않거나, 회원 탈퇴를 할 수 있습니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 본 보험계약의 피보험자의 지위에 대해 동의하며, 본인이 동반인을 대신하여 보험 가입절차를 이행하는 경우 그 보험가입에 대해 해당 동반인(들)로부터 전권을 위임받았음을 확인합니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                    </div>

                    <div class="innerBox">
                        <div class="titleArea">
                            <h4 class="title innerTitle">개인정보 수집 및 이용 및 제3자 제공 동의 (필수)</h4>
                        </div>
                        <div class="contBox">
                            
                            <div class="titleArea">
                                <h4 class="title modalContTitle">㈜비아이에스 귀중</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 귀사가 (해외)여행자보험 가입을 위하여 본인의 개인정보를 수집/이용하는 것에 동의합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 수집하는 개인정보 항목 : 성명, 법정생년월일, 성별, 이메일, 핸드폰번호, 여행지, 출발일, 귀국일, 여행목적, 보험상품플랜
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 수집/제공 목적 : (해외)여행자보험 보험 가입, 가입 취소, 고객문의 응대
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 보유 및 이용 기간 : 보험기간 종료(귀국일) 후 3년간 보관
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 귀사가 (해외)여행보험 보험료 산출 및 가입, 계약관리를 위하여 본인의 개인정보를 해당 보험사에 제공하는 것에 동의합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보를 수집하는 자 : ㈜비아이에스
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보를 제공받는 자 : 메리츠화재보험㈜
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 제공하는 개인정보 항목 : 성명, 이메일, 핸드폰번호, 여행지, 출발일, 귀국일, 여행목적, 보험상품플랜
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 제공 목적 : (해외)여행보험료 산출 및 가입, 계약관리
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 보유 및 이용 기간 : 관계 법령에 따라 보관 및 파기
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            ※ 동의 거부시 서비스 이용이 불가합니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>

                    <div class="innerBox">
                        <div class="titleArea">
                            <h4 class="title innerTitle">고유식별 정보 수집 및 이용제공 및 제3자 제공 동의 (필수)</h4>
                        </div>
                        <div class="contBox">
                            
                            <div class="titleArea">
                                <h4 class="title modalContTitle">㈜비아이에스 귀중</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 귀사가 (해외)여행자보험 보험가입을 위하여 본인의 주민등록번호를 수집하여, 해당 보험사에 제공하는 것에 동의합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 수집하는 개인정보 항목 : 주민등록번호
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 수집 목적 : (해외)여행자보험 보험 가입
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 보유 및 이용 기간 : 보험 가입 및 보험사 제공 후 7일후 삭제
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 귀사가 (해외)여행보험 보험가입을 위하여 본인의 주민등록번호를 해당 보험사에 제공하는 것에 동의합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보를 제공받는 자 : 메리츠화재보험㈜
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 제공하는 개인정보 항목 : 주민등록번호
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 수집/제공 목적 : (해외)여행자보험 보험 가입
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            - 개인정보 보유 및 이용 기간 : 목적 달성 시 즉시 폐기(관련 법령 규정이 있을 경우 해당 법령에 따라 보관)
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            ※ 동의 거부 시 서비스 이용이 불가합니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>

                    <div class="innerBox">
                        <div class="titleArea">
                            <h4 class="title innerTitle">마케팅 활용을 위한 개인정보 수집 및 이용 동의(선택)</h4>
                        </div>
                        <div class="contBox">
                            
                            <div class="titleArea">
                                <h4 class="title modalContTitle">㈜유라이프커뮤니케이션즈 귀중</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본인은 아래와 같이 귀사가 본인의 개인정보를 마케팅 목적으로 수집, 이용하는 것에 동의합니다.
                                        </p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">1. 수집/이용 항목</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            수집된 필수항목, 고객식별자 정보, 접속로그(IP포함), 쿠키, 서비스 이용기록, 서비스 이용내역(구매내역, 결제정보, 상담정보, 광고전송반응정보)
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">2. 수집/이용 목적</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            회사가 제공하는 상품∙서비스 또는 기타 타사, 제휴사가 제공하는 상품/서비스의 판매, 정보제공, 홍보, 가입권유 활동(쿠폰발송 등 판촉광고 포함), 리서치(고객설문/시장조사 및 고객만족도 조사), 제반 이벤트/프로모션 활동(사은행사, 판촉행사 등), 회사의 상품/서비스에 대한 이용실적 정보 분석 및 활용, 포인트 적립
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            <b>
                                                전자우편(E-mail)/우편물(DM)/문자(SMS)/대면접촉/텔레마케팅 등을 활용 등을 활용
                                            </b>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">[제휴분야]</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ① 보험: 삼성생명/ 메리츠화재/ DB손보/ 삼성화재/ 한화손해보험/ KB손해보험/ 현대해상화재보험/ 롯데손해보험/ AIG손해보험/ MG손해보험/ 흥국화재 등 생명/ 손해 보험 전 업계의 보험상품
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ② 상조: 더케이예다함상조/프리드라이프/대명아임레디/보람재향상조/교원라이프/보람상조라이프/보람상조개발/보람상조프라임/한라상조/ 효원상조 등 전 업계의 상조상품
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ③ 신용카드: 하나카드, 신한카드, 롯데카드 등 전 업계 카드회사 및 우리은행, NH농협, KEB하나은행 등 국내 시중은행이 발행하는 제휴 신용카드(체크카드, 선불카드 포함), 결제페이
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ④ 금융/증권: SK증권, 삼성증권 등 증권/주식/펀드 계좌개설, 국내 시중은행 예금, 대출상품
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc number">
                                            ⑤ 데이터 쿠폰, 기프티콘, 통신기기/통신상품, 패션의류, 잡화/화장품(보석 등), 식품/유아/아동, 전자/가전제품, 자동차/차량용품, 렌탈상품(정수기, 공기청정기 등), 가구/침구/생활/건강(꽃배달, 악기 등), 도서/음반, 공연/영화/경기, 레져/스포츠 용품, 웨딩상품, 회원권/상품권, 온라인컨텐츠(교육, 소프트웨어, 음원파일 등), 의료기기/의료, 신용카드/증권/은행/결제페이, 항공/호텔/면세점/렌터카/투어, 주유/정비, 태아/태교용품/산후조리원/산모 및 육아서비스, 동물병원/PET샵/PET용품/PET서비스를 비롯한 금융, 여행, 산모 및 어린이(태아 포함), PET 등 관련 상품 및 서비스
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="contBox">
                            <div class="titleArea">
                                <h4 class="title modalContTitle">3. 보유/이용기간</h4>
                            </div>
                            
                            <div class="descArea">
                                <ul>
                                    <li>
                                        <p class="desc simpleDesc">
                                            <span class="essential">
                                                상기 이용목적 및 고객 민원처리 목적으로 동의일로부터 5년간 보관 후 지체 없이 파기(동의철회 요청 시 동의철회 요청일까지)
                                            </span>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            고객님께서는 동의를 거부하실 권리가 있으며, 거부하시는 경우에도 보험가입이 가능합니다.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="desc simpleDesc">
                                            본 개인정보처리방침 11. 개인정보 보호책임자에 명시된 개인정보보호 총괄책임자 혹은 개인정보보호 관리담당자, 개인정보보호 사업담당자에게 서면, 전화, 전자우편(E-mail)등으로 연락하여 처리정지를 요구하실 수 있습니다.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
            
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //개인정보 처리 및 단체가입규약 동의 -->

<!-- 보험약관 -->
<article id="insuranceTermsLayerPopup" class="layerPopup default">
    <div class="inner">
        <!-- headArea -->
        <div class="headArea">
            <div class="titleArea">
                <h3 class="title modalTitle">보험약관</h3>
                <div class="btnArea">
                    <button type="button" class="btn modalClose white" title="닫기"></button>
                </div>
            </div>
        </div>
        <!-- //headArea -->

        <!-- bodyArea -->
        <div class="bodyArea">
            <div class="inner">
                <article class="modalCont" style="height: 300px;">
                    <div class="contBox">
                        
                        <div class="descArea">
                            <ul>
                                <li>
                                    <p class="desc simpleDesc">
                                        보험계약청약 시 기재된 내용이 사실과 다르거나 누락된 사항이 없는지 확인하시고, 사실과 다르거나, 누락된 사항이 있으면 보험약관에 의하여 보험계약의 해지 또는 보험금 불지급 등의 불이익을 당할 수 있으니, 약관을 충분히 읽어보시기 바랍니다.
                                    </p>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                    
                </article>
            </div>
        </div>
        <!-- //bodyArea -->

    </div>
</article>
<!-- //보험약관 -->


<script>
    // 모달열기
    document.querySelectorAll('.modalOpen').forEach(function(modalOpens) {
        modalOpens.addEventListener('click', function(event) {
            let action = event.target;
            let getId = action.getAttribute('id');
            let targetLayer = document.getElementById(getId + 'LayerPopup');
            
            if (targetLayer) {
                targetLayer.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    document.querySelector('.questionMarkBlue').addEventListener('click', function(event){
        let action = event.target;
        let targetTag = action.closest('.btn');
        targetTag.click();
    })

    // 모달 닫기
    document.querySelectorAll('.modalClose').forEach(function(modalCloses){
        modalCloses.addEventListener('click', function(event){
            let action = event.target;
            let targetLayer = action.closest('.layerPopup');
            
            if (targetLayer) {
                targetLayer.classList.remove('active');
                document.body.style.overflow = '';
            }
        })
    })

    // 모달영역 외 부분 클릭하면 모달 닫기
    document.querySelectorAll('.layerPopup').forEach(function(layerPopup) {
        layerPopup.addEventListener('click', function(event) {
            // 클릭한 요소가 .layerPopup 자신인 경우에만 active 클래스를 삭제
            if (event.target === layerPopup) {
                layerPopup.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

</script>
