<?php
    class Marketing_program_m extends CI_Model{
        
        function getAll(){
            return $this->db->get('marketing_program')->result();
        }

        function delete($id){
            $this->db->delete('marketing_program', array('marketing_program_id'=>$id));
    	}

    	function insert(){
    		$this->db->insert('marketing_program',array(
    			'marketing_program_name' 	=> $this->input->post('marketing_program_name'),
    			'discount' 				 	=> $this->input->post('discount'),
    			'period_start' 				=> $this->input->post('period_start'),
    			'period_end'				=> $this->input->post('period_end'),
    			'create_date'				=> date('Y-m-d'),
    			'user_inp'					=> $this->session->userdata('username'),
    			'rowstate'					=> 'planned' 
    			));
    	}
    }
?>
