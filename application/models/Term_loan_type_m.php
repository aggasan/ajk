<?php
    class Term_loan_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('term_loan_type')->result();
        }


        function delete($id){
            $this->db->delete('term_loan_type', array('term_loan_type_id'=>$id));
    	}
        
        
    }
?>
