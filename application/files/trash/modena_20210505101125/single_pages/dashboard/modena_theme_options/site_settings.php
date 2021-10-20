<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('site_save_settings'); ?>">
<?php echo $this->controller->token->output('site_save_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('General site options')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('site_width', 'Site width'); ?>
                    <span class="help-block"><?php echo t("Decide how wide the site will be (Default is 1240px)."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php echo $form->number('site_width', $site_width); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('social_button_shape', 'Social media button shape'); ?>
                    <span class="help-block"><?php echo t("Decide what shape you would like your sites social media sharing buttons."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $buttonShape = array('square' => t('Square'),'round' => t('Round')) ?>
                        <?php echo $form->select('social_button_shape', $buttonShape, $social_button_shape); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('disable_preloader', 'Page pre-loader'); ?>
                    <span class="help-block"><?php  echo t("Enable/disable the page pre-loader from all pages, when turned off your visitors will no longer see the page loading animation when they visit a page."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php  echo $form->checkbox('disable_preloader', 1, $disable_preloader); ?>
                            <label for="disable_preloader"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('disable_backto_top', 'Back to top button'); ?>
                    <span class="help-block"><?php  echo t("Enable/disable the back to top button from your site."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php  echo $form->checkbox('disable_backto_top', 1, $disable_backto_top); ?>
                            <label for="disable_backto_top"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('use_us_date', 'Use US Date format'); ?>
                    <span class="help-block"><?php echo t("Enable/disable the US standard date format (Month/Day/Year) anywhere the date is displayed."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php  echo $form->checkbox('use_us_date', 1, $use_us_date); ?>
                            <label for="use_us_date"><div></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('mobile_animation', 'Animated content on mobile devices '); ?>
                    <span class="help-block"><?php echo t("Enable/disable animations on mobile devices, please be aware that animations are resource heavy and their performance may be poor on slow network connections."); ?></span>
                </div>
                <div class="col-md-2 text-center">
                    <div class="well">
                        <div class="ensemble-checkbox">
                            <?php  echo $form->checkbox('mobile_animation', 1, $mobile_animation); ?>
                            <label for="mobile_animation"><div></div></label>
                        </div>
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
