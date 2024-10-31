
</div><!-- end class="servContents" -->

  <!-- design Js -->
  <script type="text/javascript" src="/assets/js/design.js"></script>

<!--
    <div>
      (주)BIS | 사업자등록번호 : 123-45-67890 | 문의번호 : 02-123-4567<br/>
      대표자 : 김정훈 | 서울 중구 퇴계로 324 10층 (ㅇㅇㅇㅇ 12-34)<br/>
      Copyright © 2023. bis All rights reserved.
    </div>
-->
<div class="topArea">
  <button type="button" class="btn goTop">
    <svg height="1.2em" class="arrow" viewBox="0 0 512 512"><path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"></path></svg>
  </button>
</div>

<script>

document.querySelector('.conts-box').addEventListener('scroll', function() {
    let scrollPosition = this.scrollTop;

    let topArea = document.querySelector('.topArea');
    
    if (scrollPosition >= 300) {
      topArea.classList.add('active')
    } else {
      topArea.classList.remove('active')
    }
});



document.querySelector('.goTop').addEventListener('click', function(){
    let contBox = document.querySelector('.conts-box');
    contBox.scrollTo({
        top: 0,
        behavior: 'smooth' // 부드러운 스크롤 효과를 적용
    });
})



</script>

</body>
</html>