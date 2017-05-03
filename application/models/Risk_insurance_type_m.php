<?php
    class Risk_insurance_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('risk_insurance_type')->result();
        }

        function delete($id){
            $this->db->delete('risk_insurance_type', array('risk_insurance_type_id'=>$id));
    	}
        
        
    }
?>
