<?php $this->load->view('layout/notification') ?>
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
			<i class="icon-docs"></i>Data Pengajuan 
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
		<form action="<?= site_url('calculator/detail') ?>" method="post" class="horizontal-form">
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Perusahaan/Client
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="bank_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
								<?php foreach ($get_bank as $val) { ?>
									<option value="<?= $val->bank_id ?>"><?= $val->bank_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Debitur
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="debitur_name" value="" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tanggal Lahir
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
							data-date-start-date="-70y">
								<input type="text" class="form-control" name="datebirth" required="required" tabindex="1">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="insurance_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih Jenis Asuransi" tabindex="1">
								<option></option>
								<?php foreach ($get_insurance_type as $row) { ?>
								<option value="<?= $row->insurance_type_id ?>"><?= $row->insurance_type_name ?>
								</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!--/span-->	
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Mulai Asuransi
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
							data-date-start-date="+0d">
								<input type="text" class="form-control" name="period_start" required="required" tabindex="1">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tenor
								<span class="required" aria-required="true">* Tahun</span>
							</label>
							<input type="text" name="period" value="" class="form-control" placeholder="Masukan angka" required="required" tabindex="1">
							<!-- <span class="help-block">Tahun </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Uang Pertanggungan
								<span class="required" aria-required="true">* IDR</span>
							</label>
                            <input type="text" name="sum_insured" value="" class="form-control money" placeholder="Masukan Angka" required="required" tabindex="1">
                            <!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->				
				</div>
				<!-- row -->
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
				<!-- <a href="<?= site_url($flag_url_back) ?>" class="btn default"/>Batal</a> -->
				<input type="submit" name="submit" class="btn blue" value="Hitung" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>