<?php
    class Identity_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('identity_type')->result();
        }

        function delete($id){
            $this->db->delete('identity_type', array('identity_type_id'=>$id));
    	}
    }
?>
