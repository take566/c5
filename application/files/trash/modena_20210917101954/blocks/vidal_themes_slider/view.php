<?php defined("C5_EXECUTE") or die("Access Denied."); 
    $c = Page::getCurrentPage();
?>
<?php if($c->isEditMode()) : ?>

    <div class="no-edit">
        <h4><?php echo h("Deactivated in edit mode") ?></h4>
    </div>

<?php else : ?>

<div class="ensemble-slideshow-container">
    <div class="ensemble-slideshow"
        data-cycle-loader="wait"
        data-cycle-log="false"
        data-cycle-fx="<?php  echo $slideDirection; ?>"
        data-cycle-slide-class="ensemble-slideshow__slide"
        data-cycle-timeout="<?php if (!empty($slideDuration)) {
        echo $slideDuration . "000";
            } else {
                echo "8000";
            } ?>"
    data-cycle-slide-class="ensemble-slideshow__slide"
    <?php if ($arrowNavigation == 1) {
        echo 'data-cycle-prev=".ensemble-slideshow__previous-slide"
              data-cycle-next=".ensemble-slideshow__next-slide"';
    } ?>
    <?php if ($navigationPager == 1) {
        echo 'data-cycle-pager=".ensemble-slideshow__pager"';
    } ?>
    data-cycle-slides="> div"
    id="slider-<?php echo $bID ?>">

    <?php  if (!empty($slide_items)) : ?>
        <?php  foreach ($slide_items as $slide_item_key => $slide_item) : ?>
            <?php  if ($slide_item["slideImage"]) : ?>

                <div class="ensemble-slideshow__first-slide">
                    <img src="<?php  echo $slide_item["slideImage"]->getURL(); ?>" alt="<?php  echo $slide_item["slideImage"]->getTitle(); ?>"/>
                    <div class="ensemble-slideshow__layer">

                        <div class="ensemble-slideshow__caption <?php echo $slide_item["captionHeadingAnimation"]; ?>">
                            <?php if (isset($slide_item["captionHeading"]) && trim($slide_item["captionHeading"]) != "") : ?>
                                <h2><?php echo h($slide_item["captionHeading"]); ?></h2>
                            <?php endif; ?>
                        </div>

                        <div class="ensemble-slideshow__caption <?php echo $slide_item["captionContentAnimation"]; ?>">
                            <?php if (isset($slide_item["CaptionContent"]) && trim($slide_item["CaptionContent"]) != "") : ?>
                                <?php echo $slide_item["CaptionContent"]; ?>
                            <?php endif; ?>
                        </div>

                        <div class="ensemble-slideshow__caption <?php echo $slide_item["buttonAnimation"]; ?> <?php echo $slide_item["buttonPosition"]; ?>">
                            <?php if (!empty($slide_item["buttonUrl"]) && ($slide_item["buttonUrl_c"] = Page::getByID($slide_item["buttonUrl"])) && !$slide_item["buttonUrl_c"]->error && !$slide_item["buttonUrl_c"]->isInTrash()) : ?>
                                <a class="button <?php echo $slide_item["buttonType"] ?><?php echo $slide_item["buttonColors"]; ?> <?php echo $slide_item["buttonRadius"]; ?>" href="<?php echo $slide_item["buttonUrl_c"]->getCollectionLink() ?>">
                                    <?php if (isset($slide_item["buttonIcons"]) && trim($slide_item["buttonIcons"]) != "") : ?>
                                        <i class="fa <?php echo $slide_item["buttonIcons"]; ?>"></i>
                                    <?php endif; ?>
                                    <?php echo (isset($slide_item["buttonUrl_text"]) && trim($slide_item["buttonUrl_text"]) != "" ? $slide_item["buttonUrl_text"] : $slide_item["buttonUrl_c"]->getCollectionName()) ?>
                                </a>
                            <?php endif; ?>

                            <?php if (isset($externalUrl) && trim($externalUrl) != "") : ?>
                                <a class="button <?php echo $slide_item["buttonType"] ?><?php echo $slide_item["buttonColors"]; ?> <?php echo $slide_item["buttonRadius"]; ?>" href="<?php $slide_item["externalUrl"] ?>">
                                    <?php if (isset($slide_item["buttonIcons"]) && trim($slide_item["buttonIcons"]) != "") : ?>
                                        <i class="fa <?php echo $slide_item["buttonIcons"]; ?>"></i>
                                    <?php endif; ?>
                                    <?php echo (isset($slide_item["externalUrl_text"]) && trim($slide_item["externalUrl_text"]) != "" ? $slide_item["externalUrl_text"] : $slide_item["externalUrl"]) ?>
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
        <?php if ($arrowNavigation == 1) : ?>
            <a href="#" class="ensemble-slideshow__previous-slide">
                <i class="fa fa-angle-left"></i>
            </a>
            <a href="#" class="ensemble-slideshow__next-slide">
                <i class="fa fa-angle-right"></i>
            </a>
        <?php endif; ?>
    </div>
    <?php if ($navigationPager == 1) : ?>
        <div class="ensemble-slideshow__pager ensemble-slideshow__pager--on-slider ensemble-slideshow__pager--rounded"></div>
    <?php endif; ?>
</div>

<?php endif; ?>