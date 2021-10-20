<?php defined("C5_EXECUTE") or die("Access Denied."); ?>
<?php $tabs = [
    ['hero-unit-' . $identifier_getString, t('Hero Unit'), true],
    ['hero-unit-button-' . $identifier_getString, t('Hero Unit Button')],
    ['hero-unit-settings-' . $identifier_getString, t('Hero Unit Settings')]
];
echo $app->make('helper/concrete/ui')->tabs($tabs); ?>

<div class="ccm-tab-content" id="ccm-tab-content-hero-unit-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitHeading'), t("Hero Unit Heading")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitHeading', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('heroUnitHeading'), $heroUnitHeading, array ('maxlength' => 255,)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitContent'), t("Hero Unit Content")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitContent', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $app->make('editor')->outputBlockEditModeEditor($view->field('heroUnitContent'), $heroUnitContent); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('contentAlignment'), t("Content Alignment")); ?>
        <?php echo isset($btFieldsRequired) && in_array('contentAlignment', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('contentAlignment'), $contentAlignment_options, $contentAlignment, []); ?>
    </div>

    <div class="form-group">
        <?php
        if (isset($heroUnitBackgroundImage) && $heroUnitBackgroundImage > 0) {
            $heroUnitBackgroundImage_o = File::getByID($heroUnitBackgroundImage);
            if (!is_object($heroUnitBackgroundImage_o)) {
                unset($heroUnitBackgroundImage_o);
            }
        } ?>
        <?php echo $form->label($view->field('heroUnitBackgroundImage'), t("Hero Unit Background Image")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitBackgroundImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $app->make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_hero_unit-heroUnitBackgroundImage-' . $identifier_getString, $view->field('heroUnitBackgroundImage'), t("Choose Image"), $heroUnitBackgroundImage_o); ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-hero-unit-settings-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('headingAnimation'), t("Heading Animation")); ?>
        <?php echo isset($btFieldsRequired) && in_array('headingAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('headingAnimation'), $headingAnimation_options, $headingAnimation, []); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('contentAnimation'), t("Content Animation")); ?>
        <?php echo isset($btFieldsRequired) && in_array('contentAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('contentAnimation'), $contentAnimation_options, $contentAnimation, []); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitBottomMargin'), t("Hero Unit Bottom Margin") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Set a margin under the hero unit, your sites content will begin after this margin") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitBottomMargin', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('heroUnitBottomMargin'), $heroUnitBottomMargin, []); ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-hero-unit-button-<?php echo $identifier_getString; ?>">
    <div class="form-group">
        <?php echo $form->label($view->field('linkPicker'), t("Link")); ?>
        <?php echo isset($btFieldsRequired) && in_array('linkPicker', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('linkPicker'), $linkPicker_options, $linkPicker, []); ?>
    </div>

    <div class="link_picker_page well" style="display: none;">
        <div class="form-group">
            <?php echo $form->label($view->field('buttonUrl'), t("Button URL")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonUrl', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $app->make("helper/form/page_selector")->selectPage($view->field('buttonUrl'), $buttonUrl); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonUrl_text'), t("Button URL") . " " . t("Text")); ?>
            <?php echo $form->text($view->field('buttonUrl_text'), $buttonUrl_text, []); ?>
        </div>
    </div>
    
    <div class="link_picker_external well" style="display: none;">
        <div class="form-group">
            <?php echo $form->label($view->field('externalLink'), t("External Link")); ?>
            <?php echo isset($btFieldsRequired) && in_array('externalLink', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->text($view->field('externalLink'), $externalLink, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('externalLink_text'), t("External Link") . " " . t('Text')); ?>
            <?php echo $form->text($view->field('externalLink_text'), $externalLink_text, []); ?>
        </div>
    </div>
    
    <div class="all-button-options">
        <div class="form-group">
            <?php echo $form->label($view->field('buttonType'), t("Button Type")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonType', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonType'), $buttonType_options, $buttonType, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonColors'), t("Button Colors")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonColors', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonColors'), $buttonColors_options, $buttonColors, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonRadius'), t("Button Radius")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonRadius', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonRadius'), $buttonRadius_options, $buttonRadius, []); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonAnimation'), t("Button Animation")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonAnimation', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo $form->select($view->field('buttonAnimation'), $buttonAnimation_options, $buttonAnimation, []); ?>
        </div>

        <script type="text/javascript">
            Concrete.event.publish('vidal_themes_hero_unit.buttonIcons.font_awesome');
            $(document).ready(function () {
                $('select.font-awesome-previewed').trigger('change');
            });

            $(document).ready(function() {
                $('#linkPicker').on('change', function() {
                    if ($(this).val() == '') {
                        $('.link_picker_external').hide();
                        $('.link_picker_page').hide();
                        $('.all-button-options').hide();
                    }
                    if ($(this).val() == 'external') {
                        $('.link_picker_external').show();
                        $('.link_picker_page').hide();
                        $('.all-button-options').show();
                    }
                    if ($(this).val() == 'page') {
                        $('.link_picker_external').hide();
                        $('.link_picker_page').show();
                        $('.all-button-options').show();
                    }
                }).trigger('change');
            });
        </script>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonIcons'), t("Button Icons")); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonIcons', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <div class="font-awesome-group">
                <?php echo $form->select($view->field('buttonIcons'), $buttonIcons_options, $buttonIcons, array ('class' => 'form-control font-awesome-previewed',)); ?>
                <i data-preview="icon" class=""></i>
            </div>
        </div>
    </div>
</div>