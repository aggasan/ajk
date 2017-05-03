<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php $this->load->view('layout/notification') ?>
<div class="portlet box red-intense">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Template Sertifikat
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
		</div>
	</div>
	<div class="portlet-body">
		<?php $get_permission = $this->auth->get_permission(192) ?>
		<?php if($get_permission->permission){ ?>
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<a href="<?= site_url('certificate_template/add')?>" id="sample_editable_1_new" class="btn green">
						Tambah Template Sertifikat <i class="fa fa-plus"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl;?>">
			<thead>
				<tr>
					<th>
						 No#
					</th>
					<th>
						 Nama Template Sertifikat
					</th>
					<th class="hidden-xs">
						 Tgl. dibuat
					</th>
					<th class="hidden-xs">
						 Status
					</th>
					<th class="hidden-xs">
						 User Input
					</th>
					<th class="hidden-xs">
						 Action
					</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
