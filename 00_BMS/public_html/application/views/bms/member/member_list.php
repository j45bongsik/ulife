    <div class="conts-box">
        <h1>회원 관리</h1>
        
        <h2 class="subtitle">회원 리스트</h2>
        <div class="memb-table mgT15">
            <table>
                <colgroup>
                    <col width="4%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="10%">
                    <col width="12%">
                    <col width="*">
                    <col width="10%">
                    <col width="10%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>하이웍스 아이디</th>
                        <th>휴대폰</th>
                        <th>이메일</th>
                        <th>권한</th>
                        <th>최종 로그인</th>
                        <th>등록일</th>
                        <th>상태</th>
                    </tr>
                </thead>
                <tbody>
<?php
//print_r($DATA['LISTDATA']);

// 데이터가 없으면 '관리자가 없습니다.' 라는 문구를 출력한다.
if(sizeof($DATA['LISTDATA']) == 0){
?>
                    <tr>
                        <td colspan="10">관리자가 없습니다.</td>
                    </tr>
<?php
} else {
    // 데이터가 있으면 데이터를 출력한다.
    foreach($DATA['LISTDATA'] as $key => $val){

?>
                    <tr>
                        <td><?php echo $val['admin_no']; ?></td>
                        <td><?php echo $val['adminId']; ?></td>
                        <td><?php echo $val['adminName']; ?></td>
                        <td><?php echo $val['adminHwId']; ?></td>
                        <td class="hypenTel"><?php echo $val['adminMobile']; ?></td>
                        <td><?php echo $val['adminEmail']; ?></td>
                        <td><?php echo $val['authCustomerAccount']; ?> <?php echo $val['authInsuranceContract']; ?> <?php echo $val['authBasicInformation']; ?></td>
                        <td><?php echo $val['lastLogin']; ?></td>
                        <td><?php echo $val['regdate']; ?></td>
                        <td><?php echo $val['admin_STATUS']; ?></td>
                    </tr>
                    
<?php
    }
}
?>                
                </tbody>
            </table>
            
            <div class="btn-pot-right">
                <a href="/member_reg" class="button point rgstr">등록</a>
            </div>
            <?php //include $_SERVER['DOCUMENT_ROOT']."/CRM/service/pagination.php"; ?>

            <div class="paginate">
                <?=$DATA['pagination']?>
            </div>

        </div>
    </div>