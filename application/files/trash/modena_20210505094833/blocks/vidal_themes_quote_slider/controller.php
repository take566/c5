<?php namespace Concrete\Package\Modena\Block\VidalThemesQuoteSlider;

defined("C5_EXECUTE") or die("Access Denied.");

use \Concrete\Core\Asset\AssetList;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use \Concrete\Core\File\File;
use \Concrete\Core\Page\Page;
use Core;

class Controller extends BlockController
{
    public    $btFieldsRequired = ['testimonialSlider' => []];
    protected $btExportFileColumns = ['testimonialImage'];
    protected $btExportTables = ['btVidalThemesQuoteSlider', 'btVidalThemesQuoteSliderTestimonialSliderEntries'];
    protected $btTable = 'btVidalThemesQuoteSlider';
    protected $btInterfaceWidth = 700;
    protected $btInterfaceHeight = 525;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = false;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btDefaultSet = 'modena';
    protected $pkg = false;
    
    public function getBlockTypeDescription()
    {
        return t("A slider for showing your business or personal testimonials.");
    }

    public function getBlockTypeName()
    {
        return t("Testimonial Slider");
    }

    public function getSearchableContent()
    {
        $content = [];
        $content[] = $this->slideDuration;
        $db = $this->app->make('database')->connection();
        $testimonialSlider_items = $db->fetchAll('SELECT * FROM btVidalThemesQuoteSliderTestimonialSliderEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($testimonialSlider_items as $testimonialSlider_item_k => $testimonialSlider_item_v) {
            if (isset($testimonialSlider_item_v["testimonailName"]) && trim($testimonialSlider_item_v["testimonailName"]) != "") {
                $content[] = $testimonialSlider_item_v["testimonailName"];
            }
            if (isset($testimonialSlider_item_v["testimonialPosition"]) && trim($testimonialSlider_item_v["testimonialPosition"]) != "") {
                $content[] = $testimonialSlider_item_v["testimonialPosition"];
            }
            if (isset($testimonialSlider_item_v["testimonialCompany"]) && trim($testimonialSlider_item_v["testimonialCompany"]) != "") {
                $content[] = $testimonialSlider_item_v["testimonialCompany"];
            }
            if (isset($testimonialSlider_item_v["testimonialQuote"]) && trim($testimonialSlider_item_v["testimonialQuote"]) != "") {
                $content[] = $testimonialSlider_item_v["testimonialQuote"];
            }
        }
        return implode(" ", $content);
    }

    public function view()
    {
        $db = $this->app->make('database')->connection();
        $testimonialSlider = [];
        $testimonialSlider_items = $db->fetchAll('SELECT * FROM btVidalThemesQuoteSliderTestimonialSliderEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($testimonialSlider_items as $testimonialSlider_item_k => &$testimonialSlider_item_v) {
            $testimonialSlider_item_v["testimonialQuote"] = isset($testimonialSlider_item_v["testimonialQuote"]) ? LinkAbstractor::translateFrom($testimonialSlider_item_v["testimonialQuote"]) : null;
            if (isset($testimonialSlider_item_v['testimonialImage']) && trim($testimonialSlider_item_v['testimonialImage']) != "" && ($f = File::getByID($testimonialSlider_item_v['testimonialImage'])) && is_object($f)) {
                $testimonialSlider_item_v['testimonialImage'] = $f;
            } else {
                $testimonialSlider_item_v['testimonialImage'] = false;
            }
        }
        $this->set('testimonialSlider_items', $testimonialSlider_items);
        $this->set('testimonialSlider', $testimonialSlider);
        if (trim($this->slideDuration) == "") {
            $this->set("slideDuration", '8');
        }
    }

    public function delete()
    {
        $db = $this->app->make('database')->connection();
        $db->delete('btVidalThemesQuoteSliderTestimonialSliderEntries', ['bID' => $this->bID]);
        parent::delete();
    }

    public function duplicate($newBID)
    {
        $db = $this->app->make('database')->connection();
        $testimonialSlider_items = $db->fetchAll('SELECT * FROM btVidalThemesQuoteSliderTestimonialSliderEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        foreach ($testimonialSlider_items as $testimonialSlider_item) {
            unset($testimonialSlider_item['id']);
            $testimonialSlider_item['bID'] = $newBID;
            $db->insert('btVidalThemesQuoteSliderTestimonialSliderEntries', $testimonialSlider_item);
        }
        parent::duplicate($newBID);
    }

    public function add()
    {
        $this->addEdit();
        $testimonialSlider = $this->get('testimonialSlider');
        $this->set('testimonialSlider_items', []);
        $this->set('testimonialSlider', $testimonialSlider);
    }

    public function edit()
    {
        $db = $this->app->make('database')->connection();
        $this->addEdit();
        $testimonialSlider = $this->get('testimonialSlider');
        $testimonialSlider_items = $db->fetchAll('SELECT * FROM btVidalThemesQuoteSliderTestimonialSliderEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        
        foreach ($testimonialSlider_items as &$testimonialSlider_item) {
            $testimonialSlider_item['testimonialQuote'] = isset($testimonialSlider_item['testimonialQuote']) ? LinkAbstractor::translateFromEditMode($testimonialSlider_item['testimonialQuote']) : null;
        }
        foreach ($testimonialSlider_items as &$testimonialSlider_item) {
            if (!File::getByID($testimonialSlider_item['testimonialImage'])) {
                unset($testimonialSlider_item['testimonialImage']);
            }
        }
        $this->set('testimonialSlider', $testimonialSlider);
        $this->set('testimonialSlider_items', $testimonialSlider_items);
    }

    protected function addEdit()
    {
        $this->set('app', $this->app);
        $testimonialSlider = [];
        $this->set('testimonialSlider', $testimonialSlider);
        $this->set('identifier', new \Concrete\Core\Utility\Service\Identifier());
        $al = AssetList::getInstance();
        $al->register('css', 'repeatable-ft.form', 'blocks/vidal_themes_quote_slider/css_form/repeatable-ft.form.css', array(), 'modena');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('css', 'repeatable-ft.form');
        $this->requireAsset('javascript', 'handlebars');
        $this->requireAsset('javascript', 'handlebars-helpers');
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', $this->app->make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
        $db = $this->app->make('database')->connection();
        $rows = $db->fetchAll('SELECT * FROM btVidalThemesQuoteSliderTestimonialSliderEntries WHERE bID = ? ORDER BY sortOrder', [$this->bID]);
        $testimonialSlider_items = isset($args['testimonialSlider']) && is_array($args['testimonialSlider']) ? $args['testimonialSlider'] : [];
        $queries = [];
        if (!empty($testimonialSlider_items)) {
            $i = 0;
            foreach ($testimonialSlider_items as $testimonialSlider_item) {
                $data = [
                    'sortOrder' => $i + 1,
                ];
                if (isset($testimonialSlider_item['testimonailName']) && trim($testimonialSlider_item['testimonailName']) != '') {
                    $data['testimonailName'] = trim($testimonialSlider_item['testimonailName']);
                } else {
                    $data['testimonailName'] = null;
                }
                if (isset($testimonialSlider_item['testimonialPosition']) && trim($testimonialSlider_item['testimonialPosition']) != '') {
                    $data['testimonialPosition'] = trim($testimonialSlider_item['testimonialPosition']);
                } else {
                    $data['testimonialPosition'] = null;
                }
                if (isset($testimonialSlider_item['testimonialCompany']) && trim($testimonialSlider_item['testimonialCompany']) != '') {
                    $data['testimonialCompany'] = trim($testimonialSlider_item['testimonialCompany']);
                } else {
                    $data['testimonialCompany'] = null;
                }
                if (isset($testimonialSlider_item['testimonailUrl']) && trim($testimonialSlider_item['testimonailUrl']) != '') {
                    $data['testimonailUrl'] = trim($testimonialSlider_item['testimonailUrl']);
                } else {
                    $data['testimonailUrl'] = null;
                }
                if (isset($testimonialSlider_item['testimonailUrl_text']) && trim($testimonialSlider_item['testimonailUrl_text']) != '') {
                    $data['testimonailUrl_text'] = trim($testimonialSlider_item['testimonailUrl_text']);
                } else {
                    $data['testimonailUrl_text'] = null;
                }
                $data['testimonialQuote'] = isset($testimonialSlider_item['testimonialQuote']) ? LinkAbstractor::translateTo($testimonialSlider_item['testimonialQuote']) : null;
                if (isset($testimonialSlider_item['testimonialImage']) && trim($testimonialSlider_item['testimonialImage']) != '') {
                    $data['testimonialImage'] = trim($testimonialSlider_item['testimonialImage']);
                } else {
                    $data['testimonialImage'] = null;
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
                                $db->update('btVidalThemesQuoteSliderTestimonialSliderEntries', $data, ['id' => $id]);
                            }
                            break;
                        case 'insert':
                            foreach ($values as $data) {
                                $db->insert('btVidalThemesQuoteSliderTestimonialSliderEntries', $data);
                            }
                            break;
                        case 'delete':
                            foreach ($values as $value) {
                                $db->delete('btVidalThemesQuoteSliderTestimonialSliderEntries', ['id' => $value]);
                            }
                            break;
                    }
                }
            }
        }
        parent::save($args);
    }

    public function validate($args)
    {
        $e = $this->app->make("helper/validation/error");
        $testimonialSliderEntriesMin = 0;
        $testimonialSliderEntriesMax = 0;
        $testimonialSliderEntriesErrors = 0;
        $testimonialSlider = [];
        if (isset($args['testimonialSlider']) && is_array($args['testimonialSlider']) && !empty($args['testimonialSlider'])) {
            if ($testimonialSliderEntriesMin >= 1 && count($args['testimonialSlider']) < $testimonialSliderEntriesMin) {
                $e->add(t("The %s field requires at least %s entries, %s entered.", t("Testimonial"), $testimonialSliderEntriesMin, count($args['testimonialSlider'])));
                $testimonialSliderEntriesErrors++;
            }
            if ($testimonialSliderEntriesMax >= 1 && count($args['testimonialSlider']) > $testimonialSliderEntriesMax) {
                $e->add(t("The %s field is set to a maximum of %s entries, %s entered.", t("Testimonial"), $testimonialSliderEntriesMax, count($args['testimonialSlider'])));
                $testimonialSliderEntriesErrors++;
            }
            if ($testimonialSliderEntriesErrors == 0) {
                foreach ($args['testimonialSlider'] as $testimonialSlider_k => $testimonialSlider_v) {
                    if (is_array($testimonialSlider_v)) {
                        if (in_array("testimonailName", $this->btFieldsRequired['testimonialSlider']) && (!isset($testimonialSlider_v['testimonailName']) || trim($testimonialSlider_v['testimonailName']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Name"), t("Testimonial"), $testimonialSlider_k));
                        }
                        if (in_array("testimonialPosition", $this->btFieldsRequired['testimonialSlider']) && (!isset($testimonialSlider_v['testimonialPosition']) || trim($testimonialSlider_v['testimonialPosition']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Position"), t("Testimonial"), $testimonialSlider_k));
                        }
                        if (in_array("testimonialCompany", $this->btFieldsRequired['testimonialSlider']) && (!isset($testimonialSlider_v['testimonialCompany']) || trim($testimonialSlider_v['testimonialCompany']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Company"), t("Testimonial"), $testimonialSlider_k));
                        }
                        if (((!in_array("testimonailUrl", $this->btFieldsRequired['testimonialSlider']) && isset($testimonialSlider_v['testimonailUrl']) && trim($testimonialSlider_v['testimonailUrl']) != "") || (in_array("testimonailUrl", $this->btFieldsRequired['testimonialSlider']))) && (!filter_var($testimonialSlider_v['testimonailUrl'], FILTER_VALIDATE_URL))) {
                            $e->add(t("The %s field does not have a valid URL (%s, row #%s).", t("Company URL"), t("Testimonial"), $testimonialSlider_k));
                        }
                        if (in_array("testimonialQuote", $this->btFieldsRequired['testimonialSlider']) && (!isset($testimonialSlider_v['testimonialQuote']) || trim($testimonialSlider_v['testimonialQuote']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Bio/Quote"), t("Testimonial"), $testimonialSlider_k));
                        }
                        if (in_array("testimonialImage", $this->btFieldsRequired['testimonialSlider']) && (!isset($testimonialSlider_v['testimonialImage']) || trim($testimonialSlider_v['testimonialImage']) == "" || !is_object(File::getByID($testimonialSlider_v['testimonialImage'])))) {
                            $e->add(t("The %s field is required (%s, row #%s).", t("Testimonial Image"), t("Testimonial"), $testimonialSlider_k));
                        }
                    } else {
                        $e->add(t("The values for the %s field, row #%s, are incomplete.", t('Testimonial'), $testimonialSlider_k));
                    }
                }
            }
        } else {
            if ($testimonialSliderEntriesMin >= 1) {
                $e->add(t("The %s field requires at least %s entries, none entered.", t("Testimonial"), $testimonialSliderEntriesMin));
            }
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
}