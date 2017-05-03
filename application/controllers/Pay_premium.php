<?php

class Pay_premium extends CI_Controller {
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
            'Bank_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function detail($debitur_id){
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
        $this->data['datatablesUrl_akseptasi_false']       = base_url('pay_premium/datatables/0');
        $this->data['datatablesUrl_akseptasi_true']        = base_url('pay_premium/datatables/1');
        $this->data['get_bank']             = $this->Bank_m->getAll();
        $this->data['title_1']              = "Keuangan";
        $this->data['title_2']              = "Pembayaran Premi";
        $this->data['content']              = $this->load->view('pay_premium/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA AKSEPTASI
    public function datatables($flag_pay_premium = ''){
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
            ->where('debitur.flag_pay_premium', $flag_pay_premium)
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
                form_checkbox('debitur_id[]', $v[0]),
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
    // END DATATABLES AKSEPTASI
    public function search_debitur(){
        if($this->input->post('submit')){
            $bank_id        = $this->input->post('bank_id');
            $period_start   = date('Y-m-d', strtotime($this->input->post('period_start')));
            $period_end     = date('Y-m-d', strtotime($this->input->post('period_end')));

            $this->data['datatablesUrl']       = base_url('pay_premium/datatables_pay_premium_group/'.$bank_id.'/'.$period_start.'/'.$period_end);
            $this->data['val_product']          = $this->Product_m->getByBankId($bank_id);
            $this->data['get_bank']             = $this->Bank_m->getById($bank_id);
            $this->data['get_pay_detail']       = $get_pay_detail = $this->Debitur_m->get_by_acceptance($bank_id, $period_start, $period_end);
            $this->data['period_start']         = $period_start;
            $this->data['period_end']           = $period_end;
            $this->data['title_1']              = "Keuangan";
            $this->data['title_2']              = "Pembayaran Premi Kumpulan";
            if(!$get_pay_detail->debitur_total){
                $this->session->set_flashdata('error', 'Debitur tidak ditemukan.');
                $this->data['flag_generate_button'] = 'disabled=""';
            } else {
                $this->session->set_flashdata('success', 'Ditemukan '.$get_pay_detail->debitur_total.' debitur.');
                $this->data['flag_generate_button'] = '';
            }
            $this->data['content']              = $this->load->view('pay_premium/form_search',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        } else {
            redirect('pay_premium/list_data#tab_1');
        }
    }

    // DATATABLES PAY PREMIUM GROUP
    public function datatables_pay_premium_group($bank_id = '', $period_start = '', $period_end = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'debitur.debitur_id,'.
                'debitur.bank_id,'.
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
                'debitur.underwriting_type,'.
                'debitur.create_date,'.
                'rowstate.rowstate_name,'.
                'debitur.user_inp'
                )
            ->order_by('debitur.debitur_id', 'DESC')
            ->from('debitur')
            ->join('bank','bank.bank_id = debitur.bank_id')
            ->join('rowstate','rowstate.rowstate = debitur.rowstate')
            ->where('debitur.rowstate', 6)
            ->where('debitur.flag_pay_premium', 0)
            ->where('debitur.bank_id', $bank_id)
            ->where("debitur.acceptance_insurance_date between '$period_start' and '$period_end'")
            // ->add_column('action', '<a href="' . base_url() . 'debitur/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debitur.debitur_id')
            ->unset_column('debitur.debitur_id');
            if($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $get_product = $this->Product_m->getByBankId($v[1]);
            $resultArray[] = [
                // form_checkbox('debitur_id[]', $v[0]),
                $rowIndex,
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[7].' Tahun', ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[8].' '.$get_product->term_loan_type_id, ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[9])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[10])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'.'.number_format($v[11]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[12], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'.'.number_format($v[13]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[14], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[15])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[16], ENT_QUOTES, 'UTF-8'),
                $v[17]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    // END DATATABLES PAY PREMIUM GROUP


    public function generate(){
        $debitur_id_count = $this->input->post('debitur_id');
        foreach ($debitur_id_count as $debitur_id) {
            # code...
            $val_debitur    = $this->Debitur_m->getById($debitur_id);
            $bank_id        = $val_debitur->bank_id;
            $premi          = $val_debitur->premi + $val_debitur->premi_emep;
            $marturity_date = date('Y-m-d', strtotime('+15 days', strtotime(date('Y-m-d'))));

            // INVOICE DETAIL
            $val_invoice_detail     = $this->Invoice_detail_m->last_number();
            $invoice_detail_id      = $val_invoice_detail->invoice_detail_id + 1;
            // END INVOICE DETAIL

            // DEBIT NOTE
            $val_debit_note = $this->Debit_note_m->last_number();
            $debit_note_id  = $val_debit_note->debit_note_id + 1;
            // END DEBIT NOTE ID

            // CREDIT NOTE
            $val_credit_note     = $this->Credit_note_m->last_number();
            $credit_note_id      = $val_credit_note->credit_note_id + 1;
            // END CREDIT NOTE

            // CREDIT DEBIT NOTE NUMBER
            $debit_note_number      = str_pad($debit_note_id,5,0,STR_PAD_LEFT);  
            $credit_note_number     = str_pad($credit_note_id,5,0,STR_PAD_LEFT);  
            // END CREDIT DEBIT NOTE

            // PERIOD 
            $period_start   = date('Y-m-d');
            $period_end     = date('Y-m-d');
            // END PERIOD
            $this->Invoice_detail_m->insert($invoice_detail_id, $debit_note_id, $credit_note_id, $debitur_id, $premi);
            $this->Debit_note_m->insert($debit_note_id, $bank_id, $credit_note_number, $premi, $marturity_date, 1, $period_start, $period_end);
            $this->Credit_note_m->insert($credit_note_id, $bank_id, $credit_note_number, $premi, $marturity_date, 1, $period_start, $period_end);

            // UPDATE FLAG PAY PREMIUM TO DEBITUR
            $debitur_data = array(
                'flag_pay_premium'  => 1
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $debitur_data);
            // END UPDATE FLAG PAY PREMIUM TO DEBITUR
        }   
        $this->session->set_flashdata('success', 'Pembayaran premi berhasil dibuat.');
        redirect('pay_premium/list_data');
    }

    public function generate_group($bank_id , $period_start, $period_end){
        $get_debitur    = $this->Debitur_m->get_acceptance($bank_id, $period_start, $period_end);
        $get_total      = $this->Debitur_m->get_by_acceptance($bank_id, $period_start, $period_end);
        // DEBIT NOTE
        $val_debit_note = $this->Debit_note_m->last_number();
        $debit_note_id  = $val_debit_note->debit_note_id + 1;
        // END DEBIT NOTE ID

        // CREDIT NOTE
        $val_credit_note     = $this->Credit_note_m->last_number();
        $credit_note_id      = $val_credit_note->credit_note_id + 1;
        // END CREDIT NOTE

        // CREDIT DEBIT NOTE NUMBER
        $debit_note_number      = str_pad($debit_note_id,5,0,STR_PAD_LEFT);  
        $credit_note_number     = str_pad($credit_note_id,5,0,STR_PAD_LEFT);  
        // END CREDIT DEBIT NOTE

        foreach ($get_debitur as $debitur) {
            $debitur_id = $debitur->debitur_id;

            $val_debitur    = $this->Debitur_m->getById($debitur_id);
            $bank_id        = $val_debitur->bank_id;
            $premi          = $val_debitur->premi + $val_debitur->premi_emep;
            $marturity_date = date('Y-m-d', strtotime('+15 days', strtotime(date('Y-m-d'))));

            // INVOICE DETAIL
            $val_invoice_detail     = $this->Invoice_detail_m->last_number();
            $invoice_detail_id      = $val_invoice_detail->invoice_detail_id + 1;
            // END INVOICE DETAIL

            $this->Invoice_detail_m->insert($invoice_detail_id, $debit_note_id, $credit_note_id, $debitur_id, $premi);

            // UPDATE FLAG PAY PREMIUM TO DEBITUR
            $debitur_data = array(
                'flag_pay_premium'  => 1
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $debitur_data);
            // END UPDATE FLAG PAY PREMIUM TO DEBITUR
        }
        
        $total_premi = $get_total->premi + $get_total->premi_emep;
        $total_debitur = $get_total->debitur_total;

        $this->Debit_note_m->insert($debit_note_id, $bank_id, $credit_note_number, $total_premi, $marturity_date, $total_debitur, $period_start, $period_end);
        $this->Credit_note_m->insert($credit_note_id, $bank_id, $credit_note_number, $total_premi, $marturity_date, $total_debitur, $period_start, $period_end);

        $this->session->set_flashdata('success', 'Pembayaran premi berhasil dibuat.');
        redirect('pay_premium/list_data#tab_1');
    }
}