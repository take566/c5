<?php defined('C5_EXECUTE') or die("Access Denied."); 
$pk = Package::getByHandle('modena');
?>

<style>

    <?php if($pk->getConfig()->get('vidal.ensemble.use_google_font')) : ?>
        .ccm-page {
            <?php $main_font = $pk->getConfig()->get('vidal.ensemble.main_google_font');
                $main_font = preg_replace("/[+]/", " ", $main_font);
                $main_font_array = (explode(':', $main_font));
            ?>
                font-family: "<?php echo $main_font_array[0]; ?>";
            <?php if(!empty($main_font_array[1])) : ?>
                font-weight: <?php echo $main_font_array[1]; ?>;
            <?php endif; ?>
        }

        .ccm-page h1,.ccm-page h2,.ccm-page h3,.ccm-page h4,.ccm-page h5,.ccm-page h6 {
            <?php $heading_font = $pk->getConfig()->get('vidal.ensemble.heading_google_font');
                $heading_font = preg_replace("/[+]/", " ", $heading_font);
                $heading_font_array = (explode(':', $heading_font));
            ?>
                font-family: "<?php echo $heading_font_array[0]; ?>";
                font-weight: <?php echo $heading_font_array[1]; ?>;
        }

        .ccm-page .desktop-nav .nav-item a, .ccm-page .desktop-nav .nav li a, .ccm-page .mobile-nav .nav-item a {
            <?php $nav_font = $pk->getConfig()->get('vidal.ensemble.nav_google_font');
                $nav_font = preg_replace("/[+]/", " ", $nav_font);
                $nav_font_array = (explode(':', $nav_font));
            ?>
                font-family: "<?php echo $nav_font_array[0]; ?>";
                font-weight: <?php echo $nav_font_array[1]; ?>;
        }
    <?php endif; ?>

    /*Header styles*/
    .ccm-page .primary-header, .ccm-page .primary-header--search, .ccm-page .primary-header--basket, .ccm-page .primary-header__logo h1 img, .ccm-page .mobile-nav-toggle, .hero-unit__spacer, .ccm-page .ccm-responsive-navigation {
        height: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height', 100); ?>px;
    }

    .ccm-page .primary-header__h1, .ccm-page .desktop-nav .nav-item, .ccm-page .desktop-nav .nav li, .ccm-page .primary-header__logo h1 img, .ccm-page .ccm-responsive-navigation ul li {
        line-height: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height', 100); ?>px;
    }

    <?php global $u;
        $u = new User();
    if($c->isEditMode()) : ?>

    .ccm-page .hero-unit-sub-page {
        padding-top: 0;
    }

    .ccm-page .primary-header {
        height: auto !important;
        z-index: 100 !important;
    }

    <?php else: ?>

    .ccm-page .hero-unit-sub-page__content {
        padding-top: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height', 100); ?>px;
    }

    <?php endif; ?>

    .ccm-page .primary-header--resized, .ccm-page .primary-header--resized .ccm-responsive-navigation {
        height: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height_scroll', 70); ?>px;
    }

    .ccm-page .primary-header--resized .desktop-nav .nav-item, .ccm-page .primary-header--resized .primary-header--search, .ccm-page .primary-header--resized .primary-header--basket, .ccm-page .primary-header--resized .primary-header, .ccm-page .primary-header--resized .primary-header__logo h1 img, .ccm-page .primary-header--resized .primary-header__h1, .ccm-page .primary-header--resized .primary-header__logo-image, .ccm-page .primary-header--resized .mobile-nav-toggle, .ccm-page .primary-header--resized .utility-bar-toggle, .ccm-page .primary-header--resized .ccm-responsive-navigation ul li {
        height: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height_scroll', 70); ?>px;
        line-height: <?php echo $pk->getConfig()->get('vidal.ensemble.static_header_height_scroll', 70); ?>px;
    }

    <?php $bg_img = $c->getAttribute('sub_page_banner');
        if ($bg_img && is_object($bg_img)) {
            $bg_img_src = $bg_img->getRelativePath();
    ?>
    .hero-unit-sub-page {
        background-image: url(<?php echo $bg_img_src; ?>);
        background-repeat: repeat-x;
    }
    <?php } ?>

    /*General site styles*/
    .ccm-page .grid-row, .ccm-page .row {
        max-width: <?php echo $pk->getConfig()->get('vidal.ensemble.site_width');?>px;
    }

    <?php if ($pk->getConfig()->get('vidal.ensemble.mobile_animation') == false) : ?>
        @media (max-width: 64em) {
            .animated {
                -o-transition-property: none;
                -moz-transition-property: none;
                -ms-transition-property: none;
                -webkit-transition-property: none;
                transition-property: none;
                -o-transform: none;
                -moz-transform: none;
                -ms-transform: none;
                -webkit-transform: none;
                transform: none;
                -webkit-animation: none;
                -moz-animation: none;
                -o-animation: none;
                -ms-animation: none;
                animation: none;
                opacity:1;
            }
        }
    <?php endif; ?>

    /*Mobile navigation*/
    @media (max-width: 64em) {
        .ccm-page .mobile-nav {
            width: <?php echo $pk->getConfig()->get('vidal.ensemble.mobile_nav_width'); ?>%;
        }

        <?php if ($pk->getConfig()->get('vidal.ensemble.mobile_nav_arrow')) : ?>

            .has-submenu:before {
                font-family: "Ionicons";
                content: "\f3d0";
                position: absolute;
                right: 20px;
                cursor: pointer;
                font-size: 22px;
                z-index: -1;
            }

        <?php endif; ?>

        <?php if ($pk->getConfig()->get('vidal.ensemble.mobile_nav_center')) : ?>

            .ccm-page .mobile-nav .nav-item {
                text-align: center;
            }

        <?php endif; ?>

        <?php if ($pk->getConfig()->get('vidal.ensemble.mobile_nav_shadow')) : ?>

            .ccm-page .mobile-nav {
                box-shadow: none;
            }

        <?php endif; ?>

    }

    /*Desktop navigation*/
    <?php if(!empty($pk->getConfig()->get('vidal.ensemble.sub_nav_width'))) : ?>
        .ccm-page .desktop-nav .is-submenu li, .ccm-page .desktop-nav li ul li {
            min-width: <?php echo $pk->getConfig()->get('vidal.ensemble.sub_nav_width'); ?>px;
        }
    <?php else : ?>
        .ccm-page .desktop-nav .is-submenu li, .ccm-page .desktop-nav li ul li {
            width: 100%;
            white-space: nowrap;
        }
    <?php endif; ?>

    /*Isotope styling*/
    .ccm-page .isotope-item {
        border: <?php echo $pk->getConfig()->get('vidal.ensemble.portfolio_margin'); ?> solid transparent;
    }

    .ccm-page .isotope-items {
        margin: 0 <?php echo $pk->getConfig()->get('vidal.ensemble.portfolio_margin'); ?> 0 <?php echo $pk->getConfig()->get('vidal.ensemble.portfolio_margin'); ?>;
    }

    .ccm-page [class*="column-"] .isotope-items {
        margin: 0 -<?php echo $pk->getConfig()->get('vidal.ensemble.portfolio_margin'); ?> 0 -<?php echo $pk->getConfig()->get('vidal.ensemble.portfolio_margin'); ?>;
    }

    /*Isotope styling for masonry blog*/
    .ccm-page .masonry-blog-items {
        margin: 0 <?php echo $pk->getConfig()->get('vidal.ensemble.blog_margin'); ?> 0 <?php echo $pk->getConfig()->get('vidal.ensemble.blog_margin'); ?>;
    }

    .ccm-page [class*="column-"] .masonry-blog-items {
        margin: 0 -<?php echo $pk->getConfig()->get('vidal.ensemble.blog_margin'); ?> 0 -<?php echo $pk->getConfig()->get('vidal.ensemble.blog_margin'); ?>;
    }

    .ccm-page .isotope-item.masonry-blog-item {
        border: <?php echo $pk->getConfig()->get('vidal.ensemble.blog_margin'); ?> solid transparent;
    }

</style>