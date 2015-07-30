<?php

namespace KITJAMBON\TransfertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="KITJAMBON\TransfertBundle\Entity\FileRepository")
 */
class File
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer")
     */
    private $fileId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_nom", type="string", length=255)
     */
    private $fileNom;

    /**
     * @var string
     *
     * @ORM\Column(name="file_mime", type="string", length=255)
     */
    private $fileMime;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_taille", type="integer")
     */
    private $fileTaille;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_annee", type="integer")
     */
    private $fileAnnee;

    /**
     * @var string
     *
     * @ORM\Column(name="file_typedoc", type="string", length=3)
     */
    private $fileTypedoc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="file_valide", type="boolean")
     */
    private $fileValide;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_nb_vues", type="integer")
     */
    private $fileNbVues;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_nb_like", type="integer")
     */
    private $fileNbLike;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_nb_dislike", type="integer")
     */
    private $fileNbDislike;

    /**
     * @var integer
     *
     * @ORM\Column(name="grade_id", type="integer")
     */
    private $gradeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="option_id", type="integer")
     */
    private $optionId;


    /**
     * Set fileId
     *
     * @param integer $fileId
     * @return File
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
     * Set fileNom
     *
     * @param string $fileNom
     * @return File
     */
    public function setFileNom($fileNom)
    {
        $this->fileNom = $fileNom;

        return $this;
    }

    /**
     * Get fileNom
     *
     * @return string 
     */
    public function getFileNom()
    {
        return $this->fileNom;
    }

    /**
     * Set fileMime
     *
     * @param string $fileMime
     * @return File
     */
    public function setFileMime($fileMime)
    {
        $this->fileMime = $fileMime;

        return $this;
    }

    /**
     * Get fileMime
     *
     * @return string 
     */
    public function getFileMime()
    {
        return $this->fileMime;
    }

    /**
     * Set fileTaille
     *
     * @param integer $fileTaille
     * @return File
     */
    public function setFileTaille($fileTaille)
    {
        $this->fileTaille = $fileTaille;

        return $this;
    }

    /**
     * Get fileTaille
     *
     * @return integer 
     */
    public function getFileTaille()
    {
        return $this->fileTaille;
    }

    /**
     * Set fileAnnee
     *
     * @param integer $fileAnnee
     * @return File
     */
    public function setFileAnnee($fileAnnee)
    {
        $this->fileAnnee = $fileAnnee;

        return $this;
    }

    /**
     * Get fileAnnee
     *
     * @return integer 
     */
    public function getFileAnnee()
    {
        return $this->fileAnnee;
    }

    /**
     * Set fileTypedoc
     *
     * @param string $fileTypedoc
     * @return File
     */
    public function setFileTypedoc($fileTypedoc)
    {
        $this->fileTypedoc = $fileTypedoc;

        return $this;
    }

    /**
     * Get fileTypedoc
     *
     * @return string 
     */
    public function getFileTypedoc()
    {
        return $this->fileTypedoc;
    }

    /**
     * Set fileValide
     *
     * @param boolean $fileValide
     * @return File
     */
    public function setFileValide($fileValide)
    {
        $this->fileValide = $fileValide;

        return $this;
    }

    /**
     * Get fileValide
     *
     * @return boolean 
     */
    public function getFileValide()
    {
        return $this->fileValide;
    }

    /**
     * Set fileNbVues
     *
     * @param integer $fileNbVues
     * @return File
     */
    public function setFileNbVues($fileNbVues)
    {
        $this->fileNbVues = $fileNbVues;

        return $this;
    }

    /**
     * Get fileNbVues
     *
     * @return integer 
     */
    public function getFileNbVues()
    {
        return $this->fileNbVues;
    }

    /**
     * Set fileNbLike
     *
     * @param integer $fileNbLike
     * @return File
     */
    public function setFileNbLike($fileNbLike)
    {
        $this->fileNbLike = $fileNbLike;

        return $this;
    }

    /**
     * Get fileNbLike
     *
     * @return integer 
     */
    public function getFileNbLike()
    {
        return $this->fileNbLike;
    }

    /**
     * Set fileNbDislike
     *
     * @param integer $fileNbDislike
     * @return File
     */
    public function setFileNbDislike($fileNbDislike)
    {
        $this->fileNbDislike = $fileNbDislike;

        return $this;
    }

    /**
     * Get fileNbDislike
     *
     * @return integer 
     */
    public function getFileNbDislike()
    {
        return $this->fileNbDislike;
    }

    /**
     * Set gradeId
     *
     * @param integer $gradeId
     * @return File
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

    /**
     * Set optionId
     *
     * @param integer $optionId
     * @return File
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
}
