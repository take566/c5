<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-block-topic-list-wrapper">

    <?php
    $c = Page::getCurrentPage();
    if ($mode == 'S' && is_object($tree)) {
        ?><ul class="ccm-block-topic-list-list link-nav">
        <li><a href="<?php echo $c->getCollectionLink() . "#link_title"; ?>">All</a></li><?php
        $node = $tree->getRootTreeNodeObject();
        $node->populateChildren();
        if (is_object($node)) {
            if (!isset($selectedTopicID)) {
                $selectedTopicID = null;
            }
            $walk = function ($node) use (&$walk, &$view, $selectedTopicID) {
                foreach ($node->getChildNodes() as $topic) {
                    if ($topic instanceof \Concrete\Core\Tree\Node\Type\TopicCategory) {
                        ?><li><?php echo $topic->getTreeNodeDisplayName(); ?></li>
                    <?php 
                    } else {
                        ?><li><a href="<?php echo $view->controller->getTopicLink($topic) . "#link_title"; ?>" <?php
                        if (isset($selectedTopicID) && $selectedTopicID == $topic->getTreeNodeID()) {
                            ?> class="ccm-block-topic-list-topic-selected"<?php
                        }
                        ?>><?php echo $topic->getTreeNodeDisplayName(); ?></a></li><?php 
                    }
                    $walk($topic);
                }
            };
            $walk($node);
        }
        ?></ul><?php
    }

    if ($mode == 'P') {
        if (count($topics)) {
            ?><ul class="ccm-block-topic-list-page-topics"><?php
            foreach ($topics as $topic) {
                ?><li><a href="<?php echo $view->controller->getTopicLink($topic); ?>"><?php echo $topic->getTreeNodeDisplayName(); ?></a></li><?php
            }
            ?></ul><?php 
        } else {
            echo t('No topics.');
        }
    }
    ?>

</div>
