<?php
    class City_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('city')->result();
        }

        function delete($id){
            $this->db->delete('city', array('city_id'=>$id));
    	}
    }
?>
