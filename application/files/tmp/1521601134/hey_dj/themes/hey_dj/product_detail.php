<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_product_detail.php'); ?>

	<section>
		<div class="section-pt3-1">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="images-box">
							<?php
							    $a = new Area('Thumbnail Image');
							    $a->display($c);
                            ?>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="caption">
							<?php
                                $a = new Area('Main');
                                $a->display($c);
                            ?>
						</div>
					</div>
				</div><!-- row -->
			</div><!-- container -->
		</div><!-- section-pt3 -->
	</section>

<?php $this->inc('elements/footer.php'); ?>