<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Perorangan </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Kumpulan </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Sudah dibuat </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<form action="<?= site_url('pay_premium/generate')?>" method="post">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Perorangan
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(341) ?>
							<?php if($get_permission->permission){ ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<button class="btn blue" onclick="return confirm('Generate Debit Note?')">
											<i class="fa fa-check-circle table-group-action-submit"></i> Generate Debit Note 
											</button>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_akseptasi_false;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Plan ID</th>
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
										<th>Premi EM/EP</th>
										<th>Underwriting</th>
										<th class="hidden-xs">Tgl. Input</th>
										<th class="hidden-xs">Status</th>
										<th class="hidden-xs">User Input</th>
										<th class="hidden-xs">Action</th>
									</tr>
								</thead>
							<tbody>
							</tbody>
							</table>
						</div>
					</div>
					</form>
				</div>
				<!-- tab -->
				<div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Kumpulan
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
							<form action="<?= site_url('pay_premium/search_debitur') ?>" method="post" class="horizontal-form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">
													Dari Tanggal Akseptasi
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
												data-date-start-date="-90d">
													<input type="text" class="form-control" name="period_start" required="required" id="period_start">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<!-- <span class="help-block">Dalam Hari</span> -->
											</div>
										</div>
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">
													Sampai Tanggal Akseptasi
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="input-group date date-picker" data-date-format="dd-mm-yyyy" 
												data-date-start-date="-90d">
													<input type="text" class="form-control" name="period_end" required="required" id="period_end">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<!-- <span class="help-block">This is inline help </span> -->
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">
													Perusahaan/Client
													<span class="required" aria-required="true">*</span>
												</label>
												<select name="bank_id" id="bank_id" required="required" class="select2_category form-control" data-placeholder="Pilih Bank" tabindex="1">
													<option></option>
													<?php foreach ($get_bank as $val) { ?>
														<option value="<?= $val->bank_id ?>"><?= $val->bank_name ?></option>
													<?php } ?>
												</select>
												<!-- <span class="help-block">Dalam Hari</span> -->
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
								</div>
								<div class="form-actions right">
									<input type="submit" name="submit" value="Cari" class="btn blue">
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Perorangan
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_akseptasi_false;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Plan ID</th>
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
										<th>Premi EM/EP</th>
										<th>Underwriting</th>
										<th class="hidden-xs">Tgl. Input</th>
										<th class="hidden-xs">Status</th>
										<th class="hidden-xs">User Input</th>
										<th class="hidden-xs">Action</th>
									</tr>
								</thead>
							<tbody>
							</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- tab -->
				<div class="tab-pane" id="tab_2">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Sudah dibuat
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_akseptasi_true;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Plan ID</th>
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
										<th>Premi EM/EP</th>
										<th>Underwriting</th>
										<th class="hidden-xs">Tgl. Input</th>
										<th class="hidden-xs">Status</th>
										<th class="hidden-xs">User Input</th>
										<th class="hidden-xs">Action</th>
									</tr>
								</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- tab -->
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT