<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Generate Polis Master
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
				<h3 class="form-section">Perusahaan / Client</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Perusahaan/Client
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="bank_id" required="required" class="select2_category form-control bank_id" id="bank_id" data-placeholder="Pilih Perusahaan / Client">
								<?php $bank_id = isset($get_policy->bank_id)?$get_policy->bank_id:''; ?>
								<option></option>
								<?php foreach ($getBank as $row) { ?>
								<option 
								<?php if($bank_id == $row->bank_id ) echo "selected"; ?> 
								value="<?= $row->bank_id ?>"><?= $row->bank_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Produk
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="product_id" required="required" class="select2_category form-control bank_id" id="product_id" data-placeholder="Pilih salah satu">
								<?php $product_id = isset($get_policy->product_id)?$get_policy->product_id:''; ?>
								<option></option>
								<?php foreach ($getProduct as $row) { ?>
								<option 
								 <?php if($product_id == $row->product_id ) echo "selected"; ?> 
								 value="<?= $row->product_id ?>"><?= $row->product_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->			
				</div>
				<h3 class="form-section">Informasi Umum Polis</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Masa Tunggu Klaim
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="waiting_period" value="<?php echo isset($get_policy->waiting_period)?$get_policy->waiting_period:''?>" class="form-control" placeholder="Masukan angka" required="required">
							<span class="help-block">Dalam Hari</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Grace Period
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="grace_period" value="<?php echo isset($get_policy->grace_period)?$get_policy->grace_period:''?>" class="form-control" placeholder="Masukan angka" required="required">
							<span class="help-block">Dalam Hari</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Flag Cetak Sertifikat
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="print_certificate" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<?php $print_certificate = isset($get_policy->print_certificate)?$get_policy->print_certificate:''; ?>
								<option></option>
								<option <?php if($print_certificate == "Ya" ) echo "selected"; ?> value="Ya">Ya</option>
								<option <?php if($print_certificate == "Tidak" ) echo "selected"; ?> value="Tidak">Tidak</option>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Auto Cancel Registrasi Peserta
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="auto_cancel" value="<?php echo isset($get_policy->auto_cancel)?$get_policy->auto_cancel:''?>" class="form-control" placeholder="Masukan Text" required="required">
							<!-- <span class="help-block">Dalam Persen (%). </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tipe Periode Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="period_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<?php $period_type_id = isset($get_policy->period_type_id)?$get_policy->period_type_id:''; ?>
								<option></option>
								<?php foreach ($getPeriodType as $row) { ?>
									<option 
									<?php if($period_type_id == $row->period_type_id ) echo "selected"; ?>
									value="<?= $row->period_type_id ?>"><?= $row->period_type_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Template Sertifikat
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="certificate_template_id" required="required" class="select2_category form-control" id="certificate_template_id" data-placeholder="Pilih salah satu">
								<?php $certificate_template_id = isset($get_policy->certificate_template_id)?$get_policy->certificate_template_id:''; ?>
								<option></option>
								<?php foreach ($getCertificateTemplate as $row) { ?>
								<option 
								 <?php if($certificate_template_id == $row->certificate_template_id ) echo "selected"; ?> 
								 value="<?= $row->certificate_template_id ?>"><?= $row->certificate_template_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Klausa Polis
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="klausa_polis" value="<?php echo isset($get_policy->klausa_polis)?$get_policy->klausa_polis:''?>" class="form-control" placeholder="Masukan Text" required="required">
							<span class="help-block">Informasi Pengecualian </span>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('policy') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="<?= $button_form ?>" onclick="return confirm('Proses Nomor Polis?')"/>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>