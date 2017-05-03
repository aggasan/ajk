<?php
    class Rate_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('rate')->result();
        }

        function delete($id){
            $this->db->delete('rate', array('rate_id'=>$id));
    	}

    	function getBatchById($id){
        	$query = "SELECT
				* from rate where
			rate_batch_id = '$id'";
            return $this->db->query($query)->result();
        }

        function get($period = '', $age = '', $product_id = '', $benefit_id = ''){
            $query = "SELECT
                    a.*
                FROM
                    rate as a,
                    rate_batch as b
                WHERE
                    a.rate_batch_id = b.rate_batch_id
                AND a.period = '$period'
                AND a.min_age <= '$age'
                AND a.max_age >= '$age'
                AND b.product_id = '$product_id'
                AND b.benefit_id = '$benefit_id'";
            return $this->db->query($query)->row();
        }

        function get_total($debitur_id){
            $query = "SELECT
                SUM(rate) AS rate_total,
                SUM(premi) AS premi_total
            FROM
                debitur_premi
            WHERE
                debitur_id = '$debitur_id'";
            return $this->db->query($query)->row();
        }
    }
?>
