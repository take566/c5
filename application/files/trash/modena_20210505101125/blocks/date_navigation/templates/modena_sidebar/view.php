<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-block-date-navigation-wrapper">

    <div class="ccm-block-date-navigation-header">
        <h5 class="underline"><?=h($title)?></h5>
    </div>

    <?php if (count($dates)) { ?>
        <ul class="margin-bottom-40 modena-sidebar--page-list">
            <li>
                <a href="<?=$view->controller->getDateLink()?>">
                    <?=t('All')?>
                </a>
            </li>
            <?php foreach ($dates as $date) { ?>
                <li>
                    <a href="<?=$view->controller->getDateLink($date)?>"
                        <?php if ($view->controller->isSelectedDate($date)) { ?>
                            class="ccm-block-date-navigation-date-selected"
                        <?php } ?>>
                        <?=$view->controller->getDateLabel($date)?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <?=t('None.')?>
    <?php } ?>
</div>
