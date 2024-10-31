<div class="conts-box" >
    <div class="titleArea">
        <h1>보험상품 추가</h1>
        <span class="essential">* 는 필수 항목 입니다.</span>
    </div>

    <form action="insuranceproductRegProc" name="insuranceProduct" id="insuranceProduct" method="POST" enctype="multipart/form-data">
        <section class="regBox" style="max-width: 940px;">
            <article class="erpList reg">
                <table>
                    <caption>
                        보험상품 추가 테이블로 보험사/부서, 보험종목, 상품명, 내부담당, 상품수수료, 추가수수료, 상품설명, 제출서류 정보, 자료파일, erp를 통해 접근시 추가로 플랜정보까지의 정보를 제공합니다<div class=""></div>
                    </caption>
                    <colgroup>
                        <col style="width: 175px;">
                        <col style="width: auto;">
                        <col style="width: 175px;">
                        <col style="width: auto;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="insuranceCompanyCate" class="essential">
                                    보험사/부서
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <div class="select-custom">
                                        <select name="insuranceCompanyCate" id="insuranceCompanyCate" required>
                                            <?=$INSURANCECOMPANYDIVISIONLISTSELECTBOX;?>
                                        </select>
                                    </div>
                                    <div class="select-custom">
                                        <select name="insuranceCompanyDeptName" id="insuranceCompanyDeptName" required>
                                            <option value="" selected>부서/채널 선택</option>
                                        </select>
                                    </div>
                                </div>
                            </td>

                            <th scope="row">
                                <label for="insuranceClassification" class="essential">
                                    보험종목
                                </label>
                            </th>
                            <td>
                                <div class="inputArea">
                                    <div class="select-custom">
                                        <select name="insuranceClassification" id="insuranceClassification" required>
                                            <?=$INSURANCECLASSIFICATIONSELECTBOX;?>
                                        </select>
                                    </div>
                                    
                                    <div class="select-custom">
                                        <select name="insuranceType" id="insuranceType" required>
                                            <option value="" selected>종목 선택</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="insuranceProductName" class="essential">
                                    상품명
                                </label>
                            </th>
                            <td>
                                <input type="text" name="insuranceProductName" id="insuranceProductName" placeholder="상품명 입력" value="" required>
                            </td>
                            <th scope="row">
                                <label for="internalContactPerson">
                                    내부 담당
                                </label>
                            </th>
                            <td>
                                <div class="select-custom">
                                    <select name="internalContactPerson" id="internalContactPerson">
                                        <?=$INTERNALCONTACTPERSONLISTSELECTBOX;?>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="insuranceProductCommission" class="essential">
                                    상품수수료
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <input type="number" name="insuranceProductCommission" id="insuranceProductCommission" class="textRight" placeholder="0" value="" required>
                                    <span class="between">
                                        %
                                    </span>
                                </div>
                            </td>
                            <th scope="row">
                                <label for="YES">
                                    추가수수료
                                </label>
                            </th>
                            <td>
                                <div class="checkArea">
                                    <div class="radiobox">
                                        <input id="YES" class="radio-custom" name="insuranceProductAdditionalCommission" value="Y" type="radio">
                                        <label for="YES" class="radio-custom-label">예</label>
                                    </div>
                                    <div class="radiobox">
                                        <input id="NO" class="radio-custom" name="insuranceProductAdditionalCommission" value="N" type="radio">
                                        <label for="NO" class="radio-custom-label">아니요</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="insuranceProductDescription">
                                    상품 설명
                                </label>
                            </th>
                            <td colspan="3">
                                <textarea name="insuranceProductDescription" id="insuranceProductDescription" class="textarea" placeholder="추가 사항 입력"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="insuranceProductDocument">
                                    제출서류 정보
                                </label>
                            </th>
                            <td colspan="3">
                                <textarea name="insuranceProductDocument" id="insuranceProductDocument" class="textarea" placeholder="보험 확인에 필요한 서류 입력"></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <th scope="row">
                                <label for="insuranceProductDocumentFile" >
                                    자료파일
                                </label>
                            </th>

                            <td colspan="3">
                                <div class="file-add">
                                    <!-- 
                                        <input type="file" name="str-Image1" id="fileAdd" class="add-file-input class-img">
                                        <div class="add-file-txt">파일선택</div>
                                        <label for="fileAdd"><div class="add-file-btn">찾아보기</div></label>
                                    -->
                                    <!-- 파일 업로드 다시 개발 S -->
                                    <article class="filecontainer">
                                        <label class="filelabel" id="label" for="insuranceProductDocumentFile">
                                            <!-- 점선으로 테두리 있는 박스  -->
                                            <div class="fileinner" id="inner">드래그하거나 클릭해서 업로드(최대 5개)</div>
                                        </label>
                                        <input type="file" name="insuranceProductDocumentFile[]" id="insuranceProductDocumentFile" multiple class="input" accept="image/*, .pdf" hidden="true"  >
                                        <p class="noFile">등록된 자료파일이 없습니다.</p>
                                        <!-- <span class="filepreview" id="preview"></span> -->
                                        <ul class="filepreview" id="preview">

                                        </ul>
                                    </article>
                                    <!-- 파일 업로드 다시 개발 E -->
                                </div>
                            </td>
                            
                        </tr>
                        <!-- 아래 tr은 erp에서 접근했을때만 추가 되도록 해주세요 -->
                        <?=$PLANINFOTR?>
                    </tbody>
                </table>
            </article>

            <div class="btn-box-conts">
                <input type="submit" class="button point rgstr"></input>
            </div>
        </section>
        
    </form>
</div>

<script>


// 추가 버튼을 클릭하면 등록 처리를 한다.
function submitForm(){    
    
    // 폼의 데이터를 모두 입력했는지 확인한다. S
    var insuranceCompanyCate = $("#insuranceCompanyCate").val();
    var insuranceCompanyDeptName = $("#insuranceCompanyDeptName").val();
    var insuranceClassification = $("#insuranceClassification").val();
    var insuranceType = $("#insuranceType").val();
    var insuranceProductName = $("#insuranceProductName").val();
    var internalContactPerson = $("#internalContactPerson").val();
    var insuranceProductCommission = $("#insuranceProductCommission").val();
    // input type="radio" 는 checked 된 value 값을 가져온다.
    var insuranceProductAdditionalCommission = $("input[name='YESNO']:checked").val();
    var insuranceProductDescription = $("#insuranceProductDescription").val();
    var insuranceProductDocument = $("#insuranceProductDocument").val();
    
    var insuranceProductDocumentFile = document.getElementById("insuranceProductDocumentFile");
    
    var insuranceProductDocumentFile = insuranceProductDocumentFile.files;
    //console.log(insuranceProductDocumentFile);

    // 등록 프로세서로 보낼 데이터를 만든다.
    var url = "/insuranceproductRegProc";
    var formData = new FormData();
    formData.append("insuranceCompanyCate", insuranceCompanyCate);
    formData.append("insuranceCompanyDeptName", insuranceCompanyDeptName);
    formData.append("insuranceClassification", insuranceClassification);
    formData.append("insuranceType", insuranceType);
    formData.append("insuranceProductName", insuranceProductName);
    formData.append("internalContactPerson", internalContactPerson);
    formData.append("insuranceProductCommission", insuranceProductCommission);
    formData.append("insuranceProductAdditionalCommission", insuranceProductAdditionalCommission);
    formData.append("insuranceProductDescription", insuranceProductDescription);
    formData.append("insuranceProductDocument", insuranceProductDocument);
    
    /*
    for(var i=0; i<insuranceProductDocumentFile.length; i++){
        formData.append("insuranceProductDocumentFile", insuranceProductDocumentFile[i]);
    }
    */

    
    // 씨리얼라이즈로 폼의 데이터를 가져온다.
    // var formData = $("#insuranceProduct").serialize();
    // var url = "/insuranceproductRegProc";

    // var insuranceProductDocumentFile = document.getElementById("insuranceProductDocumentFile");
    
    // var insuranceProductDocumentFile = insuranceProductDocumentFile.files;
    // console.log(insuranceProductDocumentFile);
    
    // console.log(formData);

    // console.log(" size => " + insuranceProductDocumentFile.length);
    // formData 에 데이터가 잘 들어갔는지 확인한다. for (var pair of formData.entries()) { console.log(pair[0]+ ', ' + pair[1]); }


    $.ajax({
        method: 'POST',
        url: url,
        processData: false,
        contentType: false,
        dataType: 'json',
        data: formData,
        async: false,
        //cache: false,
        //headers: {'cache-control': 'no-cache', 'pragma': 'no-cache'},
        success: function (data) {
            if(data.result == "success"){
                alert(data.msg);
                // 리스트 페이지로 이동한다.
                //location.href = "/insuranceproduct";
            } else {
                alert(data.msg);
                //console.log(data);
            }
        },
        error: function(data) {
            //console.log("error");
            //console.log(data);
        }
    })

}


// insuranceCompanyCate 를 선택시 insuranceCompanyDeptName 을 변경 시킨다.
// 해당 보험사의 부서를 선택할 수 있도록 한다.
// 리턴 받는 data 는 json 형태로 받는다.
// data 에 insuranceCompanyDeptName select box 를 만들어서 넣어준다.
// insuranceCompanyDeptName 의 option 의 value 는 insuranceCompanyDeptName 의 seq 를 넣어준다.
// insuranceCompanyDeptName 의 option 의 text 는 insuranceCompanyDeptName 의 name 을 넣어준다.

$("#insuranceCompanyCate").change(function(){
    var insuranceCompanyCate = $("#insuranceCompanyCate").val();
    //var url = "/insuranceproduct/getInsuranceCompanyDeptNameListByInsuranceCompanyCate";
	//var url = "/insurancecompany_SelectBox";
	var url = "/getInsuranceCompanyDeptNameListByInsuranceCompanyCate";
    var data = {
        "insuranceCompanyCate": insuranceCompanyCate
    };
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function(data) {
			//console.log(data);
			$("#insuranceCompanyDeptName").html(data.html);
            if(data.result != "success"){
                alert(data.msg);
            }
        },
        error: function(data) {
			//console.log(data);
            alert("error");
        }
    });
});



// insuranceClassification 을 선택시 insuranceType 을 변경 시킨다.
$("#insuranceClassification").change(function(){
    var insuranceClassification = $("#insuranceClassification").val();
    //var url = "/insuranceproduct/getInsuranceTypeListByInsuranceClassification";
    var url = "/getInsuranceTypeListByInsuranceClassification";
    var data = {
        "insuranceClassification": insuranceClassification
    };
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function(data) {
            var insuranceTypeListSelectBox = "";
            if(data.result == "success"){
                $("#insuranceType").html(data.html);
            } else {
                $("#insuranceType").html(data.html);
                alert(data.msg);
            }
        },
        error: function(data) {
            alert("error");
        }
    });
});

// 파일 업로드 다시 개발 S
var insuranceProductDocumentFile = document.getElementById("insuranceProductDocumentFile");
var initLabel = document.getElementById("label");
var maxFileCnt = 5;

insuranceProductDocumentFile.addEventListener("change", (event) => {
    const files = changeEvent(event);

    let parentElement = insuranceProductDocumentFile.parentNode; // 부모노드
    let siblingUls = parentElement.children; // 부모 노드의 자식 들

    let filePreview = findUl(parentElement)
    let noFile = findPtag(parentElement)

    if (filePreview, noFile) {
        let liElements = filePreview.querySelectorAll('li')
        let liLength = liElements.length;
        if (liLength >= 0) {
            filePreview.classList.add('on')
            noFile.classList.add('off')
        } else {
            filePreview.classList.remove('on')
            noFile.classList.remove('off')
        }

    }

    // filepreview 클래스를 가진 태그 찾기
    function findUl(parentNode) {
        let siblings = parentNode.children;
        for (var i = 0; i < siblingUls.length; i++) {
            let siblingUl = siblingUls[i]
            if(siblingUl !== this && siblingUl.classList.contains('filepreview')) {
                return siblingUl
            }
        }
        return null;
    }

    // noFile 클래스를 가진 태그 찾기
    function findPtag(parentNode) {
        let siblings = parentNode.children;
        for (var i = 0; i < siblingUls.length; i++) {
            let siblingUl = siblingUls[i]
            if(siblingUl !== this && siblingUl.classList.contains('noFile')) {
                return siblingUl
            }
        }
        return null;
    }

    // 파일의 개수는 최대 5개까지만 가능합니다. 그리고 자동으로 5개까지만 받습니다.
    if(files.length > maxFileCnt){
        alert("파일은 5개까지만 업로드 가능합니다.");
        files = files.slice(0, maxFileCnt);
    }

    handleUpdate(files);

});

// 파일 삭제 버튼 클릭시
document.querySelector('.filecontainer').addEventListener('click', (event) => {
    if (event.target.classList.contains('fileDelete')) {
        // '.fileDelete'를 클릭한 경우
        let closestLi = event.target.closest('li');
        let parentUl = event.target.closest('.filepreview')
        
        let liLength = parentUl.children.length;
        closestLi.remove()
        
        let fileContainer = parentUl.parentNode;
        let siblingsNofile = fileContainer.children;


        if (liLength <= 1) {
            parentUl.classList.remove('on')
                for (var i = 0; i< siblingsNofile.length; i++) {
                let sibling = siblingsNofile[i]
                if (sibling !== this && sibling.classList.contains('noFile')) {
                    sibling.classList.remove('off')
                }
            }
        }
    }
});


// 마우스 오버시에는 label 의 배경색을 바꿔준다.
initLabel.addEventListener("mouseover", (event) => {
    event.preventDefault();
    const label = document.getElementById("label");
    label?.classList.add("label--hover");
});


// 마우스 아웃시에는 label 의 배경색을 원래대로 바꿔준다.
initLabel.addEventListener("mouseout", (event) => {
    event.preventDefault();
    const label = document.getElementById("label");
    label?.classList.remove("label--hover");
});

// 드래그시에는 label 의 배경색을 바꿔준다.
document.addEventListener("dragenter", (event) => {
    event.preventDefault();
    if (event.target.className === "fileinner") {
        // event.target.style.background = "#616161";

        event.target.style.background = "#ebf2ff";
        event.target.style.color = "#0b5eff";
        event.target.style.border = "2px dashed #0b5eff";
    }
});

// 드래그시에는 label 의 배경색을 바꿔준다.
document.addEventListener("dragover", (event) => {
    event.preventDefault();
});

// 드래그시에는 label 의 배경색을 바꿔준다.
document.addEventListener("dragleave", (event) => {
    event.preventDefault();
    if (event.target.className === "fileinner") {
        // event.target.style.background = "#3a3a3a";

        event.target.style.background = "#fff";
        event.target.style.color = "#bbbbbb"
        event.target.style.border = "2px dashed #cccccc";
    }
});

// 드래그&드랍시 배경색 변경과 파일 처리
document.addEventListener("drop", (event) => {
    event.preventDefault();
    if (event.target.className === "fileinner") {
        const files = event.dataTransfer?.files;
        // event.target.style.background = "#3a3a3a";

        event.target.style.background = "#fff";
        event.target.style.color = "#bbbbbb"
        event.target.style.border = "2px dashed #cccccc";

        console.log(files.length)

        // 파일의 개수는 최대 5개까지만 가능합니다 그리고 자동으로 5개 까지만 받습니다.
        if(files.length > maxFileCnt){
            alert("파일은 "+maxFileCnt+"개까지만 업로드 가능합니다.");
            files = files.slice(0, maxFileCnt);
        }

        
        let parentElement = insuranceProductDocumentFile.parentNode; // 부모노드
        let siblingUls = parentElement.children; // 부모 노드의 자식 들

        let filePreview = findUl(parentElement)
        let noFile = findPtag(parentElement)

        if (filePreview, noFile) {
            let liElements = filePreview.querySelectorAll('li')
            let liLength = liElements.length;
            console.log(liLength)
            if (liLength >= 0) {
                filePreview.classList.add('on')
                noFile.classList.add('off')
            } else {
                filePreview.classList.remove('on')
                noFile.classList.remove('off')
            }

        }

        // filepreview 클래스를 가진 태그 찾기
        function findUl(parentNode) {
            let siblings = parentNode.children;
            for (var i = 0; i < siblingUls.length; i++) {
                let siblingUl = siblingUls[i]
                if(siblingUl !== this && siblingUl.classList.contains('filepreview')) {
                    return siblingUl
                }
            }
            return null;
        }

        // noFile 클래스를 가진 태그 찾기
        function findPtag(parentNode) {
            let siblings = parentNode.children;
            for (var i = 0; i < siblingUls.length; i++) {
                let siblingUl = siblingUls[i]
                if(siblingUl !== this && siblingUl.classList.contains('noFile')) {
                    return siblingUl
                }
            }
            return null;
        }

        handleUpdate([...files]);

    }
});


function changeEvent(event){
    const { target } = event;
    return [...target.files];
};

// 파일에 대한 정보를 받아서 preview 에 띄워준다.
/*
추후 고민 할 것 
UI상으로 새로 자료파일이 업로드 되면 예를들어 처음에 1개 올리고 또 다른 폴더에서 3개 올릴때 기존에 올라와 보이는 1개의 파일을 삭제를 해서 안보이게 해야 하는데
지금은 4개가 보이고 백엔드로는 나중에 들어간 3개만 들어가는 상황이다.
*/
function handleUpdate(fileList){
    const preview = document.getElementById("preview");

    // preview 의 자식 노드의 개수가 5개 이면 alert 를 띄우고 5개 까지만 받는다.
    if(preview.childElementCount == maxFileCnt){
        alert("파일은 "+maxFileCnt+"개까지만 업로드 가능합니다.");
        return;
    }

    // fileList 의 개수가 5개 보다 크면 alert 를 띄우고 5개 까지만 받는다.
    if(fileList.length > maxFileCnt){
        alert("파일은 "+maxFileCnt+"개까지만 업로드 가능합니다.");
        fileList = fileList.slice(0, maxFileCnt);
    }

    fileList.forEach((file) => {
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {

            const img = el("img", {
                className: "embed-img",
                src: event.target?.result,
                id: "test",
                onClick:"window.open(this.src)" 
            });
            
            const imgContainer = el("li", { className: "container-img" }, img);
            
            // p태그와 button 태그를 감쌀 div 추가
            new_divTag = document.createElement('div');


            // 파일 이름을 html 로 append 해준다.
            let new_pTag = document.createElement('p');
            let file_name = file.name;
            new_pTag.innerHTML = file_name;


            // 삭제 버튼을 추가한다.
            let new_bTag = document.createElement('button')
            new_bTag.setAttribute("type", "button");
            new_bTag.setAttribute("class", "btn fileDelete");
            new_bTag.setAttribute("title", file_name + " 삭제");

            imgContainer.append(new_divTag);
            new_divTag.append(new_pTag);
            new_divTag.append(new_bTag)


            preview.append(imgContainer);
        });
        reader.readAsDataURL(file);
    });

};

function el(nodeName, attributes, ...children) {
    const node =
    nodeName === "fragment"
        ? document.createDocumentFragment()
        : document.createElement(nodeName);

    Object.entries(attributes).forEach(([key, value]) => {
        if (key === "events") {
            Object.entries(value).forEach(([type, listener]) => {
                node.addEventListener(type, listener);
            });
        } else if (key in node) {
            try {
                node[key] = value;
            } catch (err) {
                node.setAttribute(key, value);
            }
        } else {
            node.setAttribute(key, value);
        }
    });

    children.forEach((childNode) => {
        if (typeof childNode === "string") {
            node.appendChild(document.createTextNode(childNode));
        } else {
            node.appendChild(childNode);
        }
    });

    return node;
}

// 파일 업로드 다시 개발 E


// 보험종목 select 선택하면 상품명 입력
document.getElementById('insuranceType').addEventListener('change', function(event){
    let selectTag = event.target;
    let selectText = selectTag.options[selectTag.selectedIndex].innerText;
    let insertInput = document.getElementById('insuranceProductName');

    insertInput.setAttribute('value', selectText);
})


// input 태그에 onlyEnNumber 클래스가 있으면 영어+숫자만 입력되게
document.addEventListener('keyup', function(event) {
    if (event.target.classList.contains('onlyEnNumber')) {
        let inputValue = event.target.value;
        let filteredValue = inputValue.replace(/[^a-zA-Z0-9]/g, '');

        event.target.value = filteredValue;
    }
});

// input 태그에 포커스가 떠날 때 입력 필드의 값을 정리
// (input에 입력된 문자열의 끝자리가 text일 경우 입력된 값이 출력되는것을 처리)
document.addEventListener('focusout', function(event) {
    if (event.target.classList.contains('onlyEnNumber')) {
        let inputValue = event.target.value;
        let filteredValue = inputValue.replace(/[^a-zA-Z0-9]/g, '');
        
        event.target.value = filteredValue;
    }
});



// 플랜 정보 추가
document.addEventListener('DOMContentLoaded', function() {
    let planAddButton = document.getElementById('planAdd');

    if (planAddButton) {
        planAddButton.addEventListener('click', function(event) {
            
            //엘리먼트 추적
            let planInfoName = document.getElementById('planInfoName');
            let planInfoSummary = document.getElementById('planInfoSummary');

            // 플랜명, 요약설명 비어있을때
            if (planInfoName.value == '' && planInfoSummary.value == '') {
                alert('플랜 정보를 입력하세요.');
                planInfoName.focus();
                return false;
            
            // 플랜명만 비어있을때
            } else if (planInfoName.value == '') {
                alert('플랜명을 입력하세요.');
                planInfoName.focus();
                return false;

            // 요약설명만 비어있을때
            } else if (planInfoSummary.value == '') {
                alert('요약설명을 입력하세요.');
                planInfoSummary.focus();
                return false;

            // 플랜명 요약설명 작성되었을때
            } else {

                /* ===== 코드를 추가하기위한 엘리먼트 생성 S ===== */
                // li 생성
                let liElement = document.createElement('li');

                // hiddenBox 생성
                let hiddenBox = document.createElement('div');
                hiddenBox.className = 'hiddenBox';
                liElement.appendChild(hiddenBox); // 생성된 li 자식으로 추가

                // resultBox 생성
                let resultBox = document.createElement('div');
                resultBox.className = 'resultBox';
                liElement.appendChild(resultBox); // 생성된 li 자식으로 추가

                // 플랜명 value값 담을 input[hidden] 생성
                let planNameResult = document.createElement('input');
                planNameResult.type = 'hidden';
                // planNameResult.id = 'planNameResult[]';
                planNameResult.name = 'planNameResult[]';
                planNameResult.value = planInfoName.value.toUpperCase();
                hiddenBox.appendChild(planNameResult); // 생성된 hiddenBox 자식으로 추가

                // 요약정보 value값 담을 input[hidden] 생성
                let planSummaryResult = document.createElement('input');
                planSummaryResult.type = 'hidden';
                // planSummaryResult.id = 'planSummaryResult[]';
                planSummaryResult.name = 'planSummaryResult[]';
                planSummaryResult.value = planInfoSummary.value;
                hiddenBox.appendChild(planSummaryResult); // 생성된 hiddenBox 자식으로 추가

                // 플랜명 출력할 p 생성
                let planNameText = document.createElement('p');
                planNameText.className = 'planNameText';
                planNameText.textContent = planInfoName.value.toUpperCase();
                resultBox.appendChild(planNameText); // 생성된 resultBox 자식으로 추가

                // span 생성
                let spanBetween = document.createElement('span');
                spanBetween.className = 'between';
                spanBetween.textContent = ':';
                resultBox.appendChild(spanBetween); // 생성된 resultBox 자식으로 추가

                // 요약설명 출력할 p 생성
                let planSummaryText = document.createElement('p');
                planSummaryText.className = 'planSummaryText';
                planSummaryText.textContent = planInfoSummary.value;
                resultBox.appendChild(planSummaryText); // 생성된 resultBox 자식으로 추가

                // .fileDelete button 태그 추가
                let fileDeleteButton = document.createElement('button');
                fileDeleteButton.type = 'button';
                fileDeleteButton.className = 'btn fileDelete';
                fileDeleteButton.setAttribute('title', '삭제');
                liElement.appendChild(fileDeleteButton);

                // ul 엘리먼트 추적 (li를 추가하기 위함)
                let ulElement = document.querySelector('.planResult ul');

                // li가 추가 될때 input[type="hidden"] value값이 같은 쌍이 있으면 추가 되지 않도록 그렇지 않으면 추가 되도록
                var lis = ulElement.querySelectorAll('li');
                var allSame = false;
                for (var j = 0; j < lis.length; j++) {
                    var currentHiddenInputs = lis[j].querySelectorAll('.hiddenBox input[type="hidden"]');
                    var newHiddenInputs = hiddenBox.querySelectorAll('input[type="hidden"]');
                    allSame = true;
                    for (var k = 0; k < currentHiddenInputs.length; k++) {
                        if (currentHiddenInputs[k].value !== newHiddenInputs[k].value) {
                            allSame = false;
                            break;
                        }
                    }
                    if (allSame) {
                        alert('이미 추가된 플랜정보입니다.');
                        return false; // 중복되었을 때 바로 종료
                    }
                }
                // allSame이 true면 li 엘리먼트 추가
                if (!allSame) {
                    ulElement.appendChild(liElement);
                    alert('플랜 추가 \n' + planInfoName.value.toUpperCase() + ' : ' + planInfoSummary.value)
                }
                
                // input 입력값 초기화
                planInfoName.value = '';
                planInfoSummary.value = '';

                // 플랜명에 포커스
                planInfoName.focus();
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    let planResult = document.querySelector('.planResult');

    if (planResult) {
        planResult.addEventListener('click', function(event) {
            // 가장 근접한 부모 li를 찾고
            let targetLi = event.target.closest('li');
            // 유효하면
            if (targetLi) {
                // 근접한 li를 삭제
                targetLi.remove();

            }
        });
    }
});




</script>