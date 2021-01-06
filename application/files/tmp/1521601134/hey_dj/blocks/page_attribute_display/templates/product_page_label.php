<?php
defined('C5_EXECUTE') or die('Access Denied.');
echo $controller->getOpenTag();
echo "<span class=\"ccm-block-page-attribute-display-title\">".$controller->getTitle()."</span>";
$bgcolor = array('49b2e2','e68542','a3c75d');
$c = Page::getCurrentPage();
$productTopic = $c->getAttribute('product_topic');
$bgcolorNum = $productTopic[0]->treeNodeDisplayOrder % 3;

echo "<span class=\"product-label js-matchHeight\" style=\"background-color:#" . $bgcolor[$bgcolorNum] . "\">" . $controller->getContent() . "</span>";

echo $controller->getCloseTag();


