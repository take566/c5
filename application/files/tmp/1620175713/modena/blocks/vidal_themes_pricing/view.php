<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if (isset($recommendedColumn) && trim($recommendedColumn) != "") : ?>
    <?php $recColumn = ($recommendedColumn == 1 ? "pricing-column--recommended" : ""); ?>
<?php endif; ?>

<?php if (isset($chooseAnimation) && trim($chooseAnimation) != "" && array_key_exists($chooseAnimation, $chooseAnimation_options)) : ?>
    <?php $animation = "animated"." ".$chooseAnimation; ?>
<?php endif; ?>

<?php if (isset($animationOffset) && trim($animationOffset) != "") : ?>
    <?php $offset = "data-appear-top-offset='$animationOffset'"; ?>
<?php endif; ?>

<?php if (isset($animateOnce) && trim($animateOnce) != "") : ?>
    <?php $runOnce = ($animateOnce == 1 ? "animate-once" : ""); ?>
<?php endif; ?>

<div class="animated-parent <?php echo $recColumn." ".$buttonPosition." ".$runOnce; ?>" <?php echo $offset ?>>
    <div class="pricing-column <?php $animation." ".$animationSpeed." ".$borderRadius; ?>">
        <div class="pricing-column__header">
            <h5 class="no-margin"><?php echo h($packageHeading); ?></h5>
        </div>
        <div class="pricing-column__price background-color-11">
            <span class="pricing-column__price-amount"><?php echo $packagePrice; ?></span>
            <span class="pricing-column__price-interval"><?php echo h($chargeInterval); ?></span>
        </div>
        <div class="pricing-column__content margin-top-30">
            <ul class="list">
                <?php foreach ($packageItems_items as $packageItems_item_key => $packageItems_item) : ?>
                    <?php if (isset($packageItems_item["packageItem"]) && trim($packageItems_item["packageItem"]) != "") : ?>
                        <li class="list__item padding-bottom-5">
                            <?php echo h($packageItems_item["packageItem"]); ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="pricing-column__footer">
            <?php if( $linkPicker == '' ) {
                echo "";
            } ?>

            <?php if( $linkPicker == 'page' ) : ?>
                <?php if (!empty($buttonUrl) && ($buttonUrl_c = Page::getByID($buttonUrl)) && !$buttonUrl_c->error && !$buttonUrl_c->isInTrash()) : ?>
                    <a class="button <?php echo $buttonType; ?><?php echo $buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $buttonUrl_c->getCollectionLink() ?>">
                        <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                            <i class="fa <?php echo $buttonIcons; ?>"></i>
                        <?php endif; ?>
                        <?php echo (isset($buttonUrl_text) && trim($buttonUrl_text) != "" ? $buttonUrl_text : $buttonUrl_c->getCollectionName()) ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( $linkPicker == 'external' ) : ?>
                <?php if (isset($externalUrl) && trim($externalUrl) != "") : ?>
                    <a class="button <?php echo $buttonType; ?><?php echo $buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $externalUrl ?>">
                        <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                            <i class="fa <?php echo $buttonIcons; ?>"></i>
                        <?php endif; ?>
                        <?php echo (isset($externalUrl_text) && trim($externalUrl_text) != "" ? $externalUrl_text : $externalUrl) ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>