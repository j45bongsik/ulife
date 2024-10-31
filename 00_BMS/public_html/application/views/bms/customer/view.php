

<div class="conts-box">
            <div class="titleArea">
                <h1>고객 정보 관리</h1>
            </div>
            <div class="indvd-bsns">
                <?=$DIVISION_CHECKED?>
            </div>

            <form id="customer_update_form" name="customer_update_form">
                <input type="hidden" name="no" id="no" value="<?=$CUSTOMERDATA['no']?>" readonly >
                <input type="hidden" name="division" value="<?=$CUSTOMERDATA['division']?>" readonly >
<?php
    // 사업자 구분이 개인 사업자가 아닌경우에만 출력
    if($CUSTOMERDATA['division'] != 'personal'){
?>

                <article class="erpList reg com">
                    <table>
                        <caption>
                            고객정보관리(법인) 테이블로 법인명, 업종, 사업자번호, 대표자명, 고객사담당자, 부서, 연락처, 휴대전화번호, 대표번호, 홈페이지, 이메일, 관리채널, 소재지, 메모 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="customer_name">
                                        법인명
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="customer_name" id="customer_name" placeholder="법인명 입력" value="<?=$CUSTOMERDATA['customer_name']?>" disabled >
                                </td>
                                <th scope="row">
                                    <label for="industry">
                                        업종
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="industry" id="industry" placeholder="업종 입력" value="<?=$CUSTOMERDATA['industry']?>" disabled >
                                </td>
                                <th>
                                    <label for="business_number">
                                        사업자번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="" id="business_number" placeholder="012-34-34567" value="<?=$CUSTOMERDATA['business_number']?>"  disabled >
                                </td>
                                
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="ceo_name" class="essential">
                                        대표자명
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="ceo_name" id="ceo_name" placeholder="대표자명 입력" value="<?=$CUSTOMERDATA['ceo_name']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="manager_name" class="essential">
                                        고객사 담당자
                                    </label>
                                </th>
                                <td>
                                    <div class="inputArea">
                                        <input type="text" name="manager_name" id="manager_name" placeholder="담당자명 입력" value="<?=$CUSTOMERDATA['manager_name']?>" required>
                                        <span class="between">/</span>
                                        <input type="text" name="manager_position" id="manager_position" placeholder="직책 입력" value="<?=$CUSTOMERDATA['manager_position']?>" required>
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="manager_dept" class="essential">
                                        부서
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="manager_dept" id="manager_dept" placeholder="총무부" value="<?=$CUSTOMERDATA['manager_dept']?>" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="manager_tel" class="essential">
                                        연락처
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="manager_tel" id="manager_tel" placeholder="02-3456-7890" value="<?=$CUSTOMERDATA['manager_tel']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="manager_mobile" class="essential">
                                        휴대전화번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="manager_mobile" id="manager_mobile" placeholder="010-2345-6789" value="<?=$CUSTOMERDATA['manager_mobile']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="tel" class="essential">
                                        대표번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="tel" id="tel" placeholder="1566-1234" value="<?=$CUSTOMERDATA['tel']?>" required>
                                </td>
                            </tr>
                            <tr>
                                
                                <th scope="row">
                                    <label for="homepage">
                                        홈페이지
                                    </label>
                                </th>
                                <td>
                                    <div class="checkArea">
                                        <span class="between">http://</span>
                                        <input type="text" name="homepage" id="homepage" placeholder="bis.co.kr" value="<?=$CUSTOMERDATA['homepage']?>">
                                    </div>
                                </td>
                                <th scope="row">
                                    <label for="email" class="essential">
                                        이메일
                                    </label>
                                </th>
                                <td>
                                    <input type="email" name="email" id="email" placeholder="amdin@amdin.co.kr" value="<?=$CUSTOMERDATA['email']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="offline">
                                        관리 채널
                                    </label>
                                </th>
                                <td>
                                    <div class="checkArea">
                                        <div class="radiobox">
                                            <input id="offline" class="radio-custom" name="management_channel" type="radio" value="off" <?=$ONOFFRADIOCHECKED1?>>
                                            <label for="offline" class="radio-custom-label">오프라인</label>
                                        </div>
                                        <div class="radiobox">
                                            <input id="online" class="radio-custom" name="management_channel" type="radio" value="on" <?=$ONOFFRADIOCHECKED2?>>
                                            <label for="online" class="radio-custom-label">온라인(유비즈)</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="searchaddr" class="essential">
                                        소재지
                                    </label>
                                </th>
                                <td colspan="5">
                                    <div class="inputArea">
                                        <input type="hidden" name="road_address" id="road_address" readonly value="<?=$CUSTOMERDATA['road_address']?>">
                                        <input type="hidden" name="postcode" id="postcode" readonly value="<?=$CUSTOMERDATA['postcode']?>">
                                        <input type="hidden" name="road_address" id="road_address" readonly value="<?=$CUSTOMERDATA['road_address']?>">
                                        <input type="hidden" name="extra_address" id="extra_address" placeholder="참고항목"  value="<?=$CUSTOMERDATA['extra_address']?>">
                                        <input type="text" name="jibun_address" id="jibun_address" placeholder="우편번호 찾기" readonly value="<?=$CUSTOMERDATA['jibun_address']?>" required>    
                                        <button type="button" class="searchaddr" id="searchaddr" onclick="searchAddressZipcode()" >주소검색</button>
                                        <input type="text" name="detail_address" id="detail_address" placeholder="상세주소 입력" value="<?=$CUSTOMERDATA['detail_address']?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="memo">
                                        메모
                                    </label>
                                </th>
                                <td colspan="5">
                                    <textarea name="memo" id="memo" class="textarea" placeholder="추가 사항 입력"><?=$CUSTOMERDATA['memo']?></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>


<?php 
    // 서업자 구분이 개인 사업자인 경우에만 출력
    } else {

?>
                <!-- 개인 start -->

                <article class="erpList reg per">
                    <table>
                        <caption>
                            고객정보관리(개인) 테이블로 성명, 주소, 연락처, 휴대전화번호, 이메일, 관리채널 등의 정보를 제공합니다.
                        </caption>
                        <colgroup>
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                            <col style="width: 130px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="perName">
                                        성명
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="customer_name" id="customer_name" placeholder="성명 입력" value="<?=$CUSTOMERDATA['ceo_name']?>" disabled>
                                </td>
                                <th scope="row">
                                    <label for="tel" class="essential">
                                        연락처
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="tel" id="tel" placeholder="02-3456-7890" value="<?=$CUSTOMERDATA['tel']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="manager_mobile" class="essential">
                                        휴대전화번호
                                    </label>
                                </th>
                                <td>
                                    <input type="text" name="manager_mobile" id="manager_mobile" placeholder="010-2345-6789" value="<?=$CUSTOMERDATA['manager_mobile']?>" required> 
                                </td>
                            </tr>
                            <tr>
                                
                                <th scope="row">
                                    <label for="email" class="essential">
                                        이메일
                                    </label>
                                </th>
                                <td>
                                    <input type="email" name="email" id="email" placeholder="amdin@amdin.co.kr" value="<?=$CUSTOMERDATA['email']?>" required>
                                </td>
                                <th scope="row">
                                    <label for="offline2">
                                        관리채널
                                    </label>
                                </th>
                                <td colspan="3">
                                    <div class="checkArea">
                                        <div class="radiobox">
                                            <input id="offline2" class="radio-custom" name="management_channel" type="radio" value="off" <?=$ONOFFRADIOCHECKED1?>>
                                            <label for="offline2" class="radio-custom-label">오프라인</label>
                                        </div>
                                        <div class="radiobox">
                                            <input id="online2" class="radio-custom" name="management_channel" type="radio" value="on" <?=$ONOFFRADIOCHECKED2?>>
                                            <label for="online2" class="radio-custom-label">온라인(유비즈)</label>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>

                            <tr>
                                <th>
                                    <label for="searchaddr" class="essential">
                                        주소
                                    </label>
                                </th>
                                <td colspan="5">
                                    <div class="inputArea">
                                        <input type="hidden" name="postcode" id="postcode" readonly value="<?=$CUSTOMERDATA['postcode']?>">
                                        <input type="hidden" name="jibun_address" id="jibun_address" readonly value="<?=$CUSTOMERDATA['jibun_address']?>">
                                        <input type="hidden" name="road_address" id="road_address" readonly value="<?=$CUSTOMERDATA['road_address']?>">
                                        <input type="hidden" name="extra_address" id="extra_address" placeholder="참고항목"  value="<?=$CUSTOMERDATA['extra_address']?>">
                                        <input type="text" name="road_address" id="road_address" placeholder="우편번호 찾기" readonly value="<?=$CUSTOMERDATA['road_address']?>" required>
                                        <button type="button" class="searchaddr" id="searchaddr" onclick="searchAddressZipcode()" >주소검색</button>
                                        <input type="text" name="detail_address" id="detail_address" placeholder="상세주소 입력" value="<?=$CUSTOMERDATA['detail_address']?>" required>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>

                <!-- 개인 end -->
<?php
    }
    // 사업자 구분별로 노출 되는 항목 조건문 끝
?>

                <div class="btn-box-conts">
                    <a class="button point rgstr">수정</a>
                </div>

            </form>

            <h2 class="subtitle">보험 가입 정보
                <a href="/contract_reg" class="button new-regis"><i class="icon-plus">등록</i>신규 등록</a>
            </h2>
            <div class="table-box mgT10">
                <table>
                    <colgroup>
                        <col width="50px;">
                        <col width="7%">
                        <col width="10%">
                        <col width="10%">
                        <col width="7%">
                        <col width="13%">
                        <col width="7%">
                        <col width="7%">
                        <col width="7%">
                        <col width="7%">
                        <col width="7%">
                        <col width="*">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>종목</th>
                            <th>상품명</th>
                            <th>증권번호</th>
                            <th>청약일</th>
                            <th>보험 기간</th>
                            <th>보험료</th>
                            <th>피보험자</th>
                            <th>취급<br />담당자 </th>
                            <th>부<br />담당자</th>
                            <th>상태</th>
                            <th>기타</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$INSURANCEPRODUCTLISTTR?>
                    </tbody>
                </table>
            </div>

            <h2 class="subtitle">히스토리</h2>
            <div class="history-box">
                <ul class="clearfix inb">
                    <?=$INSURANCEPRODUCTLISTHISTORYTR?>
                </ul>
            </div>
        </div>


        
<script>
    // 수정 버튼 클릭시 고객 정보 수정
    // 씨리얼라이즈를 이용해서 form 데이터를 전달 한다.
    // form 의 id 를 이용해서 데이터를 전달한다.
    //ajax_customer_update_proc
    $('.rgstr').on('click', function(){
        var form = $('#customer_update_form');
        var formData = form.serialize();
        $.ajax({
            url: '/customer/ajax_customer_update_proc',
            type: 'post',
            data: formData,
            dataType: "json",
            success: function(data){
                if(data.result == 'success'){
                    alert('고객 정보가 수정 되었습니다.');
                    // alert(data.msg);
                } else {
                    alert('고객 정보 수정에 실패 했습니다.');
                    // alert(data.msg);
                }
            }
        });
    });









</script>