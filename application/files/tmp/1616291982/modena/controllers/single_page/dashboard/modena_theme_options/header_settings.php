<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class HeaderSettings extends DashboardPageController
{
    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $static_header = $pkg->getConfig()->get('vidal.ensemble.static_header');
        $static_header_height = $pkg->getConfig()->get('vidal.ensemble.static_header_height');
        $static_header_height_scroll = $pkg->getConfig()->get('vidal.ensemble.static_header_height_scroll');
        $disable_search = $pkg->getConfig()->get('vidal.ensemble.disable_search');
        $disable_guide_header = $pkg->getConfig()->get('vidal.ensemble.disable_guide_header');
        $style_sub_header = $pkg->getConfig()->get('vidal.ensemble.style_sub_header');

        $this->set('static_header', $static_header);
        $this->set('static_header_height', $static_header_height);
        $this->set('static_header_height_scroll', $static_header_height_scroll);
        $this->set('disable_search', $disable_search);
        $this->set('disable_guide_header', $disable_guide_header);
        $this->set('style_sub_header', $style_sub_header);
    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function save_header_settings()
    {
        if ($this->token->validate("save_header_settings")) {
            if ($this->isPost()) {

                $static_header = $this->request->request->get('static_header');
                $static_header_height = $this->request->request->get('static_header_height');
                $static_header_height_scroll = $this->request->request->get('static_header_height_scroll');
                $disable_search = $this->request->request->get('disable_search');
                $disable_guide_header = $this->request->request->get('disable_guide_header');
                $style_sub_header = $this->request->request->get('style_sub_header');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.static_header', $static_header);
                $pkg->getConfig()->save('vidal.ensemble.static_header_height', $static_header_height);
                $pkg->getConfig()->save('vidal.ensemble.static_header_height_scroll', $static_header_height_scroll);
                $pkg->getConfig()->save('vidal.ensemble.disable_search', $disable_search);
                $pkg->getConfig()->save('vidal.ensemble.disable_guide_header', $disable_guide_header);
                $pkg->getConfig()->save('vidal.ensemble.style_sub_header', $style_sub_header);

                $this->redirect('/dashboard/modena_theme_options/header_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}