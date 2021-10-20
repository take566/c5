<?php
defined('C5_EXECUTE') or die("Access Denied.");

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$c = Page::getCurrentPage();
$pk = Package::getByHandle('modena');
$th = $app->make('helper/text');
$dh = $app->make('helper/date');
$author = $c->getVersionObject()->getVersionAuthorUserName();

if ($c->isEditMode() && $controller->isBlockEmpty()) : ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.') ?></div>
<?php else: ?>

    <div class="ccm-block-page-list-wrapper">

        <?php if (isset($rssUrl) && $rssUrl) : ?>
            <a href="<?php echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed">
                <i class="fa fa-rss"></i>
            </a>
        <?php endif; ?>

        <div class="isotope-items" data-isotope='{ "itemSelector": ".isotope-item", "layoutMode": "masonry" }'>

            <?php $includeEntryText = false;
            if (
                (isset($includeName) && $includeName)
                ||
                (isset($includeDescription) && $includeDescription)
                ||
                (isset($useButtonForLink) && $useButtonForLink)
            ) {
                $includeEntryText = true;
            }

            foreach ($pages as $page) :
                if (empty($pk->getConfig()->get('vidal.ensemble.portfolio_columns'))) {
                    $isotope_columns = "isotope-width-4";
                }else{
                    $isotope_columns = $pk->getConfig()->get('vidal.ensemble.portfolio_columns');
                }

                // Prepare data for each page being listed...
                $buttonClasses = 'ccm-block-page-list-read-more';
                $entryClasses = 'ccm-block-page-list-page-entry';
                $title = $page->getCollectionName();
                if ($page->getCollectionPointerExternalLink() != '') {
                    $url = $page->getCollectionPointerExternalLink();
                    if ($page->openCollectionPointerExternalLinkInNewWindow()) {
                        $target = '_blank';
                    }
                } else {
                    $url = $page->getCollectionLink();
                    $target = $page->getAttribute('nav_target');
                }

                // Convert project topics in to a format Isotope understands
                $topics = $page->getAttribute('project_topics', 'display');
                $remove = array(',', ' ');
                $remove_underscores = array('--');
                $tax_links = str_replace($remove, '-', $topics );
                $tax = strtolower($tax_links);
                $output_tax = str_replace($remove_underscores, ' ', $tax);

                $target = empty($target) ? '_self' : $target;
                $description = $page->getCollectionDescription();
                $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
                $thumbnail = false;
                if ($displayThumbnail) {
                    $thumbnail = $page->getAttribute('thumbnail');
                }
                if (is_object($thumbnail) && $includeEntryText) {
                    $entryClasses = 'isotope-item'." ".$output_tax." ".$isotope_columns;
                }

                $collectionDate = strtotime($page->getCollectionDatePublic());
                if($pk->getConfig()->get('vidal.ensemble.use_us_date') == true) {
                    $date = date("M d Y", $collectionDate);
                }else{
                    $date = date("d M Y", $collectionDate);
                } ?>

                <div class="<?php echo $entryClasses ?>">

                    <div class="overlay">
                        <div class="overlay__background overlay__background--slide-right"></div>
                        <div class="overlay__content text-center">

                            <?php if ($includeEntryText) : ?>
                                <span class="overlay__content-heading">
                                    <?php if (isset($includeName) && $includeName) : ?>
                                        <a href="<?php echo h($url) ?>"target="<?php echo h($target) ?>"><?php echo h($title) ?></a>
                                    <?php endif; ?>
                                        <span class="overlay__divider">/</span>
                                        <?php if($thumbnail) : ?>
                                            <a class="display-inline-block" data-lightbox="gallery" data-caption="<?php echo h($title) ?>" href="<?php echo $thumbnail->getRelativePath();?>">
                                                <i class="ion-plus"></i>
                                            </a>
                                        <?php endif; ?>

                                    <?php if (isset($includeDate) && $includeDate) : ?>
                                        <span class="overlay__content-date">
                                            <time datetime="<?php echo $page->getCollectionDatePublic(); ?>"><?php echo $date; ?></time>
                                        </span>
                                    <?php endif; ?>
                                </span>

                                <span class="overlay__content-text">
                                    <?php if (isset($includeDescription) && $includeDescription) : ?>
                                        <?php echo h($description) ?>
                                    <?php endif; ?>

                                    <?php if (isset($useButtonForLink) && $useButtonForLink) : ?>
                                        <span class="overlay__content-read-more">
                                            <a href="<?php echo h($url) ?>" target="<?php echo h($target) ?>" class="<?php echo h($buttonClasses) ?>"><?php echo h($buttonLinkText) ?></a>
                                        </span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php if (is_object($thumbnail)) : ?>
                        <?php
                            $img = $app->make('html/image', array($thumbnail));
                            $tag = $img->getTag();
                            $tag->addClass('overlay__image overlay__image--skew');
                            echo $tag;
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div><!-- end .ccm-block-page-list-pages -->
        <?php if (count($pages) == 0) : ?>
            <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage) ?></div>
        <?php endif; ?>
</div><!-- end .ccm-block-page-list-wrapper -->

<?php if ($showPagination) : ?>
    <?php echo $pagination; ?>
<?php endif; ?>

<?php endif; ?>
