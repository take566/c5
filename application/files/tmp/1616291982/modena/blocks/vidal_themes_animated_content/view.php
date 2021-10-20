<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="animated-parent <?php  if (isset($animateOnce) && trim($animateOnce) != "" && array_key_exists($animateOnce, $animateOnce_options)) : ?>
        <?php  echo $animateOnce; ?><?php endif; ?>" data-appear-top-offset="<?php  if (isset($offset) && trim($offset) != "") : ?>
            <?php  echo h($offset); ?>
        <?php endif; ?>">
    <div class="animated
        <?php  if (isset($chooseAnimation) && trim($chooseAnimation) != "" && array_key_exists($chooseAnimation, $chooseAnimation_options)) : ?>
            <?php  echo $chooseAnimation; ?>
        <?php endif; ?>

        <?php  if (isset($animationSpeed) && trim($animationSpeed) != "" && array_key_exists($animationSpeed, $animationSpeed_options)) : ?>
            <?php  echo $animationSpeed; ?>
        <?php endif; ?>">

        <?php  if (isset($animatedContents) && trim($animatedContents) != "") : ?>
            <?php  echo $animatedContents; ?>
        <?php endif; ?>
    </div>
</div>
