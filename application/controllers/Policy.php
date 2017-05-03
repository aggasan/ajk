<?php 

class Policy extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Policy_m',
            'Product_m',
            'Bank_m',
            'Period_type_m',
            'Certificate_template_m'
            ));
    }

    public function index(){
        redirect('policy/list_data');
    }
        
    public function list_data(){
        $this->data['datatablesUrl']        = base_url('policy/datatables');
        $this->data['title_1']              = "Setup";
        $this->data['title_2']              = "Polis";
        $this->data['content']              = $this->load->view('policy/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function add(){
        if($this->input->post('submit')){
            $this->Policy_m->insert();
            $this->session->set_flashdata('success', 'Nomor polis berhasil digenerate');
            redirect('policy/list_data/');   
        } else {
            $this->data['title_1']                        =   "Setup";
            $this->data['title_2']                        =   "Generate Polis";
            $this->data['button_form']                    =   "Generate";
            $this->data['getBank']                        =   $this->Bank_m->getAll();
            $this->data['getProduct']                     =   $this->Product_m->getAll();
            $this->data['getPeriodType']                  =   $this->Period_type_m->getAll();
            $this->data['getCertificateTemplate']         =   $this->Certificate_template_m->getAll($rowstate = 'active');
            $this->data['content']                        =   $this->load->view('policy/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function edit($policy_id){
        if($this->input->post('submit')){
            $this->Policy_m->update($policy_id);
            $this->session->set_flashdata('success', 'Nomor polis berhasil diupdate');
            redirect('policy/list_data/');   
        } else {
            $this->data['title_1']                        =   "Setup";
            $this->data['title_2']                        =   "Generate Polis";
            $this->data['button_form']                    =   "Edit";
            $this->data['get_policy']                     =   $this->Policy_m->getById($policy_id);
            $this->data['getBank']                        =   $this->Bank_m->getAll();
            $this->data['getProduct']                     =   $this->Product_m->getAll();
            $this->data['getPeriodType']                  =   $this->Period_type_m->getAll();
            $this->data['getCertificateTemplate']         =   $this->Certificate_template_m->getAll($rowstate = 'active');
            $this->data['content']                        =   $this->load->view('policy/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function datatables()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'policy.policy_id,'.
                'bank.bank_name,'.
                'product.product_name,'.
                'policy.policy_number,'.
                'policy.print_certificate,'.
                'policy.create_date,'.
                'policy.rowstate,'.
                'policy.user_inp'
                )
            ->order_by('policy.policy_id', 'DESC')
            ->from('policy')
            ->join('bank', 'bank.bank_id = policy.bank_id')
            ->join('product', 'product.product_id = policy.product_id')
            ->add_column('action', '<a href="' . base_url() . 'policy/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'policy_id')
            ->unset_column('policy.policy_id');

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
                htmlspecialchars(date('d-m-Y', strtotime($v[5])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[6], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[7], ENT_QUOTES, 'UTF-8'),
                $v[8]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

    public function detail($policy_id){
        $this->data['title_1']                      =   "Setup";
        $this->data['title_2']                      =   "Detail Polis Master";
        $this->data['get_policy']                   =  $get_policy = $this->Policy_m->getById($policy_id);
        $this->data['getBankById']                  =  $get_bank   = $this->Bank_m->getById($get_policy->bank_id);
        $this->data['content']                      =   $this->load->view('policy/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function confirm($policy_id){
        $this->Policy_m->confirm($policy_id);
        redirect('policy/detail/'.$policy_id);         
    }
    
}