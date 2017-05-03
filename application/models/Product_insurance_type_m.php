<?php
    class Product_insurance_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('product_insurance_type')->result();
        }

        function delete($id){
            $this->db->delete('product_insurance_type', array('product_insurance_type_id'=>$id));
    	}

    	function getByBankid($bank_id = ''){
    		$query = "SELECT
                        d.*
                    FROM
                        bank AS a,
                        product AS b,
                        product_insurance_type as c,
                        insurance_type as d
                    WHERE
                        a.product_id = b.product_id
                    AND b.product_id = c.product_id
                    AND c.insurance_type_id = d.insurance_type_id
                    AND a.bank_id = '$bank_id'";
            return $this->db->query($query)->result();
    	}
    }
?>
