<?php

namespace Proxies\__CG__\KITJAMBON\MembreBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Membre extends \KITJAMBON\MembreBundle\Entity\Membre implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
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
            return array('__isInitialized__', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreId', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreLogin', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membrePass', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreMail', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreStatut', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreAnnee', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreToken', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreTemperament', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreDateDescription', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreEtat', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreRenewPass', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbDown', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbUp', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbAvPlus', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbAvMoins', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbMessages', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbConnexions', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreLastConnexion', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbParrainages', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbSignalements', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'optionId', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'gradeId');
        }

        return array('__isInitialized__', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreId', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreLogin', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membrePass', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreMail', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreStatut', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreAnnee', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreToken', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreTemperament', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreDateDescription', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreEtat', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreRenewPass', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbDown', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbUp', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbAvPlus', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbAvMoins', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbMessages', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbConnexions', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreLastConnexion', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbParrainages', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'membreNbSignalements', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'optionId', '' . "\0" . 'KITJAMBON\\MembreBundle\\Entity\\Membre' . "\0" . 'gradeId');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Membre $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
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
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setMembreId($membreId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreId', array($membreId));

        return parent::setMembreId($membreId);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getMembreId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreId', array());

        return parent::getMembreId();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreLogin($membreLogin)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreLogin', array($membreLogin));

        return parent::setMembreLogin($membreLogin);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreLogin', array());

        return parent::getMembreLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembrePass($membrePass)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembrePass', array($membrePass));

        return parent::setMembrePass($membrePass);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembrePass()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembrePass', array());

        return parent::getMembrePass();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreMail($membreMail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreMail', array($membreMail));

        return parent::setMembreMail($membreMail);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreMail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreMail', array());

        return parent::getMembreMail();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreStatut($membreStatut)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreStatut', array($membreStatut));

        return parent::setMembreStatut($membreStatut);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreStatut()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreStatut', array());

        return parent::getMembreStatut();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreAnnee($membreAnnee)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreAnnee', array($membreAnnee));

        return parent::setMembreAnnee($membreAnnee);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreAnnee()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreAnnee', array());

        return parent::getMembreAnnee();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreToken($membreToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreToken', array($membreToken));

        return parent::setMembreToken($membreToken);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreToken', array());

        return parent::getMembreToken();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreTemperament($membreTemperament)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreTemperament', array($membreTemperament));

        return parent::setMembreTemperament($membreTemperament);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreTemperament()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreTemperament', array());

        return parent::getMembreTemperament();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreDateDescription($membreDateDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreDateDescription', array($membreDateDescription));

        return parent::setMembreDateDescription($membreDateDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreDateDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreDateDescription', array());

        return parent::getMembreDateDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreEtat($membreEtat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreEtat', array($membreEtat));

        return parent::setMembreEtat($membreEtat);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreEtat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreEtat', array());

        return parent::getMembreEtat();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreRenewPass($membreRenewPass)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreRenewPass', array($membreRenewPass));

        return parent::setMembreRenewPass($membreRenewPass);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreRenewPass()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreRenewPass', array());

        return parent::getMembreRenewPass();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbDown($membreNbDown)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbDown', array($membreNbDown));

        return parent::setMembreNbDown($membreNbDown);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbDown()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbDown', array());

        return parent::getMembreNbDown();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbUp($membreNbUp)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbUp', array($membreNbUp));

        return parent::setMembreNbUp($membreNbUp);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbUp()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbUp', array());

        return parent::getMembreNbUp();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreAvPlus($membreAvPlus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreAvPlus', array($membreAvPlus));

        return parent::setMembreAvPlus($membreAvPlus);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreAvPlus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreAvPlus', array());

        return parent::getMembreAvPlus();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreAvMoins($membreAvMoins)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreAvMoins', array($membreAvMoins));

        return parent::setMembreAvMoins($membreAvMoins);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreAvMoins()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreAvMoins', array());

        return parent::getMembreAvMoins();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbMessages($membreNbMessages)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbMessages', array($membreNbMessages));

        return parent::setMembreNbMessages($membreNbMessages);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbMessages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbMessages', array());

        return parent::getMembreNbMessages();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbConnexions($membreNbConnexions)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbConnexions', array($membreNbConnexions));

        return parent::setMembreNbConnexions($membreNbConnexions);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbConnexions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbConnexions', array());

        return parent::getMembreNbConnexions();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreLastConnexion($membreLastConnexion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreLastConnexion', array($membreLastConnexion));

        return parent::setMembreLastConnexion($membreLastConnexion);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreLastConnexion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreLastConnexion', array());

        return parent::getMembreLastConnexion();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbParrainages($membreNbParrainages)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbParrainages', array($membreNbParrainages));

        return parent::setMembreNbParrainages($membreNbParrainages);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbParrainages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbParrainages', array());

        return parent::getMembreNbParrainages();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembreNbSignalements($membreNbSignalements)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembreNbSignalements', array($membreNbSignalements));

        return parent::setMembreNbSignalements($membreNbSignalements);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembreNbSignalements()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembreNbSignalements', array());

        return parent::getMembreNbSignalements();
    }

    /**
     * {@inheritDoc}
     */
    public function setOptionId($optionId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOptionId', array($optionId));

        return parent::setOptionId($optionId);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOptionId', array());

        return parent::getOptionId();
    }

    /**
     * {@inheritDoc}
     */
    public function setGradeId($gradeId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGradeId', array($gradeId));

        return parent::setGradeId($gradeId);
    }

    /**
     * {@inheritDoc}
     */
    public function getGradeId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGradeId', array());

        return parent::getGradeId();
    }

}
