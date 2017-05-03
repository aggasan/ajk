<?php
    class Count_age_method_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('count_age_method')->result();
        }


        function delete($id){
            $this->db->delete('count_age_method', array('count_age_method_id'=>$id));
    	}
        
        
    }
?>
