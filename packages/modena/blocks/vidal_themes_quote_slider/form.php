<?php defined("C5_EXECUTE") or die("Access Denied."); 
    print $app->make('helper/concrete/ui')->tabs(array(
        array('testimonial-details', t('Add Testimonial'), true),
        array('testimonial-settings', t('Settings')),
    ));
?>

<div id="ccm-tab-content-testimonial-details" class="ccm-tab-content">

<script type="text/javascript">
    var CCM_EDITOR_SECURITY_TOKEN = "<?php echo $app->make('helper/validation/token')->generate('editor')?>";
</script>
            <?php
    $core_editor = $app->make('editor');
    if (method_exists($core_editor, 'getEditorInitJSFunction')) {
        /* @var $core_editor \Concrete\Core\Editor\CkeditorEditor */
        ?>
        <script type="text/javascript">var blockDesignerEditor = <?php echo $core_editor->getEditorInitJSFunction(); ?>;</script>
    <?php
    } else {
    /* @var $core_editor \Concrete\Core\Editor\RedactorEditor */
    if(method_exists($core_editor, 'requireEditorAssets')){
        $core_editor->requireEditorAssets();
    } ?>
        <script type="text/javascript">
            var blockDesignerEditor = function (identifier) {$(identifier).redactor(<?php echo json_encode(array('plugins' => ['concrete5magic'] + $core_editor->getPluginManager()->getSelectedPlugins(), 'minHeight' => 300,'concrete5' => array('filemanager' => $core_editor->allowFileManager(), 'sitemap' => $core_editor->allowSitemap()))); ?>).on('remove', function () {$(this).redactor('core.destroy');});};
        </script>
        <?php
    } ?><?php $repeatable_container_id = 'btVidalThemesQuoteSlider-testimonialSlider-container-' . $identifier_getString; ?>
    <div id="<?php echo $repeatable_container_id; ?>">
        <div class="sortable-items-wrapper">
            <a href="#" class="btn btn-primary add-entry">
                <?php echo t('Add Testimonial'); ?>
            </a>

            <div class="sortable-items" data-attr-content="<?php echo htmlspecialchars(
                json_encode(
                    [
                        'items' => $testimonialSlider_items,
                        'order' => array_keys($testimonialSlider_items),
                    ]
                )
            ); ?>">
            </div>

            <a href="#" class="btn btn-primary add-entry add-entry-last">
                <?php echo t('Add Testimonial'); ?>
            </a>
        </div>

        <script class="repeatableTemplate" type="text/x-handlebars-template">
            <div class="sortable-item" data-id="{{id}}">
                <div class="sortable-item-title">
                    <span class="sortable-item-title-default">
                        <?php echo t('Testimonial') . ' ' . t("row") . ' <span>#{{id}}</span>'; ?>
                    </span>
                    <span class="sortable-item-title-generated"></span>
                </div>

                <div class="sortable-item-inner">
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailName]" class="control-label"><?php echo t("Name") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add your testimonial supliers name") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonailName', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <input name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailName]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailName]" class="form-control" type="text" value="{{ testimonailName }}" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialPosition]" class="control-label"><?php echo t("Position") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add your testimonial suppliers job position") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonialPosition', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <input name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialPosition]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialPosition]" class="form-control" type="text" value="{{ testimonialPosition }}" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialCompany]" class="control-label"><?php echo t("Company") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add the company your testimonial supplier works for") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonialCompany', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <input name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialCompany]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialCompany]" class="form-control" type="text" value="{{ testimonialCompany }}" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl]" class="control-label"><?php echo t("Company URL") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add a link to your testimonial suppliers website, this will make their name link to their site.") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonailUrl', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <input name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl]" class="form-control" type="text" value="{{ testimonailUrl }}" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl_text]" class="control-label"><?php echo t("Company URL") . " " . t('Text'); ?></label>
                        <input name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl_text]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonailUrl_text]" class="form-control" type="text" value="{{ testimonailUrl_text }}" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialQuote]" class="control-label"><?php echo t("Bio/Quote") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add the content of your testimonial suppliers quote") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonialQuote', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <textarea name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialQuote]" id="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialQuote]" class="ft-testimonialSlider-testimonialQuote">{{ testimonialQuote }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialImage]" class="control-label"><?php echo t("Testimonial Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Add an image of the testimonial supplier or an image representing their company") . '"></i>'; ?></label>
                        <?php echo isset($btFieldsRequired['testimonialSlider']) && in_array('testimonialImage', $btFieldsRequired['testimonialSlider']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <div data-file-selector-input-name="<?php echo $view->field('testimonialSlider'); ?>[{{id}}][testimonialImage]" class="ccm-file-selector ft-image-testimonialImage-file-selector" data-file-selector-f-id="{{ testimonialImage }}"></div>
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
</div>

<div id="ccm-tab-content-testimonial-settings" class="ccm-tab-content">
    <div class="form-group">
        <?php echo $form->label($view->field('slideDuration'), t("Slide Duration (In whole seconds)")); ?>
        <?php echo isset($btFieldsRequired) && in_array('slideDuration', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('slideDuration'), $slideDuration, array (
    'maxlength' => 255,
    )); ?>
    </div>
</div>

<script type="text/javascript">
    Concrete.event.publish('btVidalThemesQuoteSlider.testimonialSlider.edit.open', {id: '<?php echo $repeatable_container_id; ?>'});
    $.each($('#<?php echo $repeatable_container_id; ?> input[type="text"].title-me'), function () {
        $(this).trigger('keyup');
    });
</script>