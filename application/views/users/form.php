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
			<i class="fa fa-gift"></i>Form Tambah User
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
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Kategori User
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="user_category" id="user_category" required="required" class="select2_category form-control" data-placeholder="Pilih Underwriting" tabindex="1">
								<option></option>
								<option value="1">Admin</option>
								<option value="2">Asuransi</option>
								<option value="3">Bank</option>
								<option value="4">Broker</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">
								Username
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="user_username" class="form-control" placeholder="Masukan Username">
						</div>
					</div>
					<!--/span-->
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Perusahaan/Client
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="user_bankid" id="user_bankid" required="required" class="select2_category form-control" data-placeholder="Pilih Bank" tabindex="1">
								<option></option>
								<?php foreach ($get_bank as $val) { ?>
									<option value="<?= $val->bank_id."-".$val->bank_name ?>"><?= $val->bank_name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">
								Password
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="password" name="user_password" class="form-control" placeholder="Masukan Password">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">
								Sebagai
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="user_roles" id="user_roles" required="required" class="select2_category form-control" data-placeholder="Pilih Bank" tabindex="1">
								<option></option>
								<?php foreach ($get_role as $val) { ?>
									<option value="<?= $val->roles_id ?>"><?= $val->roles_name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">
								Retype Password
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="password" name="retype" class="form-control" placeholder="Ketik Ulang Password">
						</div>
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