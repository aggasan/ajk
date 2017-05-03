<?php

class Refund extends CI_Controller {
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
            'Bank_account_m',
            'Refund_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function list_data_search(){
        $this->data['datatablesUrl_false']  = base_url('refund/datatables/0');
        $this->data['datatablesUrl_true']   = base_url('refund/datatables/1');
        $this->data['title_1']              = "Transaksi";
        $this->data['title_2']              = "Input Pelunasan";
        $this->data['content']              = $this->load->view('refund/list_search',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables($flag_refund = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $this->datatables->select(
                'debitur.debitur_id,'.
                'debitur.bank_id,'.
                'product.plan_id,'.
                'bank.bank_name,'.
                'debitur.debitur_name,'.
                'product.product_name,'.
                'debitur.policy_id,'.
                'debitur.certificate_number,'.
                'debitur.age,'.
                'debitur.period,'.
                'debitur.period_start,'.
                'debitur.period_end,'.
                'debitur.sum_insured,'.
                'debitur.rate,'.
                'debitur.premi,'.
                'debitur.premi_emep,'.
                'debitur.underwriting_type,'.
                'debitur.create_date,'.
                'rowstate.rowstate_name,'.
                'debitur.user_inp,'.
                'debitur.product_id,'.
                'product.term_loan_type_id,'.
                'product.currency_id'
                )
            ->order_by('debitur.debitur_id', 'DESC')
            ->from('debitur')
            ->join('bank','bank.bank_id = debitur.bank_id')
            ->join('rowstate','rowstate.rowstate = debitur.rowstate')
            ->join('product','product.product_id = debitur.product_id')
            ->where('debitur.rowstate', 6)
            ->where('debitur.flag_refund', $flag_refund)
            ->add_column('action', '<a href="' . base_url() . 'debitur/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debitur_id')
            ->unset_column('debitur.debitur_id');

            if($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;
        foreach ($result->data as $k => $v) {
            $resultArray[] = [
                form_radio('debitur_id', $v[0]),
                $rowIndex,
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[7], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[8].' Tahun', ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[9].' '.$v[21], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[10])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[11])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[22].'. '.number_format($v[12]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[13], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[22].'.'.number_format($v[14]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[22].'.'.number_format($v[15]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[16], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[17])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[18], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[19], ENT_QUOTES, 'UTF-8'),
                $v[23]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function add(){
        if($this->input->post('submit')){
            $this->Refund_m->insert();
            $this->session->set_flashdata('success', 'Pelunasan berhasil diinput.');
            redirect('refund/list_data_search#tab_0');
        } else if($this->input->post('pay')){
            $debitur_id = $this->input->post('debitur_id');
            if(!$debitur_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debitur.');
                redirect('refund/list_data_search#tab_0');
            } else {
                $this->data['title_1']                      = "Transaksi";
                $this->data['title_2']                      = "Input Pelunasan";
                $this->data['get_debitur']                  = $get_debitur = $this->Debitur_m->getById($debitur_id);
                // $this->data['get_bank']                     = $this->Bank_m->getById($get_debitur->bank_id);
                $this->data['val_product']                  = $this->Product_m->getByBankId($get_debitur->bank_id);
                $this->data['content']                      = $this->load->view('refund/form',$this->data,TRUE);
                $this->load->view('layout/main',$this->data);
            }
        } else {
            redirect('refund/list_data_search#tab_0');
        }
    }
}