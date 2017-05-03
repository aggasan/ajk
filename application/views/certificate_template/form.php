<script type="text/javascript">
	var postForm = function() {
		var certificate_text = $('textarea[name="certificate_text"]').html($('#summernote').code());
	}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Template Sertifikat
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
								Nama Template Sertifikat
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="certificate_template_name" value="<?php echo isset($get_certificate_template->certificate_template_name)?$get_certificate_template->certificate_template_name:''?>" class="form-control" placeholder="Masukan Text" required="required">
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
							<?php $rowstate = isset($get_certificate_template->rowstate)?$get_certificate_template->rowstate:'' ?>
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
				<!-- row -->
				<div class="row">
					<div class="form-group">
						<!-- <label class="control-label col-md-1">Default Editor</label> -->
						<div class="col-md-12">
							<textarea id="summernote_1" name="certificate_text">
							<?php echo isset($get_certificate_template->certificate_text)?$get_certificate_template->certificate_text:''?>
							</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('certificate_template') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" id="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>