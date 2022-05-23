<?php

namespace DoctrineProxies\__CG__\Concrete\Core\Entity\Board;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class InstanceSlot extends \Concrete\Core\Entity\Board\InstanceSlot implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'boardInstanceSlotID', 'instance', 'template', 'slot', 'bID'];
        }

        return ['__isInitialized__', 'boardInstanceSlotID', 'instance', 'template', 'slot', 'bID'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (InstanceSlot $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load(): void
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized(): bool
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized): void
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null): void
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer(): ?\Closure
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null): void
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner(): ?\Closure
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties(): array
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getBoardInstanceSlotID()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getBoardInstanceSlotID();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBoardInstanceSlotID', []);

        return parent::getBoardInstanceSlotID();
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate(): \Concrete\Core\Entity\Board\SlotTemplate
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTemplate', []);

        return parent::getTemplate();
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate($template): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTemplate', [$template]);

        parent::setTemplate($template);
    }

    /**
     * {@inheritDoc}
     */
    public function getSlot()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSlot', []);

        return parent::getSlot();
    }

    /**
     * {@inheritDoc}
     */
    public function setSlot($slot): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSlot', [$slot]);

        parent::setSlot($slot);
    }

    /**
     * {@inheritDoc}
     */
    public function getInstance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstance', []);

        return parent::getInstance();
    }

    /**
     * {@inheritDoc}
     */
    public function setInstance($instance): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInstance', [$instance]);

        parent::setInstance($instance);
    }

    /**
     * {@inheritDoc}
     */
    public function getContentSlots()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContentSlots', []);

        return parent::getContentSlots();
    }

    /**
     * {@inheritDoc}
     */
    public function setContentSlots($content_slots): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContentSlots', [$content_slots]);

        parent::setContentSlots($content_slots);
    }

    /**
     * {@inheritDoc}
     */
    public function getBlockID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBlockID', []);

        return parent::getBlockID();
    }

    /**
     * {@inheritDoc}
     */
    public function setBlockID($bID): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBlockID', [$bID]);

        parent::setBlockID($bID);
    }

}