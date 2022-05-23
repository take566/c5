<?php
namespace Concrete\Block\CoreContainer;

use Concrete\Core\Area\ContainerArea;
use Concrete\Core\Area\SubArea;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Entity\Page\Container;
use Concrete\Core\Filesystem\FileLocator;
use Concrete\Core\Page\Container\ContainerBlockInstance;
use Concrete\Core\Page\Container\ContainerExporter;
use Concrete\Core\Page\Container\TemplateLocator;
use Concrete\Core\StyleCustomizer\Inline\StyleSet;
use Doctrine\ORM\EntityManager;

class Controller extends BlockController
{
    protected $btTable = 'btCoreContainer';
    protected $btIsInternal = true;
    protected $btIgnorePageThemeGridFrameworkContainer = true;
    
    public $containerInstanceID;
    
    public function getBlockTypeDescription()
    {
        return t("Proxy block for theme containers added through the UI.");
    }

    public function getBlockTypeName()
    {
        return t("Container");
    }
    
    public function getContainerInstanceObject() :? Container\Instance
    {
        $entityManager = $this->app->make(EntityManager::class);
        if ($this->containerInstanceID) {
            $instance = $entityManager->find(Container\Instance::class, $this->containerInstanceID);
            return $instance;
        }
        return null;
    }
    
    public function view()
    {
        $template = null;
        $instance = $this->getContainerInstanceObject();
        if ($instance) {
            $container = $instance->getContainer();
            if ($container) {
                $containerBlockInstance = $this->app->make(ContainerBlockInstance::class, 
                    ['block' => $this->getBlockObject(), 'instance' => $instance]);
                $locator = $this->app->make(TemplateLocator::class);
                // no this is not a typo. Aesthetically it looks nice to pass $container to the container area
                // constructor, but we need the instance object, not just the outer container object.
                $this->set('container', $containerBlockInstance);
                $this->set('fileToRender', $locator->getFileToRender($this->getCollectionObject(), $container));
            }
        }
    }
    
    public function save($data)
    {
        $entityManager = $this->app->make(EntityManager::class);
        $container = $entityManager->find(Container::class, $data['containerID']);
        if ($container) {
            $instance = new Container\Instance();
            $instance->setContainer($container);
            $entityManager->persist($instance);
            $entityManager->flush();
            $data['containerInstanceID'] = $instance->getContainerInstanceID();
            $this->containerInstanceID = $data['containerInstanceID'];
        }
        parent::save($data);
    }

    public function export(\SimpleXMLElement $blockNode)
    {
        $instance = $this->getContainerInstanceObject();
        if ($instance) {
            $page = $this->getBlockObject()->getBlockCollectionObject();
            $exporter = new ContainerExporter($page);
            $exporter->export($instance, $blockNode);
        }
    }

    public function getImportData($blockNode, $page)
    {
        $args = [];
        $entityManager = $this->app->make(EntityManager::class);
        if (isset($blockNode->container)) {
            $handle = (string) $blockNode->container['handle'];
            $container = $entityManager->getRepository(Container::class)
                ->findOneByContainerHandle($handle);
            if ($container) {
                $args['containerID'] = $container->getContainerID();
            }
        }
        return $args;
    }

    public function delete()
    {
        $entityManager = $this->app->make(EntityManager::class);
        // Remove all the blocks within this container's areas.
        $instance = $this->getContainerInstanceObject();
        if ($instance) {
            foreach($instance->getInstanceAreas() as $instanceArea) {
                $containerBlockInstance = new ContainerBlockInstance(
                    $this->getBlockObject(),
                    $instance,
                    $entityManager
                );
                $containerArea = new ContainerArea($containerBlockInstance, $instanceArea->getContainerAreaName());
                $subBlocks = $containerArea->getAreaBlocksArray($this->getCollectionObject());
                foreach($subBlocks as $subBlock) {
                    $subBlock->delete();
                }
            }
            $this->app->make(EntityManager::class)->remove($instance);
            $this->app->make(EntityManager::class)->flush();
        }
        parent::delete();
    }


    protected function importAdditionalData($b, $blockNode)
    {
        $db = $this->app->make(Connection::class);
        // such a pain
        $this->containerInstanceID = $db->fetchColumn('select containerInstanceID from btCoreContainer where bID = ?', [$b->getBlockID()]);


        $parentArea = $b->getBlockAreaObject();
        $page = $b->getBlockCollectionObject();

        $instance = $this->getContainerInstanceObject();

        $containerBlockInstance = $this->app->make(ContainerBlockInstance::class,
           ['block' => $b, 'instance' => $instance]
        );

        // go through all areas found under this node, and create the corresponding sub area.
        foreach ($blockNode->container->containerarea as $containerAreaNode) {

            $areaDisplayName = (string)$containerAreaNode['name'];
            $containerArea = new ContainerArea($containerBlockInstance, $areaDisplayName);

            $subArea = $containerArea->getSubAreaObject($page);

            if ($containerAreaNode->style) {
                $set = StyleSet::import($containerAreaNode->style);
                $page->setCustomStyleSet($subArea, $set);
            }
            foreach ($containerAreaNode->block as $bx) {
                $bt = BlockType::getByHandle((string)$bx['type']);
                if (!is_object($bt)) {
                    throw new \Exception(t('Invalid block type handle: %s', (string)($bx['type'])));
                }
                $btc = $bt->getController();
                $btc->import($page, $subArea->getAreaHandle(), $bx);
            }
        }
    }
    
}
