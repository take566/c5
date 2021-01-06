<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_diary.php'); ?>

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
		<div class="section-pt5-1">
			<?php
				$a = new Area('Main2');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>
	
	<section>
		<div class="section-pt5-3" id="link_title">
			<?php
				$a = new Area('Main8');
				$a->enableGridContainer();//bootstarap
				$a->display($c);
			?>
		</div>
	</section>

	<section>
		<div class="section-pt5-2">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="row">
							<?php
                                $a = new Area('Main7');
                                $a->display($c);
                            ?>
						</div><!-- row -->
					</div><!-- col-md-9 col-sm-9 col-xs-12 -->
					<div class="col-md-3 col-sm-12 col-xs-12">
						<?php 
						$a = new Area('Main3');
						$count = $a->getTotalBlocksInArea($c);
						if($count != 0){ ?>
							<div class="category-box">
						<?php }
	                         $a->display($c);
						if($count != 0){ ?>
							</div>
						<?php } ?>
						
						<?php 
						$a = new Area('Main4');
						$count = $a->getTotalBlocksInArea($c);
						if($count != 0){ ?>
							<div class="archive-box">
								<div class="archive-line">
						<?php }
		                         $a->display($c);
							if($count != 0){ ?>
								</div>
							</div>
						<?php } ?>
						
						<?php 
						$a = new Area('Main5');
						$count = $a->getTotalBlocksInArea($c);
						if($count != 0){ ?>
							<div class="fb-box">
						<?php }
	                         $a->display($c);
						if($count != 0){ ?>
							</div>
						<?php } ?>
						
						<?php
						$a = new Area('Main6');
						$i = $a->getTotalBlocksInArea($c);
						if($i != 0){ ?>
							<div class="tw-box">
						<?php }
							$a->display($c);
                        if($i != 0){ ?>
                            </div>
						<?php } ?>
						
						<?php
						$a = new Area('Main9');
						$i = $a->getTotalBlocksInArea($c);
						if($i != 0){ ?>
							<div class="affiliate">
						<?php }
                           $a->display($c);
                        if($i != 0){ ?>
                            </div>
						<?php } ?>
						
					</div><!-- col-md-3 col-sm-3 col-xs-12 -->
				</div><!-- row -->
			</div><!-- container -->
		</div>
	</section>

<?php $this->inc('elements/footer.php'); ?>