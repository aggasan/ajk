<?php
    class Benefit_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('benefit_type')->result();
        }

        function delete($id){
            $this->db->delete('benefit_type', array('benefit_type_id'=>$id));
    	}
    }
?>
