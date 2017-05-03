<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php $this->load->view('layout/notification') ?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-docs"></i>List Pengajuan			
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
		</div>
	</div>
	<div class="portlet-body">
		<!-- <div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<a href="<?= site_url('debitur/add')?>" id="sample_editable_1_new" class="btn green">
						Tambah Pengajuan Asuransi <i class="fa fa-plus"></i>
						</a>
					</div>
				</div>
			</div>
		</div> -->
		<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl;?>">
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
<!-- END EXAMPLE TABLE PORTLET-->
