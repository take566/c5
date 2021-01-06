<?php
namespace Concrete\Package\HeyDj\Theme\HeyDj;

use Concrete\Core\Page\Theme\Theme; 

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

// class PageTheme extends \Concrete\Core\Page\Theme\Theme {
class PageTheme extends Theme implements ThemeProviderInterface {
	protected $pThemeGridFrameworkHandle = 'bootstrap3';

	public function getThemeName(){
		return t('hey dj');
	}
	public function getThemeDescription(){
		return t('I made this theme for the purpose of a corporate site.This theme uses the Bootstrap framework.It becomes multi-device, Responsive.Because I make it in 7.5.6 for concrete5, the customization is possible in 7.5.6.');
	}

	public function registerAssets() {
		$this->providesAsset('css', 'bootstrap/*');
		$this->providesAsset('css', 'font-awesome');
		$this->providesAsset('javascript', 'bootstrap/*');
		$this->requireAsset('javascript', 'jquery');
	}

	public function getThemeAreaLayoutPresets()
	{
			$presets = array(
					array(
							'handle' => 'left_sidebar',
							'name' => 'Left Sidebar',
							'container' => '<div class="row"></div>',
							'columns' => array(
									'<div class="col-sm-4"></div>',
									'<div class="col-sm-8"></div>'
							),
					),
					array(
							'handle' => 'right_sidebar',
							'name' => 'Right Sidebar',
							'container' => '<div class="row"></div>',
							'columns' => array(
									'<div class="col-sm-8"></div>',
									'<div class="col-sm-4"></div>'
							),
					)
			);
			return $presets;
	}

	public function getThemeEditorClasses()
	{
		return array(
		array('title' => 'sub title', 'menuClass' => 'title', 'spanClass' => 'title', 'forceBlock' => 1),
		array('title' => 'footer title', 'menuClass' => 'footer-sub-title', 'spanClass' => 'footer-sub--title', 'forceBlock' => 1),
		array('title' => 'copyright', 'menuClass' => 'footer-label', 'spanClass' => 'footer-label', 'forceBlock' => 1),
		array('title' => 'link btn', 'menuClass' => 'btn btn-default btn-space', 'spanClass' => 'btn btn-default btn-space', 'forceBlock' => 1),
		array('title' => 'about logo image', 'menuClass' => 'character-icon', 'spanClass' => 'character-icon', 'forceBlock' => 1),
		array('title' => 'about title', 'menuClass' => 'character-title', 'spanClass' => 'character-title', 'forceBlock' => 1),
		array('title' => 'about comment', 'menuClass' => 'character-comment', 'spanClass' => 'character-comment', 'forceBlock' => 1),
		array('title' => 'about map txt', 'menuClass' => 'work-place-coment', 'spanClass' => 'work-place-coment', 'forceBlock' => 1),
		);
	}


}