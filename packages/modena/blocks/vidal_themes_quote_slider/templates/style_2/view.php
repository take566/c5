<?php defined("C5_EXECUTE") or die("Access Denied."); 
    $c = Page::getCurrentPage();
?>

<?php if($c->isEditMode()) : ?>

<div class="no-edit">
    <h4><?php echo h("Deactivated in edit mode") ?></h4>
</div>

<?php else : ?>

<div class="ensemble-slideshow-container margin-bottom-20">
    <div class="ensemble-slideshow"
        data-cycle-fx="scrollHorz"
        data-cycle-timeout="8000"
        data-cycle-loader="wait"
        data-cycle-pause-on-hover="true"
        data-cycle-speed="400"
        data-cycle-prev=".ensemble-slideshow__previous-slide"
        data-cycle-slide-class="ensemble-slideshow__slide"
        data-cycle-next=".ensemble-slideshow__next-slide"
        data-cycle-pager=".ensemble-slideshow__testimonial-slider-pager"
        data-cycle-auto-height="container"
        data-cycle-slides="> div">

<?php if (!empty($testimonialSlider_items)) { ?>
    <?php foreach ($testimonialSlider_items as $testimonialSlider_item_key => $testimonialSlider_item) { ?>
        <div>
            <div class="testimonial-slider">
            <?php if (!empty($testimonialSlider_item["testimonialImage"])) : ?>
                    <div class="testimonial-slider__avatar">
                        <img src="<?php echo $testimonialSlider_item["testimonialImage"]->getURL(); ?>" alt="<?php echo $testimonialSlider_item["testimonialImage"]->getTitle(); ?>"/>
                    </div>
                <?php else: ?>
                    <img class="testimonial-slider__dummy-image" src="<?php echo $this->getThemePath()?>/images/image.png" />
                <?php endif; ?>
                <div class="testimonial-slider__quote">
                    <div class="testimonial-slider__quote--divider">
                        <?php echo $testimonialSlider_item["testimonialQuote"]; ?>
                    </div>
                    <div class="testimonial-slider__meta">
                        <span class="testimonial-slider__meta-name"><?php echo h($testimonialSlider_item["testimonailName"]); ?></span>
                        <span class="testimonial-slider__meta-position">
                            <span class="testimonial-slider__divider">//</span>
                                <?php if (isset($testimonialSlider_item["testimonialPosition"]) && trim($testimonialSlider_item["testimonialPosition"]) != "") { ?>
                                    <?php echo h($testimonialSlider_item["testimonialPosition"]); ?>
                                <?php } ?>
                            <span class="testimonial-slider__divider">//</span>
                            <?php echo "<a href=\"" . $testimonialSlider_item["testimonailUrl"] . "\">" . (isset($testimonialSlider_item["testimonailUrl_text"]) && trim($testimonialSlider_item["testimonailUrl_text"]) != "" ? $testimonialSlider_item["testimonailUrl_text"] : $testimonialSlider_item["testimonailUrl"]) . "</a>"; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
            <?php } ?>
                <?php } ?>
                    <!-- <a href="#" class="ensemble-slideshow__previous-slide">
                        <i class="ion-ios-arrow-left"></i>
                    </a>
                    <a href="#" class="ensemble-slideshow__next-slide">
                        <i class="ion-ios-arrow-right"></i>
                    </a> -->
                </div>
                <div class="ensemble-slideshow__testimonial-slider-pager text-center"></div>
            </div>
        <?php endif; ?>