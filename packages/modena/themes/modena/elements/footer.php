<?php defined('C5_EXECUTE') or die("Access Denied.");
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$pk = Package::getByHandle('modena');
?>

<?php if($pk->getConfig()->get('vidal.ensemble.disable_backtotop') == true) : ?>
    <div class="back-to-top--floating"></div>
<?php endif; ?>

<footer class="background-color-2 padding-top-80 padding-bottom-40">
    <?php
        $a = new Area('Footer top');
        $a->setAreaGridMaximumColumns(12);
        $a->enableGridContainer();
        $a->display($c);
    ?>
    <div class="grid-container">
        <div class="grid-row">
            <?php
                switch ($pk->getConfig()->get('vidal.ensemble.footer_columns')) :
                    case '0': ?>
                        <div class="column-12">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
                    <?php case '1': ?>
                        <div class="column-6">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-6">
                            <?php
                                $a = new GlobalArea('Footer Column 2');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
                    <?php case '2': ?> 
                        <div class="column-4">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-4">
                            <?php
                                $a = new GlobalArea('Footer Column 2');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-4">
                            <?php
                                $a = new GlobalArea('Footer Column 3');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
                    <?php case '3': ?>
                        <div class="column-3">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-3">
                            <?php
                                $a = new GlobalArea('Footer Column 2');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-3">
                            <?php
                                $a = new GlobalArea('Footer Column 3');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-3">
                            <?php
                                $a = new GlobalArea('Footer Column 4');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
                    <?php case '4': ?>
                        <div class="column-4">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-2 push-column-6">
                            <?php
                                $a = new GlobalArea('Footer Column 2');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
                    <?php default: ?>
                        <div class="column-4">
                            <?php
                                $a = new GlobalArea('Footer Column 1');
                                $a->display();
                            ?>
                        </div>
                        <div class="column-2 push-column-6">
                            <?php
                                $a = new GlobalArea('Footer Column 2');
                                $a->display();
                            ?>
                        </div>
                    <?php break; ?>
            <?php endswitch; ?>
        </div>
    </div>

    <?php
        $a = new Area('Footer bottom');
        $a->setAreaGridMaximumColumns(12);
        $a->enableGridContainer();
        $a->display($c);
    ?>

    <div class="grid-container">
        <div class="grid-row">
            <div class="column-12 copyright-content <?php echo $pk->getConfig()->get('vidal.ensemble.copyright_position'); ?> ">
                <div class="copyright-border margin-bottom-5 margin-top-30"></div>
                <p>
                    <span class="copyright"><?php echo h("Copyright") ?> &copy; <?php echo date('Y'); ?>&nbsp;</span> 
                        <?php 
                            $copyrightNotice = $pk->getConfig()->get('vidal.ensemble.copyright_notice');
                            if ($copyrightNotice) {
                                echo $copyrightNotice;
                            }else{
                                echo t('<a href="http://vidalthemes.com" target="_blank">Theme by Vidal Themes</a>');
                        } ?>

                        <?php if($pk->getConfig()->get('vidal.ensemble.login_link')) : ?>
                            &nbsp; | &nbsp;
                        <?php endif; ?>
                    
                        <?php $loginLink = $pk->getConfig()->get('vidal.ensemble.login_link');
                            if ($loginLink == true) {
                                echo $app->make('helper/navigation')->getLogInOutLink();
                        } ?>

                        <?php if($pk->getConfig()->get('vidal.ensemble.credit_link')) : ?>
                            &nbsp; | &nbsp;
                        <?php endif; ?>

                        <?php $creditLink = $pk->getConfig()->get('vidal.ensemble.credit_link');
                            if ($creditLink == true) {
                                echo t('Built with <a href="http://concrete5.com" target="_blank">Concrete5</a> CMS');
                        } ?>
                </p>
            </div>
        </div>
    </div>
</footer>
    </div>
        <script type="text/javascript" src="<?php echo $this->getThemePath() ?>/js/main-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->getThemePath() ?>/js/scripts-min.js"></script>
        <?php View::element('footer_required'); ?>
    </body>
</html>
