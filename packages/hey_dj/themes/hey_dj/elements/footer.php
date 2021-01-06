<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
	<section>
		<div class="footer">
			<div class="footer-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<?php
								$a = new GlobalArea('footer left');
								$a->display();
							?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<?php
								$a = new GlobalArea('footer center');
								$a->display();
							?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<?php
								$a = new GlobalArea('footer right');
								$a->display();
							?>
						</div>
					</div><!-- row -->
					<!-- Scroll to Top Button -->
					<?php
						$a = new GlobalArea('page top');
						$a->enableGridContainer();//bootstarapコード
						$a->display();
					?>
					<?php
						$a = new GlobalArea('copy right');
						$a->enableGridContainer();//bootstarapコード
						$a->display();
					?>
				</div><!-- container -->
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap JS -->
<script src="<?php echo $this->getThemePath(); ?>/js/bootstrap.min.js"></script> 
<!-- window -->
<script src="<?php echo $this->getThemePath(); ?>/js/autowindow.js"></script> 
<!-- Plugin JavaScript --> 
<script src="<?php echo $this->getThemePath(); ?>/js/jquery.easing.min.js"></script> 
<!-- Plugin parallax --> 
<?php
if (! $c->isEditMode()) { ?>
<script src="<?php echo $this->getThemePath(); ?>/js/skrollr.min.js"></script>
<!--[if lt IE 9]>
	<script type="text/javascript" src="../skrollr-ie/dist/skrollr.ie.min.js"></script>
<![endif]-->
<script src="<?php echo $this->getThemePath(); ?>/js/skrollr.op.js"></script> 
<!-- Plugin height --> 
<?php } ?>

<script src="<?php echo $this->getThemePath(); ?>/js/jquery_filter_animation.js"></script> 

<script src="<?php echo $this->getThemePath(); ?>/js/jquery.matchHeight.js"></script> 
<script>
	$(function(){
		$('.product-title').matchHeight();
		$('.product-subtitle').matchHeight();
		$('.product-title-comment').matchHeight();
		$('.product-label').matchHeight();		
		$('.product-comment').matchHeight();
		$('.product-continue').matchHeight();
		$('.title-day').matchHeight();
		$('.title-monthry').matchHeight();
		$('.img-thumbnail').matchHeight();
		$('.diary-title').matchHeight();
		$('.diary-comment').matchHeight();
	});
</script>

</div>
<?php  Loader::element('footer_required'); ?>

</body>
</html>
