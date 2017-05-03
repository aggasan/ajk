<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions btn-set">
				<?php if($get_roles->rowstate == 'planned'){
					$flag_button_closing = '';
				} else {
					$flag_button_closing = 'disabled=""';
				} ?>
				<a href="<?= site_url('roles/list_data') ?>" class="btn default" onclick="return confirm('Kembali ke halaman sebelumnya?')"><i class="fa fa-angle-left"></i> Kembali</a>
				<a href="<?=site_url('roles/confirm/').$get_roles->roles_id?>" class="btn blue" <?=$flag_button_closing?> onclick="return confirm('Konfirmasi roles?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
			</div>
		</div>	
	</div>	
	<div class="tabbable-line boxless tabbable-reversed">
		<div class="tab-content">
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-docs"></i>Detail Roles
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
										<label class="control-label col-md-6">Nama Roles:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <?= $get_roles->roles_name ?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6">Status:</label>
										<div class="col-md-6">
											<p class="form-control-static">
												 <span class="label label-primary"><?= $get_roles->rowstate ?></span>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!-- row -->
							<h3 class="form-section">Permission</h3>
							<?php $roles_id = isset($get_roles->roles_id)?$get_roles->roles_id:''; ?>
							<?php foreach ($get_module_parent as $val) { ?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label class="col-md-3"><?php echo $val->module_name ?></label>
										<div class="col-md-9">
											<?php $get_module_line = $this->Module_m->get_module_line($val->module_id, $roles_id); ?>
											<?php foreach ($get_module_line as $line) { ?>
											<?php if(is_null($line->roles_id)){ ?>
											 	<label class="control-label"><span class="label label-danger"><i class="fa fa-times"></i>&nbsp;<?php echo $line->module_line_name.'-'.$line->module_line_id  ?></span></label>
											<?php } else { ?>
												<label class="control-label"><span class="label label-primary"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $line->module_line_name.'-'.$line->module_line_id ?></span></label>
											<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>	
								<?php $get_module_child = $this->Module_m->get_child($val->module_id); ?>
								<?php foreach ($get_module_child as $key) { ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
										<label class="col-md-3">&nbsp;&nbsp;&nbsp;<?php echo $key->module_name ?></label>
											<div class="col-md-9">
												<?php $get_module_line = $this->Module_m->get_module_line($key->module_id, $roles_id); ?>
												<?php foreach ($get_module_line as $line) { ?>
												<?php if(is_null($line->roles_id)){ ?>
												 	<label class="control-label"><span class="label label-danger"><i class="fa fa-times"></i>&nbsp;<?php echo $line->module_line_name.'-'.$line->module_line_id  ?></span></label>
												<?php } else { ?>
													<label class="control-label"><span class="label label-primary"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $line->module_line_name.'-'.$line->module_line_id ?></span></label>
												<?php } ?>
												<?php } ?>
												</div>
										</div>
									</div>
								</div>	
								<?php } ?>
							<?php } ?>							
							<!--/row-->
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<a href="<?= site_url('roles/edit/'.$get_roles->roles_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>
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