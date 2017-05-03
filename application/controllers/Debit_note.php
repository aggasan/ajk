<?php

class Debit_note extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Debitur_m',
            'Product_m',
            'Debit_note_m',
            'Credit_note_m',
            'Invoice_detail_m',
            'Bank_m',
            'Pay_method_m',
            'Bank_account_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function pay_confirm(){
        if($this->input->post('submit')){
            $this->Debit_note_m->pay_confirm();
            $this->session->set_flashdata('success', 'Konfirmasi pembayaran berhasil.');
            redirect('debit_note/list_data#tab_1');
        } else if($this->input->post('pay')){

            $debit_note_id = $this->input->post('debit_note_id');
            if(!$debit_note_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debit note.');
                redirect('debit_note/list_data');
            } else {
                $this->data['title_1']                      = "Keuangan";
                $this->data['title_2']                      = "Konfirmasi Pembayaran";
                $this->data['get_debit_note']               = $get_debit_note = $this->Debit_note_m->get($debit_note_id);
                $this->data['get_bank']                     = $this->Bank_m->getById($get_debit_note->bank_id);
                $this->data['val_product']                  = $this->Product_m->getByBankId($get_debit_note->bank_id);
                $this->data['get_pay_method']               = $this->Pay_method_m->getAll();
                $this->data['get_bank_account']             = $this->Bank_account_m->getAll();
                $this->data['content']                      = $this->load->view('debit_note/form_confirm',$this->data,TRUE);
                $this->load->view('layout/main',$this->data);
            }
        } else {
            redirect('debit_note/list_data');
        }
    }

    public function pay_closing($debit_note_id){
        $this->Debit_note_m->pay_closing($debit_note_id);
        $this->session->set_flashdata('success', 'Closing pembayaran berhasil.');
        redirect('debit_note/list_data');
    }

    public function detail($debit_note_id){
        $this->data['title_1']                      = "Keuangan";
        $this->data['title_2']                      = "Konfirmasi Pembayaran";
        $this->data['get_debit_note']               = $get_debit_note = $this->Debit_note_m->get($debit_note_id);
        $this->data['get_bank']                     = $this->Bank_m->getById($get_debit_note->bank_id);
        $this->data['val_product']                  = $this->Product_m->getByBankId($get_debit_note->bank_id);
        $this->data['get_pay_method']               = $this->Pay_method_m->getAll();
        $this->data['get_bank_account']             = $this->Bank_account_m->getAll();
        $this->data['content']                      = $this->load->view('debit_note/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function list_data(){
        $this->data['datatablesUrl_false']       = base_url('debit_note/datatables/planned');
        $this->data['datatablesUrl_true']        = base_url('debit_note/datatables/confirmed');
        $this->data['datatablesUrl_close']       = base_url('debit_note/datatables/closing');
        $this->data['title_1']              = "Keuangan";
        $this->data['title_2']              = "Debit Note";
        $this->data['content']              = $this->load->view('debit_note/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables($rowstate = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'debit_note.debit_note_id,'.
                'bank.bank_name,'.
                'debit_note.debit_note_number,'.
                'debit_note.premi,'.
                'debit_note.maturity_date,'.
                'debit_note.create_date,'.
                'debit_note.rowstate,'.
                'debit_note.user_inp'
                )
            ->order_by('debit_note.debit_note_id', 'DESC')
            ->from('debit_note')
            ->join('bank','bank.bank_id = debit_note.bank_id')
            ->where('debit_note.rowstate', $rowstate)
            ->add_column('action', '<a href="' . base_url() . 'debit_note/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debit_note_id')
            ->unset_column('debit_note.debit_note_id');
            if($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debit_note.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $get_product = $this->Product_m->getByBankId($v[1]);
            $resultArray[] = [
                form_radio('debit_note_id', $v[0]),
                $rowIndex,
                htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(number_format($v[3]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[4])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[5])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                $v[8]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    // END DATATABLES
}