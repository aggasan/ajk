<?php
    class Invoice_detail_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('invoice_detail')->result();
        }

        function delete($id){
            $this->db->delete('invoice_detail', array('invoice_detail_id'=>$id));
    	}

    	public function last_number(){
    		$csql = "SELECT max(invoice_detail_id) as invoice_detail_id FROM invoice_detail";
    		return $this->db->query($csql)->row();
    	}

    	public function insert($invoice_detail_id, $debit_note_id, $credit_note_id, $debitur_id, $premi){
    		$this->db->insert('invoice_detail',array(
                'invoice_detail_id'     => $invoice_detail_id,
                'debit_note_id'         => $debit_note_id,
                'credit_note_id'        => $credit_note_id,
                'debitur_id'            => $debitur_id,
                'premi'                 => $premi,
                'create_date'           => date('Y-m-d H:i:s'),
                'user_inp'              => $this->session->userdata('username'),
                'rowstate'              => 'planned'
                ));
    	}
    }
?>
