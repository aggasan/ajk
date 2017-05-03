<?php
    class Healt_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('healt')->result();
        }

        function delete($id){
            $this->db->delete('healt', array('healt_id'=>$id));
    	}

    	function getByDebiturId($debitur_id){
        	$query = "SELECT
        				* from healt where
        			debitur_id = '$debitur_id'";
            return $this->db->query($query)->row();
        }

        function insert(){
            $this->db->insert('healt',
                array('debitur_id'                  => $this->input->post('debitur_id'),
                    'height'                        => $this->input->post('height'),
                    'weight'                        => $this->input->post('weight'),
                    'weight_changes'                => $this->input->post('weight_changes'),
                    'weight_changes_opt'            => $this->input->post('weight_changes_opt'),
                    'weight_changes_val'            => $this->input->post('weight_changes_val'),
                    'smoke'                         => $this->input->post('smoke'),
                    'smoke_explanation'             => $this->input->post('smoke_explanation'),
                    'disease'                       => $this->input->post('disease'),
                    'disease_explanation'           => $this->input->post('disease_explanation'),
                    'narcotic'                      => $this->input->post('narcotic'),
                    'narcotic_explanation'          => $this->input->post('narcotic_explanation'),
                    'insurance_denial'              => $this->input->post('insurance_denial'),
                    'insurance_denial_explanation'  => $this->input->post('insurance_denial_explanation'),
                    'pregnant'                      => $this->input->post('pregnant'),
                    'pregnant_explanation'          => $this->input->post('pregnant_explanation'),
                    'create_date'                   => date('Y-m-d H:i:s'),
                    'user_inp'                      => $this->session->userdata('username'),
                    'rowstate'                      => 'planned'
                    ));
            $this->session->set_userdata('ses_debitur_id', $this->input->post('debitur_id'));
        }
    }
?>
