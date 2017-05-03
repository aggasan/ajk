<?php
    class Gender_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('gender')->result();
        }

        function delete($id){
            $this->db->delete('gender', array('gender_id'=>$id));
    	}
    }
?>
