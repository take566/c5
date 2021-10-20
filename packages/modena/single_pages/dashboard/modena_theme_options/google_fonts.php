<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('google_fonts_save_settings'); ?>">
<?php echo $this->controller->token->output('google_fonts_save_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('Google fonts')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('use_google_font', 'Use Google fonts'); ?>
                    <span class="help-block"><?php echo t("Use Google fonts on your site, this option will override all font selections made in the theme customizer. Please note, due to the large amount of fonts the font dropdown menus may take a short while to display the font previews."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php  echo $form->checkbox('use_google_font', 1, $use_google_font); ?>
                            <label for="use_google_font"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('main_google_font', 'Main site font'); ?>
                    <span class="help-block"><?php echo t("Choose a Google font to use for your main content."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php  echo $form->text('main_google_font', $main_google_font); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('heading_google_font', 'Headings font'); ?>
                    <span class="help-block"><?php echo t("Choose a Google font to use for your sites headings, this will be used for headings H1 to H6."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php  echo $form->text('heading_google_font', $heading_google_font); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('nav_google_font', 'Navigation font'); ?>
                    <span class="help-block"><?php echo t("Choose a Google font to use for your sites navigation, this will be used for your main and mobile navigation."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php  echo $form->text('nav_google_font', $nav_google_font); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</fieldset>

<script>
    $(document).ready(function() {
        $('#main_google_font').mainfontselect();
        $('#heading_google_font').fontselect();
        $('#nav_google_font').fontselect();
    });
</script>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit" ><?php echo t('Save settings')?></button>
        </div>
    </div>

</form>
