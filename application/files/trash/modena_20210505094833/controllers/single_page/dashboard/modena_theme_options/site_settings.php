<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class SiteSettings extends DashboardPageController
{
    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $site_width = $pkg->getConfig()->get('vidal.ensemble.site_width');
        $social_button_shape = $pkg->getConfig()->get('vidal.ensemble.social_button_shape');
        $disable_preloader = $pkg->getConfig()->get('vidal.ensemble.disable_preloader');
        $disable_backto_top = $pkg->getConfig()->get('vidal.ensemble.disable_backtotop');
        $use_us_date = $pkg->getConfig()->get('vidal.ensemble.use_us_date');
        $mobile_animation = $pkg->getConfig()->get('vidal.ensemble.mobile_animation');

        $this->set('site_width', $site_width);
        $this->set('social_button_shape', $social_button_shape);
        $this->set('disable_preloader', $disable_preloader);
        $this->set('disable_backto_top', $disable_backto_top);
        $this->set('use_us_date', $use_us_date);
        $this->set('mobile_animation', $mobile_animation);
    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function site_save_settings()
    {
        if ($this->token->validate("site_save_settings")) {
            if ($this->isPost()) {

                $site_width = $this->request->request->get('site_width');
                $social_button_shape = $this->request->request->get('social_button_shape');
                $disable_preloader = $this->request->request->get('disable_preloader');
                $disable_backto_top = $this->request->request->get('disable_backto_top');
                $use_us_date = $this->request->request->get('use_us_date');
                $mobile_animation = $this->request->request->get('mobile_animation');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.site_width', $site_width);
                $pkg->getConfig()->save('vidal.ensemble.social_button_shape', $social_button_shape);
                $pkg->getConfig()->save('vidal.ensemble.disable_preloader', $disable_preloader);
                $pkg->getConfig()->save('vidal.ensemble.disable_backtotop', $disable_backto_top);
                $pkg->getConfig()->save('vidal.ensemble.use_us_date', $use_us_date);
                $pkg->getConfig()->save('vidal.ensemble.mobile_animation', $mobile_animation);

                $this->redirect('/dashboard/modena_theme_options/site_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}