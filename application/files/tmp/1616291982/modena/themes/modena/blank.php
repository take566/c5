<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php  $this->inc('elements/sub-page-header.php'); ?>

<section class="margin-top-120">
    <?php
        $a = new Area('Main');
        $a->enableGridContainer();
        $a->display($c);
    ?>
</section>

<?php if ($c->getAttribute('disable_sub_page_footer_margin') == false) : ?>

    <div class="padding-top-100"></div>

<?php endif; ?>

<?php $this->inc('elements/footer.php'); ?>
