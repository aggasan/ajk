<script type="text/javascript">
    function ShowMK(){
        var term_loan_type_id = document.getElementById('term_loan_type_id');

        if(term_loan_type_id.value != ''){
            $("#ShowMK").load( SITE_PATH + 'ajax/show_mk/'+ term_loan_type_id.value);
        }
    }
</script>


<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Form Perusahaan/Client
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
								Nama Perusahaan/Client
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="bank_name" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Perusahaan/Client
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="bank_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih Salah Satu" tabindex="1">
							<option></option>
							<?php foreach ($getBankType as $row) { ?>
								<option value="<?= $row->bank_type_id ?>"><?= $row->bank_type_name ?></option>
							<?php } ?>
						</select>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								No. Telp
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="phone" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Fax
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="fax" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Kode Pos
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="zipcode" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">Dalam Persen (%). </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Pimpinan
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="ceo" class="form-control" placeholder="Masukan Text" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section">Alamat</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">
								Alamat
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="address" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Kota
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="city_name" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Distrik
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="district" class="form-control" placeholder="Masukan Text" required="required" tabindex="1">
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
				</div>
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('bank') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>