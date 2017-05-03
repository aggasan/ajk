<?php

	class Users extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'User_m',
				'Bank_m',
				'Roles_m'
			));
			$this->load->library('form_validation');
		}

		public function index(){
			redirect('Users/list_data');
		}

		function list_data(){
			$this->data['getusers']		    = $this->User_m->getAll();
			$this->data['datatablesUrl']    = base_url('Users/datatables');
			$this->data['title_1']          = "User Management";
			$this->data['title_2']          = "List Users  ";
			$this->data['content']          = $this->load->view('users/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'user.user_id,'.
				'user.username,'.
				'roles.roles_name,'.
				'bank.bank_name,'.
				'user.description,'.
				'user.rowstate,'
			)
				->order_by('user.user_id', 'DESC')
				->from('user')
				->join('bank','user.bank_id = bank.bank_id')
				->join('roles','user.roles_id = roles.roles_id')
				->add_column('action', '<a href="' . base_url() . 'Users/detail/$1" class="btn btn-xs default blue-stripe">Ubah Status</a>', 'user_id')
				->unset_column('user.user_id');

			$result = json_decode($this->datatables->generate());
			$resultArray = [];
			$rowIndex = 1;

			foreach ($result->data as $k => $v) {
				$resultArray[] = [
					$rowIndex,
					htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
					$v[6]
				];

				++ $rowIndex;
			}

			$result->data = $resultArray;

			die(json_encode($result));
		}

		function add(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('user_category', 'user_category', 'required');
				$this->form_validation->set_rules('user_username', 'user_username', 'required');
				$this->form_validation->set_rules('user_bankid', 'user_bankid', 'required');
				$this->form_validation->set_rules('user_password', 'user_password', 'required');
				$this->form_validation->set_rules('user_roles', 'user_roles', 'required');
				$this->form_validation->set_rules('retype', 'retype', 'required');

				if ($this->form_validation->run() == TRUE) {
					if($this->input->post('user_password') == $this->input->post('retype'))
					{
						$this->User_m->insert();
						$this->session->set_flashdata('success', 'Data User berhasil disimpan');
						redirect('Users/list_data/');
					}
					else
					{
						$this->session->set_flashdata('error', 'Password tidak sama');
						redirect('Users/add/');
					}

				}
				else{
					$this->session->set_flashdata('error', 'Data user harus di isi.');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Users";
					$this->data['content']                        =   $this->load->view('benefit/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			} else {
				$this->data['title_1']              = "User Management";
				$this->data['title_2']             	= "Tambah User";
				$this->data['get_bank']             = $this->Bank_m->getAll();
				$this->data['get_role']             = $this->Roles_m->getAll();
				$this->data['content']              = $this->load->view('users/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function edit(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('old_password', 'old_password', 'required');
				$this->form_validation->set_rules('retype', 'retype', 'required');

				if ($this->form_validation->run() == TRUE) {
					if(md5($this->input->post('old_password')) == $this->session->userdata('pass'))
					{
						$this->User_m->ubah($this->input->post('id_username'));
						$this->session->set_flashdata('success', 'Data User berhasil disimpan');
						$this->session->set_userdata('pass', $this->input->post('new_password'));
						redirect('home');
					}
					else
					{
						$this->session->set_flashdata('error', 'Password tidak sama dengan password anda yang terdahulu.');
						redirect('users/edit/');
					}
				}
				else{
					$this->session->set_flashdata('error', 'Data user harus di isi.');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Users";
					$this->data['content']                        =   $this->load->view('benefit/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			} else {
				$this->data['title_1']              = "User Management";
				$this->data['title_2']             	= "Ubah Password";
				$this->data['get_bank']             = $this->Bank_m->getAll();
				$this->data['get_role']             = $this->Roles_m->getAll();
				$this->data['content']              = $this->load->view('users/edit',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function detail($id){
			if($this->input->post('submit')){

			}
			else{
				$data_user	= $this->User_m->getById($id);
				if($data_user->rowstate == 'active')
				{
					$sesi_username = $this->session->userdata('username');
					$exist_username = $data_user->username;
					if($sesi_username == $exist_username)
					{
						$result = $this->User_m->update($id, 1);
						if($result)
						{
							$data_session = array(
								'isLogin'       => $this->session->userdata('isLogin'),
								'user_id'       => $this->session->userdata('user_id'),
								'username'      => $this->session->userdata('username'),
								'roles_id'      => $this->session->userdata('roles_id'),
								'user_entity'   => $this->session->userdata('user_entity'),
								'bank_id'       => $this->session->userdata('bank_id'),
								'bank_name'     => $this->session->userdata('bank_name')
							);
							$this->session->unset_userdata($data_session);
							redirect('user/login');
						}
					}
					else
					{
						$result = $this->User_m->update($id, 1);
						if($result)
						{
							$this->session->set_flashdata('success', 'Data User berhasil diupdate');
							redirect('Users/list_data/');
						}
					}
				}
				else
				{
					$result = $this->User_m->update($id, 0);
					if($result)
					{
						$this->session->set_flashdata('success', 'Data User berhasil diupdate');
						redirect('Users/list_data/');
					}
				}
			}
		}
	}