<div class="servContents erp">

<div class="menu-box">
    <button type="button" class="btn menuBtn" title="메뉴 닫기">
        <span></span>
    </button>

    <div class="inner">
        <ul class="menu-cont-item">
            <li class="list-item <?=($menuNo[0]==0)?"active":""?>"><span>통계</span>
                <ul class="items">
                    <li class="<?=($menuNo[0]==0 && $menuNo[1]==1)?"on":""?>"><a href="/dashboard">대시보드</a></li>
                </ul>
            </li>

<?php
// 회계관리 권한이 있을 경우 start
if (
    $_SESSION['CRM_LEVEL'] == '99'
    || $_SESSION['CRM_AUTH_FINANCIAL_MANAGEMENT'] == 'Y'
    || $_SESSION['CRM_DEPT'] == '003'
    || $_SESSION['CRM_DEPT'] == '001' 
    ) {
?>
            <li class="list-item <?=($menuNo[0]==1)?"active":""?>"><span>회계관리</span>
                <ul class="items">
                    <li class="<?=($menuNo[0]==1 && $menuNo[1]==1)?"on":""?>"><a href="/salesBreakdown">매출 내역</a></li>
                    <li class="<?=($menuNo[0]==1 && $menuNo[1]==2)?"on":""?>"><a href="/purchaseBreakdown">매입 내역</a></li>
                    <li class="<?=($menuNo[0]==1 && $menuNo[1]==3)?"on":""?>"><a href="/cardBreakdown">법인카드 사용내역</a></li>
                    <li class="<?=($menuNo[0]==1 && $menuNo[1]==4)?"on":""?>"><a href="/insuranceCompanyBreakdown">마감 내역</a></li>
                </ul>
            </li>
<?php 
}   // 계약관리 권한이 있을 경우 end
?>
            <li class="list-item <?=($menuNo[0]==2)?"active":""?>"><span>계약관리</span>
                <ul class="items">
                    <li class="<?=($menuNo[0]==2 && $menuNo[1]==1)?"on":""?>"><a href="/" class="cantClick">보험료 매출/수익</a></li>
                    <li class="<?=($menuNo[0]==2 && $menuNo[1]==2)?"on":""?>"><a href="/" class="cantClick">계약업로드</a></li>
                </ul>
            </li>

            <li class="list-item <?=($menuNo[0]==3)?"active":""?>"><span>기초 정보 관리</span>
                <ul class="items">
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==3)?"on":""?>"><a href="/salesUploadBreakdown">매출 내역 업로드</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==2)?"on":""?>"><a href="/purchaseUploadBreakdown">매입 내역 업로드</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==1)?"on":""?>"><a href="/cardUploadBreakdown">법인카드 사용내역 업로드</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==9)?"on":""?>"><a href="/insuranceCompanyExcelUpload">마감 내역 업로드</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==8)?"on":""?>"><a href="/cardInfo">법인카드 정보</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==4)?"on":""?>"><a href="/erpCustomerInfo">거래처 정보</a></li>
                    <!-- li class="<?=($menuNo[0]==3 && $menuNo[1]==4)?"on":""?>"><a href="/erpCustomerInfo_reg">거래처 등록 </a></!-->
                    <!-- li class="<?=($menuNo[0]==3 && $menuNo[1]==5)?"on":""?>"><a href="/erpInsuranceCompanyInfo">보험사 정보</a></!-->
                    <!-- li class="<?=($menuNo[0]==3 && $menuNo[1]==6)?"on":""?>"><a href="/erpBasicInfoManagement">보험상품 정보</a></!-->
                    <!-- li class="<?=($menuNo[0]==3 && $menuNo[1]==7)?"on":""?>"><a href="/erpMemberInfo">회원 정보</a></!-->
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==5)?"on":""?>"><a href="/insuranceCompany">보험사 정보</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==6)?"on":""?>"><a href="/insuranceProduct">보험상품 정보</a></li>
                    <li class="<?=($menuNo[0]==3 && $menuNo[1]==7)?"on":""?>"><a href="/member">회원 정보</a></li>
                </ul>
            </li>

        </ul>
    </div>
    
</div>

<script>
    const list = document.querySelectorAll('.list-item');
    function accordion(e) {
    e.stopPropagation();
    if (this.classList.contains('active')) {
        this.classList.remove('active');
    } else
    if (this.parentElement.parentElement.classList.contains('active')) {
        this.classList.add('active');
    } else
    {
        for (i = 0; i < list.length; i++) {
        list[i].classList.remove('active');
        }
        this.classList.add('active');
    }
    }
    for (i = 0; i < list.length; i++) {
    list[i].addEventListener('click', accordion);
    }
</script>