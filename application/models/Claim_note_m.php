<?php
    class Claim_note_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('claim_note')->result();
        }

        function delete($id){
            $this->db->delete('claim_note', array('claim_note_id'=>$id));
    	}

    	function getByClaimId($claim_id){
            $query = "SELECT * FROM claim_note WHERE claim_id = '$claim_id'";
            return $this->db->query($query)->result();
        }

    	public function insert($claim_id, $note){
    		$this->db->insert('claim_note',array(
    			'claim_id'		=> $claim_id,
    			'note' 			=> $note,
    			'user_entity' 	=> $this->session->userdata('user_entity'),
    			'create_date'   => date('Y-m-d H:i:s'),
                'user_inp'      => $this->session->userdata('username'),
                'rowstate'      => 'planned'
    			));
    	}
    }
?>
