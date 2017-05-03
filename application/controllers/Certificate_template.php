<?php 

class Certificate_template extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Certificate_template_m'
            ));
    }

    public function index(){
        redirect('certificate_template/list_data');
    }
        
    public function list_data(){
        $this->data['datatablesUrl']        = base_url('certificate_template/datatables');
        $this->data['title_1']              = "Setup";
        $this->data['title_2']              = "Polis";
        $this->data['content']              = $this->load->view('certificate_template/list',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function add(){
        if($this->input->post('submit')){
            $this->Certificate_template_m->insert();
            $this->session->set_flashdata('success', 'Template sertifikat berhasil disimpan');
            redirect('certificate_template/list_data/');   
        } else {
            $this->data['title_1']                        = "Master";
            $this->data['title_2']                        = "Template Sertifikat";
            $this->data['header_form']                    = "Form Template Sertifikat";             
            $this->data['button_form']                    = "Simpan";
            $this->data['content']                        = $this->load->view('certificate_template/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function edit($certificate_template_id){
        if($this->input->post('submit')){
            $this->Certificate_template_m->update($certificate_template_id);
            $this->session->set_flashdata('success', 'Template sertifikat berhasil diupdate');
            redirect('certificate_template/list_data/');   
        } else {
            $this->data['title_1']                        = "Master";
            $this->data['title_2']                        = "Template Sertifikat";
            $this->data['get_certificate_template']       = $this->Certificate_template_m->getById($certificate_template_id);
            $this->data['content']                        = $this->load->view('certificate_template/form',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        }
    }

    public function datatables()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->datatables->select(
                'certificate_template.certificate_template_id,'.
                'certificate_template.certificate_template_name,'.
                'certificate_template.create_date,'.
                'certificate_template.rowstate,'.
                'certificate_template.user_inp'
                )
            ->order_by('certificate_template.certificate_template_id', 'DESC')
            ->from('certificate_template')
            ->add_column('action', '<a href="' . base_url() . 'certificate_template/detail/$1" class="btn btn-xs default blue-stripe">Detail</a>', 'certificate_template_id')
            ->unset_column('certificate_template.certificate_template_id');

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
                $v[5]
            ];

            ++ $rowIndex;
        }

        $result->data = $resultArray;
        
        die(json_encode($result));
    }
    
    public function detail($certificate_template_id){
        $this->data['title_1']                  = "Setup";
        $this->data['title_2']                  = "Detail Template Sertifikat";
        $this->data['get_certificate_template'] = $get_policy = $this->Certificate_template_m->getById($certificate_template_id);
        $this->data['content']                  = $this->load->view('certificate_template/form_detail',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function confirm($certificate_template_id){
        $this->Certificate_template_m->confirm($certificate_template_id);
        redirect('certificate_template/detail/'.$certificate_template_id);         
    }
    
}