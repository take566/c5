<?php
namespace Concrete\Package\Modena\Theme\Modena;

use Concrete\Core\Page\Theme\Theme as Theme;
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface
{
    protected $pThemeGridFrameworkHandle = 'modena';

    public function getThemeName()
    {
        return t('Modena Theme');
    }

    public function getThemeDescription()
    {
        return t('A stylish, modern, multi-use Concrete5 theme.');
    }

    public function registerAssets() {
        $this->providesAsset('css', 'css/font-awesome');
        $this->providesAsset('css', 'blocks/form');
        $this->requireAsset('javascript', 'jquery');
    }

     public function getThemeDefaultBlockTemplates()
     {
         return array(
             'autonav' => 'main-nav'
         );
     }


    public function getThemeEditorClasses()
    {
        return array(
            array(
                'title' => t('Phone'),
                'element' => array('p'),
                'attributes' => array('class' => 'modena-icons modena-icons--phone-number')
            ),
            array(
                'title' => t('Mobile Phone'),
                'element' => array('p'),
                'attributes' => array('class' => 'modena-icons modena-icons--mobile-number')
            ),
            array(
                'title' => t('Email address'),
                'element' => array('p','a'),
                'attributes' => array('class' => 'modena-icons modena-icons--email-address')
            ),
            array(
                'title' => t('Uppercase'),
                'element' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'),
                'attributes' => array('class' => 'text-uppercase')
            ),
            array(
                'title' => t('Blockquote'),
                'element' => array('blockquote'),
                'attributes' => array('class' => 'text-blockquote')
            ),
            array(
                'title' => t('Address'),
                'element' => array('ul', 'ol'),
                'attributes' => array('class' => 'list-address'),
            ),
            array(
                'title' => t('Button Primary'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-primary')
            ),
            array(
                'title' => t('Button Primary Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-primary button-rounded')
            ),
            array(
                'title' => t('Button Primary Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-primary button-pill')
            ),
            array(
                'title' => t('Secondary Button'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-secondary')
            ),
            array(
                'title' => t('Secondary Button Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-secondary button-rounded')
            ),
            array(
                'title' => t('Secondary Button Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-secondary button-pill')
            ),
            array(
                'title' => t('Tertiary Button'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-tertiary')
            ),
            array(
                'title' => t('Tertiary Button Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-tertiary button-rounded')
            ),
            array(
                'title' => t('Tertiary Button Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-tertiary button-pill')
            ),
            array(
                'title' => t('Utility Button 1'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-1')
            ),
            array(
                'title' => t('Utility Button 1 Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-1 button-rounded')
            ),
            array(
                'title' => t('Utility Button 1 Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-1 button-pill')
            ),
            array(
                'title' => t('Utility Button 2'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-2')
            ),
            array(
                'title' => t('Utility Button 2 Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-2 button-rounded')
            ),
            array(
                'title' => t('Utility Button 2 Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-utility-2 button-pill')
            ),
            array(
                'title' => t('Ghost Button Primary'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-primary')
            ),
            array(
                'title' => t('Ghost Button Primary Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-primary button-rounded')
            ),
            array(
                'title' => t('Ghost Button Primary Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-primary button-pill')
            ),
            array(
                'title' => t('Ghost Secondary Button'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-secondary')
            ),
            array(
                'title' => t('Ghost Secondary Button Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-secondary button-rounded')
            ),
            array(
                'title' => t('Ghost Secondary Button Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-secondary button-pill')
            ),
            array(
                'title' => t('Ghost Tertiary Button'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-tertiary')
            ),
            array(
                'title' => t('Ghost Tertiary Button Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-tertiary button-rounded')
            ),
            array(
                'title' => t('Ghost Tertiary Button Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-tertiary button-pill')
            ),
            array(
                'title' => t('Ghost Utility Button 1'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-1')
            ),
            array(
                'title' => t('Ghost Utility Button 1 Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-1 button-rounded')
            ),
            array(
                'title' => t('Ghost Utility Button 1 Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-1 button-pill')
            ),
            array(
                'title' => t('Ghost Utility Button 2'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-2')
            ),
            array(
                'title' => t('Ghost Utility Button 2 Rounded'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-2 button-rounded')
            ),
            array(
                'title' => t('Ghost Utility Button 2 Pill'),
                'element' => array('a'),
                'attributes' => array('class' => 'button button-ghost-utility-2 button-pill')
            ),
            array(
                'title' => t('Dark underline'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-1'),
            ),
            array(
                'title' => t('Light underline'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-2'),
            ),
            array(
                'title' => t('Dark underline left'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-1 heading-underline--left'),
            ),
            array(
                'title' => t('Light underline left'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-2 heading-underline--left'),
            ),
            array(
                'title' => t('Dark underline right'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-1 heading-underline--right'),
            ),
            array(
                'title' => t('Light underline right'),
                'element' => 'span',
                'attributes' => array('class' => 'heading-underline heading-underline--color-2 heading-underline--right'),
            ),
        );
    }


     public function getThemeAreaLayoutPresets()
     {
         $presets = array(
             array(
                 'handle' => 'left_sidebar',
                 'name' => 'Left Sidebar',
                 'container' => '<div class="grid-row"></div>',
                 'columns' => array(
                     '<div class="column-3"></div>',
                     '<div class="column-9"></div>'
                 ),
             ),
             array(
                 'handle' => 'left_sidebar_xm',
                 'name' => 'Left Sidebar Wide Margin',
                 'container' => '<div class="grid-row"></div>',
                 'columns' => array(
                     '<div class="column-3"></div>',
                     '<div class="column-8 push-column-1"></div>'
                 ),
             ),
             array(
                 'handle' => 'right_sidebar',
                 'name' => 'Right Sidebar',
                 'container' => '<div class="grid-row"></div>',
                 'columns' => array(
                     '<div class="column-9"></div>',
                     '<div class="column-3"></div>'
                 ),
            ),
             array(
                 'handle' => 'right_sidebar_xm',
                 'name' => 'Right Sidebar Wide Margin',
                 'container' => '<div class="grid-row"></div>',
                 'columns' => array(
                     '<div class="column-8"></div>',
                     '<div class="column-3 push-column-1"></div>'
                 ),
            ),
            array(
                'handle' => 'half_columns',
                'name' => '2 Columns',
                'container' => '<div class="grid-row"></div>',
                'columns' => array(
                    '<div class="column-6"></div>',
                    '<div class="column-6"></div>'
                ),
            ),
            array(
                'handle' => 'three_columns',
                'name' => '3 Columns',
                'container' => '<div class="grid-row"></div>',
                'columns' => array(
                    '<div class="column-4"></div>',
                    '<div class="column-4"></div>',
                    '<div class="column-4"></div>'
                ),
            ),
            array(
                'handle' => 'four_columns',
                'name' => '4 Columns',
                'container' => '<div class="grid-row"></div>',
                'columns' => array(
                    '<div class="column-3"></div>',
                    '<div class="column-3"></div>',
                    '<div class="column-3"></div>',
                    '<div class="column-3"></div>'
                ),
            ),
            array(
                'handle' => 'three_six_three',
                'name' => 'Double Sidebars',
                'container' => '<div class="grid-row"></div>',
                'columns' => array(
                    '<div class="column-3"></div>',
                    '<div class="column-6"></div>',
                    '<div class="column-3"></div>'
                ),
            ),
         );
         return $presets;
     }
}