<?php
    class Mariage_status_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('mariage_status')->result();
        }

        function delete($id){
            $this->db->delete('mariage_status', array('mariage_status_id'=>$id));
    	}
    }
?>
