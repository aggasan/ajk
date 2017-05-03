<?php

class Debitur extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Debitur_m',
            'Product_m',
            'Business_field_m',
            'Job_m',
            'Gender_m',
            'Mariage_status_m',
            'Identity_type_m',
            'City_m',
            'Product_insurance_type_m',
            'Benefit_type_m',
            'Benefit_product_m',
            'Debitur_premi_m',
            'Healt_m',
            'Document_type_m',
            'Document_m',
            'Emep_m',
            'Debitur_note_m',
            'Policy_m',
            'Debitur_note_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function add(){

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $bank_id = $this->session->userdata('bank_id');
        $this->data['val_product']                    = $val_product = $this->Product_m->getByBankId($bank_id);

        $this->form_validation->set_rules('debitur_name', 'Nama Debitur', 'trim|required');
        $this->form_validation->set_rules('no_akad', 'Nomor Akad', 'trim');
        $this->form_validation->set_rules('datebirth', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('birth_place', 'Tempat Lahir', 'trim');
        $this->form_validation->set_rules('identity_type_id', 'Jenis Identitas', 'trim|required');
        $this->form_validation->set_rules('no_id', 'Nomor Identitas', 'trim|required');
        $this->form_validation->set_rules('gender_id', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('job_id', 'Pekerjaan', 'trim');
        $this->form_validation->set_rules('job_detail', 'Detail Pekerjaan', 'trim');
        $this->form_validation->set_rules('address', 'Alamat', 'trim');
        $this->form_validation->set_rules('city_id', 'Kota', 'trim');
        $this->form_validation->set_rules('handphone', 'Nomor Hanphone', 'trim');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('product_id', 'Produk', 'trim|required');
        $this->form_validation->set_rules('sum_insured', 'Uang Pertanggungan', 'trim|required|less_than_equal_to['.$val_product->max_sum_insured.']|greater_than_equal_to['.$val_product->min_sum_insured.']');
        $this->form_validation->set_rules('period_start', 'Mulai Asuransi', 'trim|required');
        $this->form_validation->set_rules('period', 'Periode', 'trim|required|less_than_equal_to['.$val_product->term_loan_val.']');
        $this->form_validation->set_rules('company_name', 'Nama Instansi/Perusahaan', 'trim');
        $this->form_validation->set_rules('business_field_id', 'Jenis Bidang Usaha', 'trim');
        $this->form_validation->set_rules('position', 'Jabatan', 'trim');
        $this->form_validation->set_rules('company_address', 'Alamat Tempat Bekerja', 'trim');

        if ($this->form_validation->run()){
            $this->Debitur_m->insert();
            $this->session->set_flashdata('success', 'Debitur berhasil disimpan');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id'));   
        }

        $this->data['title_1']                        = "Transaksi";
        $this->data['title_2']                        = "Input Debitur";
        $this->data['header_form']                    = "Form Input Pengajuan";             
        $this->data['button_form']                    = "Simpan";
        
        $this->data['getBusinessField']               = $this->Business_field_m->getAll();
        $this->data['getJob']                         = $this->Job_m->getAll();
        $this->data['getMariageStatus']               = $this->Mariage_status_m->getAll();
        $this->data['getGender']                      = $this->Gender_m->getAll();
        $this->data['getIdentityType']                = $this->Identity_type_m->getAll();
        $this->data['getPolicy']                      = $this->Policy_m->get_by_bank_id($bank_id);
        $this->data['getBenefitType']                 = $this->Benefit_type_m->getAll();
        $this->data['content']                        = $this->load->view('debitur/form_new',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function edit($debitur_id){

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $bank_id = $this->session->userdata('bank_id');
        $this->data['val_product']                    = $val_product = $this->Product_m->getByBankId($bank_id);

        $this->form_validation->set_rules('debitur_name', 'Nama Debitur', 'trim|required');
        $this->form_validation->set_rules('no_akad', 'Nomor Akad', 'trim');
        $this->form_validation->set_rules('datebirth', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('birth_place', 'Tempat Lahir', 'trim');
        $this->form_validation->set_rules('identity_type_id', 'Jenis Identitas', 'trim|required');
        $this->form_validation->set_rules('no_id', 'Nomor Identitas', 'trim|required');
        $this->form_validation->set_rules('gender_id', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('job_id', 'Pekerjaan', 'trim');
        $this->form_validation->set_rules('job_detail', 'Detail Pekerjaan', 'trim');
        $this->form_validation->set_rules('address', 'Alamat', 'trim');
        $this->form_validation->set_rules('city_id', 'Kota', 'trim');
        $this->form_validation->set_rules('handphone', 'Nomor Hanphone', 'trim');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('product_id', 'Produk', 'trim|required');
        $this->form_validation->set_rules('sum_insured', 'Uang Pertanggungan', 'trim|required|less_than_equal_to['.$val_product->max_sum_insured.']|greater_than_equal_to['.$val_product->min_sum_insured.']');
        $this->form_validation->set_rules('period_start', 'Mulai Asuransi', 'trim|required');
        $this->form_validation->set_rules('period', 'Periode', 'trim|required|less_than_equal_to['.$val_product->term_loan_val.']');
        $this->form_validation->set_rules('company_name', 'Nama Instansi/Perusahaan', 'trim');
        $this->form_validation->set_rules('business_field_id', 'Jenis Bidang Usaha', 'trim');
        $this->form_validation->set_rules('position', 'Jabatan', 'trim');
        $this->form_validation->set_rules('company_address', 'Alamat Tempat Bekerja', 'trim');

        if ($this->form_validation->run()){
            $this->Debitur_m->update($debitur_id);
            $this->session->set_flashdata('success', 'Debitur berhasil diupdate');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id'));   
        }

        $this->data['title_1']                        = "Transaksi";
        $this->data['title_2']                        = "Edit Debitur";
        $this->data['header_form']                    = "Form Edit Pengajuan";             
        $this->data['button_form']                    = "Edit";   
        $this->data['get_debitur']                    = $this->Debitur_m->getById($debitur_id);  
        $this->data['val_product']                    = $this->Product_m->getByBankId($bank_id);
        $this->data['getBusinessField']               = $this->Business_field_m->getAll();
        $this->data['getJob']                         = $this->Job_m->getAll();
        $this->data['getMariageStatus']               = $this->Mariage_status_m->getAll();
        $this->data['getGender']                      = $this->Gender_m->getAll();
        $this->data['getIdentityType']                = $this->Identity_type_m->getAll();
        $this->data['getPolicy']                      = $this->Policy_m->get_by_bank_id($bank_id);
        $this->data['getBenefitType']                 = $this->Benefit_type_m->getAll();
        $this->data['content']                        = $this->load->view('debitur/form_new',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function count_premi($debitur_id){
        $this->Debitur_m->count_premi($debitur_id);
        redirect('debitur/detail/'.$debitur_id.'#tab_0'); 
    }

    public function confirm($debitur_id){
        $this->Debitur_m->confirm($debitur_id);
        redirect('debitur/detail/'.$debitur_id.'#tab_0');         
    }

    public function acceptance($debitur_id, $rowstate){
        $this->Debitur_m->acceptance($debitur_id, $rowstate);
        redirect('debitur/detail/'.$debitur_id.'#tab_0');         
    }

    public function add_healt(){
        if ($this->input->post('submit')){
            $this->Healt_m->insert();
            // ADD HISTORY DEBITUR
            $note = 'Data kesehatan debitur diinput.';
            $this->Debitur_note_m->insert($this->input->post('debitur_id'), $note);
            // END ADD HISTORY DEBITUR     
            $this->session->set_flashdata('success', 'Data kesehatan berhasil disimpan');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id').'#tab_1');   
        } else {
            $this->session->set_flashdata('error', 'Data kesehatan gagal disimpan');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id').'#tab_1');  
        }
    }

    public function add_emep(){
        if ($this->input->post('submit')){
            $this->Emep_m->insert();
            // ADD HISTORY DEBITUR
            $note = 'Debitur dikenakan EM/EP.';
            $this->Debitur_note_m->insert($this->input->post('debitur_id'), $note);
            // END ADD HISTORY DEBITUR     
            $this->session->set_flashdata('success', 'EM / EP berhasil diproses');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id').'#tab_3');   
        } else {
            $this->session->set_flashdata('error', 'EM / EP gagal diproses');
            redirect('debitur/detail/'.$this->session->userdata('ses_debitur_id').'#tab_3');  
        }
    }

    public function detail($debitur_id){
        $this->data['title_1']                      =   "Transaksi";
        $this->data['title_2']                      =   "Detail Debitur";
        $this->data['datatablesUrl_FPAJ']           =   base_url('debitur/datatables_document/'.$debitur_id.'/fpaj');
        $this->data['datatablesUrl_Medis']          =   base_url('debitur/datatables_document/'.$debitur_id.'/medis');
        $this->data['datatablesUrl_EMEP']           =   base_url('debitur/datatables_document/'.$debitur_id.'/emep');
        $this->data['getDebitur']                   =   $getDebitur = $this->Debitur_m->getById($debitur_id);
        $this->data['getHealt']                     =   $getHealt = $this->Healt_m->getByDebiturId($debitur_id);
        $this->data['getDocSPAJ']                   =   $get_doc_fpaj = $this->Document_m->get_document_type($debitur_id,1);
        $this->data['get_debitur_note']             =   $this->Debitur_note_m->get_by_debitur_id($debitur_id);
        $this->data['getEmep']                      =   $this->Emep_m->getByDebiturId($debitur_id);
        $this->data['get_product']                  =   $this->Product_m->getByBankId($getDebitur->bank_id);

        if($getDebitur->underwriting == 'NM' OR $getDebitur->underwriting == 'M'){
            $warning = array();
            if(!$getHealt){
                $warning[] = 'Hasil data kesehatan belum diinput.';
            }

            if(!$get_doc_fpaj){
                $warning[] = 'Dokumen SPAJK belum diupload.';
            }
            $this->session->set_flashdata('warning', $warning);
        }
        
        $this->data['content']                      =   $this->load->view('debitur/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }
    
    public function list_data(){
        $this->data['datatablesUrl']        = base_url('debitur/datatables');
        $this->data['title_1']              ="Transaksi";
        $this->data['title_2']              ="List Pengajuan";
        $this->data['content']              = $this->load->view('debitur/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables(){
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
            // EQUITY
            ->where('debitur.rowstate != 6')->where('debitur.rowstate != 5')
            // LIPPO
            // ->where('debitur.flag_upload_certificate = 0')
            ->add_column('action', '<a href="' . base_url() . 'debitur/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debitur_id')
            ->unset_column('debitur.debitur_id');

            if($this->session->userdata('user_entity') == 2){
                $this->datatables->where('debitur.confirm_checker = 1');   
            } elseif($this->session->userdata('user_entity') == 4){
                $this->datatables->where('debitur.confirm_bank = 1');
            } elseif($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;
        foreach ($result->data as $k => $v) {
            $resultArray[] = [
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
    // DATATABLES LIST DATA UNDERWRITING
    public function datatables_document($debitur_id = '', $flag_doc = ''){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'document.document_id,'.
                'document_type.document_type_name,'.
                'document.document_name,'.
                'document.up_file,'.
                'document.information,'.
                'document.create_date,'.
                'document.user_inp'
                )
            ->order_by('document.document_id', 'DESC')
            ->from('document')
            ->join('document_type','document_type.document_type_id = document.document_type_id')
            ->where('document.debitur_id', $debitur_id)
            ->where('document_type.flag_doc',$flag_doc)
            ->add_column('action', '<a href="' . base_url() . 'debitur/download_document/'.$flag_doc.'/$1" class="btn btn-xs default blue-stripe">Download</a>', 'document_id')
            ->unset_column('document.document_id');

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
    // END DATATABLES UNDERWRITING

    public function list_underwriting(){
        $this->data['datatablesUrl_FCL']    = base_url('debitur/datatables_underwriting/FCL');
        $this->data['datatablesUrl_NM']     = base_url('debitur/datatables_underwriting/NM');
        $this->data['datatablesUrl_M']      = base_url('debitur/datatables_underwriting/M');
        $this->data['title_1']              = "List Data";
        $this->data['title_2']              = "Underwriting";
        $this->data['content']              = $this->load->view('debitur/list_underwriting',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA UNDERWRITING
    public function datatables_underwriting($underwriting = ''){
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
            ->where('debitur.underwriting',$underwriting)
            ->add_column('action', '<a href="' . base_url() . 'debitur/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debitur_id')
            ->unset_column('debitur.debitur_id');

            if($this->session->userdata('user_entity') == 2){
                $this->datatables->where('debitur.confirm_checker = 1');   
            } elseif($this->session->userdata('user_entity') == 4){
                $this->datatables->where('debitur.confirm_bank = 1');
            } elseif($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $resultArray[] = [
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
    // END DATATABLES UNDERWRITING

    public function list_akseptasi(){
        $this->data['datatablesUrl_akseptasi_true']         = base_url('debitur/datatables_akseptasi/6');
        $this->data['datatablesUrl_akseptasi_false']        = base_url('debitur/datatables_akseptasi/7');
        $this->data['title_1']              = "List Data";
        $this->data['title_2']              = "Aksepasi";
        $this->data['content']              = $this->load->view('debitur/list_akseptasi',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA AKSEPTASI
    public function datatables_akseptasi($rowstate = ''){
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
            ->where('debitur.rowstate',$rowstate)
            ->add_column('action', '<a href="' . base_url() . 'debitur/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'debitur_id')
            ->unset_column('debitur.debitur_id');
            if($this->session->userdata('user_entity') == 2){
                $this->datatables->where('debitur.confirm_checker = 1');   
            } elseif($this->session->userdata('user_entity') == 4){
                $this->datatables->where('debitur.confirm_bank = 1');
            } elseif($this->session->userdata('user_entity') == 3){
                $this->datatables->where('debitur.bank_id',$this->session->userdata('bank_id'));
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $resultArray[] = [
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
    // UPLOAD DOC SPAJ
    public function upload_doc_fpaj($debitur_id){
        $this->data['title_1']              = "Transaksi Bisnis";
        $this->data['title_2']              = "Dokumen SPAJK";
        $this->data['getDebitur']           = $getDebitur = $this->Debitur_m->getById($debitur_id);
        $this->data['title_form']           = "Form Upload Dokumen SPAJK - ".$getDebitur->policy_id." - ".$getDebitur->debitur_name;
        $this->data['get_document_type']    = $this->Document_type_m->get('fpaj');
        $this->data['flag_url']             = "debitur/do_upload_doc_fpaj";
        $this->data['flag_url_back']        = 'debitur/detail/'.$debitur_id.'#tab_1';
        $this->data['content']              = $this->load->view('document/form_upload',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }
    
    public function do_upload_doc_fpaj(){
        $config['upload_path']          = './file_upload/fpaj/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        
        $this->load->library('upload', $config);

        $debitur_id = $this->input->post('debitur_id');

        if (!$this->upload->do_upload('up_file')){  
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
            redirect('debitur/upload_doc_fpaj/'.$debitur_id);   
        } else {
            $upload_data = $this->upload->data();

            $file = $upload_data['file_name'];
            $path = './file_upload/fpaj/' . $file;
            $this->Document_m->insert($file);
            // ADD HISTORY DEBITUR
            $note = 'Dokumen SPAJK diupload.';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR     
            $this->session->set_flashdata('success', 'Dokumen SPAJK berhasil di upload.');
            redirect('debitur/detail/'.$debitur_id.'#tab_1');   
        } 
    }
    // END UPLOAD SPAJ
    // UPLOAD DOC MEDIS
    public function upload_doc_medis($debitur_id){
        $this->data['title_1']              = "Transaksi Bisnis";
        $this->data['title_2']              = "Dokumen Medis";
        $this->data['getDebitur']           = $getDebitur = $this->Debitur_m->getById($debitur_id);
        $this->data['title_form']           = "Form Upload Dokumen Medis - ".$getDebitur->policy_id." - ".$getDebitur->debitur_name;
        $this->data['get_document_type']    = $this->Document_type_m->get('medis');
        $this->data['flag_url']             = "debitur/do_upload_doc_medis";
        $this->data['flag_url_back']        = 'debitur/detail/'.$debitur_id.'#tab_2';
        $this->data['content']              = $this->load->view('document/form_upload',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function do_upload_doc_medis(){
        $config['upload_path']          = './file_upload/medis/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        
        $this->load->library('upload', $config);

        $debitur_id = $this->input->post('debitur_id');

        if (!$this->upload->do_upload('up_file')){  
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
            redirect('debitur/upload_doc_medis/'.$debitur_id);   
        } else {
            $upload_data = $this->upload->data();

            $file = $upload_data['file_name'];
            $path = './file_upload/medis/' . $file;
            $this->Document_m->insert($file);
            $note = 'Dokumen medis/tambahan sudah diupload';
            $this->Debitur_note_m->insert($debitur_id, $note);
            $this->session->set_flashdata('success', 'Dokumen Medis berhasil di upload.');
            redirect('debitur/detail/'.$debitur_id.'#tab_2');   
        } 
    }
    // END UPLOAD MEDIS
    // UPLOAD DOC MEDIS
    public function upload_doc_emep($debitur_id){
        $this->data['title_1']              = "Transaksi Bisnis";
        $this->data['title_2']              = "Dokumen EM/EP";
        $this->data['getDebitur']           = $getDebitur = $this->Debitur_m->getById($debitur_id);
        $this->data['title_form']           = "Form Upload Dokumen EM/EP - ".$getDebitur->policy_id." - ".$getDebitur->debitur_name;
        $this->data['get_document_type']    = $this->Document_type_m->get('emep');
        $this->data['flag_url']             = "debitur/do_upload_doc_emep";
        $this->data['flag_url_back']        = 'debitur/detail/'.$debitur_id.'#tab_3';
        $this->data['content']              = $this->load->view('document/form_upload',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }
    
    public function do_upload_doc_emep(){
        $config['upload_path']          = './file_upload/emep/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        
        $this->load->library('upload', $config);

        $debitur_id = $this->input->post('debitur_id');

        if (!$this->upload->do_upload('up_file')){  
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
            redirect('debitur/upload_doc_emep/'.$debitur_id);   
        } else {
            $upload_data = $this->upload->data();

            $file = $upload_data['file_name'];
            $path = './file_upload/emep/' . $file;
            $this->Document_m->insert($file);
            // ADD HISTORY DEBITUR
            $note = 'Dokumen EM/EP diupload.';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR     
            $this->session->set_flashdata('success', 'Dokumen EM/EP berhasil di upload.');
            redirect('debitur/detail/'.$debitur_id.'#tab_3');   
        } 
    }
    // END UPLOAD MEDIS
    // UPLOAD DOCUMENT CERTIFICATE
    public function upload_doc_certificate(){
        $debitur_id = $this->input->post('debitur_id');
        if($this->input->post('upload')){
            if(!$debitur_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debitur.');
                redirect('document/list_data/0#tab_0');
            } else {
                $this->data['title_1']              = "Transaksi Bisnis";
                $this->data['title_2']              = "Dokumen Sertifikat";
                $this->data['getDebitur']           = $getDebitur = $this->Debitur_m->getById($debitur_id);
                $this->data['title_form']           = "Form Upload Sertifikat - ".$getDebitur->policy_id." - ".$getDebitur->debitur_name;
                $this->data['get_document_type']    = $this->Document_type_m->get('certificate');
                $this->data['flag_url']             = "debitur/do_upload_doc_certificate";
                $this->data['content']              = $this->load->view('document/form_upload_certificate',$this->data,TRUE);
                $this->load->view('layout/main',$this->data);
            }
        } else if($this->input->post('download')){
            if(!$debitur_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debitur.');
                redirect('document/list_data/1#tab_0');
            } else {
                $val_document = $this->Document_m->get_document_type($debitur_id, 8);
                $this->Debitur_m->update_flag_sertificate_download($debitur_id);
                $this->download_document('certificate', $val_document->document_id);
            }
            
        }
    }

    public function do_upload_doc_certificate(){
        $config['upload_path']          = './file_upload/certificate/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2048;
        
        $this->load->library('upload', $config);

        $debitur_id = $this->input->post('debitur_id');

        if (!$this->upload->do_upload('up_file')){  
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error',$error['error']);
            redirect('document/list_data/'.$debitur_id);   
        } else {
            $upload_data = $this->upload->data();

            $file = $upload_data['file_name'];
            $path = './file_upload/certificate/' . $file;
            $this->Document_m->insert($file);
            $this->Debitur_m->update_flag_sertificate_upload($debitur_id);// ADD HISTORY DEBITUR
            $note = 'Dokumen sertifikat diupload.';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR     
            $this->session->set_flashdata('success', 'Dokumen Sertifikat berhasil di upload.');
            redirect('document/list_data/0#tab_0');   
        } 
    }
    // END UPLOAD DOCUMENT CERTIFICATE

    public function download_document($flag_doc, $document_id){
        $this->load->helper('download');
        $get_doc = $this->Document_m->get($document_id);
        $data = file_get_contents("file_upload/".$flag_doc."/".$get_doc->up_file); // Read the file's contents
        echo $name = $get_doc->up_file;
        force_download($name, $data); 
    }

    public function add_note($debitur_id){
        $note = $this->input->post('note');
        $this->Debitur_note_m->insert($debitur_id, $note);
        $this->session->set_flashdata('success', 'Catatan berhasil diinput.');
        redirect('debitur/detail/'.$claim_id.'#tab_4');
    }
}