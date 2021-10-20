<?php namespace Concrete\Package\Modena\Block\VidalThemesSlider;

defined("C5_EXECUTE") or die("Access Denied.");

use \Concrete\Core\Asset\AssetList;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use \Concrete\Core\File\File;
use \Concrete\Core\Page\Page;

class Controller extends BlockController
{
    public $btFieldsRequired = ['slide' => []];
    protected $btExportFileColumns = ['slideImage'];
    protected $btExportPageColumns = ['buttonUrl'];
    protected $btExportTables = ['btVidalThemesSlider', 'btVidalThemesSliderSlideEntries'];
    protected $btTable = 'btVidalThemesSlider';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 525;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = false;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btDefaultSet = 'modena';
    protected $pkg = false;

    public function getBlockTypeName()
    {
        return t("Image Slider");
    }

    public function getSearchableContent()
    {
        $content = [];
        $db = $this->app->make('database')->connection();
        $slide_items = $db->fetchAll('SELECT * FROM btVidalThemesSliderSlideEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($slide_items as $slide_item_k => $slide_item_v) {
            if (isset($slide_item_v["captionHeading"]) && trim($slide_item_v["captionHeading"]) != "") {
                $content[] = $slide_item_v["captionHeading"];
            }
            if (isset($slide_item_v["CaptionContent"]) && trim($slide_item_v["CaptionContent"]) != "") {
                $content[] = $slide_item_v["CaptionContent"];
            }
        }
        $content[] = $this->slideDuration;
        return implode(" ", $content);
    }

    public function view()
    {
        $db = $this->app->make('database')->connection();
        $slide = [];
        $slide["captionHeadingAnimation_options"] = [
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
        $slide["captionContentAnimation_options"] = [
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
        $slide["linkPicker_options"] = [
            '' => "-- " . t("None") . " --",
            'page' => t("Page on this site"),
            'external' => t("External page")
        ];
        $slide["buttonType_options"] = [
            '' => "-- " . t("None") . " --",
            'button-ghost-' => t("Ghost button"),
            'button-' => t("Solid Button")
        ];
        $slide["buttonColors_options"] = [
            '' => "-- " . t("None") . " --",
            'primary' => t("Primary"),
            'secondary' => t("Secondary"),
            'tertiary' => t("Tertiary"),
            'utility-1' => t("Utility 1"),
            'utility-2' => t("Utility 2"),
            'warning' => t("Warning"),
            'success' => t("Success"),
            'danger' => t("Danger")
        ];
        $slide["buttonRadius_options"] = [
            '' => "-- " . t("None") . " --",
            'button-rounded' => t("Slightly rounded button"),
            'button-pill' => t("Pill button")
        ];
        $slide["buttonPosition_options"] = [
            '' => "-- " . t("None") . " --",
            'text-left' => t("Align Left"),
            'text-right' => t("Align Right"),
            'text-center' => t("Center")
        ];
        $slide["buttonAnimation_options"] = [
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
        $slide_items = $db->fetchAll('SELECT * FROM btVidalThemesSliderSlideEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($slide_items as $slide_item_k => &$slide_item_v) {
            if (isset($slide_item_v['slideImage']) && trim($slide_item_v['slideImage']) != "" && ($f = File::getByID($slide_item_v['slideImage'])) && is_object($f)) {
                $slide_item_v['slideImage'] = $f;
            } else {
                $slide_item_v['slideImage'] = false;
            }
            $slide_item_v["CaptionContent"] = isset($slide_item_v["CaptionContent"]) ? LinkAbstractor::translateFrom($slide_item_v["CaptionContent"]) : null;
        }
        $this->set('slide_items', $slide_items);
        $this->set('slide', $slide);
        $slideDirection_options = [
            '' => "-- " . t("None") . " --",
            'scrollHorz' => t("Scroll Horizontally"),
            'fade' => t("Fade Between Slides")
        ];
        $this->set("slideDirection_options", $slideDirection_options);
    }

    public function delete()
    {
        $db = $this->app->make('database')->connection();
        $db->delete('btVidalThemesSliderSlideEntries', ['bID' => $this->bID]);
        parent::delete();
    }

    public function duplicate($newBID)
    {
        $db = $this->app->make('database')->connection();
        $slide_items = $db->fetchAll('SELECT * FROM btVidalThemesSliderSlideEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($slide_items as $slide_item) {
            unset($slide_item['id']);
            $slide_item['bID'] = $newBID;
            $db->insert('btVidalThemesSliderSlideEntries', $slide_item);
        }
        parent::duplicate($newBID);
    }

    public function add()
    {
        $this->addEdit();
        $slide = $this->get('slide');
        $this->set('slide_items', []);

        $this->set('slide', $slide);
    }

    public function edit()
    {
        $db = $this->app->make('database')->connection();
        $this->addEdit();
        $slide = $this->get('slide');
        $slide_items = $db->fetchAll('SELECT * FROM btVidalThemesSliderSlideEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($slide_items as &$slide_item) {
            if (!File::getByID($slide_item['slideImage'])) {
                unset($slide_item['slideImage']);
            }
        }

        foreach ($slide_items as &$slide_item) {
            $slide_item['CaptionContent'] = isset($slide_item['CaptionContent']) ? LinkAbstractor::translateFromEditMode($slide_item['CaptionContent']) : null;
        }
        $this->set('slide', $slide);
        $this->set('slide_items', $slide_items);
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $slide = [];
        $slide['captionHeadingAnimation_options'] = [
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
        $slide['captionContentAnimation_options'] = [
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
        $slide['linkPicker_options'] = [
            '' => "-- " . t("None") . " --",
            'page' => t("Page on this site"),
            'external' => t("External page")
        ];
        $slide['buttonType_options'] = [
            '' => "-- " . t("None") . " --",
            'button-ghost-' => t("Ghost button"),
            'button-' => t("Solid Button")
        ];
        $slide['buttonColors_options'] = [
            '' => "-- " . t("None") . " --",
            'primary' => t("Primary"),
            'secondary' => t("Secondary"),
            'tertiary' => t("Tertiary"),
            'utility-1' => t("Utility 1"),
            'utility-2' => t("Utility 2"),
            'warning' => t("Warning"),
            'success' => t("Success"),
            'danger' => t("Danger")
        ];
        $slide['buttonRadius_options'] = [
            '' => "-- " . t("None") . " --",
            'button-rounded' => t("Slightly rounded button"),
            'button-pill' => t("Pill button")
        ];
        $slide['buttonPosition_options'] = [
            '' => "-- " . t("None") . " --",
            'text-left' => t("Align Left"),
            'text-right' => t("Align Right"),
            'text-center' => t("Center")
        ];
        $slide['buttonAnimation_options'] = [
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
        $slide['buttonIcons_options'] = (!in_array("buttonIcons", $this->btFieldsRequired['slide']) ? ["" => "-- " . t("None") . " --"] : []) + $this->fontAwesomeIcons('4.7');
        $this->set('slide', $slide);
        $this->set('identifier', new \Concrete\Core\Utility\Service\Identifier());
        $this->set("slideDirection_options", [
                '' => "-- " . t("None") . " --",
                'scrollHorz' => t("Scroll Horizontally"),
                'fade' => t("Fade Between Slides")
            ]
        );
        $al = AssetList::getInstance();
        $al->register('css', 'repeatable-ft.form', 'blocks/vidal_themes_slider/css_form/repeatable-ft.form.css', array(), 'modena');
        $al->register('css', 'auto-css-' . $this->btHandle, 'blocks/' . $this->btHandle . '/auto.css', array(), 'modena');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('css', 'repeatable-ft.form');
        $this->requireAsset('javascript', 'handlebars');
        $this->requireAsset('javascript', 'handlebars-helpers');
        $this->requireAsset('core/file-manager');
        $this->requireAsset('redactor');
        $this->requireAsset('css', 'auto-css-' . $this->btHandle);
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', $this->app->make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
        $db = $this->app->make('database')->connection();
        $rows = $db->fetchAll('SELECT * FROM btVidalThemesSliderSlideEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        $slide_items = isset($args['slide']) && is_array($args['slide']) ? $args['slide'] : [];
        $queries = [];
        if (!empty($slide_items)) {
            $i = 0;
            foreach ($slide_items as $slide_item) {
                $data = [
                    'sortOrder' => $i + 1,
                ];
                if (isset($slide_item['slideImage']) && trim($slide_item['slideImage']) != '') {
                    $data['slideImage'] = trim($slide_item['slideImage']);
                } else {
                    $data['slideImage'] = null;
                }
                if (isset($slide_item['captionHeading']) && trim($slide_item['captionHeading']) != '') {
                    $data['captionHeading'] = trim($slide_item['captionHeading']);
                } else {
                    $data['captionHeading'] = null;
                }
                $data['CaptionContent'] = isset($slide_item['CaptionContent']) ? LinkAbstractor::translateTo($slide_item['CaptionContent']) : null;
                if (isset($slide_item['captionHeadingAnimation']) && trim($slide_item['captionHeadingAnimation']) != '') {
                    $data['captionHeadingAnimation'] = trim($slide_item['captionHeadingAnimation']);
                } else {
                    $data['captionHeadingAnimation'] = null;
                }
                if (isset($slide_item['captionContentAnimation']) && trim($slide_item['captionContentAnimation']) != '') {
                    $data['captionContentAnimation'] = trim($slide_item['captionContentAnimation']);
                } else {
                    $data['captionContentAnimation'] = null;
                }
                if (isset($slide_item['linkPicker']) && trim($slide_item['linkPicker']) != '') {
                    $data['linkPicker'] = trim($slide_item['linkPicker']);
                } else {
                    $data['linkPicker'] = null;
                }
                if (isset($slide_item['buttonUrl']) && trim($slide_item['buttonUrl']) != '' && (($slide_item['buttonUrl_c'] = Page::getByID($slide_item['buttonUrl'])) && !$slide_item['buttonUrl_c']->error)) {
                    $data['buttonUrl'] = trim($slide_item['buttonUrl']);
                } else {
                    $data['buttonUrl'] = null;
                }
                if (isset($slide_item['buttonUrl_text']) && trim($slide_item['buttonUrl_text']) != '') {
                    $data['buttonUrl_text'] = trim($slide_item['buttonUrl_text']);
                } else {
                    $data['buttonUrl_text'] = null;
                }
                if (isset($slide_item['externalUrl']) && trim($slide_item['externalUrl']) != '') {
                    $data['externalUrl'] = trim($slide_item['externalUrl']);
                } else {
                    $data['externalUrl'] = null;
                }
                if (isset($slide_item['externalUrl_text']) && trim($slide_item['externalUrl_text']) != '') {
                    $data['externalUrl_text'] = trim($slide_item['externalUrl_text']);
                } else {
                    $data['externalUrl_text'] = null;
                }
                if (isset($slide_item['buttonType']) && trim($slide_item['buttonType']) != '') {
                    $data['buttonType'] = trim($slide_item['buttonType']);
                } else {
                    $data['buttonType'] = null;
                }
                if (isset($slide_item['buttonColors']) && trim($slide_item['buttonColors']) != '') {
                    $data['buttonColors'] = trim($slide_item['buttonColors']);
                } else {
                    $data['buttonColors'] = null;
                }
                if (isset($slide_item['buttonRadius']) && trim($slide_item['buttonRadius']) != '') {
                    $data['buttonRadius'] = trim($slide_item['buttonRadius']);
                } else {
                    $data['buttonRadius'] = null;
                }
                if (isset($slide_item['buttonPosition']) && trim($slide_item['buttonPosition']) != '') {
                    $data['buttonPosition'] = trim($slide_item['buttonPosition']);
                } else {
                    $data['buttonPosition'] = null;
                }
                if (isset($slide_item['buttonAnimation']) && trim($slide_item['buttonAnimation']) != '') {
                    $data['buttonAnimation'] = trim($slide_item['buttonAnimation']);
                } else {
                    $data['buttonAnimation'] = null;
                }
                if (isset($slide_item['buttonIcons']) && trim($slide_item['buttonIcons']) != '') {
                    $data['buttonIcons'] = trim($slide_item['buttonIcons']);
                } else {
                    $data['buttonIcons'] = null;
                }
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
                                $db->update('btVidalThemesSliderSlideEntries', $data, ['id' => $id]);
                            }
                            break;
                        case 'insert':
                            foreach ($values as $data) {
                                $db->insert('btVidalThemesSliderSlideEntries', $data);
                            }
                            break;
                        case 'delete':
                            foreach ($values as $value) {
                                $db->delete('btVidalThemesSliderSlideEntries', ['id' => $value]);
                            }
                            break;
                    }
                }
            }
        }
        if (!isset($args["pauseOnHover"]) || trim($args["pauseOnHover"]) == "" || !in_array($args["pauseOnHover"], [0, 1])) {
            $args["pauseOnHover"] = '';
        }
        if (!isset($args["arrowNavigation"]) || trim($args["arrowNavigation"]) == "" || !in_array($args["arrowNavigation"], [0, 1])) {
            $args["arrowNavigation"] = '';
        }
        if (!isset($args["navigationPager"]) || trim($args["navigationPager"]) == "" || !in_array($args["navigationPager"], [0, 1])) {
            $args["navigationPager"] = '';
        }
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        $slideEntriesMin = 0;
        $slideEntriesMax = 0;
        $slideEntriesErrors = 0;
        $slide = [];
        if (isset($args['slide']) && is_array($args['slide']) && !empty($args['slide'])) {
            if ($slideEntriesMin >= 1 && count($args['slide']) < $slideEntriesMin) {
                $e->add(t("The %s field requires at least %s entries, %s entered.", t("Slide"), $slideEntriesMin, count($args['slide'])));
                $slideEntriesErrors++;
            }
            if ($slideEntriesMax >= 1 && count($args['slide']) > $slideEntriesMax) {
                $e->add(t("The %s field is set to a maximum of %s entries, %s entered.", t("Slide"), $slideEntriesMax, count($args['slide'])));
                $slideEntriesErrors++;
            }
            if ($slideEntriesErrors == 0) {
                foreach ($args['slide'] as $slide_k => $slide_v) {
                    if (is_array($slide_v)) {
                        if (in_array("slideImage", $this->btFieldsRequired['slide']) && (!isset($slide_v['slideImage']) || trim($slide_v['slideImage']) == "" || !is_object(File::getByID($slide_v['slideImage'])))) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Slide Image"), t("Slide"), $slide_k));
                        }
                        if (in_array("captionHeading", $this->btFieldsRequired['slide']) && (!isset($slide_v['captionHeading']) || trim($slide_v['captionHeading']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Caption Heading"), t("Slide"), $slide_k));
                        }
                        if (in_array("CaptionContent", $this->btFieldsRequired['slide']) && (!isset($slide_v['CaptionContent']) || trim($slide_v['CaptionContent']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Caption Content"), t("Slide"), $slide_k));
                        }
                        if ((in_array("captionHeadingAnimation", $this->btFieldsRequired['slide']) && (!isset($slide_v['captionHeadingAnimation']) || trim($slide_v['captionHeadingAnimation']) == "")) || (isset($slide_v['captionHeadingAnimation']) && trim($slide_v['captionHeadingAnimation']) != "" && !in_array($slide_v['captionHeadingAnimation'], ["animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right_1", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Caption Heading Animation"), t("Slide"), $slide_k));
                        }
                        if ((in_array("captionContentAnimation", $this->btFieldsRequired['slide']) && (!isset($slide_v['captionContentAnimation']) || trim($slide_v['captionContentAnimation']) == "")) || (isset($slide_v['captionContentAnimation']) && trim($slide_v['captionContentAnimation']) != "" && !in_array($slide_v['captionContentAnimation'], ["animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right_1", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Caption Content Animation"), t("Slide"), $slide_k));
                        }
                        if ((in_array("linkPicker", $this->btFieldsRequired['slide']) && (!isset($slide_v['linkPicker']) || trim($slide_v['linkPicker']) == "")) || (isset($slide_v['linkPicker']) && trim($slide_v['linkPicker']) != "" && !in_array($slide_v['linkPicker'], ["page", "external"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Link"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonUrl", $this->btFieldsRequired['slide']) || (isset($slide_v['buttonUrl']) && trim($slide_v['buttonUrl']) != '0')) && (trim($slide_v['buttonUrl']) == "" || (($page = Page::getByID($slide_v['buttonUrl'])) && $page->error !== false))) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Button URL"), t("Slide"), $slide_k));
                        }
                        if (((!in_array("externalUrl", $this->btFieldsRequired['slide']) && isset($slide_v['externalUrl']) && trim($slide_v['externalUrl']) != "") || (in_array("externalUrl", $this->btFieldsRequired['slide']))) && (!filter_var($slide_v['externalUrl'], FILTER_VALIDATE_URL))) {
                            $e->add(t("The %s field does not have a valid URL (%s, row #%s).", t("External URL"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonType", $this->btFieldsRequired['slide']) && (!isset($slide_v['buttonType']) || trim($slide_v['buttonType']) == "")) || (isset($slide_v['buttonType']) && trim($slide_v['buttonType']) != "" && !in_array($slide_v['buttonType'], ["button-ghost-", "button-"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Button Type"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonColors", $this->btFieldsRequired['slide']) && (!isset($slide_v['buttonColors']) || trim($slide_v['buttonColors']) == "")) || (isset($slide_v['buttonColors']) && trim($slide_v['buttonColors']) != "" && !in_array($slide_v['buttonColors'], ["primary", "secondary", "tertiary", "utility-1", "utility-2", "warning", "success", "danger"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Button Colors"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonRadius", $this->btFieldsRequired['slide']) && (!isset($slide_v['buttonRadius']) || trim($slide_v['buttonRadius']) == "")) || (isset($slide_v['buttonRadius']) && trim($slide_v['buttonRadius']) != "" && !in_array($slide_v['buttonRadius'], ["button-rounded", "button-pill"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Button Radius"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonPosition", $this->btFieldsRequired['slide']) && (!isset($slide_v['buttonPosition']) || trim($slide_v['buttonPosition']) == "")) || (isset($slide_v['buttonPosition']) && trim($slide_v['buttonPosition']) != "" && !in_array($slide_v['buttonPosition'], ["text-left", "text-right", "text-center"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Button Position"), t("Slide"), $slide_k));
                        }
                        if ((in_array("buttonAnimation", $this->btFieldsRequired['slide']) && (!isset($slide_v['buttonAnimation']) || trim($slide_v['buttonAnimation']) == "")) || (isset($slide_v['buttonAnimation']) && trim($slide_v['buttonAnimation']) != "" && !in_array($slide_v['buttonAnimation'], ["animate__bounce-in", "animate__bounce-in-down", "animate__bounce-in-right", "animate__bounce-in-up", "animate__bounce-in-left", "animate__fade-in-down-short", "animate__fade-in-up-short", "animate__fade-in-left-short", "animate__fade-in-right-short", "animate__fade-in-down", "animate__fade-in-up", "animate__fade-in-left", "animate__fade-in-right", "animate__fade-in", "animate__grow-in", "animate__shake", "animate__shake-up", "animate__rotate-in", "animate__rotate-in-up-left", "animate__rotate-in-up-right", "animate__rotate-in-down-right", "animate__rotate-in-down-left", "animate__rotate-in-down-right_1", "animate__roll-in", "animate__wiggle", "animate__swing", "animate__tada", "animate__wobble", "animate__pulse", "animate__light-speed-in-right", "animate__light-speed-in-left", "animate__flip", "animate__flip-in-x", "animate__flip-in-y"]))) {
                            $e->add(t("The %s field has an invalid value (%s, row #%s).", t("Button Animation"), t("Slide"), $slide_k));
                        }
                        if ((!isset($slide_v['buttonIcons']) || trim($slide_v['buttonIcons']) == "")) {
                            if (in_array("buttonIcons", $this->btFieldsRequired['slide'])) {
                                $e->add(t("The %s field is required (%s, row #%s).", t("Button Icons"), t("Slide"), $slide_k));
                            }
                        } elseif (!array_key_exists($slide_v['buttonIcons'], $this->fontAwesomeIcons('4.7'))) {
                            $e->add(t("The %s field requires a valid Font Awesome icon  (%s, row #%s).", t("Button Icons"), t("Slide"), $slide_k));
                        }
                    } else {
                        $e->add(t("The values for the %s field, row #%s, are incomplete.", t('Slide'), $slide_k));
                    }
                }
            }
        } else {
            if ($slideEntriesMin >= 1) {
                $e->add(t("The %s field requires at least %s entries, none entered.", t("Slide"), $slideEntriesMin));
            }
        }
        if ((in_array("slideDirection", $this->btFieldsRequired) && (!isset($args["slideDirection"]) || trim($args["slideDirection"]) == "")) || (isset($args["slideDirection"]) && trim($args["slideDirection"]) != "" && !in_array($args["slideDirection"], ["scrollHorz", "fade"]))) {
            $e->add(t("The %s field has an invalid value.", t("Slide Direction")));
        }
        if (in_array("pauseOnHover", $this->btFieldsRequired) && (trim($args["pauseOnHover"]) == "" || !in_array($args["pauseOnHover"], [0, 1]))) {
            $e->add(t("The %s field is required.", t("Pause On Hover")));
        }
        if (in_array("arrowNavigation", $this->btFieldsRequired) && (trim($args["arrowNavigation"]) == "" || !in_array($args["arrowNavigation"], [0, 1]))) {
            $e->add(t("The %s field is required.", t("Show Arrow Navigation")));
        }
        if (in_array("navigationPager", $this->btFieldsRequired) && (trim($args["navigationPager"]) == "" || !in_array($args["navigationPager"], [0, 1]))) {
            $e->add(t("The %s field is required.", t("Show Navigation Pager")));
        }
        if (in_array("slideDuration", $this->btFieldsRequired) && (trim($args["slideDuration"]) == "")) {
            $e->add(t("The %s field is required.", t("Slide Duration")));
        }
        return $e;
    }

    public function composer()
    {
        $al = AssetList::getInstance();
        $al->register('javascript', 'auto-js-' . $this->btHandle, 'blocks/' . $this->btHandle . '/auto.js', array(), 'modena');
        $this->requireAsset('javascript', 'auto-js-' . $this->btHandle);
        $this->edit();
    }

        public function fontAwesomeIcons($version = '4.2')
    {
        $icons = [
            // 4.7
            'fa-address-book' => 'Address Book', 'fa-address-book-o' => 'Address Book O', 'fa-address-card' => 'Address Card', 'fa-address-card-o' => 'Address Card O', 'fa-bandcamp' => 'Bandcamp', 'fa-bath' => 'Bath', 'fa-bathtub' => 'Bathtub', 'fa-drivers-license' => 'Drivers license', 'fa-drivers-license-o' => 'Drivers License O', 'fa-eercast' => 'Eercast', 'fa-envelope-open' => 'Envelope Open', 'fa-envelope-open-o' => 'Envelope Open O', 'fa-etsy' => 'Etsy', 'fa-free-code-camp' => 'Free code camp', 'fa-grav' => 'Grav', 'fa-handshake-o' => 'Handshake O', 'fa-id-badge' => 'Id badge', 'fa-id-card' => 'Id card', 'fa-id-card-o' => 'Id card O', 'fa-imdb' => 'IMDB', 'fa-linode' => 'Linode', 'fa-meetup' => 'Meetup', 'fa-microchip' => 'Microchip', 'fa-podcast' => 'Podcast', 'fa-quora' => 'Quora', 'fa-ravelry' => 'Ravelry', 'fa-s15' => 'S15', 'fa-shower' => 'Shower', 'fa-snowflake-o' => 'Snowflake O', 'fa-superpower' => 'Superpowers', 'fa-telegram' => 'Telegram', 'fa-thermometer' => 'Thermometer', 'fa-thermometer-0' => 'Thermometer 0', 'fa-thermometer-1' => 'Thermometer 1', 'fa-thermometer-2' => 'Thermometer 2', 'fa-thermometer-3' => 'Thermometer 3', 'fa-thermometer-4' => 'Thermometer 4', 'fa-thermometer-empty' => 'Thermometer Empty', 'fa-thermometer-full' => 'Thermometer full', 'fa-thermometer-half' => 'Thermometer half', 'fa-thermometer-quarter' => 'Thermometer quarter', 'fa-thermometer-three-quarters' => 'Thermometer three quarters', 'fa-times-rectangle' => 'Times rectangle', 'fa-times-rectangle-o' => 'Times rectangle o', 'fa-user-circle' => 'User circle', 'fa-user-circle-o' => 'User circle o', 'fa-user-o' => 'User o', 'fa-vcard' => 'Vcard', 'fa-vcard-o' => 'Vcard o', 'window-close' => 'Window close', 'fa-window-close-o' => 'Window close o', 'fa-window-maximize' => 'Window maximize', 'fa-window-minimize' => 'Window minimize', 'fa-window-restore' => 'Window restore', 'fa-wpexplorer' => 'WP Explorer',
            // 4.6
            'fa-american-sign-language-interpreting' => 'American Sign Language Interpreting', 'fa-asl-interpreting' => 'American Sign Language Interpreting', 'fa-assistive-listening-systems' => 'Assistive Listening Systems', 'fa-audio-description' => 'Audio description', 'fa-blind' => 'Blind', 'fa-braille' => 'Braille', 'fa-deaf' => 'Deaf', 'fa-deafness' => 'Deafness', 'fa-envira' => 'Envira', 'fa-fa'  => 'Font Awesome (alias)', 'fa-first-order'  => 'First Order', 'fa-font-awesome' => 'Font Awesome', 'fa-gitlab' => 'GitLab', 'fa-glide' => 'Glide', 'fa-glide-g' => 'Glide (g)', 'fa-google-plus-circle' => 'Google+ circle (alias)', 'fa-google-plus-official' => 'Google+', 'fa-hard-of-hearing' => 'Hard of hearing', 'fa-low-vision' => 'Low vision', 'fa-question-circle-o' => 'Question circle o', 'fa-sign-language' => 'Sign language', 'fa-signing' => 'Signing', 'fa-snapchat' => 'SnapChat', 'fa-snapchat-ghost' => 'Snapchat ghost', 'fa-snapchat-square' => 'Snapchat square', 'fa-themeisle' => 'ThemeIsle', 'fa-universal-access' => 'Universall Access', 'fa-viadeo' => 'Viadeo', 'fa-viadeo-square' => 'Viadeo square', 'fa-volume-control-phone' => 'Volume control phone', 'fa-wheelchair-alt' => 'Wheelchair alt', 'fa-wpbeginner' => 'WPBeginner', 'fa-wpforms' => 'WPForms', 'fa-yoast' => 'Yoast',
            // 4.5
            'fa-bluetooth' => 'Bluetooth', 'fa-bluetooth-b' => 'Bluetooth b', 'fa-codiepie' => 'Codie Pie', 'fa-credit-card-alt' => 'Credit Card alt', 'fa-edge' => 'Edge', 'fa-fort-awesome' => 'FortAwesome', 'fa-hashtag' => 'Hashtag', 'fa-mixcloud' => 'Mixcloud', 'fa-modx' => 'MODX', 'fa-pause-circle' => 'Pause circle', 'fa-pause-circle-o' => 'Pause circle o', 'fa-percent' => 'Percent', 'fa-product-hunt' => 'Product hunt', 'fa-reddit-alien' => 'Reddit alien', 'fa-scribd' => 'Scribd', 'fa-shopping-bag' => 'Shopping bag', 'fa-shopping-basket' => 'Shopping basket', 'fa-stop-circle' => 'Stop circle', 'fa-stop-circle-o' => 'Stop circle o', 'fa-usb' => 'USB',
            // 4.4
            'fa-500px'     => '500px', 'fa-amazon' => 'Amazon', 'fa-balance-scale' => 'Balance scale', 'fa-battery-0' => 'Battery 0', 'fa-battery-1' => 'Battery 1', 'fa-battery-2' => 'Battery 2', 'fa-battery-3' => 'Battery 3', 'fa-battery-4' => 'Battery 4', 'fa-battery-empty' => 'Battery empty', 'fa-battery-full' => 'Battery full', 'fa-battery-half' => 'Battery half', 'fa-battery-quarter' => 'Battery quarter', 'fa-battery-three-quarters' => 'Batter three quarters', 'fa-black-tie' => 'Black tie', 'fa-calendar-check-o' => 'Calendar check o', 'fa-calendar-minus-o' => 'Calendar minus o', 'fa-calendar-plus-o' => 'Calendar plus o', 'fa-calendar-times-o' => 'Calendar times o', 'fa-cc-diners-club' => 'CC diners club', 'fa-cc-jcb' => 'CC JCB', 'fa-chrome' => 'Chrome', 'fa-clone' => 'Clone', 'fa-commenting' => 'Commenting', 'fa-commenting-o' => 'Commenting o', 'fa-contao' => 'Contao', 'fa-creative-commons' => 'Creative commons', 'fa-expeditedssl' => 'ExpeditedSSL', 'fa-firefox' => 'FireFox', 'fa-fonticons' => 'Fonticons', 'fa-genderless' => 'Genderless', 'fa-get-pocket' => 'Get pocket', 'fa-gg' => 'Gg', 'fa-gg-circle' => 'Gg circle', 'fa-hand-grab-o' => 'Hand grab o', 'fa-hand-lizard-o' => 'Hand lizard o', 'fa-hand-paper-o' => 'Hand paper o', 'fa-hand-peace-o' => 'Hand peace o', 'fa-hand-pointer-o' => 'Hand pointer o', 'fa-hand-rock-o' => 'Hand rock o', 'fa-hand-scissors-o' => 'Hand scissors o', 'fa-hand-spock-o' => 'Hand spock ok', 'fa-hand-stop-o' => 'Hand stop o', 'fa-hourglass' => 'Hourglass', 'fa-hourglass-1' => 'Hourglass 1', 'fa-hourglass-2' => 'Hourglass 2', 'fa-hourglass-3' => 'Hourglass 3', 'fa-hourglass-end' => 'Hourglass end', 'fa-hourglass-half' => 'Hourglass half', 'fa-hourglass-o' => 'Hourglass o', 'fa-hourglass-start' => 'Hourglass start', 'fa-houzz' => 'Houzz', 'fa-i-cursor' => 'I cursor', 'fa-industry' => 'Industry', 'fa-internet-explorer' => 'Internet Explorer', 'fa-map' => 'Map', 'fa-map-o' => 'Map o', 'fa-map-pin' => 'Map pin', 'fa-map-signs' => 'Map signs', 'fa-mouse-pointer' => 'Mouse pointer', 'fa-object-group' => 'Object group', 'fa-object-ungroup' => 'Object ungroup', 'fa-odnoklassniki' => 'Odnoklassniki', 'fa-odnoklassniki-square' => 'Odnoklassniki square', 'fa-opencart' => 'OpenCart', 'fa-opera' => 'Opera', 'fa-optin-monster' => 'OptinMonster', 'fa-registered' => 'Registered', 'fa-safari' => 'Safari', 'fa-sticky-note' => 'Sticky note', 'fa-sticky-note-o' => 'Sticky note o', 'fa-television' => 'Television', 'fa-trademark' => 'Trademark', 'fa-tripadvisor' => 'TripAdvisor', 'fa-tv' => 'TV', 'fa-vimeo' => 'Vimeo', 'fa-wikipedia-w' => 'Wikipedia W', 'fa-y-combinator' => 'Y Combinator', 'fa-yc' => 'YC',
            // 4.3 and lower
            'fa-adjust'    => 'Adjust', 'fa-adn' => 'Adn', 'fa-align-center' => 'Align center', 'fa-align-justify' => 'Align justify', 'fa-align-left' => 'Align left', 'fa-align-right' => 'Align right', 'fa-ambulance' => 'Ambulance', 'fa-anchor' => 'Anchor', 'fa-android' => 'Android', 'fa-angellist' => 'Angellist', 'fa-angle-double-down' => 'Angle double down', 'fa-angle-double-left' => 'Angle double left', 'fa-angle-double-right' => 'Angle double right', 'fa-angle-double-up' => 'Angle double up', 'fa-angle-down' => 'Angle down', 'fa-angle-left' => 'Angle left', 'fa-angle-right' => 'Angle right', 'fa-angle-up' => 'Angle up', 'fa-apple' => 'Apple', 'fa-archive' => 'Archive', 'fa-area-chart' => 'Area chart', 'fa-arrow-circle-down' => 'Arrow circle down', 'fa-arrow-circle-left' => 'Arrow circle left', 'fa-arrow-circle-o-down' => 'Arrow circle o down', 'fa-arrow-circle-o-left' => 'Arrow circle o left', 'fa-arrow-circle-o-right' => 'Arrow circle o right', 'fa-arrow-circle-o-up' => 'Arrow circle o up', 'fa-arrow-circle-right' => 'Arrow circle right', 'fa-arrow-circle-up' => 'Arrow circle up', 'fa-arrow-down' => 'Arrow down', 'fa-arrow-left' => 'Arrow left', 'fa-arrow-right' => 'Arrow right', 'fa-arrow-up' => 'Arrow up', 'fa-arrows' => 'Arrows', 'fa-arrows-alt' => 'Arrows alt', 'fa-arrows-h' => 'Arrows h', 'fa-arrows-v' => 'Arrows v', 'fa-asterisk' => 'Asterisk', 'fa-at' => 'At', 'fa-backward' => 'Backward', 'fa-ban' => 'Ban', 'fa-bar-chart' => 'Bar chart', 'fa-barcode' => 'Barcode', 'fa-bars' => 'Bars', 'fa-bed' => 'Bed', 'fa-beer' => 'Beer', 'fa-behance' => 'Behance', 'fa-behance-square' => 'Behance square', 'fa-bell' => 'Bell', 'fa-bell-o' => 'Bell o', 'fa-bell-slash' => 'Bell slash', 'fa-bell-slash-o' => 'Bell slash o', 'fa-bicycle' => 'Bicycle', 'fa-binoculars' => 'Binoculars', 'fa-birthday-cake' => 'Birthday cake', 'fa-bitbucket' => 'Bitbucket', 'fa-bitbucket-square' => 'Bitbucket square', 'fa-bold' => 'Bold', 'fa-bolt' => 'Bolt', 'fa-bomb' => 'Bomb', 'fa-book' => 'Book', 'fa-bookmark' => 'Bookmark', 'fa-bookmark-o' => 'Bookmark o', 'fa-briefcase' => 'Briefcase', 'fa-btc' => 'Btc', 'fa-bug' => 'Bug', 'fa-building' => 'Building', 'fa-building-o' => 'Building o', 'fa-bullhorn' => 'Bullhorn', 'fa-bullseye' => 'Bullseye', 'fa-bus' => 'Bus', 'fa-buysellads' => 'Buysellads', 'fa-calculator' => 'Calculator', 'fa-calendar' => 'Calendar', 'fa-calendar-o' => 'Calendar o', 'fa-camera' => 'Camera', 'fa-camera-retro' => 'Camera retro', 'fa-car' => 'Car', 'fa-caret-down' => 'Caret down', 'fa-caret-left' => 'Caret left', 'fa-caret-right' => 'Caret right', 'fa-caret-square-o-down' => 'Caret square o down', 'fa-caret-square-o-left' => 'Caret square o left', 'fa-caret-square-o-right' => 'Caret square o right', 'fa-caret-square-o-up' => 'Caret square o up', 'fa-caret-up' => 'Caret up', 'fa-cart-arrow-down' => 'Cart arrow down', 'fa-cart-plus' => 'Cart plus', 'fa-cc' => 'Cc', 'fa-cc-amex' => 'Cc amex', 'fa-cc-discover' => 'Cc discover', 'fa-cc-mastercard' => 'Cc mastercard', 'fa-cc-paypal' => 'Cc paypal', 'fa-cc-stripe' => 'Cc stripe', 'fa-cc-visa' => 'Cc visa', 'fa-certificate' => 'Certificate', 'fa-chain-broken' => 'Chain broken', 'fa-check' => 'Check', 'fa-check-circle' => 'Check circle', 'fa-check-circle-o' => 'Check circle o', 'fa-check-square' => 'Check square', 'fa-check-square-o' => 'Check square o', 'fa-chevron-circle-down' => 'Chevron circle down', 'fa-chevron-circle-left' => 'Chevron circle left', 'fa-chevron-circle-right' => 'Chevron circle right', 'fa-chevron-circle-up' => 'Chevron circle up', 'fa-chevron-down' => 'Chevron down', 'fa-chevron-left' => 'Chevron left', 'fa-chevron-right' => 'Chevron right', 'fa-chevron-up' => 'Chevron up', 'fa-child' => 'Child', 'fa-circle' => 'Circle', 'fa-circle-o' => 'Circle o', 'fa-circle-o-notch' => 'Circle o notch', 'fa-circle-thin' => 'Circle thin', 'fa-clipboard' => 'Clipboard', 'fa-clock-o' => 'Clock o', 'fa-cloud' => 'Cloud', 'fa-cloud-download' => 'Cloud download', 'fa-cloud-upload' => 'Cloud upload', 'fa-code' => 'Code', 'fa-code-fork' => 'Code fork', 'fa-codepen' => 'Codepen', 'fa-coffee' => 'Coffee', 'fa-cog' => 'Cog', 'fa-cogs' => 'Cogs', 'fa-columns' => 'Columns', 'fa-comment' => 'Comment', 'fa-comment-o' => 'Comment o', 'fa-comments' => 'Comments', 'fa-comments-o' => 'Comments o', 'fa-compass' => 'Compass', 'fa-compress' => 'Compress', 'fa-connectdevelop' => 'Connectdevelop', 'fa-copyright' => 'Copyright', 'fa-credit-card' => 'Credit card', 'fa-crop' => 'Crop', 'fa-crosshairs' => 'Crosshairs', 'fa-css3' => 'Css3', 'fa-cube' => 'Cube', 'fa-cubes' => 'Cubes', 'fa-cutlery' => 'Cutlery', 'fa-dashcube' => 'Dashcube', 'fa-database' => 'Database', 'fa-delicious' => 'Delicious', 'fa-desktop' => 'Desktop', 'fa-deviantart' => 'Deviantart', 'fa-diamond' => 'Diamond', 'fa-digg' => 'Digg', 'fa-dot-circle-o' => 'Dot circle o', 'fa-download' => 'Download', 'fa-dribbble' => 'Dribbble', 'fa-dropbox' => 'Dropbox', 'fa-drupal' => 'Drupal', 'fa-eject' => 'Eject', 'fa-ellipsis-h' => 'Ellipsis h', 'fa-ellipsis-v' => 'Ellipsis v', 'fa-empire' => 'Empire', 'fa-envelope' => 'Envelope', 'fa-envelope-o' => 'Envelope o', 'fa-envelope-square' => 'Envelope square', 'fa-eraser' => 'Eraser', 'fa-eur' => 'Eur', 'fa-exchange' => 'Exchange', 'fa-exclamation' => 'Exclamation', 'fa-exclamation-circle' => 'Exclamation circle', 'fa-exclamation-triangle' => 'Exclamation triangle', 'fa-expand' => 'Expand', 'fa-external-link' => 'External link', 'fa-external-link-square' => 'External link square', 'fa-eye' => 'Eye', 'fa-eye-slash' => 'Eye slash', 'fa-eyedropper' => 'Eyedropper', 'fa-facebook' => 'Facebook', 'fa-facebook-official' => 'Facebook official', 'fa-facebook-square' => 'Facebook square', 'fa-fast-backward' => 'Fast backward', 'fa-fast-forward' => 'Fast forward', 'fa-fax' => 'Fax', 'fa-female' => 'Female', 'fa-fighter-jet' => 'Fighter jet', 'fa-file' => 'File', 'fa-file-archive-o' => 'File archive o', 'fa-file-audio-o' => 'File audio o', 'fa-file-code-o' => 'File code o', 'fa-file-excel-o' => 'File excel o', 'fa-file-image-o' => 'File image o', 'fa-file-o' => 'File o', 'fa-file-pdf-o' => 'File pdf o', 'fa-file-powerpoint-o' => 'File powerpoint o', 'fa-file-text' => 'File text', 'fa-file-text-o' => 'File text o', 'fa-file-video-o' => 'File video o', 'fa-file-word-o' => 'File word o', 'fa-files-o' => 'Files o', 'fa-film' => 'Film', 'fa-filter' => 'Filter', 'fa-fire' => 'Fire', 'fa-fire-extinguisher' => 'Fire extinguisher', 'fa-flag' => 'Flag', 'fa-flag-checkered' => 'Flag checkered', 'fa-flag-o' => 'Flag o', 'fa-flask' => 'Flask', 'fa-flickr' => 'Flickr', 'fa-floppy-o' => 'Floppy o', 'fa-folder' => 'Folder', 'fa-folder-o' => 'Folder o', 'fa-folder-open' => 'Folder open', 'fa-folder-open-o' => 'Folder open o', 'fa-font' => 'Font', 'fa-forumbee' => 'Forumbee', 'fa-forward' => 'Forward', 'fa-foursquare' => 'Foursquare', 'fa-frown-o' => 'Frown o', 'fa-futbol-o' => 'Futbol o', 'fa-gamepad' => 'Gamepad', 'fa-gavel' => 'Gavel', 'fa-gbp' => 'Gbp', 'fa-gift' => 'Gift', 'fa-git' => 'Git', 'fa-git-square' => 'Git square', 'fa-github' => 'Github', 'fa-github-alt' => 'Github alt', 'fa-github-square' => 'Github square', 'fa-glass' => 'Glass', 'fa-globe' => 'Globe', 'fa-google' => 'Google', 'fa-google-plus' => 'Google plus', 'fa-google-plus-square' => 'Google plus square', 'fa-google-wallet' => 'Google wallet', 'fa-graduation-cap' => 'Graduation cap', 'fa-gratipay' => 'Gratipay', 'fa-h-square' => 'H square', 'fa-hacker-news' => 'Hacker news', 'fa-hand-o-down' => 'Hand o down', 'fa-hand-o-left' => 'Hand o left', 'fa-hand-o-right' => 'Hand o right', 'fa-hand-o-up' => 'Hand o up', 'fa-hdd-o' => 'Hdd o', 'fa-header' => 'Header', 'fa-headphones' => 'Headphones', 'fa-heart' => 'Heart', 'fa-heart-o' => 'Heart o', 'fa-heartbeat' => 'Heartbeat', 'fa-history' => 'History', 'fa-home' => 'Home', 'fa-hospital-o' => 'Hospital o', 'fa-hotel' => 'Hotel', 'fa-html5' => 'Html5', 'fa-ils' => 'Ils', 'fa-inbox' => 'Inbox', 'fa-indent' => 'Indent', 'fa-info' => 'Info', 'fa-info-circle' => 'Info circle', 'fa-inr' => 'Inr', 'fa-instagram' => 'Instagram', 'fa-ioxhost' => 'Ioxhost', 'fa-italic' => 'Italic', 'fa-joomla' => 'Joomla', 'fa-jpy' => 'Jpy', 'fa-jsfiddle' => 'Jsfiddle', 'fa-key' => 'Key', 'fa-keyboard-o' => 'Keyboard o', 'fa-krw' => 'Krw', 'fa-language' => 'Language', 'fa-laptop' => 'Laptop', 'fa-lastfm' => 'Lastfm', 'fa-lastfm-square' => 'Lastfm square', 'fa-leaf' => 'Leaf', 'fa-leanpub' => 'Leanpub', 'fa-lemon-o' => 'Lemon o', 'fa-level-down' => 'Level down', 'fa-level-up' => 'Level up', 'fa-life-ring' => 'Life ring', 'fa-lightbulb-o' => 'Lightbulb o', 'fa-line-chart' => 'Line chart', 'fa-link' => 'Link', 'fa-linkedin' => 'Linkedin', 'fa-linkedin-square' => 'Linkedin square', 'fa-linux' => 'Linux', 'fa-list' => 'List', 'fa-list-alt' => 'List alt', 'fa-list-ol' => 'List ol', 'fa-list-ul' => 'List ul', 'fa-location-arrow' => 'Location arrow', 'fa-lock' => 'Lock', 'fa-long-arrow-down' => 'Long arrow down', 'fa-long-arrow-left' => 'Long arrow left', 'fa-long-arrow-right' => 'Long arrow right', 'fa-long-arrow-up' => 'Long arrow up', 'fa-magic' => 'Magic', 'fa-magnet' => 'Magnet', 'fa-male' => 'Male', 'fa-map-marker' => 'Map marker', 'fa-mars' => 'Mars', 'fa-mars-double' => 'Mars double', 'fa-mars-stroke' => 'Mars stroke', 'fa-mars-stroke-h' => 'Mars stroke h', 'fa-mars-stroke-v' => 'Mars stroke v', 'fa-maxcdn' => 'Maxcdn', 'fa-meanpath' => 'Meanpath', 'fa-medium' => 'Medium', 'fa-medkit' => 'Medkit', 'fa-meh-o' => 'Meh o', 'fa-mercury' => 'Mercury', 'fa-microphone' => 'Microphone', 'fa-microphone-slash' => 'Microphone slash', 'fa-minus' => 'Minus', 'fa-minus-circle' => 'Minus circle', 'fa-minus-square' => 'Minus square', 'fa-minus-square-o' => 'Minus square o', 'fa-mobile' => 'Mobile', 'fa-money' => 'Money', 'fa-moon-o' => 'Moon o', 'fa-motorcycle' => 'Motorcycle', 'fa-music' => 'Music', 'fa-neuter' => 'Neuter', 'fa-newspaper-o' => 'Newspaper o', 'fa-openid' => 'Openid', 'fa-outdent' => 'Outdent', 'fa-pagelines' => 'Pagelines', 'fa-paint-brush' => 'Paint brush', 'fa-paper-plane' => 'Paper plane', 'fa-paper-plane-o' => 'Paper plane o', 'fa-paperclip' => 'Paperclip', 'fa-paragraph' => 'Paragraph', 'fa-pause' => 'Pause', 'fa-paw' => 'Paw', 'fa-paypal' => 'Paypal', 'fa-pencil' => 'Pencil', 'fa-pencil-square' => 'Pencil square', 'fa-pencil-square-o' => 'Pencil square o', 'fa-phone' => 'Phone', 'fa-phone-square' => 'Phone square', 'fa-picture-o' => 'Picture o', 'fa-pie-chart' => 'Pie chart', 'fa-pied-piper' => 'Pied piper', 'fa-pied-piper-alt' => 'Pied piper alt', 'fa-pinterest' => 'Pinterest', 'fa-pinterest-p' => 'Pinterest p', 'fa-pinterest-square' => 'Pinterest square', 'fa-plane' => 'Plane', 'fa-play' => 'Play', 'fa-play-circle' => 'Play circle', 'fa-play-circle-o' => 'Play circle o', 'fa-plug' => 'Plug', 'fa-plus' => 'Plus', 'fa-plus-circle' => 'Plus circle', 'fa-plus-square' => 'Plus square', 'fa-plus-square-o' => 'Plus square o', 'fa-power-off' => 'Power off', 'fa-print' => 'Print', 'fa-puzzle-piece' => 'Puzzle piece', 'fa-qq' => 'Qq', 'fa-qrcode' => 'Qrcode', 'fa-question' => 'Question', 'fa-question-circle' => 'Question circle', 'fa-quote-left' => 'Quote left', 'fa-quote-right' => 'Quote right', 'fa-random' => 'Random', 'fa-rebel' => 'Rebel', 'fa-recycle' => 'Recycle', 'fa-reddit' => 'Reddit', 'fa-reddit-square' => 'Reddit square', 'fa-refresh' => 'Refresh', 'fa-renren' => 'Renren', 'fa-repeat' => 'Repeat', 'fa-reply' => 'Reply', 'fa-reply-all' => 'Reply all', 'fa-retweet' => 'Retweet', 'fa-road' => 'Road', 'fa-rocket' => 'Rocket', 'fa-rss' => 'Rss', 'fa-rss-square' => 'Rss square', 'fa-rub' => 'Rub', 'fa-scissors' => 'Scissors', 'fa-search' => 'Search', 'fa-search-minus' => 'Search minus', 'fa-search-plus' => 'Search plus', 'fa-sellsy' => 'Sellsy', 'fa-server' => 'Server', 'fa-share' => 'Share', 'fa-share-alt' => 'Share alt', 'fa-share-alt-square' => 'Share alt square', 'fa-share-square' => 'Share square', 'fa-share-square-o' => 'Share square o', 'fa-shield' => 'Shield', 'fa-ship' => 'Ship', 'fa-shirtsinbulk' => 'Shirtsinbulk', 'fa-shopping-cart' => 'Shopping cart', 'fa-sign-in' => 'Sign in', 'fa-sign-out' => 'Sign out', 'fa-signal' => 'Signal', 'fa-simplybuilt' => 'Simplybuilt', 'fa-sitemap' => 'Sitemap', 'fa-skyatlas' => 'Skyatlas', 'fa-skype' => 'Skype', 'fa-slack' => 'Slack', 'fa-sliders' => 'Sliders', 'fa-slideshare' => 'Slideshare', 'fa-smile-o' => 'Smile o', 'fa-sort' => 'Sort', 'fa-sort-alpha-asc' => 'Sort alpha asc', 'fa-sort-alpha-desc' => 'Sort alpha desc', 'fa-sort-amount-asc' => 'Sort amount asc', 'fa-sort-amount-desc' => 'Sort amount desc', 'fa-sort-asc' => 'Sort asc', 'fa-sort-desc' => 'Sort desc', 'fa-sort-numeric-asc' => 'Sort numeric asc', 'fa-sort-numeric-desc' => 'Sort numeric desc', 'fa-soundcloud' => 'Soundcloud', 'fa-space-shuttle' => 'Space shuttle', 'fa-spinner' => 'Spinner', 'fa-spoon' => 'Spoon', 'fa-spotify' => 'Spotify', 'fa-square' => 'Square', 'fa-square-o' => 'Square o', 'fa-stack-exchange' => 'Stack exchange', 'fa-stack-overflow' => 'Stack overflow', 'fa-star' => 'Star', 'fa-star-half' => 'Star half', 'fa-star-half-o' => 'Star half o', 'fa-star-o' => 'Star o', 'fa-steam' => 'Steam', 'fa-steam-square' => 'Steam square', 'fa-step-backward' => 'Step backward', 'fa-step-forward' => 'Step forward', 'fa-stethoscope' => 'Stethoscope', 'fa-stop' => 'Stop', 'fa-street-view' => 'Street view', 'fa-strikethrough' => 'Strikethrough', 'fa-stumbleupon' => 'Stumbleupon', 'fa-stumbleupon-circle' => 'Stumbleupon circle', 'fa-subscript' => 'Subscript', 'fa-subway' => 'Subway', 'fa-suitcase' => 'Suitcase', 'fa-sun-o' => 'Sun o', 'fa-superscript' => 'Superscript', 'fa-table' => 'Table', 'fa-tablet' => 'Tablet', 'fa-tachometer' => 'Tachometer', 'fa-tag' => 'Tag', 'fa-tags' => 'Tags', 'fa-tasks' => 'Tasks', 'fa-taxi' => 'Taxi', 'fa-tencent-weibo' => 'Tencent weibo', 'fa-terminal' => 'Terminal', 'fa-text-height' => 'Text height', 'fa-text-width' => 'Text width', 'fa-th' => 'Th', 'fa-th-large' => 'Th large', 'fa-th-list' => 'Th list', 'fa-thumb-tack' => 'Thumb tack', 'fa-thumbs-down' => 'Thumbs down', 'fa-thumbs-o-down' => 'Thumbs o down', 'fa-thumbs-o-up' => 'Thumbs o up', 'fa-thumbs-up' => 'Thumbs up', 'fa-ticket' => 'Ticket', 'fa-times' => 'Times', 'fa-times-circle' => 'Times circle', 'fa-times-circle-o' => 'Times circle o', 'fa-tint' => 'Tint', 'fa-toggle-off' => 'Toggle off', 'fa-toggle-on' => 'Toggle on', 'fa-train' => 'Train', 'fa-transgender' => 'Transgender', 'fa-transgender-alt' => 'Transgender alt', 'fa-trash' => 'Trash', 'fa-trash-o' => 'Trash o', 'fa-tree' => 'Tree', 'fa-trello' => 'Trello', 'fa-trophy' => 'Trophy', 'fa-truck' => 'Truck', 'fa-try' => 'Try', 'fa-tty' => 'Tty', 'fa-tumblr' => 'Tumblr', 'fa-tumblr-square' => 'Tumblr square', 'fa-twitch' => 'Twitch', 'fa-twitter' => 'Twitter', 'fa-twitter-square' => 'Twitter square', 'fa-umbrella' => 'Umbrella', 'fa-underline' => 'Underline', 'fa-undo' => 'Undo', 'fa-university' => 'University', 'fa-unlock' => 'Unlock', 'fa-unlock-alt' => 'Unlock alt', 'fa-upload' => 'Upload', 'fa-usd' => 'Usd', 'fa-user' => 'User', 'fa-user-md' => 'User md', 'fa-user-plus' => 'User plus', 'fa-user-secret' => 'User secret', 'fa-user-times' => 'User times', 'fa-users' => 'Users', 'fa-venus' => 'Venus', 'fa-venus-double' => 'Venus double', 'fa-venus-mars' => 'Venus mars', 'fa-viacoin' => 'Viacoin', 'fa-video-camera' => 'Video camera', 'fa-vimeo-square' => 'Vimeo square', 'fa-vine' => 'Vine', 'fa-vk' => 'Vk', 'fa-volume-down' => 'Volume down', 'fa-volume-off' => 'Volume off', 'fa-volume-up' => 'Volume up', 'fa-weibo' => 'Weibo', 'fa-weixin' => 'Weixin', 'fa-whatsapp' => 'Whatsapp', 'fa-wheelchair' => 'Wheelchair', 'fa-wifi' => 'Wifi', 'fa-windows' => 'Windows', 'fa-wordpress' => 'Wordpress', 'fa-wrench' => 'Wrench', 'fa-xing' => 'Xing', 'fa-xing-square' => 'Xing square', 'fa-yahoo' => 'Yahoo', 'fa-yelp' => 'Yelp', 'fa-youtube' => 'Youtube', 'fa-youtube-play' => 'Youtube play', 'fa-youtube-square' => 'Youtube square',
        ];
        if (version_compare($version, '4.6', '<')) {
            $unsets = ['fa-address-book', 'fa-address-book-o', 'fa-address-card', 'fa-address-card-o', 'fa-bandcamp', 'fa-bath', 'fa-bathtub', 'fa-drivers-license', 'fa-drivers-license-o', 'fa-eercast', 'fa-envelope-open', 'fa-envelope-open-o', 'fa-etsy', 'fa-free-code-camp', 'fa-grav', 'fa-handshake-o', 'fa-id-badge', 'fa-id-card', 'fa-id-card-o', 'fa-imdb', 'fa-linode', 'fa-meetup', 'fa-microchip', 'fa-podcast', 'fa-quora', 'fa-ravelry', 'fa-s15', 'fa-shower', 'fa-snowflake-o', 'fa-superpower', 'fa-telegram', 'fa-thermometer', 'fa-thermometer-0', 'fa-thermometer-1', 'fa-thermometer-2', 'fa-thermometer-3', 'fa-thermometer-4', 'fa-thermometer-empty', 'fa-thermometer-full', 'fa-thermometer-half', 'fa-thermometer-quarter', 'fa-thermometer-three-quarters', 'fa-times-rectangle', 'fa-times-rectangle-o', 'fa-user-circle', 'fa-user-circle-o', 'fa-user-o', 'fa-vcard', 'fa-vcard-o', 'window-close', 'fa-window-close-o', 'fa-window-maximize', 'fa-window-minimize', 'fa-window-restore', 'fa-wpexplorer'];
            foreach ($unsets as $unset) {
                if (isset($icons[$unset])) {
                    unset($icons[$unset]);
                }
            }
            if (version_compare($version, '4.6', '<')) {
                $unsets = ['fa-american-sign-language-interpreting', 'fa-asl-interpreting', 'fa-assistive-listening-systems', 'fa-audio-description', 'fa-blind', 'fa-braille', 'fa-deaf', 'fa-deafness', 'fa-envira', 'fa-fa', 'fa-first-order', 'fa-font-awesome', 'fa-gitlab', 'fa-glide', 'fa-glide-g', 'fa-google-plus-circle', 'fa-google-plus-official', 'fa-hard-of-hearing', 'fa-low-vision', 'fa-pied-piper', 'fa-question-circle-o', 'fa-sign-language', 'fa-signing', 'fa-snapchat', 'fa-snapchat-ghost', 'fa-snapchat-square', 'fa-themeisle', 'fa-universal-access', 'fa-viadeo', 'fa-viadeo-square', 'fa-volume-control-phone', 'fa-wheelchair-alt', 'fa-wpbeginner', 'fa-wpforms', 'fa-yoast'];
                foreach ($unsets as $unset) {
                    if (isset($icons[$unset])) {
                        unset($icons[$unset]);
                    }
                }
                if (version_compare($version, '4.5', '<')) {
                    $unsets = ['fa-bluetooth', 'fa-bluetooth-b', 'fa-codiepie', 'fa-credit-card-alt', 'fa-edge', 'fa-fort-awesome', 'fa-hashtag', 'fa-mixcloud', 'fa-modx', 'fa-pause-circle', 'fa-pause-circle-o', 'fa-percent', 'fa-product-hunt', 'fa-reddit-alien', 'fa-scribd', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-usb' => 'USB'];
                    foreach ($unsets as $unset) {
                        if (isset($icons[$unset])) {
                            unset($icons[$unset]);
                        }
                    }
                    if (version_compare($version, '4.4', '<')) {
                        $unsets = ['fa-500px', 'fa-amazon', 'fa-balance-scale', 'fa-battery-0', 'fa-battery-1', 'fa-battery-2', 'fa-battery-3', 'fa-battery-4', 'fa-battery-empty', 'fa-battery-full', 'fa-battery-half', 'fa-battery-quarter', 'fa-battery-three-quarters', 'fa-black-tie', 'fa-calendar-check-o', 'fa-calendar-minus-o', 'fa-calendar-plus-o', 'fa-calendar-times-o', 'fa-cc-diners-club', 'fa-cc-jcb', 'fa-chrome', 'fa-clone', 'fa-commenting', 'fa-commenting-o', 'fa-contao', 'fa-creative-commons', 'fa-expeditedssl', 'fa-firefox', 'fa-fonticons', 'fa-genderless', 'fa-get-pocket', 'fa-gg', 'fa-gg-circle', 'fa-hand-grab-o', 'fa-hand-lizard-o', 'fa-hand-paper-o', 'fa-hand-peace-o', 'fa-hand-pointer-o', 'fa-hand-rock-o', 'fa-hand-scissors-o', 'fa-hand-spock-o', 'fa-hand-stop-o', 'fa-hourglass', 'fa-hourglass-1', 'fa-hourglass-2', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass-half', 'fa-hourglass-o', 'fa-hourglass-start', 'fa-houzz', 'fa-i-cursor', 'fa-industry', 'fa-internet-explorer', 'fa-map', 'fa-map-o', 'fa-map-pin', 'fa-map-signs', 'fa-mouse-pointer', 'fa-object-group', 'fa-object-ungroup', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-opencart', 'fa-opera', 'fa-optin-monster', 'fa-registered', 'fa-safari', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-television', 'fa-trademark', 'fa-tripadvisor', 'fa-tv', 'fa-vimeo', 'fa-wikipedia-w', 'fa-y-combinator', 'fa-yc'];
                        foreach ($unsets as $unset) {
                            if (isset($icons[$unset])) {
                                unset($icons[$unset]);
                            }
                        }
                        if (version_compare($version, '4.3', '<')) {
                            $unsets = ['fa-bed', 'fa-buysellads', 'fa-cart-arrow-down', 'fa-cart-plus', 'fa-connectdevelop', 'fa-dashcube', 'fa-diamond', 'fa-facebook-official', 'fa-forumbee', 'fa-heartbeat', 'fa-hotel', 'fa-leanpub', 'fa-mars', 'fa-mars-double', 'fa-mars-stroke', 'fa-mars-stroke-h', 'fa-mars-stroke-v', 'fa-medium', 'fa-mercury', 'fa-motorcycle', 'fa-neuter', 'fa-pinterest-p', 'fa-sellsy', 'fa-server', 'fa-ship', 'fa-shirtsinbulk', 'fa-simplybuilt', 'fa-skyatlas', 'fa-street-view', 'fa-subway', 'fa-train', 'fa-transgender', 'fa-transgender-alt', 'fa-user-plus', 'fa-user-secret', 'fa-user-times', 'fa-venus', 'fa-venus-double', 'fa-venus-mars', 'fa-viacoin', 'fa-whatsapp'];
                            foreach ($unsets as $unset) {
                                if (isset($icons[$unset])) {
                                    unset($icons[$unset]);
                                }
                            }
                        }
                    }
                }
            }
        }
        asort($icons);
        return $icons;
    }
}