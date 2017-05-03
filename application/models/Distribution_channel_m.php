<?php
    class Distribution_channel_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('distribution_channel')->result();
        }

        function delete($id){
            $this->db->delete('distribution_channel', array('distribution_channel_id'=>$id));
    	}
        
        
    }
?>
