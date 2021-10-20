<?php  namespace Concrete\Package\Modena\Block\VidalThemesAccordion;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use \Concrete\Core\Asset\AssetList;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array('addAccordion' => array());
    protected $btExportFileColumns = array();
    protected $btExportTables = array('btVidalThemesAccordion', 'btVidalThemesAccordionAddAccordionEntries');
    protected $btTable = 'btVidalThemesAccordion';
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
        return t("An accordion block");
    }

    public function getBlockTypeName()
    {
        return t("Accordion");
    }

    public function getSearchableContent()
    {
        $content = array();
        $db = $this->app->make('database')->connection();
        $addAccordion_items = $db->fetchAll('SELECT * FROM btVidalThemesAccordionAddAccordionEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addAccordion_items as $addAccordion_item_k => $addAccordion_item_v) {
            if (isset($addAccordion_item_v["accordionHeading"]) && trim($addAccordion_item_v["accordionHeading"]) != "") {
                $content[] = $addAccordion_item_v["accordionHeading"];
            }
            if (isset($addAccordion_item_v["accordionContent"]) && trim($addAccordion_item_v["accordionContent"]) != "") {
                $content[] = $addAccordion_item_v["accordionContent"];
            }
        }
        return implode(" ", $content);
    }

    public function view()
    {
        $db = $this->app->make('database')->connection();
        $addAccordion = array();
        $addAccordion_items = $db->fetchAll('SELECT * FROM btVidalThemesAccordionAddAccordionEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addAccordion_items as $addAccordion_item_k => &$addAccordion_item_v) {
            $addAccordion_item_v["accordionContent"] = isset($addAccordion_item_v["accordionContent"]) ? LinkAbstractor::translateFrom($addAccordion_item_v["accordionContent"]) : null;
        }
        $this->set('addAccordion_items', $addAccordion_items);
        $this->set('addAccordion', $addAccordion);
        $openOnStart_options = array(
            '' => "-- " . t("None") . " --",
            '1' => t("Open"),
            '0' => t("Closed")
        );
        $this->set("openOnStart_options", $openOnStart_options);

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

    public function delete()
    {
        $db = $this->app->make('database')->connection();
        $db->delete('btVidalThemesAccordionAddAccordionEntries', array('bID' => $this->bID));
        parent::delete();
    }

    public function duplicate($newBID)
    {
        $db = $this->app->make('database')->connection();
        $addAccordion_items = $db->fetchAll('SELECT * FROM btVidalThemesAccordionAddAccordionEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addAccordion_items as $addAccordion_item) {
            unset($addAccordion_item['id']);
            $addAccordion_item['bID'] = $newBID;
            $db->insert('btVidalThemesAccordionAddAccordionEntries', $addAccordion_item);
        }
        parent::duplicate($newBID);
    }

    public function add()
    {
        $this->addEdit();
        $addAccordion = $this->get('addAccordion');
        $this->set('addAccordion_items', array());
        $this->set('addAccordion', $addAccordion);
    }

    public function edit()
    {
        $db = $this->app->make('database')->connection();
        $this->addEdit();
        $addAccordion = $this->get('addAccordion');
        $addAccordion_items = $db->fetchAll('SELECT * FROM btVidalThemesAccordionAddAccordionEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));

        foreach ($addAccordion_items as &$addAccordion_item) {
            $addAccordion_item['accordionContent'] = isset($addAccordion_item['accordionContent']) ? LinkAbstractor::translateFromEditMode($addAccordion_item['accordionContent']) : null;
        }
        $this->set('addAccordion', $addAccordion);
        $this->set('addAccordion_items', $addAccordion_items);
    }

    protected function addEdit()
    {
        $addAccordion = array();
        $this->set('addAccordion', $addAccordion);
        $this->set('identifier', new \Concrete\Core\Utility\Service\Identifier());
        $this->set("openOnStart_options", array(
                '' => "-- " . t("None") . " --",
                '1' => t("Open"),
                '0' => t("Closed")
            )
        );
        $al = AssetList::getInstance();
        $al->register('css', 'repeatable-ft.form', 'blocks/vidal_themes_accordion/css_form/repeatable-ft.form.css', array(), 'modena');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('css', 'repeatable-ft.form');
        $this->requireAsset('javascript', 'handlebars');
        $this->requireAsset('javascript', 'handlebars-helpers');
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
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
        $this->set('app', $this->app);
    }

    public function save($args)
    {
        $db = $this->app->make('database')->connection();
        $rows = $db->fetchAll('SELECT * FROM btVidalThemesAccordionAddAccordionEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        $addAccordion_items = isset($args['addAccordion']) && is_array($args['addAccordion']) ? $args['addAccordion'] : array();
        $queries = array();
        if (!empty($addAccordion_items)) {
            $i = 0;
            foreach ($addAccordion_items as $addAccordion_item) {
                $data = array(
                    'sortOrder' => $i + 1,
                );
                if (isset($addAccordion_item['accordionHeading']) && trim($addAccordion_item['accordionHeading']) != '') {
                    $data['accordionHeading'] = trim($addAccordion_item['accordionHeading']);
                } else {
                    $data['accordionHeading'] = null;
                }
                $data['accordionContent'] = isset($addAccordion_item['accordionContent']) ? LinkAbstractor::translateTo($addAccordion_item['accordionContent']) : null;
                if (isset($rows[$i])) {
                    $queries['update'][$rows[$i]['id']] = $data;
                    unset($rows[$i]);
                } else {
                    $data['bID'] = $this->bID;
                    $queries['insert'][] = $data;
                }
                $i++;
            }
        }
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $queries['delete'][] = $row['id'];
            }
        }
        if (!empty($queries)) {
            foreach ($queries as $type => $values) {
                if (!empty($values)) {
                    switch ($type) {
                        case 'update':
                            foreach ($values as $id => $data) {
                                $db->update('btVidalThemesAccordionAddAccordionEntries', $data, array('id' => $id));
                            }
                            break;
                        case 'insert':
                            foreach ($values as $data) {
                                $db->insert('btVidalThemesAccordionAddAccordionEntries', $data);
                            }
                            break;
                        case 'delete':
                            foreach ($values as $value) {
                                $db->delete('btVidalThemesAccordionAddAccordionEntries', array('id' => $value));
                            }
                            break;
                    }
                }
            }
        }
        if (!isset($args["animateOnce"]) || trim($args["animateOnce"]) == "" || !in_array($args["animateOnce"], [0, 1])) {
            $args["animateOnce"] = '';
        }
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        $addAccordionEntriesMin = 0;
        $addAccordionEntriesMax = 0;
        $addAccordionEntriesErrors = 0;
        $addAccordion = array();
        if (isset($args['addAccordion']) && is_array($args['addAccordion']) && !empty($args['addAccordion'])) {
            if ($addAccordionEntriesMin >= 1 && count($args['addAccordion']) < $addAccordionEntriesMin) {
                $e->add(t("The %s field requires at least %s entries, %s entered.", t("Add Accordion"), $addAccordionEntriesMin, count($args['addAccordion'])));
                $addAccordionEntriesErrors++;
            }
            if ($addAccordionEntriesMax >= 1 && count($args['addAccordion']) > $addAccordionEntriesMax) {
                $e->add(t("The %s field is set to a maximum of %s entries, %s entered.", t("Add Accordion"), $addAccordionEntriesMax, count($args['addAccordion'])));
                $addAccordionEntriesErrors++;
            }
            if ($addAccordionEntriesErrors == 0) {
                foreach ($args['addAccordion'] as $addAccordion_k => $addAccordion_v) {
                    if (is_array($addAccordion_v)) {
                        if (in_array("accordionHeading", $this->btFieldsRequired['addAccordion']) && (!isset($addAccordion_v['accordionHeading']) || trim($addAccordion_v['accordionHeading']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Accordion Heading"), t("Add Accordion"), $addAccordion_k));
                        }
                        if (in_array("accordionContent", $this->btFieldsRequired['addAccordion']) && (!isset($addAccordion_v['accordionContent']) || trim($addAccordion_v['accordionContent']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Accordion Content"), t("Add Accordion"), $addAccordion_k));
                        }
                    } else {
                        $e->add(t("The values for the %s field, row #%s, are incomplete.", t('Add Accordion'), $addAccordion_k));
                    }
                }
            }
        } else {
            if ($addAccordionEntriesMin >= 1) {
                $e->add(t("The %s field requires at least %s entries, none entered.", t("Add Accordion"), $addAccordionEntriesMin));
            }
        }
        if ((in_array("openOnStart", $this->btFieldsRequired) && (!isset($args["openOnStart"]) || trim($args["openOnStart"]) == "")) || (isset($args["openOnStart"]) && trim($args["openOnStart"]) != "" && !in_array($args["openOnStart"], array("1", "0")))) {
            $e->add(t("The %s field has an invalid value.", t("Open on start")));
        }
        if ((in_array("chooseAnimation", $this->btFieldsRequired) && (!isset($args["chooseAnimation"]) || trim($args["chooseAnimation"]) == "")) || (isset($args["chooseAnimation"]) && trim($args["chooseAnimation"]) != "" && !in_array($args["chooseAnimation"], ["animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
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
        $al = AssetList::getInstance();
        $al->register('javascript', 'auto-js-vidal_themes_accordion', 'blocks/vidal_themes_accordion/auto.js', array(), 'modena');
        $this->requireAsset('javascript', 'auto-js-vidal_themes_accordion');
        $this->edit();
    }
}
