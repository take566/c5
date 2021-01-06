<?php
namespace Concrete\Package\HeyDj;

use Concrete\Core\Package\Package;
use BlockType;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Theme\Theme;
use Loader;
use FileImporter;
use Concrete\Core\Entity\File\Image\Thumbnail\Type\Type as ThumbnailType;

defined('C5_EXECUTE') or die(_("Access Denied."));
if (!function_exists('compat_is_version_8')) {
  function compat_is_version_8() {
    return interface_exists('\Concrete\Core\Export\ExportableInterface');
  }
}

class Controller extends Package
{

  protected $pkgHandle = 'hey_dj'; //package handle
  protected $appVersionRequired = '5.7.5.6'; //concrete5's ver.
  protected $pkgVersion = '2.0.8'; //package's ver.
  protected $pkgAllowsFullContentSwap = true; //over ride

  public function getPackageDescription()
  {
    return t("This theme employs a lot of functions that concrete5 assumes basics.Furthermore, I devise the list of pages.I think that I can customize this theme more freely if I understand Html&CSS.I recommend that I use the theme to release next if I do not understand Html&CSS without using this theme.");//package's description
  }
  
  
  public function getPackageName()
  {
    return t("hey_dj");//package name
  }

    public function import_files()
  {
    // now we add in any files that this package has
    if (is_dir($this->getPackagePath() . '/content_files'))
     {
        $fh = new FileImporter();
        $contents = Loader::helper('file')->getDirectoryContents($this->getPackagePath() . '/content_files');

        foreach ($contents as $filename)
        {
            $f = $fh->import($this->getPackagePath() . '/content_files/' . $filename, $filename);
        }
    }
  }

  public function install()
  {
    $pkg = parent::install();
    Theme::add('hey_dj', $pkg);//theme install
    if ( compat_is_version_8() ) {
      //code for version 8
      $this->installThumbnailV8();
    }
    else {
      //code for version 7
      $this->installThumbnailV57();
    }
  }
  
  private function installThumbnailV57(){
    $file_manager_listing = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('file_manager_listing');
    if (!is_object($file_manager_listing)) {
      $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
      $type->setName('File Manager Thumbnails');
      $type->setHandle('file_manager_listing');
      $type->setWidth(60);
      $type->setHeight(60);
      $type->save();
    }
    $file_manager_detail = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('file_manager_detail');
    if (!is_object($file_manager_detail)) {
      $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
      $type->setName('File Manager Detail Thumbnails');
      $type->setHandle('file_manager_detail');
      $type->setWidth(400);
      $type->save();
    }

    $small = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('small');
    if (!is_object($small)) {
      $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
      $type->setName('Small');
      $type->setHandle('small');
      $type->setWidth(740);
      $type->save();
    }
    $medium = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('medium');
    if (!is_object($medium)) {
      $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
      $type->setName('Medium');
      $type->setHandle('medium');
      $type->setWidth(940);
      $type->save();
    }
    $large = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');
    if (!is_object($large)) {
      $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
      $type->setName('Large');
      $type->setHandle('large');
      $type->setWidth(1140);
      $type->save();
    }
  }
  private function installThumbnailV8(){
    $em = \ORM::entityManager();
    $file_manager_listing = $em->getRepository('\Concrete\Core\Entity\File\Image\Thumbnail\Type\Type')
                   ->findOneBy(['ftTypeHandle' => 'file_manager_listing']);
    if (!is_object($file_manager_listing)) {
      $type = new ThumbnailType();
      $type->setName('File Manager Thumbnails');
      $type->setHandle('file_manager_listing');
      $type->setWidth(60);
      $type->setHeight(60);
      $type->save();
    }
    $file_manager_detail = $em->getRepository('\Concrete\Core\Entity\File\Image\Thumbnail\Type\Type')
        ->findOneBy(['ftTypeHandle' => 'file_manager_detail']);
    if (!is_object($file_manager_detail)) {
      $type = new ThumbnailType();
      $type->setName('File Manager Detail Thumbnails');
      $type->setHandle('file_manager_detail');
      $type->setWidth(400);
      $type->save();
    }

    $small = $em->getRepository('\Concrete\Core\Entity\File\Image\Thumbnail\Type\Type')
        ->findOneBy(['ftTypeHandle' => 'small']);
    if (!is_object($small)) {
      $type = new ThumbnailType();
      $type->setName('Small');
      $type->setHandle('small');
      $type->setWidth(740);
      $type->save();
    }
    $medium = $em->getRepository('\Concrete\Core\Entity\File\Image\Thumbnail\Type\Type')
        ->findOneBy(['ftTypeHandle' => 'medium']);
    if (!is_object($medium)) {
      $type = new ThumbnailType();
      $type->setName('Medium');
      $type->setHandle('medium');
      $type->setWidth(940);
      $type->save();
    }
    $large = $em->getRepository('\Concrete\Core\Entity\File\Image\Thumbnail\Type\Type')
        ->findOneBy(['ftTypeHandle' => 'large']);
    if (!is_object($large)) {
      $type = new ThumbnailType();
      $type->setName('Large');
      $type->setHandle('large');
      $type->setWidth(1140);
      $type->save();
    }
  }
    
}
