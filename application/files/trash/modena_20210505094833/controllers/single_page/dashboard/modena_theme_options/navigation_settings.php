<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class NavigationSettings extends DashboardPageController
{

    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $sub_nav_width = $pkg->getConfig()->get('vidal.ensemble.sub_nav_width');

        $this->set('sub_nav_width', $sub_nav_width);
    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function save_nav_settings()
    {
        if ($this->token->validate("save_nav_settings")) {
            if ($this->isPost()) {

                $sub_nav_width = $this->request->request->get('sub_nav_width');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.sub_nav_width', $sub_nav_width);

                $this->redirect('/dashboard/modena_theme_options/navigation_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}