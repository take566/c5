<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if(($alignImage == 'right') || (empty($alignImage))) : ?>

    <div class="offscreen-hero-unit" id="offscreen-hero-unit-<?php echo $bID; ?>">
        <div class="offscreen-hero-unit__content padding-right-85">
            <?php if (isset($heroUnitContent) && trim($heroUnitContent) != "") { ?>
                <?php echo $heroUnitContent; ?>
            <?php } ?>
        </div>
        <div class="animated-parent <?php echo (!empty($animateOnce)) ? 'animate-once' : '' ?>" data-appear-top-offset="-300">
            <div class="offscreen-hero-unit__image-right">
                <img src="<?php if ($heroImage) { ?><?php echo $heroImage->getURL(); ?><?php } ?>" class="animated <?php echo $contentAnimation; ?>" alt="">
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if($alignImage == 'left') : ?>

    <div class="offscreen-hero-unit" id="offscreen-hero-unit-<?php echo $bID; ?>">
        <div class="animated-parent <?php echo (!empty($animateOnce)) ? 'animate-once' : '' ?>" data-appear-top-offset="-300">
            <div class="offscreen-hero-unit__image-left">
                <img src="<?php if ($heroImage) { ?><?php echo $heroImage->getURL(); ?><?php } ?>" class="animated <?php echo $contentAnimation; ?>" alt="">
            </div>
        </div>
        <div class="offscreen-hero-unit__content padding-left-85">
            <?php if (isset($heroUnitContent) && trim($heroUnitContent) != "") { ?>
                <?php echo $heroUnitContent; ?>
            <?php } ?>
        </div>
    </div>

<?php endif; ?>