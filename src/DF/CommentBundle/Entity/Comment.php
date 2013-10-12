<?php

namespace DF\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Config\Definition\IntegerNode;
use PA\CommentairesBundle\Controller\PublicController;

/**
 * @ORM\Table(name="comment")
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment  implements SignedCommentInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="DF\CommentBundle\Entity\Thread")
     */
    protected $thread;
    
    /**
     * Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="DF\UserBundle\Entity\User")
     * @var User
     */
    protected $author;
    
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }
    
        return $this->getAuthor();
    }  

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
