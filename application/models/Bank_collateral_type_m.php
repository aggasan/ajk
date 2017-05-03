<?php
    class Bank_collateral_type_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('bank_collateral_type')->result();
        }


        function delete($id){
            $this->db->delete('bank_collateral_type', array('bank_collateral_type_id'=>$id));
        }

        function insert(){
            $this->db->insert('bank_collateral_type',
                array('bank_collateral_type_name'   =>  $this->input->post('bank_collateral_type_name'),
                    'create_date'           =>  date('Y-m-d'),
                    'user_inp'              =>  $this->session->userdata('username'),
                    'rowstate'              =>  'confirmed'
                ));
        }

        function update($id){

            $_data = array('bank_collateral_type_name'      =>  $this->input->post('bank_collateral_type_name'),
                'create_date'                               =>  date('Y-m-d'),
                'user_inp'                                  =>  $this->session->userdata('username'),
                'rowstate'                                  =>  'confirmed'
            );
            $this->db->where('bank_collateral_type_id',$id);
            if( $this->db->update('bank_collateral_type', $_data))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getById($id){
            $query = "SELECT * FROM bank_collateral_type WHERE bank_collateral_type_id = '$id'";
            return $this->db->query($query)->row();
        }
        
        
    }
?>
