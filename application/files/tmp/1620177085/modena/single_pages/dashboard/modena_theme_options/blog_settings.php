<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="ensemble-ui-form" action="<?php echo $this->action('blog_save_settings'); ?>">
<?php echo $this->controller->token->output('blog_save_settings'); ?>

<fieldset>
    <div>
        <legend><?php  echo t('Blog options')?></legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('blog_sidebar', 'Blog Post Sidebar'); ?>
                    <span class="help-block"><?php echo t("Decide where you would like the sidebar on your blog post pages."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $positionOptions = array('left' => t('Left'),'right' => t('Right'),'none' => t('None')) ?>
                        <?php echo $form->select('blog_sidebar', $positionOptions, $blog_sidebar); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('blog_columns', 'Blog columns (Masonry blog only)'); ?>
                    <span class="help-block"><?php echo t("Choose how many columns you would like to display your masonry blog."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $blogColumnsArray = array('isotope-width-6' => t('2'),'isotope-width-4' => t('3'),'isotope-width-3' => t('4')) ?>
                        <?php echo $form->select('blog_columns', $blogColumnsArray, $blog_columns); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('blog_margin', 'Blog margin'); ?>
                    <span class="help-block"><?php echo t("Choose how much space you would like between each blog item, this option only applies to the masonry blog layout." ); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well text-center">
                        <?php $blogMargin = array('0px' => t('No spacing'),'5px' => t('5px'),'10px' => t('10px'),'15px' => t('15px'),'20px' => t('20px'),'25px' => t('25px'),'30px' => t('30px')) ?>
                        <?php echo $form->select('blog_margin', $blogMargin, $blog_margin); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('read_more', 'Read more text') ?>
                    <span class="help-block"><?php  echo t("This text appears under a blog post prompting a user to read the full article."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <?php echo $form->text('read_more', $read_more); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $form->label('read_more_overlay', 'Read more text (Overlay)') ?>
                    <span class="help-block"><?php  echo t("This text appears on the overlay of the blog post thumbnail prompting a user to read the full article."); ?></span>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <?php echo $form->text('read_more_overlay', $read_more_overlay); ?>
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
