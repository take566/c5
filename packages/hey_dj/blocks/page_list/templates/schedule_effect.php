<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php } else { ?>

<!--<div class="ccm-block-page-list-wrapper">-->

    <?php if (isset($pageListTitle) && $pageListTitle): ?>
        <div class="ccm-block-page-list-header">
            <h5><?php echo h($pageListTitle)?></h5>
        </div>
    <?php endif; ?>

    <?php if (isset($rssUrl) && $rssUrl): ?>
        <a href="<?php echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed"><i class="fa fa-rss"></i></a>
    <?php endif; ?>

    <!--<div class="ccm-block-page-list-pages">-->

        <?php
    
        $includeEntryText = false;
        if (
            (isset($includeName) && $includeName)
            ||
            (isset($includeDescription) && $includeDescription)
            ||
            (isset($useButtonForLink) && $useButtonForLink)
        ) {
            $includeEntryText = true;
        }
    
        foreach ($pages as $page):
    
    		// Prepare data for each page being listed...
            $buttonClasses = 'ccm-block-page-list-read-more';
            $entryClasses = 'ccm-block-page-list-page-entry';
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
            if (is_object($thumbnail) && $includeEntryText) {
                $entryClasses = 'ccm-block-page-list-page-entry-horizontal';
            }
    
            $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);
    
    
    		//Other useful page data...
    
    
    		//$last_edited_by = $page->getVersionObject()->getVersionAuthorUserName();
    
    		//$original_author = Page::getByID($page->getCollectionID(), 1)->getVersionObject()->getVersionAuthorUserName();
    
    		/* CUSTOM ATTRIBUTE EXAMPLES:
    		 * $example_value = $page->getAttribute('example_attribute_handle');
    		 *
    		 * HOW TO USE IMAGE ATTRIBUTES:
    		 * 1) Uncomment the "$ih = Loader::helper('image');" line up top.
    		 * 2) Put in some code here like the following 2 lines:
    		 *      $img = $page->getAttribute('example_image_attribute_handle');
    		 *      $thumb = $ih->getThumbnail($img, 64, 9999, false);
    		 * 		<img src="<?php echo $thumb->src ?>" width="<?php echo $thumb->width ?>" height="<?php echo $thumb->height ?>" alt="" />
    		 *   (Replace "64" with max width, "9999" with max height. The "9999" effectively means "no maximum size" for that particular dimension.)
    		 *    (Change the last argument from false to true if you want thumbnails cropped.)
    		 * 3) Output the image tag below like this:
    		 *		<img src="<?php echo $thumb->src ?>" width="<?php echo $thumb->width ?>" height="<?php echo $thumb->height ?>" alt="" />
    		 *
    		 * ~OR~ IF YOU DO NOT WANT IMAGES TO BE RESIZED:
    		 * 1) Put in some code here like the following 2 lines:
    		 * 	    $img_src = $img->getRelativePath();
    		 *      $img_width = $img->getAttribute('width');
    		 *      $img_height = $img->getAttribute('height');
    		 * 2) Output the image tag below like this:
    		 * 	    <img src="<?php echo $img_src ?>" width="<?php echo $img_width ?>" height="<?php echo $img_height ?>" alt="" />
    		 */
    
    		/* End data preparation. */
    
    		/* The HTML from here through "endforeach" is repeated for every item in the list... */ ?>
    
            <!--<div class="container_sub">-->
                <div class="row">
                    <?php
                     if($page->getAttribute('schedule_effect') == 'no_move_L'){?>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatL left-under-space schedule-left-effect">
                            <p>
                                <?php 
                                    $f = $page->getAttribute('schedule_image');
                                    if(is_object($f)){
                                        $image = Core::make('html/image', array($f));
                                        $tag = $image->getTag();
                                        print $tag;
                                    }
                                ?>
                            </p>
                            <p><?php echo ($page->getAttribute('schedule_caption')); ?></p>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatR right-under-space schedule-right-effect mb50">
                               <?php echo $page->getAttribute('schedule_txt'); ?>
                        </div>
                    <?php
                    } else if($page->getAttribute('schedule_effect') == 'no_move_R'){?>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatR right-under-space schedule-left-effect">
                            <p>
                                <?php
                                    if(is_object($page->getAttribute('schedule_image'))){
                                        $image = Core::make('html/image', array($page->getAttribute('schedule_image')));
                                        $tag = $image->getTag();
                                        print $tag;
                                    }
                                ?>
                            </p>
                            <p><?php echo $page->getAttribute('schedule_caption'); ?></p>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatL right-under-space schedule-right-effect mb50">
                            <?php echo $page->getAttribute('schedule_txt'); ?>
                        </div>
                    <?php
                    } else { ?>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatL left-under-space schedule-left-effect">
                            <p>
                                <?php 
                                    $image = Core::make('html/image', array($page->getAttribute('schedule_image')));
                                    $tag = $image->getTag();
                                    print $tag;
                                ?>
                            </p>
                            <p><?php echo $page->getAttribute('schedule_caption'); ?></p>
                        <div class="col-md-6 col-sm-12 col-xs-12 floatR right-under-space schedule-right-effect mb50">
                            <?php echo $page->getAttribute('schedule_txt'); ?>
                        </div>
                    <?php } ?>
                </div>
            <!--</div>--><!--container_sub-->
            <?php 
            $cp = new Permissions($page);
            if($cp->canViewToolbar()){ ?>
                <a class="edit_mb15" href="<?php echo $url?>">This pagelist to edit page..</a>
            <?php } ?>
    	<?php endforeach; ?>
    <!--</div>--><!--ccm-block-page-list-pages-->
    
    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;?>

<!--</div>--><!-- end .ccm-block-page-list -->


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
