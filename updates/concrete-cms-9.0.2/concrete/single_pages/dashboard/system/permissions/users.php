<?php defined('C5_EXECUTE') or die("Access Denied."); 
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
?>

<?php ob_start(); ?>
<?=View::element('permission/help');?>
<?php $help = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<form method="post" action="<?=$view->action('save')?>" role="form">

  <?=$app->make('helper/validation/token')->output('save_permissions')?>

	<?php
    $tp = new TaskPermission();
    if ($tp->canAccessTaskPermissions()) {
        ?>

        <div class="pb-3">
            <h3><?=t('General User Permissions')?></h3>
            <?php View::element('permission/lists/user')?>
        </div>
        <div>
            <h3><?=t('Default Group Permissions')?></h3>
            <div class="help-block"><?=t('Individual groups and group folders may override these permissions.')?></div>
            <?php View::element('permission/lists/tree/node', ['node' => $root, 'disableDialog' => true])?>
        </div>

	<?php
    } else {
        ?>
		<p><?=t('You cannot access task permissions.')?></p>
	<?php
    } ?>

    <div class="ccm-dashboard-form-actions-wrapper">
	    <div class="ccm-dashboard-form-actions">
            <a href="<?=$view->url('/dashboard/system/permissions/users')?>" class="btn btn-secondary float-start"><?=t('Cancel')?></a>
            <button class="float-end btn btn-primary" type="submit" ><?=t('Save')?></button>
	    </div>
	</div>
</form>
