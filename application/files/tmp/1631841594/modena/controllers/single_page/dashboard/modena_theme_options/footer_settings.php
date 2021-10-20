<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class FooterSettings extends DashboardPageController
{
    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $copyright_notice = $pkg->getConfig()->get('vidal.ensemble.copyright_notice');
        $copyright_position = $pkg->getConfig()->get('vidal.ensemble.copyright_position');
        $login_link = $pkg->getConfig()->get('vidal.ensemble.login_link');
        $credit_link = $pkg->getConfig()->get('vidal.ensemble.credit_link');
        $footer_columns = $pkg->getConfig()->get('vidal.ensemble.footer_columns');

        $this->set('copyright_notice', $copyright_notice);
        $this->set('copyright_position', $copyright_position);
        $this->set('login_link', $login_link);
        $this->set('credit_link', $credit_link);
        $this->set('footer_columns', $footer_columns);

    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function save_footer_settings()
    {
        if ($this->token->validate("save_footer_settings")) {
            if ($this->isPost()) {

                $copyright_notice = $this->request->request->get('copyright_notice');
                $copyright_position = $this->request->request->get('copyright_position');
                $login_link = $this->request->request->get('login_link');
                $credit_link = $this->request->request->get('credit_link');
                $footer_columns = $this->request->request->get('footer_columns');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.copyright_notice', $copyright_notice);
                $pkg->getConfig()->save('vidal.ensemble.copyright_position', $copyright_position);
                $pkg->getConfig()->save('vidal.ensemble.login_link', $login_link);
                $pkg->getConfig()->save('vidal.ensemble.credit_link', $credit_link);
                $pkg->getConfig()->save('vidal.ensemble.footer_columns', $footer_columns);

                $this->redirect('/dashboard/modena_theme_options/footer_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}