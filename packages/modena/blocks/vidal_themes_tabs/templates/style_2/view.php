<?php  defined("C5_EXECUTE") or die("Access Denied.");
$tab_body = 1; 
$tab_header = 1; 
$current_title = 0;
$current_content = 0;
?>

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
    <div class="tabs tabs__style-2 <?php echo $animation." ".$animationSpeed; ?>">
        <?php if (!empty($addTabs_items)) : ?>
            <ul class="list no-margin">
                <?php  foreach ($addTabs_items as $addTabs_item_key => $addTabs_item) : ?>
                    <?php $current_title++ ?>
                    <?php  if (isset($addTabs_item["tabHeading"]) && trim($addTabs_item["tabHeading"]) != "") : ?>
                        <li class="list__item--inline-block list-item--tabs <?php if($current_title == 1){echo ' current-list-tab';} ?>" data-tab="tab-<?php echo $tab_header ++ ?>">
                            <?php  echo h($addTabs_item["tabHeading"]); ?>
                        </li>
                    <?php  endif; ?>
                <?php  endforeach; ?>
            </ul>
            <?php  foreach ($addTabs_items as $addTabs_item_key => $addTabs_item) : ?>
                <?php $current_content++ ?>
                <?php  if (isset($addTabs_item["tabContent"]) && trim($addTabs_item["tabContent"]) != "") : ?>
                    <div id="tab-<?php echo $tab_body ++ ?>" class="tabs__content <?php if($current_content == 1){echo ' current-content-tab';} ?>">
                        <div class="tabs__content-side-borders"><?php  echo $addTabs_item["tabContent"]; ?></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
