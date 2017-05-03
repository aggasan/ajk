<?php $this->load->view('layout/notification') ?>
<!-- INPUT MASK CURRENCY-->
<script type="text/javascript">
	$(document).ready(function(){
  		$('.money').inputmask("numeric", {
		    radixPoint: ".",
		    groupSeparator: ",",
		    digits: 2,
		    autoGroup: true,
		    // prefix: '$', //No Space, this will truncate the first character
		    rightAlign: false,
		    min: 0,
		    max: 100,
		    // integer: { min: 0, max: 255 },
		    oncleared: function() {
		    	self.value('');
			}
		});
	});
</script>
<div class="row">			
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title"><!-- 
				<div class="caption">
					<i class="fa fa-shopping-cart"></i>Test Product
				</div> -->
				<div class="actions btn-set">
					<?php 
						if($getDebitur->premi == 0 or $getDebitur->rate == 0 OR is_null($getDebitur->underwriting) OR is_null($getDebitur->underwriting_type)){ 
							$flag_button_premi = '';
							$flag_button_konfirmasi = 'disabled=""';
						} else {
							$flag_button_premi = 'disabled=""';

							if($getDebitur->rowstate == 4 ){
								$flag_acceptance = '';
							} else {
								$flag_acceptance = 'disabled=""';								
							}

							if($this->session->userdata('user_entity') == 3){
								if($getDebitur->rowstate == 1){
									$healt_debitur_id = isset($getHealt->debitur_id)?$getHealt->debitur_id:'';
									$spaj_debitur_id = isset($getDocSPAJ->debitur_id)?$getDocSPAJ->debitur_id:'';

									if(!$healt_debitur_id OR !$spaj_debitur_id ){
										if($getDebitur->underwriting == 'FCL'){
											$flag_button_konfirmasi = '';
										} else {
											$flag_button_konfirmasi = 'disabled=""';
										}
									} else {
										$flag_button_konfirmasi = '';
									}
								} else {
									$flag_button_konfirmasi = 'disabled=""';
								}
							} else if($this->session->userdata('user_entity') == 4){
								if($getDebitur->rowstate == 2){
									$flag_button_konfirmasi = '';
								} else {
									$flag_button_konfirmasi = 'disabled=""';
								}
							} else if($this->session->userdata('user_entity') == 2){
								if($getDebitur->rowstate == 3){
									$flag_button_konfirmasi = '';
								} else {
									$flag_button_konfirmasi = 'disabled=""';
								}
							}	
						}
					?>
					<a href="<?php echo $this->agent->referrer()?>" class="btn default"><i class="fa fa-angle-left"></i> Kembali</a>
					
					<?php if ($this->session->userdata('user_entity') == 3 ){?>
					<a href="<?=site_url('debitur/count_premi/').$getDebitur->debitur_id?>" class="btn blue" <?=$flag_button_premi?> onclick="return confirm('Hitung premi?')"><i class="fa fa-check-circle"></i> Hitung Premi</a>
					<?php } ?>
					<?php $get_permission = $this->auth->get_permission(291) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?=site_url('debitur/confirm/').$getDebitur->debitur_id?>" class="btn green" <?=$flag_button_konfirmasi?> onclick="return confirm('Konfirmasi debitur?')"><i class="fa fa-check-circle"></i> Konfirmasi</a>
					<?php } ?>
					
					<?php $get_permission = $this->auth->get_permission(315) ?>
					<?php if($get_permission->permission){  ?>
					<a href="<?= site_url('debitur/acceptance/').$getDebitur->debitur_id.'/6' ?>" class="btn blue" <?=$flag_acceptance?> onclick="return confirm('Akseptasi diterima??')"><i class="fa fa-check-circle"></i> Akseptasi diterima</a>
					<a href="<?= site_url('debitur/acceptance/').$getDebitur->debitur_id.'/7' ?>" class="btn red" <?=$flag_acceptance?> onclick="return confirm('Akseptasi ditolak?')"><i class="fa fa-times"></i> Akseptasi ditolak</a>
					<a href="<?= site_url('debitur/acceptance/').$getDebitur->debitur_id.'/7' ?>" class="btn yellow" <?=$flag_acceptance?> onclick="return confirm('Akseptasi ditolak?')"><i class="fa fa-check-circle"></i> Akseptasi ditangguhkan</a>
					<?php } ?>
					<!-- CREATE URL PERMISSION USER ENTITY -->
				</div>
			</div>	
		</div>	
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_0" data-toggle="tab">
					Data Debitur </a>
				</li>
				<!-- OPEN FOR MEDIS -->
				<?php if($getDebitur->underwriting == 'M' OR $getDebitur->underwriting == 'NM'){ ?>
				<li>
					<a href="#tab_1" data-toggle="tab">
					Dokumen SPAJK </a>
				</li>
				<?php } ?>
				<!-- END OPEN FOR MEDIS -->
				<?php if($getDebitur->underwriting == 'M'){ ?>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Dokumen Medis / Tambahan </a>
				</li>
				<li>
					<a href="#tab_3" data-toggle="tab">
					EM / EP </a>
				</li>
				<?php } ?>
				<li>
					<a href="#tab_4" data-toggle="tab">
					Riwayat Pengajuan </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_0">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Data Debitur
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
												<label class="control-label col-md-6">Status Debitur:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <span class="label label-primary"><?= $getDebitur->rowstate_name ?> </span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<!-- row -->
									<h3 class="form-section">Data Debitur</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Debitur:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->debitur_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">No. Akad:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= $getDebitur->no_akad ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Usia:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->age.' Tahun' ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tanggal Lahir:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?= date('d-m-Y', strtotime($getDebitur->datebirth)) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Tempat Lahir:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->birth_place ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Identitas:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->identity_type_name ?>
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
														 <?= $getDebitur->no_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Pekerjaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->job_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Detail Pekerjaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->job_detail ?>
													</p>
												</div>
											</div>
										</div>
									</div>
									<h3 class="form-section">Kontak Debitur</h3>
									<div class="row">
										<!--/span-->
										<!-- <div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nearest:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?php
														
										?>
													</p>
												</div>
											</div>
										</div>
										<!--/span--> 
									
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3">Alamat:</label>
												<div class="col-md-9">
													<p class="form-control-static">
														 <?= $getDebitur->address ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Kota:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->city_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">No. Handphone:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->handphone ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Telepon:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->phone ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Email:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->email ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
									<h3 class="form-section">Produk</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Perusahaan/Client:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->bank_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Produk:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->product_name?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->insurance_type_name ?>
													</p>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Periode:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->period.' '.$get_product->term_loan_type_id ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Mulai Asuransi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= date('d-m-Y', strtotime($getDebitur->period_start)) ?>
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
														 <?= date('d-m-Y', strtotime($getDebitur->period_end)) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Rate:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->rate ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Uang Pertanggungan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_product->currency_id.'. '.number_format($getDebitur->sum_insured) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Premi:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_product->currency_id.'. '.number_format($getDebitur->premi) ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Premi EM/EP:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $get_product->currency_id.'. '.number_format($getDebitur->premi_emep) ?>
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
												<label class="control-label col-md-6">Nomor Sertifikat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->certificate_number ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Medis:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->underwriting_type ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<h3 class="form-section">Tempat Bekerja</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Nama Instansi / Perusahaan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->company_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jenis Bidang Usaha:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->business_field_name ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Jabatan:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->position ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6">Alamat:</label>
												<div class="col-md-6">
													<p class="form-control-static">
														 <?= $getDebitur->company_address ?>
													</p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
									<h3 class="form-section">Benefit</h3>
									<?php 
										$i = 1;
										$debitur_id = $getDebitur->debitur_id;
										$getBenefitProduct = $this->Debitur_premi_m->getByDebitur($debitur_id);
									?>
									<?php foreach ($getBenefitProduct as $val) { ?>
									<div class="row">
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-2"><?= $i++ ?>.</label>
												<div class="col-md-10">
													<p class="form-control-static">
													 <?= $val->benefit_name ?>
													</p>
													
												</div>
											</div>
										</div>
									</div>
									<!--/row--> 
									<?php } ?>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<?php $get_permission = $this->auth->get_permission(215) ?>
													<?php if($get_permission->permission){ ?>
													<?php if($getDebitur->rowstate == 1) { ?>
													<a href="<?= site_url('debitur/edit/'.$getDebitur->debitur_id)?>" class="btn green"><i class="fa fa-pencil"></i> Edit</a>
													<?php } ?>
													<?php } ?>
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
				<?php if($getDebitur->underwriting == 'M' OR $getDebitur->underwriting == 'NM'){ ?>
				
				<div class="tab-pane" id="tab_1">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>Hasil Data Kesehatan Calon Peserta / Debitur - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?>
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
							<form action="<?= site_url('debitur/add_healt') ?>" method="post" class="horizontal-form">
							<!-- HIDDEN FOR POST -->
							<input type="hidden" name="debitur_id" value="<?= $getDebitur->debitur_id ?>">
							<!-- HIDDEN FOR POST -->
								<div class="form-body">
									<!-- <h3 class="form-section">Informasi Umum</h3> -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Tinggi badan
													<span class="required" aria-required="true">* Cm</span>
												</label>
												<input type="text" name="height" value="<?=isset($getHealt->height)?$getHealt->height:''?>" class="form-control" placeholder="Masukan Angka" required="required">
												<!-- <span class="help-block"> </span> -->
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Berat badan
													<span class="required" aria-required="true">* Kg</span>
												</label>
												<input type="text" name="weight" value="<?=isset($getHealt->weight)?$getHealt->weight:''?>" class="form-control" placeholder="Masukan Angka" required="required">
												<!-- <span class="help-block"> </span> -->
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Apakah ada perubahan berat badan lebih dari 3kg dalam 12 bulan terakhir
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $weight_changes = isset($getHealt->weight_changes)?$getHealt->weight_changes:'' ?>
														<select name="weight_changes" required="required" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($weight_changes=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($weight_changes=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-4">
														<?php $weight_changes_opt = isset($getHealt->weight_changes_opt)?$getHealt->weight_changes_opt:'' ?>
														<select name="weight_changes_opt" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($weight_changes_opt=='Bertambah') echo "selected"; ?> value="Bertambah">Bertambah</option>
															<option <?php if($weight_changes_opt=='Berkurang') echo "selected"; ?> value="Berkurang">Berkurang</option>
														</select>
													</div>
													<div class="col-md-4">
														<input type="text" name="weight_changes_val" value="<?=isset($getHealt->weight_changes_val)?$getHealt->weight_changes_val:''?>" class="form-control" placeholder="Masukan Angka">
														<span class="help-block">Kg </span>
													</div>
												</div>
												
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Apakah anda merokok selama 12 bulan terakhir
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $smoke = isset($getHealt->smoke)?$getHealt->smoke:'' ?>
														<select name="smoke" required="required" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($smoke=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($smoke=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-8">
														<input type="text" name="smoke_explanation" value="<?=isset($getHealt->smoke_explanation)?$getHealt->smoke_explanation:''?>" class="form-control" placeholder="Penjelasan">
														<!-- <span class="help-block">This is inline help </span> -->
													</div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Apakah anda pernah atau sedang menderita atau mendapatkan perawatan untuk penyakit kanker, tumor, jantung dan pembuluh darah, darah, tekanan darah tinggi, stroke atau gangguan fungsi otak, ginjal dan saluran kencing, kencing manis, penyakit hatitier atau hepatitis, saluran pencernaan, paru-paru, TBC, atau saluran pernafasan lainnya, sistem saraf, sistem otot tulang atau sendi, infeksi HIV/AIDS, kelenjar gondok, epilepsi, terluka parah, infeksi, atau menyandang cacat fisik atau gangguan kesehatan jiwa atau keterbelakangan mental, kelainan bawaan, gangguan pendengaran atau penglihatan, atau penyakit lain yang tidak bisa disebutkan diatas?
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $disease = isset($getHealt->disease)?$getHealt->disease:'' ?>
														<select name="disease" required="required" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($disease=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($disease=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-8">
														<input type="text" name="disease_explanation" value="<?=isset($getHealt->disease_explanation)?$getHealt->disease_explanation:''?>" class="form-control" placeholder="Penjelasan">
														<!-- <span class="help-block">This is inline help </span> -->
													</div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Apakah anda mempunyai kebiasaan atau pernah menggunakan narkotik atau obat-obatan atau alkohol, atau pernah dirawat/atau mendapat nasihat dokter karena hal tersebut atau mempunyai hobi atau kebiasaan berbahaya seperti mendaki gunung, terjun payung, arum jeram, balap motor, dll?
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $narcotic = isset($getHealt->narcotic)?$getHealt->narcotic:'' ?>
														<select name="narcotic" required="required" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($narcotic=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($narcotic=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-8">
														<input type="text" name="narcotic_explanation" value="<?=isset($getHealt->narcotic_explanation)?$getHealt->narcotic_explanation:''?>" class="form-control" placeholder="Penjelasan">
														<!-- <span class="help-block">This is inline help </span> -->
													</div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Pernahkan permintaan asuransi anda ditolak atau ditangguhkan atau dikenakan extra premi atau dikenakan persyaratan khusus?
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $insurance_denial = isset($getHealt->insurance_denial)?$getHealt->insurance_denial:'' ?>
														<select name="insurance_denial" required="required" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($insurance_denial=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($insurance_denial=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-8">
														<input type="text" name="insurance_denial_explanation" value="<?=isset($getHealt->insurance_denial_explanation)?$getHealt->insurance_denial_explanation:''?>" class="form-control" placeholder="Penjelasan">
														<!-- <span class="help-block">This is inline help </span> -->
													</div>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Apakah anda saat ini sedang hamil? bagaimana kondisi kehamilan anda saat ini
													<!-- <span class="required" aria-required="true">*</span> -->
												</label>
												<div class="row">
													<div class="col-md-4">
														<?php $pregnant = isset($getHealt->pregnant)?$getHealt->pregnant:'' ?>
														<select name="pregnant" class="select2_category form-control" tabindex="1">
															<option></option>
															<option <?php if($pregnant=='Ya') echo "selected"; ?> value="Ya">Ya</option>
															<option <?php if($pregnant=='Tidak') echo "selected"; ?> value="Tidak">Tidak</option>
														</select>
													</div>
													<div class="col-md-8">
														<input type="text" name="pregnant_explanation" value="<?=isset($getHealt->pregnant_explanation)?$getHealt->pregnant_explanation:''?>" class="form-control" placeholder="Penjelasan">
													</div>
												</div>
												<span class="help-block">Hanya diisi oleh calon tertanggung wanita. </span>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
								</div>
								<?php $get_permission = $this->auth->get_permission(316) ?>
								<?php if($get_permission->permission){ ?>
								<!-- OPEN IF NULL -->
								<?php 
								$debitur_id = isset($getHealt->debitur_id)?$getHealt->debitur_id:'';
								if(!$debitur_id){ ?>
								<div class="form-actions right">
									<input type="submit" name="submit" class="btn blue"  value="Simpan" onclick="return confirm('Simpan data kesehatan?')"/>
								</div>
								<?php } ?>
								<!-- END OPEN IF NULL -->
								<?php } ?>
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->					
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Dokumen SPAJK - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<?php $get_permission = $this->auth->get_permission(317) ?>
							<?php if($get_permission->permission){ ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?= site_url('debitur/upload_doc_fpaj/'.$getDebitur->debitur_id)?>" id="sample_editable_1_new" class="btn green">
											Upload Dokumen <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_FPAJ;?>">
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
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
				<div class="tab-pane" id="tab_2">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Dokumen Medis / Tambahan - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?>
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
											<a href="<?= site_url('debitur/upload_doc_medis/'.$getDebitur->debitur_id)?>" id="sample_editable_1_new" class="btn green">
											Upload Dokumen <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_Medis;?>">
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
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
				<div class="tab-pane" id="tab_3">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-docs"></i>EM / EP - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?>
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
							<form action="<?= site_url('debitur/add_emep') ?>" method="post" enctype="multipart/form-data" class="horizontal-form">
							<!-- HIDDEN FOR POST -->
							<input type="hidden" name="debitur_id" value="<?= $getDebitur->debitur_id ?>">
							<!-- HIDDEN FOR POST -->
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Kondisi
													<span class="required" aria-required="true">*</span>
												</label>
												<?php $condition = isset($getEmep->condition)?$getEmep->condition:'' ?>
												<select name="condition" required="required" class="select2_category form-control" tabindex="1">
													<option></option>
													<option <?php if($condition == 'Standar') echo "selected"; ?> value="Standar">Standar</option>
													<option <?php if($condition == 'Substandar') echo "selected"; ?> value="Substandar">Substandar</option>
													<option <?php if($condition == 'Decline') echo "selected"; ?> value="Decline">Decline</option>
												</select>
												<!-- <span class="help-block"> </span> -->
											</div>
										</div>
										<!--/span-->	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Tipe
													<!-- <span class="required" aria-required="true">*</span> -->
												</label>
												<?php $type = isset($getEmep->type)?$getEmep->type:'' ?>
												<select name="type" class="select2_category form-control" tabindex="1">
													<option></option>
													<option <?php if($type == 'EM') echo "selected"; ?> value="EM">EM</option>
													<option <?php if($type == 'EP') echo "selected"; ?> value="EP">EP</option>
												</select>
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
													Penambahan Persentase Premi
													<!-- <span class="required" aria-required="true">* (%)</span> -->
												</label>
												<input type="text" name="percent" class="form-control" placeholder="Masukan Angka" value="<?= isset($getEmep->percent)?$getEmep->percent:'' ?>">
												<!-- <span class="help-block"></span> -->
											</div>
										</div>
										<!--/span-->	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Status
													<!-- <span class="required" aria-required="true">*</span> -->
												</label>
												<?php $rowstate = isset($getEmep->rowstate)?$getEmep->rowstate:'' ?>
												<select name="rowstate" class="select2_category form-control" tabindex="1">
													<option></option>
													<option <?php if($rowstate =='Medical Status') echo "selected"; ?> value="Medical Status">Medical Status</option>
													<option <?php if($rowstate =='Over Insurance') echo "selected"; ?> value="Over Insurance">Over Insurance</option>
												</select>
												<!-- <span class="help-block">Nama Dokumen</span> -->
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Premi
													<span class="required" aria-required="true">(<?= $getDebitur->currency_id?>)</span>
												</label>
												<input type="text" name="note" class="form-control money" placeholder="Masukan Angka" required="required" readonly="" value="<?= isset($getEmep->premi)?$getEmep->premi:'' ?>">
												<!-- <span class="help-block">Nama Dokumen</span> -->
											</div>
										</div>
										<!--/span-->
									</div>
									<!-- row -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Catatan
													<!-- <span class="required" aria-required="true"></span> -->
												</label>
												<input type="text" name="note" class="form-control" placeholder="Masukan Text" value="<?= isset($getEmep->note)?$getEmep->note:'' ?>">
												<!-- <span class="help-block">Nama Dokumen</span> -->
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
								<?php $get_permission = $this->auth->get_permission(319) ?>
								<?php if($get_permission->permission){ ?>
									<!-- OPEN IF NULL -->
									<?php 
									$debitur_id = isset($getEmep->debitur_id)?$getHealt->debitur_id:'';
									if(!$debitur_id){ ?>
									<div class="form-actions right">
										<input type="submit" name="submit" class="btn blue"  value="Simpan" onclick="return confirm('Proses EM/EP?')"/>
									</div>
									<?php } ?>
									<!-- END OPEN IF NULL -->
								<?php } ?>
								<!-- OPEN ONLY INSURANCE -->
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Dokumen EM / EP - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<!-- OPEN ONLY INSURANCE -->
							<?php $get_permission = $this->auth->get_permission(320) ?>
								<?php if($get_permission->permission){  ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?= site_url('debitur/upload_doc_emep/'.$getDebitur->debitur_id)?>" id="sample_editable_1_new" class="btn green">
											Upload Dokumen <i class="fa fa-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<!-- END OPEN ONLY INSURANCE -->
							<table class="table table-striped table-bordered table-hover sample_6" data-url="<?php echo $datatablesUrl_EMEP;?>">
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
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
				<?php } ?>
				<div class="tab-pane" id="tab_4">
					<!-- BEGIN PORTLET-->
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bubble font-red-sunglo"></i>
								<span class="caption-subject font-red-sunglo ">Riwayat Pengajuan - <?= $getDebitur->debitur_name.' - '.$getDebitur->policy_id ?></span>
							</div>
						</div>
						<div class="portlet-body" id="chats">
							<div class="scroller" style="height: 341px;" data-always-visible="1" data-rail-visible1="1">
								<ul class="chats">
									<?php foreach ($get_debitur_note as $val) { ?>
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
							<form action="<?= site_url('debitur/add_note/'.$getDebitur->debitur_id)?>" method="post">
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