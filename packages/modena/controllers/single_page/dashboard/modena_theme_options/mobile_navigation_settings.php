<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class MobileNavigationSettings extends DashboardPageController
{

    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $mobile_nav_width = $pkg->getConfig()->get('vidal.ensemble.mobile_nav_width');
        $mobile_nav_arrow = $pkg->getConfig()->get('vidal.ensemble.mobile_nav_arrow');
        $mobile_nav_center = $pkg->getConfig()->get('vidal.ensemble.mobile_nav_center');
        $mobile_nav_shadow = $pkg->getConfig()->get('vidal.ensemble.mobile_nav_shadow');

        $this->set('mobile_nav_width', $mobile_nav_width);
        $this->set('mobile_nav_arrow', $mobile_nav_arrow);
        $this->set('mobile_nav_center', $mobile_nav_center);
        $this->set('mobile_nav_shadow', $mobile_nav_shadow);
    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function save_mobile_nav_settings()
    {
        if ($this->token->validate("save_mobile_nav_settings")) {
            if ($this->isPost()) {

                $mobile_nav_width = $this->request->request->get('mobile_nav_width');
                $mobile_nav_arrow = $this->request->request->get('mobile_nav_arrow');
                $mobile_nav_center = $this->request->request->get('mobile_nav_center');
                $mobile_nav_shadow = $this->request->request->get('mobile_nav_shadow');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.mobile_nav_width', $mobile_nav_width);
                $pkg->getConfig()->save('vidal.ensemble.mobile_nav_arrow', $mobile_nav_arrow);
                $pkg->getConfig()->save('vidal.ensemble.mobile_nav_center', $mobile_nav_center);
                $pkg->getConfig()->save('vidal.ensemble.mobile_nav_shadow', $mobile_nav_shadow);
               
                $this->redirect('/dashboard/modena_theme_options/mobile_navigation_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}