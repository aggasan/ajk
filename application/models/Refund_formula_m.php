<?php
    class Refund_formula_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('refund_formula')->result();
        }

        function delete($id){
            $this->db->delete('refund_formula', array('refund_formula_id'=>$id));
    	}
    }
?>
