<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

        <h3 class="archive-title"><?php echo h($title)?></h3>
        <?php if (count($dates)) { ?>
            <?php
            $dateBefore = "";
            $year = array();
            foreach($dates as $date){
                if($datebefore != $date['year']){ ?>
                <?php 
                    $datebefore = $date['year'];
                    $year[] = $date['year'];
            }
        } ?>
        <ul class="archive-list">
            <li class="archive-name"><a class="archive-name" href="<?php echo $view->controller->getDateLink()?>"><?php echo t('All')?></a></li>
            <?php foreach($year as $y){ ?>
                <li class="archive-name dropdown">
                    <button class="archive-name"  type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $y . $bID ?>" aria-expanded="<?php echo $y == date("Y",time()) ? "true":"false"?>" aria-controls="collapseExample"><?php echo $y?></button>
                    <ul class="collapse archive-liner <?php echo $y == date("Y",time()) ? "in":""?>" id="collapseExample<?php echo $y . $bID ?>">
                    <?php foreach($dates as $date){
                        if($date['year'] == $y){?>
                            <li class="archive-name"><a href="<?php echo $view->controller->getDateLink($date) . "#link_title"?>"
                                <?php if ($view->controller->isSelectedDate($date)) { ?>
                                    class="ccm-block-date-navigation-date-selected"
                                <?php } ?>
                                ><?php echo $view->controller->getDateLabel($date)?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>

    <?php } else { ?>
        <?php echo t('None.')?>
    <?php } ?>
