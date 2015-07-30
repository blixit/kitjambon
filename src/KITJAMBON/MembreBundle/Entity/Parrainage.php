<?php

namespace KITJAMBON\MembreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parrainage
 *
 * @ORM\Table(name="kj_parrainage")
 * @ORM\Entity(repositoryClass="KITJAMBON\MembreBundle\Entity\ParrainageRepository")
 */
class Parrainage
{

    /**
     * @var integer
     *
     * @ORM\Column(name="parrainage_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $parrainageId;

    /**
     * @var string
     *
     * @ORM\Column(name="parrainage_mail_fillot", type="string", length=255)
     */
    private $parrainageMailFillot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="parrainage_date", type="datetime")
     */
    private $parrainageDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="parrainage_valide", type="integer")
     */
    private $parrainageValide;

    /**
     * @var string
     *
     * @ORM\Column(name="parrainage_token", type="string", length=255)
     */
    private $parrainageToken;

    /**
     * @var integer
     *
     * @ORM\Column(name="parrain", type="integer")
     */
    private $parrain;

    /**
     * @var integer
     *
     * @ORM\Column(name="fillot", type="integer")
     */
    private $fillot;

    /**
     * Set parrainageId
     *
     * @param integer $parrainageId
     * @return Parrainage
     */
    public function setParrainageId($parrainageId)
    {
        $this->parrainageId = $parrainageId;

        return $this;
    }

    /**
     * Get parrainageId
     *
     * @return integer 
     */
    public function getParrainageId()
    {
        return $this->parrainageId;
    }

    /**
     * Set parrainageMailFillot
     *
     * @param string $parrainageMailFillot
     * @return Parrainage
     */
    public function setParrainageMailFillot($parrainageMailFillot)
    {
        $this->parrainageMailFillot = $parrainageMailFillot;

        return $this;
    }

    /**
     * Get parrainageMailFillot
     *
     * @return string 
     */
    public function getParrainageMailFillot()
    {
        return $this->parrainageMailFillot;
    }

    /**
     * Set parrainageDate
     *
     * @param \DateTime $parrainageDate
     * @return Parrainage
     */
    public function setParrainageDate($parrainageDate)
    {
        $this->parrainageDate = $parrainageDate;

        return $this;
    }

    /**
     * Get parrainageDate
     *
     * @return \DateTime 
     */
    public function getParrainageDate()
    {
        return $this->parrainageDate;
    }

    /**
     * Set parrainageValide
     *
     * @param integer $parrainageValide
     * @return Parrainage
     */
    public function setParrainageValide($parrainageValide)
    {
        $this->parrainageValide = $parrainageValide;

        return $this;
    }

    /**
     * Get parrainageValide
     *
     * @return integer 
     */
    public function getParrainageValide()
    {
        return $this->parrainageValide;
    }

    /**
     * Set parrainageToken
     *
     * @param string $parrainageToken
     * @return Parrainage
     */
    public function setParrainageToken($parrainageToken)
    {
        $this->parrainageToken = $parrainageToken;

        return $this;
    }

    /**
     * Get parrainageToken
     *
     * @return string 
     */
    public function getParrainageToken()
    {
        return $this->parrainageToken;
    }

    /**
     * Set parrain
     *
     * @param integer $parrain
     * @return Parrainage
     */
    public function setParrain($parrain)
    {
        $this->parrain = $parrain;

        return $this;
    }

    /**
     * Get parrain
     *
     * @return integer 
     */
    public function getParrain()
    {
        return $this->parrain;
    }

    /**
     * Set fillot
     *
     * @param integer $fillot
     * @return Parrainage
     */
    public function setFillot($fillot)
    {
        $this->fillot = $fillot;

        return $this;
    }

    /**
     * Get fillot
     *
     * @return integer 
     */
    public function getFillot()
    {
        return $this->fillot;
    }
}
