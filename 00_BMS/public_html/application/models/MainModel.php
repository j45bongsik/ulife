<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model{
    function __construct(){
        parent::__construct(); 
        $this->load->database();
    }

    // drawTable 을 그리기 위해 쿼리를 하나 받아서 그대로 실행 시키는 함수
    public function DrawTable($sql){
        return $this->db->query($sql)->result();
    }

    // 금년, 작년 매출, 매입 총액을 가져오는 함수 getSalesBuyTotal($start, $end, $type) 데이터는 erp_sales_buy_invoice 테이블에서 가져옴 issue_year_month 를 기준으로 가져옴 금액은 total_amount 를 가져옴
    public function getSalesBuyTotal($start, $end, $type){
        $this->db->select('SUM(total_amount) as total');
        $this->db->where('issue_year_month >=', $start);
        $this->db->where('issue_year_month <=', $end);
        $this->db->where('type', $type);
        $this->db->where('del_yn', 'N');
        $this->db->from('erp_sales_buy_invoice');

        return $this->db->get()->row()->total;
    }

    // 년도를 받아서 해당 연도의 매출 순위 TOP10 가져오기 getSalesRanking($year)
    // SELECT rec_sup_mutual, SUM(total_amount) as total, rec_sup_business_number FROM `erp_sales_buy_invoice` WHERE `issue_year_month` like '2024%' AND `type` = 'S' AND `del_yn` = 'N' GROUP BY rec_sup_business_number ORDER  BY SUM(total_amount) desc LIMIT 10
    public function getSalesRanking($Year){
        $this->db->select('rec_sup_mutual, SUM(total_amount) as total, rec_sup_business_number');
        $this->db->like('issue_year_month', $Year);
        $this->db->where('type', 'S');
        $this->db->where('del_yn', 'N');
        $this->db->from('erp_sales_buy_invoice');
        $this->db->group_by('rec_sup_business_number');
        $this->db->order_by('SUM(total_amount)', 'desc');
        $this->db->limit(10);

        return $this->db->get()->result();
    }

    // 년도를 받아서 해당 연도의 매입 순위 TOP10 가져오기 getBuyRanking($Year)
    // SELECT sup_mutual, SUM(total_amount) as total, sup_business_number FROM `erp_sales_buy_invoice` WHERE `issue_year_month` like '2024%' AND `type` = 'B' AND `del_yn` = 'N' GROUP BY sup_business_number ORDER  BY SUM(total_amount) desc LIMIT 10;
    public function getBuyRanking($Year){
        $this->db->select('sup_mutual, SUM(total_amount) as total, sup_business_number');
        $this->db->like('issue_year_month', $Year);
        $this->db->where('type', 'B');
        $this->db->where('del_yn', 'N');
        $this->db->from('erp_sales_buy_invoice');
        $this->db->group_by('sup_business_number');
        $this->db->order_by('SUM(total_amount)', 'desc');
        $this->db->limit(10);

        return $this->db->get()->result();
    }

    // 년도를 받아서 해당 연도의 월별 매출, 매입 총액을 가져오는 함수 getSalesBuyMonthTotal($Year)
    /*
    SELECT
        `Y`,
        `type`,
        IFNULL(SUM(CASE WHEN M = '01' THEN total  ELSE NULL END), 0) AS 'M01',
        IFNULL(SUM(CASE WHEN M = '02' THEN total  ELSE NULL END), 0) AS 'M02',
        IFNULL(SUM(CASE WHEN M = '03' THEN total  ELSE NULL END), 0) AS 'M03',
        IFNULL(SUM(CASE WHEN M = '04' THEN total  ELSE NULL END), 0) AS 'M04',	
        IFNULL(SUM(CASE WHEN M = '05' THEN total  ELSE NULL END), 0) AS 'M05',
        IFNULL(SUM(CASE WHEN M = '06' THEN total  ELSE NULL END), 0) AS 'M06',
        IFNULL(SUM(CASE WHEN M = '07' THEN total  ELSE NULL END), 0) AS 'M07',
        IFNULL(SUM(CASE WHEN M = '08' THEN total  ELSE NULL END), 0) AS 'M08',
        IFNULL(SUM(CASE WHEN M = '09' THEN total  ELSE NULL END), 0) AS 'M09',
        IFNULL(SUM(CASE WHEN M = '10' THEN total  ELSE NULL END), 0) AS 'M10',
        IFNULL(SUM(CASE WHEN M = '11' THEN total  ELSE NULL END), 0) AS 'M11',
        IFNULL(SUM(CASE WHEN M = '12' THEN total  ELSE NULL END), 0) AS 'M12'
    FROM 
        (
        SELECT 
            use_year_month, SUBSTR(use_year_month,1, 4) AS `Y`, SUBSTR(use_year_month,6, 2) AS `M`, `type`, sum(total_amount) as total
        FROM 
            erp_sales_buy_invoice
        WHERE 
            -- SUBSTR(use_year_month,1, 4) IN ('2023', '2024')
            SUBSTR(use_year_month,1, 4) = '2024'
        group BY `type`, SUBSTR(use_year_month,1, 4), SUBSTR(use_year_month,6, 2)
        ) AS T

    GROUP BY `Y`,`type`	
    */
    public function getSalesBuyMonthTotal($Year){
        //$this->db->select('Y, type, IFNULL(SUM(CASE WHEN M = "01" THEN total  ELSE NULL END), 0) AS "M01",.... 
        $this->db->select('Y, type, IFNULL(SUM(CASE WHEN M = "01" THEN total  ELSE NULL END), 0) AS "M01", 
        IFNULL(SUM(CASE WHEN M = "02" THEN total  ELSE NULL END), 0) AS "M02", 
        IFNULL(SUM(CASE WHEN M = "03" THEN total  ELSE NULL END), 0) AS "M03", 
        IFNULL(SUM(CASE WHEN M = "04" THEN total  ELSE NULL END), 0) AS "M04", 
        IFNULL(SUM(CASE WHEN M = "05" THEN total  ELSE NULL END), 0) AS "M05",
        IFNULL(SUM(CASE WHEN M = "06" THEN total  ELSE NULL END), 0) AS "M06",
        IFNULL(SUM(CASE WHEN M = "07" THEN total  ELSE NULL END), 0) AS "M07",
        IFNULL(SUM(CASE WHEN M = "08" THEN total  ELSE NULL END), 0) AS "M08",
        IFNULL(SUM(CASE WHEN M = "09" THEN total  ELSE NULL END), 0) AS "M09",
        IFNULL(SUM(CASE WHEN M = "10" THEN total  ELSE NULL END), 0) AS "M10",
        IFNULL(SUM(CASE WHEN M = "11" THEN total  ELSE NULL END), 0) AS "M11",
        IFNULL(SUM(CASE WHEN M = "12" THEN total  ELSE NULL END), 0) AS "M12"');
        $this->db->from('
        (
        SELECT 
            issue_year_month, SUBSTR(issue_year_month,1, 4) AS `Y`, SUBSTR(issue_year_month,6, 2) AS `M`, `type`, sum(total_amount) as total
        FROM
            erp_sales_buy_invoice
        WHERE
            del_yn = "N" AND
            SUBSTR(issue_year_month,1, 4) = "'.$Year.'"
        group BY `type`, SUBSTR(issue_year_month,1, 4), SUBSTR(issue_year_month,6, 2)
        ) AS T');
        $this->db->group_by('Y, type');

        return $this->db->get()->result();
    }



}