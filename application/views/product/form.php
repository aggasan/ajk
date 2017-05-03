<!-- INPUT MASK CURRENCY-->
<script type="text/javascript">
	$(document).ready(function(){
  		$('.money').inputmask("numeric", {
		    radixPoint: ".",
		    groupSeparator: ",",
		    digits: 2,
		    autoGroup: true,
		    // prefix: '$', //No Space, this will truncate the first character
		    rightAlign: false,
		    min: 0,
		    max: 100,
		    // integer: { min: 0, max: 255 },
		    oncleared: function() {
		    	self.value('');
			}
		});
	});
</script>
<script type="text/javascript">
    function ShowMK(){
        var term_loan_type_id = document.getElementById('term_loan_type_id');

        if(term_loan_type_id.value != ''){
            $("#ShowMK").load( SITE_PATH + 'ajax/show_mk/'+ term_loan_type_id.value);
        }
    }
</script>

<script type="text/javascript">
$(window).load(function() {
  $('.checkid1').attr('disabled', true);
});
</script>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-docs"></i>Form Produk
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			</a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?= site_url(uri_string()) ?>" method="post" class="horizontal-form">
			<div class="form-body">
				<h3 class="form-section">Informasi Umum</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Produk
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="product_name" value="<?= isset($get_product->product_name)?$get_product->product_name:'' ?>" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="insurance_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $insurance_type_id = isset($get_product->insurance_type_id)?$get_product->insurance_type_id:'' ?>
							<option></option>
							<?php foreach ($getInsuranceType as $row) { ?>
								<option 
								<?php if($insurance_type_id == $row->insurance_type_id ) echo "selected"; ?> 
								value="<?= $row->insurance_type_id ?>"><?= $row->insurance_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Produk
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="product_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $product_type_id = isset($get_product->product_type_id)?$get_product->product_type_id:'' ?>
							<option></option>
							<?php foreach ($getProductType as $row) { ?>
								<option 
								<?php if($product_type_id == $row->product_type_id ) echo "selected"; ?> 
								value="<?= $row->product_type_id ?>"><?= $row->product_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Kredit
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="credit_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $credit_type_id = isset($get_product->credit_type_id)?$get_product->credit_type_id:'' ?>
							<option></option>
							<?php foreach ($getCreditType as $row) { ?>
								<option 
								<?php if($credit_type_id == $row->credit_type_id ) echo "selected"; ?> 
								value="<?= $row->credit_type_id ?>"><?= $row->credit_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Kreditur
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="creditur_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $creditur_type_id = isset($get_product->creditur_type_id)?$get_product->creditur_type_id:'' ?>
							<option></option>
							<?php foreach ($getCrediturType as $row) { ?>
								<option 
								<?php if($creditur_type_id == $row->creditur_type_id ) echo "selected"; ?> 
								value="<?= $row->creditur_type_id ?>"><?= $row->creditur_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Uang Pertanggungan
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="sum_insured_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $sum_insured_type_id = isset($get_product->sum_insured_type_id)?$get_product->sum_insured_type_id:'' ?>
							<option></option>
							<?php foreach ($getSumInsuredType as $row) { ?>
								<option 
								<?php if($sum_insured_type_id == $row->sum_insured_type_id ) echo "selected"; ?> 
								value="<?= $row->sum_insured_type_id ?>"><?= $row->sum_insured_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Agunan
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="bank_collateral_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $bank_collateral_type_id = isset($get_product->bank_collateral_type_id)?$get_product->bank_collateral_type_id:'' ?>
							<option></option>
							<?php foreach ($getBankCollateralType as $row) { ?>
								<option 
								<?php if($bank_collateral_type_id == $row->bank_collateral_type_id ) echo "selected"; ?> 
								value="<?= $row->bank_collateral_type_id ?>"><?= $row->bank_collateral_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tingkat Bunga Pinjaman Maksimum
								<span class="required" aria-required="true">*</span>
							</label>
							<input name="max_interest_rate" value="<?= isset($get_product->max_interest_rate)?$get_product->max_interest_rate:'' ?>" required="required" type="text" class="form-control" placeholder="Masukan Angka" tabindex="1">
							<span class="help-block">Dalam Persen (%). </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Mata Uang
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="currency_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $currency_id = isset($get_product->currency_id)?$get_product->currency_id:'' ?>
							<option></option>
							<?php foreach ($getCurrency as $row) { ?>
								<option 
								<?php if($currency_id == $row->currency_id ) echo "selected"; ?> 
								value="<?= $row->currency_id ?>"><?= $row->currency_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Channel Distribusi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="distribution_channel_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $distribution_channel_id = isset($get_product->distribution_channel_id)?$get_product->distribution_channel_id:'' ?>
							<option></option>
							<?php foreach ($getDistributionChannel as $row) { ?>
								<option 
								<?php if($distribution_channel_id == $row->distribution_channel_id ) echo "selected"; ?> 
								value="<?= $row->distribution_channel_id ?>"><?= $row->distribution_channel_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Resiko Pertanggungan
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="risk_insurance_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $risk_insurance_type_id = isset($get_product->risk_insurance_type_id)?$get_product->risk_insurance_type_id:'' ?>
							<option></option>
							<?php foreach ($getRiskInsuranceType as $row) { ?>
								<option 
								<?php if($risk_insurance_type_id == $row->risk_insurance_type_id ) echo "selected"; ?> 
								value="<?= $row->risk_insurance_type_id ?>"><?= $row->risk_insurance_type_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Mekanisme Pembayaran
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="pay_method_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $pay_method_id = isset($get_product->pay_method_id)?$get_product->pay_method_id:'' ?>
							<option></option>
							<?php foreach ($getPayMethod as $row) { ?>
								<option 
								<?php if($pay_method_id == $row->pay_method_id ) echo "selected"; ?> 
								value="<?= $row->pay_method_id ?>"><?= $row->pay_method_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section">Parameter Produk</h3>
				<div class="row">
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Metode Hitung Usia
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="count_age_method_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $count_age_method_id = isset($get_product->count_age_method_id)?$get_product->count_age_method_id:'' ?>
							<option></option>
							<?php foreach ($getCountAgeMethod as $row) { ?>
								<option 
								<?php if($count_age_method_id == $row->count_age_method_id ) echo "selected"; ?> 
								value="<?= $row->count_age_method_id ?>"><?= $row->count_age_method_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Range Usia Masuk Tertanggung
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="row">
							<div class="col-md-6">
							<input type="text" name="min_age_start" value="<?= isset($get_product->min_age_start)?$get_product->min_age_start:'' ?>" id="min_age_start" class="form-control" placeholder="Masukan Usia Minimum" required="required" tabindex="1">
							</div>
							<div class="col-md-6">
							<input type="text" name="max_age_start" value="<?= isset($get_product->max_age_start)?$get_product->max_age_start:'' ?>" id="max_age_start" class="form-control" placeholder="Masukan Usia Maksimum" required="required" tabindex="1">
							</div>
							</div>
							<span class="help-block">Dalam Tahun</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Maksimum Usia Pertanggungan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="max_age" value="<?= isset($get_product->max_age)?$get_product->max_age:'' ?>" id="max_age" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">Dalam Tahun </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jangka Waktu Pinjaman (MK)
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="term_loan_type_id" id="term_loan_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1" onchange="ShowMK()">
							<?= $term_loan_type_id = isset($get_product->term_loan_type_id)?$get_product->term_loan_type_id:'' ?>
							<option></option>
							<?php foreach ($getTermLoanType as $row) { ?>
								<option 
								<?php if($term_loan_type_id == $row->term_loan_type_id ) echo "selected"; ?> 
								value="<?= $row->term_loan_type_id ?>"><?= $row->term_loan_type_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">Dalam Persen (%)</span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Maksimum Jangka Waktu Pinjaman
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="term_loan_val" value="<?= isset($get_product->term_loan_val)?$get_product->term_loan_val:'' ?>" id="term_loan_val" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block" id="ShowMK"></span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Masa Pembayaran Premi (MPP)
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="pay_premium_period" value="<?= isset($get_product->pay_premium_period)?$get_product->pay_premium_period:'' ?>" id="pay_premium_period" class="form-control" placeholder="Masukan Angka" tabindex="1">
							<!-- <span class="help-block">Dalam Hari</span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Range Nilai Uang Pertanggungan
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="row">
							<div class="col-md-6">
							<input type="text" name="min_sum_insured" value="<?= isset($get_product->min_sum_insured)?$get_product->min_sum_insured:'' ?>" id="min_sum_insured" class="form-control money" placeholder="Masukan Minimum UP" required="required" tabindex="1">
							</div>
							<div class="col-md-6">
							<input type="text" name="max_sum_insured" value="<?= isset($get_product->max_sum_insured)?$get_product->max_sum_insured:'' ?>" id="max_sum_insured" class="form-control money" placeholder="Masukan Maksimum UP" required="required" tabindex="1">
							</div>
							</div>
							<!-- <span class="help-block">Dalam Tahun</span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Masa Tunggu Klaim
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="claim_waiting_period" value="<?= isset($get_product->claim_waiting_period)?$get_product->claim_waiting_period:'' ?>" id="claim_waiting_period" class="form-control" placeholder="Masukan Angka" tabindex="1">
							<span class="help-block">Dalam Hari</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Pengaturan Penerbitan sertifikat
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="param_publishing_certificate_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $param_publishing_certificate_id = isset($get_product->param_publishing_certificate_id)?$get_product->param_publishing_certificate_id:'' ?>
							<option></option>
							<?php foreach ($getParamPublishingCertificate as $row) { ?>
								<option 
								<?php if($param_publishing_certificate_id == $row->param_publishing_certificate_id ) echo "selected"; ?> 
								value="<?= $row->param_publishing_certificate_id ?>"><?= $row->param_publishing_certificate_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">Dalam Persen (%) </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Cara Bayar Premi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="pay_premium_type_id" id="pay_premium_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $pay_premium_type_id = isset($get_product->pay_premium_type_id)?$get_product->pay_premium_type_id:'' ?>
							<option></option>
							<?php foreach ($getPayPremiumType as $row) { ?>
								<option 
								<?php if($pay_premium_type_id == $row->pay_premium_type_id ) echo "selected"; ?> 
								value="<?= $row->pay_premium_type_id ?>"><?= $row->pay_premium_type_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">Dalam Persen (%)</span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						
					</div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nilai Minimal Refund Premi
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="premi_refund_min" value="<?= isset($get_product->max_interest_rate)?$get_product->max_interest_rate:'' ?>" id="premi_refund_min" class="form-control money" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block"><?= $getProductById->currency_id ?></span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Formula Perhitungan Refund Premi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="refund_formula_id" id="refund_formula_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $refund_formula_id = isset($get_product->refund_formula_id)?$get_product->refund_formula_id:'' ?>
							<option></option>
							<?php foreach ($getRefundFormula as $row) { ?>
								<option 
								<?php if($refund_formula_id == $row->refund_formula_id ) echo "selected"; ?> 
								value="<?= $row->refund_formula_id ?>"><?= $row->refund_formula_name ?></option>
							<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Broker/Pihak Ketiga
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="broker_name" value="<?= isset($get_product->broker_name)?$get_product->broker_name:'' ?>" id="broker_name" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block"></span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Komisi Broker/Pihak Ketiga
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="broker_commission" value="<?= isset($get_product->broker_commission)?$get_product->broker_commission:'' ?>" id="broker_commission" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">Dalam Persen (%) </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Diskon Perusahaan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="discount" value="<?= isset($get_product->discount)?$get_product->discount:'' ?>" id="discount" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">Dalam Persen (%)</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Komisi Perusahaan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="commission" value="<?= isset($get_product->commission)?$get_product->commission:'' ?>" id="commission" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">Dalam Persen (%) </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Biaya Polis
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="polis_fee" value="<?= isset($get_product->polis_fee)?$get_product->polis_fee:'' ?>" id="polis_fee" class="form-control money" placeholder="Masukan Angka" required="required" tabindex="1">
							<!-- <span class="help-block"><?= $getProductById->currency_id ?></span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Informasi Target Produksi
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="production_target" value="<?= isset($get_product->production_target)?$get_product->production_target:'' ?>" id="production_target" class="form-control money" placeholder="Masukan Angka" required="required" tabindex="1">
							<!-- <span class="help-block"><?= $getProductById->currency_id ?></span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Marketing Fee
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="marketing_fee" value="<?= isset($get_product->marketing_fee)?$get_product->marketing_fee:'' ?>" id="marketing_fee" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">Dalam Persen (%). </span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section">Benefit</h3>
				<div class="row">
					<?php foreach ($getBenefitType as $row) { ?>
					<div class="row">
						<!--/span-->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-2"><?= $row->benefit_type_name ?>:</label>
								<?php 
									$i = 1;
									$benefit_type_id = $row->benefit_type_id;
									$product_id = isset($get_product->product_id)?$get_product->product_id:'';
									$getBenefitProduct = $this->Benefit_product_m->get_id($product_id,$benefit_type_id);
								?>
								<?php if($row->benefit_type_id == 1) { ?>
									<div class="input-group">
										<div class="icheck-inline">
											<?php foreach ($getBenefitProduct as $val) { ?>
											<?php if(is_null($val->benefit_product_id)){
													$checked = "checked"; 
													} else {
													$checked = "checked";
													} ?>
												<label>
												<input type="checkbox" <?= $checked ?> name="benefit_id[]" value="<?= $val->benefit_id ?>" class="icheck" ><?= $val->benefit_code ?> - <?= $val->benefit_name ?></label><br>
											<?php } ?>
										</div>
									</div>
								<?php } else { ?>
									<div class="input-group">
										<?php foreach ($getBenefitProduct as $val) { ?>
												<?php if(is_null($val->benefit_product_id)){
													$checked = ""; 
													} else {
													$checked = "checked";
													} ?>
										<div class="icheck-inline">
											
												<label>
												<input type="checkbox" <?= $checked ?> name="benefit_id[]" value="<?= $val->benefit_id ?>" class="icheck"><?= $val->benefit_code ?> - <?= $val->benefit_name ?></label>
											
										</div>
										<?php } ?>
									</div>
									<!-- <span class="help-block">This is inline help </span> -->
								<?php } ?>
							</div>
						</div>
					</div>
					<!--/row-->
					<?php } ?>
				</div>
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('product') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="<?= $button_form ?>" onclick="return confirm('Proses data produk?')"/>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>