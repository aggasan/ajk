<?php
    class Claim_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('claim_type')->result();
        }

        function delete($id){
            $this->db->delete('claim_type', array('claim_type_id'=>$id));
    	}
    }
?>
