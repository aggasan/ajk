<?php
    class Debitur_m extends CI_Model 
    {
        public function getAll(){
            return $this->db->get('debitur')->result();
        }

        public function getById($debitur_id){
        	$query = "SELECT
					a.*, b.product_name,
					d.job_name,
					e.identity_type_name,
					g.bank_name,
                    i.rowstate_name,
                    j.business_field_name,
                    b.currency_id,
                    b.term_loan_type_id,
                    b.plan_id,
                    c.insurance_type_name
				FROM
					debitur AS a
                    LEFT JOIN business_field as j ON a.business_field_id = j.business_field_id
                    LEFT JOIN job AS d on a.job_id = d.job_id,
					product AS b,
                    insurance_type as c,
					identity_type AS e,
					bank AS g,
                    rowstate as i
                
				WHERE
					a.product_id = b.product_id
                AND b.insurance_type_id = c.insurance_type_id
				AND a.identity_type_id = e.identity_type_id
				AND a.bank_id = g.bank_id
                AND a.rowstate = i.rowstate
				AND a.debitur_id = '$debitur_id'";
			return $this->db->query($query)->row();
        }

        public function get_by_acceptance($bank_id, $period_start, $period_end){
            $query = "SELECT *,count(*) as debitur_total, sum(premi) as premi, sum(premi_emep) as premi_emep FROM debitur
                WHERE
                bank_id = '$bank_id'
                AND acceptance_insurance_date between '$period_start' and '$period_end'
                AND flag_pay_premium = 0
                AND rowstate = 6
                ";
            return $this->db->query($query)->row();
        }

        public function get_acceptance($bank_id, $period_start, $period_end){
            $query = "SELECT * FROM debitur
                WHERE
                bank_id = '$bank_id'
                AND acceptance_insurance_date between '$period_start' and '$period_end'
                AND flag_pay_premium = 0
                AND rowstate = 6
                ";
            return $this->db->query($query)->result();
        }

        public function get_total_info(){
            $bank_id = $this->session->userdata('bank_id');
            if($this->session->userdata('user_entity') == 3){
            $query = "SELECT count(*) as debitur_total, sum(premi) as premi, sum(premi_emep) as premi_emep, sum(sum_insured) as sum_insured FROM debitur WHERE bank_id = '$bank_id'";
            } else {
            $query = "SELECT count(*) as debitur_total, sum(premi) as premi, sum(premi_emep) as premi_emep, sum(sum_insured) as sum_insured FROM debitur";    
            }
            return $this->db->query($query)->row();
        }

        public function delete($id){
            $this->db->delete('debitur', array('debitur_id'=>$id));
    	}

    	public function last_number_id(){
    		$query = "SELECT MAX(debitur_id) as debitur_id FROM debitur";
    		return $this->db->query($query)->row();
    	}
 
    	public function insert(){
    		$this->load->model(array('Product_m','Underwriting_m','Rate_m','Policy_m'));
    		// LAST NUMBER DEBITUR ID
    		$debitur = $this->last_number_id();
    		$debitur_id = $debitur->debitur_id + 1;
    		// END LAST NUMBER DEBITUR ID
    		$bank_id 		= $this->session->userdata('bank_id');
    		$sum_insured 	=  $val_clean = str_replace('.', '', $this->input->post('sum_insured'));
    		// PRODUCT
            $product_id     = $this->input->post('product_id');
    		$val_product 	= $this->Product_m->getById($this->input->post('product_id'));
            $term_loan_type_id = $val_product->term_loan_type_id;
            $count_age_method_id = $val_product->count_age_method_id;
    		// END PRODUCT
    		// COUNT AGE
    		$datebirth 		= date('Y-m-d', strtotime($this->input->post('datebirth')));
            $period_start 	= date('Y-m-d', strtotime($this->input->post('period_start')));
            if($count_age_method_id == 1){
                $age = round((strtotime($period_start) - strtotime($datebirth))/(24*60*60*365.25));
            } elseif($count_age_method_id == 2){
                $dob = new DateTime($datebirth);
                $diff = $dob->diff(new DateTime($period_start));
                if ($diff->format('%m') > 6) {
                    $age = $diff->format('%y') + 1;
                } else {
                    $age = $diff->format('%y');
                }
            }
    		// END COUNT AGE
    		// COUNT PERIOD END
    		$period 	= $this->input->post('period');
            if($term_loan_type_id == 'Bulan'){
                $period_end = date('Y-m-d', strtotime('+'.$period.' months', strtotime($this->input->post('period_start'))));
            } else if($term_loan_type_id == 'Tahun'){
                $period_end = date('Y-m-d', strtotime('+'.$period.' years', strtotime($this->input->post('period_start'))));
            }
    		// END COUNT PERIOD END
    		// UNDREWRITING
    		$val_underwriting 	= $this->Underwriting_m->get($sum_insured, $age, $product_id);
    		$underwriting 		= $val_underwriting->underwriting;
    		$underwriting_type 	= $val_underwriting->underwriting_type;
    		$underwriting_id 	= $val_underwriting->underwriting_id;
    		// END UNDREWRITING
    		// POLICY
    		$val_policy = $this->Policy_m->get($bank_id, $product_id);
    		$policy_id 	= $val_policy->policy_id;
    		$last_number_certificate = $val_policy->last_number_certificate + 1;
    		// END POLICY
    		// CERTIFICATE
            $now = date('y');
			$certificate 		= str_pad($last_number_certificate,7,0,STR_PAD_LEFT);
    		$certificate_number = $policy_id.'-'.$now.$certificate;   		
    		// END CERTIFICATE
            // BENEFIT
            $benefit_count = $this->input->post('benefit_id');
                foreach ($benefit_count as $selected_benefit) {
                    # code...
                    // RATE AND PREMI
                    $val_rate   = $this->Rate_m->get($period, $age, $product_id, $selected_benefit);
                    $rate       = $val_rate->rate;
                    $premi      = ($rate / 1000) * $sum_insured;
                    $rate_id    = $val_rate->rate_id;
                    // END RATE AND PREMI
                    $this->db->insert('debitur_benefit',
                        array('debitur_id'  =>  $debitur_id,
                        'benefit_id'        =>  $selected_benefit,
                        'create_date'       =>  date('Y-m-d H:i:s'),
                        'user_inp'          =>  $this->session->userdata('username'),
                        'rowstate'          =>  'planned'
                    ));

                    $this->db->insert('debitur_premi',
                        array('debitur_id'  =>  $debitur_id,
                        'benefit_id'        =>  $selected_benefit,
                        'rate_id'           =>  $rate_id,
                        'rate'              =>  $rate,
                        'premi'             =>  $premi,
                        'create_date'       =>  date('Y-m-d H:i:s'),
                        'user_inp'          =>  $this->session->userdata('username'),
                        'rowstate'          =>  'planned'
                    ));
                }
            // END BENEFIT
            // RATE AND PREMI TOTAL
            $val_total      = $this->Rate_m->get_total($debitur_id);
            $rate_total     = round($val_total->rate_total,3);
            $premi_total    = round($val_total->premi_total,3);
            // END RATE AND PREMI TOTAL
    		// INSERT TO DEBITUR
    		$this->db->insert('debitur',array(
    			'debitur_id' 			=> $debitur_id,
    			'bank_id' 				=> $bank_id,
    			'product_id' 			=> $product_id,
    			'policy_id'		 		=> $policy_id,
    			'underwriting_id' 		=> $underwriting_id,
    			'certificate' 			=> $certificate,
    			'certificate_number' 	=> $certificate_number,
    			'no_akad' 				=> $this->input->post('no_akad'),
    			'debitur_name' 			=> $this->input->post('debitur_name'),
    			'datebirth' 			=> $datebirth,
    			'birth_place' 			=> $this->input->post('birth_place'),
    			'identity_type_id' 		=> $this->input->post('identity_type_id'),
    			'no_id' 				=> $this->input->post('no_id'),
    			'gender_id' 			=> $this->input->post('gender_id'),
    			'age'		 			=> $age,
    			'job_id' 				=> $this->input->post('job_id'),
    			'job_detail' 	        => $this->input->post('job_detail'),
    			'address'	 			=> $this->input->post('address'),
    			'city_name' 		    => $this->input->post('city_name'),
    			'handphone' 			=> $this->input->post('handphone'),
    			'phone' 				=> $this->input->post('phone'),
    			'email' 				=> $this->input->post('email'),
    			'sum_insured' 			=> $sum_insured,
    			'rate'					=> $rate_total,
    			'premi' 				=> $premi_total,
    			'underwriting' 			=> $underwriting,
    			'underwriting_type' 	=> $underwriting_type,
    			'period'	 			=> $this->input->post('period'),
                'period_start'          => $period_start,
                'period_end'            => $period_end,
    			'company_name' 			=> $this->input->post('company_name'),
                'business_field_id'     => $this->input->post('business_field_id'),
                'position'              => $this->input->post('position'),
                'company_address'       => $this->input->post('company_address'),
    			'create_date' 			=> date('Y-m-d H:i:s'),
    			'user_inp' 				=> $this->session->userdata('username'),
    			'rowstate' 				=> '1',
                'flag_agregat'          => 0,
                'flag_pay_premium'      => 0,
                'flag_refund'           => 0,
                'flag_claim'            => 0,
                'flag_upload_certificate'=>0,
                'flag_print_certificate'=> 0
    			));
    		// END INSERT TO DEBITUR
            // ADD HISTORY DEBITUR
            $note = 'Pengajuan asuransi';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR
    		// UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
    		$policy_data = array(
				'last_number_certificate' => $last_number_certificate
			);
			$this->db->where('policy_id', $policy_id);
			$this->db->update('policy', $policy_data);
    		// END UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
    		
            $this->session->set_userdata('ses_debitur_id', $debitur_id);
    	}

        public function update($debitur_id){
            $this->load->model(array('Product_m','Underwriting_m','Rate_m','Policy_m'));
            
            $bank_id        = $this->session->userdata('bank_id');
            $sum_insured    =  $val_clean = str_replace('.', '', $this->input->post('sum_insured'));
            // PRODUCT
            $product_id     = $this->input->post('product_id');
            $val_product    = $this->Product_m->getById($this->input->post('product_id'));
            $term_loan_type_id = $val_product->term_loan_type_id;
            // END PRODUCT
            // COUNT AGE
            $datebirth      = date('Y-m-d', strtotime($this->input->post('datebirth')));
            $period_start   = date('Y-m-d', strtotime($this->input->post('period_start')));
            $age            = round((strtotime($period_start) - strtotime($datebirth))/(24*60*60*365.25));
            // END COUNT AGE
            // COUNT PERIOD END
            $period     = $this->input->post('period');
            if($term_loan_type_id == 'Bulan'){
                $period_end = date('Y-m-d', strtotime('+'.$period.' months', strtotime($this->input->post('period_start'))));
                // print_r($period_end);
            } else if($term_loan_type_id == 'Tahun'){
                $period_end = date('Y-m-d', strtotime('+'.$period.' years', strtotime($this->input->post('period_start'))));
                // print_r($period_end);
            }
            // END COUNT PERIOD END
            // UNDREWRITING
            $val_underwriting   = $this->Underwriting_m->get($sum_insured, $age, $product_id);
            $underwriting       = $val_underwriting->underwriting;
            $underwriting_type  = $val_underwriting->underwriting_type;
            $underwriting_id    = $val_underwriting->underwriting_id;
            // END UNDREWRITING
            // POLICY
            $val_policy = $this->Policy_m->get($bank_id, $product_id);
            $policy_id  = $val_policy->policy_id;
            $last_number_certificate = $val_policy->last_number_certificate + 1;
            // END POLICY
            // CERTIFICATE
            $now = date('y');
            $certificate        = str_pad($last_number_certificate,7,0,STR_PAD_LEFT);
            $certificate_number = $policy_id.'-'.$now.$certificate;        
            // END CERTIFICATE

            // BENEFIT
            // DELETE FIRST ON DEBITUR PREMI
            $this->db->delete('debitur_premi', array('debitur_id'=>$debitur_id));
            // END DELETE FIRST ON DEBITUR PREMI
            $benefit_count = $this->input->post('benefit_id');
                foreach ($benefit_count as $selected_benefit) {
                    # code...
                    // RATE AND PREMI
                    $val_rate   = $this->Rate_m->get($period, $age, $product_id, $selected_benefit);
                    $rate       = $val_rate->rate;
                    $premi      = ($rate / 1000) * $sum_insured;
                    $rate_id    = $val_rate->rate_id;
                    // END RATE AND PREMI

                    $this->db->insert('debitur_benefit',
                        array('debitur_id'  =>  $debitur_id,
                        'benefit_id'        =>  $selected_benefit,
                        'create_date'       =>  date('Y-m-d H:i:s'),
                        'user_inp'          =>  $this->session->userdata('username'),
                        'rowstate'          =>  'planned'
                    ));

                    $this->db->insert('debitur_premi',
                        array('debitur_id'  =>  $debitur_id,
                        'benefit_id'        =>  $selected_benefit,
                        'rate_id'           =>  $rate_id,
                        'rate'              =>  $rate,
                        'premi'             =>  $premi,
                        'create_date'       =>  date('Y-m-d H:i:s'),
                        'user_inp'          =>  $this->session->userdata('username'),
                        'rowstate'          =>  'planned'
                    ));
                }
            // END BENEFIT
            // RATE AND PREMI TOTAL
            $val_total      = $this->Rate_m->get_total($debitur_id);
            $rate_total     = round($val_total->rate_total,3);
            $premi_total    = round($val_total->premi_total,3);
            // END RATE AND PREMI TOTAL
            // UPDATE TO DEBITUR
            $policy_data = array(
                'bank_id'               => $bank_id,
                'product_id'            => $product_id,
                'policy_id'             => $policy_id,
                'underwriting_id'       => $underwriting_id,
                // 'certificate'           => $certificate,
                // 'certificate_number'    => $certificate_number,
                'no_akad'               => $this->input->post('no_akad'),
                'debitur_name'          => $this->input->post('debitur_name'),
                'datebirth'             => $datebirth,
                'birth_place'           => $this->input->post('birth_place'),
                'identity_type_id'      => $this->input->post('identity_type_id'),
                'no_id'                 => $this->input->post('no_id'),
                'gender_id'             => $this->input->post('gender_id'),
                'age'                   => $age,
                'job_id'                => $this->input->post('job_id'),
                'job_detail'            => $this->input->post('job_detail'),
                'address'               => $this->input->post('address'),
                'city_name'             => $this->input->post('city_name'),
                'handphone'             => $this->input->post('handphone'),
                'phone'                 => $this->input->post('phone'),
                'email'                 => $this->input->post('email'),
                'sum_insured'           => $sum_insured,
                'rate'                  => $rate_total,
                'premi'                 => $premi_total,
                'underwriting'          => $underwriting,
                'underwriting_type'     => $underwriting_type,
                'period'                => $this->input->post('period'),
                'period_start'          => $period_start,
                'period_end'            => $period_end,
                'company_name'          => $this->input->post('company_name'),
                'business_field_id'     => $this->input->post('business_field_id'),
                'position'              => $this->input->post('position'),
                'company_address'       => $this->input->post('company_address'),
                'create_date'           => date('Y-m-d H:i:s'),
                'user_inp'              => $this->session->userdata('username'),
                'rowstate'              => '1',
                'flag_pay_premium'      => 0
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $policy_data);
            // END UPDATE TO DEBITUR
            // ADD HISTORY DEBITUR
            $note = 'Data debitur diedit.';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR
            // UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
            $policy_data = array(
                'last_number_certificate' => $last_number_certificate
            );
            $this->db->where('policy_id', $policy_id);
            $this->db->update('policy', $policy_data);
            // END UPDATE TABLE POLICY FOR LAST NUMBER CERTIFICATE
            
            $this->session->set_userdata('ses_debitur_id', $debitur_id);
        }

        public function count_premi($debitur_id){
            $this->load->model(array('Rate_m','Debitur_premi_m','Underwriting_m'));
            // COUNT PREMI
            $val_debitur = $this->getById($debitur_id);
            $benefit_count = $this->Debitur_premi_m->getByDebitur($debitur_id);
            foreach ($benefit_count as $selected_benefit) {
                # code...
                $benefit_id = $selected_benefit->benefit_id;
                $val_rate   = $this->Rate_m->get($val_debitur->period, $val_debitur->age, $val_debitur->product_id, $benefit_id, $val_debitur->period);

                $rate       = $val_rate->rate;
                $premi      = ($rate / 1000) * $val_debitur->sum_insured;
                $rate_id    = $val_rate->rate_id;
                $debitur_premi_data = array(
                    'rate_id'           =>  $rate_id,
                    'rate'              =>  $rate,
                    'premi'             =>  $premi
                );
                $this->db->where('debitur_id', $debitur_id);
                $this->db->update('debitur_premi', $debitur_premi_data);
            }

            $val_total      = $this->Rate_m->get_total($debitur_id);
            $rate_total     = round($val_total->rate_total,3);
            $premi_total    = round($val_total->premi_total,3);
            // END COUNT PREMI
            // UNDREWRITING
            $val_underwriting   = $this->Underwriting_m->get($val_debitur->sum_insured, $val_debitur->age, $val_debitur->product_id);
            $underwriting       = $val_underwriting->underwriting;
            $underwriting_type  = $val_underwriting->underwriting_type;
            $underwriting_id    = $val_underwriting->underwriting_id;
            // END UNDREWRITING
            // UPDATE TO DEBITUR
            $debitur_data = array(
                'rate'                  => $rate_total,
                'premi'                 => $premi_total,
                'underwriting'          => $underwriting,
                'underwriting_type'     => $underwriting_type,
                'underwriting_id'       => $underwriting_id
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $debitur_data);
            // END UPDATE TO DEBITUR
            
            $this->session->set_flashdata('success', 'Premi '.$val_debitur->debitur_name.' berhasil dihitung.');
        }

        public function confirm($debitur_id){
            $val_debitur = $this->getById($debitur_id);
            if($this->session->userdata('user_entity') == 3){
                if($val_debitur->underwriting == 'FCL'){
                    $debitur_data = array(
                        'rowstate'                  => 6,
                        'confirm_bank'              => 1,
                        'confirm_checker'           => 1,                        
                        'confirm_insurance'         => 1,
                        'confirm_bank_date'         => date('Y-m-d H:i:s'),
                        'confirm_checker_date'      => date('Y-m-d H:i:s'),
                        'confirm_insurance_date'    => date('Y-m-d H:i:s'),                     
                        'acceptance_insurance_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('debitur_id', $debitur_id);
                    $this->db->update('debitur', $debitur_data);
                    // ADD HISTORY DEBITUR
                    $note = 'Debitur FCL otomatis akseptasi.';
                    $this->Debitur_note_m->insert($debitur_id, $note);
                    // END ADD HISTORY DEBITUR    
                } else if($val_debitur->underwriting == 'NM'){
                    $debitur_data = array(
                        'rowstate'                  => 3,
                        'confirm_bank'              => 1,
                        'confirm_checker'           => 1,    
                        'confirm_bank_date'         => date('Y-m-d H:i:s'),
                        'confirm_checker_date'      => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('debitur_id', $debitur_id);
                    $this->db->update('debitur', $debitur_data);
                    // ADD HISTORY DEBITUR
                    $note = 'Debitur dikonfirmasi oleh Perusahaan/Client.';
                    $this->Debitur_note_m->insert($debitur_id, $note);
                    // END ADD HISTORY DEBITUR      
                } else if($val_debitur->underwriting == 'M'){
                    $debitur_data = array(
                        'rowstate'                  => 3,
                        'confirm_bank'              => 1,
                        'confirm_checker'           => 1,    
                        'confirm_bank_date'         => date('Y-m-d H:i:s'),
                        'confirm_checker_date'      => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('debitur_id', $debitur_id);
                    $this->db->update('debitur', $debitur_data); 
                    $note = 'Debitur dikonfirmasi oleh Perusahaan/Client.';
                    $this->Debitur_note_m->insert($debitur_id, $note); 
                }
            } else if($this->session->userdata('user_entity') == 4) {
                $debitur_data = array(
                    'rowstate'                      => 3,
                    'confirm_checker'               => 1,
                    'confirm_checker_date'          => date('Y-m-d H:i:s')
                );
                $this->db->where('debitur_id', $debitur_id);
                $this->db->update('debitur', $debitur_data);
                // ADD HISTORY DEBITUR
                $note = 'Debitur dikonfirmasi oleh Broker.';
                $this->Debitur_note_m->insert($debitur_id, $note);
                // END ADD HISTORY DEBITUR     
            } else if($this->session->userdata('user_entity') == 2) {
                $debitur_data = array(
                    'rowstate'                      => 4,
                    'confirm_insurance'             => 1,
                    'confirm_insurance_date'        => date('Y-m-d H:i:s')
                );
                $this->db->where('debitur_id', $debitur_id);
                $this->db->update('debitur', $debitur_data);
                // ADD HISTORY DEBITUR
                $note = 'Debitur dikonfirmasi oleh Asuransi.';
                $this->Debitur_note_m->insert($debitur_id, $note);
                // END ADD HISTORY DEBITUR     
            }

            $this->session->set_flashdata('success', 'Data Debitur '.$val_debitur->debitur_name.' berhasil dikonfirmasi.');
        }

        public function acceptance($debitur_id, $rowstate){
            $debitur_data = array(
                'rowstate'      => $rowstate,                        
                'acceptance_insurance_date' => date('Y-m-d H:i:s'),
                'user_acceptance'           => $this->session->userdata('username')
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $debitur_data);
            // ADD HISTORY DEBITUR
            $note = 'Debitur diakseptasi oleh Asuransi.';
            $this->Debitur_note_m->insert($debitur_id, $note);
            // END ADD HISTORY DEBITUR         
        }

        public function update_flag_sertificate_upload($debitur_id){
            $data = array(
                'flag_upload_certificate' => 1,
                'certificate_number' => $this->input->post('certificate_number')
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $data);
        }

        public function update_flag_sertificate_download($debitur_id){
            $data = array(
                'flag_print_certificate' => 1
            );
            $this->db->where('debitur_id', $debitur_id);
            $this->db->update('debitur', $data);
        }
    }
?>
