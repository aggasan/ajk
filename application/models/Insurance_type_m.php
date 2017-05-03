<?php
    class Insurance_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('insurance_type')->result();
        }

        function delete($id){
            $this->db->delete('insurance_type', array('insurance_type_id'=>$id));
    	}

    	public function getById($insurance_type_id){
    		$csql = "SELECT * FROM insurance_type WHERE insurance_type_id = '$insurance_type_id'";
    		return $this->db->query($csql)->row();
    	}
    }
?>
