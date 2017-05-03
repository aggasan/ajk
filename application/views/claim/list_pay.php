<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Belum Dibayar </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Sudah Dibayar </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<form action="<?= site_url('claim/pay')?>" method="post">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Belum Dibayar
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">							
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_not_pay;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Perusahaan/Client</th>
										<th>Nama Debitur</th>
										<th>Mulai Asuransi</th>
										<th>Akhir Asuransi</th>
										<th>No. Sertifikat</th>
										<th>Uang Pertanggungan</th>
										<th>Tgl. Kejadian</th>
										<th>Alasan Klaim</th>
										<th>Total Diajukan</th>
										<th class="hidden-xs">Tgl. Klaim</th>
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
				<div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Sudah Dibayar
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(300) ?>
							<?php if($get_permission->permission){ ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<input type="submit" name="pay" value="Bayar Klaim" class="btn blue" onclick="return confirm('Bayar Klaim?')">
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_is_pay;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Perusahaan/Client</th>
										<th>Nama Debitur</th>
										<th>Mulai Asuransi</th>
										<th>Akhir Asuransi</th>
										<th>No. Sertifikat</th>
										<th>Uang Pertanggungan</th>
										<th>Tgl. Kejadian</th>
										<th>Alasan Klaim</th>
										<th>Total Diajukan</th>
										<th class="hidden-xs">Tgl. Klaim</th>
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
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT
