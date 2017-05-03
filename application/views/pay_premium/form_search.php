<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions btn-set">
				<a href="<?= site_url('pay_premium/list_data#tab_1') ?>" class="btn default" onclick="return confirm('Batalkan proses generate?')"><i class="fa fa-angle-left"></i> Back</a>
				<?php $get_permission = $this->auth->get_permission(342) ?>
				<?php if($get_permission->permission){ ?>
				<a href="<?= site_url('pay_premium/generate_group/'.$get_bank->bank_id.'/'.$period_start.'/'.$period_end) ?>" class="btn blue" onclick="return confirm('Generate Debit Note?')" <?=$flag_generate_button?>><i class="fa fa-check-circle table-group-action-submit"></i> Generate Debit Note</a>
				<?php } ?>
			</div>
		</div>	
	</div>	
	<div class="tabbable-line boxless tabbable-reversed">
		<div class="tab-content">
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings"></i>Detail Pembayaran Premi
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
												 <?= date('d-m-Y', strtotime($period_start)) ?>
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
												 <?= date('d-m-Y', strtotime($period_end)) ?>
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
												 <?= $get_pay_detail->debitur_total?>
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
												 <?= $val_product->currency_id.'. 	'.number_format($get_pay_detail->premi + $get_pay_detail->premi_emep) ?>
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
						<i class="icon-docs"></i>Data Detail Debitur
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl;?>">
						<thead>
							<tr>
								<th>#</th>
								<!-- <th>No#</th> -->
								<th>Perusahaan/Client</th>
								<th>Nama Debitur</th>
								<th>Jenis Asuransi</th>
								<th>No. Polis</th>
								<th>No. Sertifikat</th>
								<th>Usia</th>
								<th>Periode</th>
								<th>Mulai Asuransi</th>
								<th>Akhir Asuransi</th>
								<th>Uang Pertanggungan</th>
								<th>Rate</th>
								<th>Premi</th>
								<th>Underwriting</th>
								<th class="hidden-xs">Tgl. Input</th>
								<th class="hidden-xs">Status</th>
								<!-- <th class="hidden-xs">Action</th> -->
							</tr>
						</thead>
					<tbody>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT