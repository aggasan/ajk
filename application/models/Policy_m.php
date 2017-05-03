<?php
    class Policy_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('policy')->result();
        }

        function delete($id){
            $this->db->delete('policy', array('policy_id'=>$id));
    	}

        public function getById($policy_id){
            $csql = "SELECT a.*, b.bank_name, c.product_name, c.plan_id, d.insurance_type_name, e.period_type_name, f.certificate_template_name 
                from policy as a, bank as b, product as c, insurance_type as d, period_type as e, certificate_template as f
                WHERE a.bank_id = b.bank_id 
                AND a.product_id = c.product_id
                AND c.insurance_type_id = d.insurance_type_id
                AND a.period_type_id = e.period_type_id
                AND a.certificate_template_id = f.certificate_template_id
                AND a.policy_id = '$policy_id'
            ";
            return $this->db->query($csql)->row();
        }

        public function get_by_bank_id($bank_id){
            $csql = "SELECT a.*,b.product_name FROM policy as a, product as b WHERE a.product_id = b.product_id AND a.bank_id = '$bank_id'";
            return $this->db->query($csql)->result();
        }

    	function get($bank_id = '', $product_id = ''){
    		$csql = "SELECT
				*, max(last_number_certificate) as last_number_certificate
			FROM
				policy
			WHERE
				bank_id = '$bank_id'
			AND product_id = '$product_id'";
			return $this->db->query($csql)->row();
    	}

        function last_number($now){
            $csql = "SELECT
                *, max(number_record) as number_record
            FROM
                policy
            WHERE
            year_number_record = '$now'";
            return $this->db->query($csql)->row();
        }

        public function insert(){
            $this->load->model(array('Product_m'));
            
            $now = date('y');

            $val_last_number_policy = $this->last_number($now);
            $last_number_policy     = $val_last_number_policy->number_record + 1;

            $policy                 = str_pad($last_number_policy,3,0,STR_PAD_LEFT);
            $policy_id              = date('y').$policy;
            $policy_number          = date('y').$policy.'-01-000';

            $this->db->insert('policy',
                array('bank_id'         => $this->input->post('bank_id'),
                'product_id'            => $this->input->post('product_id'),
                'policy_id'             => $policy_id,
                'waiting_period'        => $this->input->post('waiting_period'),
                'grace_period'          => $this->input->post('grace_period'),
                'print_certificate'     => $this->input->post('print_certificate'),
                'auto_cancel'           => $this->input->post('auto_cancel'),
                'period_type_id'        => $this->input->post('period_type_id'),
                'klausa_polis'          => $this->input->post('klausa_polis'),
                'certificate_template_id' => $this->input->post('certificate_template_id'),
                'policy_number'         => $policy_number,
                'year_number_record'    => $now,
                'number_record'         => $last_number_policy,
                'create_date'           => date('Y-m-d H:i:s'),
                'user_inp'              => $this->session->userdata('username'),
                'rowstate'              => 'planned'
                ));

            $this->session->set_userdata('ses_policy_id', $policy_id);
        }

        public function update($policy_id){
            $data = array(
                'bank_id'               => $this->input->post('bank_id'),
                'product_id'            => $this->input->post('product_id'),
                'policy_id'             => $policy_id,
                'waiting_period'        => $this->input->post('waiting_period'),
                'grace_period'          => $this->input->post('grace_period'),
                'print_certificate'     => $this->input->post('print_certificate'),
                'auto_cancel'           => $this->input->post('auto_cancel'),
                'period_type_id'        => $this->input->post('period_type_id'),
                'klausa_polis'          => $this->input->post('klausa_polis'),
                'certificate_template_id' => $this->input->post('certificate_template_id'),
                'last_update'           => date('Y-m-d H:i:s'),
                'user_update'           => $this->session->userdata('username'),
                'rowstate'              => 'planned'
            );
            $this->db->where('policy_id', $policy_id);
            $this->db->update('policy', $data);

            $this->session->set_userdata('ses_policy_id', $policy_id);
        }

        public function confirm($policy_id){
            $data = array(
                'rowstate'                  => 'active'
            );
            $this->db->where('policy_id', $policy_id);
            $this->db->update('policy', $data);  
            $this->session->set_flashdata('success', 'Polis Master berhasil dikonfirmasi.');
        }
    }
?>
