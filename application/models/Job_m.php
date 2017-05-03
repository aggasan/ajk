<?php
    class Job_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('job')->result();
        }

        function delete($id){
            $this->db->delete('job', array('job_id'=>$id));
    	}
    }
?>
