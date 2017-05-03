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

	function calc(){
		var refund_date 	= Date.parse(document.refund.refund_date.value)/1000;
		var period 				= document.refund.period.value;
		var period_start 		= Date.parse(document.refund.period_start.value)/1000;

		var rest = (parseInt(refund_date)-parseInt(period_start))/(24*60*60*30.25);

		three 	= Math.round(rest);

		four  	= parseInt(period) - parseInt(three);

		document.refund.remain_period.value = four ;

		rest_period = document.refund.remain_period.value;
		var premi=<?=$get_debitur->premi + $get_debitur->premi_emep?>;

		var hit_bul = rest_period / period;
		var hit_p_s = 60 * premi / 100;
		var hit_s = hit_bul * hit_p_s;
		var sisapremi = 45 * hit_s / 100;

		//var sisapremi= premi / one * four;
		var sisaan=sisapremi;
		document.refund.remain_premi.value = sisaan;
	}
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
							<i class="icon-docs"></i>Form Penutupan
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
						<form action="<?= site_url(uri_string()) ?>" method="post" class="horizontal-form" name="refund">
						<!-- POST HIDDEN ID -->
						<input type="hidden" name="debitur_id" value="<?= $get_debitur->debitur_id ?>">
						<input type="hidden" name="period" id="period" value="<?= $get_debitur->period ?>" class="form-control" placeholder="" tabindex="1" readonly="">
						<input type="hidden" name="period_start" id="period_start" value="<?= $get_debitur->period_start ?>" class="form-control" placeholder="" tabindex="1" readonly="">
						<!-- END POST HIDDEN ID -->
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Tanggal Pelunasan
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" 
											data-date-start-date="-1y">
												<input type="text" class="form-control" name="refund_date" required="required" tabindex="1" onchange="calc()">
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
												Sisa Periode
												<span class="required" aria-required="true">*</span>
											</label>
											<input type="text" name="remain_period" id="remain_period" value="" class="form-control" placeholder="" tabindex="1" readonly="">
											<!-- <span class="help-block"> </span> -->
										</div>
									</div>
									<!--/span-->								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Ajukan Permohonan Kredit Lagi
												<!-- <span class="required" aria-required="true">*</span> -->
											</label>
											<div><input type="checkbox" name="" value="" class="icheck"></div>
										</div>
									</div>
									<!-- span -->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Sisa Premi
												<span class="required" aria-required="true">*</span>
											</label>
											<input type="text" name="remain_premi" id="remain_premi" value="" class="form-control money" placeholder="" tabindex="1" readonly="">
										</div>
									</div>
									<!-- span -->
								</div>
							</div>
							<div class="form-actions right">
								<a href="<?= site_url('refund/list_data_search') ?>" class="btn default"/>Batal</a>
								<input type="submit" name="submit" class="btn blue" value="Proses"  onclick="return confirm('Proses Data Pelunasan?')"/>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT