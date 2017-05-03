<script>
    $(document).ready(function(){
    	$('.page-content-wrapper').on('click', '.a_rate', function(e) {
    		var rate_batch_id = $(this).data("id");
            jQuery.post(SITE_PATH + "ajax/show_batch_rate/" + rate_batch_id, function(e) {
            	var data = jQuery.parseJSON(e);
            	jQuery("#show_plan_id").html("").html(data.plan_id);
            	jQuery("#show_benefit").html("").html(data.benefit_name);
            	jQuery("#show_period_start").html("").html(data.period_start);
            	jQuery("#show_period_end").html("").html(data.period_end);
            });

        $("#show_rate").load( SITE_PATH + 'ajax/show_rate/'+ rate_batch_id);
		});

    	$('.page-content-wrapper').on('click', '.a_underwriting', function(e) {
    		var underwriting_batch_id = $(this).data("id");
            jQuery.post(SITE_PATH + "ajax/show_batch_underwriting/" + underwriting_batch_id, function(e) {
            	var data = jQuery.parseJSON(e);
            	console.log(data.rate_batch_id);
            	jQuery("#show_period_start_underwriting").html("").html(data.period_start);
            	jQuery("#show_period_end_underwriting").html("").html(data.period_end);
            });

            $("#show_underwriting").load( SITE_PATH + 'ajax/show_underwriting/'+ underwriting_batch_id);
		});

		$('.page-content-wrapper').on('click', '.a_decrease', function(e) {
    		var decrease_batch_id = $(this).data("id");
            jQuery.post(SITE_PATH + "ajax/show_batch_decrease/" + decrease_batch_id, function(e) {
            	var data = jQuery.parseJSON(e);
            	console.log(data.rate_batch_id);
            	jQuery("#show_period_start_decrease").html("").html(data.period_start);
            	jQuery("#show_period_end_decrease").html("").html(data.period_end);
            });

            $("#show_decrease").load( SITE_PATH + 'ajax/show_decrease/'+ decrease_batch_id);
		});
    });
</script>

<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
				<?php if(!$get_underwriting_batch or !$get_rate_batch or !$get_decrease_batch){
					$flag_button_konfirmasi = 'disabled=""';
				} else {
					if($getProductById->rowstate == 'planned'){
						$flag_button_konfirmasi = '';
					} else {
						$flag_button_konfirmasi = 'disabled=""';
					}
					
				} ?>

				<div class="actions btn-set">
					
					<a href="<?= site_url('product') ?>" class="btn default"><i class="fa fa-angle-left"></i> Kembali</a>
					<?php $get_permission = $this->auth->get_permission(349) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?=site_url('product/cloning/').$getProductById->product_id?>" class="btn blue" onclick="return confirm('Cloning Produk Asuransi?')"><i class="fa fa-check-circle"></i> Cloning</a>
					<?php } ?>
					<?php $get_permission = $this->auth->get_permission(312) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?=site_url('product/confirm/').$getProductById->product_id?>" class="btn green" <?=$flag_button_konfirmasi?> onclick="return confirm('Konfirmasi Produk Asuransi?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
					<?php } ?>
				</div>
			</div>	
		</div>	
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Informasi Umum </a>
				</li>
				<li class="">
					<a href="#tab_2" data-toggle="tab">
					Rate </a>
				</li>
				<li class="">
					<a href="#tab_4" data-toggle="tab">
					Tabel Penurunan </a>
				</li>
				<li class="">
					<a href="#tab_3" data-toggle="tab">
					Tabel Medis </a>
				</li>				
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Detail Produk
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
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Status Produk:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <span class="label label-primary"><?= $getProductById->rowstate ?> </span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<!-- row -->
									<h3 class="form-section">Informasi Umum</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->insurance_type_name?>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Produk:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->product_name?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Plan ID:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->plan_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Produk:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->product_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Kredit:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->credit_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Agunan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->bank_collateral_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tingkat Bunga Pinjaman Maksimum:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->max_interest_rate ?> %
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Mata Uang:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Channel Distribusi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->distribution_channel_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Resiko Pertanggungan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->risk_insurance_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Informasi Cara Bayar:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->pay_method_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									
									<h3 class="form-section">Parameter Produk</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Metode Hitung Usia:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->count_age_method_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Range Usia Masuk Tertanggung:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= number_format($getProductById->min_age_start).' - '.number_format($getProductById->max_age_start)?> Tahun
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Maksumim Usia Pertanggungan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->max_age ?> Tahun
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jangka Waktu Pinjaman (MK):</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->term_loan_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Maksimum Jangka Waktu Pinjaman:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->term_loan_val.' '.$getProductById->term_loan_type_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Masa Pembayaran Premi (MPP):</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->pay_premium_period ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Range Nilai Uang Pertanggungan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id.'. '.number_format($getProductById->min_sum_insured).' - '. number_format($getProductById->max_sum_insured) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Masa Tunggu Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->claim_waiting_period ?> Hari
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Pengaturan Penerbitan sertifikat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->param_publishing_certificate_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Cara Bayar Premi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->pay_premium_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nilai Minimal Refund Premi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id.'. '.number_format($getProductById->premi_refund_min) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Formula Perhitungan Refund Premi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->refund_formula_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Broker/Pihak Ketiga:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->broker_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Komisi Broker/Pihak Ketiga:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->broker_commission ?> %
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Diskon Perusahaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->discount ?> %
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Komisi Perusahaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->commission ?> %
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Biaya Polis:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id.'. '.number_format($getProductById->polis_fee) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Informasi Target Produksi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id.'. '.number_format($getProductById->production_target) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Marketing Fee:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getProductById->currency_id.'. '.number_format($getProductById->marketing_fee) ?> %
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Benefit</h3>
									<?php foreach ($getBenefitType as $row) { ?>
									<div class="row">
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-2"><?= $row->benefit_type_name ?>:</label>
												<div class="col-md-10">
													<?php 
														$i = 1;
														$benefit_type_id = $row->benefit_type_id;
														$product_id = $getProductById->product_id;
														$getBenefitProduct = $this->Benefit_product_m->getById($product_id,$benefit_type_id);

													?>
													<?php foreach ($getBenefitProduct as $val) { ?>
													<p class="form-control-static">
													<?= $val->benefit_code ?> - <?= $val->benefit_name ?>
													</p>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<!--/row-->
									<?php } ?>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<?php $get_permission = $this->auth->get_permission(236) ?>
													<?php if($get_permission->permission){  ?>
													<?php if($getProductById->rowstate == 'planned') { ?>
													<a href="<?= site_url('product/edit/'.$getProductById->product_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>
													<?php } ?>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_2">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red-intense">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>List Rate
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<!-- <a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a>
								<!-- <a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(322) ?>
							<?php if($get_permission->permission){  ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a data-toggle="modal" href="#basic" class="btn green">
											Upload Rate <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6"  data-url="<?php echo $datatablesUrl_rate;?>">
							<thead>
							<tr>
								<th>
									 No#
								</th>
								<th>
									 Benefit
								</th>
								<th class="hidden-xs">
									 Periode Mulai
								</th>
								<th class="hidden-xs">
									 Periode Akhir
								</th>
								<th class="hidden-xs">
									 Tgl. dibuat
								</th>
								<th class="hidden-xs">
									 Status
								</th>
								<th class="hidden-xs">
									 User Input
								</th>
								<th class="hidden-xs">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>

				<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Form Upload Rate
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
										<form action="<?= site_url('product/add_rate') ?>" method="post" class="horizontal-form" enctype="multipart/form-data">
											<input type="hidden" name="product_id" value="<?= $getProductById->product_id ?>">
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Benefit
																<span class="required" aria-required="true">*</span>
															</label>
															<select name="benefit_id" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
															<?php 
																$i = 1;
																$product_id = $getProductById->product_id;
																$getBenefitProduct = $this->Benefit_product_m->getByProduct($product_id);

															?>
															<?php foreach ($getBenefitProduct as $val) { ?>
																<option value="<?= $val->benefit_id ?>"><?= $val->benefit_name ?></option>
															<?php } ?>
															</select>
															<!-- <span class="help-block">This is inline help </span> -->
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Dari Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" name="period_start">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- <span class="help-block">This is inline help </span> -->
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Sampai Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" name="period_end">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																File
																<span class="required" aria-required="true">*</span>
															</label>									
														
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="input-group">
																	<div class="form-control uneditable-input" data-trigger="fileinput">
																		<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
																		</span>
																	</div>
																	<span class="input-group-addon btn default btn-file">
																	<span class="fileinput-new">
																	Select file </span>
																	<span class="fileinput-exists">
																	Change </span>
																	<input type="file" name="up_file">
																	</span>
																	<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
																	Remove </a>
																</div><span class="help-block">(xls, xlsx)</span>
															</div>
														</div>

													</div>
													<!--/span-->
													
												</div>
												<!--/row-->

											</div>
											<div class="form-actions">
												<div class="btn-set pull-left">
													<a href="<?= site_url('product/download_document/TemplateRate.xls')?>" class="btn green">
													<i class="fa fa-file-o"></i> Unduh File Template </a>
												</div>
												<div class="btn-set pull-right">
													<button type="button" class="btn default" data-dismiss="modal">Batal</button>
													<input type="submit" name="submit" class="btn blue" value="Upload" />
												</div>
												</div>
											</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="tab-pane" id="tab_3">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red-intense">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>List Tabel Medis
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<!-- <a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a>
								<!-- <a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(324) ?>
							<?php if($get_permission->permission){  ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a data-toggle="modal" href="#basic_2" class="btn green">
											Upload Table Medis <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_underwriting;?>">
							<thead>
							<tr>
								<th>
									 No#
								</th>
								<th>
									 Periode Mulai
								</th>
								<th>
									 Periode Akhir
								</th>
								<th>
									 Tgl. dibuat
								</th>
								<th class="hidden-xs">
									 Status
								</th>
								<th class="hidden-xs">
									 User Input
								</th>
								<th class="hidden-xs">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>

				<div class="modal fade" id="basic_2" tabindex="-1" role="basic_2" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Form Upload Table Medis
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
										<form action="<?= site_url('product/add_underwriting') ?>" method="post" class="horizontal-form" enctype="multipart/form-data">
											<input type="hidden" name="product_id" value="<?= $getProductById->product_id ?>">
											<div class="form-body">
												<!-- <h3 class="form-section">Form Upload Rate</h3> -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Dari Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">

																<input type="text" class="form-control" name="period_start">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- <span class="help-block">This is inline help </span> -->
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Sampai Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" name="period_end">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																File
																<span class="required" aria-required="true">*</span>
															</label>									
														
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="input-group">
																	<div class="form-control uneditable-input" data-trigger="fileinput">
																		<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
																		</span>
																	</div>
																	<span class="input-group-addon btn default btn-file">
																	<span class="fileinput-new">
																	Select file </span>
																	<span class="fileinput-exists">
																	Change </span>
																	<input type="file" name="up_file">
																	</span>
																	<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
																	Remove </a>
																</div><span class="help-block">(xls, xlsx)</span>
															</div>
														</div>

													</div>
													<!--/span-->
													
												</div>
												<!--/row-->

											</div>
											<div class="form-actions">
												<div class="btn-set pull-left">
													<a href="<?= site_url('product/download_document/TemplateUnderwriting.xls')?>" class="btn green">
													<i class="fa fa-file-o"></i> Unduh File Template </a>
												</div>
												<div class="btn-set pull-right">
													<button type="button" class="btn default" data-dismiss="modal">Batal</button>
													<input type="submit" name="submit" class="btn blue" value="Upload" />
												</div>
											</div>
											</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="tab-pane" id="tab_4">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box red-intense">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>List Tabel Penurunan
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<!-- <a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a>
								<!-- <a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(326) ?>
							<?php if($get_permission->permission){  ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a data-toggle="modal" href="#basic_3" class="btn green">
											Upload Tabel Penurunan <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6"  data-url="<?php echo $datatablesUrl_decrease;?>">
							<thead>
							<tr>
								<th>
									 No#
								</th>
								<th class="hidden-xs">
									 Periode Mulai
								</th>
								<th class="hidden-xs">
									 Periode Akhir
								</th>
								<th class="hidden-xs">
									 Tgl. dibuat
								</th>
								<th class="hidden-xs">
									 Status
								</th>
								<th class="hidden-xs">
									 User Input
								</th>
								<th class="hidden-xs">
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>

				<div class="modal fade" id="basic_3" tabindex="-1" role="basic_3" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Form Upload Tabel Penurunan
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
										<form action="<?= site_url('product/add_decrease') ?>" method="post" class="horizontal-form" enctype="multipart/form-data">
											<input type="hidden" name="product_id" value="<?= $getProductById->product_id ?>">
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Dari Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" name="period_start">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- <span class="help-block">This is inline help </span> -->
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Aktif Sampai Tanggal
																<span class="required" aria-required="true">*</span>
															</label>
															<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
																<input type="text" class="form-control" name="period_end">
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																File
																<span class="required" aria-required="true">*</span>
															</label>									
														
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="input-group">
																	<div class="form-control uneditable-input" data-trigger="fileinput">
																		<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
																		</span>
																	</div>
																	<span class="input-group-addon btn default btn-file">
																	<span class="fileinput-new">
																	Select file </span>
																	<span class="fileinput-exists">
																	Change </span>
																	<input type="file" name="up_file">
																	</span>
																	<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
																	Remove </a>
																</div><span class="help-block">(xls, xlsx)</span>
															</div>
														</div>

													</div>
													<!--/span-->
													
												</div>
												<!--/row-->

											</div>
											<div class="form-actions">
												<div class="btn-set pull-left">
													<a href="<?= site_url('product/download_document/TemplateTabelPenurunan.xls')?>" class="btn green">
													<i class="fa fa-file-o"></i> Unduh File Template </a>
												</div>
												<div class="btn-set pull-right">
													<button type="button" class="btn default" data-dismiss="modal">Batal</button>
													<input type="submit" name="submit" class="btn blue" value="Upload" />
												</div>
												</div>
											</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Detail Rate
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a><!-- 
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a><!-- 
								<a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<h3 class="form-section">Informasi Rate</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Plan ID:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_plan_id">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Benefit:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_benefit">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Mulai:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_start">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Akhir:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_end">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Tabel Rate</h3>
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
										<div class="portlet box red-intense">
											<div class="portlet-title">
												<div class="caption">
													<i class="icon-settings"></i>List Detail Tabel Rate
												</div>
												<div class="tools">
													<a href="javascript:;" class="collapse">
													</a>
													<a href="javascript:;" class="reload">
													</a>
												</div>
											</div>
											<div class="portlet-body" id="show_rate">
											</div>
											
												
												
										</div>
										<!-- END EXAMPLE TABLE PORTLET-->
										<div class="form-actions">
											<!-- <div class="btn-set pull-left">
												<a href="javascript:;" class="btn green">
												<i class="fa fa-file-o"></i> Unduh File Template </a>
											</div> -->
											<div class="btn-set pull-right">
												<button type="button" class="btn default" data-dismiss="modal">Batal</button>
												<!-- <input type="submit" name="submit" class="btn blue" value="Simpan" /> -->
											</div>
										</div>
									</div>
									</form>
									<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade bs-modal-lg" id="large_2" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-settings"></i>Detail Tabel Medis
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a><!-- 
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a> -->
											<a href="javascript:;" class="reload">
											</a><!-- 
											<a href="javascript:;" class="remove">
											</a> -->
										</div>
									</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<h3 class="form-section">Informasi Tabel Medis</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Mulai:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_start_underwriting">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Akhir:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_end_underwriting">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Tabel Medis</h3>
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
										<div class="portlet box red-intense">
											<div class="portlet-title">
												<div class="caption">
													<i class="icon-settings"></i>List Detail Tabel Medis
												</div>
												<div class="tools">
													<a href="javascript:;" class="collapse">
													</a>
													<a href="javascript:;" class="reload">
													</a>
												</div>
											</div>
											<div class="portlet-body" id="show_underwriting">
											</div>
										</div>
										<!-- END EXAMPLE TABLE PORTLET-->
										<div class="form-actions">
											<!-- <div class="btn-set pull-left">
												<a href="javascript:;" class="btn green">
												<i class="fa fa-file-o"></i> Unduh File Template </a>
											</div> -->
											<div class="btn-set pull-right">
												<button type="button" class="btn default" data-dismiss="modal">Batal</button>
												<!-- <input type="submit" name="submit" class="btn blue" value="Simpan" /> -->
											</div>
										</div>
									</div>
									</form>
									<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade bs-modal-lg" id="large_3" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Detail Tabel Penurunan
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a><!-- 
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a><!-- 
								<a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<h3 class="form-section">Informasi Tabel Penurunan</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Mulai:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_start_decrease">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Periode Akhir:</label>
												<div class="col-md-8">
													<p class="form-control-static" id="show_period_end_decrease">
														 
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Tabel Penurunan</h3>
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
										<div class="portlet box red-intense">
											<div class="portlet-title">
												<div class="caption">
													<i class="icon-settings"></i>List Detail Tabel Penurunan
												</div>
												<div class="tools">
													<a href="javascript:;" class="collapse">
													</a>
													<a href="javascript:;" class="reload">
													</a>
												</div>
											</div>
											<div class="portlet-body" id="show_decrease">
											</div>
											
												
												
										</div>
										<!-- END EXAMPLE TABLE PORTLET-->
										<div class="form-actions">
											<!-- <div class="btn-set pull-left">
												<a href="javascript:;" class="btn green">
												<i class="fa fa-file-o"></i> Unduh File Template </a>
											</div> -->
											<div class="btn-set pull-right">
												<button type="button" class="btn default" data-dismiss="modal">Batal</button>
												<!-- <input type="submit" name="submit" class="btn blue" value="Simpan" /> -->
											</div>
										</div>
									</div>
									</form>
									<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT