<?php
    class Certificate_template_m extends CI_Model 
    {
        public function getAll($rowstate = NULL){
            return $this->db->get_where('certificate_template',array('rowstate'=>$rowstate))->result();
        }

        public function delete($certificate_template_id){
            $this->db->delete('certificate_template', array('certificate_template_id'=>$certificate_template_id));
    	}

    	public function getById($certificate_template_id){
            $query = "SELECT * FROM certificate_template WHERE certificate_template_id = '$certificate_template_id'";
            return $this->db->query($query)->row();
        }

        public function get_by_policy_id($policy_id){
        	$query = "SELECT a.*, b.certificate_text FROM policy AS a, certificate_template AS b WHERE a.certificate_template_id = b.certificate_template_id AND a.policy_id = '$policy_id'";
            return $this->db->query($query)->row();
        }

    	public function insert(){
    		$this->db->insert('certificate_template', array(
    			'certificate_template_name' => $this->input->post('certificate_template_name'),
    			'certificate_text' 			=> $this->input->post('certificate_text'),
    			'create_date'       		=> date('Y-m-d H:i:s'),
                'user_inp'					=> $this->session->userdata('username'),
                'rowstate'          		=> $this->input->post('rowstate')
    			));
    	}

    	public function update($certificate_template_id){
    		$data = array(
				'certificate_template_name' => $this->input->post('certificate_template_name'),
    			'certificate_text' 			=> $this->input->post('certificate_text'),
    			'create_date'       		=> date('Y-m-d H:i:s'),
                'user_inp'					=> $this->session->userdata('username'),
                'rowstate'          		=> $this->input->post('rowstate')
			);
			$this->db->where('certificate_template_id', $certificate_template_id);
			$this->db->update('certificate_template', $data);
    	}
    }
?>
