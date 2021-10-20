<?php defined("C5_EXECUTE") or die("Access Denied.");
    print $app->make('helper/concrete/ui')->tabs(array(
        array('hero-unit-details', t('Hero Unit Details'), true),
        array('hero-unit-settings', t('Hero Unit Settings'))
    ));
    $color = $app->make('helper/form/color');
?>

<div id="ccm-tab-content-hero-unit-details" class="ccm-tab-content">
    <div class="form-group">
        <?php
        if (isset($heroImage) && $heroImage > 0) {
            $heroImage_o = File::getByID($heroImage);
            if (!is_object($heroImage_o)) {
                unset($heroImage_o);
            }
        } ?>
        <?php echo $form->label($view->field('heroImage'), t("Hero Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Set your hero image, this will display on the left or right of your content, depending on your selection.") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $app->make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_offscreen_hero-heroImage-' . $identifier_getString, $view->field('heroImage'), t("Choose Image"), $heroImage_o); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('alignImage'), t("Align Image")); ?>
        <?php echo isset($btFieldsRequired) && in_array('alignImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('alignImage'), $alignImage_options, $alignImage, []); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitContent'), t("Hero Unit Content") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This content will appear at the left or right of your image.") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitContent', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $app->make('editor')->outputBlockEditModeEditor($view->field('heroUnitContent'), $heroUnitContent); ?>
    </div>
</div>

<div id="ccm-tab-content-hero-unit-settings" class="ccm-tab-content">
    <div class="form-group">
        <?php echo $form->label($view->field('contentAnimation'), t("Content Animation") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Select an animation to make your content appear when scrolled in to sight.") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('contentAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('contentAnimation'), $contentAnimation_options, $contentAnimation, []); ?>
    </div>

    <div class="form-group">
        <?php  echo $form->label('animateOnce', t("Run animation once per page load") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("When this option is checked, the animation will only run once per page load, by default the animation will play whenever the element is scrolled to.") . '"></i>'); ?>
        <div class="clear"></div>
        <?php echo $form->checkbox('animateOnce', 1, $animateOnce) ?>
    </div>
</div>


