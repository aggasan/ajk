<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Marketing Program
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
		<form action="<?= site_url(uri_string()) ?>" method="post" class="horizontal-form">
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Nama Marketing Program
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="marketing_program_name" class="form-control" placeholder="Masukan Text" required="required">
							<!-- <span class="help-block"> </span> -->
						</div>
					</div>
					<!--/span-->	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Diskon
								<span class="required" aria-required="true">*</span>
							</label>
							<input type="text" name="discount" class="form-control" placeholder="Masukan Text" required="required">
							<span class="help-block">Dalam Persen (%)</span>
						</div>
					</div>
					<!--/span-->			
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Aktif Dari Tanggal
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
								<input type="text" class="form-control" name="period_start">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
							<!-- <span class="help-block">This is inline help </span> -->
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								Aktif Sampai Tanggal
								<span class="required" aria-required="true">*</span>
							</label>
							<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
								<input type="text" class="form-control" name="period_end">
								<span class="input-group-btn">
								<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!-- row -->
			</div>
			<div class="form-actions right">
				<a href="<?= site_url('policy') ?>" class="btn default"/>Batal</a>
				<input type="submit" name="submit" class="btn blue" value="Simpan" />
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>