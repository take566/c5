<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['tabs-' . $identifier_getString, t('Tabs'), true],
    ['tabs-animation-' . $identifier_getString, t('Tabs Animation')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-tabs-<?php echo $identifier_getString; ?>">
<script type="text/javascript">
    var CCM_EDITOR_SECURITY_TOKEN = "<?php echo $app->make('helper/validation/token')->generate('editor')?>";
</script>
    <?php $core_editor = $app->make('editor');
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
    <?php } ?>
    <?php  $repeatable_container_id = 'btVidalThemesTabs-addTabs-container-' . $app->make('helper/validation/identifier')->getString(18); ?>
        <div id="<?php  echo $repeatable_container_id; ?>">
            <div class="sortable-items-wrapper">
                <a href="#" class="btn btn-primary add-entry">
                    <?php  echo t('Add Tab'); ?>
                </a>

                <div class="sortable-items" data-attr-content="<?php  echo htmlspecialchars(
                    json_encode(
                        array(
                            'items' => $addTabs_items,
                            'order' => array_keys($addTabs_items),
                        )
                    )
                ); ?>">
                </div>

                <a href="#" class="btn btn-primary add-entry add-entry-last">
                    <?php  echo t('Add Tab'); ?>
                </a>
            </div>

            <script class="repeatableTemplate" type="text/x-handlebars-template">
                <div class="sortable-item" data-id="{{id}}">
                    <div class="sortable-item-title">
                        <span class="sortable-item-title-default">
                            <?php  echo t('Add Tabs') . ' ' . t("row") . ' <span>#{{id}}</span>'; ?>
                        </span>
                        <span class="sortable-item-title-generated"></span>
                    </div>

                    <div class="sortable-item-inner">
                        <div class="form-group">
                            <label for="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabHeading]" class="control-label"><?php  echo t("Tab Heading") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This heading will appear on the clickable portion of the tab") . '"></i>'; ?></label>
                            <?php  echo isset($btFieldsRequired['addTabs']) && in_array('tabHeading', $btFieldsRequired['addTabs']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                            <input name="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabHeading]" id="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabHeading]" class="form-control" type="text" value="{{ tabHeading }}" maxlength="255" />
                        </div>
                        <div class="form-group">
                            <label for="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabContent]" class="control-label"><?php  echo t("Tab Content"); ?></label>
                            <?php  echo isset($btFieldsRequired['addTabs']) && in_array('tabContent', $btFieldsRequired['addTabs']) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
                            <textarea name="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabContent]" id="<?php  echo $view->field('addTabs'); ?>[{{id}}][tabContent]" class="ft-addTabs-tabContent">{{ tabContent }}</textarea>
                        </div>
                    </div>

                <span class="sortable-item-collapse-toggle"></span>

                <a href="#" class="sortable-item-delete" data-attr-confirm-text="<?php  echo t('Are you sure'); ?>">
                    <i class="fa fa-times"></i>
                </a>

                <div class="sortable-item-handle">
                    <i class="fa fa-sort"></i>
                </div>
            </div>
        </script>
    </div>

    <script type="text/javascript">
        Concrete.event.publish('btVidalThemesTabs.addTabs.edit.open', {id: '<?php  echo $repeatable_container_id; ?>'});
        $.each($('#<?php  echo $repeatable_container_id; ?> input[type="text"].title-me'), function () {
            $(this).trigger('keyup');
        });
    </script>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-tabs-animation-<?php echo $identifier_getString; ?>">
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
