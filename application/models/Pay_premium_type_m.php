<?php
    class Pay_premium_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('pay_premium_type')->result();
        }

        function delete($id){
            $this->db->delete('pay_premium_type', array('pay_premium_type_id'=>$id));
    	}
    }
?>
