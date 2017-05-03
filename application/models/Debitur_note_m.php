<?php
    class Debitur_note_m extends CI_Model 
    {
        public function getAll(){
            return $this->db->get('debitur_note')->result();
        }

        public function delete($id){
            $this->db->delete('debitur_note', array('debitur_note_id'=>$id));
    	}

        public function get_by_debitur_id($debitur_id){
            $query = "SELECT * FROM debitur_note WHERE debitur_id = '$debitur_id'";
            return $this->db->query($query)->result();
        }

    	public function insert($debitur_id, $note){
    		$this->db->insert('debitur_note',array(
    			'debitur_id' 	=> $debitur_id,
    			'note' 			=> $note,
    			'user_entity' 	=> $this->session->userdata('user_entity'),
    			'create_date' 	=> date('Y-m-d H:i:s'),
    			'user_inp' 		=> $this->session->userdata('username'),
    			'rowstate' 		=> 0,
    			));
    	}
    }
?>
