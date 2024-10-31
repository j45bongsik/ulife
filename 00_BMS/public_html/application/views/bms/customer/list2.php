<style>
                th {
                    vertical-align: middle;
                    }
                .list-cont-wrap {
                    display: block;
                    /* min-width: 1280px; */
                    overflow-x: scroll;
                    white-space: nowrap;
                    clear: both;
                }

                .datepicker .datepicker-days {}
                .datepicker .datepicker-days table {}
                .datepicker .datepicker-days table thead tr {}
                .datepicker .datepicker-days table thead tr:last-child {}
                .datepicker .datepicker-days table thead tr:last-child th {}
                .datepicker .datepicker-days table thead tr:last-child th:first-child {
                    color: red;
                }
                .datepicker .datepicker-days table thead tr:last-child th:last-child {
                    color: blue;
                }
                .datepicker .datepicker-days table tbody td:first-child:not(.old) {
                    color: red;
                }
                .datepicker .datepicker-days table tbody td:last-child:not(.new) {
                    color: blue;
                }
            </style>

            
            <div class="conts-box">
                <h1>거래처 리스트<보험사,보험상품,adsadadadadadadssa계약등록 관련 작업 후 작업 예정></h1> <a href="/customerlist" style="color:red">[  ☞ 등록 된 거래처만 입력값 확인을 위한 임시페이지로 이동 ] </a><br>

                <p>
                해당 페이지는 보험사와 호번상품이 함께 등록되어 있는 상태에서 보험에 가입을 해야 정확하게 나오는 페이지 입니다. <br> 고객사 등록된 내용만 보기위해서는 위 링크를 참고하세요.
                </p>

                

                <div class="details-table">                
                    <form name="searchform" method="post" action="" style="width:100%" >
                    <ul>
                        <li class="title">거래처명</li>
                        <li>
                            <input type="text" name="client_name" id="client_name" placeholder="거래처명 입력">
                        </li>
                        <li class="title">사업자번호</li>
                        <li>
                            <input type="text" name="business_number" id="business_number" placeholder="사업자번호 입력">
                        </li>
                        <li class="title">증권번호</li>
                        <li>
                            <input type="text" name="insurancePolicyNumber" id="insurancePolicyNumber" placeholder="증권번호 입력">
                        </li>
                        <li class="title">가입상품</li>
                        <li>
                            <div class="select-custom">
                                <select name="insuranceSubscriptionProduct" id="insuranceSubscriptionProduct">
                                    <optgroup label="재산종합">                         
                                        <option value="" >생산물배상책임보험</option>
                                        <option value="" >국내근로자재해보험</option>
                                    </optgroup>
                                    <optgroup label="재산종합">                         
                                        <option value="" >생산물배상책임보험</option>
                                        <option value="" >국내근로자재해보험</option>
                                    </optgroup>
                                    <optgroup label="재산종합">                         
                                        <option value="" >생산물배상책임보험</option>
                                        <option value="" >국내근로자재해보험</option>
                                    </optgroup>
                                    <optgroup label="재산종합">                         
                                        <option value="" >생산물배상책임보험</option>
                                        <option value="" >국내근로자재해보험</option>
                                    </optgroup>
                                </select>
                            </div>
                        </li>
                        <li class="title">거래처 담당자</li>
                        <li>
                            <input type="text" name="manager_name" id="manager_name" placeholder="거래처 담당자 입력">
                        </li>
                        <li class="title">계약 담당자</li>
                        <li>
                            <input type="text" name="customer_manager" id="customer_manager" placeholder="계약 담당자 입력">
                        </li>
                    </ul>
                    </form>
                </div>
                <div class="btn-box-conts">
                    <a href="" class="button search"><i class="icon-search"></i>검색</a>
                </div>


                <!-- realgrid
                http://service.realgrid.com/signin
                ID : bisdeveloper
                PW : Bis18009010!
                무료 라이선스 발급일 : 2024-02-07
                무료 라이선스 만료일 : 2024-05-07 -->

                <!-- realgrid lib -->
                <link href="/assets/realgrid.2.7.2/realgrid-style.css" rel="stylesheet" />
                <!-- <script src="/assets/realgrid.2.7.2/realgrid-lic.js"></script> -->
                <script src="/assets/realgrid.2.7.2/realgrid.2.7.2.min.js"></script>
                <script src="/assets/realgrid.2.7.2/libs/jszip.min.js"></script>
                
                <!-- bootstrap datepicker -->
                <script src="/assets/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
                <script src="/assets/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>
                <link rel="stylesheet" type="text/css" href="/assets/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

                <style>
                    

                    #realgrid {
                        height: 500px;
                        margin-top: 50px;
                    }
                    .realgrid-pre-wrap{
                        white-space: pre-wrap;
                    }
                    .rg-grid {
                        border: 1px solid var(--color-ligthGray);
                    }
                    .rg-root .rg-table, .rg-root .rg-table td {
                        vertical-align: middle;
                    }
                    .multi-line-css {
                        white-space: pre;
                    }
                    .rg-header {
                        text-align: center;
                        font-weight: bold;
                        /* 헤더의 색깔 변경 */
                        background: #e7e7e7;
                    }
                    .rg-header-group-cell {
                        background: #e7e7e7;
                    }
                    .rg-header-focus {
                        /* 포커스 헤더의 색깔 변경 */
                        background: #d2d2d2;
                        color: #1e1e1e;
                        box-shadow: inset 0px -2px 0px 0px #217346;
                        border: none;
                    }
                    .rg-header-select {
                        background: #d2d2d2;
                        color: #1e1e1e;
                        box-shadow: inset 0px -2px 0px 0px #217346;
                    }
                    .rg-header-sort-ascending {
                        background: url("../../../../assets/img/service/ico_sortUp.svg") no-repeat center 70%;
                    }
                    .rg-header-sort-descending {
                        background: url("../../../../assets/img/service/ico_sortDown.svg") no-repeat center 70%;
                    }
                    .rg-head {
                        background: #e7e7e7;
                    }
                    .rg-head .rg-table tr td {
                        border-right: 1px solid var(--color-ligthGray);
                        border-bottom: 1px solid var(--color-ligthGray);
                    }
                    .rg-header .rg-table tr td {
                        border-right: 1px solid var(--color-ligthGray);
                        border-bottom: 1px solid var(--color-ligthGray);
                    }
                    .rg-header .rg-table tr td.rg-header-focus {
                        border-right: 1px solid #e7e5e5;
                        border-bottom: 1px solid #e7e5e5;
                    }
                    .rg-header .rg-table tr td.rg-header-select:not(:last-child) {
                        border-right: 1px solid #e7e5e5;
                        border-bottom: 1px solid #e7e5e5;
                    }
                    .rg-header .rg-table tr td:hover {
                        background: #d2d2d2;
                    }

                    .rg-header-filtering.filter-activated {
                        background: url("../../../../assets/img/service/ico_filterActive.svg") no-repeat center;
                    }

                    .rg-rowbarcontainer .rg-table tr td {
                        /* background-color: #e7e7e7; */
                        border-right: 1px solid var(--color-ligthGray);
                        border-bottom: 1px solid var(--color-ligthGray);
                    }
                    .rg-rowbarcontainer .rg-table tr td:not(:last-child).rg-rowindicator-focus {
                        border-right: 1px solid #e7e5e5;
                        border-bottom: 1px solid #e7e5e5;
                    }
                    .rg-rowbarcontainer .rg-table tr:not(:last-child) td:not(:last-child).rg-rowindicator-select {
                        border-right: 1px solid #e7e5e5;
                        border-bottom: 1px solid #e7e5e5;
                    }
                    
                    .rg-rowbarcontainer .rg-table tr td.rg-statebar-updated {
                        /* background-color: #d2d2d2; */
                    }
                    
                    .rg-rowbarcontainer .rg-table tr td.rg-rowindicator-cell:hover {
                        background: #d2d2d2;
                    }
                    .rg-rowbarcontainer .rg-table tr td.rg-rowindicator-focus {
                        background: #D2D2D2;
                        box-shadow: inset -2px 0px 0px 0px #217346;
                    }
                    .rg-rowbarcontainer .rg-table tr td.rg-rowindicator-select {
                        background: #D2D2D2;
                        box-shadow: inset -2px 0px 0px 0px #217346;
                    }

                    .rg-focus {
                        /* 포커스 셀의 색깔 변경 */
                        border: 2px solid #217346;
                    }
                    .rg-selection-cell {
                        /* 선택 영역의 색깔 변경 */
                        /* background: blue !important; */
                        /* color: inherit; */
                    }
                    .rg-selection {
                        background: rgba(194, 194, 194, 0.3) !important;
                        border: 1px solid #217346;
                    }
                    .rg-editor-container {
                        border: 2px solid #217346;
                        background-color: inherit;
                        box-shadow: none;
                    }
                    .rg-editor-container > input, .rg-editor-container > textarea {
                        text-align: center;
                    }

                    .rg-body .rg-table tr td:hover, .rg-fixed-body .rg-table tr td:hover {
                        background: inherit;
                    }

                    .rg-focused-row{
                        background: #e0edf9;
                    }
                    
                    .rg-fixed-row {
                    /* 고정된 행, 열의 셀 색깔 변경 */
                        background: inherit;
                    }
                    .rg-fixed-body .rg-data-row {
                        background: inherit;
                    }

                    .rg-fixed-row td {
                        border-top: none;
                        border-right: 1px solid #9b9b9b;
                        border-bottom: 1px solid #9b9b9b;
                        border-left: none;
                        height: 0;
                    }

                    .rg-fixed-column-bar {
                        background: #9b9b9b;
                        border-right: 1px solid #9b9b9b;
                        width: 2px !important;
                    }

                    .rg-fixed-row-bar-cell {
                        background: #9b9b9b !important;
                        border-right: 1px solid #9b9b9b !important;
                        height: 2px !important;
                    }

                    .rg-renderer {
                        max-width: 100% !important;
                    }

                    .rg-cell-buttons {
                        right: 3px !important; 
                        cursor: pointer;
                    }

                    .rg-button-calendar:hover {
                        background: url("../../../../assets/img/service/ico_calenderHover.svg") no-repeat center left;
                    }

                    .multiline-editor{
                        white-space: pre;
                    }

                    .multiline-editor{
                        white-space: pre-line;
                    }

                    .disableColumn {
                        background: #f5f5f5;
                    }

                    .documentStyle {
                    text-align: center;
                    background: #BDD7EE;
                    color: #000;
                    font-size: 28px;
                    }
                    .documentSubtitleStyle {
                        text-align-last: left;
                        background: #D0CECE;
                        color: #000;
                        font-size: 16px;
                    }

                    .rg-filter-selector {
                        font-size: 14px;
                        color: #1e1e1e;
                        min-width: 250px;
                        /* min-height: 350px; */
                        padding: 10px;
                    }

                    .rg-filter-reset {
                        font-size: 16px;
                        font-weight: 600;
                        cursor: pointer;
                        padding-left: 0px;
                        padding-top: 0px;
                        padding-bottom: 0px;
                    }
                    .rg-filter-reset:hover {
                        color: #ab0505;
                    }

                    .rg-filter-searchbox {
                        margin-top: 10px;
                    }

                    .rg-filter-search-input {
                        padding: 0px 10px;
                        height: 30px;
                        line-height: 30px;
                        color: var(--color-point);
                    }

                    .rg-filter-select-all {
                        display: flex; justify-content: flex-start; align-items: center;
                        margin-top: 20px;
                        font-size: 13px;
                        font-weight: 500;
                        padding-left: 0;
                    }

                    .rg-filter-select-all .rg-filter-text {
                        position: static;
                        margin-left: 5px;
                        padding-top: 0;
                    }

                    .rg-filter-select-all .rg-filter-column-reset {
                        position: static;
                        margin-left: auto; margin-right: 0;
                    }

                    .rg-filter-select-all .rg-filter-column-reset:hover {
                        color: #ab0505;
                    }

                    .rg-filter-list-viewport {
                        margin-top: 5px;
                        padding: 5px 5px 5px 15px;
                    }

                    .rg-filter-list-viewport .rg-filter-item {
                        display: flex; justify-content: flex-start; align-items: center;
                    }

                    .rg-filter-list-viewport .rg-filter-item .rg-filter-text {
                        margin-left: 5px;
                    }

                    .rg-popup-menu {
                        padding: 5px 0px;
                    }

                    .rg-popup-menu .rg-popup-item:not(:first-child) {
                    }

                    .rg-popup-item:hover, .rg-popup-item-focused {
                        background: #c5c5c5;
                    }

                    .rg-scrolltrack {
                        background: #f1f1f1;
                        border: 1px solid #f1f1f1;
                    }

                    .rg-vscrollbar .rg-scrollthumb,
                    .rg-hscrollbar .rg-scrollthumb {
                        box-sizing: border-box;
                        border-radius: 0;
                        /* 스크롤바 버튼 색깔 변경 */
                        background: #C1C1C1;
                        border: 1px solid #C1C1C1;
                        width: 15px;
                        height: 15px;
                    }
                    
                    .rg-hscrollbar .rg-scrollthumb:hover {
                        background: #a8a8a8;
                        border: 1px solid #a8a8a8;
                    }

                    .right-column {
                        text-align: right;
                    }

                </style>

                <script>
                    const realGrid2Lic = 'upVcPE+wPOmtLjqyBIh9RkM/nBOseBrflwxYpzGZyYm9cY8amGDkiHqyYT2U1Yh3Dufv8SUhNy4d662cDE7cXw==';

                    document.addEventListener('DOMContentLoaded', function () {
                        const container = document.getElementById('realgrid');
                        const provider = new RealGrid.LocalDataProvider(true);
                        const gridView = new RealGrid.GridView(container);
                        gridView.setDataSource(provider);

                        gridView.onHideEditor = function (grid, index, dataRow) {

                            // var current = gridView.getCurrent();
                            // console.log("dataRow: " + current.dataRow + ", " + provider.getValues(current.dataRow));
                            
                            // var current = gridView.getCurrent();
                            // var jsonData = provider.getJsonRow(current.dataRow);
                            // console.log("dataRow: " + current.dataRow + ", " + JSON.stringify(JsonData));


                            var current = gridView.getCurrent();
                            var jsonData = gridView.getDisplayValues(current.itemIndex);
                            console.log("itemIndex: " + current.itemIndex + ", " + JSON.stringify(jsonData));

                        };

                        // onhideEditor 이벤트 핸들러
        
                        // 필드 생성
                        var fields01 = [
                            { fieldName: "source", dataType: "text" },
                            { fieldName: "number", dataType: "number" },
                            { fieldName: "year", dataType: "datetime" },
                            { fieldName: "division", dataType: "text" },
                            { fieldName: "type", dataType: "text" },
                            { fieldName: "insuGroup", dataType: "text" },
                            { fieldName: "insuType", dataType: "text" },
                            { fieldName: "insuName", dataType: "text" },
                            { fieldName: "contractType", dataType: "text" },
                            { fieldName: "handler", dataType: "text" },
                            { fieldName: "startDate", dataType: "datetime" },
                            { fieldName: "endDate", dataType: "datetime" },
                            { fieldName: "prevInsu", dataType: "text" },
                            { fieldName: "prevPrice", dataType: "number" },
                            { fieldName: "currentPrice", dataType: "number" },
                            { fieldName: "contractName", dataType: "text" },
                            { fieldName: "contactComplete", dataType: "text" },
                            { fieldName: "contactUnComplete", dataType: "text" },
                            { fieldName: "yesOrno", dataType: "text" },
                            { fieldName: "note", dataType: "text" },
                            { fieldName: "hompage", dataType: "text" },
                            { fieldName: "department", dataType: "text" },
                            { fieldName: "manager", dataType: "text" },
                            { fieldName: "mainNumber", dataType: "text" },
                            { fieldName: "managerNumber", dataType: "text" },
                            { fieldName: "email", dataType: "text" },
                            { fieldName: "internalManager", dataType: "text" },
                            { fieldName: "apMonth", dataType: "text" },
                            { fieldName: "reContactDate", dataType: "datetime" },
                            { fieldName: "visitFirst", dataType: "text" },
                            { fieldName: "visitSecond", dataType: "text" },
                            { fieldName: "rivalCompany", dataType: "text" },
                            { fieldName: "rivalPrice", dataType: "number" },
                            { fieldName: "result", dataType: "text" },
                            { fieldName: "addressFirst", dataType: "text" },
                            { fieldName: "addressSecond", dataType: "text" },
                            { fieldName: "addressDetails", dataType: "text" },
                        ]

                        // 컬럼 생성
                        var columns01 = [
                            { name: "source", fieldName: "source", width: "100",
                                header: { text: "출처" },
                            },
                            { name: "number",fieldName: "number", width: "70",
                                header: { text: "순번" },
                                editor: {
                                    type: "number",
                                    textAlignment: "far",
                                    editFormat: "#,##0",
                                    multipleChar: "+",
                                    
                                },
                                numberFormat: "#,##0",
                            },
                            { name: "year", fieldName: "year", width: "70",
                                header: { text: "년도" },
                                editButtonVisibility: "default",
                                editor: {
                                    type: "btdate",
                                    btOptions: {
                                        startView: 2,
                                        minViewMode: 2,
                                        todayBtn: "linked",
                                        language: "kr",
                                        todayHighlight: true,
                                        language:"ko"
                                    },
                                    textReadOnly:false,
                                    commitOnSelect: true,
                                    datetimeFormat: "yyyy",
                                    mask: {
                                        editMask: "9999",
                                        includedFormat: true
                                    },
                                },
                                datetimeFormat: "yyyy"
                            },
                            { name: "division", fieldName: "division", width: "80",
                                header: { text: "구분" },
                            },
                            { name: "type", fieldName: "type", width: "80",
                                header: { text: "인격" },
                            },
                            { name: "insuGroup", fieldName: "insuGroup", width: "70",
                                header: { text: "보험분류" },
                            },
                            { name: "insuType", fieldName: "insuType", width: "100",
                                header: { text: "보험종목" },
                            },
                            { name: "insuName", fieldName: "insuName", width: "150",
                                header: { text: "상품명" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "contractType", fieldName: "contractType", width: "80",
                                header: { text: "인수형태" },
                            },
                            { name: "handler", fieldName: "handler", width: "80",
                                header: { text: "취급자" },
                            },
                            { name: "startDate", fieldName: "startDate", width: "100",
                                header: { text: "시작일" },
                                editButtonVisibility: "default",
                                editor: {
                                    type: "btdate",
                                    btOptions: {
                                        startView: 1,
                                        minViewMode: 0,
                                        todayBtn: "linked",
                                        language: "kr",
                                        todayHighlight: true,
                                        language:"ko"
                                    },
                                    textReadOnly:false,
                                    commitOnSelect: true,
                                    datetimeFormat: "yyyy-MM-dd",
                                    mask: {
                                        editMask: "9999-99-99",
                                        includedFormat: true
                                    },
                                },
                                datetimeFormat: "yyyy-MM-dd",
                            },
                            { name: "endDate", fieldName: "endDate", width: "100",
                                header: { text: "종료일" },
                                editButtonVisibility: "default",
                                editor: {
                                    type: "btdate",
                                    btOptions: {
                                        startView: 1,
                                        minViewMode: 0,
                                        todayBtn: "linked",
                                        language: "kr",
                                        todayHighlight: true,
                                        language:"ko"
                                    },
                                    textReadOnly:false,
                                    commitOnSelect: true,
                                    datetimeFormat: "yyyy-MM-dd",
                                    mask: {
                                        editMask: "9999-99-99",
                                        includedFormat: true
                                    },
                                },
                                datetimeFormat: "yyyy-MM-dd",
                            },

                            { name: "prevInsu", fieldName: "prevInsu", width: "100",
                                header: { text: "기존 보험사" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "prevPrice", fieldName: "prevPrice", width: "150",
                                header: { text: "기존 보험료" },
                                editor: {
                                    type: "number",
                                    textAlignment: "far",
                                    editFormat: "#,##0",
                                    multipleChar: "+",
                                },
                                numberFormat: "#,##0",
                                // suffix: " 백만",
                                styleName: "right-column"
                            },
                            { name: "currentPrice", fieldName: "currentPrice", width: "150",
                                header: { text: "현재 보험료" },
                                editor: {
                                    type: "number",
                                    textAlignment: "far",
                                    editFormat: "#,##0",
                                    multipleChar: "+",
                                },
                                numberFormat: "#,##0",
                                // prefix: " 백만",
                                styleName: "right-column"
                            },
                            { name: "contractName", fieldName: "contractName", width: "100",
                                header: { text: "계약자명" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "contactComplete", fieldName: "contactComplete", width: "50",
                                header: { text: "O" },
                            },
                            { name: "contactUnComplete", fieldName: "contactUnComplete", width: "50",
                                header: { text: "X" },
                            },
                            { name: "yesOrno", fieldName: "yesOrno", width: "70",
                                header: { text: "Y/N" },
                            },
                            { name: "note", fieldName: "note", width: "300",
                                header: { text: "비고" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "hompage", fieldName: "hompage", width: "200",
                                header: { text: "홈페이지" },
                                renderer: {
                                    type: "link",
                                    urlCallback: function(grid, cell){
                                        // return "https://www.bis.co.kr"+cell.value
                                    },
                                    titleField: "homepage",
                                },
                                styleName: "left-column",
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "department", fieldName: "department", width: "150",
                                header: { text: "담당부서" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "manager", fieldName: "manager", width: "100",
                                header: { text: "담당자명" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "mainNumber", fieldName: "mainNumber", width: "200",
                                header: { text: "대표번호" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "managerNumber", fieldName: "managerNumber", width: "200",
                                header: { text: "담당자 연락처" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "email", fieldName: "email", width: "200",
                                header: { text: "이메일" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true,
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "internalManager", fieldName: "internalManager", width: "100",
                                header: { 
                                    text: "내부\n컨택\n담당자",
                                    styleName: "multi-line-css",
                                },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "apMonth", fieldName: "apMonth", width: "70",
                                header: { 
                                    text: "AP\n월별",
                                    styleName: "multi-line-css",
                                },
                            },
                            { name: "reContactDate", fieldName: "reContactDate", width: "100",
                                header: { 
                                    text: "재연락\n희망일",
                                    styleName: "multi-line-css",
                                },
                                editButtonVisibility: "default",
                                editor: {
                                    type: "btdate",
                                    btOptions: {
                                        startView: 1,
                                        minViewMode: 0,
                                        todayBtn: "linked",
                                        language: "kr",
                                        todayHighlight: true,
                                        language:"ko"
                                    },
                                    textReadOnly:false,
                                    commitOnSelect: true,
                                    datetimeFormat: "yyyy-MM-dd",
                                    mask: {
                                        editMask: "9999-99-99",
                                        includedFormat: true
                                    },
                                },
                                datetimeFormat: "yyyy-MM-dd"
                            },
                            { name: "visitFirst", fieldName: "visitFirst", width: "80",
                                header: { text: "1차" },
                            },
                            { name: "visitSecond", fieldName: "visitSecond", width: "80",
                                header: { text: "2차" },
                            },
                            { name: "rivalCompany", fieldName: "rivalCompany", width: "150",
                                header: { text: "참여 보험사" },
                                editor: {
                                    type: "multiline",
                                    altEnterNewLine:true
                                },
                                styleName: "realgrid-pre-wrap",
                            },
                            { name: "rivalPrice", fieldName: "rivalPrice", width: "150",
                                header: { text: "참여 보험료" },
                                editor: {
                                    type: "number",
                                    textAlignment: "far",
                                    editFormat: "#,##0",
                                    multipleChar: "+",
                                },
                                numberFormat: "#,##0",
                                styleName: "right-column"
                            },
                            { name: "result", fieldName: "result", width: "100",
                                header: { text: "결과" },
                            },
                            { name: "addressFirst", fieldName: "addressFirst", width: "120",
                                header: { text: "도시" },
                            },
                            { name: "addressSecond", fieldName: "addressSecond", width: "120",
                                header: { text: "시/군/구" },
                            },
                            { name: "addressDetails", fieldName: "addressDetails", width: "250",
                                header: { text: "상세주소" },
                                styleName: "realgrid-pre-wrap",
                            },
                        ]



                        // 로우 생성
                        var rows01 = [

                            {
                                source: 'DB 손해보험', number: '21', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '33', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '44', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '55', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '66', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '77', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '1', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '543', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '1', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                            {
                                source: 'DB 손해보험', number: '21', year: '2024', division: '사업자', type: '법인사업자', 
                                insuGroup: '종합', insuType: '재산종합', insuName: 'DB 재산종합보험2', contractType: '단독', 
                                handler: 'BIS', startDate: '1999-12-31', endDate: '2000-07-01', prevInsu: '삼성화재', 
                                prevPrice: '900000000', currentPrice: '1000000000', contractName: '알톤스포츠', 
                                contactComplete: '', contactUnComplete: '', note: '전화를 받지 않음', hompage: 'https://www.bis.co.kr', 
                                department: '경영지원부', manager: '홍길동', mainNumber: '1800-9010', managerNumber: '02-1234-1234', 
                                email: 'bis@bis.co.kr', internalManager: '김성일', apMonth: '매월 15일', reContactDate: '2023-12-31', 
                                visitFirst: '회사', visitSecond: '회사2', rivalCompany: '삼성화재', rivalPrice: '900000000', result: '상담종료',
                                addressFirst: '서울턱별시', addressSecond: '중구', addressDetails: '성우빌딩 10F' 
                            },
                        ]


                        // var layout01 header 병합을 위한 layout 구성
                        layout01 = [
                            "source", "number", "year", "division", "type", "insuGroup", "insuType", "insuName", "contractType", 
                            "handler", 
                            // header 병합
                            {
                                name: "dateGroup", 
                                direction: "horizontal",
                                items: [
                                    "startDate",
                                    "endDate"
                                ],
                                header: {
                                    text: "보험기간"
                                }
                            }, 

                            "prevInsu", "prevPrice", "currentPrice", 
                            
                            // header 병합
                            {
                                name: "contractGroup",
                                direction: "horizontal",
                                items: [
                                    "contractName",
                                    // header 병합 2depth
                                    {
                                        name: "contractGroup2depth",
                                        direction: "horizontal",
                                        items: [
                                            "contactComplete",
                                            "contactUnComplete",
                                            "yesOrno",
                                            "note",
                                        ],
                                        header: {
                                            text: "컨택사항"
                                        }
                                    },
                                    "hompage",
                                    "department",
                                    "manager",
                                    "mainNumber",
                                    "managerNumber", 
                                    "email", 
                                ],
                                header: {
                                    text: "계약자"
                                }
                            },

                            "internalManager", 
                            "apMonth",
                            // header 병합
                            {
                                name: "reContactGroup",
                                direction: "horizontal",
                                items: [
                                    "reContactDate",
                                    // header 병합 2depth
                                    {
                                        name: "reContactGroup2depth",
                                        direction: "horizontal",
                                        items: [
                                            "visitFirst", 
                                            "visitSecond", 
                                        ],
                                        header: {
                                            text: "방문",
                                        }
                                    },
                                    
                                ],
                                header: {
                                    text: "날짜",
                                }
                            },
                            
                            "rivalCompany", "rivalPrice", "result",

                            // header 병합
                            {
                                name: "addressGroup",
                                direction: "horizontal",
                                items: [
                                    "addressFirst", 
                                    "addressSecond", 
                                    "addressDetails", 
                                ],
                                header: {
                                    text: "주소"
                                }
                            },
                            
                        ]

                        provider.setFields(fields01); //필드설정
                        gridView.setColumns(columns01); //컬럼설정
                        provider.setRows(rows01); //데이터 채우기

                        gridView.setColumnLayout(layout01); //header 병합


                        // undo / redo
                        gridView.undoable = true;

                        // edit / update 표시
                        gridView.editOptions.editable = true;
                        gridView.editOptions.updatable = true;

                        // header의 높이
                        gridView.header.heights = [30, 30, 30]

                        // footer visible
                        gridView.setFooters({
                            visible:false,
                        });

                        // 컬럼 이동 여부
                        gridView.displayOptions.columnMovable = false;

                        // focus가 있는 행의 배경색과 포커스 셀 내부의 배경색
                        gridView.displayOptions.useFocusClass = true;

                        gridView.displayOptions.fitStyle = "even";
                        gridView.header.heights = [30,30,30]
                        gridView.displayOptions.minRowHeight = 30;
                        gridView.displayOptions.rowHeight = -1;

                        gridView.displayOptions.useFocusClass = true;
                        
                        //realGrid scrollbar style
                        gridView.scrollBarWidth = 15;
                        gridView.scrollBarHeight = 15;
                        gridView.scrollBarRadius = 0;

                        // 다중선택 블록
                        gridView.displayOptions.selectionMode = "extended";
                        gridView.displayOptions.selectionStyle = "block";

                        // Number true/false
                        gridView.setRowIndicator({
                            visible: true
                        });
                        //checkbox true/false
                        gridView.setCheckBar({
                            visible: false
                        });
                        // 편집불가 컬럽
                        // var sourceColumn = gridView.columnByName("source").editable;
                        // gridView.columnByName("source").editable = false;

                        // var numberColumn = gridView.columnByName("number").editable;
                        // gridView.columnByName("number").editable = false;

                        // 복사/ 붙혀넣기
                        // gridView.setCopyOptions({
                        //     // singleMode: document.getElementById("chkSingleMode").checked,
                        //     enabled: document.getElementById("chkEnabled").checked
                        // });

                        /* ========== 우클릭 메뉴를 설정 ========== */
                        setContextMenu(gridView);
                        
                        //행 추가 삭제 설정
                        gridView.setEditOptions({
                            insertable: false,
                            appendable: true,
                            deletable: true,
                        });
                        //필터 생성 설정
                        function createColumnFilter(grid, colName) {
                            grid.columnByName(colName).autoFilter = true
                        }

                        // 행 삭제 ctrl+delete 
                        function btnDeleteSelection() {
                            gridView.deleteSelection(true);
                        }

                        // function btnRemoveRow() {
                        //     var curr = gridView.getCurrent();
                        //     dataProvider.removeRow(curr.dataRow);
                        // }

                        // 우클릭 설정 값
                        var toggle = false;
                        function setContextMenu(grid) {
                            grid.onContextMenuItemClicked = function (grid, item, clickData) { 
                                if (item.tag == "excel") {
                                    grid.exportGrid({
                                        type: "excel",
                                        target: "local",
                                        documentTitle: {
                                            message: "거래처 리스트",
                                            visible: true,
                                            spaceTop: 1,
                                            spaceBottom: 0,
                                            height: 60,
                                            styleName: "documentStyle"
                                        },
                                        documentTail: { //부제
                                            message: "Excel 데이터 기준일 : " + new Date().toLocaleString().replace(/\./g, '').replace(/\s/g, '-'),
                                            visible: true,
                                            spaceTop: 1,
                                            height: 20,
                                            styleName: "documentSubtitleStyle"
                                        },
                                        // fileName: "gridExportSample.xlsx"
                                    });
                                } else if (item.tag == 'filter' && clickData.column) {
                                    createColumnFilter(grid, clickData.column);
                                } 
                                // else if (item.tag == 'visibleTrue') {
                                //     var columns = grid.getColumns();1

                                //     for (var i in columns) {
                                //         grid.setColumnProperty(columns[i].name, "visible", true);
                                //     }
                                //     toggle = false;
                                //     setHeaderCellContextMenu(grid, toggle);
                                // } 
                                // else if (item.tag == 'visibleFalse') {
                                //     grid.setColumnProperty(clickData.column, "visible", false);

                                //     toggle = true;
                                //     setHeaderCellContextMenu(grid, toggle);
                                // } 
                                else if (item.tag == 'fixedCol') {
                                    var count = grid.layoutByColumn(clickData.column).root.vindex + 1;
                                    grid.setFixedOptions({ colCount: count });
                                } else if (item.tag == 'fixedRow') {
                                    var count = clickData.itemIndex + 1;
                                    grid.setFixedOptions({ rowCount: count });
                                } else if (item.tag == 'fixedCancel') {
                                    grid.setFixedOptions({ colCount: 0, rowCount: 0 });
                                } else if (item.tag == 'addEmptyRow') {
                                    gridView.beginAppendRow();
                                } else if (item.tag == 'romoveRow') {
                                    if (confirm("선택된 행(들)을 삭제하시겠습니까??")) {
                                        gridView.deleteSelection(true);
                                    } else {}

                                };
                            }

                            grid.onContextMenuPopup = function (grid, x, y, elementName) {
                                if (elementName.cellType == 'header') {
                                    setHeaderCellContextMenu(grid, toggle);
                                } else if (elementName.cellType == 'data') {
                                    setDataCellContextMenu(grid);
                                } else {
                                    return false;
                                }
                            };

                            setDataCellContextMenu(grid);
                        }

                        function setHeaderCellContextMenu(grid, val) {
                            var contextMenu = [{
                                label: '엑셀 내보내기',
                                tag: 'excel'
                            }, {
                                label: '필터 만들기',
                                tag: 'filter'
                            },
                            // {
                            //     label: '빈행 추가',
                            //     tag: 'addEmptyRow',
                            // },
                            //    {
                            //        label: "-"
                            //    },
                            //    {
                            //        label: '컬럼 숨기기',
                            //        tag: 'visibleFalse'
                            //    }, {
                            //        label: '컬럼 모두 보이기',
                            //        tag: 'visibleTrue',
                            //        enabled: val
                            //    }
                            ];

                            grid.setContextMenu(contextMenu);
                        }

                        function setDataCellContextMenu(grid) {
                            var contextMenu = [{
                                label: '엑셀 내보내기',
                                tag: 'excel'
                            }, {
                                label: "-"
                            }, {
                                label: '빈행 추가',
                                tag: 'addEmptyRow',
                            }, {
                                label: '선택 행 전체삭제',
                                tag: 'romoveRow',
                            }, {
                                label: "-"
                            }, {
                                label: '열 고정',
                                tag: 'fixedCol'
                            }, {
                                label: '행 고정',
                                tag: 'fixedRow'
                            }, {
                                label: '고정 취소',
                                tag: 'fixedCancel'
                            }];

                            grid.setContextMenu(contextMenu);
                        }

                        function setHeaderCellContextMenu(grid, val) {
                            var contextMenu = [{
                                label: '엑셀 내보내기',
                                tag: 'excel'
                            }, {
                                label: '필터 만들기',
                                tag: 'filter'
                            }, 
                            // {
                            //     label: '빈행 추가',
                            //     tag: 'addEmptyRow',
                            // },
                            //    {
                            //        label: "-"
                            //    }, 
                            //    {
                            //        label: '컬럼 숨기기',
                            //        tag: 'visibleFalse'
                            //    }, {
                            //        label: '컬럼 모두 보이기',
                            //        tag: 'visibleTrue',
                            //        enabled: val
                            //    }
                            ];

                            grid.setContextMenu(contextMenu);
                        }

                        function setDataCellContextMenu(grid) {
                            var contextMenu = [{
                                label: '엑셀 내보내기',
                                tag: 'excel'
                            }, {
                                label: "-"
                            }, {
                                label: '빈행 추가',
                                tag: 'addEmptyRow',
                            }, {
                                label: '선택 행 전체삭제',
                                tag: 'romoveRow',
                            }, {
                                label: "-"
                            }, {
                                label: '열 고정',
                                tag: 'fixedCol'
                            }, {
                                label: '행 고정',
                                tag: 'fixedRow'
                            }, {
                                label: '고정 취소',
                                tag: 'fixedCancel'
                            }];

                            grid.setContextMenu(contextMenu);
                        }


                        /* ===== API 추천설정 ===== */
                        // 소트나 필터링시 새로 추가되거나 편집된 데이터는 그 기준(소트, 필터)에 맞게 재정렬되는데
                        // 그것을 방지하고 사용자가 재정렬이나 필터링 하기전까지는 그 위치를 유지하게하고자 할때
                        gridView.sortMode = 'explicit';
                        gridView.filterMode = 'explicit';

                        // 셀 편집이 완료되면 바로 commit
                        gridView.editOptions.commitByCell = true; 

                        // 편집중에 그리드 외부 영역을 클릭하였을때 commit
                        gridView.editOptions.commitWhenLeave = true;

                        //탭 키로 컬럼 이동시 마지막 컬럼에 도착하면 다음행의 첫 컬럼으로 포커스 이동
                        gridView.editOptions.crossWhenExitLast = true;

                        // 첫행의 맨 앞에서 조절 가능, 모든 행의 높이가 동일하게 변경
                        // gridView.displayOptions.rowResizable = true;
                        // 개별 높이변경
                        // gridView.displayOptions.eachRowResizable = true;


                        // readOnly이거나 editable이 false인 Column은 paste대상에서 제외
                        gridView.pasteOptions.checkReadOnly = true;

                        // 숫자 필드에 '1,000'을 붙여넣기 할때 ','문자로 인해 1 만 붙여넣기 될때 
                        gridView.pasteOptions.numberChars = [',']


                    

                    });//

                    




                </script>

                <div id="realgrid"></div>
            </div>

        <script>
            // 검색버튼 클릭시 검색하기
            $(".search").click(function(){
                $("form[name=searchform]").submit();
            });


        </script>