<?php
    class Document_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('document')->result();
        }

        function delete($id){
            $this->db->delete('document', array('document_id'=>$id));
    	}

    	function get($document_id){
        	$query = "SELECT * FROM document WHERE document_id = '$document_id'";
            return $this->db->query($query)->row();
        }

        function get_claim($document_id){
            $query = "SELECT * FROM document_claim WHERE document_id = '$document_id'";
            return $this->db->query($query)->row();
        }

        function get_document_type($debitur_id, $document_type_id){
            $query = "SELECT * FROM document WHERE document_type_id = '$document_type_id' and debitur_id = '$debitur_id'";
            return $this->db->query($query)->row();
        }

    	public function insert($file){
    		$this->db->insert('document', 
    			array('debitur_id' 	=> $this->input->post('debitur_id'),
    			'document_type_id' 	=> $this->input->post('document_type_id'),
    			'document_name' 	=> $this->input->post('document_name'),
    			'up_file'			=> $file,
    			'information'		=> $this->input->post('information'),
    			'create_date'       => date('Y-m-d H:i:s'),
                'user_inp'          => $this->session->userdata('username'),
                'rowstate'          => 'planned'
    				));
    	}

        public function insert_claim($file){
            $this->db->insert('document_claim', 
                array('claim_id'    => $this->input->post('claim_id'),
                'document_type_id'  => $this->input->post('document_type_id'),
                'document_name'     => $this->input->post('document_name'),
                'up_file'           => $file,
                'information'       => $this->input->post('information'),
                'create_date'       => date('Y-m-d H:i:s'),
                'user_inp'          => $this->session->userdata('username'),
                'rowstate'          => 'planned'
                    ));
        }
    }
?>
