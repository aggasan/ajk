<?php
    class Sum_insured_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('sum_insured_type')->result();
        }

        function delete($sum_insured_type_id){
            $this->db->delete('sum_insured_type', array('sum_insured_type_id'=>$sum_insured_type_id));
    	}

    	function insert(){
            $this->db->insert('sum_insured_type',
                array('sum_insured_type_name'  	=>  $this->input->post('sum_insured_type_name'),
                    'create_date'       	=>  date('Y-m-d H:i:s'),
                    'user_inp'				=> 	$this->session->userdata('username'),
                    'rowstate'          	=>  'confirmed'
                ));
        }

        function update($sum_insured_type_id){

            $_data = array('sum_insured_type_name'  	=>  $this->input->post('sum_insured_type_name'),
                            'create_date'       	=>  date('Y-m-d H:i:s'),
                            'user_inp'				=> 	$this->session->userdata('username'),
                            'rowstate'          	=>  'confirmed'
            );
            $this->db->where('sum_insured_type_id',$sum_insured_type_id);
            if( $this->db->update('sum_insured_type', $_data ))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getById($sum_insured_type_id){
            $query = "SELECT * FROM sum_insured_type WHERE sum_insured_type_id = '$sum_insured_type_id'";
            return $this->db->query($query)->row();
        }
    }
?>
