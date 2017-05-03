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

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-docs"></i><?= $header_form ?>
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
				<h3 class="form-section">Data Debitur</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Debitur
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="debitur_name" value="<?= isset($get_debitur->debitur_name)?$get_debitur->debitur_name:'' ?>" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								No. Akad
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="no_akad" value="<?= isset($get_debitur->akad_no)?$get_debitur->akad_no:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tanggal Lahir
								<span class="required" aria-required="true">* Maksimum
								<?= $max_age = $val_product->max_age ?> Tahun</span>
							</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
							data-date-start-date="-<?=$val_product->max_age?>y">
								<input type="text" class="form-control" name="datebirth" required="required" value="<?= isset($get_debitur->datebirth)?date('d-m-Y', strtotime($get_debitur->datebirth)):'' ?>" tabindex="1">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
							<!-- <span class="help-block"></span> -->
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tempat Lahir
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="birth_place"  value="<?= isset($get_debitur->birth_place)?$get_debitur->birth_place:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					</div>
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Identitas
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $identity_type_id = isset($get_debitur->identity_type_id)?$get_debitur->identity_type_id:'' ?>
							<select name="identity_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getIdentityType as $row) { ?>
									<option 
										<?php if($identity_type_id == $row->identity_type_id ) echo "selected"; ?> 
										value="<?= $row->identity_type_id ?>"><?= $row->identity_type_name ?>		
									</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nomor Identitas
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="no_id" value="<?= isset($get_debitur->no_id)?$get_debitur->no_id:'' ?>" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Kelamin
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $gender_id = isset($get_debitur->gender_id)?$get_debitur->gender_id:'' ?>
							<select name="gender_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getGender as $row) { ?>
									<option 
										<?php if($gender_id == $row->gender_id ) echo "selected"; ?>
										value="<?= $row->gender_id ?>"><?= $row->gender_name ?>
									</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Pekerjaan
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $job_id = isset($get_debitur->job_id)?$get_debitur->job_id:'' ?>
							<select name="job_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getJob as $row) { ?>
									<option 
										<?php if($job_id == $row->job_id ) echo "selected"; ?> 
										value="<?= $row->job_id ?>"><?= $row->job_name ?>
									</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Detail Pekerjaan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="job_detail" value="<?= isset($get_debitur->job_detail)?$get_debitur->job_detail:'' ?>"  class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<!-- <div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Status Pernikahan
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $mariage_status_id = isset($get_debitur->mariage_status_id)?$get_debitur->mariage_status_id:'' ?>
							<select name="mariage_status_id" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getMariageStatus as $row) { ?>
									<option 
										<?php if($mariage_status_id == $row->mariage_status_id ) echo "selected"; ?> 
										value="<?= $row->mariage_status_id ?>"><?= $row->mariage_status_name ?>
									</option>
								<?php } ?>
							</select>
							<span class="help-block">This is inline help </span>
						</div>
					</div> -->
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section">Kontak Debitur</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Alamat
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="address" value="<?= isset($get_debitur->address)?$get_debitur->address:'' ?>" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Kota
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $city_id = isset($get_debitur->city_id)?$get_debitur->city_id:'' ?>
							<select name="city_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getCity as $row) { ?>
									<option 
										<?php if($city_id == $row->city_id ) echo "selected"; ?> 
										value="<?= $row->city_id ?>"><?= $row->city_name ?>
									</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								No. Handphone
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="handphone" value="<?= isset($get_debitur->handphone)?$get_debitur->handphone:'' ?>"  class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Telepon
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="phone" value="<?= isset($get_debitur->phone)?$get_debitur->phone:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Email
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="email" value="<?= isset($get_debitur->email)?$get_debitur->email:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<h3 class="form-section">Produk</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $insurance_type_id = isset($get_debitur->insurance_type_id)?$get_debitur->insurance_type_id:'' ?>
							<select name="insurance_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih Jenis Asuransi" tabindex="1">
								<option></option>
								<?php foreach ($getProductInsuranceType as $row) { ?>
								<option 
									<?php if($insurance_type_id == $row->insurance_type_id ) echo "selected"; ?> 
									value="<?= $row->insurance_type_id ?>"><?= $row->insurance_type_name ?>
								</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Uang Pertanggungan
								<span class="required" aria-required="true">* Range Uang Pertanggungan 
								<?= $val_product->currency_id ?>. <?= number_format($val_product->min_sum_insured) ?> - 
								<?= $val_product->currency_id ?>. <?= number_format($val_product->max_sum_insured) ?> </span>
							</label>
                            <input type="text" name="sum_insured" value="<?= isset($get_debitur->sum_insured)?$get_debitur->sum_insured:'' ?>" class="form-control money" placeholder="Masukan Angka" required="required" tabindex="1">
							<span class="help-block">
								 
							</span>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Mulai Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
								<input type="text" class="form-control" name="period_start" value="<?= isset($get_debitur->period_start)?date('d-m-Y', strtotime($get_debitur->period_start)):'' ?>" required="required" tabindex="1">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tenor
								<span class="required" aria-required="true">* Maksimum
								<?= $val_product->term_loan_val ?> <?= $val_product->term_loan_type_id ?> </span>
							</label>
							<input type="text" name="period" value="<?= isset($get_debitur->period)?$get_debitur->period:'' ?>" class="form-control" placeholder="Masukan Angka Dalam <?= $val_product->term_loan_type_id ?>" required="required" tabindex="1">
							<!-- <span class="help-block"></span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<h3 class="form-section">Tempat Bekerja</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Instansi / Perusahaan
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="company_name" value="<?= isset($get_debitur->company_name)?$get_debitur->company_name:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Bidang Usaha
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
								<?php $business_field_id = isset($get_debitur->business_field_id)?$get_debitur->business_field_id:'' ?>
								<select name="business_field_id" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($getBusinessField as $row) { ?>
									<option 
										<?php if($business_field_id == $row->business_field_id ) echo "selected"; ?> 
										value="<?= $row->business_field_id ?>"><?= $row->business_field_name ?>
									</option>
								<?php } ?>
							</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jabatan
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="position" value="<?= isset($get_debitur->position)?$get_debitur->position:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Alamat
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="company_address" value="<?= isset($get_debitur->company_address)?$get_debitur->company_address:'' ?>" class="form-control" placeholder="Masukan Text" tabindex="1">
						</div>
					</div>
					<!--/span-->
				</div>
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
									$product_id = $val_product->product_id;
									$debitur_id = isset($get_debitur->debitur_id)?$get_debitur->debitur_id:'';
									$getBenefitProduct = $this->Benefit_product_m->getById($product_id,$benefit_type_id,$debitur_id);
								?>
								<?php if($row->benefit_type_id == 1) { ?>
									<div class="input-group">
										<div class="icheck-inline">
											<?php foreach ($getBenefitProduct as $val) { ?>
												<label>
												<input type="hidden" name="benefit_id[]" value="<?= $val->benefit_id ?>">
												<input type="checkbox" checked disabled="" class="icheck" ><?= $val->benefit_name ?></label>
											<?php } ?>
										</div>
									</div>
								<?php } else { ?>
									<div class="input-group">
										<div class="icheck-inline">
											<?php foreach ($getBenefitProduct as $val) { ?>
												<?php if(is_null($val->debitur_premi_id)){
													$checked = ""; 
													} else {
													$checked = "checked";
													} ?>
												<label><input type="checkbox" <?= $checked ?> name="benefit_id[]" value="<?= $val->benefit_id ?>" class="icheck"><?= $val->benefit_name ?></label>
											<?php } ?>
										</div>
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
				<a href="<?= site_url('debitur') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="<?= $button_form ?>" onclick="return confirm('Proses data debitur?')"/>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>