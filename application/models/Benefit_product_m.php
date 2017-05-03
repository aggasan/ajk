<?php
    class Benefit_product_m extends CI_Model 
    {
        function getAll(){
        	$query = "SELECT
					a.*, b.benefit_name
				FROM
					benefit_product AS a,
					benefit AS b,
					product AS c
				WHERE
					a.product_id = c.product_id
				AND a.benefit_id = b.benefit_id";
            return $this->db->get('benefit')->result();
        }

        function getByid($product_id = '',$benefit_type_id = '', $debitur_id = ''){
        	$query = "SELECT
						a.*, b.benefit_name, b.benefit_id, b.benefit_code, d.debitur_premi_id
					FROM
						benefit_product AS a,
						product AS c,
						benefit AS b
					LEFT JOIN (
						SELECT
							*
						FROM
							debitur_premi
						WHERE
							debitur_id = '$debitur_id'
					) AS d ON d.benefit_id = b.benefit_id
					WHERE
						a.product_id = c.product_id
					AND a.benefit_id = b.benefit_id
					AND a.benefit_type_id = '$benefit_type_id'
					AND a.product_id = '$product_id'";
            return $this->db->query($query)->result();
        }

        function get_id($product_id = '',$benefit_type_id = ''){
        	$query = "SELECT a.*,b.benefit_product_id FROM benefit as a
					LEFT JOIN(SELECT
						*
					FROM
						benefit_product
					WHERE
						product_id = '$product_id') as b ON a.benefit_id = b.benefit_id
						WHERE a.benefit_type_id = '$benefit_type_id'";
            return $this->db->query($query)->result();
        }

        function getByProduct($product_id){
        	$query = "SELECT
					a.*, b.benefit_name
				FROM
					benefit_product AS a,
					benefit AS b,
					product AS c
				WHERE
					a.product_id = c.product_id
				AND a.benefit_id = b.benefit_id
				and a.product_id = '$product_id'";
            return $this->db->query($query)->result();
        }

        function delete($id){
            $this->db->delete('benefit', array('benefit_id'=>$id));
    	}
    }
?>
