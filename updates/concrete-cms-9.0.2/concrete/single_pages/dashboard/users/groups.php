<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpDeprecationInspection */
/** @noinspection DuplicatedCode */

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Application\UserInterface\ContextMenu\DropdownMenu;
use Concrete\Core\Application\UserInterface\ContextMenu\MenuInterface;
use Concrete\Core\User\Group\Group;
use Concrete\Core\User\Group\Search\Result\Column;
use Concrete\Core\User\Group\Search\Result\Result;
use Concrete\Core\User\Group\Search\Result\Item;
use Concrete\Core\User\Group\Search\Result\ItemColumn;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\Group\Menu;

/** @var MenuInterface $menu */
/** @var Result $result */
/** @var DropdownMenu $resultsBulkMenu */

?>
<div id="ccm-search-results-table">
    <table class="ccm-search-results-table" data-search-results="groups">
        <thead>
        <tr>
            <th colspan="2" class="ccm-search-results-bulk-selector">
                <div class="btn-group dropdown">
                    <span class="btn btn-secondary" data-search-checkbox-button="select-all">
                        <!--suppress HtmlFormInputWithoutLabel -->
                        <input type="checkbox" data-search-checkbox="select-all"/>
                    </span>

                    <button
                            type="button"
                            disabled="disabled"
                            data-search-checkbox-button="dropdown"
                            class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"
                            data-reference="parent">

                            <span class="sr-only">
                                <?php echo t("Toggle Dropdown"); ?>
                            </span>
                    </button>

                    <?php echo $resultsBulkMenu->getMenuElement(); ?>
                </div>
            </th>

            <?php foreach ($result->getColumns() as $column): ?>
                <?php /** @var Column $column */ ?>
                <th class="<?php echo $column->getColumnStyleClass() ?>">
                    <?php if ($column->isColumnSortable()): ?>
                        <a href="<?php echo $column->getColumnSortURL() ?>">
                            <?php echo $column->getColumnTitle() ?>
                        </a>
                    <?php else: ?>
                        <span>
                            <?php echo $column->getColumnTitle() ?>
                        </span>
                    <?php endif; ?>
                </th>
            <?php endforeach; ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($result->getItems() as $item) { ?>
            <?php
            /** @var Item $item */
            /** @var Group $group */
            $group = $item->getItem();
            ?>
            <tr data-details-url="javascript:void(0)"
                <?php if (isset($highlightResults)
                    && in_array($item->getItem()->getTreeNodeID(), $highlightResults)) { ?>
                    class="table-row-highlight"<?php } ?>
            >
                <td class="ccm-search-results-checkbox">
                    <?php
                    if ($item->getResultGroupId() > 0) { ?>
                        <!--suppress HtmlFormInputWithoutLabel -->
                        <input data-search-checkbox="individual"
                               type="checkbox"
                               data-node-type="<?php
                               echo $item->getItem()->getTreeNodeTypeHandle() ?>"
                               data-item-id="<?php echo $item->getResultGroupId() ?>"/>
                        <?php
                    } ?>
                </td>

                <td class="ccm-search-results-icon">
                    <?php
                    echo $item->getItem()->getListFormatter()->getIconElement() ?>
                </td>

                <?php foreach ($item->getColumns() as $column) { ?>
                    <?php /** @var ItemColumn $column */ ?>
                    <?php /** @noinspection PhpUndefinedMethodInspection */

                    if ($column->getColumnKey() ==  'name') { ?>
                        <td class="ccm-search-results-name">
                            <a href="<?php echo $item->getDetailsURL(); ?>">
                                <?php echo $column->getColumnValue(); ?>
                            </a>
                        </td>
                    <?php } else { ?>
                        <td class="<?=$class?? '' ?>">
                            <?php echo $column->getColumnValue(); ?>
                        </td>
                    <?php } ?>
                <?php } ?>

                <?php $menu = $item->getItem()->getTreeNodeMenu(); ?>

                <?php if ($menu) { ?>
                    <td class="ccm-search-results-menu-launcher">
                        <div class="dropdown" data-menu="search-result">

                            <button class="btn btn-icon"
                                    data-boundary="viewport"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">

                                <svg width="16" height="4">
                                    <use xlink:href="#icon-menu-launcher"/>
                                </svg>
                            </button>

                            <?php echo $menu->getMenuElement(); ?>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php echo $result->getPagination()->renderView('dashboard'); ?>

<script type="text/javascript">
    (function ($) {
        $(function () {
            $('table[data-search-results=groups]').concreteGroupManagerTable({
                'folderID': '<?php echo $folderID; ?>'
            });
        });
    })(jQuery);
</script>
