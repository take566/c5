<?php  namespace Concrete\Package\Modena\Block\VidalThemesTeam;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use \Concrete\Core\File\File;
use \Concrete\Core\Page\Page;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array();
    protected $btExportFileColumns = array('profileImage');
    protected $btTable = 'btVidalThemesTeam';
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
        return t("A Block to add team member profiles");
    }

    public function getBlockTypeName()
    {
        return t("Team Profiles");
    }

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->profileName;
        $content[] = $this->jobTitle;
        $content[] = $this->profileBio;
        return implode(" ", $content);
    }

    public function view()
    {

        if ($this->profileImage && ($f = File::getByID($this->profileImage)) && is_object($f)) {
            $this->set("profileImage", $f);
        } else {
            $this->set("profileImage", false);
        }
        $this->set('profileBio', LinkAbstractor::translateFrom($this->profileBio));
        $roundProfilePic_options = array(
            '' => "-- " . t("None") . " --",
            'profile__avatar--round' => t("Round Image"),
            'profile__avatar--standard' => t("Square Image")
        );
        $this->set("roundProfilePic_options", $roundProfilePic_options);
        $chooseAnimation_options = [
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
            $this->set("chooseAnimation_options", $chooseAnimation_options);
            $animationSpeed_options = [
                '' => "-- " . t("None") . " --",
                'animated-slow' => t("Slow"),
                'animated-slower' => t("Slower"),
                'animated-slowest' => t("Slowest")
            ];
        $this->set("animationSpeed_options", $animationSpeed_options);
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();

        $this->set('profileBio', LinkAbstractor::translateFromEditMode($this->profileBio));
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $this->set("roundProfilePic_options", array(
                '' => "-- " . t("None") . " --",
                'profile__avatar--round' => t("Round Image"),
                'profile__avatar--standard' => t("Square Image")
            )
        );
        $this->requireAsset('core/file-manager');
        $this->requireAsset('redactor');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set("chooseAnimation_options", [
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
        $this->set("animationSpeed_options", [
                '' => "-- " . t("None") . " --",
                'animated-slow' => t("Slow"),
                'animated-slower' => t("Slower"),
                'animated-slowest' => t("Slowest")
            ]
        );
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', $this->app->make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
        $args['profileBio'] = LinkAbstractor::translateTo($args['profileBio']);
        if (!isset($args["animateOnce"]) || trim($args["animateOnce"]) == "" || !in_array($args["animateOnce"], [0, 1])) {
            $args["animateOnce"] = '';
        }
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        if (in_array("profileImage", $this->btFieldsRequired) && (trim($args["profileImage"]) == "" || !is_object(File::getByID($args["profileImage"])))) {
            $e->add(t("The %s field is required.", t("Profile Image")));
        }
        if (in_array("profileName", $this->btFieldsRequired) && (trim($args["profileName"]) == "")) {
            $e->add(t("The %s field is required.", t("Name")));
        }
        if (in_array("jobTitle", $this->btFieldsRequired) && (trim($args["jobTitle"]) == "")) {
            $e->add(t("The %s field is required.", t("Job Title")));
        }
        if (in_array("profileBio", $this->btFieldsRequired) && (trim($args["profileBio"]) == "")) {
            $e->add(t("The %s field is required.", t("Profile Bio")));
        }
        if ((in_array("roundProfilePic", $this->btFieldsRequired) && (!isset($args["roundProfilePic"]) || trim($args["roundProfilePic"]) == "")) || (isset($args["roundProfilePic"]) && trim($args["roundProfilePic"]) != "" && !in_array($args["roundProfilePic"], array("profile__avatar--round", "profile__avatar--standard")))) {
            $e->add(t("The %s field has an invalid value.", t("Round Profile Images")));
        }
        if ((in_array("chooseAnimation", $this->btFieldsRequired) && (!isset($args["chooseAnimation"]) || trim($args["chooseAnimation"]) == "")) || (isset($args["chooseAnimation"]) && trim($args["chooseAnimation"]) != "" && !in_array($args["chooseAnimation"], ["animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right_1", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
            $e->add(t("The %s field has an invalid value.", t("Choose Animation")));
        }
        if (in_array("animationOffset", $this->btFieldsRequired) && (trim($args["animationOffset"]) == "")) {
            $e->add(t("The %s field is required.", t("Offset")));
        }
        if ((in_array("animationSpeed", $this->btFieldsRequired) && (!isset($args["animationSpeed"]) || trim($args["animationSpeed"]) == "")) || (isset($args["animationSpeed"]) && trim($args["animationSpeed"]) != "" && !in_array($args["animationSpeed"], ["animated-slow", "animated-slower", "animated-slowest"]))) {
            $e->add(t("The %s field has an invalid value.", t("Animation Speed")));
        }
        if (in_array("animateOnce", $this->btFieldsRequired) && (trim($args["animateOnce"]) == "" || !in_array($args["animateOnce"], [0, 1]))) {
            $e->add(t("The %s field is required.", t("Animate Once")));
        }
        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}
