<script type="text/javascript">
	var postForm = function() {
		var certificate_text = $('textarea[name="certificate_text"]').html($('#summernote').code());
	}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-docs"></i><?= $header_form ?>
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			</a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?= site_url(uri_string()) ?>" method="post" class="horizontal-form" id="postForm">
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Roles
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="roles_name" value="<?php echo isset($get_roles->roles_name)?$get_roles->roles_name:''?>" class="form-control" placeholder="Masukan Text" required="required">
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Status
								<span class="required" aria-required="true">*</span>
							</label>
							<?php $rowstate = isset($get_roles->rowstate)?$get_roles->rowstate:'' ?>
							<select name="rowstate" required="required" class="select2_category form-control" data-placeholder="Pilih salah satu" tabindex="1">
								<option></option>
									<option <?php if($rowstate == 'planned' ) echo "selected"; ?> value="planned">planned</option>
									<option <?php if($rowstate == 'active' ) echo "selected"; ?> value="active">active</option>
							</select>
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->	
				</div>
				<!--/row-->
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
								<?php if(is_null($line->roles_id)){
								$checked = ""; 
								} else {
								$checked = "checked";
								} ?>
								<input type="checkbox" name="module_line_id[]" value="<?php echo $line->module_line_id ?>" class="icheck" <?php echo $checked ?>><?php echo $line->module_line_name ?>
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
									<?php if(is_null($line->roles_id)){
									$checked = ""; 
									} else {
									$checked = "checked";
									} ?>
									<input type="checkbox" name="module_line_id[]" value="<?php echo $line->module_line_id ?>" class="icheck" <?php echo $checked ?>><?php echo $line->module_line_name ?>
									<?php } ?>
									</div>
							</div>
						</div>
					</div>	
					<?php } ?>
				<?php } ?>							
				<!--/row-->
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('roles/detail/'.$roles_id) ?>" class="btn default"  onclick="return confirm('Batalkan Roles?')"/>Batal</a>
				<input type="submit" name="submit" id="submit" class="btn blue" value="<?= $button_form ?>" onclick="return confirm('Proses Roles?')"/>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>