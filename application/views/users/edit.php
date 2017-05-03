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
			<i class="fa fa-gift"></i>Form Ubah Password
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
		<form action="<?= site_url(uri_string()) ?>" method="post" class="horizontal-form">
			<div class="form-body">
				<h3 class="form-section">Data</h3>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Username
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="hidden" name="id_username" class="form-control" placeholder="Masukan Username" value="<?= $this->session->userdata('user_id') ?>" >
							<input type="text" name="new_username" class="form-control" placeholder="Masukan Username" value="<?= $this->session->userdata('username') ?>" disabled >
						</div>
						<div class="form-group">
							<label class="control-label">
								Password Baru
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="password" name="new_password" class="form-control" placeholder="Masukan Password Baru">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Password Lama
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="password" name="old_password" class="form-control" placeholder="Masukan Password Lama">
						</div>
						<div class="form-group">
							<label class="control-label">
								Retype Password Baru
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="password" name="retype" class="form-control" placeholder="Ketik Ulang Password Baru">
						</div>
					</div>
					<div class="col-md-4">
						&nbsp;
					</div>
				</div>
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('Users') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>