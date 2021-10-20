<?php defined('C5_EXECUTE') or die("Access Denied.");

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$c = Page::getCurrentPage();
$th = $app->make('helper/text');
$dh = $app->make('helper/date');
$author = $c->getVersionObject()->getVersionAuthorUserName();

if ($c->isEditMode() && $controller->isBlockEmpty()) : ?>

    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.') ?></div>

        <?php else: ?>

            <?php if (isset($pageListTitle) && $pageListTitle) : ?>
                <div class="grid-row">
                    <div class="column-12">
                        <h5><?php echo h($pageListTitle) ?></h5>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($rssUrl) && $rssUrl) : ?>
                <a href="<?php echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed">
                    <i class="fa fa-rss"></i>
                </a>
            <?php endif; ?>

            <ul class="margin-bottom-40 modena-sidebar--page-list">
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

                foreach ($pages as $page) {

                // Prepare data for each page being listed...
                $buttonClasses = 'ccm-block-page-list-read-more';
                $entryClasses = 'blog-teaser margin-bottom-100';
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
                $target = empty($target) ? '_self' : $target; ?>

                    <li>
                        <a href="<?php echo h($url) ?>" target="<?php echo h($target) ?>">
                            <?php echo h($title) ?>
                        </a>
                    </li>
            <?php } ?>
        </ul>
    <?php endif; ?>
