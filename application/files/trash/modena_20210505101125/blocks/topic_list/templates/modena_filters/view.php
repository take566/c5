<?php  defined('C5_EXECUTE') or die("Access Denied.");
if (!isset($selectedTopicID)) {
    $selectedTopicID = null;
}
use Concrete\Core\Tree\Node\Node as TreeNode;
use Concrete\Core\Tree;
$pk = Package::getByHandle('modena');
?>

<div class="ccm-block-topic-list-flat-filter margin-bottom-20">
<?php if($tree) : ?>
<?php
    if (is_object($tree)) {
        $node = $tree->getRootTreeNodeObject();
        if (is_object($node)) {
            $node->populateDirectChildrenOnly(); ?>

                <div class="isotope-filters-buttons <?php echo $pk->getConfig()->get('vidal.ensemble.topic_list_position','text-center'); ?>">
                    <div class="isotope-filters-button
                    <?php if (!$selectedTopicID) { ?> isotope-filters-button__selected"<?php } ?>><?php echo t('All')?></div><span class="isotope-filters-divider">/</span>

                <?php foreach ($node->getChildNodes() as $child) { ?>

                <?php
                    $topics = $child->getTreeNodeDisplayName();
                    $tax_links = str_replace(' ', '-', $topics );
                    $tax = strtolower($tax_links);
                ?>

                <div class="isotope-filters-button" data-filter=".<?php echo $tax;  ?>"
                    <?php if (isset($selectedTopicID) && $selectedTopicID == $child->getTreeNodeID()) { ?>
                        class="isotope-filters-button__selected"
                    <?php } ?> ><?php echo $child->getTreeNodeDisplayName()?></div><span class="isotope-filters-divider">/</span>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
                    <?php endif; ?>