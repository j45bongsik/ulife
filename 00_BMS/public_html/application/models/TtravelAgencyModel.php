<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TtravelAgencyModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }


    // 데이터 베이스 생성중 2024-07-02
    /*
        - 거래처 정보 테이블
        - 거래처 담당자 정보 테이블
        - 정산 정보 테이블
        - 보험사/상품(수수료)관리 테이블
        - 포괄계약 정보 테이블 --> 증권 번호 관련 확인 중
    */


    // 금융기관 정보 테이블 
    /*
        CREATE TABLE `bank_info` (
            `code` char(3) NOT NULL COMMENT '실제금융결제원 고유코드값',
            `bank_name` varchar(20) DEFAULT NULL COMMENT '금융기관 명',
            `view_yn` varchar(20) DEFAULT NULL COMMENT '노출여부',
            `cate` enum('B','C','I','F','E','S') DEFAULT NULL COMMENT '''B''=은행, ''C''=카드사, ''I''=보험사, ''F''=캐피탈, ''E''=기타, ''S''=증권사  (모두 대문자)',
            `sort` tinyint(3) unsigned zerofill DEFAULT 000 COMMENT '정렬순서 ( 추후 자주 사용하는 은행을 위로 올려달라고 할까봐 ) ',
            PRIMARY KEY (`code`),
            KEY `bank_name` (`bank_name`),
            KEY `view_yn` (`view_yn`),
            KEY `cate` (`cate`),
            KEY `sort` (`sort`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='금융사 정보(고유코드 + 이름) 테이블'
    */

    // 여행사 아이디 중복 체크 IdCheck

    

}