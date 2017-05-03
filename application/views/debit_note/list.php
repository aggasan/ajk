<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Pembayaran Belum Dikonfirmasi </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Pembayaran Sudah dikonfirmasi </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Closing </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<form action="<?= site_url('debit_note/pay_confirm')?>" method="post">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Pembayaran Belum Dikonfirmasi
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(298) ?>
							<?php if($get_permission->permission){ ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<input type="submit" name="pay" value="Konfirmasi Pembayaran" class="btn blue" onclick="return confirm('Konfirmasi Pembayaran?')">
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_false;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Perusahaan/Client</th>
										<th>Nomor</th>
										<th>Premi</th>
										<th>Tgl. Jatuh Tempo</th>
										<th>Tgl. Dibuat</th>
										<th class="hidden-xs">Status</th>
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
								<i class="icon-docs"></i>Pembayaran Sudah dikonfirmasi 
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_true;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Perusahaan/Client</th>
										<th>Nomor</th>
										<th>Premi</th>
										<th>Tgl. Jatuh Tempo</th>
										<th>Tgl. Dibuat</th>
										<th class="hidden-xs">Status</th>
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
								<i class="icon-docs"></i>Closing
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_close;?>">
								<thead>
									<tr>
										<th>#</th>
										<th>No#</th>
										<th>Perusahaan/Client</th>
										<th>Nomor</th>
										<th>Premi</th>
										<th>Tgl. Jatuh Tempo</th>
										<th>Tgl. Dibuat</th>
										<th class="hidden-xs">Status</th>
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