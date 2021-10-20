<?php  namespace Concrete\Package\Modena\Block\VidalThemesTabs;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use \Concrete\Core\Asset\AssetList;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array('form');
    public $btFieldsRequired = array('addTabs' => array('tabHeading'));
    protected $btExportFileColumns = array();
    protected $btExportTables = array('btVidalThemesTabs', 'btVidalThemesTabsAddTabsEntries');
    protected $btTable = 'btVidalThemesTabs';
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
        return t("A block for creating a tabbed content area");
    }

    public function getBlockTypeName()
    {
        return t("Tabs");
    }

    public function getSearchableContent()
    {
        $content = array();
        $db = $this->app->make('database')->connection();
        $addTabs_items = $db->fetchAll('SELECT * FROM btVidalThemesTabsAddTabsEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addTabs_items as $addTabs_item_k => $addTabs_item_v) {
            if (isset($addTabs_item_v["tabHeading"]) && trim($addTabs_item_v["tabHeading"]) != "") {
                $content[] = $addTabs_item_v["tabHeading"];
            }
            if (isset($addTabs_item_v["tabContent"]) && trim($addTabs_item_v["tabContent"]) != "") {
                $content[] = $addTabs_item_v["tabContent"];
            }
        }
        return implode(" ", $content);
    }

    public function view()
    {
        $db = $this->app->make('database')->connection();
        $addTabs = array();
        $addTabs_items = $db->fetchAll('SELECT * FROM btVidalThemesTabsAddTabsEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addTabs_items as $addTabs_item_k => &$addTabs_item_v) {
            $addTabs_item_v["tabContent"] = isset($addTabs_item_v["tabContent"]) ? LinkAbstractor::translateFrom($addTabs_item_v["tabContent"]) : null;
        }
        $this->set('addTabs_items', $addTabs_items);
        $this->set('addTabs', $addTabs);
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

    public function delete()
    {
        $db = $this->app->make('database')->connection();
        $db->delete('btVidalThemesTabsAddTabsEntries', array('bID' => $this->bID));
        parent::delete();
    }

    public function duplicate($newBID)
    {
        $db = $this->app->make('database')->connection();
        $addTabs_items = $db->fetchAll('SELECT * FROM btVidalThemesTabsAddTabsEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        foreach ($addTabs_items as $addTabs_item) {
            unset($addTabs_item['id']);
            $addTabs_item['bID'] = $newBID;
            $db->insert('btVidalThemesTabsAddTabsEntries', $addTabs_item);
        }
        parent::duplicate($newBID);
    }

    public function add()
    {
        $this->addEdit();
        $addTabs = $this->get('addTabs');
        $this->set('addTabs_items', array());
        $this->set('addTabs', $addTabs);
    }

    public function edit()
    {
        $db = $this->app->make('database')->connection();
        $this->addEdit();
        $addTabs = $this->get('addTabs');
        $addTabs_items = $db->fetchAll('SELECT * FROM btVidalThemesTabsAddTabsEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));

        foreach ($addTabs_items as &$addTabs_item) {
            $addTabs_item['tabContent'] = isset($addTabs_item['tabContent']) ? LinkAbstractor::translateFromEditMode($addTabs_item['tabContent']) : null;
        }
        $this->set('addTabs', $addTabs);
        $this->set('addTabs_items', $addTabs_items);
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $addTabs = array();
        $this->set('addTabs', $addTabs);
        $this->set('identifier', new \Concrete\Core\Utility\Service\Identifier());
        $al = AssetList::getInstance();
        $al->register('css', 'repeatable-ft.form', 'blocks/vidal_themes_tabs/css_form/repeatable-ft.form.css', array(), 'modena');
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
        $db = $this->app->make('database')->connection();
        $rows = $db->fetchAll('SELECT * FROM btVidalThemesTabsAddTabsEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        $addTabs_items = isset($args['addTabs']) && is_array($args['addTabs']) ? $args['addTabs'] : array();
        $queries = array();
        if (!empty($addTabs_items)) {
            $i = 0;
            foreach ($addTabs_items as $addTabs_item) {
                $data = array(
                    'sortOrder' => $i + 1,
                );
                if (isset($addTabs_item['tabHeading']) && trim($addTabs_item['tabHeading']) != '') {
                    $data['tabHeading'] = trim($addTabs_item['tabHeading']);
                } else {
                    $data['tabHeading'] = null;
                }
                $data['tabContent'] = isset($addTabs_item['tabContent']) ? LinkAbstractor::translateTo($addTabs_item['tabContent']) : null;
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
                                $db->update('btVidalThemesTabsAddTabsEntries', $data, array('id' => $id));
                            }
                            break;
                        case 'insert':
                            foreach ($values as $data) {
                                $db->insert('btVidalThemesTabsAddTabsEntries', $data);
                            }
                            break;
                        case 'delete':
                            foreach ($values as $value) {
                                $db->delete('btVidalThemesTabsAddTabsEntries', array('id' => $value));
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
        $addTabsEntriesMin = 0;
        $addTabsEntriesMax = 0;
        $addTabsEntriesErrors = 0;
        $addTabs = array();
        if (isset($args['addTabs']) && is_array($args['addTabs']) && !empty($args['addTabs'])) {
            if ($addTabsEntriesMin >= 1 && count($args['addTabs']) < $addTabsEntriesMin) {
                $e->add(t("The %s field requires at least %s entries, %s entered.", t("Add Tabs"), $addTabsEntriesMin, count($args['addTabs'])));
                $addTabsEntriesErrors++;
            }
            if ($addTabsEntriesMax >= 1 && count($args['addTabs']) > $addTabsEntriesMax) {
                $e->add(t("The %s field is set to a maximum of %s entries, %s entered.", t("Add Tabs"), $addTabsEntriesMax, count($args['addTabs'])));
                $addTabsEntriesErrors++;
            }
            if ($addTabsEntriesErrors == 0) {
                foreach ($args['addTabs'] as $addTabs_k => $addTabs_v) {
                    if (is_array($addTabs_v)) {
                        if (in_array("tabHeading", $this->btFieldsRequired['addTabs']) && (!isset($addTabs_v['tabHeading']) || trim($addTabs_v['tabHeading']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Tab Heading"), t("Add Tabs"), $addTabs_k));
                        }
                        if (in_array("tabContent", $this->btFieldsRequired['addTabs']) && (!isset($addTabs_v['tabContent']) || trim($addTabs_v['tabContent']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Tab Content"), t("Add Tabs"), $addTabs_k));
                        }
                    } else {
                        $e->add(t("The values for the %s field, row #%s, are incomplete.", t('Add Tabs'), $addTabs_k));
                    }
                }
            }
        } else {
            if ($addTabsEntriesMin >= 1) {
                $e->add(t("The %s field requires at least %s entries, none entered.", t("Add Tabs"), $addTabsEntriesMin));
            }
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
        $al = AssetList::getInstance();
        $al->register('javascript', 'auto-js-vidal_themes_tabs', 'blocks/vidal_themes_tabs/auto.js', array(), 'modena');
        $this->requireAsset('javascript', 'auto-js-vidal_themes_tabs');
        $this->edit();
    }
}