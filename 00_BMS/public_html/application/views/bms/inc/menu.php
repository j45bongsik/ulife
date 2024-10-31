<div class="servContents bms">
        
    <div class="menu-box">
        <button type="button" class="btn menuBtn" title="메뉴 닫기">
            <span></span>
        </button>
        <div class="inner">
            
            <ul class="menu-cont-item">
                <li class="list-item <?=($menuNo[0]==2)?"active":""?>"><span>고객(사) 관리</span>
                    <ul class="items">
                        <li class="<?=($menuNo[0]==2 && $menuNo[1]==1)?"on":""?>"><a href="/customer">전체 리스트</a></li>
                        <li class="<?=($menuNo[0]==2 && $menuNo[1]==1)?"on":""?>"><a href="/customer2">RealGrid test</a></li>
                        <li class="<?=($menuNo[0]==2 && $menuNo[1]==2)?"on":""?>"><a href="/customer_reg">고객 등록</a></li>
                    </ul>
                </li>
                
                <li class="list-item <?=($menuNo[0]==3)?"active":""?>"><span>보험 계약 관리</span>
                    <ul class="items">
                        <li class="<?=($menuNo[0]==3 && $menuNo[1]==1)?"on":""?>"><a href="/contract">전체 리스트</a></li>
                        <li class="<?=($menuNo[0]==3 && $menuNo[1]==2)?"on":""?>"><a href="/contract_reg">계약 등록</a></li>
                    </ul>
                </li>
                <li class="list-item <?=($menuNo[0]==4)?"active":""?>"><span>기초 정보</span>
                    <ul class="items">
                        <li class="<?=($menuNo[0]==4 && $menuNo[1]==1)?"on":""?>"><a href="/insuranceCompany">보험사 관리</a></li>
                        <li class="<?=($menuNo[0]==4 && $menuNo[1]==2)?"on":""?>"><a href="/insuranceProduct">보험상품 관리</a></li>
                        <li class="<?=($menuNo[0]==4 && $menuNo[1]==3)?"on":""?>"><a href="/member">회원 관리</a></li>
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