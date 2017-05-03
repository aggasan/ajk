<?php 

class Bank extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Bank_m',
            'Product_m',
            'City_m',
            'Bank_type_m',
            'Benefit_product_m',
            'Benefit_type_m'
            ));
    }

    function index(){
        redirect('bank/list_data');
    }
        
    public function list_data(){
        // $this->data['getBank']     = $this->Bank_m->getAll();
        $this->data['datatablesUrl']    = base_url('bank/datatables');
        $this->data['title_1']          = "Setup";
        $this->data['title_2']          = "Bank";
        $this->data['content']          = $this->load->view('bank/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function datatables()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'bank.bank_id,'.
                'bank.bank_name,'.
                'bank_type.bank_type_name,'.
                'bank.address,'.
                'bank.city_name,'.
                'bank.phone,'.
                'bank.create_date,'.
                'bank.rowstate,'.
                'bank.user_inp'
                )
            ->order_by('bank.bank_id', 'DESC')
            ->from('bank')
            ->join('bank_type','bank_type.bank_type_id = bank.bank_type_id')
            ->add_column('action', '<a href="' . base_url() . 'bank/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'bank_id')
            ->unset_column('bank.bank_id');

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
                htmlspecialchars(date('d-m-Y', strtotime($v[6])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[7], ENT_QUOTES, 'UTF-8'),
                $v[9]
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
            $this->Bank_m->insert();
            $this->session->set_flashdata('success', 'Data Perusahaan/Client berhasil disimpan');
            redirect('bank/list_data/');   
        } else {
            $this->data['title_1']                        =   "Setup";
            $this->data['title_2']                        =   "Tambah Perusahaan/Client";
            $this->data['getBankType']                    =   $this->Bank_type_m->getAll();
            $this->data['getProduct']                     =   $this->Product_m->getAll();
            $this->data['content']                        =   $this->load->view('bank/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function detail($id){
        $this->data['title_1']                      =   "Setup";
        $this->data['title_2']                      =   "Detail Perusahaan / Client";
        $this->data['getBankById']  = $get_bank     =   $this->Bank_m->getById($id);
        $this->data['content']                      =   $this->load->view('bank/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function confirm($bank_id){
        $this->Bank_m->confirm($bank_id);
        redirect('bank/detail/'.$bank_id);         
    }
    
}