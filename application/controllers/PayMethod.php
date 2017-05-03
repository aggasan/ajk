<?php
	class PayMethod extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->library(['datatables']);
			if(!$this->session->userdata('isLogin')) redirect ('user/login');
			$this->load->model(array(
				'Pay_method_m'
			));
			$this->load->library('form_validation');
		}

		function index(){
			redirect('PayMethod/list_data');
		}

		function list_data(){
			$this->data['getpay_method']    = $this->Pay_method_m->getAll();
			$this->data['datatablesUrl']    = base_url('PayMethod/datatables');
			$this->data['title_1']          = "Master";
			$this->data['title_2']          = "Mekanisme Pembayaran";
			$this->data['content']          = $this->load->view('mekanisme_pembayaran/list',$this->data,TRUE);
			$this->load->view('layout/main',$this->data);
		}

		function datatables()
		{
			if (! $this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
			$this->datatables->select(
				'pay_method.pay_method_id,'.
				'pay_method.pay_method_name,'.
				'pay_method.create_date,'.
				'pay_method.user_inp'
			)
				->order_by('pay_method.pay_method_id', 'DESC')
				->from('pay_method')
				->add_column('action', '<a href="' . base_url() . 'PayMethod/detail/$1" class="btn btn-xs default blue-stripe">Edit</a>', 'pay_method_id')
				->unset_column('pay_method.pay_method_id');

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

				$this->form_validation->set_rules('pay_method_name', 'pay_method_name', 'required');

				if ($this->form_validation->run() == TRUE) {
					$this->Pay_method_m->insert();
					$this->session->set_flashdata('success', 'Data Mekanisme Pembayaran berhasil disimpan');
					redirect('PayMethod/list_data/');
				}
				else{
					$this->session->set_flashdata('error', 'Data Mekanisme Pembayaran harus di isi');
					$this->data['title_1']                        =   "Master";
					$this->data['title_2']                        =   "Tambah Mekanisme Pembayaran";
					$this->data['content']                        =   $this->load->view('mekanisme_pembayaran/form',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			} else {
				$this->data['title_1']                        =   "Master";
				$this->data['title_2']                        =   "Tambah Mekanisme Pembayaran";
				$this->data['content']                        =   $this->load->view('mekanisme_pembayaran/form',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}

		function detail($id){
			if($this->input->post('submit')){
				$result = $this->Pay_method_m->update($id);
				if($result)
				{
					$this->session->set_flashdata('success', 'Data Mekanisme Pembayaran berhasil diupdate');
					redirect('PayMethod/list_data/');
				}
				else
				{
					$this->data['title_1']                      =   "Master";
					$this->data['title_2']                      =   "Edit Mekanisme Pembayaran";
					$this->data['getPeyMethodById']  		    =   $this->Pay_method_m->getById($id);
					$this->data['content']                      =   $this->load->view('mekanisme_pembayaran/form_detail',$this->data,TRUE);
					$this->load->view('layout/main',$this->data);
				}
			}
			else
			{
				$this->data['title_1']                      =   "Master";
				$this->data['title_2']                      =   "Edit Mekanisme Pembayaran";
				$this->data['getPeyMethodById']             =   $this->Pay_method_m->getById($id);
				$this->data['content']                      =   $this->load->view('mekanisme_pembayaran/form_detail',$this->data,TRUE);
				$this->load->view('layout/main',$this->data);
			}
		}
	}
?>