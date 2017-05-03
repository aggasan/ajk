<?php
    class Period_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('period_type')->result();
        }

        function delete($id){
            $this->db->delete('period_type', array('period_type_id'=>$id));
    	}
    }
?>
