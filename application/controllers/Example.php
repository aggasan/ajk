<?php
	class Example extends CI_Controller{
		function __construct(){
			parent::__construct();
		}

		public function name(){
			$this->data['title_1']              = "Transaksi";
        	$this->data['title_2']              = "List Pengajuan";	
			$this->data['param'] 				= "my name is putri";
			$this->data['content']  			= $this->load->view('example',$this->data,TRUE);
        	$this->load->view('layout/main',$this->data);
		}
	}
?>