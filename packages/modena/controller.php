<?php namespace Concrete\Package\Modena;

use \Concrete\Core\Page\Single as SinglePage;
use \Concrete\Core\Page\Page;
use \Concrete\Core\Package\Package;
use \Concrete\Package\Modena\Src\EnsembleGridFramework;
use \Concrete\Core\Page\Template;
use \Concrete\Core\Page\Theme\Theme;
use \Concrete\Core\Page\Type\Type;
use \Concrete\Core\Block\BlockType\BlockType;
use \Concrete\Core\Block\BlockType\Set;
use \Concrete\Core\File\Importer;
use \Concrete\Core\Page\PageList;
use \Concrete\Core\File\FileList;
use \Concrete\Core\Page\Stack\StackList;
use \Concrete\Core\Attribute\Type as AttributeType;
use \Concrete\Attribute\Select;
use \Concrete\Attribute\Select\Option as SelectAttributeTypeOption;
use \Concrete\Core\Tree\Type\Topic;
use \Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey;
use \Concrete\Core\Backup\ContentImporter;


defined('C5_EXECUTE') or die('Access Denied.');

if (!function_exists('compat_is_version_8')) {
    function compat_is_version_8() {
        return interface_exists('\Concrete\Core\Export\ExportableInterface');
    }
}

class Controller extends Package
{
    protected $pkgHandle = 'modena';
    protected $appVersionRequired = '8.5.1';
    protected $pkgVersion = '1.1.7';
    protected $pkgAllowsFullContentSwap = true;
    protected $pkgAutoloaderRegistries = array(
        'src' => '\Concrete\Package\Modena\Src'
    );

    public function getPackageName()
    {
        return t("Modena Theme");
    }

    public function getPackageDescription()
    {
        return t("A stylish, modern, multi-use Concrete5 theme");
    }

    public function swapContent($options)
    {
        if ($this->validateClearSiteContents($options)) {
            $app->make('cache/request')->disable();

            $pl = new PageList();
            $pages = $pl->getResults();
            foreach ($pages as $c) {
                $c->delete();
            }

            $fl = new FileList();
            $files = $fl->getResults();
            foreach ($files as $f) {
                $f->delete();
            }

            $sl = new StackList();
            foreach ($sl->get() as $c) {
                $c->delete();
            }

            $home = Page::getByID(HOME_CID);
            $blocks = $home->getBlocks();
            foreach ($blocks as $b) {
                $b->deleteBlock();
            }

            $pageTypes = PageType::getList();
            foreach ($pageTypes as $ct) {
                $ct->delete();
            }

            if (is_dir($this->getPackagePath() . '/content_files')) {
                $ch = new ContentImporter();
                $computeThumbnails = true;
                if ($this->contentProvidesFileThumbnails()) {
                    $computeThumbnails = false;
                }
                $ch->importFiles($this->getPackagePath() . '/content_files', $computeThumbnails);
            }

            $ci = new ContentImporter();
            $ci->importContentFile($this->getPackagePath() . '/content.xml');

            $app->make('cache/request')->enable();
        }
    }

    public function install()
    {
        $pkg = parent::install();
        $theme = Theme::add('modena', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/header_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/footer_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/navigation_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/mobile_navigation_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/site_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/blog_settings', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/google_fonts', $pkg);
        SinglePage::add('/dashboard/modena_theme_options/portfolio_settings', $pkg);

        // Set up general site options
        $pkg->getConfig()->save('vidal.ensemble.site_width', '1240');
        $pkg->getConfig()->save('vidal.ensemble.social_button_shape', 'square');
        $pkg->getConfig()->save('vidal.ensemble.disable_preloader', true);
        $pkg->getConfig()->save('vidal.ensemble.disable_backtotop', true);
        $pkg->getConfig()->save('vidal.ensemble.use_us_date', false);
        $pkg->getConfig()->save('vidal.ensemble.mobile_animation', false);

        // Set up header options
        $pkg->getConfig()->save('vidal.ensemble.static_header', true);
        $pkg->getConfig()->save('vidal.ensemble.static_header_height', '100');
        $pkg->getConfig()->save('vidal.ensemble.static_header_height_scroll', '70');
        $pkg->getConfig()->save('vidal.ensemble.disable_search', true);
        $pkg->getConfig()->save('vidal.ensemble.disable_guide_header', true);
        $pkg->getConfig()->save('vidal.ensemble.style_sub_header', false);

        // Set up footer options
        $pkg->getConfig()->save('vidal.ensemble.copyright_notice', '<a href="http://vidalthemes.com" target="_blank">Theme by Vidal Themes</a>');
        $pkg->getConfig()->save('vidal.ensemble.copyright_position', 'left');
        $pkg->getConfig()->save('vidal.ensemble.login_link', false);
        $pkg->getConfig()->save('vidal.ensemble.credit_link', false);
        $pkg->getConfig()->save('vidal.ensemble.footer_columns', '5');

        // Set up desktop navigation options
        $pkg->getConfig()->save('vidal.ensemble.sub_nav_width', '225');

        // Set up mobile navigation options
        $pkg->getConfig()->save('vidal.ensemble.mobile_nav_width', '70');
        $pkg->getConfig()->save('vidal.ensemble.mobile_nav_arrow', true);
        $pkg->getConfig()->save('vidal.ensemble.mobile_nav_center', false);
        $pkg->getConfig()->save('vidal.ensemble.mobile_nav_shadow', false);

        // Set up blog options
        $pkg->getConfig()->save('vidal.ensemble.blog_sidebar', 'left');
        $pkg->getConfig()->save('vidal.ensemble.blog_columns', 'isotope-width-4');
        $pkg->getConfig()->save('vidal.ensemble.blog_margin', '10px');
        $pkg->getConfig()->save('vidal.ensemble.read_more', 'Read more...');
        $pkg->getConfig()->save('vidal.ensemble.read_more_overlay', 'Read this article');

        // Set up Google Fonts
        $pkg->getConfig()->save('vidal.ensemble.use_google_font', false);
        $pkg->getConfig()->save('vidal.ensemble.main_google_font', 'Open+Sans');
        $pkg->getConfig()->save('vidal.ensemble.heading_google_font', 'Open+Sans');
        $pkg->getConfig()->save('vidal.ensemble.nav_google_font', 'Open+Sans');

        // Set up portfolio options
        $pkg->getConfig()->save('vidal.ensemble.topic_list_position', 'text-center');
        $pkg->getConfig()->save('vidal.ensemble.portfolio_columns', 'isotope-width-4');
        $pkg->getConfig()->save('vidal.ensemble.portfolio_margin', '10px');

        // Install our Blocks

        if(!Set::getByHandle('modena')) {
            Set::add('modena', 'Modena', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_accordion');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_accordion', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_animated_content');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_animated_content', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_buttons');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_buttons', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_hero_unit');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_hero_unit', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_icon_box');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_icon_box', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_slider');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_slider', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_lightbox');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_lightbox', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_tabs');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_tabs', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_notices');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_notices', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_pricing');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_pricing', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_team');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_team', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_offscreen_hero');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_offscreen_hero', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_quote_slider');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_quote_slider', $pkg);
        }

        $bt = BlockType::getByHandle('vidal_themes_video_hero_unit');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType('vidal_themes_video_hero_unit', $pkg);
        }

        // Install our page templates

        if(!Template::getByHandle('right_sidebar')) {
            Template::add('right_sidebar', t('Right Sidebar'), 'right_sidebar.png', $pkg);
        }

        if(!Template::getByHandle('left_sidebar')) {
            Template::add('left_sidebar', t('Left Sidebar'), 'left_sidebar.png', $pkg);
        }

        if(!Template::getByHandle('full')) {
            Template::add('full_width', t('Full'), 'full.png', $pkg);
        }

        if(!Template::getByHandle('sub_page')) {
            Template::add('sub_page', t('Sub Page'), 'full.png', $pkg);
        }

        if(!Template::getByHandle('blog_entry')) {
            Template::add('blog_entry', t('Blog Entry'), 'full.png', $pkg);
        }

        if(!Template::getByHandle('home')) {
            Template::add('home', t('Home'), 'full.png', $pkg);
        }

        // Install and register attributes

        $bgImgAttrKey = CollectionAttributeKey::getByHandle('sub_page_banner');
            if (!$bgImgAttrKey || !intval($bgImgAttrKey->getAttributeKeyID())) {
                $boolt = AttributeType::getByHandle('image_file');
                $bgImgAttrKey = CollectionAttributeKey::add($boolt, array('akHandle' => 'sub_page_banner', 'akName' => t('Page Banner'), 'akIsSearchable' => false),$pkg);
        }

        $disableSubPageName = CollectionAttributeKey::getByHandle('disable_sub_page_name');
            if (!$disableSubPageName || !intval($disableSubPageName->getAttributeKeyID())) {
                $disableName = AttributeType::getByHandle('boolean');
                $disableSubPageName = CollectionAttributeKey::add($disableName, array('akHandle' => 'disable_sub_page_name', 'akName' => t('Disable Sub Page Name'), 'akIsSearchable' => false),$pkg);
        }

        $disableSubPageBanner = CollectionAttributeKey::getByHandle('disable_sub_page_banner');
            if (!$disableSubPageBanner || !intval($disableSubPageBanner->getAttributeKeyID())) {
                $disableBanner = AttributeType::getByHandle('boolean');
                $disableSubPageBanner = CollectionAttributeKey::add($disableBanner, array('akHandle' => 'disable_sub_page_banner', 'akName' => t('Disable Sub Page Banner'), 'akIsSearchable' => false),$pkg);
        }

        $disableSubPageFooterMargin = CollectionAttributeKey::getByHandle('disable_sub_page_footer_margin');
            if (!$disableSubPageFooterMargin || !intval($disableSubPageFooterMargin->getAttributeKeyID())) {
                $disableFooterMargin = AttributeType::getByHandle('boolean');
                $disableSubPageFooterMargin = CollectionAttributeKey::add($disableFooterMargin, array('akHandle' => 'disable_sub_page_footer_margin', 'akName' => t('Disable Page Footer Margin'), 'akIsSearchable' => false),$pkg);
        }

        $subPageHeadingSubText = CollectionAttributeKey::getByHandle('sub_page_heading_sub_text');
            if (!$subPageHeadingSubText || !intval($subPageHeadingSubText->getAttributeKeyID())) {
                $subPageSubText = AttributeType::getByHandle('text');
                $subPageHeadingSubText = CollectionAttributeKey::add($subPageSubText, array('akHandle' => 'sub_page_heading_sub_text', 'akName' => t('Sub Page Heading Description'), 'akIsSearchable' => false),$pkg);
        }

        $subPageHeadingHashTag = CollectionAttributeKey::getByHandle('sub_page_heading_hash_tag');
            if (!$subPageHeadingHashTag || !intval($subPageHeadingHashTag->getAttributeKeyID())) {
                $subPageHash = AttributeType::getByHandle('boolean');
                $subPageHeadingHashTag = CollectionAttributeKey::add($subPageHash, array('akHandle' => 'sub_page_heading_hash_tag', 'akName' => t('Disable Sub Heading Hash Tag'), 'akIsSearchable' => false),$pkg);
        }
    }

    public function upgrade() {
        parent::upgrade();
        $pkg = Package::getByHandle('modena');
        $bt = BlockType::getByHandle('vidal_themes_video_hero_unit');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockTypeFromPackage('vidal_themes_video_hero_unit', $pkg);
        }
    }

    public function on_start()
    {

        $app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();

        // Register Ensemble Grid
        $manager = $app->make('manager/grid_framework');
            $manager->extend('modena', function($app) {
                return new EnsembleGridFramework();
        });

        $al = \Concrete\Core\Asset\AssetList::getInstance();

        $al->register(
            'css', 'ensemble_ui_styles', 'css/ui-styles.css', array(), 'modena'
        );

        $al->register(
            'javascript', 'modena_google_fonts', 'js/google-fonts.js', array(), 'modena'
        );

        $al->register(
            'javascript', 'main_modena_google_fonts', 'js/main-google-fonts.js', array(), 'modena'
        );

        $al->register(
            'javascript', 'handlebars', 'js/handlebars-v4.0.4.js', array(), 'modena'
        );

        $al->register(
            'javascript', 'handlebars-helpers', 'js/handlebars-helpers.js', array(), 'modena'
        );
    }
}