<?php defined('C5_EXECUTE') or die('Access Denied.'); 
$pk = Package::getByHandle('modena');
?>

<div class="ccm-block-share-this-page">
    <ul class="sharing-icons">
    <?php foreach ($selected as $service) { ?>
        <li class="sharing-icon">
            <a class="sharing-icon--dark <?php echo $pk->getConfig()->get('vidal.ensemble.social_button_shape') == 'round' ? 'sharing-icon--round' : ''; ?>" href="<?php echo h($service->getServiceLink()) ?>" target="_blank" aria-label="<?php echo h($service->getDisplayName()) ?>"><?php echo $service->getServiceIconHTML()?></a>
        </li>
    <?php } ?>
    </ul>
</div>
