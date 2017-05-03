<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<?php if($getBankById->rowstate == 'planned'){
						$flag_button_konfirmasi = '';
					} else {
						$flag_button_konfirmasi = 'disabled=""';
					} ?>
			<div class="actions btn-set">
				<a href="<?= site_url('bank') ?>" class="btn default"><i class="fa fa-angle-left"></i> Kembali</a>
				<?php $get_permission = $this->auth->get_permission(311) ?>
				<?php if($get_permission->permission){ ?>
				<a href="<?=site_url('bank/confirm/').$getBankById->bank_id?>" class="btn green" <?=$flag_button_konfirmasi?> onclick="return confirm('Konfirmasi Perusahaan/Client?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
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
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Detail Perusahaan / Client
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
												<label class="control-label col-md-6">Status Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <span class="label label-primary"><?= $getBankById->rowstate ?> </span>
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
												<label class="control-label col-md-6">Nama Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->bank_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->bank_type_name ?>
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
												<label class="control-label col-md-6">No. Telp:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->phone ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Fax:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->fax ?>
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
												<label class="control-label col-md-6">Kode Pos:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->zipcode ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Pimpinan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->ceo ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Alamat</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Alamat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->address ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Kecamatan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->district ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Kota:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getBankById->city_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-pencil"></i> Edit</button>
													<!-- <button type="button" class="btn default">Cancel</button> -->
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
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT