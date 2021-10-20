<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php  $this->inc('elements/sub-page-header.php'); ?>

<?php if($c->getAttribute('disable_sub_page_banner') == true) : ?>
    <div class="hero-unit__spacer"></div>
<?php else : ?>
    <div class="hero-unit-sub-page margin-bottom-100">
        <div class="hero-unit-sub-page--overlay"></div>
        <div class="hero-unit-sub-page__content">
            <div class="grid-row">
                <div class="column-12 animated-parent animation-delay-1000">
                    <h2 class="animated animate__fade-in-down-short go">
                        <?php if ($c->getAttribute('disable_sub_page_name') == false) {
                            $page = Page::getCurrentPage();
                            echo $page->getCollectionName();
                        } ?>
                    </h2>
                    <p class="animated animate__fade-in-up-short go">
                        <?php if($c->getAttribute('sub_page_heading_hash_tag') == false) : ?>
                            <span class="text-bold sub-heading-hash">#</span>
                        <?php endif; ?>
                        <?php if ($c->getAttribute('sub_page_heading_sub_text')) {
                            $page = Page::getCurrentPage();
                            echo $c->getAttribute('sub_page_heading_sub_text');
                        } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<section class="margin-top-120">
    <div class="grid-container">
        <div class="grid-row">
            <div class="column-8">
                <?php
                    $a = new Area('Main');
                    $a->setAreaGridMaximumColumns(12);
                    $a->enableGridContainer();
                    $a->display($c);
                ?>
            </div>
            <div class="column-3 push-column-1">
                <?php
                    $a = new Area('Right Sidebar');
                    $a->setAreaGridMaximumColumns(12);
                    $a->enableGridContainer();
                    $a->display($c);
                ?>
            </div>
        </div>
    </div>
</section>

<?php if ($c->getAttribute('disable_sub_page_footer_margin') == false) : ?>

    <div class="padding-top-100"></div>

<?php endif; ?>

<?php $this->inc('elements/footer.php'); ?>
