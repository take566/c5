<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="notice notice--timed">
    <div class="notice__content">
    <span class="notice__close"></span>
        <?php  if (isset($noticeContent) && trim($noticeContent) != "") : ?>
            <p>
                <?php  echo $noticeContent; ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<?php if (Page::getCurrentPage()->isEditMode()): ?>
    <div class="ccm-edit-mode-disabled-item">
            Notice Block.
    </div>
<?php endif; ?>

<script type="text/javascript">
    $(window).on('load', function() {
        $('.notice').ensembleNotices({
            delay: '<?php  echo h($displayTime); ?>000'
        });
    });
</script>
