<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['icon-box-' . $identifier_getString, t('Icon Box'), true],
    ['icon-box-animation-' . $identifier_getString, t('Icon Box Animation')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-icon-box-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php  echo $form->label('iconPosition', t("Icon Position")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('iconPosition', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->select($view->field('iconPosition'), $iconPosition_options, $iconPosition, array()); ?>
    </div>
    
    <script type="text/javascript">
        Concrete.event.publish('vidal_themes_icon_box.chooseIcon.font_awesome');
        $(document).ready(function () {
            $('select.font-awesome-previewed').trigger('change');
        });
    </script>

    <div class="form-group">
        <?php  echo $form->label('chooseIcon', t("Choose Icon")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('chooseIcon', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <div class="font-awesome-group">
        <?php  echo $form->select($view->field('chooseIcon'), $chooseIcon_options, $chooseIcon, array ('class' => 'form-control font-awesome-previewed',)); ?>
            <i data-preview="icon" class=""></i>
        </div>
    </div>

    <div class="form-group">
        <?php  echo $form->label('iconBoxContent', t("Icon Box Content")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('iconBoxContent', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $app->make('editor')->outputBlockEditModeEditor($view->field('iconBoxContent'), $iconBoxContent); ?>
    </div>

    <div class="form-group">
        <?php  echo $form->label('iconBoxBorder', t("Icon Box Border")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('iconBoxBorder', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->select($view->field('iconBoxBorder'), $iconBoxBorder_options, $iconBoxBorder, array()); ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-icon-box-animation-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('chooseAnimation'), t("Choose Animation")); ?>
        <?php echo isset($btFieldsRequired) && in_array('chooseAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('chooseAnimation'), $chooseAnimation_options, $chooseAnimation, []); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('animationOffset'), t("Offset") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("The offset determines when the animation triggers in relation to where the screen is scrolled, for example setting the offset to 300 will trigget the animation 300 pixels before the element is seen on screen, setting it to -300 means you will have to scroll past the element 300 pixels before it animates ") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('animationOffset', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('animationOffset'), $animationOffset, array ('maxlength' => 255,)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('animationSpeed'), t("Animation Speed")); ?>
        <?php echo isset($btFieldsRequired) && in_array('animationSpeed', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('animationSpeed'), $animationSpeed_options, $animationSpeed, []); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('animateOnce'), t("Animate Once") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("By default animations will run every time they are scrolled to on a page, by activating &quot;animate once&quot; the animation will only run the first time it is encountered, it will only run again once the page has been refreshed or navigated away from and back again.") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('animateOnce', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('animateOnce'), (isset($btFieldsRequired) && in_array('animateOnce', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $animateOnce, []); ?>
    </div>
</div>


