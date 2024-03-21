<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Trick $trick): void
    {
        $this->_em->persist($trick);
        $this->_em->flush();
    }

    /**
     * @throws OptimisticLockException
     */
    public function update(Trick $trick): void
    {
        $this->_em->flush();
    }

    /**
     * @throws OptimisticLockException
     */
    public function delete(Trick $trick): void
    {
        $this->_em->remove($trick);
        $this->_em->flush();
    }

    // Find a Trick by its ID
    public function findById(int $id): ?Trick
    {
        return $this->find($id);
    }

    // Find all Tricks
    public function findAll(): array
    {
        return $this->findAll();
    }
}
