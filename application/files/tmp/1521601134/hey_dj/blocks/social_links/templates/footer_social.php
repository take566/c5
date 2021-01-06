<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="center-box">
	<ul class="footer-box">
	    <?php foreach($links as $link) {
	        $service = $link->getServiceObject();
	    ?>
			<li>
				<a href="<?php echo h($link->getURL()) ?>" target="blank" class="footer-title">
					<span class="footer-icon">
						<i class="fa fa-<?php  echo $service->getIcon() ?>"></i>
						<?php echo h($service->getName()) ?>
					</span>
				</a>
			</li>
    	<?php } ?>
    </ul>
</div>

