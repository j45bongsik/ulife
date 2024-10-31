<?php
// 해당 파일은 github webhook 을 통해 서버에 push 가 되면 자동으로 실행되는 파일입니다.

$system_path = "";
define('BASEPATH', $system_path);
// DB 연결
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/config/database.php";

// DB 연결
$conn = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

print_r($conn);

// DB 연결 확인
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// 디버깅 함수
function debug($data){
    echo "<pre><div style='width:1024px; background:#000000; margin-top:100px; color:#1ee209;'>"; //  #0f6244;
    print_r($data);
    echo "</div></pre>";
}

echo "github webhook test";

// 오늘 날짜    
$today = date("Y-m-d");
// github 에서 post로 넘어온 데이터를 받는다
$postdata = "";
$postdata = $_POST;


/*
테이블 구조 
CREATE TABLE `github_webhook_test` (
    `no` int(11) NOT NULL,
    `cont` text NOT NULL COMMENT '내용',
    `ip` varchar(50) NOT NULL COMMENT '아이피
    `regdate` datetime NOT NULL,
    PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci

해당 테이블에 넘어오는 데이터를 저장 한다 .


*/


$ip = $_SERVER['REMOTE_ADDR'];

if(!empty($postdata)){
    $sql = "insert into github_webhook_test (cont, ip, regdate) values ('".$today." --- ".json_encode($postdata)."', '".$ip."',   now());";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "insert into github_webhook_test (cont, ip, regdate) values ('".$today." --- no data', '".$ip."',   now());";
    $result = mysqli_query($conn, $sql);
}

