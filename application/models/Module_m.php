
<?php
    class Module_m extends CI_Model 
    {
        public function getAll(){
            return $this->db->get('module')->result();
        }

        public function delete($module_id){
            $this->db->delete('module', array('module_id'=>$module_id));
    	}

    	public function getById($module_id){
            $query = "SELECT * FROM module WHERE module_id = '$module_id'";
            return $this->db->query($query)->row();
        }

        public function get_parent(){
            $query = "SELECT * FROM module WHERE module_parent = 0 order by sort ASC";
            return $this->db->query($query)->result();
        }

        public function get_child($module_parent){
            $query = "SELECT * FROM module WHERE module_parent = '$module_parent'";
            return $this->db->query($query)->result();
        }

        public function get_module_line($module_id = '', $roles_id = ''){
            $query = "SELECT a.*, b.roles_id, b.roles_permission_id, b.permission from module_line as a
                        LEFT JOIN (SELECT * from roles_permission WHERE roles_id = '$roles_id') as b on a.module_line_id = b.module_line_id
                        where a.module_id = '$module_id'";
            return $this->db->query($query)->result();
        }

    	public function insert(){
    		$this->db->insert('module', array(
    			'module_name' => $this->input->post('module_name'),
    			'create_date'       		=> date('Y-m-d H:i:s'),
                'user_inp'					=> $this->session->userdata('username'),
                'rowstate'          		=> $this->input->post('rowstate')
    			));
    	}

    	public function update($module_id){
    		$data = array(
				'module_name' => $this->input->post('module_name'),
    			'create_date'       		=> date('Y-m-d H:i:s'),
                'user_inp'					=> $this->session->userdata('username'),
                'rowstate'          		=> $this->input->post('rowstate')
			);
			$this->db->where('module_id', $module_id);
			$this->db->update('module', $data);
    	}
    }
?>
