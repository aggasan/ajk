<?php

class Credit_note extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Debitur_m',
            'Product_m',
            'Debit_note_m',
            'Credit_note_m',
            'Invoice_detail_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function detail(){
        $this->data['title_1']                      =   "Transaksi";
        $this->data['title_2']                      =   "Detail Debitur";
        $this->data['getDebitur']                   =   $getDebitur = $this->Debitur_m->getById($debitur_id);
        $this->data['getHealt']                     =   $this->Healt_m->getByDebiturId($debitur_id);
        $this->data['getEmep']                      =   $this->Emep_m->getByDebiturId($debitur_id);
        $this->data['get_product']                  =   $this->Product_m->getByBankId($getDebitur->bank_id);
        $this->data['content']                      =   $this->load->view('debitur/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function list_data(){
        $this->data['datatablesUrl_false']          = base_url('debit_note/datatables/planned');
        $this->data['datatablesUrl_true']           = base_url('debit_note/datatables/confirmed');
        $this->data['datatablesUrl_close']          = base_url('debit_note/datatables/closing');
        $this->data['title_1']                      = "Keuangan";
        $this->data['title_2']                      = "Credit Note";
        $this->data['content']                      = $this->load->view('debit_note/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables($rowstate = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'credit_note.debit_note_id,'.
                'bank.bank_name,'.
                'credit_note.debit_note_number,'.
                'credit_note.premi,'.
                'credit_note.maturity_date,'.
                'credit_note.create_date,'.
                'credit_note.rowstate,'.
                'credit_note.user_inp'
                )
            ->order_by('credit_note.credit_note_id', 'DESC')
            ->from('debit_note')
            ->join('bank','bank.bank_id = credit_note.bank_id')
            ->where('credit_note.rowstate', $rowstate)
            ->add_column('action', '<a href="' . base_url() . 'debitr_note/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'credit_note.credit_note_id')
            ->unset_column('credit_note.credit_note_id');

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $get_product = $this->Product_m->getByBankId($v[1]);
            $resultArray[] = [
                form_radio('debitur_id', $v[0]),
                $rowIndex,
                htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(number_format($v[3]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
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