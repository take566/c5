<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('save_portfolio_settings'); ?>">
<?php echo $this->controller->token->output('save_portfolio_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('Portfolio options')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('topic_list_position', 'Topic list position'); ?>
                    <span class="help-block"><?php echo t("Position the topic list filters."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $topicPosition = array('text-left' => t('Left'),'text-center' => t('Center'),'text-right' => t('Right')) ?>
                        <?php echo $form->select('topic_list_position', $topicPosition, $topic_list_position); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('portfolio_columns', 'Portfolio columns'); ?>
                    <span class="help-block"><?php echo t("Choose how many columns you would like to display your portfolio items across."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $portfolioColumns = array('isotope-width-6' => t('2'),'isotope-width-4' => t('3'),'isotope-width-3' => t('4')) ?>
                        <?php echo $form->select('portfolio_columns', $portfolioColumns, $portfolio_columns); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('portfolio_margin', 'Portfolio margin'); ?>
                    <span class="help-block"><?php echo t("Choose how much space you would like between each portfolio item, Please note: the pagelist custom template \"modena portfolio no margins\" will ignore this setting." ); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $portfolioMargin = array('0px' => t('No spacing'),'5px' => t('5px'),'10px' => t('10px'),'15px' => t('15px'),'20px' => t('20px'),'25px' => t('25px'),'30px' => t('30px')) ?>
                        <?php echo $form->select('portfolio_margin', $portfolioMargin, $portfolio_margin); ?>
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
