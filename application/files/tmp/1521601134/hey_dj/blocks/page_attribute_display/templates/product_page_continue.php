<?php
defined('C5_EXECUTE') or die('Access Denied.');
echo $controller->getOpenTag();
echo "<span class=\"ccm-block-page-attribute-display-title\">".$controller->getTitle()."</span>";
echo "<h5 class=\"product-continue js-matchHeight\">".$controller->getContent()."</h5>";
echo $controller->getCloseTag();
