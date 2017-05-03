<?php
    class Rate_batch_m extends CI_Model 
    {
        function getAll(){
        	$query = "SELECT
				a.*,
				b.benefit_name
			FROM
				rate_batch AS a,
				benefit AS b
			WHERE
			a.benefit_id = b.benefit_id";
            return $this->db->query($query)->result();
        }

        function getById($rate_batch_id){
            $query = "SELECT
                a.*, 
                b.benefit_name,
                c.plan_id
            FROM
                rate_batch AS a,
                benefit AS b,
                product as c
            WHERE
                a.benefit_id = b.benefit_id
            AND a.product_id = c.product_id
            AND a.rate_batch_id = '$rate_batch_id'";
            return $this->db->query($query)->row();
        }

        function getProductId($id){
        	$query = "SELECT
				a.*,
				b.benefit_name
			FROM
				rate_batch AS a,
				benefit AS b
			WHERE
				a.benefit_id = b.benefit_id
			AND a.product_id = '$id'";
            return $this->db->query($query)->result();
        }

        public function check_state($rate_batch_id){
            $query = "SELECT b.rowstate,b.product_id from rate_batch as a, product as b 
            WHERE a.product_id = b.product_id 
            AND a.rate_batch_id = '$rate_batch_id'";
            return $this->db->query($query)->row();
        }

        function delete($rate_batch_id){
            $this->db->delete('rate_batch', array('rate_batch_id'=>$rate_batch_id));
            $this->db->delete('rate', array('rate_batch_id'=>$rate_batch_id));
    	}
        
        function insert($dataexcel, $product_id, $benefit_id, $period_start, $period_end){
        	$query = $this->db->query("SELECT MAX(rate_batch_id) as rate_batch_id FROM rate_batch");
            $row = $query->row();
            $rate_batch_id = $row->rate_batch_id + 1;
        	$this->db->insert('rate_batch',array(
        		'product_id' 		=> 	$product_id,
        		'rate_batch_id' 	=> 	$rate_batch_id,
                'benefit_id'		=>	$benefit_id,
                'period_start'		=>	$period_start,
                'period_end'		=>	$period_end,
                'user_inp' 			=> 	$this->session->userdata('username'),
                'create_date'		=>	date('Y-m-d'),
                'rowstate'			=>	'Planned'
                ));	

        	for ($i = 0; $i < count($dataexcel); $i++) {
                $this->db->insert('rate', array(
                	'rate_batch_id' => 	$rate_batch_id,
                    'period' 		=> 	$dataexcel[$i]['period'],
                    'min_age' 		=> 	$dataexcel[$i]['min_age'],
                    'max_age' 		=> 	$dataexcel[$i]['max_age'],
                    'rate' 			=> 	$dataexcel[$i]['rate'],
                    'user_inp' 		=> 	$this->session->userdata('username'),
                    'create_date'	=> 	date('Y-m-d'),
                    'rowstate' 		=> 	'Planned'
                ));
        	}
        }

    }
?>
