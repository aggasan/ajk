<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<?php if($get_policy->rowstate == 'planned'){
						$flag_button_konfirmasi = '';
					} else {
						$flag_button_konfirmasi = 'disabled=""';
					} ?>
			<div class="actions btn-set">
				<a href="<?= site_url('policy') ?>" class="btn default"><i class="fa fa-angle-left"></i> Kembali</a>
				<?php $get_permission = $this->auth->get_permission(313) ?>
				<?php if($get_permission->permission){ ?>
				<a href="<?=site_url('policy/confirm/').$get_policy->policy_id?>" class="btn green" <?=$flag_button_konfirmasi?> onclick="return confirm('Konfirmasi Polis Master?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
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
				<li>
					<a href="#tab_1" data-toggle="tab">
					Perusahaan/Client </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Informasi Umum
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
												<label class="control-label col-md-6">Status Polis:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <span class="label label-primary"><?= $get_policy->rowstate ?> </span>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
									</div>
									<!-- row -->
									<h3 class="form-section">Informasi Umum</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->bank_name ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->insurance_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Produk:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->product_name ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nomor Polis:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->policy_number ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Masa Tunggu Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->waiting_period ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Grace Period:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->grace_period ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Flag Cetak Sertifikat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?php if($get_policy->print_certificate == 1)
															{ echo "Ya"; } else { echo "Tidak"; } ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Auto Cancel Registrati Peserta:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_policy->auto_cancel ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tipe Periode Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_policy->period_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Klausa Polis:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_policy->klausa_polis ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Template Sertifikat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_policy->certificate_template_name ?>
													</p>
												</div>
											</div>
										</div>
										<!-- span -->
									</div>
									<!-- row -->
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<?php $get_permission = $this->auth->get_permission(237) ?>
													<?php if($get_permission->permission){ ?>
													<?php if($get_policy->rowstate == 'planned') { ?>
													<a href="<?= site_url('policy/edit/'.$get_policy->policy_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>
													<?php } ?>
													<?php } ?>
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
				<div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i>Detail Perusahaan/Client
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a><!-- 
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a> -->
								<a href="javascript:;" class="reload">
								</a><!-- 
								<a href="javascript:;" class="remove">
								</a> -->
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
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