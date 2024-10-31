
<div class="conts-box">
    <div class="titleArea">
        <h1>법인카드 등록</h1>
    </div>

    <!-- form -->
    <form name="cardRegForm" id="cardRegForm" method="post" action="/cardInfoRegProc">

        <!-- regBox -->
        <section class="regBox" style="max-width: 1000px;">
            <!-- erpList reg -->
            <article class="erpList reg">
                <table>
                    <caption>
                        카드등록 테이블로 카드사, 카드번호, 유효기간, 결제일, 사용자, 메모 등의 정보를 입력하여 등록합니다.
                    </caption>
                    <colgroup>
                        <col style="width: 175px;">
                        <col style="width: 300px;">
                        <col style="width: 175px;">
                        <col style="width: 300px;">
                    </colgroup>
                    <tbody>
                        <!-- 페이지 당 tr은 max 10개까지만 -->
                        <tr>
                            <th scope="row">
                                <label for="cardCompany" class="essential">
                                    카드사
                                </label>
                            </th>
                            <td>
                                <!-- select-custom -->
                                <div class="select-custom">
                                    <?=$CARDCOMPANYOPTIONSELECTBOX?>
                                </div>
                                <!-- //select-custom -->
                            </td>

                            <th scope="row">
                                <label for="numberFirst" class="essential">
                                    카드번호
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <!-- data-length : 카드번호 or 유효기간 자릿수 구분을 위함 -->
                                    <input type="number" name="numberFirst" id="numberFirst" value="" data-length="4" placeholder="XXXX" required>
                                    <span class="between">-</span>
                                    <input type="number" name="numberSecond" id="numberSecond" value="" data-length="4" placeholder="XXXX" required>
                                    <span class="between">-</span>
                                    <input type="number" name="numberThird" id="numberThird" value="" data-length="4" placeholder="XXXX" required>
                                    <span class="between">-</span>
                                    <input type="number" name="numberFourth" id="numberFour" value="" data-length="4" placeholder="XXXX" required>
                                </div>
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
                                    <input type="number" id="ValidM" name="ValidM" value="" placeholder="MM" data-length="2" required>
                                    <span class="between">-</span>
                                    <input type="number" id="ValidY" name="ValidY" value="" placeholder="YY" data-length="2" required>
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
                                    <select name="paymentDays">
                                        <option value="">날짜</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value=10>10</option>
                                        <option value=11>11</option>
                                        <option value=12>12</option>
                                        <option value=13>13</option>
                                        <option value=14>14</option>
                                        <option value=15>15</option>
                                        <option value=16>16</option>
                                        <option value=17>17</option>
                                        <option value=18>18</option>
                                        <option value=19>19</option>
                                        <option value=20>20</option>
                                        <option value=21>21</option>
                                        <option value=22>22</option>
                                        <option value=23>23</option>
                                        <option value=24>24</option>
                                        <option value=25>25</option>
                                        <option value=26>26</option>
                                        <option value=27>27</option>
                                        <option value=28>28</option>
                                    </select>
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
                                <script>
                                    
                                </script>
                            </td>
                            <th>
                                <label for="memo">
                                    메모
                                </label>
                            </th>
                            <td>
                                <input type="text" name="memo" id="memo" value="" placeholder="추가 사항 입력"> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </article>
            <!-- //erpList reg -->

            <div class="inputBox">
                <a href="/cardInfo" class="btn list">목록</a>
                <label for="inputAdd">
                    <input type="submit" id="inputAdd" class="btn search" value="등록" title="등록">
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