<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_product.php'); ?>

	<section>
		<div class="section-header">
			<?php
				$a = new Area('Main1');
				$a->setAreaGridMaximumColumns(12);
				$a->display($c);
			?>
		</div><!-- section-pt1 -->
	</section>

	<section>
		<div class="product_title" id="link_title">
			<?php
				$a = new Area('Main2');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-anchor-nav">
			<?php
				$a = new Area('Main3');
				$a->enableGridContainer();//bootstarapコード
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt3">
			<?php
				$a = new Area('Main4');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

<?php $this->inc('elements/footer.php'); ?>