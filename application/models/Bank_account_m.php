<?php
    class Bank_account_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('bank_account')->result();
        }

        function delete($id){
            $this->db->delete('bank_account', array('bank_account_id'=>$id));
    	}
    }
?>
