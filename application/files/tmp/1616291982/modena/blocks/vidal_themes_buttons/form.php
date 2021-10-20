<?php defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['form-button-' . $identifier_getString, t('Button'), true],
    ['form-button-animation-' . $identifier_getString, t('Button Animation')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-form-button-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('linkPicker'), t("Link")); ?>
        <?php echo isset($btFieldsRequired) && in_array('linkPicker', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('linkPicker'), $linkPicker_options, $linkPicker, []); ?>
    </div>

        <div class="link_picker_page well">
            <div class="form-group">
                <?php echo $form->label($view->field('buttonUrl'), t("Button URL")); ?>
                <?php echo isset($btFieldsRequired) && in_array('buttonUrl', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                <?php echo $app->make("helper/form/page_selector")->selectPage($view->field('buttonUrl'), $buttonUrl); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($view->field('buttonUrl_text'), t("Button URL") . " " . t("Text")); ?>
                <?php echo $form->text($view->field('buttonUrl_text'), $buttonUrl_text, []); ?>
            </div>
        </div>
    
        <div class="link_picker_external well">
            <div class="form-group">
                <?php echo $form->label($view->field('externalUrl'), t("External URL") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add a link to an external page/site ") . '"></i>'); ?>
                <?php echo isset($btFieldsRequired) && in_array('externalUrl', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                <?php echo $form->text($view->field('externalUrl'), $externalUrl, []); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($view->field('externalUrl_text'), t("External URL") . " " . t('Text')); ?>
                <?php echo $form->text($view->field('externalUrl_text'), $externalUrl_text, []); ?>
            </div>
        </div>
   
    <div class="all-button-options">
        <div class="form-group">
            <?php echo $form->label($view->field('buttonType'), t("Button type") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Choose between a solid background button, or a ghost button that has just its border.") . '"></i>'); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonType', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonType'), $buttonType_options, $buttonType, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonColors'), t("Button colors")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonColors', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonColors'), $buttonColors_options, $buttonColors, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonRadius'), t("Button radius")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonRadius', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonRadius'), $buttonRadius_options, $buttonRadius, []); ?>
        </div>

        <div class="form-group">
            <?php  echo $form->label('buttonPosition', t("Button Position")); ?>
            <?php  echo isset($btFieldsRequired) && in_array('buttonPosition', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php  echo $form->select($view->field('buttonPosition'), $buttonPosition_options, $buttonPosition, array()); ?>
        </div>

        <script type="text/javascript">
            Concrete.event.publish('vidal_themes_buttons.buttonIcons.font_awesome');
            $(document).ready(function () {
                $('select.font-awesome-previewed').trigger('change');
            });

            $(document).ready(function() {
                    $('#linkPicker').on('change', function() {
                        if ($(this).val() == '') {
                            $('.link_picker_external').hide();
                            $('.link_picker_page').hide();
                            $('.all-button-options').hide();
                        }
                        if ($(this).val() == 'external') {
                            $('.link_picker_external').show();
                            $('.link_picker_page').hide();
                            $('.all-button-options').show();
                        }
                        if ($(this).val() == 'page') {
                            $('.link_picker_external').hide();
                            $('.link_picker_page').show();
                            $('.all-button-options').show();
                        }
                    }).trigger('change');
                });
        </script>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonIcons'), t("Button Icons")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonIcons', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <div class="font-awesome-group">
                <?php echo $form->select($view->field('buttonIcons'), $buttonIcons_options, $buttonIcons, array ('class' => 'form-control font-awesome-previewed', )); ?>
                <i data-preview="icon" class=""></i>
            </div>
        </div>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-form-button-animation-<?php echo $identifier_getString; ?>">
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