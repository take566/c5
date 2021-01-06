<?php
defined('C5_EXECUTE') or die('Access Denied.');
$c = Page::getCurrentPage();

if($c->getAttribute('product_sample') !=""){
    $title = $c->getAttribute('product_sample');
} else {
    $title = t("sample music come here");
}
?>
<a href="<?php echo $controller->getContent()?>"><h5 class="product-continue js-matchHeight"><?php echo $title ?></h5></a>
