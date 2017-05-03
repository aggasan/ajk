<?php
    class Param_publishing_certificate_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('param_publishing_certificate')->result();
        }


        function delete($id){
            $this->db->delete('Param_publishing_certificate', array('Param_publishing_certificate_id'=>$id));
    	}
        
        
    }
?>
