<?php 

class Marketing_program extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Marketing_program_m',
            'Product_m'
            ));
    }
    
    public function index(){
        redirect('marketing_program/list_data');
    }

    public function list_data(){
        $this->data['datatablesUrl']        = base_url('marketing_program/datatables');
        $this->data['title_1']              = "Setup";
        $this->data['title_2']              = "Marketing_program";
        $this->data['content']              = $this->load->view('marketing_program/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    

    public function add(){
        if($this->input->post('submit')){
            $this->Marketing_program_m->insert();
            $this->session->set_flashdata('success', 'Marketing Program berhasil disimpan');
            redirect('Marketing_program/detail/'.$this->session->userdata('ses_marketing_program_id'));   
        } else {
            $this->data['title_1']                        =   "Setup";
            $this->data['title_2']                        =   "Tambah Marketing Program";
            $this->data['content']                        =   $this->load->view('marketing_program/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function datatables()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'marketing_program.marketing_program_id,'.
                'marketing_program.marketing_program_name,'.
                'marketing_program.discount,'.
                'marketing_program.period_start,'.
                'marketing_program.period_end,'.
                'marketing_program.create_date,'.
                'marketing_program.rowstate,'.
                'marketing_program.user_inp'
                )
            ->order_by('marketing_program.marketing_program_id', 'DESC')
            ->from('marketing_program')
            // ->where($this->tables['marketing_program'].'.author', $this->session->userdata('user_id'))
            ->add_column('action', '<a href="' . base_url() . 'marketing_program/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'marketing_program_id')
            ->unset_column('marketing_program.marketing_program_id');

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
                ''// $v[8]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    /**
     * END DATATABLES
     */

    public function detail($id){
        $this->data['title_1']                      =   "Setup";
        $this->data['title_2']                      =   "Detail Perusahaan / Client";
        $this->data['getMarketing_programById']     =  $get_Marketing_program     =   $this->Marketing_program_m->getById($id);
        $this->data['getProductById']               =   $this->Product_m->getById($get_Marketing_program->product_id);
        $this->data['getProductInsuranceType']      =   $this->Product_m->ProductInsuranceType($get_Marketing_program->product_id);

        $this->data['getBenefitType']               =   $this->Benefit_type_m->getAll();
        $this->data['content']                      =   $this->load->view('marketing_program/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    
}