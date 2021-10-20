<?php defined("C5_EXECUTE") or die("Access Denied."); 
    print $app->make('helper/concrete/ui')->tabs(array(
        array('video-hero-unit-details', t('Video Hero Unit'), true),
        array('video-hero-unit-button', t('Hero Unit Button')),
        array('video-hero-unit-settings', t('Hero Unit settings'))
    ));
?>

<div id="ccm-tab-content-video-hero-unit-details" class="ccm-tab-content">
    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitHeading'), t("Hero Unit Heading")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitHeading', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('heroUnitHeading'), $heroUnitHeading, array ('maxlength' => 255,)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('heroUnitContent'), t("Hero Unit Content")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitContent', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo Core::make('editor')->outputBlockEditModeEditor($view->field('heroUnitContent'), $heroUnitContent); ?>
    </div>

    <?php $videoBackground_o = null;
    if ($videoBackground > 0) {
        $videoBackground_o = File::getByID($videoBackground);
    } ?>
    <div class="form-group">
        <?php echo $form->label($view->field('videoBackground'), t("Video Background (MP4)")); ?>
        <?php echo isset($btFieldsRequired) && in_array('videoBackground', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo Core::make("helper/concrete/asset_library")->file('ccm-b-file-videoBackground-' . $identifier_getString, $view->field('videoBackground'), t("Choose File"), $videoBackground_o); ?>
    </div>

    <?php $videoBackgroundBackup_o = null;
    if ($videoBackgroundBackup > 0) {
        $videoBackgroundBackup_o = File::getByID($videoBackgroundBackup);
    } ?>
    <div class="form-group">
        <?php echo $form->label($view->field('videoBackgroundBackup'), t("Video Background (WEBM)") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This video will be used in browsers that are unable to handle the MP4 format") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('videoBackgroundBackup', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo Core::make("helper/concrete/asset_library")->file('ccm-b-file-videoBackgroundBackup-' . $identifier_getString, $view->field('videoBackgroundBackup'), t("Choose File"), $videoBackgroundBackup_o); ?>
    </div>

    <div class="form-group">
        <?php
        if (isset($posterImage) && $posterImage > 0) {
            $posterImage_o = File::getByID($posterImage);
            if (!is_object($posterImage_o)) {
                unset($posterImage_o);
            }
        } ?>
        <?php echo $form->label($view->field('posterImage'), t("Poster Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This image will be used if the video fails to load") . '"></i>'); ?>
        <?php echo isset($btFieldsRequired) && in_array('posterImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo Core::make("helper/concrete/asset_library")->image('ccm-b-vidal_themes_video_hero_unit-posterImage-' . $identifier_getString, $view->field('posterImage'), t("Choose Image"), $posterImage_o); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('contentAlignment'), t("Content Alignment")); ?>
        <?php echo isset($btFieldsRequired) && in_array('contentAlignment', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('contentAlignment'), $contentAlignment_options, $contentAlignment, []); ?>
    </div>
</div>

<div id="ccm-tab-content-video-hero-unit-button" class="ccm-tab-content">
    <div class="form-group">
        <?php echo $form->label($view->field('linkPicker'), t("Link")); ?>
        <?php echo isset($btFieldsRequired) && in_array('linkPicker', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('linkPicker'), $linkPicker_options, $linkPicker, []); ?>
    </div>

    <div class="link_picker_page well" style="display: none;">
        <div class="form-group">
            <?php echo $form->label($view->field('buttonUrl'), t("Internal Link") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Link to a page on this site") . '"></i>'); ?>
            <?php echo isset($btFieldsRequired) && in_array('buttonUrl', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
            <?php echo Core::make("helper/form/page_selector")->selectPage($view->field('buttonUrl'), $buttonUrl); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($view->field('buttonUrl_text'), t("Internal Link") . " " . t("Text")); ?>
            <?php echo $form->text($view->field('buttonUrl_text'), $buttonUrl_text, []); ?>
        </div>
    </div>

    <div class="link_picker_external well" style="display: none;">
        <div class="form-group">
            <?php echo $form->label($view->field('externalLink'), t("External Link") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Link to a page on another site") . '"></i>'); ?>
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
            Concrete.event.publish('vidal_themes_video_hero_unit.buttonIcons.font_awesome');
            $(document).ready(function () {
                $('select.font-awesome-previewed').trigger('change');
            });
            $(document).ready(function() {
                $('#linkPicker').on('change', function() {
                    if ($(this).val() == 'none') {
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
                <?php echo $form->select($view->field('buttonIcons'), $buttonIcons_options, $buttonIcons, array (
        'class' => 'form-control font-awesome-previewed',
        )); ?>
                <i data-preview="icon" class=""></i>
            </div>
        </div>
    </div>
</div>

<div id="ccm-tab-content-video-hero-unit-settings" class="ccm-tab-content">
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
        <?php echo $form->label($view->field('heroUnitBottomMargin'), t("Hero Unit Bottom Margin")); ?>
        <?php echo isset($btFieldsRequired) && in_array('heroUnitBottomMargin', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->text($view->field('heroUnitBottomMargin'), $heroUnitBottomMargin, array (
    'maxlength' => 255,
    )); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($view->field('loopVideo'), t("Loop Video")); ?>
        <?php echo isset($btFieldsRequired) && in_array('loopVideo', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php echo $form->select($view->field('loopVideo'), (isset($btFieldsRequired) && in_array('loopVideo', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $loopVideo, []); ?>
    </div>

    <!-- Removed due to Webkit policy of not autoplaying a video unless its muted -->
    <!--
    <div class="form-group">
        <?php //echo $form->label($view->field('muteVideo'), t("Mute Video")); ?>
        <?php //echo isset($btFieldsRequired) && in_array('muteVideo', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
        <?php //echo $form->select($view->field('muteVideo'), (isset($btFieldsRequired) && in_array('muteVideo', $btFieldsRequired) ? [] : ["" => "--" . t("Select") . "--"]) + [0 => t("No"), 1 => t("Yes")], $muteVideo, []); ?>
    </div>
    -->
</div>