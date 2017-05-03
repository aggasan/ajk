<?php $this->load->view('layout/notification') ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Form Benefit
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
				<h3 class="form-section">Data</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Tipe Benefit
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="benefit_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
							<?= $benefit_type_id = isset($get_benefit->benefit_type_id)?$get_benefit->benefit_type_id:'' ?>
							<option></option>
							<?php foreach ($get_benefit_type as $row) { ?>
								<option 
								<?php if($benefit_type_id == $row->benefit_type_id ) echo "selected"; ?> 
								value="<?= $row->benefit_type_id ?>"><?= $row->benefit_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Kode Benefit
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="benefit_code" class="form-control" placeholder="Masukan Kode Benefit">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Nama Benefit
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="benefit_name" class="form-control" placeholder="Masukan Nama Benefit">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						&nbsp;
					</div>
				</div>
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('Benefit') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>