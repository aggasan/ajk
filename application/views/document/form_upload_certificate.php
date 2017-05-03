<?php $this->load->view('layout/notification') ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-docs"></i><?= $title_form ?>
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
		<form action="<?= site_url($flag_url) ?>" method="post" enctype="multipart/form-data" class="horizontal-form">
		<!-- HIDDEN FOR POST -->
		<input type="hidden" name="debitur_id" value="<?= $getDebitur->debitur_id ?>">
		<!-- HIDDEN FOR POST -->
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Jenis Dokumen
								<span class="required" aria-required="true">*</span>
							</label>
							<select name="document_type_id" required="required" class="select2_category form-control" tabindex="1">
								<option></option>
								<?php foreach ($get_document_type as $val) { ?>
									<!-- # code... -->
									<option value="<?= $val->document_type_id ?>"><?= $val->document_type_name ?></option>
								<?php } ?>
							</select>
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nomor Sertifikat
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="certificate_number" class="form-control" placeholder="Masukan Text" required="required">
							<!-- <span class="help-block">Nama Dokumen</span> -->
						</div>
					</div>
					<!--/span-->			
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Keterangan
								<!-- <span class="required" aria-required="true">*</span> -->
							</label>
							<input type="text" name="information" class="form-control" placeholder="Masukan Text">
							<!-- <span class="help-block">Nama Dokumen</span> -->
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<label class="control-label">
									File Dokumen
									<span class="required" aria-required="true">*</span>
								</label>
								<div class="input-group">
									<div class="form-control uneditable-input" data-trigger="fileinput">
										<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
										</span>
									</div>
									<span class="input-group-addon btn default btn-file">
									<span class="fileinput-new">
									Select file </span>
									<span class="fileinput-exists">
									Change </span>
									<input type="file" name="up_file">
									</span>
									<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
									Remove </a>
								</div>
							</div>
							<span class="help-block">Tipe file yang diperbolehkan *.pdf dan ukuran file maksimal 2 MB</span>
						</div>
					</div>
					<!--/span-->	
				</div>
				<!-- row -->
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('document/list_data/0') ?>" class="btn default" onclick="return confirm('Batal Upload??')"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Upload" onclick="return confirm('Upload Dokumen??')"/>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>