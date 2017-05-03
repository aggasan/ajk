<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
				<div class="actions btn-set">
					<a href="<?= site_url('calculator') ?>" class="btn default"><i class="fa fa-angle-left"></i> Back</a>
					<button class="btn green"><i class="fa fa-check-circle table-group-action-submit"></i> Cetak PDF</button>
				</div>
			</div>	
		</div>	
		<div class="tabbable-line boxless tabbable-reversed">
			<div class="tab-content">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-docs"></i>Detail Simulasi Kredit
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
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Nama Debitur:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $debitur_name ?>
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
													 <?= date('d-m-Y', strtotime($datebirth)) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Jenis Asuransi:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $get_insurance_type->insurance_type_name?>
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
													 <?= date('d-m-Y', strtotime($period_start)) ?>
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
													 <?= date('d-m-Y', strtotime($period_end)) ?>
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
											<label class="control-label col-md-6">Tenor:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $period ?> Bulan
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Uang Pertanggungan:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													IRD. <?= number_format($sum_insured) ?>
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
											<label class="control-label col-md-6">Usia:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $age ?> Tahun
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Rate:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $rate ?>
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
											<label class="control-label col-md-6">Premi:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 IDR. <?= number_format($premi) ?>
												</p>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-6">Underwriting:</label>
											<div class="col-md-6">
												<p class="form-control-static">
													 <?= $underwriting_type ?>
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
</div>
<!-- END PAGE CONTENT