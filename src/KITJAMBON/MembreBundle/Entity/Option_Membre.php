<?php

namespace KITJAMBON\MembreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Option_Membre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="KITJAMBON\MembreBundle\Entity\Option_MembreRepository")
 */
class Option_Membre
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="option_id", type="integer")
     */
    private $optionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_id", type="integer")
     */
    private $membreId;
    

    /**
     * Set optionId
     *
     * @param integer $optionId
     * @return Option_Membre
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
     * Set membreId
     *
     * @param integer $membreId
     * @return Option_Membre
     */
    public function setMembreId($membreId)
    {
        $this->membreId = $membreId;

        return $this;
    }

    /**
     * Get membreId
     *
     * @return integer 
     */
    public function getMembreId()
    {
        return $this->membreId;
    }
}
