<?php
    class Debitur_premi_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('benefit')->result();
        }

        function delete($id){
            $this->db->delete('benefit', array('benefit_id'=>$id));
    	}

    	function getByDebitur($debitur_id){
        	$query = "SELECT
					a.*, b.benefit_name
				FROM
					debitur_premi AS a,
					benefit AS b
				WHERE
					a.benefit_id = b.benefit_id
				and a.debitur_id = '$debitur_id'";
            return $this->db->query($query)->result();
        }

        function getByDebitur_old($debitur_id){
            echo $query = "SELECT
                *
            FROM
                benefit AS a
            LEFT JOIN (
                SELECT
                    *
                FROM
                    debitur_benefit
                WHERE
                    debitur_id = '$debitur_id'
            ) AS b ON a.benefit_id = b.benefit_id";
            return $this->db->query($query)->result();
        }
    }
?>
