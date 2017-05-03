<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions btn-set">
				<?php if($get_certificate_template->rowstate == 'planned'){
					$flag_button_closing = '';
				} else {
					$flag_button_closing = 'disabled=""';
				} ?>
				<a href="<?= site_url('certificate_template/list_data') ?>" class="btn default" onclick="return confirm('Kembali ke halaman sebelumnya?')"><i class="fa fa-angle-left"></i> Kembali</a>
				<?php $get_permission = $this->auth->get_permission(306) ?>
				<?php if($get_permission->permission){ ?>
				<a href="<?=site_url('get_certificate_template/confirm/').$get_certificate_template->certificate_template_id?>" class="btn blue" <?=$flag_button_closing?> onclick="return confirm('Konfirmasi template sertifikat?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
				<?php } ?>
			</div>
		</div>	
	</div>	
	<div class="tabbable-line boxless tabbable-reversed">
		<div class="tab-content">
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-docs"></i>Detail Template Sertifikat
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
										<label class="control-label col-md-6">Nama Template Sertifikat:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_certificate_template->certificate_template_name ?>
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
										<label class="control-label col-md-6">Status:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <span class="label label-primary"><?= $get_certificate_template->rowstate ?></span>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-md-12">
											<textarea id="summernote_1" name="certificate_text"><?= $get_certificate_template->certificate_text ?>
											</textarea>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<?php $get_permission = $this->auth->get_permission(230) ?>
											<?php if($get_permission->permission){ ?>
											<?php if($get_certificate_template->rowstate == !'') { ?>
											<a href="<?= site_url('certificate_template/edit/'.$get_certificate_template->certificate_template_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>
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
	</div>
</div>
<!-- END PAGE CONTENT