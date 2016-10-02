<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table
 */

class Reply{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */

    private $replyText;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="replies")
     */

    private $subject;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     minMessage = "Sadly your name is way too short for this awesome form :( btw the limit is  {{ limit }} characters ;D",
     *     maxMessage = "Ooooh nooooo :( your name is such a huge one (that's what she said) ! Stop this and write below {{ limit }} characters ;D"
     * )
     * @ORM\Column(type="string")
     */
   private $author;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * if we put in the panrentheses "checkHost=true" it allows to check if mail addresses really exist
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $vote;


    public function __construct()
    {
        $this->vote = 0;
    }

    /**
     * @return integer
     */

    public function getId(){
        return $this->id;
    }


    public function getReplyText()
    {
        return $this->replyText;
    }

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return mixed
     */
   public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    /**
     * @param text $replyText
     */
    public function setReplyText($replyText)
    {
        $this->replyText = $replyText;
    }


    public function getSubject()
    {
        return $this->subject;
    }


    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;
    }


}

