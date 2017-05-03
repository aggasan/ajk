<?php
    class Pay_method_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('pay_method')->result();
        }

        function delete($id){
            $this->db->delete('pay_method', array('pay_method_id'=>$id));
    	}
        
        function insert(){
            $this->db->insert('pay_method',
                array('pay_method_name'  	=>  $this->input->post('pay_method_name'),
                    'create_date'       	=>  date('Y-m-d H:i:s'),
                    'user_inp'				=> 	$this->session->userdata('username'),
                    'rowstate'          	=>  'confirmed'
                ));
        }

        function update($id){

            $_data = array('pay_method_name'  	=>  $this->input->post('pay_method_name'),
                            'create_date'       =>  date('Y-m-d H:i:s'),
                            'user_inp'			=> 	$this->session->userdata('username'),
                            'rowstate'          =>  'confirmed'
            );
            $this->db->where('pay_method_id',$id);
            if( $this->db->update('pay_method', $_data ))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getById($id){
            $query = "SELECT * FROM pay_method WHERE pay_method_id = '$id'";
            return $this->db->query($query)->row();
        }
    }
?>
