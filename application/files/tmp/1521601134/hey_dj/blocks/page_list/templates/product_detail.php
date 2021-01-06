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
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="images-box">
                    <a href="<?php echo $url ?>" target="<?php echo $target ?>">
                        <?php if (is_object($thumbnail)): ?>
                            <?php
                                $img = Core::make('html/image', array($thumbnail));
                                $tag = $img->getTag();
                                print $tag;
                            ?>
                        <?php 
                        else: 
                            echo '<img src="'.$this->getThemePath().'/images/product_detail_no-image.png" width="262" height="180" alt="">';
                        ?>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="caption">
                    <ul class="caption-ul">
                        <li class="product-title js-matchHeight">
                            <?php echo h($title) ;?>
                        </li>
                        <li class="product-subtitle js-matchHeight">
                            <?php $productSubTitle = $page->getAttribute('product_sub_title');
                            echo $productSubTitle ?>
                        </li>
                        <li class="product-title-comment js-matchHeight"> 
                            <?php $productCommentTitle = $page->getAttribute('product_comment_title');
                            echo $productCommentTitle; ?>
                        </li>

                        <?php $bgcolor = array('49b2e2','e68542','a3c75d');
                        $productTopic = $page->getAttribute('product_topic');
                        $bgcolorNum = $productTopic[0]->treeNodeDisplayOrder % 3;
                        ?>
                        <span class="product-label js-matchHeight" style="background-color: #<?php echo $bgcolor[$bgcolorNum] ?>;">          
                        <?php $productLabel = $page->getAttribute('product_topic','displaySanitized');
                            echo $productLabel ?>
                        </span>

                        <li class="product-comment js-matchHeight">
                            <?php echo $description ?>
                        </li>
                        <li class="product-continue js-matchHeight">
                            <a href="<?php echo $url ?>" target="<?php echo $target ?>">Read more…</a>
                        </li>
                    </ul>
                </div>
            </div>

    	<?php endforeach; ?>
        </div>

        <?php if (count($pages) == 0): ?>
            <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
        <?php endif;?>

    </div>
</div><!-- end .ccm-block-page-list -->

<?php// if ($showPagination): ?>
    <?php// echo $pagination;?>
<?php// endif; ?>

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
