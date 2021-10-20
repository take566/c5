<?php defined('C5_EXECUTE') or die('Access Denied.');

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$request =$app->make('\Concrete\Core\Http\Request');
$query_search_paths = $request->query->get('search_paths');

if (isset($error)) {
    ?><?php echo $error?><br/><br/><?php

}

if (!isset($query) || !is_string($query)) {
    $query = '';
}

?><form action="<?php echo $view->url($resultTarget)?>" method="get" class="ccm-search-block-form search-results-form"><?php
    if (isset($title) && ($title !== '')) {
        ?>
            <h3><?php echo h($title)?></h3>

        <?php

    }
    if ($query === '') { ?>
    
    <input name="search_paths[]" type="hidden" value="<?php echo htmlentities($baseSearchPath, ENT_COMPAT, APP_CHARSET) ?>" />

    <?php } else if (is_array($query_search_paths)) {
        foreach($query_search_paths as $search_path){ ?>
            
            <input name="search_paths[]" type="hidden" value="<?php echo htmlentities($search_path, ENT_COMPAT, APP_CHARSET) ?>" /><?php

        }
    }
    ?>
    <input name="query" type="text" value="<?php echo htmlentities($query, ENT_COMPAT, APP_CHARSET)?>" class="ccm-search-block-text search-results-input" /><?php
    if (isset($buttonText) && ($buttonText !== '')) {
        ?> <input name="submit" type="submit" value="<?php echo h($buttonText)?>" class="btn btn-default ccm-search-block-submit search-results-submit" /><?php

    }

    if (isset($do_search) && $do_search) {
        if (count($results) == 0) {
            ?><h6 class="padding-top-40"><?php echo t('There were no results found. Please try another keyword or phrase.'); ?></h6><?php

        } else {
            $tt = $app->make('helper/text');
            ?><div id="searchResults" class="padding-top-40"><?php
                foreach ($results as $r) {
                    $currentPageBody = $this->controller->highlightedExtendedMarkup($r->getPageIndexContent(), $query);
                    ?><div class="searchResult">
                        <h6><a href="<?php echo $r->getCollectionLink()?>"><?php echo $r->getCollectionName()?></a></h6>
                        <p><?php
                            if ($r->getCollectionDescription()) {
                                echo $this->controller->highlightedMarkup($tt->shortText($r->getCollectionDescription()), $query);
                                ?><br/><?php

                            }
                            echo $currentPageBody;
                            ?> <br/><a href="<?php echo $r->getCollectionLink()?>" class="pageLink"><?php echo $this->controller->highlightedMarkup($r->getCollectionLink(), $query)?></a>
                        </p>
                    </div><?php

                }
            ?></div><?php
            $pages = $pagination->getCurrentPageResults();
            if ($pagination->haveToPaginate()) {
                $showPagination = true;
                echo $pagination->renderDefaultView();
            }
        }
    }
?></form><?php
