<?php
	class Benefit extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'Benefit_m',
				'Benefit_type_m'
			));
			$this->load->library('form_validation');
		}

		function index(){
			redirect('Benefit/list_data');
		}

		function list_data(){
			$this->data['getbenefit_type']  = $this->Benefit_m->getAll();
			$this->data['datatablesUrl']    = base_url('Benefit/datatables');
			$this->data['title_1']          = "Master";
			$this->data['title_2']          = "Jenis Benefit";
			$this->data['content']          = $this->load->view('benefit/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'benefit.benefit_id,'.
				'benefit_type.benefit_type_name,'.
				'benefit.benefit_code,'.
				'benefit.benefit_name,'.
				'benefit.create_date,'.
				'benefit.user_inp'
			)
				->order_by('benefit.benefit_id', 'DESC')
				->from('benefit')
				->join('benefit_type', 'benefit_type.benefit_type_id = benefit.benefit_type_id')
				->add_column('action', '<a href="' . base_url() . 'Benefit/detail/$1" class="btn btn-xs default blue-stripe">Edit</a>', 'benefit_id')
				->unset_column('benefit.benefit_id');

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

				$this->form_validation->set_rules('benefit_name', 'benefit_name', 'required');

				if ($this->form_validation->run() == TRUE) {
					$this->Benefit_m->insert();
					$this->session->set_flashdata('success', 'Data Benefit berhasil disimpan');
					redirect('Benefit/list_data/');
				}
				else{
					$this->session->set_flashdata('error', 'Data Benefit harus di isi.');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Jenis Benefit";
					$this->data['get_benefit_type']				  = $this->Benefit_type_m->getAll();
					$this->data['content']                        =   $this->load->view('benefit/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			} else {
				$this->data['title_1']                        =   "Master";
				$this->data['title_2']                        =   "Tambah Jenis Benefit";
				$this->data['get_benefit_type']				  = $this->Benefit_type_m->getAll();
				$this->data['content']                        =   $this->load->view('benefit/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function detail($id){
			if($this->input->post('submit')){
				$result = $this->Benefit_m->update($id);
				if($result)
				{
					$this->session->set_flashdata('success', 'Data Benefit berhasil diupdate');
					redirect('Benefit/list_data/');
				}
				else
				{
					$this->data['title_1']                      =   "Master";
					$this->data['title_2']                      =   "Edit Benefit";
					$this->data['getBenefit']       			=   $this->Benefit_m->getById($id);
					$this->data['get_benefit_type']				  = $this->Benefit_type_m->getAll();
					$this->data['content']                      =   $this->load->view('benefit/form_detail',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			}
			else
			{
				$this->data['title_1']                      =   "Master";
				$this->data['title_2']                      =   "Edit Benefit";
				$this->data['getBenefit']           		=   $this->Benefit_m->getById($id);
				$this->data['get_benefit_type']				  = $this->Benefit_type_m->getAll();
				$this->data['content']                      =   $this->load->view('benefit/form_detail',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}
	}
?>