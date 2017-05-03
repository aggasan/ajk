<?php
    class Creditur_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('creditur_type')->result();
        }

        function delete($id){
            $this->db->delete('creditur_type', array('creditur_type_id'=>$id));
    	}
    }
?>
