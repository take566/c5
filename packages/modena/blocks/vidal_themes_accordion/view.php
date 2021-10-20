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

<div class="animated-parent <?php echo $runOnce; ?>" <?php echo $offset;?>>
    <div class="accordion <?php echo $animation." ".$animationSpeed; ?>">
        <?php  if (!empty($addAccordion_items)) : ?>
            <?php  foreach ($addAccordion_items as $addAccordion_item_key => $addAccordion_item) : ?>
                <?php  if (isset($addAccordion_item["accordionHeading"]) && trim($addAccordion_item["accordionHeading"]) != "") : ?>
                    <div>
                        <header class="accordion__header">
                            <?php  echo h($addAccordion_item["accordionHeading"]); ?>
                        </header>
                            <?php  endif; ?>

                            <?php  if (isset($addAccordion_item["accordionContent"]) && trim($addAccordion_item["accordionContent"]) != "") : ?>
                        <div class="accordion__content">
                            <?php  echo $addAccordion_item["accordionContent"]; ?>
                        </div>
                    <?php  endif; ?>
                </div>
            <?php  endforeach; ?>
        <?php  endif; ?>
    </div>
</div>