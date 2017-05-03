<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php $this->load->view('layout/notification') ?>
<div class="portlet box red-intense">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Produk
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="javascript:;" class="reload">
			</a>
		</div>
	</div>
	<div class="portlet-body">
		<?php $get_permission = $this->auth->get_permission(198) ?>
		<?php if($get_permission->permission){  ?>
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<a href="<?= site_url('product/add')?>" id="sample_editable_1_new" class="btn green">
						Tambah Produk <i class="fa fa-plus"></i>
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
				 Nama Produk
			</th>
			<th>
				 Plan ID
			</th>
			<th>
				 Informasi Cara Bayar
			</th>
			<th class="hidden-xs">
				 Jenis Kredit
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
