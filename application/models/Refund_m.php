<?php
    class Refund_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('refund')->result();
        }

        function delete($id){
            $this->db->delete('refund', array('refund_id'=>$id));
    	}

    	public function insert(){
    		$this->db->insert('refund',array(
    			'debitur_id' 	=> $this->input->post('debitur_id'),
    			'remain_premi' 	=> $this->input->post('remain_premi'),
    			'remain_period' => $this->input->post('remain_period'),
    			'refund_date' 	=> $this->input->post('refund_date'),
    			'create_date' 	=> date('Y-m-d H:i:s'),
    			'user_inp' 		=> $this->session->userdata('username'),
    			'rowstate' 		=> 'planned'
    			));
    		
    		// CHANGE FLAG REFUND 
    		$debitur_data = array(
                'flag_refund'  	=> 1
            );
            $this->db->where('debitur_id', $this->input->post('debitur_id'));
            $this->db->update('debitur', $debitur_data);  
    	}
    }
?>
