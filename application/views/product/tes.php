<div class="modal fade" id="basic_2" tabindex="-1" role="basic_2" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Form Upload Table Medis
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
										<form action="<?= site_url('product/add_underwriting') ?>" method="post" class="horizontal-form" enctype="multipart/form-data">
											<input type="hidden" name="product_id" value="<?= $getProductById->product_id ?>">
											<div class="form-body">
												<!-- <h3 class="form-section">Form Upload Rate</h3> -->
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
												<!--/row-->

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																File
																<span class="required" aria-required="true">*</span>
															</label>									
														
															<div class="fileinput fileinput-new" data-provides="fileinput">
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
																</div><span class="help-block">(xls, xlsx)</span>
															</div>
														</div>

													</div>
													<!--/span-->
													
												</div>
												<!--/row-->

											</div>
											<div class="form-actions">
												<div class="btn-set pull-left">
													<a href="javascript:;" class="btn green">
													<i class="fa fa-file-o"></i> Unduh File Template </a>
												</div>
												<div class="btn-set pull-right">
													<button type="button" class="btn default" data-dismiss="modal">Batal</button>
													<input type="submit" name="submit" class="btn blue" value="Simpan" />
												</div>
												</div>
											</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->