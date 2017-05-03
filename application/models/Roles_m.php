
<?php
    class Roles_m extends CI_Model 
    {
        public function getAll(){
            return $this->db->get('roles')->result();
        }

        public function delete($roles_id){
            $this->db->delete('roles', array('roles_id'=>$roles_id));
    	}

    	public function getById($roles_id){
            $query = "SELECT * FROM roles WHERE roles_id = '$roles_id'";
            return $this->db->query($query)->row();
        }

        public function get_roles_permission($roles_id){
            $query = "SELECT * FROM roles WHERE roles_id = '$roles_id'";
            return $this->db->query($query)->result();
        }

        public function last_number_id(){
            $query = "SELECT MAX(roles_id) as roles_id FROM roles";
            return $this->db->query($query)->row();
        }

    	public function insert(){
            // LAST NUMBER DEBITUR ID
            $roles = $this->last_number_id();
            $roles_id = $roles->roles_id + 1;
            // END LAST NUMBER DEBITUR ID
    		$this->db->insert('roles', array(
                'roles_id'      => $roles_id,
    			'roles_name'    => $this->input->post('roles_name'),
    			'create_date'   => date('Y-m-d H:i:s'),
                'user_inp'		=> $this->session->userdata('username'),
                'rowstate'      => $this->input->post('rowstate')
    			));

            // PERMISSION
            $module_line_count = $this->input->post('module_line_id');
            foreach ($module_line_count as $selected_module_line) {
                $this->db->insert('roles_permission',
                    array('roles_id'  =>  $roles_id,
                    'module_line_id'  =>  $selected_module_line,
                    'permission'      =>  1,
                    'create_date'     =>  date('Y-m-d H:i:s'),
                    'user_inp'        =>  $this->session->userdata('username')
                ));
            }
            // END PERMISSION
            $this->session->set_userdata('ses_roles_id', $roles_id);
    	}

    	public function update($roles_id){
            // DELETE FIRST ON DEBITUR PREMI
            $this->db->delete('roles_permission', array('roles_id'=>$roles_id));
            // END DELETE FIRST ON DEBITUR PREMI
    		 // UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
            $data = array(
                'roles_name'    => $this->input->post('roles_name'),
                'last_update'   => date('Y-m-d H:i:s'),
                'user_update'   => $this->session->userdata('username'),
                'rowstate'      => $this->input->post('rowstate')
            );
            $this->db->where('roles_id', $roles_id);
            $this->db->update('roles', $data);
            // END UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
            // PERMISSION
            $module_line_count = $this->input->post('module_line_id');
            foreach ($module_line_count as $selected_module_line) {
                $this->db->insert('roles_permission',
                    array('roles_id'  =>  $roles_id,
                    'module_line_id'  =>  $selected_module_line,
                    'permission'      =>  1,
                    'create_date'     =>  date('Y-m-d H:i:s'),
                    'user_inp'        =>  $this->session->userdata('username')
                ));
            }
            // END PERMISSION
            $this->session->set_userdata('ses_roles_id', $roles_id);
    	}
    }
?>
