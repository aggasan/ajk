<?php
    class Credit_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('credit_type')->result();
        }


        function delete($id){
            $this->db->delete('credit_type', array('credit_type_id'=>$id));
    	}
        
        function insert(){
            $this->db->insert('credit_type',
                array('credit_type_name'  	=>  $this->input->post('credit_type_name'),
                    'create_date'       	=>  date('Y-m-d H:i:s'),
                    'user_inp'				=> 	$this->session->userdata('username'),
                    'rowstate'          	=>  'confirmed'
                ));
        }

        function update($id){

            $_data = array('credit_type_name'  	=>  $this->input->post('credit_type_name'),
                            'create_date'       	=>  date('Y-m-d H:i:s'),
                            'user_inp'				=> 	$this->session->userdata('username'),
                            'rowstate'          	=>  'confirmed'
            );
            $this->db->where('credit_type_id',$id);
            if( $this->db->update('credit_type', $_data ))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getById($id){
            $query = "SELECT * FROM credit_type WHERE credit_type_id = '$id'";
            return $this->db->query($query)->row();
        }
    }
?>
