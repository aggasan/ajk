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
				<?php if($get_debit_note->rowstate == 'confirmed'){
					$flag_button_closing = '';
				} else {
					$flag_button_closing = 'disabled=""';
				} ?>
				<a href="<?= site_url('debit_note/list_data') ?>" class="btn default" onclick="return confirm('Kembali ke halaman sebelumnya?')"><i class="fa fa-angle-left"></i> Kembali</a>
				<?php $get_permission = $this->auth->get_permission(338) ?>
				<?php if($get_permission->permission){ ?>
				<a href="<?=site_url('debit_note/pay_closing/').$get_debit_note->debit_note_id?>" class="btn green" <?=$flag_button_closing?> onclick="return confirm('Closing Pembayaran?')"><i class="fa fa-check-circle"></i> Closing</a>
				<?php } ?>
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
										<label class="control-label col-md-6">Debit Note Number:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->debit_note_number ?>
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
										<label class="control-label col-md-6">Perusahaan/Client:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_bank->bank_name ?>
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
										<label class="control-label col-md-6">Dari Tanggal Akseptasi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->period_start ?>
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
												 <?= $get_debit_note->period_end ?>
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
												 <?= $val_product->currency_id.'. '.number_format($get_debit_note->premi) ?>
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
												 <?= $get_debit_note->maturity_date ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Metode Bayar:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->pay_method_name ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Bayar Ke Rekening:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->bank_account_id ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Tanggal Bayar:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->pay_date ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Jumlah Bayar:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $val_product->currency_id.'. '.number_format($get_debit_note->summary) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">4 digit awal Kode validasi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->validation_code ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Nama Pemegang Rekening:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->rek_name ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">No. Rekening Pengirim:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_debit_note->rek_number ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Tanggal Konfirmasi:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												<?= date('d-m-Y H:i:s', strtotime($get_debit_note->confirm_date)) ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Status:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <span class="label label-primary"><?= $get_debit_note->rowstate ?></span>
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
		</div>
	</div>
</div>
<!-- END PAGE CONTENT