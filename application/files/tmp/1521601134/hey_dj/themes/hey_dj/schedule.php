<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_schedule.php'); ?>

	<section>
		<div class="section-header">
			<?php
				$a = new Area('Main1');
				$a->setAreaGridMaximumColumns(12);
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt6-1">
			<?php
				$a = new Area('Main2');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt6-2">
			<?php
				$a = new Area('Main3');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

<?php $this->inc('elements/footer.php'); ?>