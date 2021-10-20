<?php  namespace Concrete\Package\Modena\Block\VidalThemesAnimatedContent;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use \Concrete\Core\Asset\AssetList;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array();
    protected $btExportFileColumns = array();
    protected $btTable = 'btVidalThemesAnimatedContent';
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
        return t("A block for creating CSS3 animated content");
    }

    public function getBlockTypeName()
    {
        return t("Animated Content");
    }

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->offset;
        $content[] = $this->animatedContents;
        return implode(" ", $content);
    }

    public function view()
    {
        $chooseAnimation_options = array(
            '' => "-- " . t("None") . " --",
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
            'animate__rotate-in-down-right' => t("Rotate in down right"),
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
        );
        $this->set("chooseAnimation_options", $chooseAnimation_options);
        $animationSpeed_options = array(
            '' => "-- " . t("None") . " --",
            'animated-slow' => "Slow",
            'animated-slower' => "Slower",
            'animated-slowest' => "Slowest"
        );
        $this->set("animationSpeed_options", $animationSpeed_options);
        $animateOnce_options = array(
            '' => "-- " . t("None") . " --",
            'animate-once' => "Animate once",
            'animate-multi' => "Animate on each scroll"
        );
        $this->set("animateOnce_options", $animateOnce_options);
        $this->set('animatedContents', LinkAbstractor::translateFrom($this->animatedContents));
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();

        $this->set('animatedContents', LinkAbstractor::translateFromEditMode($this->animatedContents));
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $this->set("chooseAnimation_options", array(
                '' => "-- " . t("None") . " --",
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
                'animate__rotate-in-down-right' => t("Rotate in down right"),
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
            )
        );
        $this->set("animationSpeed_options", array(
                '' => "-- " . t("None") . " --",
                'animated-slow' => "Slow",
                'animated-slower' => "Slower",
                'animated-slowest' => "Slowest"
            )
        );
        $this->set("animateOnce_options", array(
                '' => "-- " . t("None") . " --",
                'animate-once' => "Animate once",
                'animate-multi' => "Animate on each scroll"
            )
        );
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
    }

    public function save($args)
    {
        $args['animatedContents'] = LinkAbstractor::translateTo($args['animatedContents']);
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        if ((in_array("chooseAnimation", $this->btFieldsRequired) && (!isset($args["chooseAnimation"]) || trim($args["chooseAnimation"]) == "")) || (isset($args["chooseAnimation"]) && trim($args["chooseAnimation"]) != "" && !in_array($args["chooseAnimation"], array("animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y")))) {
            $e->add(t("The %s field has an invalid value.", t("Choose Animation")));
        }
        if (in_array("offset", $this->btFieldsRequired) && (trim($args["offset"]) == "")) {
            $e->add(t("The %s field is required.", t("Offset")));
        }
        if ((in_array("animationSpeed", $this->btFieldsRequired) && (!isset($args["animationSpeed"]) || trim($args["animationSpeed"]) == "")) || (isset($args["animationSpeed"]) && trim($args["animationSpeed"]) != "" && !in_array($args["animationSpeed"], array("animated-slow", "animated-slower", "animated-slowest")))) {
            $e->add(t("The %s field has an invalid value.", t("Animation Speed")));
        }
        if ((in_array("animateOnce", $this->btFieldsRequired) && (!isset($args["animateOnce"]) || trim($args["animateOnce"]) == "")) || (isset($args["animateOnce"]) && trim($args["animateOnce"]) != "" && !in_array($args["animateOnce"], array("animate-once", "animate-multi")))) {
            $e->add(t("The %s field has an invalid value.", t("Animate Once")));
        }
        if (in_array("animatedContents", $this->btFieldsRequired) && (trim($args["animatedContents"]) == "")) {
            $e->add(t("The %s field is required.", t("Content")));
        }
        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}
