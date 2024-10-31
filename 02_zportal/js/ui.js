$(function(){

    // .btn태그에 .ripple 클래스 클릭&터치시 좌표값을 기준으로 애니메이션 효과
    document.querySelectorAll('.ripple').forEach(function(ripples){ 
        ripples.addEventListener('click', function(e){ 
            let event = e.touches ? e.touches[0] : e; 

            let getBounding = ripples.getBoundingClientRect(); 
            let duration = Math.sqrt(Math.pow(getBounding.width, 2) + Math.pow(getBounding.height, 2)) * 2; 
            
            ripples.style.cssText = `--s: 0; --0: 1;`; 
            ripples.offsetTop; 
            ripples.style.cssText = `--t: 1; --o: 0; --d: ${duration}; --x:${event.clientX - getBounding.left}; --y:${event.clientY - getBounding.top};`; 
        }) 
    }) 

    //tab 기능
    document.querySelectorAll('.tabArea').forEach(function(tabFunc){
        tabFunc.querySelectorAll('.tabList li .btn').forEach(function(tabBtns, tabIndex){
            tabBtns.addEventListener('click', function(event){
                // 엘리먼트 추적
                let action = event.target;
                let liTag = action.closest('li');
                let tabArea = action.closest('.tabArea');
                let siblingsLiTag = tabArea.querySelectorAll('.tabList li');
                let tabConts = tabArea.querySelectorAll('.tabCont');

                let radio = liTag.querySelector('.radio input[type="radio"]');

                siblingsLiTag.forEach(function(siblings){
                    if(siblings.closest('.tabArea') === tabArea) {
                        siblings.classList.remove('active');
                    }
                });

                if (liTag.closest('.tabArea') === tabArea) {
                    liTag.classList.add('active');
                }

                tabConts.forEach(function(tabCont){
                    let tabAreaParent = tabCont.closest('.tabArea');
                    
                    if (tabAreaParent === tabArea) {
                        if (Array.prototype.indexOf.call(tabConts, tabCont) === tabIndex) {
                            tabCont.classList.add('active');
                        } else {
                            tabCont.classList.remove('active');
                        }
                    }
                })

                if (radio) {
                    radio.checked = true;
                }

            })
        })
    })

})
