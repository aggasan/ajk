<?php
    class Currency_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('currency')->result();
        }


        function delete($id){
            $this->db->delete('currency', array('currency_id'=>$id));
    	}
        
        
    }
?>
