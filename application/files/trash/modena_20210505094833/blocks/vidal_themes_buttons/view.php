<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if (isset($chooseAnimation) && trim($chooseAnimation) != "" && array_key_exists($chooseAnimation, $chooseAnimation_options)) : ?>
    <?php $animation = "animated"." ".$chooseAnimation; ?>
<?php endif; ?>

<?php if (isset($animationOffset) && trim($animationOffset) != "") : ?>
    <?php $offset = "data-appear-top-offset='$animationOffset'"; ?>
<?php endif; ?>

<?php if (isset($animateOnce) && trim($animateOnce) != "") : ?>
    <?php $runOnce = ($animateOnce == 1 ? "animate-once" : ""); ?>
<?php endif; ?>

<div class="animated-parent <?php echo $buttonPosition." ".$runOnce; ?>" <?php echo $offset ?>>

    <?php if( $linkPicker == '' ) {
        echo "";
    } ?>

    <?php if( $linkPicker == 'page' ) : ?>
        <?php if (!empty($buttonUrl) && ($buttonUrl_c = Page::getByID($buttonUrl)) && !$buttonUrl_c->error && !$buttonUrl_c->isInTrash()) : ?>
            <a class="button <?php echo $animation." ".$animationSpeed; ?> <?php echo $buttonType.$buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $buttonUrl_c->getCollectionLink() ?>">
                <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                    <i class="fa <?php echo $buttonIcons; ?>"></i>
                <?php endif; ?>
                <?php echo (isset($buttonUrl_text) && trim($buttonUrl_text) != "" ? $buttonUrl_text : $buttonUrl_c->getCollectionName()) ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if( $linkPicker == 'external' ) : ?>
        <?php if (isset($externalUrl) && trim($externalUrl) != "") : ?>
            <a class="button <?php echo $animation." ".$animationSpeed; ?> <?php echo $buttonType.$buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $externalUrl ?>">
                <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                    <i class="fa <?php echo $buttonIcons; ?>"></i>
                <?php endif; ?>
                <?php echo (isset($externalUrl_text) && trim($externalUrl_text) != "" ? $externalUrl_text : $externalUrl) ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>

</div>