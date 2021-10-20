<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if (isset($loopVideo) && trim($loopVideo) != "") : ?>
    <?php $videoLoop = ($loopVideo == 1 ? "loop" : ""); ?>
<?php endif; ?>


<div class="video-hero-unit-container">
    <div class="video-hero-unit">
        <div class="video-hero-unit__overlay"></div>
        <?php if (isset($videoBackground) || ($videoBackgroundBackup) && $videoBackground || $videoBackgroundBackup !== false) : ?>
            <video autoplay muted <?php echo $videoLoop; ?>>
                <source src="<?php echo $videoBackground->urls["relative"]; ?>">
                <?php if (isset($videoBackgroundBackup) && $videoBackgroundBackup !== false) : ?>
                    <source src="<?php echo $videoBackgroundBackup->urls["relative"]; ?>">
                <?php endif; ?>
            </video>
        <?php endif; ?>

        <div class="video-hero-unit__content">
            <div class="grid-container">
                <div class="grid-row">
                    <div class="column-12 animated-parent <?php echo $contentAlignment; ?>">

                        <h2 class="animated <?php echo $headingAnimation ?>">
                            <?php if (isset($heroUnitHeading) && trim($heroUnitHeading) != "") : ?>
                                <?php echo h($heroUnitHeading); ?>
                            <?php endif; ?>
                        </h2>

                        <div class="animated <?php echo $contentAnimation ?>">
                            <?php if (isset($heroUnitContent) && trim($heroUnitContent) != "") : ?>
                                <?php echo $heroUnitContent; ?>
                            <?php endif; ?>
                        </div>

                        <div class="animated-parent">
                            <?php if( $linkPicker == '' ) {
                                echo "";
                            } ?>

                            <?php if( $linkPicker == 'page' ) : ?>
                                <?php if (!empty($buttonUrl) && ($buttonUrl_c = Page::getByID($buttonUrl)) && !$buttonUrl_c->error && !$buttonUrl_c->isInTrash()) : ?>
                                    <a class="button animated <?php echo $buttonAnimation ?> <?php echo $buttonType.$buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $buttonUrl_c->getCollectionLink() ?>">
                                        <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                                            <i class="fa <?php echo $buttonIcons; ?>"></i>
                                        <?php endif; ?>
                                        <?php echo (isset($buttonUrl_text) && trim($buttonUrl_text) != "" ? $buttonUrl_text : $buttonUrl_c->getCollectionName()) ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if( $linkPicker == 'external' ) : ?>
                                <?php if (isset($externalLink) && trim($externalLink) != "" ) : ?>
                                    <a class="button animated <?php echo $buttonAnimation ?> <?php echo $buttonType.$buttonColors; ?> <?php echo $buttonRadius; ?>" href="<?php echo $externalLink ?>">
                                        <?php if (isset($buttonIcons) && trim($buttonIcons) != "") : ?>
                                            <i class="fa <?php echo $buttonIcons; ?>"></i>
                                        <?php endif; ?>
                                        <?php echo (isset($externalLink_text) && trim($externalLink_text) != "" ? $externalLink_text : $externalLink) ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .video-hero-unit {
        <?php if ($posterImage) : ?>
            background-image: url(<?php echo $posterImage->getURL(); ?>);
        <?php endif; ?>
    }
    .video-hero-unit-container {
        <?php if ($heroUnitBottomMargin) : ?>
            margin-bottom: <?php echo h($heroUnitBottomMargin); ?>px;
        <?php endif; ?>
    }
</style>