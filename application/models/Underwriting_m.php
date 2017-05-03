<?php
    class Underwriting_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('underwriting')->result();
        }

        function delete($id){
            $this->db->delete('underwriting', array('underwriting_id'=>$id));
    	}

    	function getBatchById($id){
        	$query = "SELECT
				* from underwriting where
			underwriting_batch_id = '$id'";
            return $this->db->query($query)->result();
        }

        function get($sum_insured = '', $age = '', $product_id = ''){
           $csql = "SELECT
                a.*
            FROM
                underwriting as a,
                underwriting_batch as b
            WHERE
                a.underwriting_batch_id = b.underwriting_batch_id
            AND a.sum_insured_min <= '$sum_insured'
            AND a.sum_insured_max >= '$sum_insured'
            AND a.min_age <= '$age'
            AND a.max_age >= '$age'
            AND b.product_id = '$product_id'";
            return $this->db->query($csql)->row();
        }
    }
?>
