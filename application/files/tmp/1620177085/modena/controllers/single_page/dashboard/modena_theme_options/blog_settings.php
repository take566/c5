<?php
namespace Concrete\Package\Modena\Controller\SinglePage\Dashboard\ModenaThemeOptions;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Package\Package;

class BlogSettings extends DashboardPageController
{
    public function view()
    {
        $this->requireAsset('css', 'ensemble_ui_styles');
        $pkg = Package::getByHandle('modena');

        $blog_sidebar = $pkg->getConfig()->get('vidal.ensemble.blog_sidebar');
        $blog_columns = $pkg->getConfig()->get('vidal.ensemble.blog_columns');
        $blog_margin = $pkg->getConfig()->get('vidal.ensemble.blog_margin');
        $read_more = $pkg->getConfig()->get('vidal.ensemble.read_more');
        $read_more_overlay = $pkg->getConfig()->get('vidal.ensemble.read_more_overlay');

        $this->set('blog_sidebar', $blog_sidebar);
        $this->set('blog_columns', $blog_columns);
        $this->set('blog_margin', $blog_margin);
        $this->set('read_more', $read_more);
        $this->set('read_more_overlay', $read_more_overlay);

    }

    public function updated()
    {
        $this->set('success', t("Your settings were saved successfully."));
        $this->view();
    }

    public function blog_save_settings()
    {
        if ($this->token->validate("blog_save_settings")) {
            if ($this->isPost()) {

                $blog_sidebar = $this->request->request->get('blog_sidebar');
                $blog_columns = $this->request->request->get('blog_columns');
                $blog_margin = $this->request->request->get('blog_margin');
                $read_more = $this->request->request->get('read_more');
                $read_more_overlay = $this->request->request->get('read_more_overlay');

                $pkg = Package::getByHandle('modena');

                $pkg->getConfig()->save('vidal.ensemble.blog_sidebar', $blog_sidebar);
                $pkg->getConfig()->save('vidal.ensemble.blog_columns', $blog_columns);
                $pkg->getConfig()->save('vidal.ensemble.blog_margin', $blog_margin);
                $pkg->getConfig()->save('vidal.ensemble.read_more', $read_more);
                $pkg->getConfig()->save('vidal.ensemble.read_more_overlay', $read_more_overlay);

                $this->redirect('/dashboard/modena_theme_options/blog_settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }
}