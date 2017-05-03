<?php $this->load->view('layout/notification') ?>
<div class="row">
	<div class="col-md-10">
		&nbsp;
	</div>
	<div class="col-md-2" style="margin-top: -30px; margin-bottom: 20px; float: right; clear: both">
		<a href="<?= site_url('JenisPerusahaan') ?>" class="btn default"><i class="fa fa-angle-left"></i> Back</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Form Edit Jenis Perusahaan/Client
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
										Nama Jenis Perusahaan/Client
										<span class="required" aria-required="true">*</span>
									</label>
									<input type="text" name="bank_type_name" class="form-control" placeholder="Masukan Nama Jenis Perusahaan/Client" required="required" value="<?= $getBankById->bank_type_name ?>">
									<!-- <span class="help-block">This is inline help </span> -->
								</div>
							</div>
							<div class="col-md-6">
								&nbsp;
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<input type="submit" name="submit" class="btn blue" value="Update" />
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT