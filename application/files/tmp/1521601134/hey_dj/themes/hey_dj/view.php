<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('elements/header.php'); ?>

<div class="error-page">
	<div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-4 col-xs-12">
                <div class="jumbo">
                    <h1><?php echo t('404 Error')?></h1>
                    <p><?php echo t('Page not found.')?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->inc('elements/footer.php'); ?>