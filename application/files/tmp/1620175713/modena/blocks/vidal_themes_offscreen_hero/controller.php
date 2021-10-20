<?php namespace Concrete\Package\Modena\Block\VidalThemesOffscreenHero;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use \Concrete\Core\File\File;
use \Concrete\Core\Page\Page;

class Controller extends BlockController
{
    public $btFieldsRequired = [];
    protected $btExportFileColumns = ['heroImage'];
    protected $btTable = 'btVidalThemesOffscreenHero';
    protected $btInterfaceWidth = 700;
    protected $btInterfaceHeight = 525;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btDefaultSet = 'modena';
    protected $pkg = false;
    
    public function getBlockTypeDescription()
    {
        return t("A hero unit that adds a left or right aligned image that stays partially offscreen.");
    }

    public function getBlockTypeName()
    {
        return t("Offscreen Hero Unit");
    }

    public function getSearchableContent()
    {
        $content = [];
        $content[] = $this->heroUnitContent;
        return implode(" ", $content);
    }

    public function view()
    {
        
        if ($this->heroImage && ($f = File::getByID($this->heroImage)) && is_object($f)) {
            $this->set("heroImage", $f);
        } else {
            $this->set("heroImage", false);
        }
        $alignImage_options = [
            '' => "-- " . t("None") . " --",
            'left' => t("Left"),
            'right' => t("Right")
        ];
        $this->set("alignImage_options", $alignImage_options);
        $this->set('heroUnitContent', LinkAbstractor::translateFrom($this->heroUnitContent));
        $contentAnimation_options = [
            '' => "-- " . t("None") . " --",
            'none' => t("None"),
            'animate__bounce-in' => t("Bounce in"),
            'animate__bounce-in-down' => t("Bounce in down"),
            'animate__bounce-in-right' => t("Bounce in right"),
            'animate__bounce-in-up' => t("Bounce in up"),
            'animate__bounce-in-left' => t("Bounce in left"),
            'animate__fade-in-down-short' => t("Fade in down short"),
            'animate__fade-in-up-short' => t("Fade in up short"),
            'animate__fade-in-left-short' => t("Fade in left short"),
            'animate__fade-in-right-short' => t("Fade in right short"),
            'animate__fade-in-down' => t("Fade in down"),
            'animate__fade-in-up' => t("Fade in up"),
            'animate__fade-in-left' => t("Fade in left"),
            'animate__fade-in-right' => t("Fade in right"),
            'animate__fade-in' => t("Fade in"),
            'animate__grow-in' => t("Grow in"),
            'animate__shake' => t("Shake"),
            'animate__shake-up' => t("Shake up"),
            'animate__rotate-in' => t("Rotate in"),
            'animate__rotate-in-up-left' => t("Rotate in up left"),
            'animate__rotate-in-up-right' => t("Rotate in up right"),
            'animate__rotate-in-down-right' => t("Rotate in down right"),
            'animate__rotate-in-down-left' => t("Rotate in down left"),
            'animate__rotate-in-down-right_1' => t("Rotate in down right"),
            'animate__roll-in' => t("Roll in"),
            'animate__wiggle' => t("Wiggle"),
            'animate__swing' => t("Swing"),
            'animate__tada' => t("Tada"),
            'animate__wobble' => t("Wobble"),
            'animate__pulse' => t("Pulse"),
            'animate__light-speed-in-right' => t("Light speed in right"),
            'animate__light-speed-in-left' => t("Light speed in left"),
            'animate__flip' => t("Flip"),
            'animate__flip-in-x' => t("Flip in x"),
            'animate__flip-in-y' => t("Flip in y")
        ];
        $this->set("contentAnimation_options", $contentAnimation_options);
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();
        
        $this->set('heroUnitContent', LinkAbstractor::translateFromEditMode($this->heroUnitContent));
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $this->set("alignImage_options", [
                '' => "-- " . t("None") . " --",
                'left' => t("Left"),
                'right' => t("Right")
            ]
        );
        $this->set("contentAnimation_options", [
                '' => "-- " . t("None") . " --",
                'none' => t("None"),
                'animate__bounce-in' => t("Bounce in"),
                'animate__bounce-in-down' => t("Bounce in down"),
                'animate__bounce-in-right' => t("Bounce in right"),
                'animate__bounce-in-up' => t("Bounce in up"),
                'animate__bounce-in-left' => t("Bounce in left"),
                'animate__fade-in-down-short' => t("Fade in down short"),
                'animate__fade-in-up-short' => t("Fade in up short"),
                'animate__fade-in-left-short' => t("Fade in left short"),
                'animate__fade-in-right-short' => t("Fade in right short"),
                'animate__fade-in-down' => t("Fade in down"),
                'animate__fade-in-up' => t("Fade in up"),
                'animate__fade-in-left' => t("Fade in left"),
                'animate__fade-in-right' => t("Fade in right"),
                'animate__fade-in' => t("Fade in"),
                'animate__grow-in' => t("Grow in"),
                'animate__shake' => t("Shake"),
                'animate__shake-up' => t("Shake up"),
                'animate__rotate-in' => t("Rotate in"),
                'animate__rotate-in-up-left' => t("Rotate in up left"),
                'animate__rotate-in-up-right' => t("Rotate in up right"),
                'animate__rotate-in-down-right' => t("Rotate in down right"),
                'animate__rotate-in-down-left' => t("Rotate in down left"),
                'animate__rotate-in-down-right_1' => t("Rotate in down right"),
                'animate__roll-in' => t("Roll in"),
                'animate__wiggle' => t("Wiggle"),
                'animate__swing' => t("Swing"),
                'animate__tada' => t("Tada"),
                'animate__wobble' => t("Wobble"),
                'animate__pulse' => t("Pulse"),
                'animate__light-speed-in-right' => t("Light speed in right"),
                'animate__light-speed-in-left' => t("Light speed in left"),
                'animate__flip' => t("Flip"),
                'animate__flip-in-x' => t("Flip in x"),
                'animate__flip-in-y' => t("Flip in y")
            ]
        );
        $this->requireAsset('core/file-manager');
        $this->requireAsset('redactor');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', $this->app->make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
        $args['heroUnitContent'] = LinkAbstractor::translateTo($args['heroUnitContent']);
        $args['animateOnce'] = isset($args['animateOnce']) ? 1 : 0;
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        if (in_array("heroImage", $this->btFieldsRequired) && (trim($args["heroImage"]) == "" || !is_object(File::getByID($args["heroImage"])))) {
            $e->add(t("The %s field is required.", t("Hero Image")));
        }
        if ((in_array("alignImage", $this->btFieldsRequired) && (!isset($args["alignImage"]) || trim($args["alignImage"]) == "")) || (isset($args["alignImage"]) && trim($args["alignImage"]) != "" && !in_array($args["alignImage"], ["left", "right"]))) {
            $e->add(t("The %s field has an invalid value.", t("Align Image")));
        }
        if (in_array("heroUnitContent", $this->btFieldsRequired) && (trim($args["heroUnitContent"]) == "")) {
            $e->add(t("The %s field is required.", t("Hero Unit Content")));
        }
        if ((in_array("contentAnimation", $this->btFieldsRequired) && (!isset($args["contentAnimation"]) || trim($args["contentAnimation"]) == "")) || (isset($args["contentAnimation"]) && trim($args["contentAnimation"]) != "" && !in_array($args["contentAnimation"], ["none", "animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right_1", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
            $e->add(t("The %s field has an invalid value.", t("Content Animation")));
        }
        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}