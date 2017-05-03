<?php
    class Benefit_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('benefit')->result();
        }

        function delete($id){
            $this->db->delete('benefit', array('benefit_id'=>$id));
    	}

    	function insert(){
            $this->db->insert('benefit',
                array('benefit_name'  	    =>  $this->input->post('benefit_name'),
                    'benefit_type_id'       =>  $this->input->post('benefit_type_id'),
                    'benefit_code'          =>  $this->input->post('benefit_code'),
                    'create_date'       	=>  date('Y-m-d'),
                    'user_inp'				=> 	$this->session->userdata('username'),
                    'rowstate'          	=>  'confirmed'
                ));
        }

        function update($id){

            $_data = array('benefit_name'  	=>  $this->input->post('benefit_name'),
                'benefit_type_id'           =>  $this->input->post('benefit_type_id'),
                'benefit_code'              =>  $this->input->post('benefit_code'),
                'create_date'       	    =>  date('Y-m-d'),
                'user_inp'				    => 	$this->session->userdata('username'),
                'rowstate'          	    =>  'confirmed'
            );
            $this->db->where('benefit_id',$id);
            if( $this->db->update('benefit', $_data))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getById($id){
            $query = "SELECT a.*, b.benefit_type_name FROM benefit as a, benefit_type as b WHERE a.benefit_type_id = b.benefit_type_id and benefit_id = '$id'";
            return $this->db->query($query)->row();
        }
    }
?>
