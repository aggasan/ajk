<?php
    class Bank_m extends CI_Model {
        function getAll(){
        	$query = "SELECT
						a.*, c.bank_type_name
					FROM
						bank AS a,
						bank_type AS c
					WHERE
					a.bank_type_id = c.bank_type_id
                    AND a.rowstate = 'active'";
            return $this->db->query($query)->result();
        }

        function getById($id){
        	$query = "SELECT
						a.*, c.bank_type_name
					FROM
						bank AS a,
						bank_type AS c
					WHERE
						a.bank_type_id = c.bank_type_id
					AND a.bank_id = '$id'";
            return $this->db->query($query)->row();
        }

        function getProductId($bank_id){
            $query = "SELECT
                        a.*, b.product_name
                    FROM
                        bank AS a,
                        product AS b
                    WHERE
                        a.product_id = b.product_id
                    AND a.bank_id = '$bank_id'";
            return $this->db->query($query)->row();
        }

        public function get_total_info(){
            $query = "SELECT count(bank_id) as bank_total from bank WHERE bank_type_id = 1";
            return $this->db->query($query)->row();
        }

        function delete($id){
            $this->db->delete('bank', array('bank_id'=>$id));
    	}

    	function insert(){
    		$this->db->insert('bank',
                array('bank_type_id'  	=>  $this->input->post('bank_type_id'),
                'product_id'  			=>  $this->input->post('product_id'),
                'bank_name' 			=>  $this->input->post('bank_name'),
                'address' 				=>  $this->input->post('address'),
                'city_name' 		    =>  $this->input->post('city_name'),
                'district' 				=>  $this->input->post('district'),
                'phone' 				=>  $this->input->post('phone'),
                'fax' 					=>  $this->input->post('fax'),
                'zipcode' 				=>  $this->input->post('zipcode'),
                'ceo' 					=>  $this->input->post('ceo'),
                'create_date'       	=>  date('Y-m-d'),
                'user_inp'				=> 	$this->session->userdata('username'),
                'rowstate'          	=>  'planned'
                ));
    	}

        public function confirm($bank_id){
            $data = array(
                'rowstate'                  => 'active'
            );
            $this->db->where('bank_id', $bank_id);
            $this->db->update('bank', $data);  
            $this->session->set_flashdata('success', 'Perusahaan/Client berhasil dikonfirmasi.');
        }
    }
?>
