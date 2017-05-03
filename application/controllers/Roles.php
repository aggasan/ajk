<?php 

class Roles extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Roles_m',
            'Module_m'
            ));
    }

    public function index(){
        redirect('roles/list_data');
    }

    public function add(){
        if($this->input->post('submit')){
            $this->Roles_m->insert();
            $this->session->set_flashdata('success', 'Roles berhasil disimpan');
            redirect('roles/detail/'.$this->session->userdata('ses_roles_id'));  
        } else {
            $this->data['title_1']                        = "Menejemen User";
            $this->data['title_2']                        = "Roles";
            $this->data['header_form']                    = "Form Roles";             
            $this->data['button_form']                    = "Simpan";
            $this->data['get_module_parent'] = $this->Module_m->get_parent();     
            $this->data['content']                        = $this->load->view('roles/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function edit($roles_id){
        if($this->input->post('submit')){
            $this->Roles_m->update($roles_id);
            $this->session->set_flashdata('success', 'Roles berhasil diupdate');
            redirect('roles/detail/'.$this->session->userdata('ses_roles_id'));   
        } else {
            $this->data['title_1']      = "Menejemen User";
            $this->data['title_2']      = "Roles";
            $this->data['header_form']  = "Form Roles";             
            $this->data['button_form']  = "Edit";
            $this->data['get_roles']    = $this->Roles_m->getById($roles_id);
            $this->data['get_module_parent'] = $this->Module_m->get_parent();
            $this->data['content']      = $this->load->view('roles/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function list_data(){
        $this->data['datatablesUrl']        = base_url('roles/datatables/');
        $this->data['title_1']              = "Menejemen User";
        $this->data['title_2']              = "Roles";
        $this->data['content']              = $this->load->view('roles/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    // DATATABLES LIST DATA
    public function datatables(){
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $this->datatables->select(
            'roles.roles_id,'.
            'roles.roles_name,'.
            'roles.create_date,'.
            'roles.rowstate,'.
            'roles.user_inp'
            )
        ->order_by('roles.roles_id', 'DESC')
        ->from('roles')
        ->add_column('action', '<a href="' . base_url() . 'roles/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'roles_id')
        ->unset_column('roles.roles_id');

        $result = json_decode($this->datatables->generate());
        $resultArray = [];
        $rowIndex = 1;
        foreach ($result->data as $k => $v) {
            $resultArray[] = [
                $rowIndex,
                htmlspecialchars($v[1], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(date('d-m-Y', strtotime($v[2])), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[3], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($v[4], ENT_QUOTES, 'UTF-8'),
                $v[5]
            ];
            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }

    public function detail($roles_id){
        $this->data['title_1']          = "Manajemen User";
        $this->data['title_2']          = "Detil Roles";
        $this->data['get_roles']        = $this->Roles_m->getById($roles_id);
        $this->data['get_module_parent'] = $this->Module_m->get_parent();        
        $this->data['content']          = $this->load->view('roles/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function confirm($roles_id){
        $this->roles_m->confirm($roles_id);
        redirect('roles/detail/'.$roles_id);         
    }
}