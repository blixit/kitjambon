<?php

namespace KITJAMBON\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="kj_options")
 * @ORM\Entity(repositoryClass="KITJAMBON\SiteBundle\Entity\OptionsRepository")
 */
class Options
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="option_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $optionId;

    /**
     * @var string
     *
     * @ORM\Column(name="option_nom", type="string", length=255)
     */
    private $optionNom;

    /**
     * @var string
     *
     * @ORM\Column(name="option_module", type="string", length=255)
     */
    private $optionModule;

    /**
     * @var string
     *
     * @ORM\Column(name="option_abrege", type="string", length=255)
     */
    private $optionAbrege;

    /**
     * @var integer
     *
     * @ORM\Column(name="option_annee", type="integer")
     */
    private $optionAnnee; 

    /**
     * Set optionId
     *
     * @param integer $optionId
     * @return Options
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * Get optionId
     *
     * @return integer 
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * Set optionNom
     *
     * @param string $optionNom
     * @return Options
     */
    public function setOptionNom($optionNom)
    {
        $this->optionNom = $optionNom;

        return $this;
    }

    /**
     * Get optionNom
     *
     * @return string 
     */
    public function getOptionNom()
    {
        return $this->optionNom;
    }

    /**
     * Set optionModule
     *
     * @param string $optionModule
     * @return Options
     */
    public function setOptionModule($optionModule)
    {
        $this->optionModule = $optionModule;

        return $this;
    }

    /**
     * Get optionModule
     *
     * @return string 
     */
    public function getOptionModule()
    {
        return $this->optionModule;
    }

    /**
     * Set optionAbrege
     *
     * @param string $optionAbrege
     * @return Options
     */
    public function setOptionAbrege($optionAbrege)
    {
        $this->optionAbrege = $optionAbrege;

        return $this;
    }

    /**
     * Get optionAbrege
     *
     * @return string 
     */
    public function getOptionAbrege()
    {
        return $this->optionAbrege;
    }

    /**
     * Set optionAnnee
     *
     * @param integer $optionAnnee
     * @return Options
     */
    public function setOptionAnnee($optionAnnee)
    {
        $this->optionAnnee = $optionAnnee;

        return $this;
    }

    /**
     * Get optionAnnee
     *
     * @return integer 
     */
    public function getOptionAnnee()
    {
        return $this->optionAnnee;
    }
}