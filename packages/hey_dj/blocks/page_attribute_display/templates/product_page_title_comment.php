<?php
defined('C5_EXECUTE') or die('Access Denied.');
echo $controller->getOpenTag();
echo "<span class=\"ccm-block-page-attribute-display-title\">".$controller->getTitle()."</span>";
echo "<span class=\"product-title-comment js-matchHeight\">".$controller->getContent()."</span>";
echo $controller->getCloseTag();
