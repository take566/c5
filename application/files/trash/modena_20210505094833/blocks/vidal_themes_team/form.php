<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['team-' . $identifier_getString, t('Team'), true],
    ['team-animation-' . $identifier_getString, t('Team Animation')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-team-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php 
        if (isset($profileImage) && $profileImage > 0) {
            $profileImage_o = File::getByID($profileImage);
            if (!is_object($profileImage_o)) {
                unset($profileImage_o);
            }
        } ?>
        <?php  echo $form->label('profileImage', t("Profile Image")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('profileImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $app->make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_team-profileImage-' . $app->make('helper/validation/identifier')->getString(18), $view->field('profileImage'), t("Choose Image"), $profileImage_o); ?>
    </div>
    <div class="form-group">
        <?php  echo $form->label('profileName', t("Name")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('profileName', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->text($view->field('profileName'), $profileName, array ('maxlength' => 255,)); ?>
    </div>
    <div class="form-group">
        <?php  echo $form->label('jobTitle', t("Job Title")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('jobTitle', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->text($view->field('jobTitle'), $jobTitle, array ('maxlength' => 255,)); ?>
    </div>
    <div class="form-group">
        <?php  echo $form->label('profileBio', t("Profile Bio")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('profileBio', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $app->make('editor')->outputBlockEditModeEditor($view->field('profileBio'), $profileBio); ?>
    </div>
    <div class="form-group">
        <?php  echo $form->label('roundProfilePic', t("Round Profile Images")); ?>
        <?php  echo isset($btFieldsRequired) && in_array('roundProfilePic', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php  echo $form->select($view->field('roundProfilePic'), $roundProfilePic_options, $roundProfilePic, array()); ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-team-animation-<?php echo $identifier_getString; ?>">
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