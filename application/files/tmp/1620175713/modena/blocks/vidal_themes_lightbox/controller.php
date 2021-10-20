<?php  namespace Concrete\Package\Modena\Block\VidalThemesLightbox;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use \Concrete\Core\File\File;
use \Concrete\Core\Page\Page;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array('lightboxLargeImage', 'lightboxSmallImage');
    protected $btExportFileColumns = array('lightboxLargeImage', 'lightboxSmallImage');
    protected $btTable = 'btVidalThemesLightbox';
    protected $btInterfaceWidth = 700;
    protected $btInterfaceHeight = 525;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 0;
    protected $btDefaultSet = 'modena';
    protected $pkg = false;

    public function getBlockTypeDescription()
    {
        return t("Display your images within an enlarged lightbox");
    }

    public function getBlockTypeName()
    {
        return t("Lightbox");
    }

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->lightboxCaption;
        $content[] = $this->altText;
        return implode(" ", $content);
    }

    public function view()
    {

        if ($this->lightboxLargeImage && ($f = File::getByID($this->lightboxLargeImage)) && is_object($f)) {
            $this->set("lightboxLargeImage", $f);
        } else {
            $this->set("lightboxLargeImage", false);
        }

        if ($this->lightboxSmallImage && ($f = File::getByID($this->lightboxSmallImage)) && is_object($f)) {
            $this->set("lightboxSmallImage", $f);
        } else {
            $this->set("lightboxSmallImage", false);
        }
        $lightboxGallery_options = array(
            '' => "-- " . t("None") . " --",
            'lightbox' => t("Standalone lightboxed image"),
            'gallery' => t("Image forms part of a gallery")
        );
        $this->set("lightboxGallery_options", $lightboxGallery_options);
        $lightboxTheme_options = array(
            '' => "-- " . t("None") . " --",
            'light' => "Light Theme",
            'dark' => "Dark Theme"
        );
        $this->set("lightboxTheme_options", $lightboxTheme_options);
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $this->set("lightboxGallery_options", array(
                'lightbox' => t("Standalone lightboxed image"),
                'gallery' => t("Image forms part of a gallery")
            )
        );
        $this->set("lightboxTheme_options", array(
                '' => "-- " . t("None") . " --",
                'light' => "Light Theme",
                'dark' => "Dark Theme"
            )
        );
        $this->requireAsset('core/file-manager');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        if (in_array("lightboxLargeImage", $this->btFieldsRequired) && (trim($args["lightboxLargeImage"]) == "" || !is_object(File::getByID($args["lightboxLargeImage"])))) {
            $e->add(t("The %s field is required.", t("Lightbox Large Image")));
        }
        if (in_array("lightboxSmallImage", $this->btFieldsRequired) && (trim($args["lightboxSmallImage"]) == "" || !is_object(File::getByID($args["lightboxSmallImage"])))) {
            $e->add(t("The %s field is required.", t("Lightbox Small Image")));
        }
        if (in_array("lightboxCaption", $this->btFieldsRequired) && (trim($args["lightboxCaption"]) == "")) {
            $e->add(t("The %s field is required.", t("Lightbox Caption")));
        }
        if (in_array("altText", $this->btFieldsRequired) && (trim($args["altText"]) == "")) {
            $e->add(t("The %s field is required.", t("Alt Text")));
        }
        if ((in_array("lightboxGallery", $this->btFieldsRequired) && (!isset($args["lightboxGallery"]) || trim($args["lightboxGallery"]) == "")) || (isset($args["lightboxGallery"]) && trim($args["lightboxGallery"]) != "" && !in_array($args["lightboxGallery"], array("lightbox", "gallery")))) {
            $e->add(t("The %s field has an invalid value.", t("Lightbox or Gallery")));
        }
        if ((in_array("lightboxTheme", $this->btFieldsRequired) && (!isset($args["lightboxTheme"]) || trim($args["lightboxTheme"]) == "")) || (isset($args["lightboxTheme"]) && trim($args["lightboxTheme"]) != "" && !in_array($args["lightboxTheme"], array("light", "dark")))) {
            $e->add(t("The %s field has an invalid value.", t("Theme")));
        }
        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}
