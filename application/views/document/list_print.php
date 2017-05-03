<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<div class="btn-group">
						<a class="btn default yellow-stripe dropdown-toggle" href="javascript:;" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
						<span class="hidden-480">
						<?php if($this->uri->segment(3) == 0) { echo "Belum Didownload"; } else { echo "Sudah Didownload "; } ?> </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?= site_url('document/list_data_print/0')?>">
								Belum Didownload </a>
							</li>
							<li>
								<a href="<?= site_url('document/list_data_print/1')?>">
								Sudah Didownload </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<?php if($this->uri->segment(3) == 0) { $flag_info = "Belum Didownload"; } else { $flag_info = "Sudah Didownload"; } ?> </span>
					<a href="#tab_0" data-toggle="tab">
					Sertifikat</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<!-- EQUITY -->
					<form action="<?= site_url('document/generate_certificate')?>" method="post">
					<!-- END EQUITY -->
					
					<!-- LIPPO -->
					<!-- <form action="<?= site_url('debitur/upload_doc_certificate')?>" method="post"> -->
					<!-- END LIPPO -->

					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Sertifikat <?= $flag_info ?>	
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<input type="submit" name="download" value="Download Sertifikat" class="btn blue" onclick="return confirm('Download Sertifikat?')">
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Plan ID</th>
										<th>Perusahaan/Client</th>
										<th>Nama Debitur</th>
										<th>Nama Produk</th>
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
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT