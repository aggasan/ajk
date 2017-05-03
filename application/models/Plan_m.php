<?php
    class Plan_m extends CI_Model 
    {
        function getAll($id)
        {
            $csql=" select a.*,b.term_loan_type_name from plan as a, term_loan_type as b where a.term_loan_type_id = b.term_loan_type_id and a.product_id = '$id'";
            return $this->db->query($csql)->result();
        }

        function delete($id){
            $this->db->delete('insurance_type', array('insurance_type_id'=>$id));
    	}
        
        function insert($id){
            $data = array(
                'product_id' => $id,
                'plan_name' => $this->input->post('plan_name'),
                
                'create_date' => date('Y-m-d'),
                'rowstate' => 'Planned',
            );
            $this->db->insert('plan', $data);

            // $this->session->set_flashdata('flagTabPlan', 'active');
        }
        
    }
?>
