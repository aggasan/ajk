<script type="text/javascript">
	function ShowMK(){
		var term_loan_type_id = document.getElementById('term_loan_type_id');

		if(term_loan_type_id.value != ''){
			$("#ShowMK").load( SITE_PATH + 'ajax/show_mk/'+ term_loan_type_id.value);
		}
	}
</script>

<?php $this->load->view('layout/notification') ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Form Jenis Agunan
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
								Nama Jenis Agunan
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="bank_collateral_type_name" class="form-control" placeholder="Masukan Jenis Agunan">
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
				<a href="<?= site_url('BankCollateral') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>