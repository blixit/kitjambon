<?php

namespace KITJAMBON\MembreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grade
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="KITJAMBON\MembreBundle\Entity\GradeRepository")
 */
class Grade
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="grade_id", type="integer")
     */
    private $gradeId;

    /**
     * @var string
     *
     * @ORM\Column(name="grade_nom", type="string", length=32)
     */
    private $gradeNom;

    /**
     * @var string
     *
     * @ORM\Column(name="grade_abrege", type="string", length=8)
     */
    private $gradeAbrege;

    /**
     * @var integer
     *
     * @ORM\Column(name="grade_nd_point", type="integer")
     */
    private $gradeNdPoint;

    /**
     * Set gradeId
     *
     * @param integer $gradeId
     * @return Grade
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
     * Set gradeNom
     *
     * @param string $gradeNom
     * @return Grade
     */
    public function setGradeNom($gradeNom)
    {
        $this->gradeNom = $gradeNom;

        return $this;
    }

    /**
     * Get gradeNom
     *
     * @return string 
     */
    public function getGradeNom()
    {
        return $this->gradeNom;
    }

    /**
     * Set gradeAbrege
     *
     * @param string $gradeAbrege
     * @return Grade
     */
    public function setGradeAbrege($gradeAbrege)
    {
        $this->gradeAbrege = $gradeAbrege;

        return $this;
    }

    /**
     * Get gradeAbrege
     *
     * @return string 
     */
    public function getGradeAbrege()
    {
        return $this->gradeAbrege;
    }

    /**
     * Set gradeNdPoint
     *
     * @param integer $gradeNdPoint
     * @return Grade
     */
    public function setGradeNdPoint($gradeNdPoint)
    {
        $this->gradeNdPoint = $gradeNdPoint;

        return $this;
    }

    /**
     * Get gradeNdPoint
     *
     * @return integer 
     */
    public function getGradeNdPoint()
    {
        return $this->gradeNdPoint;
    }
}
