<?php
    class Product_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('product_type')->result();
        }


        function delete($id){
            $this->db->delete('product_type', array('product_type_id'=>$id));
    	}
        
        
    }
?>
