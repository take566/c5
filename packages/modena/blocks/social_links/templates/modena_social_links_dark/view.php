<?php defined('C5_EXECUTE') or die("Access Denied."); 
$pk = Package::getByHandle('modena');
?>

<div id="ccm-block-social-links<?php echo $bID?>" class="ccm-block-social-links">
    <ul class="sharing-icons">
    <?php foreach($links as $link) {
        $service = $link->getServiceObject();
        ?>
        <li class="sharing-icon"><a target="_blank" class="sharing-icon--dark <?php echo $pk->getConfig()->get('vidal.ensemble.social_button_shape') == 'round' ? 'sharing-icon--round' : ''; ?>" href="<?php echo h($link->getURL()); ?>"><?php echo $service->getServiceIconHTML(); ?></a></li>
    <?php } ?>
    </ul>
</div>