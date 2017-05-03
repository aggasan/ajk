<?php

class Claim extends CI_Controller {
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
            'Claim_m',
            'Claim_type_m',
            'Document_type_m',
            'Document_m',
            'Claim_note_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function list_data(){
        $this->data['datatablesUrl_proccess']  = base_url('claim/datatables_list/15');
        $this->data['datatablesUrl_accept'] = base_url('claim/datatables_list/12');
        $this->data['datatablesUrl_reject'] = base_url('claim/datatables_list/13');
        $this->data['title_1']              = "List Data";
        $this->data['title_2']              = "Pengajuan Klaim";
        $this->data['content']              = $this->load->view('claim/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables_list($rowstate){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $this->datatables->select(
                'claim.claim_id,'.
                'debitur.bank_id,'.
                'bank.bank_name,'.
                'debitur.debitur_name,'.
                'debitur.period_start,'.
                'debitur.period_end,'.
                'debitur.certificate_number,'.
                'debitur.sum_insured,'.
                'claim.insident_date,'.
                'claim.claim_reason,'.
                'claim.sum_insured_proposed,'.
                'claim.create_date,'.
                'rowstate.rowstate_name,'.
                'debitur.user_inp'
                )
            ->order_by('claim.claim_id', 'DESC')
            ->from('claim')
            ->join('debitur','claim.debitur_id = debitur.debitur_id')
            ->join('bank','bank.bank_id = debitur.bank_id')
            ->join('rowstate','rowstate.rowstate = claim.rowstate')
            ->where('claim.rowstate', $rowstate)
            ->add_column('action', '<a href="' . base_url() . 'claim/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'claim_id')
            ->unset_column('claim.claim_id');

            if($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;
        foreach ($result->data as $k => $v) {
            $get_product = $this->Product_m->getByBankId($v[1]);
            $resultArray[] = [
                form_radio('claim_id', $v[0]),
                $rowIndex,
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[4])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[5])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'. '.number_format($v[7]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[8])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[9], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'. '.number_format($v[10]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[11])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[12], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[13], ENT_QUOTES, 'UTF-8'),
                $v[14]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function list_data_pay(){
        $this->data['datatablesUrl_not_pay']    = base_url('claim/datatables_pay/13');
        $this->data['datatablesUrl_is_pay']     = base_url('claim/datatables_pay/14');
        $this->data['title_1']                  = "List Data";
        $this->data['title_2']                  = "Pembayaran Klaim";
        $this->data['content']                  = $this->load->view('claim/list_pay',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables_pay($rowstate){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $this->datatables->select(
                'claim.claim_id,'.
                'debitur.bank_id,'.
                'bank.bank_name,'.
                'debitur.debitur_name,'.
                'debitur.period_start,'.
                'debitur.period_end,'.
                'debitur.certificate_number,'.
                'debitur.sum_insured,'.
                'claim.insident_date,'.
                'claim.claim_reason,'.
                'claim.sum_insured_proposed,'.
                'claim.create_date,'.
                'rowstate.rowstate_name,'.
                'debitur.user_inp'
                )
            ->order_by('claim.claim_id', 'DESC')
            ->from('claim')
            ->join('debitur','claim.debitur_id = debitur.debitur_id')
            ->join('bank','bank.bank_id = debitur.bank_id')
            ->join('rowstate','rowstate.rowstate = claim.rowstate')
            ->where('claim.rowstate', $rowstate)
            ->add_column('action', '<a href="' . base_url() . 'claim/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'claim_id')
            ->unset_column('claim.claim_id');

            if($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;
        foreach ($result->data as $k => $v) {
            $get_product = $this->Product_m->getByBankId($v[1]);
            $resultArray[] = [
                form_radio('claim_id', $v[0]),
                $rowIndex,
                htmlspecialchars($v[2], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[4])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[5])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'. '.number_format($v[7]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[8])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[9], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($get_product->currency_id.'. '.number_format($v[10]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[11])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[12], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[13], ENT_QUOTES, 'UTF-8'),
                $v[14]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function list_data_search(){
        $this->data['datatablesUrl_false']  = base_url('claim/datatables/0');
        $this->data['datatablesUrl_true']   = base_url('claim/datatables/1');
        $this->data['title_1']              = "Transaksi";
        $this->data['title_2']              = "Input Klaim";
        $this->data['content']              = $this->load->view('claim/list_search',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables($flag_claim = ''){
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
            ->where('debitur.flag_claim', $flag_claim)
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
            $this->Claim_m->insert();
            $this->session->set_flashdata('success', 'Pemberitahuan klaim berhasil diinput.');
            redirect('claim/list_data_search#tab_0');
        } else if($this->input->post('claim')){
            $debitur_id = $this->input->post('debitur_id');
            if(!$debitur_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debitur.');
                redirect('claim/list_data_search#tab_0');
            } else {
                $this->data['title_1']                      = "Transaksi";
                $this->data['title_2']                      = "Input Klaim";
                $this->data['get_debitur']                  = $get_debitur = $this->Debitur_m->getById($debitur_id);
                $this->data['val_product']                  = $this->Product_m->getByBankId($get_debitur->bank_id);
                $this->data['get_claim_type']               = $this->Claim_type_m->getAll();
                $this->data['content']                      = $this->load->view('claim/form',$this->data,TRUE);
                $this->load->view('layout/main',$this->data);
            }
        } else {
            redirect('claim/list_data_search#tab_0');
        }
    }

    public function detail($claim_id){
        $this->data['title_1']                      =   "Transaksi";
        $this->data['title_2']                      =   "Detail Klaim";
        $this->data['get_claim']                    =   $get_claim = $this->Claim_m->getById($claim_id);
        $this->data['datatablesUrl_DocClaim']       =   base_url('claim/datatables_document/'.$get_claim->claim_id.'/claim');
        $this->data['get_product']                  =   $this->Product_m->getByBankId($get_claim->bank_id);
        $this->data['get_claim_note']               =   $this->Claim_note_m->getByClaimId($claim_id);
        $this->data['content']                      =   $this->load->view('claim/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA DOCUMENT
    public function datatables_document($claim_id = '', $flag_doc = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'document_claim.document_id,'.
                'document_type.document_type_name,'.
                'document_claim.document_name,'.
                'document_claim.up_file,'.
                'document_claim.information,'.
                'document_claim.create_date,'.
                'document_claim.user_inp'
                )
            ->order_by('document_claim.document_id', 'DESC')
            ->from('document_claim')
            ->join('document_type','document_type.document_type_id = document_claim.document_type_id')
            ->where('document_claim.claim_id', $claim_id)
            ->where('document_type.flag_doc',$flag_doc)
            ->add_column('action', '<a href="' . base_url() . 'claim/download_document/'.$flag_doc.'/$1" class="btn btn-xs default blue-stripe">Download</a>', 'document_id')
            ->unset_column('document_claim.document_id');

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
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[5])), ENT_QUOTES, 'UTF-8'),
                $v[7]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function upload_doc_claim($claim_id){
        $this->data['title_1']              = "Transaksi Bisnis";
        $this->data['title_2']              = "Dokumen Klaim";
        $this->data['get_claim']            = $get_claim = $this->Claim_m->getById($claim_id);
        $this->data['title_form']           = "Form Upload Dokumen Klaim - ".$get_claim->policy_id." - ".$get_claim->debitur_name;
        $this->data['get_document_type']    = $this->Document_type_m->get('claim');
        $this->data['flag_url']             = "claim/do_upload_doc_claim";
        $this->data['flag_url_back']        = 'claim/detail/'.$claim_id.'#tab_1';
        $this->data['content']              = $this->load->view('document/form_upload_claim',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }
    
    public function do_upload_doc_claim(){
        $config['upload_path']          = './file_upload/claim/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        
        $this->load->library('upload', $config);

        $claim_id = $this->input->post('claim_id');

        if (!$this->upload->do_upload('up_file')){  
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
            redirect('claim/upload_doc_claim/'.$claim_id);   
        } else {
            $upload_data = $this->upload->data();

            $file = $upload_data['file_name'];
            $path = './file_upload/claim/' . $file;
            $this->Document_m->insert_claim($file);
            $this->session->set_flashdata('success', 'Dokumen Klaim berhasil di upload.');
            redirect('claim/detail/'.$claim_id.'#tab_1');   
        } 
    }
    // END UPLOAD DOC
    public function download_document($flag_doc, $document_id){
        $this->load->helper('download');
        $get_doc = $this->Document_m->get_claim($document_id);
        $data = file_get_contents("file_upload/".$flag_doc."/".$get_doc->up_file); // Read the file's contents
        echo $name = $get_doc->up_file;
        force_download($name, $data); 
    }

    public function add_note($claim_id){
        $note = $this->input->post('note');
        $this->Claim_note_m->insert($claim_id, $note);
        $this->session->set_flashdata('success', 'Catatan berhasil diinput.');
        redirect('claim/detail/'.$claim_id.'#tab_2');
    }
}