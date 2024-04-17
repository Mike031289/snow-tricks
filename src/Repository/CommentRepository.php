<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
        $this->managerRegistry = $registry;
    }

    /**
     * Add a comment to the related trick.
     *
     * @param Comment $comment
     * @param Trick $trick
     */
    public function addCommentToTrick(Comment $comment, Trick $trick): void
    {
        $em = $this->managerRegistry->getManager();

        // Associate the comment with the trick
        $comment->setTrick($trick);

        // Persist the comment to the database
        $em->persist($comment);
        $em->flush();
    }
}
