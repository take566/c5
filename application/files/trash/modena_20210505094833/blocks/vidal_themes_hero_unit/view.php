<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="hero-unit hero-unit--banner-<?php echo $bID ?>">
    <div class="hero-unit--overlay"></div>
    <div class="hero-unit__content">
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

<style media="screen">
    <?php if (Page::getCurrentPage()->isEditMode()) : ?>
        .hero-unit--banner-<?php echo $bID ?> {
            height: 100vh;
        }
    <?php endif; ?>
    .hero-unit--banner-<?php echo $bID ?> {
        background-image: url(<?php if ($heroUnitBackgroundImage) : ?>
            <?php  echo $heroUnitBackgroundImage->getURL(); ?>
        <?php endif; ?>);
        margin-bottom: <?php echo (!empty($heroUnitBottomMargin)) ? h($heroUnitBottomMargin) : '100'; ?>px;
    }
</style>