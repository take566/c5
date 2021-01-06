<?php
defined('C5_EXECUTE') or die('Access Denied.');
$c = Page::getCurrentPage();

if($c->getAttribute('product_link') !=""){
    $title = $c->getAttribute('product_link');
} else {
    $title = t("buy come here");
}
?>
<a href="<?php echo $controller->getContent()?>"><h5 class="product-continue js-matchHeight"><?php echo $title ?></h5></a>
