<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Proses Klaim </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Klaim Ditolak </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Klaim Diterima </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<form action="<?= site_url('claim/pay')?>" method="post">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Proses Klaim
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">							
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_proccess;?>">
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
								<i class="icon-docs"></i>Klaim Ditolak
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_accept;?>">
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
				<div class="tab-pane" id="tab_2">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Klaim Diterima
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_reject;?>">
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
				<!-- <div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Klaim Dibayar
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_pay;?>">
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
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT
