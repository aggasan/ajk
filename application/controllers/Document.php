<?php 

class Document extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Debitur_m',
            'Document_m',
            'Product_m',
            'Certificate_template_m'
            ));
    }

    public function index(){
        redirect('list_data');
    }

    public function list_data($flag_upload_certificate){
        $this->data['datatablesUrl']        = base_url('document/datatables/'.$flag_upload_certificate);
        $this->data['title_1']              = "Transaksi";
        $this->data['title_2']              = "Dokumen dan Surat";
        $this->data['content']              = $this->load->view('document/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables($flag_upload_certificate){
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
            ->where('debitur.flag_upload_certificate', $flag_upload_certificate)
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
                htmlspecialchars($v[9].' '.$v[20], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[10])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[11])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[21].'.'.number_format($v[12]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[13], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[21].'.'.number_format($v[14]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[15], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[16])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[17], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[18], ENT_QUOTES, 'UTF-8'),
                $v[22]
            ];
            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function list_data_print($flag_print_certificate){
        $this->data['datatablesUrl']        = base_url('document/datatables_print/'.$flag_print_certificate);
        $this->data['title_1']              = "List Data";
        $this->data['title_2']              = "Cetak Dokumen dan Surat";
        $this->data['content']              = $this->load->view('document/list_print',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables_print($flag_print_certificate){
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
            ->where('debitur.flag_print_certificate', $flag_print_certificate)
            // LIPPO
            // ->where('debitur.flag_upload_certificate', 1)
            // END LIPPO
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
                htmlspecialchars($v[9].' '.$v[20], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[10])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[11])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[21].'.'.number_format($v[12]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[13], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[21].'.'.number_format($v[14]), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[15], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y H:i:s', strtotime($v[16])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[17], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[18], ENT_QUOTES, 'UTF-8'),
                $v[22]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function generate_certificate(){
        $debitur_id = $this->input->post('debitur_id');
        if($this->input->post('download')){
            if(!$debitur_id){
                $this->session->set_flashdata('error', 'Pilih salah satu debitur.');
                redirect('document/list_data/1#tab_0');
            } else {
                $this->data['get_debitur'] = $get_debitur = $this->Debitur_m->getById($debitur_id);
                $this->data['get_certificate_template'] = $this->Certificate_template_m->get_by_policy_id($get_debitur->policy_id);
                $size='a4'; 
                $orient='potrait';
                $filename  = 'sertifikat_.pdf';
                $this->load->library('dompdf_lib'); 
                $file_pdf = $this->load->view('document/pdf/certificate',$this->data ,TRUE);//Save as variable
                $this->dompdf_lib->convert_html_to_pdf($file_pdf, $size, $orient, $filename, $stream = TRUE);
            }   
        }
    }
}