<?php 

class Ajax extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function show_mk($term_loan_type_id = ''){
		if($term_loan_type_id == 'Bulan'){
			$return = 'Dalam Bulan';
		} else if($term_loan_type_id == 'Tahun'){
			$return = 'Dalam Tahun';
		} else {
			$return = '';
		}
        echo $return;
	}

	public function show_batch_rate($rate_batch_id = ''){
        $this->load->model(array('Rate_batch_m'));
		
		$rate_batch = $this->Rate_batch_m->getById($rate_batch_id);

        echo json_encode($rate_batch);
    }

    public function show_rate($rate_batch_id = ''){
        $this->load->model(array('Rate_m'));
		
		$rate_batch = $this->Rate_m->getBatchById($rate_batch_id);
		$i = 1;
		$return = '';
		$return .= '<table class="table table-striped table-bordered table-hover sample_6">
							<thead>
								<tr>
									<th>
										 Min Usia
									</th>
									<th>
										 Max Usia
									</th>
									<th>
										 Periode
									</th>
									<th>
										 Rate
									</th>
								</tr>
							</thead>
						<tbody>';
      	foreach ($rate_batch as $m){
			$return .= '<tr>';
				$return .= '<td>'.$m->min_age.'</td>';
				$return .= '<td>'.$m->max_age.'</td>';
				$return .= '<td>'.$m->period.'</td>';
				$return .= '<td>'.$m->rate.'</td>';
			$return .= '</tr>';
		 }
		 	$return .= '</tbody>
					</table>';
        echo $return;
    }

    public function show_batch_underwriting($underwriting_batch_id = ''){
        $this->load->model(array('Underwriting_batch_m'));
		
		$rate_batch = $this->Underwriting_batch_m->getById($underwriting_batch_id);

        echo json_encode($rate_batch);
    }

    public function show_underwriting($underwriting_batch_id = ''){
        $this->load->model(array('Underwriting_m'));
		
		$underwriting_batch = $this->Underwriting_m->getBatchById($underwriting_batch_id);
		$i = 1;
		$return = '';
		$return .= '<table class="table table-striped table-bordered table-hover" id="sample_8">
							<thead>
								<tr>
									<th>
										 Min Usia
									</th>
									<th>
										 Max Usia
									</th>
									<th>
										 Min UP
									</th>
									<th>
										 Max UP
									</th>
									<th>
										 Tipe Medis
									</th>
								</tr>
							</thead>
						<tbody>';
      	foreach ($underwriting_batch as $m){
			$return .= '<tr>';
				$return .= '<td>'.$m->min_age.'</td>';
				$return .= '<td>'.$m->max_age.'</td>';
				$return .= '<td>'.number_format($m->sum_insured_min).'</td>';
				$return .= '<td>'.number_format($m->sum_insured_max).'</td>';
				$return .= '<td>'.$m->underwriting_type.'</td>';
			$return .= '</tr>';
		 }
		 	$return .= '</tbody>
					</table>';
        echo $return;
    }

    public function show_batch_decrease($decrease_batch_id = ''){
        $this->load->model(array('Decrease_batch_m'));
		
		$rate_batch = $this->Decrease_batch_m->getById($decrease_batch_id);

        echo json_encode($rate_batch);
    }

    public function show_decrease($decrease_batch_id = ''){
        $this->load->model(array('Decrease_m'));
		
		$decrease_batch = $this->Decrease_m->getBatchById($decrease_batch_id);
		$i = 1;
		$return = '';
		$return .= '<table class="table table-striped table-bordered table-hover sample_6">
							<thead>
								<tr>
									<th>
										 Min Usia
									</th>
									<th>
										 Max Usia
									</th>
									<th>
										 Periode
									</th>
									<th>
										 Penurunan
									</th>
								</tr>
							</thead>
						<tbody>';
      	foreach ($decrease_batch as $m){
			$return .= '<tr>';
				$return .= '<td>'.$m->min_age.'</td>';
				$return .= '<td>'.$m->max_age.'</td>';
				$return .= '<td>'.$m->period.'</td>';
				$return .= '<td>'.$m->decrease.'</td>';
			$return .= '</tr>';
		 }
		 	$return .= '</tbody>
					</table>';
        echo $return;
    }

    public function show_product_info($bank_id = ''){
        $this->load->model(array('Bank_m'));
		
		$rate_batch = $this->Bank_m->getProductId($bank_id);

        echo json_encode($rate_batch);
    }

    public function show_product_insurance_type($bank_id = ''){
        $this->load->model(array('Product_insurance_type_m'));
		
		$product_insurance_type = $this->Product_insurance_type_m->getByBankid($bank_id);
		$return = '';
		foreach ($product_insurance_type as $m) {
			# code...
			$return .= '<option value='.$m->insurance_type_id.'>'.$m->insurance_type_name.'</option>';
		}

		echo $return;
    }
}