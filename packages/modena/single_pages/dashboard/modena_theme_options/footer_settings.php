<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('save_footer_settings'); ?>">
<?php echo $this->controller->token->output('save_footer_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('Footer options')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('copyright_notice', 'Copyright notice text') ?>
                    <span class="help-block"><?php  echo t("This text will appear at the bottom of your site displaying a copyright warning. You may also insert HTML to link to another site."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <?php echo $form->text('copyright_notice', $copyright_notice); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('login_link', 'Login link') ?>
                    <span class="help-block"><?php echo t("Show/hide a login link in the copyright area of the footer."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php echo $form->checkbox('login_link', 1, $login_link); ?>
                            <label for="login_link"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('credit_link', 'Credit link') ?>
                    <span class="help-block"><?php echo t("Show\hide the \"Built with Concrete5\" message in the copyright area of the footer."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php echo $form->checkbox('credit_link', 1, $credit_link); ?>
                            <label for="credit_link"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('copyright_position', 'Copyright position') ?>
                    <span class="help-block"><?php echo t("Where would you like to display the copyright text in the footer."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $positionOptions = array('text-left' => t('Left'),'text-center' => t('Center'),'text-right' => t('Right')) ?>
                        <?php echo $form->select('copyright_position', $positionOptions, $copyright_position); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('footer_columns', 'Footer columns') ?>
                    <span class="help-block"><?php echo t("Specify the amount of columns you would like in your footer."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $footerColumnArray = array('1','2','3','4','4-2') ?>
                        <?php echo $form->select('footer_columns', $footerColumnArray, $footer_columns); ?>
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
