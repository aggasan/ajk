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
		<div class="tabbable-line boxless tabbable-reversed">
			<div class="tab-content">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-docs"></i>Detail Debitur
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
													 <?= $get_debitur->bank_name ?>
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
											<label class="control-label col-md-6">Nama Debitur:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_debitur->debitur_name ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Tempat Lahir:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_debitur->birth_place ?>
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
											<label class="control-label col-md-6">Tanggal Lahir:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= date('d-m-Y', strtotime($get_debitur->datebirth)) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Usia:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_debitur->age ?>
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
											<label class="control-label col-md-6">Jenis Kelamin:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													<?= $get_debitur->gender_id ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Pekerjaan:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_debitur->job_name ?>
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
											<label class="control-label col-md-6">Uang Pertanggungan:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													<?= $val_product->currency_id.'. 	'.number_format($get_debitur->sum_insured) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Periode:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_debitur->period.' '.$val_product->term_loan_type_id ?>
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
											<label class="control-label col-md-6">Mulai Asuransi:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= date('d-m-Y', strtotime($get_debitur->period_start)) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Akhir Asuransi:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= date('d-m-Y', strtotime($get_debitur->period_end)) ?>
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
											<label class="control-label col-md-6">Underwriting:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													<?= $get_debitur->underwriting_type ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Premi:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													<?= $val_product->currency_id.'. '.number_format($get_debitur->premi + $get_debitur->premi_emep) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->
							</div>
						</form>
					</div>
				</div>
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-docs"></i>Form Pengajuan Klaim
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
						<input type="hidden" name="debitur_id" value="<?= $get_debitur->debitur_id ?>">
						<!-- END POST HIDDEN ID -->
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Tanggal Kejadian
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
											data-date-start-date="-1y">
												<input type="text" class="form-control" name="insident_date" required="required" tabindex="1">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
											<!-- <span class="help-block"> </span> -->
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Jenis Klaim
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="claim_type_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
												<option></option>
												<?php foreach ($get_claim_type as $row) { ?>
													<option	value="<?= $row->claim_type_id ?>"><?= $row->claim_type_name ?>		
													</option>
												<?php } ?>
											</select>
											<!-- <span class="help-block"> </span> -->
										</div>
									</div>
									<!--/span-->								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Alasan Klaim
												<span class="required" aria-required="true">*</span>
											</label>
											<input type="text" name="claim_reason" value="" class="form-control" placeholder="" tabindex="1">
										</div>
									</div>
									<!-- span -->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Jumlah Yang Diajukan
												<span class="required" aria-required="true">*</span>
											</label>
											<input type="text" name="sum_insured_proposed" value="" class="form-control money" placeholder="" tabindex="1">
										</div>
									</div>
									<!-- span -->
								</div>
							</div>
							<div class="form-actions right">
								<a href="<?= site_url('claim/list_data_search') ?>" class="btn default"/>Batal</a>
								<input type="submit" name="submit" class="btn blue" value="Proses"  onclick="return confirm('Input Pengajuan Klaim?')"/>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT