<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php $this->load->view('layout/notification') ?>
<div class="portlet box red-intense">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Roles
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<a href="<?= site_url('roles/add')?>" id="sample_editable_1_new" class="btn green">
						Tambah Roles <i class="fa fa-plus"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl;?>">
			<thead>
				<tr>
					<th>
						 No#
					</th>
					<th>
						 Nama Roles
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
