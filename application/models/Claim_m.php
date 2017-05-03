<?php
    class Claim_m extends CI_Model 
    {
        function getAll(){
            return $this->db->get('claim')->result();
        }

        function delete($id){
            $this->db->delete('claim', array('claim_id'=>$id));
    	}

        public function getById($claim_id){
            $query = "SELECT
                a.*, b.bank_id,
                b.policy_id,
                b.debitur_name,
                b.birth_place,
                b.datebirth,
                b.age,
                b.no_id,
                b.gender_id,
                c.job_name,
                b.sum_insured,
                b.period,
                b.period_start,
                b.period_end,
                b.underwriting_type,
                b.premi,
                b.premi_emep,
                d.bank_name,
                e.claim_type_name,
                f.rowstate_name
            FROM
                claim AS a,
                debitur AS b,
                job AS c,
                bank AS d,
                claim_type AS e,
                rowstate as f
            WHERE
                a.debitur_id = b.debitur_id
            AND b.job_id = c.job_id
            AND b.bank_id = d.bank_id
            AND a.claim_type_id = e.claim_type_id
            AND a.rowstate = f.rowstate
            AND a.claim_id = '$claim_id'";
            return $this->db->query($query)->row();
        }

    	public function insert(){
    		$insident_date = date('Y-m-d', strtotime($this->input->post('insident_date')));
    		$this->db->insert('claim',array(
    			'debitur_id' 			=> $this->input->post('debitur_id'),
    			'insident_date' 		=> $insident_date,
    			'claim_type_id' 		=> $this->input->post('claim_type_id'),
    			'claim_reason' 			=> $this->input->post('claim_reason'),
    			'sum_insured_proposed' 	=> $this->input->post('sum_insured_proposed'),
    			'create_date' 			=> date('Y-m-d H:i:s'),
    			'user_inp' 				=> $this->session->userdata('username'),
    			'rowstate' 				=> 15,
    			));
    		// CHANGE FLAG REFUND 
    		$debitur_data = array(
                'flag_claim'  	=> 1
            );
            $this->db->where('debitur_id', $this->input->post('debitur_id'));
            $this->db->update('debitur', $debitur_data);
    	}
    }
?>
