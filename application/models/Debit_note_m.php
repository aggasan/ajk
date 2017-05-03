<?php
    class Debit_note_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('debit_note')->result();
        }

        function delete($id){
            $this->db->delete('debit_note', array('debit_note_id'=>$id));
    	}

        public function get($debit_note_id){
            $csql = "SELECT a.*, b.pay_method_name FROM debit_note as a
                left join pay_method as b on a.pay_method_id = b.pay_method_id
            where debit_note_id = '$debit_note_id'";
            return $this->db->query($csql)->row();
        }

    	public function last_number(){
    		$csql = "SELECT max(debit_note_id) as debit_note_id FROM debit_note";
    		return $this->db->query($csql)->row();
    	}

    	public function insert($debit_note_id, $bank_id, $debit_note_number, $premi, $marturity_date, $total_debitur, $period_start, $period_end){
    		$this->db->insert('debit_note',array(
                'debit_note_id'         => $debit_note_id,
                // 'bank_id_from'          => $this->session->userdata('bank_id'),
                'bank_id'               => $bank_id,
                'debit_note_number'     => $debit_note_number,
                'premi'                 => $premi,
                'total_debitur'         => $total_debitur,
                'maturity_date'         => $marturity_date,
                'period_start'          => $period_start,
                'period_end'            => $period_end,
                'create_date'           => date('Y-m-d H:i:s'),
                'user_inp'              => $this->session->userdata('username'),
                'rowstate'              => 'planned'
                ));
    	}

        public function pay_confirm(){
            $data = array(
                'pay_method_id'     => $this->input->post('pay_method_id'),
                'bank_account_id'   => $this->input->post('bank_account_id'),
                'pay_date'          => date('Y-m-d', strtotime($this->input->post('pay_date'))),
                'summary'           => $this->input->post('summary'),
                'validation_code'   => $this->input->post('validation_code'),
                'rek_name'          => $this->input->post('rek_name'),
                'rek_number'        => $this->input->post('rek_number'),
                'confirm_date'      => date('Y-m-d H:i:s'),
                'user_confirm'      => $this->session->userdata('username'),
                'rowstate'          => 'confirmed'
            );
            $this->db->where('debit_note_id', $this->input->post('debit_note_id'));
            $this->db->update('debit_note', $data);
        }

        public function pay_closing($debit_note_id){
            $data = array(
                'closing_date'      => date('Y-m-d H:i:s'),
                'user_closing'      => $this->session->userdata('username'),
                'rowstate'          => 'closing'
            );
            $this->db->where('debit_note_id', $debit_note_id);
            $this->db->update('debit_note', $data);
        }
    }
?>
