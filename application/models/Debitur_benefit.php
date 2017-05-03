<?php
    class Debitur_benefit_m extends CI_Model 
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
    }
?>
