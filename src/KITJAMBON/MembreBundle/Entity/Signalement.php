<?php

namespace KITJAMBON\MembreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signalement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="KITJAMBON\MembreBundle\Entity\SignalementRepository")
 */
class Signalement
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="signalement_id", type="integer")
     */
    private $signalementId;

    /**
     * @var integer
     *
     * @ORM\Column(name="signalement_type", type="integer")
     */
    private $signalementType;

    /**
     * @var string
     *
     * @ORM\Column(name="signalement_message", type="text")
     */
    private $signalementMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="signalement_date", type="datetime")
     */
    private $signalementDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


    /**
     * Set signalementId
     *
     * @param integer $signalementId
     * @return Signalement
     */
    public function setSignalementId($signalementId)
    {
        $this->signalementId = $signalementId;

        return $this;
    }

    /**
     * Get signalementId
     *
     * @return integer 
     */
    public function getSignalementId()
    {
        return $this->signalementId;
    }

    /**
     * Set signalementType
     *
     * @param integer $signalementType
     * @return Signalement
     */
    public function setSignalementType($signalementType)
    {
        $this->signalementType = $signalementType;

        return $this;
    }

    /**
     * Get signalementType
     *
     * @return integer 
     */
    public function getSignalementType()
    {
        return $this->signalementType;
    }

    /**
     * Set signalementMessage
     *
     * @param string $signalementMessage
     * @return Signalement
     */
    public function setSignalementMessage($signalementMessage)
    {
        $this->signalementMessage = $signalementMessage;

        return $this;
    }

    /**
     * Get signalementMessage
     *
     * @return string 
     */
    public function getSignalementMessage()
    {
        return $this->signalementMessage;
    }

    /**
     * Set signalementDate
     *
     * @param \DateTime $signalementDate
     * @return Signalement
     */
    public function setSignalementDate($signalementDate)
    {
        $this->signalementDate = $signalementDate;

        return $this;
    }

    /**
     * Get signalementDate
     *
     * @return \DateTime 
     */
    public function getSignalementDate()
    {
        return $this->signalementDate;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Signalement
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
