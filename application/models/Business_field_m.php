<?php
    class Business_field_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('business_field')->result();
        }

        function delete($id){
            $this->db->delete('business_field', array('business_field_id'=>$id));
    	}
    }
?>
