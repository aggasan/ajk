<?php
    class Product_m extends CI_Model 
    {
        function getAll()
        {
            $csql="SELECT
                        a.*, b.pay_method_name,
                        c.credit_type_name,
                        d.risk_insurance_type_name
                    FROM
                        product AS a,
                        pay_method AS b,
                        credit_type AS c,
                        risk_insurance_type AS d
                    WHERE
                        a.pay_method_id = b.pay_method_id
                    AND a.credit_type_id = c.credit_type_id
                    AND a.risk_insurance_type_id = d.risk_insurance_type_id
                    AND a.rowstate = 'active'";
            return $this->db->query($csql)->result();
        }

        function getById($id)
        {
            $csql= "SELECT
                        a.*, b.pay_method_name,
                        c.credit_type_name,
                        d.risk_insurance_type_name,
                        e.distribution_channel_name,
                        f.product_type_name,
                        g.bank_collateral_type_name,
                        h.count_age_method_name,
                        i.term_loan_type_name,
                        j.param_publishing_certificate_name,
                        k.pay_premium_type_name,
                        l.currency_name,
                        m.refund_formula_name,
                        n.insurance_type_name,
                        o.creditur_type_name,
                        p.sum_insured_type_name
                    FROM
                        product AS a,
                        pay_method AS b,
                        credit_type AS c,
                        risk_insurance_type AS d,
                        distribution_channel AS e,
                        product_type AS f,
                        bank_collateral_type AS g,
                        count_age_method AS h,
                        term_loan_type AS i,
                        param_publishing_certificate AS j,
                        pay_premium_type AS k,
                        currency AS l,
                        refund_formula AS m,
                        insurance_type AS n,
                        creditur_type AS o,
                        sum_insured_type AS p

                    WHERE
                        a.pay_method_id = b.pay_method_id
                    AND a.credit_type_id = c.credit_type_id
                    AND a.risk_insurance_type_id = d.risk_insurance_type_id 
                    AND a.distribution_channel_id = e.distribution_channel_id
                    AND a.product_type_id = f.product_type_id
                    AND a.bank_collateral_type_id = g.bank_collateral_type_id
                    AND a.count_age_method_id = h.count_age_method_id
                    AND a.term_loan_type_id = i.term_loan_type_id
                    AND a.param_publishing_certificate_id = j.param_publishing_certificate_id
                    AND a.pay_premium_type_id = k.pay_premium_type_id
                    AND a.currency_id = l.currency_id
                    AND a.refund_formula_id = m.refund_formula_id
                    AND a.insurance_type_id = n.insurance_type_id
                    AND a.creditur_type_id = o.creditur_type_id
                    AND a.sum_insured_type_id = p.sum_insured_type_id
                    AND a.product_id = '$id'";
            return $this->db->query($csql)->row();
        }

        function getByBankId($bank_id = ''){
            $csql = "SELECT * from product as a, bank as b
                    WHERE a.product_id = b.product_id
                    AND b.bank_id = '$bank_id'";
            return $this->db->query($csql)->row();
        }

        function ProductInsuranceType($id)
        {
            $csql="SELECT 
                        a.*,b.insurance_type_name 
                    from 
                        product_insurance_type as a, insurance_type as b 
                    where
                        a.insurance_type_id = b.insurance_type_id
                    AND a.product_id = '$id'";
            return $this->db->query($csql)->result();
        }

        function insert(){
            $query = $this->db->query("SELECT MAX(product_id) as product_id FROM product");
            $row = $query->row();
            $product_id = $row->product_id + 1;
            $min_sum_insured    =   str_replace('.', '', $this->input->post('min_sum_insured'));
            $max_sum_insured    =   str_replace('.', '', $this->input->post('max_sum_insured'));
            $premi_refund_min   =   str_replace('.', '', $this->input->post('premi_refund_min'));
            $production_target  =   str_replace('.', '', $this->input->post('production_target'));
            $polis_fee          =   str_replace('.', '', $this->input->post('polis_fee'));
            $plan_id = 'AJK'.$this->input->post('insurance_type_id').$this->input->post('creditur_type_id').$this->input->post('credit_type_id').$this->input->post('sum_insured_type_id');
            $this->db->insert('product',
                array('product_id'          =>  $product_id,
                'insurance_type_id'         =>  $this->input->post('insurance_type_id'),
                'product_name'              =>  $this->input->post('product_name'),
                'plan_id'                   =>  $plan_id,
                'pay_method_id'             =>  $this->input->post('pay_method_id'),
                'credit_type_id'            =>  $this->input->post('credit_type_id'),
                'creditur_type_id'          =>  $this->input->post('creditur_type_id'),
                'sum_insured_type_id'       =>  $this->input->post('sum_insured_type_id'),
                'max_interest_rate'         =>  $this->input->post('max_interest_rate'),
                'currency_id'               =>  $this->input->post('currency_id'),
                'distribution_channel_id'   =>  $this->input->post('distribution_channel_id'),
                'risk_insurance_type_id'    =>  $this->input->post('risk_insurance_type_id'),
                'product_type_id'           =>  $this->input->post('product_type_id'),
                'bank_collateral_type_id'   =>  $this->input->post('bank_collateral_type_id'),
                'count_age_method_id'       =>  $this->input->post('count_age_method_id'),
                'premi_refund_min'          =>  $premi_refund_min,
                'discount'                  =>  $this->input->post('discount'),
                'commission'                =>  $this->input->post('commission'),
                'claim_waiting_period'      =>  $this->input->post('claim_waiting_period'),
                'min_age_start'             =>  $this->input->post('min_age_start'),
                'max_age_start'             =>  $this->input->post('max_age_start'),
                'max_age'                   =>  $this->input->post('max_age'),
                'param_publishing_certificate_id' => $this->input->post('param_publishing_certificate_id'),
                'term_loan_type_id'         =>  $this->input->post('term_loan_type_id'),
                'term_loan_val'             =>  $this->input->post('term_loan_val'),
                'pay_premium_period'        =>  $this->input->post('pay_premium_period'),
                'pay_premium_type_id'       =>  $this->input->post('pay_premium_type_id'),
                // 'loan_interest_rate' => $this->input->post('loan_interest_rate'),
                'min_sum_insured'           =>  $min_sum_insured,
                'max_sum_insured'           =>  $max_sum_insured,
                'polis_fee'                 =>  $polis_fee,
                'refund_formula_id'         =>  $this->input->post('refund_formula_id'),
                'broker_name'               =>  $this->input->post('broker_name'),
                'broker_commission'         =>  $this->input->post('broker_commission'),
                'marketing_fee'             =>  $this->input->post('marketing_fee'),
                'production_target'         =>  $production_target,
                'user_inp'                  =>  $this->session->userdata('username'),
                'create_date'               =>  date('Y-m-d H:i:s'),
                'rowstate'                  =>  'planned'
                ));

            $benefit_count = $this->input->post('benefit_id');
            foreach ($benefit_count as $selected_benefit) {
                # code...
                $benefit_type = $this->Benefit_m->getById($selected_benefit);
                $benefit_type_id = $benefit_type->benefit_type_id;
                $this->db->insert('benefit_product',
                    array('product_id'  =>  $product_id,
                    'benefit_type_id'   =>  $benefit_type_id,
                    'benefit_id'        =>  $selected_benefit,
                    'create_date'       =>  date('Y-m-d H:i:s'),
                    'rowstate'          =>  'planned'
                ));
            }

            $this->session->set_userdata('ses_product_id', $product_id);
           
        }

        function update($product_id){
            $min_sum_insured    =   str_replace('.', '', $this->input->post('min_sum_insured'));
            $max_sum_insured    =   str_replace('.', '', $this->input->post('max_sum_insured'));
            $premi_refund_min   =   str_replace('.', '', $this->input->post('premi_refund_min'));
            $plan_id = 'AJK'.$this->input->post('insurance_type_id').$this->input->post('creditur_type_id').$this->input->post('credit_type_id').$this->input->post('sum_insured_type_id');

            $data = array(
                'insurance_type_id'         =>  $this->input->post('insurance_type_id'),
                'product_name'              =>  $this->input->post('product_name'),
                'plan_id'                   =>  $plan_id,
                'pay_method_id'             =>  $this->input->post('pay_method_id'),
                'credit_type_id'            =>  $this->input->post('credit_type_id'),
                'creditur_type_id'          =>  $this->input->post('creditur_type_id'),
                'sum_insured_type_id'       =>  $this->input->post('sum_insured_type_id'),
                'max_interest_rate'         =>  $this->input->post('max_interest_rate'),
                'currency_id'               =>  $this->input->post('currency_id'),
                'distribution_channel_id'   =>  $this->input->post('distribution_channel_id'),
                'risk_insurance_type_id'    =>  $this->input->post('risk_insurance_type_id'),
                'product_type_id'           =>  $this->input->post('product_type_id'),
                'bank_collateral_type_id'   =>  $this->input->post('bank_collateral_type_id'),
                'count_age_method_id'       =>  $this->input->post('count_age_method_id'),
                'premi_refund_min'          =>  $premi_refund_min,
                'discount'                  =>  $this->input->post('discount'),
                'commission'                =>  $this->input->post('commission'),
                'claim_waiting_period'      =>  $this->input->post('claim_waiting_period'),
                'min_age_start'             =>  $this->input->post('min_age_start'),
                'max_age_start'             =>  $this->input->post('max_age_start'),
                'max_age'                   =>  $this->input->post('max_age'),
                'param_publishing_certificate_id' => $this->input->post('param_publishing_certificate_id'),
                'term_loan_type_id'         =>  $this->input->post('term_loan_type_id'),
                'term_loan_val'             =>  $this->input->post('term_loan_val'),
                'pay_premium_period'        =>  $this->input->post('pay_premium_period'),
                'pay_premium_type_id'       =>  $this->input->post('pay_premium_type_id'),
                'min_sum_insured'           =>  $min_sum_insured,
                'max_sum_insured'           =>  $max_sum_insured,
                'polis_fee'                 =>  $this->input->post('polis_fee'),
                'refund_formula_id'         =>  $this->input->post('refund_formula_id'),
                'broker_name'               =>  $this->input->post('broker_name'),
                'broker_commission'         =>  $this->input->post('broker_commission'),
                'marketing_fee'             =>  $this->input->post('marketing_fee'),
                'production_target'         =>  $this->input->post('production_target'),
                'user_update'               =>  $this->session->userdata('username'),
                'last_update'               =>  date('Y-m-d H:i:s'),
                'rowstate'                  =>  'planned'
            );
            $this->db->where('product_id', $product_id);
            $this->db->update('product', $data);

            // DELETE FIRST ON DEBITUR PREMI
            $this->db->delete('benefit_product', array('product_id'=>$product_id));
            // END DELETE FIRST ON DEBITUR PREMI
            $this->load->model('Benefit_type_m');
            
            $benefit_count = $this->input->post('benefit_id');
            foreach ($benefit_count as $selected_benefit) {
                # code...
                $benefit_type = $this->Benefit_m->getById($selected_benefit);
                $benefit_type_id = $benefit_type->benefit_type_id;
                $this->db->insert('benefit_product',
                    array('product_id'  =>  $product_id,
                    'benefit_type_id'   =>  $benefit_type_id,
                    'benefit_id'        =>  $selected_benefit,
                    'create_date'       =>  date('Y-m-d H:i:s'),
                    'rowstate'          =>  'planned'
                ));
            }
            
            $this->session->set_userdata('ses_product_id', $product_id);
        }

        public function confirm($product_id){
            $data = array(
                'rowstate'                  => 'active'
            );
            $this->db->where('product_id', $product_id);
            $this->db->update('product', $data);  
            $this->session->set_flashdata('success', 'Produk berhasil dikonfirmasi.');
        }
    }
?>
