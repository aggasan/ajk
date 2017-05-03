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
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions btn-set">
				<a href="<?= site_url('debit_note/list_data') ?>" class="btn default" onclick="return confirm('Batalkan proses generate?')"><i class="fa fa-angle-left"></i> Back</a>
			</div>
		</div>	
	</div>	
	<div class="tabbable-line boxless tabbable-reversed">
		<div class="tab-content">
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-docs"></i>Detail Pembayaran Premi
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form class="form-horizontal" role="form">
						<div class="form-body">
							<!-- <h3 class="form-section">Perusahaan/Client</h3> -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Perusahaan/Client:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_bank->bank_name ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!-- row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Dari Tanggal Akseptasi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= date('d-m-Y', strtotime($get_debit_note->period_start)) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Sampai Tanggal Akseptasi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= date('d-m-Y', strtotime($get_debit_note->period_end)) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Debit Note Number:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->debit_note_number ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Total Debitur:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->total_debitur ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Total Premi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $val_product->currency_id.'. 	'.number_format($get_debit_note->premi) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Tanggal Jatuh Tempo:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= date('d-m-Y', strtotime($get_debit_note->maturity_date)) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>

			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-docs"></i>Form Konfirmasi Pembayaran
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
					<!-- POST HIDDEN ID -->
					<input type="hidden" name="debit_note_id" value="<?= $get_debit_note->debit_note_id ?>">
					<!-- END POST HIDDEN ID -->
						<div class="form-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Metode Bayar
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="pay_method_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
											<option></option>
											<?php foreach ($get_pay_method as $val) { ?>
												<option value="<?= $val->pay_method_id ?>"><?= $val->pay_method_name ?></option>
											<?php } ?>
										</select>
										<!-- <span class="help-block"> </span> -->
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Bayar Ke Rekening
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="bank_account_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
											<option></option>
											<?php foreach ($get_bank_account as $val) { ?>
												<option value="<?= $val->bank_account_id ?>"><?= $val->bank_account_name ?></option>
											<?php } ?>
										</select>
										<!-- <span class="help-block"> </span> -->
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Tanggal Bayar
											<span class="required" aria-required="true">*</span>
										</label>
										<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
										data-date-start-date="-1y">
											<input type="text" class="form-control" name="pay_date" required="required" tabindex="1">
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
											Jumlah Bayar
											<span class="required" aria-required="true">*</span>
										</label>
			                            <input type="text" name="summary" value="" class="form-control money" placeholder="Masukan Angka" required="required" tabindex="1">
			                            <span class="help-block"><?= $val_product->currency_id ?> </span>
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											4 digit awal Kode validasi
											<span class="required" aria-required="true">*</span>
										</label>
			                            <input type="text" name="validation_code" value="" class="form-control" placeholder="Masukan Angka" required="required" tabindex="1">
			                            <span class="help-block">(Jika Setor Tunai) Jika bukan setor tunai, harap isi dengan 0000 </span>
									</div>
								</div>
								<!--/span-->	
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Nama Pemegang Rekening
											<span class="required" aria-required="true">*</span>
										</label>
										<input type="text" name="rek_name" value="" class="form-control" placeholder="Masukan angka" required="required" tabindex="1">
										<span class="help-block">Jika tunai, harap isi dengan TUNAI </span>
									</div>
								</div>
								<!--/span-->
							</div>
							<!-- row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											No. Rekening Pengirim
											<span class="required" aria-required="true">*</span>
										</label>
										<input type="text" name="rek_number" value="" class="form-control" placeholder="Masukan angka" required="required" tabindex="1">
										<span class="help-block">Jika tunai, harap isi dengan TUNAI </span>
									</div>
								</div>
								<!--/span-->			
							</div>
							<!-- row -->
						</div>
						<div class="form-actions right">
							<a href="<?= site_url('debit_note/list_data') ?>" class="btn default"/>Batal</a>
							<input type="submit" name="submit" class="btn blue" value="Konfirmasi"  onclick="return confirm('Konfirmasi Pembayaran?')"/>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT