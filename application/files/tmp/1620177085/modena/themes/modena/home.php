<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php  $this->inc('elements/header.php'); ?>

<section>
    <?php
        $a = new Area('Hero Unit');
        if($a->getTotalBlocksInArea($c) == 0 && $c->isEditMode()) : ?>
            <div class="hero-unit--empty">
                <div class="hero-unit--empty-inner">
                    <?php $a->display($c); ?>
                </div>
            </div>
        <?php else: ?>
            <?php $a->display($c); ?>
        <?php endif; ?>
</section>

<section>
        <?php
            $a = new Area('Main');
            $a->setAreaGridMaximumColumns(12);
            $a->enableGridContainer();
            $a->display($c);
        ?>
</section>

<?php if ($c->getAttribute('disable_sub_page_footer_margin') == false) : ?>

    <div class="padding-top-100"></div>

<?php endif; ?>

<?php $this->inc('elements/footer.php'); ?>
