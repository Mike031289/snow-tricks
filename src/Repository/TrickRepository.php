<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
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
        $em = $this->managerRegistry->getManager();
        $em->remove($trick);
        $em->flush();
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

        /**
     * Find a Trick by its name.
     *
     * @param string $name The name of the trick to find.
     * @return Trick|null The Trick entity if found, null otherwise.
     */
    // public function findByName(string $name): ?Trick
    // {
    //     return $this->createQueryBuilder('t')
    //         ->andWhere('t.name = :name')
    //         ->setParameter('name', $name)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

}
