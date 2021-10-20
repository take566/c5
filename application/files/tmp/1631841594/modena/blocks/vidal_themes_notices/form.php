<?php  defined("C5_EXECUTE") or die("Access Denied.");
print $app->make('helper/concrete/ui')->tabs(array(
    array('notice-details', t('Notice Details'), true),
    array('notice-settings', t('Notice Settings'))
));
?>

<div id="ccm-tab-content-notice-details" class="ccm-tab-content">
    <div class="form-group">
        <?php  echo $form->label('noticeContent', t("Notice Content")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('noticeContent', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $app->make('editor')->outputBlockEditModeEditor($view->field('noticeContent'), $noticeContent); ?>
    </div>
</div>

<div id="ccm-tab-content-notice-settings" class="ccm-tab-content">
    <div class="form-group">
        <?php  echo $form->label('displayTime', t("Display Time") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Set the amount of time that passes after the page loads before your notice appears, for example 10 will make the notice appear 10 seconds after the page has loaded.") . '"></i>'); ?>
        <?php  echo isset($btFieldsRequired) && in_array('displayTime', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->text($view->field('displayTime'), $displayTime, array ('maxlength' => 255,)); ?>
    </div>
</div>
