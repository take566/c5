<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php $tabs = [
    ['form-slider-' . $identifier_getString, t('Slides'), true],
    ['form-slider-options-' . $identifier_getString, t('Slider Settings')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-form-slider-<?php echo $identifier_getString; ?>">
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
    } ?><?php $repeatable_container_id = 'btVidalThemesSlider-slide-container-' . $identifier_getString; ?>
    <div id="<?php echo $repeatable_container_id; ?>">
        <div class="sortable-items-wrapper">
            <a href="#" class="btn btn-primary add-entry">
                <?php echo t('Add Entry'); ?>
            </a>

            <div class="sortable-items" data-attr-content="<?php echo htmlspecialchars(
                json_encode(
                    [
                        'items' => $slide_items,
                        'order' => array_keys($slide_items),
                    ]
                )
            ); ?>">
            </div>

            <a href="#" class="btn btn-primary add-entry add-entry-last">
                <?php echo t('Add Entry'); ?>
            </a>
        </div>

        <script class="repeatableTemplate" type="text/x-handlebars-template">
            <div class="sortable-item" data-id="{{id}}">
                <div class="sortable-item-title">
                    <span class="sortable-item-title-default">
                        <?php echo t('Slide') . ' ' . t("row") . ' <span>#{{id}}</span>'; ?>
                    </span>
                    <span class="sortable-item-title-generated"></span>
                </div>

                <div class="sortable-item-inner">
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][slideImage]" class="control-label"><?php echo t("Slide Image"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('slideImage', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <div data-file-selector-input-name="<?php echo $view->field('slide'); ?>[{{id}}][slideImage]" class="ccm-file-selector ft-image-slideImage-file-selector" data-file-selector-f-id="{{ slideImage }}"></div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][captionHeading]" class="control-label"><?php echo t("Caption Heading"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('captionHeading', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <input name="<?php echo $view->field('slide'); ?>[{{id}}][captionHeading]" id="<?php echo $view->field('slide'); ?>[{{id}}][captionHeading]" class="form-control" type="text" value="{{ captionHeading }}" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][CaptionContent]" class="control-label"><?php echo t("Caption Content"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('CaptionContent', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <textarea name="<?php echo $view->field('slide'); ?>[{{id}}][CaptionContent]" id="<?php echo $view->field('slide'); ?>[{{id}}][CaptionContent]" class="ft-slide-CaptionContent">{{ CaptionContent }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][captionHeadingAnimation]" class="control-label"><?php echo t("Caption Heading Animation"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('captionHeadingAnimation', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideCaptionHeadingAnimation_options = $slide['captionHeadingAnimation_options']; ?>
                            <select name="<?php echo $view->field('slide'); ?>[{{id}}][captionHeadingAnimation]" id="<?php echo $view->field('slide'); ?>[{{id}}][captionHeadingAnimation]" class="form-control">{{#select captionHeadingAnimation}}<?php foreach ($slideCaptionHeadingAnimation_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][captionContentAnimation]" class="control-label"><?php echo t("Caption Content Animation"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('captionContentAnimation', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideCaptionContentAnimation_options = $slide['captionContentAnimation_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][captionContentAnimation]" id="<?php echo $view->field('slide'); ?>[{{id}}][captionContentAnimation]" class="form-control">{{#select captionContentAnimation}}<?php foreach ($slideCaptionContentAnimation_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-warning" role="alert">
                            Please use an internal link OR external link.
                        </div>
                    </div>
                    <div class="well">
                        <div class="form-group">
                            <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonUrl]" class="control-label"><?php echo t("Button URL"); ?></label>
                            <?php echo isset($btFieldsRequired['slide']) && in_array('buttonUrl', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                            <div data-page-selector="{{token}}" data-input-name="<?php echo $view->field('slide'); ?>[{{id}}][buttonUrl]" data-cID="{{buttonUrl}}" class="link-ft"></div>
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonUrl_text]" class="control-label"><?php echo t("Button URL") . " " . t("Text"); ?></label>
                            <input name="<?php echo $view->field('slide'); ?>[{{id}}][buttonUrl_text]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonUrl_text]" class="form-control" type="text" value="{{ buttonUrl_text }}" />
                        </div>
                    </div>
                    <div class="well">
                        <div class="form-group">
                            <label for="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl]" class="control-label"><?php echo t("External URL"); ?></label>
                            <?php echo isset($btFieldsRequired['slide']) && in_array('externalUrl', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                            <input name="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl]" id="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl]" class="form-control" type="text" value="{{ externalUrl }}" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl_text]" class="control-label"><?php echo t("External URL") . " " . t('Text'); ?></label>
                            <input name="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl_text]" id="<?php echo $view->field('slide'); ?>[{{id}}][externalUrl_text]" class="form-control" type="text" value="{{ externalUrl_text }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonType]" class="control-label"><?php echo t("Button Type"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonType', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideButtonType_options = $slide['buttonType_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonType]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonType]" class="form-control">{{#select buttonType}}<?php foreach ($slideButtonType_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonColors]" class="control-label"><?php echo t("Button Colors"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonColors', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideButtonColors_options = $slide['buttonColors_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonColors]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonColors]" class="form-control">{{#select buttonColors}}<?php foreach ($slideButtonColors_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonRadius]" class="control-label"><?php echo t("Button Radius"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonRadius', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideButtonRadius_options = $slide['buttonRadius_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonRadius]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonRadius]" class="form-control">{{#select buttonRadius}}<?php foreach ($slideButtonRadius_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonPosition]" class="control-label"><?php echo t("Button Position"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonPosition', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideButtonPosition_options = $slide['buttonPosition_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonPosition]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonPosition]" class="form-control">{{#select buttonPosition}}<?php foreach ($slideButtonPosition_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonAnimation]" class="control-label"><?php echo t("Button Animation"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonAnimation', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <?php $slideButtonAnimation_options = $slide['buttonAnimation_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonAnimation]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonAnimation]" class="form-control">{{#select buttonAnimation}}<?php foreach ($slideButtonAnimation_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo $view->field('slide'); ?>[{{id}}][buttonIcons]" class="control-label"><?php echo t("Button Icons"); ?></label>
                        <?php echo isset($btFieldsRequired['slide']) && in_array('buttonIcons', $btFieldsRequired['slide']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                        <div class="font-awesome-group">
                            <?php $slideButtonIcons_options = $slide['buttonIcons_options']; ?><select name="<?php echo $view->field('slide'); ?>[{{id}}][buttonIcons]" id="<?php echo $view->field('slide'); ?>[{{id}}][buttonIcons]" class="form-control font-awesome-previewed">{{#select buttonIcons}}<?php foreach ($slideButtonIcons_options as $k => $v) {echo "<option value='" . $k . "'>" . $v . "</option>";} ?>{{/select}}</select>
                            <i data-preview="icon" class=""></i>
                        </div>
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
        Concrete.event.publish('btVidalThemesSlider.slide.edit.open', {id: '<?php echo $repeatable_container_id; ?>'});
        $.each($('#<?php echo $repeatable_container_id; ?> input[type="text"].title-me'), function () {
            $(this).trigger('keyup');
        });
    </script>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-form-slider-options-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('slideDirection'), t("Slide Direction")); ?>
        <?php echo isset($btFieldsRequired) && in_array('slideDirection', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('slideDirection'), $slideDirection_options, $slideDirection, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('pauseOnHover'), t("Pause On Hover")); ?>
        <?php echo isset($btFieldsRequired) && in_array('pauseOnHover', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('pauseOnHover'), (isset($btFieldsRequired) && in_array('pauseOnHover', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $pauseOnHover, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('arrowNavigation'), t("Show Arrow Navigation")); ?>
        <?php echo isset($btFieldsRequired) && in_array('arrowNavigation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('arrowNavigation'), (isset($btFieldsRequired) && in_array('arrowNavigation', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $arrowNavigation, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('navigationPager'), t("Show Navigation Pager")); ?>
        <?php echo isset($btFieldsRequired) && in_array('navigationPager', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('navigationPager'), (isset($btFieldsRequired) && in_array('navigationPager', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $navigationPager, []); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($view->field('slideDuration'), t("Slide Duration")); ?>
        <?php echo isset($btFieldsRequired) && in_array('slideDuration', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('slideDuration'), $slideDuration, array ('maxlength' => 255,)); ?>
    </div>
</div>