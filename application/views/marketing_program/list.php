<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php $this->load->view('layout/notification') ?>
<div class="portlet box red-intense">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Marketing Program
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<!-- <a href="#portlet-config" data-toggle="modal" class="config">
			</a> -->
			<a href="javascript:;" class="reload">
			</a>
			<!-- <a href="javascript:;" class="remove">
			</a> -->
		</div>
	</div>
	<div class="portlet-body">
		<?php $get_permission = $this->auth->get_permission(200) ?>
		<?php if($get_permission->permission){ ?>
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<a href="<?= site_url('marketing_program/add')?>" id="sample_editable_1_new" class="btn green">
						Tambah Marketing Program <i class="fa fa-plus"></i>
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
				 Nama Marketing Program
			</th>
			<th>
				 Diskon(%)
			</th>
			<th class="hidden-xs">
				 Berlaku Mulai
			</th>
			<th class="hidden-xs">
				 Berlaku Sampai
			</th>
			<th class="hidden-xs">
				 Tgl. dibuat
			</th>
			<th class="hidden-xs">
				 Status
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
