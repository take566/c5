<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if (isset($chooseAnimation) && trim($chooseAnimation) != "" && array_key_exists($chooseAnimation, $chooseAnimation_options)) : ?>
    <?php $animation = "animated"." ".$chooseAnimation; ?>
<?php endif; ?>

<?php if (isset($animationOffset) && trim($animationOffset) != "") : ?>
    <?php $offset = "data-appear-top-offset='$animationOffset'"; ?>
<?php endif; ?>

<?php if (isset($animateOnce) && trim($animateOnce) != "") : ?>
    <?php $runOnce = ($animateOnce == 1 ? "animate-once" : ""); ?>
<?php endif; ?>

<?php if($iconPosition == "icon-box__icons--icons-std") : ?>
    <div class="animated-parent <?php echo $buttonPosition." ".$runOnce; ?>" <?php echo $offset ?>>
        <div class="icon-box margin-top-40 padding-top-50 padding-left-20 padding-right-20 <?php echo $iconBoxBorder." ".$animation." ".$animationSpeed; ?>">
            <?php  if (isset($chooseIcon) && trim($chooseIcon) != "") : ?>
                <div class="icon-box__icons <?php  echo $iconPosition; ?>" id="icon-box-<?php echo $bID ?>">
                    <i class="fa <?php  echo $chooseIcon; ?>"></i>
                </div>
            <?php  endif; ?>
            <?php  if (isset($iconBoxContent) && trim($iconBoxContent) != "") : ?>
                <div class="icon-box__content full-width">
                    <?php echo $iconBoxContent; ?>
                </div>
            <?php  endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if($iconPosition == "icon-box__icons--icons-left") : ?>
    <div class="animated-parent <?php echo $buttonPosition." ".$runOnce; ?>" <?php echo $offset ?>>
        <div class="icon-box padding-left-20 <?php echo $animation." ".$animationSpeed; ?>">
            <?php  if (isset($chooseIcon) && trim($chooseIcon) != "") : ?>
                <div class="icon-box__icons <?php echo $iconPosition; ?>" id="icon-box-<?php echo $bID ?>">
                    <i class="fa <?php  echo $chooseIcon; ?>"></i>
                </div>
            <?php  endif; ?>
            <?php  if (isset($iconBoxContent) && trim($iconBoxContent) != "") : ?>
                <div class="icon-box__content margin-left-70">
                    <?php echo $iconBoxContent; ?>
                </div>
            <?php  endif; ?>
        </div>
    </div>
<?php endif; ?>