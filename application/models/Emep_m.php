<?php
    class Emep_m extends CI_Model 
    {
        public function getAll(){
            return $this->db->get('emep')->result();
        }

        public function delete($id){
            $this->db->delete('emep', array('emep_id'=>$id));
    	}

    	public function getByDebiturId($debitur_id){
        	$query = "SELECT * FROM emep WHERE debitur_id = '$debitur_id'";
            return $this->db->query($query)->row();
        }

    	public function insert(){
            $this->load->model('Debitur_m');
            
            $debitur_id = $this->input->post('debitur_id');
            $debitur_premi = $this->Debitur_m->getById($debitur_id);
            if($this->input->post('condition') == 'Substandar'){
                $premi = (($this->input->post('percent') / 100) * $debitur_premi->premi) + $debitur_premi->premi;
            } else {
                $premi = 0;
            }
            
    		
            $this->db->insert('emep', 
    			array('debitur_id' 	=> $debitur_id,
    			'condition' 	    => $this->input->post('condition'),
    			'type' 	            => $this->input->post('type'),
    			'percent'			=> $this->input->post('percent'),
    			'premi'		        => $premi,
                'note'              => $this->input->post('note'),
    			'create_date'       => date('Y-m-d H:i:s'),
                'user_inp'          => $this->session->userdata('username'),
                'rowstate'          => $this->input->post('rowstate')
    				));
            // UPDATE TABLE PREMI EM/EP TO DEBITUR
            $data = array(
                'premi_emep' => $premi
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $data);
            // END  UPDATE TABLE PREMI EM/EP TO DEBITUR

            $this->session->set_userdata('ses_debitur_id', $this->input->post('debitur_id'));
    	}
    }
?>
