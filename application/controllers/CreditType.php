<?php
	class CreditType extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'Credit_type_m'
			));
			$this->load->library('form_validation');
		}

		function index(){
			redirect('CreditType/list_data');
		}

		function list_data(){
			$this->data['getCreditType']     = $this->Credit_type_m->getAll();
			$this->data['datatablesUrl']    = base_url('CreditType/datatables');
			$this->data['title_1']          = "Master";
			$this->data['title_2']          = "Jenis Kredit";
			$this->data['content']          = $this->load->view('credit_type/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'credit_type.credit_type_id,'.
				'credit_type.credit_type_name,'.
				'credit_type.create_date,'.
				'credit_type.user_inp'
			)
				->order_by('credit_type.credit_type_id', 'DESC')
				->from('credit_type')
				->add_column('action', '<a href="' . base_url() . 'CreditType/detail/$1" class="btn btn-xs default blue-stripe">Edit</a>', 'credit_type_id')
				->unset_column('credit_type.credit_type_id');

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

				$this->form_validation->set_rules('credit_type_name', 'credit_type_name', 'required');

				if ($this->form_validation->run() == TRUE) {
					$this->Credit_type_m->insert();
					$this->session->set_flashdata('success', 'Data Jenis Kredit berhasil disimpan');
					redirect('CreditType/list_data/');
				}
				else {
					$this->session->set_flashdata('error', 'Data Nama Jenis Kredit harus di isi.');
					$this->data['title_1'] = "Master";
					$this->data['title_2'] = "Tambah Jenis Kredit";
					$this->data['content'] = $this->load->view('credit_type/form', $this->data, TRUE);
					$this->load->view('layout/main', $this->data);
				}
			} else {
				$this->data['title_1']                        =   "Master";
				$this->data['title_2']                        =   "Tambah Jenis Kredit";
				$this->data['content']                        =   $this->load->view('credit_type/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function detail($id){
			if($this->input->post('submit')){
				$result = $this->Credit_type_m->update($id);
				if($result)
				{
					$this->session->set_flashdata('success', 'Data Jenis Kredit berhasil diupdate');
					redirect('CreditType/list_data/');
				}
				else
				{
					$this->data['title_1']                      =   "Master";
					$this->data['title_2']                      =   "Edit Jenis Kredit";
					$this->data['getCreditById']               	=   $this->Credit_type_m->getById($id);
					$this->data['content']                      =   $this->load->view('credit_type/form_detail',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			}
			else
			{
				$this->data['title_1']                      =   "Master";
				$this->data['title_2']                      =   "Edit Jenis Kredit";
				$this->data['getCreditById']               	=   $this->Credit_type_m->getById($id);
				$this->data['content']                      =   $this->load->view('credit_type/form_detail',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}
	}
?>