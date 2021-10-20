<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="form-group">
    <?php
    if (isset($lightboxLargeImage) && $lightboxLargeImage > 0) {
        $lightboxLargeImage_o = File::getByID($lightboxLargeImage);
        if (!is_object($lightboxLargeImage_o)) {
            unset($lightboxLargeImage_o);
        }
    } ?>
    <?php  echo $form->label('lightboxLargeImage', t("Lightbox Large Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This image will be show when the smaller image is clicked on.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('lightboxLargeImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $app->make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_lightbox-lightboxLargeImage-' . $app->make('helper/validation/identifier')->getString(18), $view->field('lightboxLargeImage'), t("Choose Image"), $lightboxLargeImage_o); ?>
</div>

<div class="form-group">
    <?php
    if (isset($lightboxSmallImage) && $lightboxSmallImage > 0) {
        $lightboxSmallImage_o = File::getByID($lightboxSmallImage);
        if (!is_object($lightboxSmallImage_o)) {
            unset($lightboxSmallImage_o);
        }
    } ?>
    <?php  echo $form->label('lightboxSmallImage', t("Lightbox Small Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This image will be shown on your page, when clicking on this image the larger image will be shown") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('lightboxSmallImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $app->make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_lightbox-lightboxSmallImage-' . $app->make('helper/validation/identifier')->getString(18), $view->field('lightboxSmallImage'), t("Choose Image"), $lightboxSmallImage_o); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('lightboxCaption', t("Lightbox Caption") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This caption will appear under the large lightboxed image") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('lightboxCaption', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->text($view->field('lightboxCaption'), $lightboxCaption, array ('maxlength' => 255,)); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('altText', t("Alt Text") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Alt text is used to convey the image contents to assistive technologies for disabled users, alt text should be short but descriptive.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('altText', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->text($view->field('altText'), $altText, array ('maxlength' => 255,)); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('lightboxGallery', t("Lightbox or Gallery") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Decide if you want to make your lightboxed image part of a gallery, with the gallery option enabled, viewers will be able to jump from one image to another that have also been made part of the gallery.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('lightboxGallery', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->select($view->field('lightboxGallery'), $lightboxGallery_options, $lightboxGallery, array()); ?>
</div>
