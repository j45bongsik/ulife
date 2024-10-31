
<div class="conts-box">
    <div class="titleArea">
        <h1>
            법인카드 수정
        </h1>
    </div>

    <!-- form -->
    <form name="cardRegForm" id="cardRegForm" method="post" action="/cardInfoEditProc">
        
        <!-- regBox -->
        <section class="regBox" style="max-width: 1000px;">
            <!-- erpList reg -->
            <article class="erpList reg">
                <table>
                    <caption>
                        카드정보 수정 테이블로 카드사, 카드번호, 유효기간, 결제일, 사용자, 메모 등의 정보를 입력하여 수정합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 200px;">
                        <col style="width: 300px;">
                        <col style="width: 200px;">
                        <col style="width: 300px;">
                    </colgroup>
                    <tbody>
                        <!-- 페이지 당 tr은 max 10개까지만 -->
                        <tr>
                            <th scope="row">
                                <label for="cardCompany">
                                    카드사 
                                </label>
                            </th>
                            <td>
                                <p id="cardCompany" class="disabled">
                                    <input type="hidden" name="seq" value="<?=$CARDSEQ?>" >
                                    <?=$CARDCOMPANYNAME?>
                                </p>
                                <!-- select-custom -->
                            </td>

                            <th scope="row">
                                <label for="numberFirst">
                                    카드번호
                                </label>
                            </th>
                            <td>
                                <p class="disabled">
                                    <span id="numberFirst">
                                        <?=$CARDNO1?>
                                    </span>
                                    <span class="between">-</span>
                                    <span id="numberSecond">
                                        <?=$CARDNO2?>
                                    </span>
                                    <span class="between">-</span>
                                    <span id="numberThird">
                                        <?=$CARDNO3?>
                                    </span>
                                    <span class="between">-</span>
                                    <span id="numberFour">
                                        <?=$CARDNO4?>
                                    </span>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="ValidM" class="essential">
                                    유효기간
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- data-length : 카드번호 or 유효기간 자릿수 구분을 위함 -->
                                    <input type="number" id="ValidM" name="ValidM" value="<?=$CARDMONTH?>" placeholder="MM" data-length="2" required>
                                    <span class="between">-</span>
                                    <input type="number" id="ValidY" name="ValidY" value="<?=$CARDYEAR?>" placeholder="YY" data-length="2" required>
                                </div>
                            </td>

                            <th scope="row">
                                <label for="paymentDays">
                                    결제일
                                </label>
                            </th>
                            <td>
                                <!-- select-custom -->
                                <div class="select-custom">
                                    <?=$PAYMENTDAYSSELECTBOX?>
                                </div>
                                <!-- //select-custom -->
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="useDep" class="essential">
                                    사용자
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- select-custom -->
                                    <div class="select-custom firstSelect">
                                        <?=$DEPTLISTSELECTBOX?>
                                    </div>
                                    <!-- //select-custom -->
                                    <!-- select-custom -->
                                    <div class="select-custom secondSelect">
                                        <?=$MEMBERSELECTBOX?>
                                    </div>
                                    <!-- //select-custom -->
                                </div>
                            </td>
                            <th>
                                <label for="memo">
                                    메모
                                </label>
                            </th>
                            <td>
                                <input type="text" name="memo" id="memo" value="<?=$CARDMEMO?>" placeholder="추가 사항 입력"> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <!-- //erpList reg -->

            <div class="inputBox">
                <a href="/cardInfo" class="btn list">목록</a>
                <label for="inputEdit">
                    <input type="submit" id="inputEdit" class="btn search" value="수정" title="수정">
                </label>
            </div>
        </section>
        <!-- //regBox -->

    </form>
    <!-- //form -->
    
</div>

<script>

    
    // 숫자 입력 필드들을 선택하고 각각에 대해 이벤트 리스너를 등록
    document.querySelectorAll('input[type="number"]').forEach(function(input, index, inputs) {
        input.addEventListener('keyup', function(event) {
            let currentInput = this;
            let currentValue = currentInput.value;
            let dataLength = currentInput.getAttribute('data-length'); 

            // 태그 data-length속성값이 4이면
            if (dataLength === "4") {
                if (currentValue.length > dataLength - 1) {
                    currentInput.value = currentValue.slice(0, 4);
                    if (index < inputs.length - 1) {
                        // 다음 입력 필드로 포커스 이동
                        inputs[index + 1].focus();
                    }
                }
            // 태그 data-length속성값이 2이면
            } else if (dataLength === "2") {
                if (currentValue.length > dataLength - 1) {
                    currentInput.value = currentValue.slice(0, 2);
                    if (index < inputs.length - 1) {
                        // 다음 입력 필드로 포커스 이동
                        inputs[index + 1].focus();
                    }
                }
            }
        });
    });
</script>