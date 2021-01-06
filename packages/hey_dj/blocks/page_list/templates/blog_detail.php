<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Core::make('helper/text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php } else { ?>

<div class="container">
    <div class="row">

        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="row">

                <?php if (isset($rssUrl) && $rssUrl): ?>
                    <a href="<?php echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed"><i class="fa fa-rss"></i></a>
                <?php endif; ?>

                <div class="ccm-block-page-list-pages">

                <?php

                    $includeEntryText = false;
                    if ($includeName || $includeDescription || $useButtonForLink) {
                        $includeEntryText = true;
                    }

                    foreach ($pages as $page):

                		// Prepare data for each page being listed...
                		$title = $th->entities($page->getCollectionName());
                		$url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
                		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
                		$target = empty($target) ? '_self' : $target;
                		$description = $page->getCollectionDescription();
                		$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
                		$description = $th->entities($description);
                        $thumbnail = false;
                        if ($displayThumbnail) {
                            $thumbnail = $page->getAttribute('thumbnail');
                        }

                ?>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="box-all">
                        <div class="border-line">
                            <ul class="caption-ul">
                                <li>
                                    <span class="title-day js-matchHeight">
                                        <?php
											echo $page->getCollectionDatePublicObject()->format('j');
											?>
                                    </span>
                                    <span class="day">
                                        <?php
											echo $page->getCollectionDatePublicObject()->format('S');
											?>
                                    </span>
                                    <hr class="short">
                                    <span class="title-monthry js-matchHeight">
                                        <?php
											echo $page->getCollectionDatePublicObject()->format('F');
											?>
                                    </span>
                                    <span class="year">
                                        <?php
											echo $page->getCollectionDatePublicObject()->format('Y');
											?>
                                    </span>
                                    <span class="img-thumbnail js-matchHeight">
                                        <a class="img" href="<?php echo $url ?>" target="<?php echo $target ?>">
                                            <?php if (is_object($thumbnail)): ?>
                                                <?php
                                                    $img = Core::make('html/image', array($thumbnail));
                                                    $tag = $img->getTag();
                                                    print $tag;
                                                ?>
                                            <?php 
                                            else: 
                                                echo '<img src="'.$this->getThemePath().'/images/diary_detail_no-image.png" width="189" height="106" alt="">';
                                            ?>
                                            <?php endif; ?>
                                        </a>
                                    </span>
                                    <span class="diary-title js-matchHeight"><?php echo h($title) ;?></span>
                                    <span class="diary-comment js-matchHeight"><?php echo $description ?></span>
                                    <span><a class="btn btn-default btn-space" href="<?php echo $url ?>" target="<?php echo $target ?>">Read more…</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            	<?php endforeach; ?>
                </div>

                <?php if (count($pages) == 0): ?>
                    <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div><!-- end .ccm-block-page-list -->

<?php if ($showPagination): ?>
    <?php
    $pagination = $list->getPagination();
    if ($pagination->getTotalPages() > 1) {
        $options = array(
            'proximity'           => 2,
            'prev_message'        => '← Prev',
            'next_message'        => 'Next →',
            'dots_message'        => '...',
            'active_suffix'       => '',
            'css_container_class' => 'my-container-class',
            'css_prev_class'      => 'my-prev-class',
            'css_next_class'      => 'my-next-class',
            'css_disabled_class'  => 'my-disabled-class',
            'css_dots_class'      => 'my-dots-class',
            'css_active_class'    => 'my-active-class'
        );
        echo $pagination->renderDefaultView($options);
    }
    ?>
<?php endif; ?>

<?php } ?>
