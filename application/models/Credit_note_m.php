<?php
    class Credit_note_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('credit_note')->result();
        }

        function delete($id){
            $this->db->delete('credit_note', array('credit_note_id'=>$id));
    	}

    	public function last_number(){
    		$csql = "SELECT max(credit_note_id) as credit_note_id FROM credit_note";
    		return $this->db->query($csql)->row();
    	}

    	public function insert($credit_note_id, $bank_id, $credit_note_number, $premi, $marturity_date, $total_debitur, $period_start, $period_end){
    		$this->db->insert('credit_note',array(
                'credit_note_id'        => $credit_note_id,
                // 'bank_id_from'          => $bank_id,
                'bank_id'               => $bank_id,
                'credit_note_number'    => $credit_note_number,
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
    }
?>
