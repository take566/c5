<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="grid-container--full-width">
    <?php
        foreach ($columns as $column) {
            $html = $column->getColumnHtmlObject();
            echo $html;
        }
    ?>
</div>

