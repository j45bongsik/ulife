<!--  CSS 프레임워크 중 부트스크랩 가져오기  -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">



<div class="conts-box"> 

<table style="border:1px" class='table table-list'>
    <tr>
        <th>no</th>
        <th>구분</th>
        <th>법인명</th>
        <th>업종</th>
        <th>업종코드</th>
        <th>대표자명</th>
        <th>사업자번호</th>
        <th>주민번호</th>
        <!-- <th>주민번호암호화</th> -->
        <th>담당자명</th>
        <th>담당자직책</th>
        <th>담당자부서</th>
        <th>담당자전화</th>
        <th>담당자휴대폰</th>
        <th>전화번호</th>
        <th>홈페이지</th>
        <th>이메일</th>
        <th>관리경로</th>
        <th>지번주소</th>
        <th>도로명주소</th>
        <th>상세주소</th>
        <th>참고항목</th>
        <th>우편번호</th>
        <th>메모</th>
        <th>고객담당자</th>
        <th>삭제여부</th>
        <th>수정일</th>
        <th>등록일</th>
    </tr>
<?php
// CUSTOMERLIST : 고객사 리스트 변수 리스트 대로 모두 보여준다 
echo "총 ". count($CUSTOMERLIST) ."개의 고객사가 있습니다.";

foreach($CUSTOMERLIST as $key => $val){
?>
<tr>
    <td style="font-size:9px;"><?php echo $val->no; ?></td>
    <td style="font-size:9px;"><?php echo $val->division; ?></td>
    <td style="font-size:9px;"><?php echo $val->customer_name; ?></td>
    <td style="font-size:9px;"><?php echo $val->industry; ?></td>
    <td style="font-size:9px;"><?php echo $val->industry_code; ?></td>
    <td style="font-size:9px;"><?php echo $val->ceo_name; ?></td>
    <td style="font-size:9px;"><?php echo $val->business_number; ?></td>
    <td style="font-size:9px;"><?php echo $val->resident_number; ?></td>
    <!-- <td style="font-size:9px;"><?php echo $val->resident_number_encrypt; ?></td> -->
    <td style="font-size:9px;"><?php echo $val->manager_name; ?></td>
    <td style="font-size:9px;"><?php echo $val->manager_position; ?></td>
    <td style="font-size:9px;"><?php echo $val->manager_dept; ?></td>
    <td style="font-size:9px;"><?php echo $val->manager_tel; ?></td>
    <td style="font-size:9px;"><?php echo $val->manager_mobile; ?></td>
    <td style="font-size:9px;"><?php echo $val->tel; ?></td>
    <td style="font-size:9px;"><?php echo $val->homepage; ?></td>
    <td style="font-size:9px;"><?php echo $val->email; ?></td>
    <td style="font-size:9px;"><?php echo $val->management_channel; ?></td>
    <td style="font-size:9px;"><?php echo $val->jibun_address; ?></td>
    <td style="font-size:9px;"><?php echo $val->road_address; ?></td>
    <td style="font-size:9px;"><?php echo $val->detail_address; ?></td>
    <td style="font-size:9px;"><?php echo $val->extra_address; ?></td>
    <td style="font-size:9px;"><?php echo $val->postcode; ?></td>
    <td style="font-size:9px;"><?php echo $val->memo; ?></td>
    <td style="font-size:9px;"><?php echo $val->customer_manager; ?></td>
    <td style="font-size:9px;"><?php echo $val->del_yn; ?></td>
    <td style="font-size:9px;"><?php echo $val->update_date; ?></td>
    <td style="font-size:9px;"><?php echo $val->regdate; ?></td>
</tr>
<?php
}
?>
</table>


</div>