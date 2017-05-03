<?php
	class User_m extends CI_Model
	{
		public function getAll(){
			return $this->db->get('user')->result();
		}

		function getById($id){
			$query = "SELECT username, rowstate FROM user WHERE user_id = '$id'";
			return $this->db->query($query)->row();
		}

		function update($id, $status){

			if($status==1)
			{
				$_data = array(
					'rowstate'	=> 'nonactive',
					'user_inp'	=> 	$this->session->userdata('username')
				);
				$this->db->where('user_id',$id);
				if( $this->db->update('user', $_data))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				$_data = array(
					'rowstate'	=> 'active',
					'user_inp'	=> 	$this->session->userdata('username')
				);
				$this->db->where('user_id',$id);
				if( $this->db->update('user', $_data))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}

		public function ubah($id)
		{
			$_data = array(
				'password'	=> md5($this->input->post('new_password')),
				'user_inp'	=> $this->session->userdata('username')
			);

			$this->db->where('user_id', $id);
			if( $this->db->update('user', $_data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function delete($id){
			$this->db->delete('user', array('user_id'=>$id));
		}

		public function insert(){
			$this->db->insert('user',array(
				'user_entity'   => $this->input->post('user_category'),
				'roles_id'      => $this->input->post('user_roles'),
				'bank_id'    	=> $this->input->post('user_bankid'),
				'username'      => $this->input->post('user_username'),
				'password'      => md5($this->input->post('user_password')),
				'photo'         => 'default.jpg',
				'description'   => '-',
				'create_date'   => date('Y-m-d H:i:s'),
				'user_inp'      => $this->session->userdata('username'),
				'rowstate'      => 'active'
			));
		}
	}
?>
