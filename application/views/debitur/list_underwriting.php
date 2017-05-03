<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Data FCL </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Data Non Medis </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Data Medis </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Data FCL
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_FCL;?>">
								<thead>
									<tr>
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
				<div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Data Non Medis
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_NM;?>">
								<thead>
									<tr>
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
				<div class="tab-pane" id="tab_2">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Data Medis
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<!-- BEGIN FORM-->
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_M;?>">
								<thead>
									<tr>
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
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT