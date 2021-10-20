<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="form-group">
    <?php  echo $form->label('chooseAnimation', t("Choose Animation")); ?>
    <?php  echo isset($btFieldsRequired) && in_array('chooseAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->select($view->field('chooseAnimation'), $chooseAnimation_options, $chooseAnimation, array()); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('offset', t("Offset") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("You can choose when to animate an element as it appears in the viewport. This will make the animation either start before or after it has entered the viewport by the specified amount. If you wanted to only start the animation after the user has scrolled 300px past it then setting an offset of -300px would achieve this.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('offset', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->text($view->field('offset'), $offset, array ('maxlength' => 255,)); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('animationSpeed', t("Animation Speed") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Define how fast the animation fires.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('animationSpeed', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->select($view->field('animationSpeed'), $animationSpeed_options, $animationSpeed, array()); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('animateOnce', t("Animate Once") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Do you want the animation to fire every time it is scrolled to, or just once.") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('animateOnce', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $form->select($view->field('animateOnce'), $animateOnce_options, $animateOnce, array()); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('animatedContents', t("Content") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add the content to be animated") . '"></i>'); ?>
    <?php  echo isset($btFieldsRequired) && in_array('animatedContents', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo $app->make('editor')->outputBlockEditModeEditor($view->field('animatedContents'), $animatedContents); ?>
</div>