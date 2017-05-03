<?php 

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('isLogin')) redirect ('user/login');
		$this->load->model(array('Debitur_m','Bank_m'));
	}
	
    public function index(){
    	$this->data['title_1']		= "Beranda";
    	$this->data['title_2']		= "";
    	$this->data['get_debitur']	= $this->Debitur_m->get_total_info();
    	// $this->data['get_bank']		= $this->Bank_m->get_total_info();
		$this->data['content'] 		= $this->load->view('home/form',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
	}
}