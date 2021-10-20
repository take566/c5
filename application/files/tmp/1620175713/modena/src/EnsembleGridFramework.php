<?php
namespace Concrete\Package\Modena\Src;

use Concrete\Core\Page\Theme\GridFramework\GridFramework;

defined('C5_EXECUTE') or die("Access Denied.");

class EnsembleGridFramework extends GridFramework
{
    public function supportsNesting()
    {
        return true;
    }
    public function getPageThemeGridFrameworkName()
    {
        return t('Ensemble');
    }
    public function getPageThemeGridFrameworkRowStartHTML()
    {
        return '<div class="grid-row">';
    }
    public function getPageThemeGridFrameworkRowEndHTML()
    {
        return '</div>';
    }
    public function getPageThemeGridFrameworkContainerStartHTML()
    {
        return '<div class="grid-container">';
    }
    public function getPageThemeGridFrameworkContainerEndHTML()
    {
        return '</div>';
    }
    public function getPageThemeGridFrameworkColumnClasses()
    {
        $ensemble_columns = array(
            'column-1',
            'column-2',
            'column-3',
            'column-4',
            'column-5',
            'column-6',
            'column-7',
            'column-8',
            'column-9',
            'column-10',
            'column-11',
            'column-12',
        );
        return $ensemble_columns;
    }
    public function getPageThemeGridFrameworkColumnOffsetClasses()
    {
        $ensemble_offsets = array(
            'push-column-1',
            'push-column-2',
            'push-column-3',
            'push-column-4',
            'push-column-5',
            'push-column-6',
            'push-column-7',
            'push-column-8',
            'push-column-9',
            'push-column-10',
            'push-column-11',
            'push-column-12',
        );
        return $ensemble_offsets;
    }
    public function getPageThemeGridFrameworkColumnAdditionalClasses()
    {
        return '';
    }
    public function getPageThemeGridFrameworkColumnOffsetAdditionalClasses()
    {
        return '';
    }
}
