<script type="text/javascript">
    function ShowMK(){
        var term_loan_type_id = document.getElementById('term_loan_type_id');

        if(term_loan_type_id.value != ''){
            $("#ShowMK").load( SITE_PATH + 'ajax/show_mk/'+ term_loan_type_id.value);
        }
    }
</script>

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Informasi Umum
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a><!-- 
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a> -->
			<a href="javascript:;" class="reload">
			</a><!-- 
			<a href="javascript:;" class="remove">
			</a> -->
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form class="form-horizontal" role="form">
			<div class="form-body">
				<h3 class="form-section">Produk</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Nama Produk:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->product_name ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Informasi Cara Bayar:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->pay_method_name ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Jenis Kredit:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->credit_type_name ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Maksimal Bunga Pinjaman:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->max_interest_rate ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Mata Uang:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->currency_id ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Channel Distribusi:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->distribution_channel_name ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5">Jenis Resiko Pertanggungan:</label>
							<div class="col-md-7">
								<p class="form-control-static">
									 <?= $getProductById->risk_insurance_type_name ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section">Jenis Asuransi</h3>
				<?php $i = 1;?>
				<?php foreach ($getProductInsuranceType as $row) { ?>
				<div class="row">
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-2"><?= $i++ ?>.</label>
							<div class="col-md-10">
								<p class="form-control-static">
									 <?= $row->insurance_type_name ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Form Plan
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
				<!-- <h3 class="form-section">Person Info</h3> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Plan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="plan_name" id="plan_name" class="form-control" placeholder="Masukan Text" required="required">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Metode Hitung Usia
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="count_age_method_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<option></option>
							<?php foreach ($getCountAgeMethod as $row) { ?>
								<option value="<?= $row->count_age_method_id ?>"><?= $row->count_age_method_name ?></option>
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
							<input type="text" name="min_age_start" id="min_age_start" class="form-control" placeholder="Masukan Usia Minimum" required="required">
							</div>
							<div class="col-md-6">
							<input type="text" name="max_age_start" id="max_age_start" class="form-control" placeholder="Masukan Usia Maksimum" required="required">
							</div>
							</div>
							<span class="help-block">Dalam Tahun</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Maksumim Usia yang ditanggung
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="max_age" id="max_age" class="form-control" placeholder="Masukan Angka" required="required">
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
							<option></option>
							<?php foreach ($getTermLoanType as $row) { ?>
								<option value="<?= $row->term_loan_type_id ?>"><?= $row->term_loan_type_name ?></option>
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
							<input type="text" name="term_load_val" id="term_load_val" class="form-control" placeholder="Masukan Angka" required="required">
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
							<input type="text" name="pay_premium_period" id="pay_premium_period" class="form-control" placeholder="Masukan Angka">
							<span class="help-block">Dalam Tahun</span>
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
							<input type="text" name="min_sum_insured" id="min_sum_insured" class="form-control" placeholder="Masukan Minimum UP" required="required">
							</div>
							<div class="col-md-6">
							<input type="text" name="max_sum_insured" id="max_sum_insured" class="form-control" placeholder="Masukan Maksimum UP" required="required">
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
							<input type="text" name="claim_waiting_period" id="claim_waiting_period" class="form-control" placeholder="Masukan Angka">
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
							<select name="count_age_method_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<option></option>
							<?php foreach ($getParamPublishingCertificate as $row) { ?>
								<option value="<?= $row->param_publishing_certificate_id ?>"><?= $row->param_publishing_certificate_name ?></option>
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
							<option></option>
							<?php foreach ($getPayPremiumType as $row) { ?>
								<option value="<?= $row->pay_premium_type_id ?>"><?= $row->pay_premium_type_name ?></option>
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
							<input type="text" name="premi_refund_min" id="premi_refund_min" class="form-control" placeholder="Masukan Text" required="required">
							<span class="help-block"><?= $getProductById->currency_id ?></span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Formula Perhitungan Refund Premi
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="refund_formula_name" id="refund_formula_name" class="form-control" placeholder="Masukan Text" required="required">
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
								Diskon Perusahaan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="discount" id="discount" class="form-control" placeholder="Masukan Angka" required="required">
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
							<input type="text" name="commission" id="commission" class="form-control" placeholder="Masukan Angka" required="required">
							<span class="help-block">Dalam Persen (%) </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				
				
				<!--/row-->
				<!-- <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tingkat Bunga Pinjaman Maksimum
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="loan_interest_rate" id="loan_interest_rate" class="form-control" placeholder="Masukan Angka" required="required">
							<span class="help-block">Dalam Persen (%)</span>
						</div>
					</div>
					<!--/span-->
					<!-- <div class="col-md-6">
						
					</div> -->
					<!--/span-->
				<!-- </div> --> 
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Biaya Polis
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="polis_fee" id="polis_fee" class="form-control" placeholder="Masukan Angka" required="required">
							<span class="help-block"><?= $getProductById->currency_id ?></span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Informasi Target Produksi
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="production_target" id="production_target" class="form-control" placeholder="Masukan Angka" required="required">
							<span class="help-block"><?= $getProductById->currency_id ?></span>
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
							<input type="text" name="marketing_fee" id="marketing_fee" class="form-control" placeholder="Masukan Angka" required="required">
							<span class="help-block"><?= $getProductById->currency_id ?></span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('product/detail/'.$getProductById->product_id) ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>