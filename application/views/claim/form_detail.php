<?php $this->load->view('layout/notification') ?>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
				<div class="actions btn-set">
					<a href="<?php echo $this->agent->referrer()?>" class="btn default"><i class="fa fa-angle-left"></i> Kembali</a>
					<?php $get_permission = $this->auth->get_permission(294) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?=site_url('claim/confirm/').$get_claim->claim_id?>" class="btn green" onclick="return confirm('Konfirmasi debitur?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
					<?php } ?>
					<?php $get_permission = $this->auth->get_permission(334) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?= site_url('claim/acceptance/').$get_claim->claim_id.'/13' ?>" class="btn red" onclick="return confirm('Aksep Klaim?')"><i class="fa fa-times"></i> Klaim diterima</a>
					<a href="<?= site_url('claim/acceptance/').$get_claim->claim_id.'/12' ?>" class="btn red" onclick="return confirm('Tolak Klaim?')"><i class="fa fa-times"></i> Klaim ditolak</a>
					<?php } ?>
					<?php $get_permission = $this->auth->get_permission(300) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?= site_url('claim/acceptance/').$get_claim->claim_id.'/14' ?>" class="btn blue" onclick="return confirm('Bayar Klaim?')"><i class="fa fa-check-circle"></i> Bayar Klaim</a>
					<?php } ?>
				</div>
			</div>	
		</div>	
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Data Pengajuan Klaim </a>
				</li>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Dokumen Klaim </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Catatan </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Data Pengajuan Klaim
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
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Status Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <span class="label label-primary"><?= $get_claim->rowstate_name ?> </span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<!-- row -->
									<h3 class="form-section">Detail Klaim</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->bank_name ?>
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
												<label class="control-label col-md-6">Nama Debitur:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->debitur_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tempat Lahir:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->birth_place ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tanggal Lahir:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= date('d-m-Y', strtotime($get_claim->datebirth)) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Usia:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->age ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nomor Identitas:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->no_id ?>
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
												<label class="control-label col-md-6">Jenis Kelamin:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_claim->gender_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Pekerjaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->job_name ?>
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
												<label class="control-label col-md-6">Uang Pertanggungan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_product->currency_id.'. 	'.number_format($get_claim->sum_insured) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Periode:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->period.' '.$get_product->term_loan_type_id ?>
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
												<label class="control-label col-md-6">Mulai Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= date('d-m-Y', strtotime($get_claim->period_start)) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Akhir Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= date('d-m-Y', strtotime($get_claim->period_end)) ?>
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
												<label class="control-label col-md-6">Underwriting:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_claim->underwriting_type ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Premi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_product->currency_id.'. '.number_format($get_claim->premi + $get_claim->premi_emep) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tgl. Kejadian:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= date('d-m-Y', strtotime($get_claim->insident_date)) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tgl. Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= date('d-m-Y', strtotime($get_claim->create_date)) ?>
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
												<label class="control-label col-md-6">Jenis Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_claim->claim_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Alasan Klaim:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $get_claim->claim_reason ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jumlah Diajukan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_product->currency_id.'. '.number_format($get_claim->sum_insured_proposed) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?= site_url('claim/edit/'.$get_claim->claim_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>													
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
				<!-- OPEN FOR MEDIS -->
				<div class="tab-pane" id="tab_1">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Dokumen Klaim
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(332) ?>
							<?php if($get_permission->permission){  ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?= site_url('claim/upload_doc_claim/'.$get_claim->claim_id)?>" id="sample_editable_1_new" class="btn green">
											Upload Dokumen <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<!-- END OPEN ONLY BANK -->

							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_DocClaim;?>">
								<thead>
									<tr>
										<th>No#</th>
										<th>Jenis Dokumen</th>
										<th>Nama Dokumen</th>
										<th>Nama File</th>
										<th>Keterangan</th>
										<th class="hidden-xs">Tgl. Input</th>
										<th class="hidden-xs">Action</th>
									</tr>
								</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
				</div>	
				<div class="tab-pane" id="tab_2">
					<!-- BEGIN PORTLET-->
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bubble font-red-sunglo"></i>
								<span class="caption-subject font-red-sunglo ">Catatan</span>
							</div>
						</div>
						<div class="portlet-body" id="chats">
							<div class="scroller" style="height: 341px;" data-always-visible="1" data-rail-visible1="1">
								<ul class="chats">
									<?php foreach ($get_claim_note as $val) { ?>
									<?php if($val->user_entity == 3) { $class = "in"; } else { $class = "out"; } ?>
										<li class="<?= $class ?>">
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												<?= $val->user_inp ?> </a>
												<span class="datetime">
												at <?= $val->create_date ?> </span>
												<span class="body"><?= $val->note ?></span>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
							<form action="<?= site_url('claim/add_note/'.$get_claim->claim_id)?>" method="post">
								<div class="chat-form">
									<div class="input-cont">
										<input class="form-control" name="note" type="text" placeholder="Masukan Catatan..." required="required" />
									</div>
									<div class="btn-cont">
										<span class="arrow">
										</span>
										<button class="btn blue icn-only"><i class="fa fa-check icon-white"></i></button>
										
										</a>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT