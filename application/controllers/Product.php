<?php 

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
		$this->load->model(array(
            'Product_m',
            'Pay_method_m',
            'Credit_type_m',
            'Currency_m',
            'Distribution_channel_m',
            'Risk_insurance_type_m',
            'Insurance_type_m',
            'Plan_m',
            'Count_age_method_m',
            'Param_publishing_certificate_m',
            'Term_loan_type_m',
            'Pay_premium_type_m',
            'Bank_collateral_type_m',
            'Product_type_m',
            'Benefit_m',
            'Benefit_type_m',
            'Benefit_product_m',
            'Rate_batch_m',
            'Underwriting_batch_m',
            'Refund_formula_m',
            'Creditur_type_m',
            'Sum_insured_type_m',
            'Decrease_batch_m'));
	}

    public function index(){
        redirect('product/list_data');
    }

    public function list_data(){
        $this->data['datatablesUrl'] = base_url('product/datatables');
    	$this->data['title_1']     ="Setup";
    	$this->data['title_2']     ="Produk";
		$this->data['content']     = $this->load->view('product/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
	}

    public function datatables()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'product.product_id,'.
                'product.product_name,'.
                'product.plan_id,'.
                'pay_method.pay_method_name,'.
                'credit_type.credit_type_name,'.
                'product.rowstate,'.
                'product.user_inp'
                )
            ->order_by('product.product_id', 'DESC')
            ->from('product')
            ->join('pay_method','pay_method.pay_method_id = product.pay_method_id')
            ->join('credit_type','credit_type.credit_type_id = product.credit_type_id')
            ->add_column('action', '<a href="' . base_url() . 'product/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'product_id')
            ->unset_column('product.product_id');

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
                $v[7]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

	public function add(){
        if($this->input->post('submit')){
            $this->Product_m->insert();
            $this->session->set_flashdata('success', 'Informasi umum produk berhasil disimpan');
            redirect('product/detail/'.$this->session->userdata('ses_product_id'));   
        } else {
            $this->data['title_1']                        = "Setup";
	    	$this->data['title_2']                        = "Tambah Produk";
            $this->data['button_form']                    = "Simpan";
	    	$this->data['getPayMethod']                   = $this->Pay_method_m->getAll();
	    	$this->data['getCreditType']                  = $this->Credit_type_m->getAll();
	    	$this->data['getCurrency']                    = $this->Currency_m->getAll();
	    	$this->data['getDistributionChannel']         = $this->Distribution_channel_m->getAll();
	    	$this->data['getRiskInsuranceType']           = $this->Risk_insurance_type_m->getAll();
            $this->data['getBankCollateralType']          = $this->Bank_collateral_type_m->getAll();
            $this->data['getProductType']                 = $this->Product_type_m->getAll();
	    	$this->data['getInsuranceType']               = $this->Insurance_type_m->getAll();
            $this->data['getCountAgeMethod']              = $this->Count_age_method_m->getAll();
            $this->data['getParamPublishingCertificate']  = $this->Param_publishing_certificate_m->getAll();
            $this->data['getTermLoanType']                = $this->Term_loan_type_m->getAll();
            $this->data['getPayPremiumType']              = $this->Pay_premium_type_m->getAll();
            $this->data['getBenefitType']                 = $this->Benefit_type_m->getAll();
            $this->data['getBenefit']                     = $this->Benefit_m->getAll();
            $this->data['getRefundFormula']               = $this->Refund_formula_m->getAll();
            $this->data['getCrediturType']                = $this->Creditur_type_m->getAll();
            $this->data['getSumInsuredType']              = $this->Sum_insured_type_m->getAll();
			$this->data['content']                        = $this->load->view('product/form',$this->data,TRUE);
	        $this->load->view('layout/main',$this->data);
        }
    }

    public function edit($product_id){
        if($this->input->post('submit')){
            $this->Product_m->update($product_id);
            $this->session->set_flashdata('success', 'Informasi umum produk berhasil diedit');
            redirect('product/detail/'.$this->session->userdata('ses_product_id'));   
        } else {
            $this->data['title_1']                        = "Setup";
            $this->data['title_2']                        = "Edit Produk";
            $this->data['button_form']                    = "Edit";
            $this->data['get_product']                    = $this->Product_m->getById($product_id);
            $this->data['getPayMethod']                   = $this->Pay_method_m->getAll();
            $this->data['getCreditType']                  = $this->Credit_type_m->getAll();
            $this->data['getCurrency']                    = $this->Currency_m->getAll();
            $this->data['getDistributionChannel']         = $this->Distribution_channel_m->getAll();
            $this->data['getRiskInsuranceType']           = $this->Risk_insurance_type_m->getAll();
            $this->data['getBankCollateralType']          = $this->Bank_collateral_type_m->getAll();
            $this->data['getProductType']                 = $this->Product_type_m->getAll();
            $this->data['getInsuranceType']               = $this->Insurance_type_m->getAll();
            $this->data['getCountAgeMethod']              = $this->Count_age_method_m->getAll();
            $this->data['getParamPublishingCertificate']  = $this->Param_publishing_certificate_m->getAll();
            $this->data['getTermLoanType']                = $this->Term_loan_type_m->getAll();
            $this->data['getPayPremiumType']              = $this->Pay_premium_type_m->getAll();
            $this->data['getBenefitType']                 = $this->Benefit_type_m->getAll();
            $this->data['getBenefit']                     = $this->Benefit_m->getAll();
            $this->data['getRefundFormula']               = $this->Refund_formula_m->getAll();
            $this->data['getCrediturType']                = $this->Creditur_type_m->getAll();
            $this->data['getSumInsuredType']              = $this->Sum_insured_type_m->getAll();
            $this->data['content']                        = $this->load->view('product/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function cloning($product_id){
        if($this->input->post('submit')){
            $this->Product_m->insert();
            $this->session->set_flashdata('success', 'Produk Berhasil Dicloning');
            redirect('product/detail/'.$this->session->userdata('ses_product_id'));   
        } else {
            $this->data['title_1']                        = "Setup";
            $this->data['title_2']                        = "Cloning Produk";
            $this->data['button_form']                    = "Clone";
            $this->data['get_product']                    = $this->Product_m->getById($product_id);
            $this->data['getPayMethod']                   = $this->Pay_method_m->getAll();
            $this->data['getCreditType']                  = $this->Credit_type_m->getAll();
            $this->data['getCurrency']                    = $this->Currency_m->getAll();
            $this->data['getDistributionChannel']         = $this->Distribution_channel_m->getAll();
            $this->data['getRiskInsuranceType']           = $this->Risk_insurance_type_m->getAll();
            $this->data['getBankCollateralType']          = $this->Bank_collateral_type_m->getAll();
            $this->data['getProductType']                 = $this->Product_type_m->getAll();
            $this->data['getInsuranceType']               = $this->Insurance_type_m->getAll();
            $this->data['getCountAgeMethod']              = $this->Count_age_method_m->getAll();
            $this->data['getParamPublishingCertificate']  = $this->Param_publishing_certificate_m->getAll();
            $this->data['getTermLoanType']                = $this->Term_loan_type_m->getAll();
            $this->data['getPayPremiumType']              = $this->Pay_premium_type_m->getAll();
            $this->data['getBenefitType']                 = $this->Benefit_type_m->getAll();
            $this->data['getBenefit']                     = $this->Benefit_m->getAll();
            $this->data['getRefundFormula']               = $this->Refund_formula_m->getAll();
            $this->data['getCrediturType']                = $this->Creditur_type_m->getAll();
            $this->data['getSumInsuredType']              = $this->Sum_insured_type_m->getAll();
            $this->data['content']                        = $this->load->view('product/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function detail($product_id){
        $this->data['title_1']                      = "Setup";
    	$this->data['title_2']                      = "Detail Produk";
        $this->data['datatablesUrl_rate']           = base_url('product/datatables_rate/'.$product_id);
        $this->data['datatablesUrl_underwriting']   = base_url('product/datatables_underwriting/'.$product_id);
        $this->data['datatablesUrl_decrease']       = base_url('product/datatables_decrease/'.$product_id);
    	$this->data['getProductById']               = $this->Product_m->getById($product_id);
    	$this->data['getPlan']                      = $this->Plan_m->getAll($product_id);
    	$this->data['getProductInsuranceType']      = $this->Product_m->ProductInsuranceType($product_id);
        $this->data['getBenefitType']               = $this->Benefit_type_m->getAll();
        $this->data['get_underwriting_batch']       = $get_underwriting_batch = $this->Underwriting_batch_m->getProductId($product_id);
        $this->data['get_rate_batch']               = $get_rate_batch = $this->Rate_batch_m->getProductId($product_id);
        $this->data['get_decrease_batch']           = $get_decrease_batch = $this->Decrease_batch_m->getProductId($product_id);
        $warning = array();
        if(!$get_underwriting_batch){
            $warning[] = 'Table medis belum diupload.';
        }
        if(!$get_rate_batch){
            $warning[] = 'Table rate belum diupload.';
        }
         if(!$get_decrease_batch){
            $warning[] = 'Table penurunan belum diupload.';
        }
        $this->session->set_flashdata('warning', $warning);
		
        $this->data['content']                      = $this->load->view('product/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function datatables_rate($product_id)
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'rate_batch.rate_batch_id,'.
                'benefit.benefit_name,'.
                'rate_batch.period_start,'.
                'rate_batch.period_end,'.
                'rate_batch.create_date,'.
                'rate_batch.rowstate,'.
                'rate_batch.user_inp'
                )
            ->order_by('rate_batch.rate_batch_id', 'DESC')
            ->from('rate_batch')           
            ->join('benefit','benefit.benefit_id = rate_batch.benefit_id')
            ->where('rate_batch.product_id', $product_id)
              
            ->unset_column('rate_batch.rate_batch_id');
            $get_permission = $this->auth->get_permission(323);
            if($get_permission->permission){
            $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large" class="btn btn-xs default blue-stripe a_rate">Detail</a>
                <a href="' . base_url() . 'product/delete_rate/$1" onclick="return confirm("Konfirmasi Produk Asuransi?")" class="btn btn-xs red">Hapus</a>', 'rate_batch_id'); 
            } else {
                $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large" class="btn btn-xs default blue-stripe a_rate">Detail</a>', 'rate_batch_id');
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $resultArray[] = [
                $rowIndex,
                htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[2])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[3])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[4])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                $v[7]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

    public function datatables_underwriting($product_id)
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'underwriting_batch.underwriting_batch_id,'.
                'underwriting_batch.period_start,'.
                'underwriting_batch.period_end,'.
                'underwriting_batch.create_date,'.
                'underwriting_batch.rowstate,'.
                'underwriting_batch.user_inp'
                )
            ->order_by('underwriting_batch.underwriting_batch_id', 'DESC')
            ->from('underwriting_batch')
            ->where('underwriting_batch.product_id', $product_id)
            ->unset_column('underwriting_batch.underwriting_batch_id');
            $get_permission = $this->auth->get_permission(325);
            if($get_permission->permission){
                $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large_2" class="btn btn-xs default blue-stripe a_underwriting">Detail</a>
                <a href="' . base_url() . 'product/delete_underwriting/$1" onclick="return confirm("Konfirmasi Produk Asuransi?")" class="btn btn-xs red">Hapus</a>', 'underwriting_batch_id');
            } else {
                $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large_2" class="btn btn-xs default blue-stripe a_underwriting">Detail</a>', 'underwriting_batch_id');
            }

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $resultArray[] = [
                $rowIndex,
                htmlspecialchars(date('d-m-Y', strtotime($v[1])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[2])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[3])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
                $v[6]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

    public function datatables_decrease($product_id)
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'decrease_batch.decrease_batch_id,'.
                'decrease_batch.period_start,'.
                'decrease_batch.period_end,'.
                'decrease_batch.create_date,'.
                'decrease_batch.rowstate,'.
                'decrease_batch.user_inp'
                )
            ->order_by('decrease_batch.decrease_batch_id', 'DESC')
            ->from('decrease_batch')           
            ->where('decrease_batch.product_id', $product_id) 
            ->unset_column('decrease_batch.decrease_batch_id');
            $get_permission = $this->auth->get_permission(327);
            if($get_permission->permission){
                $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large_3" class="btn btn-xs default blue-stripe a_decrease">Detail</a>
                <a href="' . base_url() . 'product/delete_decrease/$1" onclick="return confirm("Hapus?")" class="btn btn-xs red">Hapus</a>', 'decrease_batch_id');  
            } else {
                $this->datatables->add_column('action', '<a data-id="$1" data-toggle="modal" href="#large_3" class="btn btn-xs default blue-stripe a_decrease">Detail</a>', 'decrease_batch_id');  
            }
        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;

        foreach ($result->data as $k => $v) {
            $resultArray[] = [
                $rowIndex,
                htmlspecialchars(date('d-m-Y', strtotime($v[1])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[2])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[3])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[5], ENT_QUOTES, 'UTF-8'),
                $v[6]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

    public function add_rate(){
            // config upload
            $config['upload_path']      = './file_upload/rate/';
            $config['allowed_types']    = 'xls|xlsx';
            $config['max_size']         = '10000';
            $this->load->library('upload', $config);
            
            $product_id         = $this->input->post('product_id');
            $benefit_id         = $this->input->post('benefit_id');
            $period_start       = date('Y-m-d', strtotime($this->input->post('period_start')));
            $period_end         = date('Y-m-d', strtotime($this->input->post('period_end')));

            if (!$this->upload->do_upload('up_file')){  
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                exit;
            } else {
                $upload_data = $this->upload->data();
                $this->load->library('excel_reader');

                $this->excel_reader->setOutputEncoding('230787');
                $file = $upload_data['full_path'];
                $this->excel_reader->read($file);
                error_reporting(E_ALL ^ E_NOTICE);

                $data = $this->excel_reader->sheets[0];
                $dataexcel = Array();
                for ($i = 2; $i <= $data['numRows']; $i++) {
                    if ($data['cells'][$i][1] == '')
                        break;
                    $dataexcel[$i - 2]['period']    = $data['cells'][$i][2];
                    $dataexcel[$i - 2]['min_age']   = $data['cells'][$i][3];
                    $dataexcel[$i - 2]['max_age']   = $data['cells'][$i][4];
                    $dataexcel[$i - 2]['rate']      = $data['cells'][$i][5];
                }
                
                $this->Rate_batch_m->insert($dataexcel, $product_id, $benefit_id, $period_start, $period_end);

                $file = $upload_data['up_file'];
                $path = './file_upload/rate/' . $file;
                // chmod($path, 0777);
                // unlink($path);
                $this->session->set_flashdata('success', 'Rate berhasil di upload.');
                redirect('product/detail/'.$product_id.'#tab_2');   
        } 
    }

    public function add_underwriting(){
            // config upload
            $config['upload_path']      = './file_upload/underwriting/';
            $config['allowed_types']    = 'xls|xlsx';
            $config['max_size']         = '10000';
            $this->load->library('upload', $config);
            
            $product_id     = $this->input->post('product_id');
            $period_start   = date('Y-m-d', strtotime($this->input->post('period_start')));
            $period_end     = date('Y-m-d', strtotime($this->input->post('period_end')));

            if (!$this->upload->do_upload('up_file')){  
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                exit;
            } else {
                $upload_data = $this->upload->data();
                $this->load->library('excel_reader');

                $this->excel_reader->setOutputEncoding('230787');
                $file = $upload_data['full_path'];
                $this->excel_reader->read($file);
                error_reporting(E_ALL ^ E_NOTICE);

                $data = $this->excel_reader->sheets[0];
                $dataexcel = Array();
                for ($i = 2; $i <= $data['numRows']; $i++) {
                    if ($data['cells'][$i][1] == '')
                        break;
                    $dataexcel[$i - 2]['min_age']           = $data['cells'][$i][2];
                    $dataexcel[$i - 2]['max_age']           = $data['cells'][$i][3];
                    $dataexcel[$i - 2]['sum_insured_min']   = $data['cells'][$i][4];
                    $dataexcel[$i - 2]['sum_insured_max']   = $data['cells'][$i][5];
                    $dataexcel[$i - 2]['underwriting']      = $data['cells'][$i][6];
                    $dataexcel[$i - 2]['underwriting_type'] = $data['cells'][$i][7];
                }
                
                $this->Underwriting_batch_m->insert($dataexcel, $product_id, $period_start, $period_end);

                $file = $upload_data['up_file'];
                $path = './file_upload/underwriting/' . $file;
                // chmod($path, 0777);
                // unlink($path);
                $this->session->set_flashdata('success', 'Tabel Medis berhasil di upload.');
                redirect('product/detail/'.$product_id.'#tab_2');   
        } 
    }

    public function add_decrease(){
            // config upload
            $config['upload_path']      = './file_upload/decrease/';
            $config['allowed_types']    = 'xls|xlsx';
            $config['max_size']         = '10000';
            $this->load->library('upload', $config);
            
            $product_id         = $this->input->post('product_id');
            $period_start       = date('Y-m-d', strtotime($this->input->post('period_start')));
            $period_end         = date('Y-m-d', strtotime($this->input->post('period_end')));

            if (!$this->upload->do_upload('up_file')){  
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                exit;
            } else {
                $upload_data = $this->upload->data();
                $this->load->library('excel_reader');

                $this->excel_reader->setOutputEncoding('230787');
                $file = $upload_data['full_path'];
                $this->excel_reader->read($file);
                error_reporting(E_ALL ^ E_NOTICE);

                $data = $this->excel_reader->sheets[0];
                $dataexcel = Array();
                for ($i = 2; $i <= $data['numRows']; $i++) {
                    if ($data['cells'][$i][1] == '')
                        break;
                    $dataexcel[$i - 2]['period']    = $data['cells'][$i][2];
                    $dataexcel[$i - 2]['min_age']   = $data['cells'][$i][3];
                    $dataexcel[$i - 2]['max_age']   = $data['cells'][$i][4];
                    $dataexcel[$i - 2]['rate']      = $data['cells'][$i][5];
                }
                
                $this->Decrease_batch_m->insert($dataexcel, $product_id, $period_start, $period_end);

                $file = $upload_data['up_file'];
                $path = './file_upload/decrease/' . $file;
                // chmod($path, 0777);
                // unlink($path);
                $this->session->set_flashdata('success', 'Tabel Penurunan berhasil di upload.');
                redirect('product/detail/'.$product_id.'#tab_4');   
        } 
    }

    public function download_document($document_name){
        $this->load->helper('download');
        // $get_doc = $this->Document_m->get($document_id);
        $data = file_get_contents("file_upload/template/".$document_name); // Read the file's contents
        $name = $get_doc->up_file;
        force_download($name, $data); 
    }

    public function confirm($product_id){
        $this->Product_m->confirm($product_id);
        redirect('product/detail/'.$product_id);         
    }

    public function delete_rate($rate_batch_id){
        $get_state = $this->Rate_batch_m->check_state($rate_batch_id);
        if($get_state->rowstate == 'active'){
            $this->session->set_flashdata('error', 'Rate gagal dihapus, status produk sudah active.');
            redirect('product/detail/'.$get_state->product_id.'tab_2');
        }

        $this->Rate_batch_m->delete($rate_batch_id);
        $this->session->set_flashdata('success', 'Rate Berhasil dihapus.');
        redirect($this->agent->referrer());
    }

    public function delete_underwriting($underwriting_batch_id){
        $get_state = $this->Underwriting_batch_m->check_state($underwriting_batch_id);
        if($get_state->rowstate == 'active'){
            $this->session->set_flashdata('error', 'Tabel Medis gagal dihapus, status produk sudah active.');
            redirect('product/detail/'.$get_state->product_id.'tab_3');
        }

        $this->Underwriting_batch_m->delete($underwriting_batch_id);
        $this->session->set_flashdata('success', 'Tabel Medis Berhasil dihapus.');
        redirect($this->agent->referrer());
    }

    public function delete_decrease($decrease_batch_id){
        $get_state = $this->Decrease_batch_m->check_state($decrease_batch_id);
        if($get_state->rowstate == 'active'){
            $this->session->set_flashdata('error', 'Tabel penurunan gagal dihapus, status produk sudah active.');
            redirect('product/detail/'.$get_state->product_id.'tab_4');
        }

        $this->Decrease_batch_m->delete($decrease_batch_id);
        $this->session->set_flashdata('success', 'Tabel penurunan berhasil dihapus.');
        redirect($this->agent->referrer());
    }
}