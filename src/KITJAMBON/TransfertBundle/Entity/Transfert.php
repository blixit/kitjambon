<?php

namespace KITJAMBON\TransfertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transfert
 *
 * @ORM\Table(name="kj_transfert")
 * @ORM\Entity(repositoryClass="KITJAMBON\TransfertBundle\Entity\TransfertRepository")
 */
class Transfert
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="transfert_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $transfertId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="transfert_down", type="boolean")
     */
    private $transfertDown;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transfert_date", type="datetime")
     */
    private $transfertDate;

    /**
     * @var string
     *
     * @ORM\Column(name="transfert_ip", type="string", length=16)
     */
    private $transfertIp;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer")
     */
    private $fileId;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_id", type="integer")
     */
    private $membreId;


    /**
     * Set transfertId
     *
     * @param integer $transfertId
     * @return Transfert
     */
    public function setTransfertId($transfertId)
    {
        $this->transfertId = $transfertId;

        return $this;
    }

    /**
     * Get transfertId
     *
     * @return integer 
     */
    public function getTransfertId()
    {
        return $this->transfertId;
    }

    /**
     * Set transfertDown
     *
     * @param boolean $transfertDown
     * @return Transfert
     */
    public function setTransfertDown($transfertDown)
    {
        $this->transfertDown = $transfertDown;

        return $this;
    }

    /**
     * Get transfertDown
     *
     * @return boolean 
     */
    public function getTransfertDown()
    {
        return $this->transfertDown;
    }

    /**
     * Set transfertDate
     *
     * @param \DateTime $transfertDate
     * @return Transfert
     */
    public function setTransfertDate($transfertDate)
    {
        $this->transfertDate = $transfertDate;

        return $this;
    }

    /**
     * Get transfertDate
     *
     * @return \DateTime 
     */
    public function getTransfertDate()
    {
        return $this->transfertDate;
    }

    /**
     * Set transfertIp
     *
     * @param string $transfertIp
     * @return Transfert
     */
    public function setTransfertIp($transfertIp)
    {
        $this->transfertIp = $transfertIp;

        return $this;
    }

    /**
     * Get transfertIp
     *
     * @return string 
     */
    public function getTransfertIp()
    {
        return $this->transfertIp;
    }

    /**
     * Set fileId
     *
     * @param integer $fileId
     * @return Transfert
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;

        return $this;
    }

    /**
     * Get fileId
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * Set membreId
     *
     * @param integer $membreId
     * @return Transfert
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
