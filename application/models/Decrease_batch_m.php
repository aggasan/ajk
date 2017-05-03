<?php
    class Decrease_batch_m extends CI_Model 
    {
        function getAll(){
        	$query = "SELECT
				*
			FROM
				decrease_batch";
            return $this->db->query($query)->result();
        }

        function getById($decrease_batch_id){
            $query = "SELECT
                *
            FROM
                decrease_batch
               
            WHERE decrease_batch_id = '$decrease_batch_id'";
            return $this->db->query($query)->row();
        }

        function getProductId($id){
        	$query = "SELECT
				*
			FROM
				decrease_batch
			WHERE
            product_id = '$id'";
            return $this->db->query($query)->result();
        }

        public function check_state($decrease_batch_id){
            $query = "SELECT b.rowstate,b.product_id from decrease_batch as a, product as b 
            WHERE a.product_id = b.product_id 
            AND a.decrease_batch_id = '$decrease_batch_id'";
            return $this->db->query($query)->row();
        }

        function delete($decrease_batch_id){
            $this->db->delete('decrease_batch', array('decrease_batch_id'=>$decrease_batch_id));
            $this->db->delete('decrease', array('decrease_batch_id'=>$decrease_batch_id));
    	}
        
        function insert($dataexcel, $product_id, $period_start, $period_end){
        	$query = $this->db->query("SELECT MAX(decrease_batch_id) as decrease_batch_id FROM decrease_batch");
            $row = $query->row();
            $decrease_batch_id = $row->decrease_batch_id + 1;
        	$this->db->insert('decrease_batch',array(
        		'product_id' 		=> 	$product_id,
        		'decrease_batch_id' => 	$decrease_batch_id,
                'period_start'		=>	$period_start,
                'period_end'		=>	$period_end,
                'user_inp' 			=> 	$this->session->userdata('username'),
                'create_date'		=>	date('Y-m-d'),
                'rowstate'			=>	'Planned'
                ));	

        	for ($i = 0; $i < count($dataexcel); $i++) {
                $this->db->insert('decrease', array(
                	'decrease_batch_id' => 	$decrease_batch_id,
                    'period' 		=> 	$dataexcel[$i]['period'],
                    'min_age' 		=> 	$dataexcel[$i]['min_age'],
                    'max_age' 		=> 	$dataexcel[$i]['max_age'],
                    'decrease' 		=> 	$dataexcel[$i]['rate'],
                    'user_inp' 		=> 	$this->session->userdata('username'),
                    'create_date'	=> 	date('Y-m-d'),
                    'rowstate' 		=> 	'Planned'
                ));
        	}
        }

    }
?>
