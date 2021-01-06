<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header_diary_detail.php'); ?>

	<section>
		<div class="section-pt5-1">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="box-all">
									<div class="border-line">
										<div class="day_area">
											<?php
											$page = \Page::getCurrentPage();
											?>
											<span class="title-monthry"><?php
											echo $page->getCollectionDatePublicObject()->format('F');
											?></span>
											<span class="title-day"><?php
											echo $page->getCollectionDatePublicObject()->format('j');
											?></span>
											<span class="day"><?php
											echo $page->getCollectionDatePublicObject()->format('S');
											?></span>
											<span class="year"><?php
											echo $page->getCollectionDatePublicObject()->format('Y');
											?></span>
											<?php
				                                // $a = new Area('Main1');
				                                // $a->display($c);
				                            ?>
				                            <hr class="long">
										</div>
										<div class="images-box">
											<?php
											    $a = new Area('Thumbnail Image');
											    $a->display($c);
				                            ?>
										</div>
										<div class="caption">
											<?php
				                                $a = new Area('Main2');
				                                $a->display($c);
				                            ?>
										</div>
									</div>
								</div>
							</div>
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