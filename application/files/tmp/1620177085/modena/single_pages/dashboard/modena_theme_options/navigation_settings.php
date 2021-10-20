<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('save_nav_settings'); ?>">
<?php echo $this->controller->token->output('save_nav_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('Navigation options')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('sub_nav_width', 'Sub menu width'); ?>
                    <span class="help-block"><?php  echo t("Set a width for your sub menus. By default the sub menus will stretch to fit their content, and navigation items will not wrap to the next line, by specifying a width you can override this behaviour."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php  echo $form->number('sub_nav_width', $sub_nav_width); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <button class="pull-right btn btn-success" type="submit" ><?php echo t('Save settings')?></button>
    </div>
    </div>

</form>
