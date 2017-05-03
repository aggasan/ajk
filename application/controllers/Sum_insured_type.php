<?php
	class Sum_insured_type extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'Sum_insured_type_m'
			));
			$this->load->library('form_validation');
		}

		function index(){
			redirect('sum_insured_type/list_data');
		}

		function list_data(){
			$this->data['getSumInsuredType']     = $this->Sum_insured_type_m->getAll();
			$this->data['datatablesUrl']    = base_url('sum_insured_type/datatables');
			$this->data['title_1']          = "Master";
			$this->data['title_2']          = "Jenis Uang Pertanggungan";
			$this->data['content']          = $this->load->view('sum_insured_type/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'sum_insured_type.sum_insured_type_id,'.
				'sum_insured_type.sum_insured_type_name,'.
				'sum_insured_type.create_date,'.
				'sum_insured_type.user_inp'
			)
				->order_by('sum_insured_type.sum_insured_type_id', 'DESC')
				->from('sum_insured_type')
				->add_column('action', '<a href="' . base_url() . 'sum_insured_type/edit/$1" class="btn btn-xs default blue-stripe">Edit</a>', 'sum_insured_type_id')
				->unset_column('sum_insured_type.sum_insured_type_id');

			$result = json_decode($this->datatables->generate());
			$resultArray = [];
			$rowIndex = 1;

			foreach ($result->data as $k => $v) {
				$resultArray[] = [
					$rowIndex,
					htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
					htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
					$v[4]
				];

				++ $rowIndex;
			}

			$result->data = $resultArray;

			die(json_encode($result));
		}

		function add(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('sum_insured_type_name', 'sum_insured_type_name', 'required|trim');

				if ($this->form_validation->run() == TRUE) {

					$this->Sum_insured_type_m->insert();
					$this->session->set_flashdata('success', 'Jenis uang pertanggungan berhasil disimpan');
					redirect('sum_insured_type/list_data/');
				}
				else
				{
					$this->session->set_flashdata('error', 'Data Nama Jenis uang pertanggungan harus di isi.');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Jenis uang pertanggungan";
					$this->data['content']                        =   $this->load->view('sum_insured_type/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}

			} else {
				$this->data['title_1']                        =   "Master";
				$this->data['title_2']                        =   "Tambah Jenis uang pertanggungan";
				$this->data['content']                        =   $this->load->view('sum_insured_type/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function edit($sum_insured_type_id){
			if($this->input->post('submit')){
				$result = $this->Sum_insured_type_m->update($sum_insured_type_id);
				if($result)
				{
					$this->session->set_flashdata('success', 'Data Jenis Uang Pertanggungan berhasil diupdate');
					redirect('sum_insured_type/list_data/');
				}
				else
				{
					$this->data['title_1']                      =   "Master";
					$this->data['title_2']                      =   "Edit Jenis Uang Pertanggungan";
					$this->data['get_sum_insured_type']        	=   $this->Sum_insured_type_m->getById($sum_insured_type_id);
					$this->data['content']                      =   $this->load->view('sum_insured_type/form_edit',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			}
			else
			{
				$this->data['title_1']                      =   "Master";
				$this->data['title_2']                      =   "Edit Jenis Uang Pertanggungan";
				$this->data['get_sum_insured_type']        	=   $this->Sum_insured_type_m->getById($sum_insured_type_id);
				$this->data['content']                      =   $this->load->view('sum_insured_type/form_edit',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}
	}
?>