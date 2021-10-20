<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div class="blog-sharing__icons-wrapper">

        <?php foreach ($selected as $service) { ?>
            
            <a class="blog-sharing__icons" href="<?php echo h($service->getServiceLink()) ?>" target="_blank" aria-label="<?php echo h($service->getDisplayName()) ?>">
                <?php echo $service->getServiceIconHTML()?>
            </a>
            
        <?php } ?>

</div>
