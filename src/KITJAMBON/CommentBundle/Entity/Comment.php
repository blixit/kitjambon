<?php

namespace KITJAMBON\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="kj_comment")
 * @ORM\Entity(repositoryClass="KITJAMBON\CommentBundle\Entity\CommentRepository")
 */
class Comment
{ 

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $commentId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_message", type="text")
     */
    private $commentMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_date", type="datetime")
     */
    private $commentDate;

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
     * Set commentId
     *
     * @param integer $commentId
     * @return Comment
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * Get commentId
     *
     * @return integer 
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set commentMessage
     *
     * @param string $commentMessage
     * @return Comment
     */
    public function setCommentMessage($commentMessage)
    {
        $this->commentMessage = $commentMessage;

        return $this;
    }

    /**
     * Get commentMessage
     *
     * @return string 
     */
    public function getCommentMessage()
    {
        return $this->commentMessage;
    }

    /**
     * Set commentDate
     *
     * @param \DateTime $commentDate
     * @return Comment
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;

        return $this;
    }

    /**
     * Get commentDate
     *
     * @return \DateTime 
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Set fileId
     *
     * @param integer $fileId
     * @return Comment
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
     * @return Comment
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
