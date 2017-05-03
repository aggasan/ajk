<!-- BEGIN DASHBOARD STATS -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual">
				<i class="fa fa-comments"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?= $get_debitur->debitur_total ?>
				</div>
				<div class="desc">
					 Total Debitur
				</div>
			</div>
			<a class="more" href="javascript:;">
			Selengkapnya <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual">
				<i class="fa fa-bar-chart-o"></i>
			</div>
			<div class="details">
				<div class="number">
					 IDR. <?= number_format($get_debitur->premi + $get_debitur->premi_emep) ?>
				</div>
				<div class="desc">
					 Total Premi
				</div>
			</div>
			<a class="more" href="javascript:;">
			Selengkapnya <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual">
				<i class="fa fa-shopping-cart"></i>
			</div>
			<div class="details">
				<div class="number">
					 IDR. <?= number_format($get_debitur->sum_insured) ?>
				</div>
				<div class="desc">
					 Total Uang Pertanggungan
				</div>
			</div>
			<a class="more" href="javascript:;">
			Selengkapnya <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number">
					 0
				</div>
				<div class="desc">
					 Total Klaim
				</div>
			</div>
			<a class="more" href="javascript:;">
			Selengkapnya <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
</div>
<!-- END DASHBOARD STATS -->