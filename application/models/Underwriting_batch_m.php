<?php
    class Underwriting_batch_m extends CI_Model 
    {
        function getAll(){
        	$query = "SELECT * from underwriting_batch";
            return $this->db->query($query)->result();
        }

        function getById($underwriting_batch_id){
            $query = "SELECT
                *
            FROM
                underwriting_batch
            WHERE
               underwriting_batch_id = '$underwriting_batch_id'";
            return $this->db->query($query)->row();
        }

        function getProductId($id){
        	$query = "SELECT * from underwriting_batch where
			product_id = '$id'";
            return $this->db->query($query)->result();
        }

        public function check_state($underwriting_batch_id){
            $query = "SELECT b.rowstate,b.product_id from underwriting_batch as a, product as b 
            WHERE a.product_id = b.product_id 
            AND a.underwriting_batch_id = '$underwriting_batch_id'";
            return $this->db->query($query)->row();
        }

        function delete($underwriting_batch_id){
            $this->db->delete('underwriting_batch', array('underwriting_batch_id'=>$underwriting_batch_id));
            $this->db->delete('underwriting', array('underwriting_batch_id'=>$underwriting_batch_id));
    	}
        
        function insert($dataexcel, $product_id, $period_start, $period_end){
        	$query = $this->db->query("SELECT MAX(underwriting_batch_id) as underwriting_batch_id FROM underwriting_batch");
            $row = $query->row();
            $underwriting_batch_id = $row->underwriting_batch_id + 1;
        	$this->db->insert('underwriting_batch',array(
        		'product_id'              => $product_id,
        		'underwriting_batch_id'   => $underwriting_batch_id,
                'period_start'            => $period_start,
                'period_end'              => $period_end,
                'user_inp'                => $this->session->userdata('username'),
                'create_date'             => date('Y-m-d'),
                'rowstate'                => 'Planned'
                ));	

        	for ($i = 0; $i < count($dataexcel); $i++) {
                $this->db->insert('underwriting', array(
                    'underwriting_batch_id' => $underwriting_batch_id,
                    'min_age'               => $dataexcel[$i]['min_age'],
                    'max_age'               => $dataexcel[$i]['max_age'],
                    'sum_insured_min'       => $dataexcel[$i]['sum_insured_min'],
                    'sum_insured_max'       => $dataexcel[$i]['sum_insured_max'],
                    'underwriting'          => $dataexcel[$i]['underwriting'],
                    'underwriting_type'     => $dataexcel[$i]['underwriting_type'],
                    'user_inp'              => $this->session->userdata('username'),
                    'create_date'           => date('Y-m-d'),
                    'rowstate'              => 'Planned'
                ));
        	}
        }

    }
?>
