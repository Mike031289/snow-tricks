<?php

namespace App\Repository;

use App\Entity\Trick;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * Finds a category by its related trick.
     *
     * @param Trick $trick
     * @return Category|null
     */
    public function findOneByTrick(Trick $trick): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere(':trick MEMBER OF c.tricks')
            ->setParameter('trick', $trick)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
