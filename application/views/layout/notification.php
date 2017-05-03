<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong><?php echo $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('warning')): ?>
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>
		<?php if(is_array($this->session->flashdata('warning'))){
			$i = 0;
			foreach ($this->session->flashdata('warning') as $warning) {
				$i ++;
				echo $i.'. '.$warning.'<br>';
			}
		} else {
			echo $this->session->flashdata('success');
		}

		?>
		</a>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong><?php echo $this->session->flashdata('error'); ?></a>
	</div>
<?php endif; ?>

