<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header.php'); ?>

	<section>
		<div class="section-pt1">
			<?php
				$a = new Area('Main1');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div><!-- section-pt1 -->
	</section>

	<section>
		<div class="section-pt2" id="firstattck">
			<?php
				$a = new Area('Main2');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt3">
			<?php
				$a = new Area('Main3');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div><!-- section-pt3 -->
	</section>

	<section>
		<div class="section-pt4">
			<?php
				$a = new Area('Main4');
				$a->setAreaGridMaximumColumns(12);
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt5">
			<?php
				$a = new Area('Main5');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

<?php $this->inc('elements/footer.php'); ?>