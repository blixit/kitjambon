<?php

namespace KITJAMBON\MembreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="KITJAMBON\MembreBundle\Entity\MembreRepository")
 */
class Membre
{ 
    /**
     * @var integer
     *
     * @ORM\Column(name="membre_id", type="integer")
     */
    private $membreId;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_login", type="string", length=255)
     */
    private $membreLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_pass", type="string", length=255)
     */
    private $membrePass;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_mail", type="string", length=255)
     */
    private $membreMail;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_statut", type="string", length=32)
     */
    private $membreStatut;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_annee", type="integer")
     */
    private $membreAnnee;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_token", type="string", length=255)
     */
    private $membreToken;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_temperament", type="string", length=255)
     */
    private $membreTemperament;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="membre_date_description", type="datetime")
     */
    private $membreDateDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_etat", type="integer")
     */
    private $membreEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="membre_renew_pass", type="string", length=255)
     */
    private $membreRenewPass;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_down", type="integer")
     */
    private $membreNbDown;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_up", type="integer")
     */
    private $membreNbUp;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_av_plus", type="integer")
     */
    private $membreNbAvPlus;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_av_moins", type="integer")
     */
    private $membreNbAvMoins;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_messages", type="integer")
     */
    private $membreNbMessages;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_connexions", type="integer")
     */
    private $membreNbConnexions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="membre_last_connexion", type="datetime")
     */
    private $membreLastConnexion;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_parrainages", type="integer")
     */
    private $membreNbParrainages;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_nb_signalements", type="integer")
     */
    private $membreNbSignalements;

    /**
     * @var integer
     *
     * @ORM\Column(name="option_id", type="integer")
     */
    private $optionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="grade_id", type="integer")
     */
    private $gradeId;


    /**
     * Set membreId
     *
     * @param integer $membreId
     * @return Membre
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

    /**
     * Set membreLogin
     *
     * @param string $membreLogin
     * @return Membre
     */
    public function setMembreLogin($membreLogin)
    {
        $this->membreLogin = $membreLogin;

        return $this;
    }

    /**
     * Get membreLogin
     *
     * @return string 
     */
    public function getMembreLogin()
    {
        return $this->membreLogin;
    }

    /**
     * Set membrePass
     *
     * @param string $membrePass
     * @return Membre
     */
    public function setMembrePass($membrePass)
    {
        $this->membrePass = $membrePass;

        return $this;
    }

    /**
     * Get membrePass
     *
     * @return string 
     */
    public function getMembrePass()
    {
        return $this->membrePass;
    }

    /**
     * Set membreMail
     *
     * @param string $membreMail
     * @return Membre
     */
    public function setMembreMail($membreMail)
    {
        $this->membreMail = $membreMail;

        return $this;
    }

    /**
     * Get membreMail
     *
     * @return string 
     */
    public function getMembreMail()
    {
        return $this->membreMail;
    }

    /**
     * Set membreStatut
     *
     * @param string $membreStatut
     * @return Membre
     */
    public function setMembreStatut($membreStatut)
    {
        $this->membreStatut = $membreStatut;

        return $this;
    }

    /**
     * Get membreStatut
     *
     * @return string 
     */
    public function getMembreStatut()
    {
        return $this->membreStatut;
    }

    /**
     * Set membreAnnee
     *
     * @param integer $membreAnnee
     * @return Membre
     */
    public function setMembreAnnee($membreAnnee)
    {
        $this->membreAnnee = $membreAnnee;

        return $this;
    }

    /**
     * Get membreAnnee
     *
     * @return integer 
     */
    public function getMembreAnnee()
    {
        return $this->membreAnnee;
    }

    /**
     * Set membreToken
     *
     * @param string $membreToken
     * @return Membre
     */
    public function setMembreToken($membreToken)
    {
        $this->membreToken = $membreToken;

        return $this;
    }

    /**
     * Get membreToken
     *
     * @return string 
     */
    public function getMembreToken()
    {
        return $this->membreToken;
    }

    /**
     * Set membreTemperament
     *
     * @param string $membreTemperament
     * @return Membre
     */
    public function setMembreTemperament($membreTemperament)
    {
        $this->membreTemperament = $membreTemperament;

        return $this;
    }

    /**
     * Get membreTemperament
     *
     * @return string 
     */
    public function getMembreTemperament()
    {
        return $this->membreTemperament;
    }

    /**
     * Set membreDateDescription
     *
     * @param \DateTime $membreDateDescription
     * @return Membre
     */
    public function setMembreDateDescription($membreDateDescription)
    {
        $this->membreDateDescription = $membreDateDescription;

        return $this;
    }

    /**
     * Get membreDateDescription
     *
     * @return \DateTime 
     */
    public function getMembreDateDescription()
    {
        return $this->membreDateDescription;
    }

    /**
     * Set membreEtat
     *
     * @param integer $membreEtat
     * @return Membre
     */
    public function setMembreEtat($membreEtat)
    {
        $this->membreEtat = $membreEtat;

        return $this;
    }

    /**
     * Get membreEtat
     *
     * @return integer 
     */
    public function getMembreEtat()
    {
        return $this->membreEtat;
    }

    /**
     * Set membreRenewPass
     *
     * @param string $membreRenewPass
     * @return Membre
     */
    public function setMembreRenewPass($membreRenewPass)
    {
        $this->membreRenewPass = $membreRenewPass;

        return $this;
    }

    /**
     * Get membreRenewPass
     *
     * @return string 
     */
    public function getMembreRenewPass()
    {
        return $this->membreRenewPass;
    }

    /**
     * Set membreNbDown
     *
     * @param integer $membreNbDown
     * @return Membre
     */
    public function setMembreNbDown($membreNbDown)
    {
        $this->membreNbDown = $membreNbDown;

        return $this;
    }

    /**
     * Get membreNbDown
     *
     * @return integer 
     */
    public function getMembreNbDown()
    {
        return $this->membreNbDown;
    }

    /**
     * Set membreNbUp
     *
     * @param integer $membreNbUp
     * @return Membre
     */
    public function setMembreNbUp($membreNbUp)
    {
        $this->membreNbUp = $membreNbUp;

        return $this;
    }

    /**
     * Get membreNbUp
     *
     * @return integer 
     */
    public function getMembreNbUp()
    {
        return $this->membreNbUp;
    }

    /**
     * Set membreAvPlus
     *
     * @param integer $membreAvPlus
     * @return Membre
     */
    public function setMembreAvPlus($membreAvPlus)
    {
        $this->membreAvPlus = $membreAvPlus;

        return $this;
    }

    /**
     * Get membreAvPlus
     *
     * @return integer 
     */
    public function getMembreAvPlus()
    {
        return $this->membreAvPlus;
    }

    /**
     * Set membreAvMoins
     *
     * @param integer $membreAvMoins
     * @return Membre
     */
    public function setMembreAvMoins($membreAvMoins)
    {
        $this->membreAvMoins = $membreAvMoins;

        return $this;
    }

    /**
     * Get membreAvMoins
     *
     * @return integer 
     */
    public function getMembreAvMoins()
    {
        return $this->membreAvMoins;
    }

    /**
     * Set membreNbMessages
     *
     * @param integer $membreNbMessages
     * @return Membre
     */
    public function setMembreNbMessages($membreNbMessages)
    {
        $this->membreNbMessages = $membreNbMessages;

        return $this;
    }

    /**
     * Get membreNbMessages
     *
     * @return integer 
     */
    public function getMembreNbMessages()
    {
        return $this->membreNbMessages;
    }

    /**
     * Set membreNbConnexions
     *
     * @param integer $membreNbConnexions
     * @return Membre
     */
    public function setMembreNbConnexions($membreNbConnexions)
    {
        $this->membreNbConnexions = $membreNbConnexions;

        return $this;
    }

    /**
     * Get membreNbConnexions
     *
     * @return integer 
     */
    public function getMembreNbConnexions()
    {
        return $this->membreNbConnexions;
    }

    /**
     * Set membreLastConnexion
     *
     * @param \DateTime $membreLastConnexion
     * @return Membre
     */
    public function setMembreLastConnexion($membreLastConnexion)
    {
        $this->membreLastConnexion = $membreLastConnexion;

        return $this;
    }

    /**
     * Get membreLastConnexion
     *
     * @return \DateTime 
     */
    public function getMembreLastConnexion()
    {
        return $this->membreLastConnexion;
    }

    /**
     * Set membreNbParrainages
     *
     * @param integer $membreNbParrainages
     * @return Membre
     */
    public function setMembreNbParrainages($membreNbParrainages)
    {
        $this->membreNbParrainages = $membreNbParrainages;

        return $this;
    }

    /**
     * Get membreNbParrainages
     *
     * @return integer 
     */
    public function getMembreNbParrainages()
    {
        return $this->membreNbParrainages;
    }

    /**
     * Set membreNbSignalements
     *
     * @param integer $membreNbSignalements
     * @return Membre
     */
    public function setMembreNbSignalements($membreNbSignalements)
    {
        $this->membreNbSignalements = $membreNbSignalements;

        return $this;
    }

    /**
     * Get membreNbSignalements
     *
     * @return integer 
     */
    public function getMembreNbSignalements()
    {
        return $this->membreNbSignalements;
    }

    /**
     * Set optionId
     *
     * @param integer $optionId
     * @return Membre
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
     * Set gradeId
     *
     * @param integer $gradeId
     * @return Membre
     */
    public function setGradeId($gradeId)
    {
        $this->gradeId = $gradeId;

        return $this;
    }

    /**
     * Get gradeId
     *
     * @return integer 
     */
    public function getGradeId()
    {
        return $this->gradeId;
    }
}
