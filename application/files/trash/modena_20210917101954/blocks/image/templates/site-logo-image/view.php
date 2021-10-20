<?php defined('C5_EXECUTE') or die("Access Denied.");
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();


$c = Page::getCurrentPage();
if (is_object($f)) {
    if ($maxWidth > 0 || $maxHeight > 0) {
        $im = $app->make('helper/image');
        $thumb = $im->getThumbnail(
            $f,
            $maxWidth,
            $maxHeight
        ); //<-- set these 2 numbers to max width and height of thumbnails
        $tag = new \HtmlObject\Image();
        $tag->src($thumb->src);
    } else {
        $image = $app->make('html/image', array($f));
        $tag = $image->getTag();
    }
    $tag->addClass('ccm-image-block primary-header__logo-image bID-'.$bID);
    $tag->width('');
    $tag->height('');
    if ($altText) {
        $tag->alt(h($altText));
    } else {
        $tag->alt('');
    }
    if ($title) {
        $tag->title(h($title));
    }
    if ($linkURL):
        print '<a href="' . $linkURL . '">';
    endif;

    print $tag;

    if ($linkURL):
        print '</a>';
    endif;
} else if ($c->isEditMode()) { ?>

    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Image Block.')?></div>

<?php } ?>

<?php if(isset($foS) && is_object($foS)) { ?>
<script>
$(function() {
    $('.bID-<?php print $bID;?>')
        .mouseover(function(e){$(this).attr("src", '<?php print $imgPath["hover"];?>');})
        .mouseout(function(e){$(this).attr("src", '<?php print $imgPath["default"];?>');});
});
</script>
<?php } ?>