<?php
    class Document_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('document_type')->result();
        }

        function delete($id){
            $this->db->delete('document_type', array('document_type_id'=>$id));
    	}
        
        function get($flag_doc){
        	$query = "SELECT * FROM document_type WHERE flag_doc = '$flag_doc'";
            return $this->db->query($query)->result();
        }
        
    }
?>
