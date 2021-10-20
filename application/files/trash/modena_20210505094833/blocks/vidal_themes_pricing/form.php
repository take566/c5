<?php defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['form-basics-' . $identifier_getString, t('Pricing Column'), true],
    ['form-packageItems_items-' . $identifier_getString, t('Package Items')],
    ['pricing-animation-' . $identifier_getString, t('Pricing Column Animation')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-form-basics-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('packageHeading'), t("Package Heading")); ?>
        <?php echo isset($btFieldsRequired) && in_array('packageHeading', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('packageHeading'), $packageHeading, array ('maxlength' => 255,)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('packagePrice'), t("Package Price") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("How much you would like to charge per charge interval") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('packagePrice', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('packagePrice'), $packagePrice, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('chargeInterval'), t("Charge Interval") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Decide how regularly you would like people to pay, for example &quot;Per month&quot;, &quot;Per Week&quot; ") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('chargeInterval', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('chargeInterval'), $chargeInterval, array ('maxlength' => 255,)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('linkPicker'), t("Link")); ?>
        <?php echo isset($btFieldsRequired) && in_array('linkPicker', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('linkPicker'), $linkPicker_options, $linkPicker, []); ?>
    </div>

    <div class="link_picker_page well">
        <div class="form-group">
            <?php echo $form->label($view->field('buttonUrl'), t("Button URL") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Link your button to a page on your site") . '"></i>'); ?>
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
            <?php echo $form->label($view->field('externalUrl'), t("External URL") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Link this button to an external page/site ") . '"></i>'); ?>
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
            <?php echo $form->label($view->field('buttonType'), t("Button Type")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonType', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonType'), $buttonType_options, $buttonType, []); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($view->field('buttonColors'), t("Button Colors")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonColors', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonColors'), $buttonColors_options, $buttonColors, []); ?>
        </div>
        <div class="form-group">
            <?php echo $form->label($view->field('buttonRadius'), t("Button Radius")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonRadius', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonRadius'), $buttonRadius_options, $buttonRadius, []); ?>
        </div>
        <script type="text/javascript">
            Concrete.event.publish('vidal_themes_pricing.buttonIcons.font_awesome');
            $(document).ready(function () {
                $('select.font-awesome-previewed').trigger('change');
            });
        </script>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonIcons'), t("Button Icons")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonIcons', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <div class="font-awesome-group">
                <?php echo $form->select($view->field('buttonIcons'), $buttonIcons_options, $buttonIcons, array ('class' => 'form-control font-awesome-previewed',)); ?>
                <i data-preview="icon" class=""></i>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('borderRadius'), t("Column Border Radius")); ?>
        <?php echo isset($btFieldsRequired) && in_array('borderRadius', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('borderRadius'), $borderRadius_options, $borderRadius, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('recommendedColumn'), t("Recommended") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Make this column stand out from normal columns. You may wish to steer people towards this package in preference to your other packages ") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('recommendedColumn', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('recommendedColumn'), (isset($btFieldsRequired) && in_array('recommendedColumn', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $recommendedColumn, []); ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-form-packageItems_items-<?php echo $identifier_getString; ?>">
    <script type="text/javascript">
        var CCM_EDITOR_SECURITY_TOKEN = "<?php echo $app->make('helper/validation/token')->generate('editor')?>";
    </script>
    <?php $repeatable_container_id = 'btVidalThemesPricing-packageItems-container-' . $identifier_getString; ?>
        <div id="<?php echo $repeatable_container_id; ?>">
            <div class="sortable-items-wrapper">
                <a href="#" class="btn btn-primary add-entry">
                    <?php echo t('Add Package Item'); ?>
                </a>

                <div class="sortable-items" data-attr-content="<?php echo htmlspecialchars(
                    json_encode(
                        [
                            'items' => $packageItems_items,
                            'order' => array_keys($packageItems_items),
                        ]
                    )
                ); ?>">
                </div>

                <a href="#" class="btn btn-primary add-entry add-entry-last">
                    <?php echo t('Add Package Item'); ?>
                </a>
            </div>

            <script class="repeatableTemplate" type="text/x-handlebars-template">
                <div class="sortable-item" data-id="{{id}}">
                    <div class="sortable-item-title">
                        <span class="sortable-item-title-default">
                            <?php echo t('Package Items') . ' ' . t("row") . ' <span>#{{id}}</span>'; ?>
                        </span>
                        <span class="sortable-item-title-generated"></span>
                    </div>
                    <div class="sortable-item-inner">            
                        <div class="form-group">
                            <label for="<?php echo $view->field('packageItems'); ?>[{{id}}][packageItem]" class="control-label"><?php echo t("Package Item"); ?></label>
                                <?php echo isset($btFieldsRequired['packageItems']) && in_array('packageItem', $btFieldsRequired['packageItems']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                            <input name="<?php echo $view->field('packageItems'); ?>[{{id}}][packageItem]" id="<?php echo $view->field('packageItems'); ?>[{{id}}][packageItem]" class="form-control" type="text" value="{{ packageItem }}" maxlength="255" />
                        </div>
                    </div>

                    <span class="sortable-item-collapse-toggle"></span>

                    <a href="#" class="sortable-item-delete" data-attr-confirm-text="<?php echo t('Are you sure'); ?>">
                        <i class="fa fa-times"></i>
                    </a>

                    <div class="sortable-item-handle">
                        <i class="fa fa-sort"></i>
                    </div>
                </div>
            </script>
        </div>

    <script type="text/javascript">
        Concrete.event.publish('btVidalThemesPricing.packageItems.edit.open', {id: '<?php echo $repeatable_container_id; ?>'});
        $.each($('#<?php echo $repeatable_container_id; ?> input[type="text"].title-me'), function () {
            $(this).trigger('keyup');
        });
    </script>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-pricing-animation-<?php echo $identifier_getString; ?>">
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

<script>
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