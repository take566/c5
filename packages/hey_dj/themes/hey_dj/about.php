<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_about.php'); ?>

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
		<div class="section-crew">
			<?php
				$a = new Area('Main3');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-work-place">
			<?php
				$a = new Area('Main4');
				$a->setAreaGridMaximumColumns(12);
				$a->display($c);
			?>
		</div>
	</section>
	<section>
		<div class="section-work-place-pt2">
			<?php
				$a = new Area('Main5');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-contact">
			<?php
				$a = new Area('Main6');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

<?php $this->inc('elements/footer.php'); ?>