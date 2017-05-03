<?php 

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
    public function index(){
        redirect('login');
    }
    
    public function login(){
		$this->load->view('login');
	}
    
    public function do_login(){
        $username      = $this->input->post('username');
        $password   = $this->input->post('password');
        
        $enc = md5($password);
        //echo $enc;
        $sql = $this->db->query("SELECT
                    a.*, b.bank_id,
                    b.bank_name
                FROM
                    user AS a,
                    bank AS b
                WHERE
                    a.bank_id = b.bank_id
                AND a.username = '$username'
                AND a.`password` = '$enc'
                AND a.rowstate = 'active'
                AND b.rowstate = 'active'
                LIMIT 1");
        if($sql->num_rows() == 1){
            $row = $sql->row();
            $data = array (
                'isLogin' => 'yes',
                'user_id' => $row->user_id,
                'username' => $row->username,
                'roles_id' => $row->roles_id,
                'user_entity' => $row->user_entity,
                'bank_id' => $row->bank_id,
                'bank_name' => $row->bank_name
				
				
            );
            $this->session->set_userdata($data);
			//$this->session->set_flashdata('Anda Berhasil Login');
            redirect('home');
        } else {
            $this->session->set_flashdata('error', '<p class="errors notification">User ID atau Password Salah!!</p>');
            redirect('user/login');
            
        }
    }
    
    public function do_logout()
    {
        $data_session = array(
			'isLogin'       => $this->session->userdata('isLogin'),
            'user_id'       => $this->session->userdata('user_id'),			
            'username'      => $this->session->userdata('username'),
            'roles_id'      => $this->session->userdata('roles_id'),
            'user_entity'   => $this->session->userdata('user_entity'),
            'bank_id'       => $this->session->userdata('bank_id'),
            'bank_name'     => $this->session->userdata('bank_name')			
		);
		$this->session->unset_userdata($data_session);
        redirect('user/login');    
    }
}