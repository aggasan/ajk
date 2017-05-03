<?php
	class BankCollateral extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'Bank_collateral_type_m'
			));
			$this->load->library('form_validation');
		}

		function index(){
			redirect('BankCollateral/list_data');
		}

		function list_data(){
			$this->data['getbank_collateral_type']     = $this->Bank_collateral_type_m->getAll();
			$this->data['datatablesUrl']    = base_url('BankCollateral/datatables');
			$this->data['title_1']          = "Master";
			$this->data['title_2']          = "Jenis Agunan";
			$this->data['content']          = $this->load->view('agunan/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'bank_collateral_type.bank_collateral_type_id,'.
				'bank_collateral_type.bank_collateral_type_name,'.
				'bank_collateral_type.create_date,'.
				'bank_collateral_type.user_inp'
			)
				->order_by('bank_collateral_type.bank_collateral_type_id', 'DESC')
				->from('bank_collateral_type')
				->add_column('action', '<a href="' . base_url() . 'BankCollateral/detail/$1" class="btn btn-xs default blue-stripe">Edit</a>', 'bank_collateral_type_id')
				->unset_column('bank_collateral_type.bank_collateral_type_id');

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

				$this->form_validation->set_rules('bank_collateral_type_name', 'bank_collateral_type_name', 'required');

				if ($this->form_validation->run() == TRUE) {
					$this->Bank_collateral_type_m->insert();
					$this->session->set_flashdata('success', 'Data Jenis Agunan berhasil disimpan');
					redirect('BankCollateral/list_data/');
				}
				else{
					$this->session->set_flashdata('error', 'Data Jenis Agunan harus di isi');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Jenis Agunan";
					$this->data['content']                        =   $this->load->view('agunan/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			} else {
				$this->data['title_1']                        =   "Master";
				$this->data['title_2']                        =   "Tambah Jenis Agunan";
				$this->data['content']                        =   $this->load->view('agunan/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function detail($id){
			if($this->input->post('submit')){
				$result = $this->Bank_collateral_type_m->update($id);
				if($result)
				{
					$this->session->set_flashdata('success', 'Data Jenis Agunan berhasil diupdate');
					redirect('BankCollateral/list_data/');
				}
				else
				{
					$this->data['title_1']                      =   "Master";
					$this->data['title_2']                      =   "Edit Jenis Agunan";
					$this->data['getCollateralTypeById']        =   $this->Bank_collateral_type_m->getById($id);
					$this->data['content']                      =   $this->load->view('agunan/form_detail',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			}
			else
			{
				$this->data['title_1']                      =   "Master";
				$this->data['title_2']                      =   "Edit Jenis Agunan";
				$this->data['getCollateralTypeById']               	=   $this->Bank_collateral_type_m->getById($id);
				$this->data['content']                      =   $this->load->view('agunan/form_detail',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}
	}
?>