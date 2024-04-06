<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\emInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

class TrickRepository extends ServiceEntityRepository
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
        $this->managerRegistry = $registry;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Trick $trick): void
    {
        $em = $this->managerRegistry->getManager();
        $em->persist($trick);
        $em->flush();
    }

    /**
     * @throws OptimisticLockException
     */
    public function update(Trick $trick): void
    {
        $this->em->flush();
    }

    /**
     * @throws OptimisticLockException
     */
    public function delete(Trick $trick): void
    {
        $this->em->remove($trick);
        $this->em->flush();
    }

    // Find a Trick by its ID
    public function findById(int $id): ?Trick
    {
        return $this->find($id);
    }

    // Find all Tricks ordered by creation date (most recent first)
    public function findAllOrderByCreationDate(): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC') // Trie par date de création (plus récent d'abord)
            ->getQuery()
            ->getResult();
    }

}
