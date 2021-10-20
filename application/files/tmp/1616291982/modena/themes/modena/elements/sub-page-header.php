<?php defined('C5_EXECUTE') or die("Access Denied."); 
$pk = Package::getByHandle('modena');
$staticHeader = $pk->getConfig()->get('vidal.ensemble.static_header');
$disableSearch = $pk->getConfig()->get('vidal.ensemble.disable_search');
$guideHeader = $pk->getConfig()->get('vidal.ensemble.disable_guide_header');
$subHeaderStyle = $pk->getConfig()->get('vidal.ensemble.style_sub_header');
?>
<!doctype html>
<html lang="<?php echo Localization::activeLanguage()?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php View::element('header_required', array('pageTitle' => $pageTitle));?>
    <?php  echo $html->css($view->getStylesheet('main.less'))?>
    <?php if($pk->getConfig()->get('vidal.ensemble.use_google_font') == true) : ?>
        <link href="https://fonts.googleapis.com/css?family=<?php echo $pk->getConfig()->get('vidal.ensemble.main_google_font'); ?>:300,400,500,600,700,800,900" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=<?php echo $pk->getConfig()->get('vidal.ensemble.heading_google_font'); ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=<?php echo $pk->getConfig()->get('vidal.ensemble.nav_google_font'); ?>" rel="stylesheet" type="text/css">
    <?php endif; ?>
</head>
<body class="body">
    <div class="<?php echo $c->getPageWrapperClass()?>">
    <?php if($pk->getConfig()->get('vidal.ensemble.disable_preloader') == true) : ?>
        <div class="page-pre-loader">
            <div class="page-pre-loader__container">
                <div class="page-pre-loader__effect"></div>
            </div>
        </div>
    <?php endif; ?>
        <?php  global $u;
            $u = new User();
                if (($u->isRegistered()) || $c->isEditMode()) { ?>
                    <style media="screen">
                        .ccm-page .primary-header--fixed-nav {
                            top: 48px;
                            overflow: visible !important;
                        }
                    </style>
        <?php } ?>
    <?php $this->inc('elements/styles.php'); ?>

<header class="primary-header <?php echo ($staticHeader == true && !$c->isEditMode()) ? "primary-header--fixed-nav" : ""; ?> <?php echo ($guideHeader == true && $c->isEditMode()) ? "primary-header--guide-header" : ""; ?> <?php echo ($subHeaderStyle == true) ? "secondary-header" : ""; ?>">
    <div class="grid-container">
        <div class="grid-row">
            <div class="column-12">
            <?php
                if ($disableSearch == true ) : ?>
                    <div class="primary-header--search float-right">
                        <div class="primary-header--search-inner">
                            <i class="ion-ios-search-strong"></i>
                        </div>
                    </div>
                <?php endif;?>
                <div class="primary-header__logo float-left">
                    <h1 class="primary-header__h1">
                        <?php
                            $a = new GlobalArea('Header Site Title');
                            $a->display();
                        ?>
                    </h1>
                </div>
                <button class="mobile-nav-toggle float-right">
                    <span></span>
                </button>
                <nav class="desktop-nav float-right">
                    <?php
                        $a = new GlobalArea('Header Navigation');
                        $a->setCustomTemplate("autonav", "main-nav");
                        $a->display();
                    ?>
                </nav>
                <span class="border-bottom"></span>
            </div>
        </div>
    </div>
    <div class="primary-header--search-dropdown">
        <div class="grid-container">
            <div class="grid-row">
                <div class="column-6 push-column-6">
                    <div class="column-background">
                        <?php
                            $a = new GlobalArea('Search');
                            $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
