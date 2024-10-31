<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width">
	<title>BIS BMS</title>

	<meta name="format-detection" content="telephone=no"><!-- iOS에서 숫자가 전화번호로 인식되는 문제 막기 -->
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/common/favicon.ico">
	<link rel="shortcut icon" href="/assets/img/common/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="/assets/img/common/favicon.png"/>

	<!-- design style css -->
	<!--link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet"-->

	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.css?v=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css?v=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="/assets/css/basic.css?v=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="/assets/css/button.css?v=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="/assets/css/member.css?v=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="/assets/css/service.css?v=<?=time()?>">

	<script type="text/javascript" src="/assets/js/jquery-3.6.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/assets/js/common.js"></script>

	<?php
	// 주소 검색 $SearchAddress 라는 변수가 있는 경우에만 실행 한다.
	// 주소 검색은 필요한 경우 해당 페이지 컨트롤에서 $SearchAddress 변수에 값을 넣어서 사용한다.
	// ex) $SearchAddress = $this->customclass->SearchAddress();
	//     $this->load->view($this->serviceTab . '/inc/common', array('SearchAddress'=>$SearchAddress));
	// input 태그에 아래와 같이 넣어서 사용한다.	
	// <input type="text" name="postcode" id="postcode" value="" placeholder="우편번호">
	// <input type="text" name="road_address" id="road_address" value="" placeholder="도로명 주소">
	// <input type="text" name="jibun_address" id="jibun_address" value="" placeholder="지번 주소">
	// <input type="text" name="extra_address" id="extra_address" value="" placeholder="주소 참고사항 예:(논현동)">
	// <input type="text" name="detail_address" id="address" value="" placeholder="상세 주소">
	// <input type="button" onclick="SearchAddress();" value="주소검색" class="btn btn-sm btn-gray">
	if(isset($SearchAddress)){
		echo $SearchAddress;
	}
	?>
</head>

<body>