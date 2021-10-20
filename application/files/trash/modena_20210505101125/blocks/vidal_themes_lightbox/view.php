<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<a data-lightbox="<?php  echo $lightboxGallery; ?>" href="<?php  echo $lightboxLargeImage->getURL(); ?>" data-caption='<?php  if (isset($lightboxCaption) && trim($lightboxCaption) != "") : ?>
    <?php  echo h($lightboxCaption); ?>
        <?php endif; ?>'>
            <img class="tester" src="<?php  echo $lightboxSmallImage->getURL(); ?>" alt="<?php  if (isset($altText) && trim($altText) != "") : ?>
        <?php  echo h($altText); ?>
    <?php endif; ?>">
</a>
