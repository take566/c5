<?php  namespace Concrete\Package\Modena\Block\VidalThemesNotices;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array('noticeContent');
    protected $btExportFileColumns = array();
    protected $btTable = 'btVidalThemesNotices';
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
        return t("Place a timed, dismissable notice on your page.");
    }

    public function getBlockTypeName()
    {
        return t("Notices");
    }

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->noticeContent;
        $content[] = $this->displayTime;
        return implode(" ", $content);
    }

    public function view()
    {
        $this->set('noticeContent', LinkAbstractor::translateFrom($this->noticeContent));
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();

        $this->set('noticeContent', LinkAbstractor::translateFromEditMode($this->noticeContent));
    }

    protected function addEdit()
    {
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('app', $this->app);
    }

    public function save($args)
    {
        $args['noticeContent'] = LinkAbstractor::translateTo($args['noticeContent']);
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        if (in_array("noticeContent", $this->btFieldsRequired) && (trim($args["noticeContent"]) == "")) {
            $e->add(t("The %s field is required.", t("Notice Content")));
        }
        if (in_array("displayTime", $this->btFieldsRequired) && (trim($args["displayTime"]) == "")) {
            $e->add(t("The %s field is required.", t("Display Time")));
        }
        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}
